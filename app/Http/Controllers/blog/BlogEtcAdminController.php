<?php

namespace App\Http\Controllers\blog;

use App\blog_slider;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use WebDevEtc\BlogEtc\Interfaces\BaseRequestInterface;
use WebDevEtc\BlogEtc\Events\BlogPostAdded;
use WebDevEtc\BlogEtc\Events\BlogPostEdited;
use WebDevEtc\BlogEtc\Events\BlogPostWillBeDeleted;
use WebDevEtc\BlogEtc\Helpers;
use WebDevEtc\BlogEtc\Middleware\UserCanManageBlogPosts;
use WebDevEtc\BlogEtc\Models\BlogEtcPost;
use WebDevEtc\BlogEtc\Models\BlogEtcUploadedPhoto;
use WebDevEtc\BlogEtc\Requests\CreateBlogEtcPostRequest;
use WebDevEtc\BlogEtc\Requests\DeleteBlogEtcPostRequest;
use WebDevEtc\BlogEtc\Requests\UpdateBlogEtcPostRequest;
use WebDevEtc\BlogEtc\Traits\UploadFileTrait;

/**
 * Class BlogEtcAdminController
 * @package WebDevEtc\BlogEtc\Controllers
 */
class BlogEtcAdminController extends Controller
{
    use UploadFileTrait;

    /**
     * BlogEtcAdminController constructor.
     */
    public function __construct()
    {
        $this->middleware(UserCanManageBlogPosts::class);

        if (!is_array(config("blogetc"))) {
            throw new \RuntimeException('The config/blogetc.php does not exist. Publish the vendor files for the BlogEtc package by running the php artisan publish:vendor command');
        }
    }


    /**
     * View all posts
     *
     * @return mixed
     */
    public function index()
    {
        $posts = BlogEtcPost::orderBy("posted_at", "desc")
            ->paginate(100);
        return view("blog.blogetc_admin.index", ['posts' => $posts]);
    }

    public function slider()
    {
        $sliders = blog_slider::get();

        return view("blog.blogetc_admin.slider.index", compact('sliders'));
    }

    public function slider_page($slider_id = null)
    {
        $slider = null;
        if ($slider_id) {
            $slider = blog_slider::find($slider_id);
        }

        return view("blog.blogetc_admin.slider.slider_page", compact('slider'));
    }

    public function save_slider($slider_id = null, Request $request)
    {
        $this->validate($request, [
            'filepath' => 'required',
        ]);
        if ($request['slider_id']) {
            $slider = blog_slider::find($request['slider_id']);
        } else {
            $slider = new blog_slider();
        }
        $slider->image_large = $request['filepath'];
        $slider->text_1 = $request['text_1'] or null;
        $slider->text_1_dir = $request['text_1_dir'] or null;
        $slider->text_2 = $request['text_2'] or null;
        $slider->text_2_dir = $request['text_2_dir'] or null;
        $slider->text_3 = $request['text_3'] or null;
        $slider->text_3_dir = $request['text_3_dir'] or null;
        $slider->btn_text = $request['btn_text'] or null;
        $slider->btn_link = $request['btn_link'] or null;
        $slider->btn_dir = $request['btn_dir'] or null;
        $slider->save();
        return redirect()->route('blog_slider');
    }

    public function delete_slider($slider_id = null, Request $request)
    {
        $slider = blog_slider::find($slider_id);
        $slider->delete();
        $messages = trans('messages.item_deleted', ['item' => trans('messages.blog_slider')]);
        return back_normal($request, $messages);

    }

    /**
     * Show form for creating new post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create_post()
    {
        return view("blog.blogetc_admin.posts.add_post");
    }

    /**
     * Save a new post
     *
     * @param CreateBlogEtcPostRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function store_post(CreateBlogEtcPostRequest $request)
    {
        $request['posted_at']  = shamsi_to_miladi($request['posted_at']);
        $new_blog_post = new BlogEtcPost($request->all());

        $this->processUploadedImages($request, $new_blog_post);

        if (!$new_blog_post->posted_at) {
            $new_blog_post->posted_at = date('Y-m-d H:i:s');
        }

        $new_blog_post->user_id = \Auth::user()->id;
        $new_blog_post->save();

        $new_blog_post->categories()->sync($request->categories());
        $new_blog_post->specificPage()->sync($request->specificPage());

        Helpers::flash_message("Added post");
        event(new BlogPostAdded($new_blog_post));
        return redirect($new_blog_post->edit_url());
    }

    /**
     * Show form to edit post
     *
     * @param $blogPostId
     * @return mixed
     */
    public function edit_post($blogPostId)
    {
        $post = BlogEtcPost::findOrFail($blogPostId);
        return view("blog.blogetc_admin.posts.edit_post")->withPost($post);
    }

    /**
     * Save changes to a post
     *
     * @param UpdateBlogEtcPostRequest $request
     * @param $blogPostId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function update_post(UpdateBlogEtcPostRequest $request, $blogPostId)
    {
        /** @var BlogEtcPost $post */
        $request['posted_at']  = shamsi_to_miladi($request['posted_at']);
        $post = BlogEtcPost::findOrFail($blogPostId);
        $post->fill($request->all());

        $this->processUploadedImages($request, $post);

        $post->save();
        $post->categories()->sync($request->categories());
        $post->specificPage()->sync($request->specificPage());


        Helpers::flash_message("Updated post");
        event(new BlogPostEdited($post));

        return redirect($post->edit_url());

    }

    /**
     * Delete a post
     *
     * @param DeleteBlogEtcPostRequest $request
     * @param $blogPostId
     * @return mixed
     */
    public function destroy_post(DeleteBlogEtcPostRequest $request, $blogPostId)
    {

        $post = BlogEtcPost::findOrFail($blogPostId);
        event(new BlogPostWillBeDeleted($post));

        $post->delete();

        // todo - delete the featured images?
        // At the moment it just issues a warning saying the images are still on the server.

        return back_normal($post,['message'=>'ok']);
        return view("blog.blogetc_admin.posts.deleted_post")
            ->withDeletedPost($post);

    }

    /**
     * Process any uploaded images (for featured image)
     *
     * @param BaseRequestInterface $request
     * @param $new_blog_post
     * @throws \Exception
     * @todo - next full release, tidy this up!
     */
    protected function processUploadedImages(BaseRequestInterface $request, BlogEtcPost $new_blog_post)
    {
        if (!config("blogetc.image_upload_enabled")) {
            // image upload was disabled
            return;
        }

        $this->increaseMemoryLimit();

        // to save in db later
        $uploaded_image_details = [];


        foreach ((array)config('blogetc.image_sizes') as $size => $image_size_details) {

            if ($image_size_details['enabled'] && $photo = $request->get_image_file($size)) {
                // this image size is enabled, and
                // we have an uploaded image that we can use

                $uploaded_image = $this->UploadAndResize($new_blog_post, $new_blog_post->title, $image_size_details, $photo);

                $new_blog_post->$size = $uploaded_image['filename'];
                $uploaded_image_details[$size] = $uploaded_image;
            }
        }


        // store the image upload.
        // todo: link this to the blogetc_post row.
        if (count(array_filter($uploaded_image_details)) > 0) {
            BlogEtcUploadedPhoto::create([
                'source' => "BlogFeaturedImage",
                'uploaded_images' => $uploaded_image_details,
            ]);
        }


    }


}

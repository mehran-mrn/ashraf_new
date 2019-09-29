<?php

namespace App\Http\Controllers\blog;

use App\blogEtcSpecificPage;
use App\Http\Controllers\Controller;
use WebDevEtc\BlogEtc\Events\SpecificPageAdded;
use WebDevEtc\BlogEtc\Events\SpecificPageEdited;
use WebDevEtc\BlogEtc\Events\SpecificPageWillBeDeleted;
use WebDevEtc\BlogEtc\Helpers;
use WebDevEtc\BlogEtc\Middleware\UserCanManageBlogPosts;
use WebDevEtc\BlogEtc\Models\BlogEtcCategory;
use WebDevEtc\BlogEtc\Models\BlogEtcSpecificPages;
use WebDevEtc\BlogEtc\Requests\DeleteBlogEtcCategoryRequest;
use WebDevEtc\BlogEtc\Requests\StoreBlogEtcCategoryRequest;
use WebDevEtc\BlogEtc\Requests\UpdateBlogEtcCategoryRequest;

/**
 * Class BlogEtcCategoryAdminController
 * @package WebDevEtc\BlogEtc\Controllers
 */
class BlogEtcSpecificPagesAdminController extends Controller
{
    /**
     * BlogEtcCategoryAdminController constructor.
     */
    public function __construct()
    {
        $this->middleware(UserCanManageBlogPosts::class);
    }

    /**
     * Show list of categories
     *
     * @return mixed
     */
    public function index()
    {

        $categories = BlogEtcSpecificPages::orderBy("category_name")->paginate(25);
        return view("blog.blogetc_admin.SpecificPages.index")->withCategories($categories);
    }

    /**
     * Show the form for creating new category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create_category()
    {

        return view("blog.blogetc_admin.SpecificPages.add_category");

    }

    /**
     * Store a new category
     *
     * @param StoreBlogEtcCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store_category(StoreBlogEtcCategoryRequest $request)
    {
        $new_category = new BlogEtcSpecificPages($request->all());
        $new_category->save();

        Helpers::flash_message("Saved new category");

        event(new SpecificPageAdded($new_category));
        return redirect(route('blogetc.admin.SpecificPages.index'));
    }

    /**
     * Show the edit form for category
     * @param $categoryId
     * @return mixed
     */
    public function edit_category($categoryId)
    {
        $category = BlogEtcSpecificPages::findOrFail($categoryId);
        return view("blog.blogetc_admin.SpecificPages.edit_category")->withCategory($category);
    }

    /**
     * Save submitted changes
     *
     * @param UpdateBlogEtcCategoryRequest $request
     * @param $categoryId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update_category(UpdateBlogEtcCategoryRequest $request, $categoryId)
    {
        /** @var BlogEtcCategory $category */
        $category = BlogEtcSpecificPages::findOrFail($categoryId);
        $category->fill($request->all());
        $category->save();

        Helpers::flash_message("Saved category changes");
        event(new SpecificPageEdited($category));
        return redirect($category->edit_url());
    }

    /**
     * Delete the category
     *
     * @param DeleteBlogEtcCategoryRequest $request
     * @param $categoryId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destroy_category(DeleteBlogEtcCategoryRequest $request, $categoryId)
    {
        $request = $request;
        $category = BlogEtcSpecificPages::findOrFail($categoryId);
        event(new SpecificPageWillBeDeleted($category));
        $category->delete();

        $messages = trans('messages.item_deleted', ['item' => trans('messages.Specific_page')]);
        return back_normal($request, $messages);
    }

}

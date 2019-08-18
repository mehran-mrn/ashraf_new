<?php

namespace App\Http\Controllers\panel;

use App\gallery_category;
use App\Http\Controllers\Controller;
use App\video_gallery;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class Media extends Controller
{
    public function upload_files(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|max:10240',
        ]);

        $fileName = "file" . time() . rand(100000, 999999) . '.' . request()->file->getClientOriginalExtension();
        $request->file->storeAs('files', $fileName);
        return $fileName;
    }


    public function upload_files_category(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file',
            'cat_id' => 'required',
        ]);
        $fileSize = request()->file->getSize();
        $getRealPath = $request->file('file')->getRealPath();
        $year = jdate("Y", time(), '', '', 'en');
        $month = jdate("m", time(), '', '', 'en');
        $day = jdate("d", time(), '', '', 'en');

        if (!file_exists('public/images')) {
            mkdir('public/images', 0644, true);
        }
        if (!file_exists('public/images/gallery')) {
            mkdir('public/images/gallery', 0644, true);
        }
        if (!file_exists('public/images/gallery/' . $request['cat_id'])) {
            mkdir('public/images/gallery/' . $request['cat_id'], 0644, true);
        }
        if (!file_exists('public/images/gallery/' . $request['cat_id'] . "/" . $year)) {
            mkdir('public/images/gallery/' . $request['cat_id'] . "/" . $year, 0644, true);
        }
        if (!file_exists('public/images/gallery/' . $request['cat_id'] . "/" . $year . "/" . $month)) {
            mkdir('public/images/gallery/' . $request['cat_id'] . "/" . $year . "/" . $month, 0644, true);
        }
        if (!file_exists('public/images/gallery/' . $request['cat_id'] . "/" . $year . "/" . $month . "/" . $day)) {
            mkdir('public/images/gallery/' . $request['cat_id'] . "/" . $year . "/" . $month . "/" . $day, 0644, true);
        }

        $destinationPath = 'public/images/gallery/' . $request['cat_id'] . "/" . $year . "/" . $month . "/" . $day;
        $image_name = mt_rand() . '.' . request()->file->getClientOriginalExtension();

        $filename = request()->file->getClientOriginalName();

        request()->file->move($destinationPath, $image_name);
        \App\media::create([
            'name' => $image_name,
            'url' => $destinationPath . "/" . $image_name,
            'path' => $destinationPath,
            'org_name' => request()->file->getClientOriginalName(),
            'mime' => request()->file->getClientMimeType(),
            'module' => "gallery",
            'size' => $fileSize,
            'category_id' => $request['cat_id'],
            'title' => $request['title']
        ]);

        $file = $request['file'];
        $image_resize = Image::make($file->getRealPath());
        $sizes = array('100x700', '600x400', '150x150');
        foreach ($sizes as $size) {
            $sizeEx = explode("x", $size);
            $w = $sizeEx[0];
            $h = $sizeEx[1];
            if (!file_exists('public/images/gallery/' . $request['cat_id'] . "/" . $year . "/" . $month . "/" . $day . "/" . $w . "-" . $h)) {
                mkdir('public/images/gallery/' . $request['cat_id'] . "/" . $year . "/" . $month . "/" . $day . "/" . $w . "-" . $h, 0775, true);
            }
            $filename = time() . $file->getClientOriginalName();
            $destinationPath = '/public/images/gallery/' . $request['cat_id'] . "/" . $year . "/" . $month . "/" . $day . "/" . $w . "-" . $h."/";

//            Image::make($request['file'])->resize($w, $h)->save($destinationPath .  $filename);

            $image_resize->resize($w, $h, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_resize->save($destinationPath .  $filename);
        }


        $messages = trans('messages.item_created', ['item' => trans('messages.image')]);
        return back_normal($request, $messages);
    }


    public function gallery_category_add(Request $request)
    {
        $this->validate($request,
            [
                'title' => 'required|min:3|string'
            ]);
        gallery_category::create(
            [
                'title' => $request['title'],
                'description' => $request['description'],
                'more_description' => $request['more_description']
            ]
        );

        $messages = trans('messages.item_created', ['item' => trans('messages.category')]);
        return back_normal($request, $messages);
    }

    public function add_video(Request $request)
    {
        $this->validate($request,
            [
                'title' => 'required|min:3|string',
                'iframe' => 'required|min:13|string'
            ]);
        video_gallery::create(
            [
                'title' => $request['title'],
                'description' => $request['description'],
                'iframe' => $request['iframe']
            ]
        );

        $messages = trans('messages.item_created', ['item' => trans('messages.video')]);
        return back_normal($request, $messages);
    }

    public function video_remove(Request $request)
    {
        if ($video = video_gallery::findOrFail($request['id'])) {
            $video->delete();
            $video->save();
            $messages = trans('messages.item_deleted', ['item' => trans('messages.video')]);
            return back_normal($request, $messages);
        }
    }


    public function gallery_category_remove(Request $request)
    {
        if ($cat = gallery_category::findOrFail($request['id'])) {
            $cat->delete();
            $cat->save();
            \App\media::where('category_id', $request['id'])->delete();
            $messages = trans('messages.item_deleted', ['item' => trans('messages.category')]);
            return back_normal($request, $messages);
        }
    }

    public function gallery_category_image_remove(Request $request)
    {
        if ($media = \App\media::findOrFail($request['id'])) {
            $media->delete();
            $media->save();
            $messages = trans('messages.item_deleted', ['item' => trans('messages.file')]);
            return back_normal($request, $messages);
        }

    }

    public function gallery_media_info(Request $request)
    {
        return \App\media::findOrFail($request['id']);
    }

    public function gallery_media_edit(Request $request)
    {
        if (\App\media::findOrFail($request['media_id'])) {
            \App\media::where('id', $request['media_id'])
                ->update(
                    [
                        'title' => $request['title']
                    ]);
            $data['messages'] = trans('messages.item_updated', ['item' => trans('messages.file')]);
            $data['status'] = 200;
            return back_normal($request, $data);
        }
    }


}

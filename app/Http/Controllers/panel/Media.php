<?php

namespace App\Http\Controllers\panel;

use App\gallery_category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Image;


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
                'title' => $request['title']
            ]
        );

        $messages = trans('messages.item_created', ['item' => trans('messages.category')]);
        return back_normal($request, $messages);
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


}

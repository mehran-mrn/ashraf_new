<?php

namespace App\Http\Controllers\panel;

use App\category;
use App\gallery_category;
use App\Http\Controllers\Controller;
use App\video_gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;
use Image;

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
            'file' => 'required|image',
            'cat_id' => 'required',
        ]);

        uploadGallery($request['file'], 'gallery', array('category_id' => $request['cat_id'], 'title' => $request['title']));

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

    public function gallery_category_image_default(Request $request)
    {
        $catInfo = gallery_category::find($request['cat_id']);
        if ($catInfo) {
            if ($request['id'] == "one") {
                $catInfo->media_id_one = $request['media_id'];
            } elseif ($request['id'] == "two") {
                $catInfo->media_id_two = $request['media_id'];
            } elseif ($request['id'] == "three") {
                $catInfo->media_id_three = $request['media_id'];
            } else {
                $catInfo->media_id_one = $request['media_id'];
            }
            $catInfo->save();
        }
        return back_normal($request, trans('messages.item_updated', ['item' => trans('messages.category')]));
    }

}

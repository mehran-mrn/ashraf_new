<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Image;


class Media extends Controller
{
    public function upload_files(Request $request){
        $this->validate($request, [
            'file' => 'required|file|max:10240',
        ]);

        $fileName = "file".time().rand(100000,999999).'.'. request()->file->getClientOriginalExtension();
        $request->file->storeAs('files',$fileName);
        return $fileName;
    }



}

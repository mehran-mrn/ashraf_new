<?php

namespace App\Http\Controllers;

use App\uploaded_doc;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

        public function download_doc(Request $request)
    {
        $this->validate($request, [
            'doc_id' => 'required|exists:uploaded_docs,id',
        ]);
        $file = uploaded_doc::find($request['doc_id']);
        $file_exists = file_exists($file['url']);
        if (!$file_exists){
            return back_error($request,[trans('errors.file_not_found')]);
        }

        return response()->download($file['url']);

    }
}

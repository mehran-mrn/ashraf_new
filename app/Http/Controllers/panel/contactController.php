<?php

namespace App\Http\Controllers\panel;

use App\contact;
use App\Http\Controllers\Controller;
use App\video_gallery;
use Illuminate\Http\Request;

class contactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contacts =contact::all();
        return view('panel.setting.contact',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('global.contact');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if (contact::create($request->all())) {
            $messages = __('messages.your_message_successfully_send');
            $status = 200;
        } else {
            $messages = __('messages.your_message_fail_to_send');
            $status = 401;
        }

//        if(captcha_check($request['captcha'])) {
//
//        }else{
//            $messages = __('messages.captcha_code_fail');
//            $status = 404;
//
//        }
        return back_normal($request, ['message' => $messages, 'status' => $status]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $info = contact::findOrFail($id);
        $info->status='read';
        $info->save();
        return view('panel.setting.contact.show',compact('info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if($info = contact::findOrFail($id)){
            $info->delete();
        }
        return redirect();
    }
}

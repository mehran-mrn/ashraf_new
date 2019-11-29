<?php

namespace App\Http\Controllers\panel;

use App\charity_supportForm;
use App\charity_supportForm_filds;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class supportFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sforms = charity_supportForm::get();
        return view('panel.charity.setting.sform_titles',compact('sforms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $sForm_pattern = null;
        return view('panel.charity.setting.module.sForm_add_new_pattern',compact('sForm_pattern'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
        $image = null;
        if ($request->img){
            $image_id = image_saver($request->img,'photos','sform');
            $image = \App\media::find($image_id);
        }
        $form = new charity_supportForm();
        $form->title = $request->title;
        $form->description = $request->description;
        $form->img = $image['url'];
        $form->save();
        $order = 1;
        foreach ($request['new_field_title'] as $key => $new_field_title){
            $form_fild = new charity_supportForm_filds();
            $form_fild->ch_s_form_id =$form->id;
            $form_fild->order =$order;
            $form_fild->title =$new_field_title;
            $form_fild->type =$request['field_type'][$key];
            $form_fild->required =$request['field_requirement'][$key];
            $form_fild->save();
            $order++;
        }
        return back_normal($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

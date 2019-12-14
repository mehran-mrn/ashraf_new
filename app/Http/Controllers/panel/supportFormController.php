<?php

namespace App\Http\Controllers\panel;

use App\charity_sForm_file_fild;
use App\charity_supportForm;
use App\charity_supportForm_filds;
use App\charity_supportForm_file;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

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
        if ($request['new_field_title']){
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
        }
        return back_normal($request);

    }
    public function store_raw(Request $request)
    {
        $this->validate($request, [
            'sform_id' => 'required',
            'title' => 'required',
        ]);
        $pattern = charity_supportForm::find($request['sform_id']);
        if ($pattern->fields){

            $form = new charity_supportForm_file();
            $form->ch_s_form_id = $request['sform_id'];
            $form->title = $request['title'];
            $form->save();
            foreach ($pattern->fields as $field){
                if ($request[$field['id']]){
                $file_field = new charity_sForm_file_fild();
                $file_field->ch_s_form_file_id =$form['id'];
                $file_field->key =$field['title'];
                $file_field->value =$request[$field['id']];
                $file_field->save();
                }
            }
        }
        $message = __('long_msg.sform_submit');
        return back_normal($request,$message);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $sform = charity_supportForm::find($id);
        return view('global.sform.index',compact('sform'));
    }
    public function sform_list()
    {
        $sforms = charity_supportForm_file::orderBy('status')->orderBy('created_at','desc')->paginate(100);
        return view('panel.charity.sform.sform_list',compact('sforms'));
    }
    public function sform_file_view($id)
    {
        $sform = charity_supportForm_file::find($id);
        return view('panel.charity.sform.sform_file',compact('sform'));
    }
    public function sform_file_update(Request $request)
    {
        $file = charity_supportForm_file::find($request['file_id']);
        $file->comment = $request->description;
        $file->status = $request->file_status;
        $file->save();
        return back_normal($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sForm_pattern = charity_supportForm::find($id);
        return view('panel.charity.setting.module.sForm_add_new_pattern',compact('sForm_pattern'));
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
        $this->validate($request, [
            'title' => 'required',
        ]);
        $form = charity_supportForm::find($id);
        $image['url'] = $form['img'];
        if ($request->img){
            $image_id = image_saver($request->img,'photos','sform');
            $image = \App\media::find($image_id);
        }
        $form->title = $request->title;
        $form->description = $request->description;
        $form->img = $image['url'];
        $form->save();
        $order = 1;
        $form->fields()->delete();
        if ($request['new_field_title']){
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
        }
        return back_normal($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        charity_supportForm::where('id',$id)->delete();
        return back_normal($request);
    }
}
function sendsms ($mobile,$body,$farsi=true) {
    include_once('../../include/libs/nusoap.php');
    $wsdl="http://sms1000.ir/webservice/sms.asmx?wsdl";
    $client=new nusoap_client($wsdl, 'wsdl');
    $client->soap_defencoding = 'UTF-8';
    $client->decode_utf8 = true;
    $param=array(
        'uUsername' => 'anbiya',
        'uPassword' => '131571',
        'uNumber' => 1000454646, //شماره اختصاصی
        'uCellphones' => $mobile,
        'uMessage' => $body,
        'uFarsi' => $farsi
    );
    $results = $client->call('doSendSMS', $param);

    /*include ('/home/ashraf/public_html/include/libs/class.sms.php');
    $sms = new sms();
    $sms->SendSMS($mobile, $body);*/
}
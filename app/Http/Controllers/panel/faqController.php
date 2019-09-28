<?php

namespace App\Http\Controllers\panel;

use App\blog_option;
use Barryvdh\TranslationManager\Models\Translation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\TranslationManager\Manager;

class faqController extends Controller
{
    protected $locales;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = blog_option::where('name','faq')->get();
        return view('panel.blog_setting.FAQ',compact('faqs'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $locales = ['fa','en'];
        return view('panel.blog_setting.materials.faq_form',compact('locales'));

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
            'question' => 'required',
            'answer' => 'required',
            'local' => 'required',
        ]);

        $value =[
            'question'=>$request['question'],
            'answer'=>$request['answer'],
        ];
        $option = new blog_option();
        $option->name = 'faq';
        $option->key = $request->local;
        $option->value = json_encode($value,JSON_UNESCAPED_SLASHES);
        $option->json = true;
        $option->save();
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
        $locales = ['fa','en'];
        $faq = blog_option::find($id);
        return view('panel.blog_setting.materials.faq_form',compact('locales','faq'));

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
            'question' => 'required',
            'answer' => 'required',
            'local' => 'required',
        ]);
        $value =[
            'question'=>$request['question'],
            'answer'=>$request['answer'],
        ];
        $faq = blog_option::find($id);
        $faq->value = json_encode($value,JSON_UNESCAPED_SLASHES);
        $faq->key = $request['local'];
        $faq->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        blog_option::where('id',$id)->delete();
        return back_normal($request);
    }
}

<?php

namespace App\Http\Controllers;

use App\bank;
use App\menu;
use Illuminate\Http\Request;

class menuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.blog_setting.menu.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $serialize_data = $request->input('data');
        $datas = json_decode($serialize_data, true);
        $order = 1;
        foreach ($datas as $data){
            menu::where('id',$data['id'])->update(['parent_id'=>0,'order'=>$order]);
            if (!empty($data['children'])){
                $this->sort($data['children'],$data['id']);
            }
            $order++;
        }
        $message = trans('message.arranged');
        return back_normal($request,$message);
    }

    protected function sort($datas,$parent_id){
        $order = 1;
        foreach ($datas as $data){
            menu::where('id',$data['id'])->update(['parent_id'=>$parent_id,'order'=>$order]);
            if (!empty($data['children'])){
                $this->sort($data['children'],$data['id']);
            }
            $order++;
        }
        return true;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($request['preDefined']) and $request['preDefined'] == 1){
            $validatedData = $request->validate([
                'system' => 'required|max:190',
                'local' => 'required',
                'type' => 'required',
            ]);

            foreach ($request['system'] as $key => $system_page){
                $objexts = explode('||',$system_page);
                if (count($objexts) ==2){
                $menu = new menu();
                $menu->system_name = $objexts[1];
                $menu->type = $request['type'];
                $menu->name = $objexts[1];
                $menu->url = $objexts[0];
                $menu->local = $validatedData['local'];
                $menu->save();
                }
            }
        }
        else{
            $validatedData = $request->validate([
                'name' => 'required|max:190',
                'url' => 'required',
                'local' => 'required',
            ]);
            $menu = new menu();
            $menu->type = $request['type'];
            $menu->name = $validatedData['name'];
            $menu->url = $validatedData['url'];
            $menu->local = $validatedData['local'];
            $menu->save();
        }
        return back_normal($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id ,Request $request)
    {
        $type =$request->input('type','top');
        return view('panel.blog_setting.menu.menu',compact('id','type'));

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
        if ($id != $request['pk']){
            return back_error($request,['mismatch']);
        }
        menu::where('id',$id)->update(['name'=>$request['value']]);
        return back_normal($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $menu = menu::find($id);
        menu::where('parent_id',$id)->update(['parent_id'=>$menu['parent_id']]);
        $menu->delete();
        $message = trans('message.deleted');
        return back_normal($request,$message);
    }
}

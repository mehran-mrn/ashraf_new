<?php

namespace App\Http\Controllers\panel;

use App\page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class pagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = page::get();
        return view('panel.pages.index', compact('pages'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.pages.create');

    }

    public function randomGenerator($length = 3, $local = "fa")
    {
        do {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $str_length = strlen($permitted_chars) - 1;
            $random_string = $permitted_chars[rand(10, $str_length)];
            for ($i = 1; $i <= $length - 1; $i++) {
                $random_string .= $permitted_chars[rand(0, $str_length)];
            }
            $exists = page::where('local', $local)->where('slug', $random_string)->exists();
        } while ($exists);
        return $random_string;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:190',
            'local' => 'required',
            'page_type' => 'required|integer',
            'content' => 'required',
            'slug' => 'nullable|regex:/[a-z]{1}[a-z0-9\-]*/i',
        ]);

        $link = false;
        if (!$request['link']) {
            $link = true;
        }

        if (!$request['slug']) {
            $slug = $this->randomGenerator(3, $request['local']);
        } else {
            $slug = $request['slug'];
        }
        page::create([
            'local' => $validatedData['local'],
            'name' => $validatedData['name'],
            'slug' => $slug,
            'content' => $validatedData['content'],
            'index' => $validatedData['page_type'],
            'link' => $link,
        ]);

        return redirect(route('pages.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = page::find($id);
        return view('panel.pages.edit', compact('page'));

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

        $validatedData = $request->validate([
            'name' => 'required|max:190',
            'local' => 'required',
            'page_type' => 'required|integer',
            'content' => 'required',
        ]);

        $link = false;
        if (!$request['link']) {
            $link = true;
        }
        $this_page = page::find($id);
        $this_page->local = $validatedData['local'];
        $this_page->name = $validatedData['name'];
        $this_page->content = $validatedData['content'];
        $this_page->index = $validatedData['page_type'];
        $this_page->link = $link;
        $this_page->save();

        return redirect(route('pages.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = page::find($id);
        $page->delete();
        return redirect(route('pages.index'));
    }
}

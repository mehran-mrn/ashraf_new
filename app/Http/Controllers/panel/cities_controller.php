<?php

namespace App\Http\Controllers\panel;

use App\city;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class cities_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = city::where('lvl', '1')->orderBy('name')->paginate(32);
        return view('panel.setting.cities.cities_list', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $city = null;
        $parent = $request['parent'] or null;
        return view('panel.setting.cities.city_form', compact('city', 'parent'));

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
            'name' => 'required|max:255',
            'parent' => 'nullable',
        ]);
        $lvl =1;
        if (!empty($request['parent'])) {
            $parent = city::with('province')->find($validatedData['parent']);
            $lvl = $parent['lvl'] + 1;
            if ($parent['lvl'] >= 3) {
                $errors[] = 'not available now';
                return back_error($request, $errors);
            }
        }
        city::create([
            'name'=>$validatedData['name'],
            'parent'=>(empty($request['parent'])? 0:$request['parent']) ,
            'lvl'=>$lvl,
        ]);
        return back_normal($request);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = city::with('city', 'all_provinces')->findOrFail($id);

        return view('panel.setting.cities.city_show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = city::findOrFail($id);
        return view('panel.setting.cities.city_form', compact('city'));

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
            'name' => 'required|max:255',
        ]);
        $city = city::find($id);
        $city->name = $validatedData['name'];
        $city->save();
        return back_normal($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $city = city::with('city.city')->find($id);
        foreach ($city['city'] as $lvl1) {
            foreach ($lvl1['city'] as $lvl2) {
                $lvl2->delete();
            }
            $lvl1->delete();
        }
        $city->delete();
        return back_normal($request);

    }
}

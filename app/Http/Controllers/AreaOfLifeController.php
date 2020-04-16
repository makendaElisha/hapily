<?php

namespace App\Http\Controllers;

use App\Entities\AreaOfLife;
use App\Entities\Symptom;
use Illuminate\Http\Request;

class AreaOfLifeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areasOfLife = AreaOfLife::with(["symptoms"])->get();

        return view("areas.index", compact("areasOfLife"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('areas.create');
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
            'title' => 'string|required',
        ]);

        $areaOfLife = AreaOfLife::create([
            "title" => $request->title,
        ]);

        return redirect()->route('area.index')->with('success', 'Area of life created!');    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\AreaOfLife  $areaOfLife
     * @return \Illuminate\Http\Response
     */
    public function show(AreaOfLife $areaOfLife)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entities\AreaOfLife  $areaOfLife
     * @return \Illuminate\Http\Response
     */
    public function edit(AreaOfLife $areaOfLife)
    {
        // $areaOfLife = AreaOfLife::with(['symptoms'])->find($areaOfLife);

        return view('areas.edit', compact('areaOfLife'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\AreaOfLife  $areaOfLife
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AreaOfLife $areaOfLife)
    {
        $this->validate($request, [
            'title' => 'string|required',
        ]);

        $areaOfLife->title = $request->title;

        $areaOfLife->save();

        return redirect()->route('area.index');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\AreaOfLife  $areaOfLife
     * @return \Illuminate\Http\Response
     */
    public function destroy(AreaOfLife $areaOfLife)
    {
        //
    }
}

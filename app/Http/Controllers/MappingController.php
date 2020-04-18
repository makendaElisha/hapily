<?php

namespace App\Http\Controllers;

use App\Entities\Mapping;
use App\Entities\AreaOfLife;
use App\Entities\Symptom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MappingController extends Controller  // Must Be Removed, no longer needed !!!
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all areas of life
        $areaOfLives = AreaOfLife::with(["symptoms"])->get();
        
        return view("mappings.index", compact('areaOfLives'));

    }

    /**
     * Show the form for creating a new resource. c
     *
     * @return \Illuminate\Http\Response
     */
    public function create(AreaOfLife $areaOfLife)
    {
        return view('mappings.create', compact('areaOfLife'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AreaOfLife $areaOfLife)
    {
        //validation
        $this->validate($request, [
            'instant_help' => 'string|required',
            'res_prio' => 'required',
            'fear' => 'required',
            'anger' => 'required',
            'sadness' => 'required',
            'belief' => 'string|required',
            'recom_book_url' => 'string|required',
            'recom_book_image' => 'string|required',
            'recom_book_description' => 'string|required',
            'recom_program' => 'string|required',
        ]);

        //Create Symptom
        $symptom = $areaOfLife->symptoms()->create([
            "text" => $request->symptom,
        ]);

        //Create Mapping of symptom
        $mapping = Mapping::create([
            'area_of_life_id' => $areaOfLife->id,
            'symptom_id' => $symptom->id,
            'name' => $symptom->text,
            'instant_help' => Request('instant_help'),
            'res_prio' => Request('selectResPrio'),
            'fear' => Request('selectFear'),
            'anger' => Request('selectAnger'),
            'sadness' => Request('selectSadness'),
            'belief' => Request('belief'),
            'recom_book_url' => Request('recom_book_url'),
            'recom_book_image' => Request('recom_book_image'),
            'recom_book_description' => Request('recom_book_description'),
            'recom_program' => Request('recom_program'),
        ]);

        return redirect()->route('mapping.show', $areaOfLife->id)->with('success', 'Mapping created!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\Mapping  $mapping
     * @return \Illuminate\Http\Response
     */
    public function show(AreaOfLife $areaOfLife)
    {
        // $areaOfLife = AreaOfLife::with(["symptoms"])->find($areaOfLife->id);
        return view("mappings.show", compact('areaOfLife'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entities\Mapping  $mapping
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Mapping $mapping)
    {
        //validation
        $this->validate($request, [
            'instant_help' => 'string|required',
            'res_prio' => 'required',
            'fear' => 'required',
            'anger' => 'required',
            'sadness' => 'required',
            'belief' => 'string|required',
            'recom_book_url' => 'string|required',
            'recom_book_image' => 'string|required',
            'recom_book_description' => 'string|required',
            'recom_program' => 'string|required',
        ]);

        //update Symptom
        $symptom = $areaOfLife->symptoms()->create([
            "text" => $request->symptom,
        ]);

        //Create Mapping of symptom
        $mapping = Mapping::create([
            'area_of_life_id' => $areaOfLife->id,
            'symptom_id' => $symptom->id,
            'name' => $symptom->text,
            'instant_help' => Request('instant_help'),
            'res_prio' => Request('selectResPrio'),
            'fear' => Request('selectFear'),
            'anger' => Request('selectAnger'),
            'sadness' => Request('selectSadness'),
            'belief' => Request('belief'),
            'recom_book_url' => Request('recom_book_url'),
            'recom_book_image' => Request('recom_book_image'),
            'recom_book_description' => Request('recom_book_description'),
            'recom_program' => Request('recom_program'),
        ]);

        return redirect()->route('mapping.index', $areaOfLife->id)->with('success', 'Mapping created!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Mapping  $mapping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mapping $mapping)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\Mapping  $mapping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mapping $mapping)
    {
        //
    }

    function getIdFromFieldName($fieldName){
        return end(explode('_', $fieldName));     
    }
}

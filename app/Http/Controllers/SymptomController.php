<?php

namespace App\Http\Controllers;

use App\Entities\Symptom;
use App\Entities\AreaOfLife;
use Illuminate\Http\Request;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AreaOfLife $areaOfLife)
    {
        $symptoms = Symptom::where('area_of_life_id', $areaOfLife->id)->get();
        
        return view("symptoms.index", compact('symptoms', 'areaOfLife'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(AreaOfLife $areaOfLife)
    {
        return view('symptoms.create', compact('areaOfLife'));
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
            'name' => 'required|string',
            'instant_help' => 'required|string',
            'res_prio' => 'required',
            'belief' => 'required|string',
            'recom_book_url' => 'required|string',
            'recom_book_image' => 'required|string',
            'recom_book_description' => 'required|string',
            'recom_program_url' => 'required|string',
            'recom_program_image' => 'required|string',
            'recom_program_description' => 'required|string',
        ]);

        //Create Symptom
        $symptom = Symptom::create([
            "name" => Request('name'),
            'area_of_life_id' => $areaOfLife->id,
            'instant_help' => Request('instant_help'),
            'res_prio' => Request('res_prio'),
            'belief' => Request('belief'),
            'recom_book_url' => Request('recom_book_url'),
            'recom_book_image' => Request('recom_book_image'),
            'recom_book_description' => Request('recom_book_description'),
            'recom_program_url' => Request('recom_program_url'),
            'recom_program_image' => Request('recom_program_image'),
            'recom_program_description' => Request('recom_program_description'),
        ]);

        return redirect()->route('symptom.index', $areaOfLife->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function show(Symptom $symptom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entities\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function edit(AreaOfLife $areaOfLife, Symptom $symptom)
    {
        return view('symptoms.edit', compact('areaOfLife', 'symptom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AreaOfLife $areaOfLife, Symptom $symptom)
    {

        //validation
        $this->validate($request, [
            'name' => 'required|string',
            'instant_help' => 'required|string',
            'res_prio' => 'required',
            'belief' => 'required|string',
            'recom_book_url' => 'required|string',
            'recom_book_image' => 'required|string',
            'recom_book_description' => 'required|string',
            'recom_program_url' => 'required|string',
            'recom_program_image' => 'required|string',
            'recom_program_description' => 'required|string',
        ]);

        //Update Symptom
            $symptom->name = Request('name');
            $symptom->instant_help = Request('instant_help');
            $symptom->res_prio = Request('res_prio');
            $symptom->belief = Request('belief');
            $symptom->recom_book_url = Request('recom_book_url');
            $symptom->recom_book_image = Request('recom_book_image');
            $symptom->recom_book_description = Request('recom_book_description');
            $symptom->recom_program_url = Request('recom_program_url');
            $symptom->recom_program_image = Request('recom_program_image');
            $symptom->recom_program_description = Request('recom_program_description');

            $symptom->save();

        return redirect()->route('symptom.index', $areaOfLife->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function destroy(AreaOfLife $areaOfLife, Symptom $symptom)
    {
        $symptom->delete();

        return redirect()->route('symptom.index', $areaOfLife->id);
    }
}

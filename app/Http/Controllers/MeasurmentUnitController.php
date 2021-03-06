<?php

namespace App\Http\Controllers;
use App\Helper\Helper;

use App\Models\MeasurmentUnit;
use Illuminate\Http\Request;

class MeasurmentUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MeasurmentUnit::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return MeasurmentUnit::create([
            'title' => $request['title'],
            'acronym' => $request['acronym'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MeasurmentUnit  $measurmentUnit
     * @return \Illuminate\Http\Response
     */
    public function show(MeasurmentUnit $measurmentUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MeasurmentUnit  $measurmentUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(MeasurmentUnit $measurmentUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MeasurmentUnit  $measurmentUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MeasurmentUnit $measurmentUnit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MeasurmentUnit  $measurmentUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $uom = MeasurmentUnit::findOrFail($id);
        $uom->delete();
        return ['message' => 'item type Deleted'];
    }
}

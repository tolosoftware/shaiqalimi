<?php

namespace App\Http\Controllers;

use App\Models\Fuel_despenser;
use App\Models\Fuel_desp_str;
use Illuminate\Http\Request;

class FuelDespenserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Fuel_despenser::with(['fuel_station'])->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        $despenser = Fuel_despenser::create($request->all());
        foreach ($request->storage_id as $key => $storage) {
            Fuel_desp_str::create(['storage_id' => $storage['id'], 'despencer_id'=> $despenser->id]);
        }
        return $despenser;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fuel_despenser  $fuel_despenser
     * @return \Illuminate\Http\Response
     */
    public function show(Fuel_despenser $fuel_despenser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fuel_despenser  $fuel_despenser
     * @return \Illuminate\Http\Response
     */
    public function edit(Fuel_despenser $fuel_despenser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fuel_despenser  $fuel_despenser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fuel_despenser $fuel_despenser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fuel_despenser  $fuel_despenser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \Schema::disableForeignKeyConstraints();
        $fuel_despenser = Fuel_despenser::findOrFail($id);
        return $fuel_despenser->delete();

    }
}

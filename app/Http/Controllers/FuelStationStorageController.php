<?php

namespace App\Http\Controllers;

use App\Models\Fuel_station_storage;
use Illuminate\Http\Request;

class FuelStationStorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\fuel_station_storage  $fuel_station_storage
     * @return \Illuminate\Http\Response
     */
    public function show(fuel_station_storage $fuel_station_storage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\fuel_station_storage  $fuel_station_storage
     * @return \Illuminate\Http\Response
     */
    public function edit(fuel_station_storage $fuel_station_storage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\fuel_station_storage  $fuel_station_storage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, fuel_station_storage $fuel_station_storage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\fuel_station_storage  $fuel_station_storage
     * @return \Illuminate\Http\Response
     */
    public function destroy(fuel_station_storage $fuel_station_storage)
    {
        //
    }
    public function bystation(Request $request, fuel_station_storage $fuel_station_storage)
    {
        return Fuel_station_storage::where('station_id', $request->id)->get();
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Fuel_station;
use Illuminate\Http\Request;

class FuelStationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Fuel_station::all();
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
        return Fuel_station::create([
          
            'name' => $request['name'],
            'manager' => $request['manager'],
            'phone' => $request['phone'],
            'address' => $request['address'],
           
           
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fuel_station  $fuel_station
     * @return \Illuminate\Http\Response
     */
    public function show(Fuel_station $fuel_station)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fuel_station  $fuel_station
     * @return \Illuminate\Http\Response
     */
    public function edit(Fuel_station $fuel_station)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fuel_station  $fuel_station
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fuel_station $fuel_station)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fuel_station  $fuel_station
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Fuel_station::findOrFail($id);
        $user->delete();
        return ['message' => 'station Deleted'];
    }
}

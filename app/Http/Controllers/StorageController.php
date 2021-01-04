<?php

namespace App\Http\Controllers;

use App\Models\Storage;
use App\Models\Fuel_station;
use App\Models\Inventory;
use App\Models\Fuel_despenser;
use App\Models\Fuel_station_storage;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Storage::all();
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

        return Storage::create([

            'code' => $request['code'],
            'name' => $request['name'],
            'manager' => $request['manager'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'capacity' => $request['capacity'],
            'oum_id' => $request['oum_id']['id'],

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Storage::where('id', $id)->get();
    }
    public function totalstorage()
    {
        $storages = Storage::all();
        $stCount = $storages->count();
        return $stCount;
        // return $storages;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function edit(storage $storage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, storage $storage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $storage = Storage::findOrFail($id);
        $storage->delete();
        return response()->json(['status' => 'success']);
    }
    public function allTypeSource()
    {

        // Get Storages, Fuil station with decpincer and mini storages and inventory for source component.
        $source1 = Storage::selectRaw("id, name")->get();
        $source2 = Fuel_station::with(['fuel_despencers', 'fuel_station_storages'])->selectRaw("id, name")->get();
        $source3 = Inventory::selectRaw("id, name")->get();
            
        $all = ['str' => $source1, 'fuel' => $source2, 'inv' => $source3];
    
        return $all;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Storage;
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
        
        return Storage::create([
          
            'code' => $request['code'],
            'name' => $request['name'],
            'manager' => $request['manager'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'capacity' => $request['capacity'],
            'oum_id' =>$request['oum_id']['id'],
           
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function show(storage $storage)
    {
        //
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
    public function destroy(storage $storage)
    {
        //
    }
}

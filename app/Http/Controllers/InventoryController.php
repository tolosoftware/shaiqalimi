<?php

namespace App\Http\Controllers;
use App\Helper\Helper;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inventory::all();
    }
    public function first()
    {
        return Inventory::first();
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
        $this->validate($request, [
            'name' => 'required|min:2',
            'address' => 'required|min:3',
            'manager' => 'required|min:2',
            'phone' => 'required',
            'description' => 'required|min:5',
        ]);

        Inventory::create([
            'name' => $request['name'],
            'address' => $request['address'],
            'manager' => $request['manager'],
            'phone' => $request['phone'],
            'description' => $request['description']
        ]);
        return response()->json(['status' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Inventory::where('id', $id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'address' => 'required|min:2',
            'manager' => 'required:2',
            'phone' => 'required',
            'description' => 'required|min:2'
        ]);
        $inventory = Inventory::findOrFail($id);
        $inventory->update($request->all());
        return response()->json(['status' => $inventory]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();
        return response()->json(['status' => 'success']);
    }

    public function getRow(Request $request)
    {
    }
}

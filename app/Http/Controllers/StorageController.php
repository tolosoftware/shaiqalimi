<?php

namespace App\Http\Controllers;

use App\Helper\Helper;

use App\Models\Storage;
use App\Models\Fuel_station;
use App\Models\Inventory;
use App\Models\Fuel_despenser;
use App\Models\StockRecord;
use App\Models\Fuel_station_storage;
use App\Models\Item;
use App\Models\Transfer;
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

        $storage = Storage::create([

            'code' => $request['code'],
            'name' => $request['name'],
            'manager' => $request['manager'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'capacity' => $request['capacity'],
            'oum_id' => $request['oum_id']['id'],

        ]);
        if ($storage) {
            return 1;
        } else {
            return 0;
        }
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
    public function allItemsOfSource(Request $request)
    {
        if ($inc = StockRecord::where('source', $request->type)->where('source_id', $request->id)->get()) {
            $items = [];
            foreach ($inc as $key => &$obj) {
                $items[] = [
                    'id' => $obj->item_id,
                    'value' => $obj->increment_equiv
                ];
            }
            // $return = array();

            // foreach($items as $val) {
            //     $return[$val['id']] = (isset($return[$val['id']])) ? $return[$val['id']] + $val['value'] : $val['value']; 
            // }
            // return $return;
            return $items;
            // $items = [
            //     [

            //     'id' => 1,
            //     'value' => 100,
            // ],
            // [

            //     'id' => 3,
            //     'value' => 2100,
            // ],
            // ];

        } else {

            return response(['status' => 'Not Found'], 404);
        }
    }
    public function alltotals()
    {

        $all = [];
        $storages = Storage::all();
        $fuelstaions = Fuel_station::all();
        $items = Item::all();
        $inventories = Inventory::all();
        $transfers = Transfer::all();

        $fuelstaionsCount = $fuelstaions->count();
        $fuelCount = $storages->count();
        $itemsCount = $items->count();
        $inventoriesCount = $inventories->count();
        $transfersCount = $transfers->count();

        $all['fuelstations'] = $fuelstaionsCount;
        $all['items'] = $itemsCount;
        $all['inventories'] = $inventoriesCount;
        $all['transfers'] = $transfersCount;
        $all['storages'] = $fuelCount;

        return $all;
    }
}

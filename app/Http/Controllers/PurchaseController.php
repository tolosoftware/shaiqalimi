<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\StockRecord;
use App\Models\FinancialRecord;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Purchase::all();
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
        DB::beginTransaction();
        try {

        Purchase::create([
            'serial_no' => $request['serial_no'],
            'vendor_id' => $request['vendor_id'],
            'date_time' =>$request['datetime'],
            'user_id' =>$request['user_id'],
            'description' =>$request['description'],
        ]);
        $purchase =  Purchase::latest()->first();
        foreach($request->item as $valueItem ){
          StockRecord::create([
            'type'=> "purchase",
            'type_id'=> $purchase->id,
            'source' => $request['godam']['name'],
            'source_id'=> $request['godam']['id'],
            'item_id' => $valueItem['item_id']['id'],
            'increment'=> $valueItem['ammount'],
            'decrement'=>0,
            'uom_id' => $valueItem['item_id']['measurment_unites_min']['id'],
            'increment_equiv'=>$valueItem['equivalent'],
            'decrement_equiv'=> 0,
            'uom_equiv_id'=> $valueItem['item_id']['measurment_unites_sub']['id'],
            'density'=> $valueItem['density'],
            'operation_id' => $valueItem['operation_id']['id'], 
            'remark' => $request['description'],
          ]);

            // Create opening FR for the created Projet
            $data = [
                'type' => 'purchase', // here the type of financial record is project
                'type_id' => $purchase->id, //Project Id will be used here as type id
                'account_id' => $request['account_id'],
                'description' => $request['description'],
                'currency_id' => $request['currency'],
                'credit' => 0,
                'debit' => $valueItem['total_price'],
                'ex_rate_id' => $request['currency'],
                'status' => 'Exp'
                ];
                FinancialRecord::create($data);

        }

        

        DB::commit();
        return 1;
    } catch (Exception $e) {
        DB::rollback();
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}

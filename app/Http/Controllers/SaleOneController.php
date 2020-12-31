<?php

namespace App\Http\Controllers;

use App\Models\SaleOne;
use App\Models\Sale;
use App\Models\ProItem;
use App\Models\AccountType;
use App\Models\Account;
use App\Models\ExchangeRate;
use App\Models\FinancialRecord;
use App\Models\Currency;
use App\Models\Project;
use App\Models\Notification;
use App\Models\StockRecord;
use Illuminate\Http\Request;
use Carbon\Carbon as Carbon;

class SaleOneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return SaleOne::with('storage')->get();
        return Sale::with(['saleS1.storage'])->has('saleS1.storage')->with('source')->has('source')->get();
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
            'title' => 'required|min:2',
            'formula' => 'required|min:2',
            'serial_no' => 'required',
            'storage_id' => 'required',
            'destination' => 'required',
            'transport_cost' => 'required',
            'service_cost' => 'required',
            'tax' => 'required',
            'deposit' => 'required',
            'total' => 'required',
            'steps' => 'required',
            'description' => 'required',
            'type' => 'required',
            'source_id' => 'required',
            'source_type' => 'required',
            'user_id' => 'required',
            'currency_id' => 'required',
            'datatime' => 'required',
            'item' => 'required',
        ]);

        $project = $request->source_id;

        $storage = $request->storage_id;
        foreach (['source_id', 'storage_id'] as $key) {
            $request[$key] = $request[$key]['id'];
        }
        // return $request;
        $newSale = Sale::create($request->all());
        $request['sales_id'] = $newSale->id;
        $newSaleOne = SaleOne::create($request->all());
        
        $typeId = AccountType::latest()->first()->id;
        $accData = [
            'user_id' => $request->user_id,
            'type_id' => $typeId,
            'name' => 'اکانت ساخته شده برای فروشات',
            'ref_code' => 'فروشات - ' . $newSale->id,
            'status' => 1,
            'description' => 'اکانت ساخته شده برای فروشات',
            'system' => 0,
        ];
        $newAcc = Account::create($accData);
        if ($newAcc) {

            // Create opening FR for the created Projet
            $FRData = [
                'type' => 'sale', // here the type of financial record is project
                'type_id' => $newSale->id, //Project Id will be used here as type id
                'account_id' => $newAcc->id,
                'description' => 'عملیه مالی ثبت شده برای فروشات - ' . $newSale->id,
                'currency_id' => Currency::latest()->first()->id,
                'credit' => $request->total,
                'debit' => 0,
                'ex_rate_id' => ExchangeRate::latest()->first()->id,
                'status' => 'opn'
            ];
            $newFR = FinancialRecord::create($FRData);

        }
        if($newAcc) {
            $stocks = [];
            foreach($request->item as $valueItem ){
                $stocks[] = StockRecord::create([
                  'type'=> "sale",
                  'type_id'=> $newSale->id,
                  'source' => $storage['name'],
                  'source_id'=> $storage['id'],
                  'item_id' => $valueItem['item_id']['id'],
                  'increment'=> $valueItem['ammount'],
                  'decrement'=> 0,
                  'uom_id' => $valueItem['item_id']['measurment_unites_min']['id'],
                  'increment_equiv'=>$valueItem['equivalent'],
                  'decrement_equiv'=> 0,
                  'uom_equiv_id'=> $valueItem['item_id']['measurment_unites_sub']['id'],
                  'density'=> $valueItem['density'],
                  'operation_id' => $valueItem['operation_id']['id'], 
                  'remark' => $request['description'],
                ]);
            }
        }

        // Create the Notification
        if($newFR) {
            $client_name = $project['pro_data']['client']['name'];
            $item_name = $storage['name'];
            $nofication = [
                'title' => 'فروشات جدید',
                'text' => 'یک فروش جدید از ' . $item_name . ' برای ' . $client_name . ' در سیستم ثبت گردید.',
                'type' => 'normal',
                'gen_date' => Carbon::now(),
                'exp_date' => Carbon::now()->endOfDay(),
                'action' => 'view',
                'url' => 'sales?list',
                'user_id' => $request->user_id,
            ];
            $newNotif = Notification::create($nofication);

        }
        return [$newSale, $newSaleOne, $newAcc, $newFR, $newNotif, $stocks];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SaleOne  $saleOne
     * @return \Illuminate\Http\Response
     */
    public function show(SaleOne $saleOne)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SaleOne  $saleOne
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleOne $saleOne)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SaleOne  $saleOne
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleOne $saleOne)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SaleOne  $saleOne
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleOne $saleOne)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\SaleFour;
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
use App\Models\SerialNumber;
use Illuminate\Http\Request;
use Carbon\Carbon as Carbon;

class SaleFourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return SaleFour::with('storage')->get();
        return Sale::with(['saleS4.storage'])->has('saleS4.storage')->with('source')->has('source')->get();
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
        $serial_no = getSerialNo('sale4', 'sale');
        $this->validate($request, [
            'serial_no' => 'required',
            'service_cost' => 'required',
            'additional_cost' => 'required',
            'total' => 'required',
            'description' => 'required',
            'item' => 'required',
        ]);

        $source = $request->source_id;

        // $project = $request->project_id;
        foreach (['source_id'] as $key) {
            $request[$key] = $request[$key]['id'];
        }
        $request['serial_no'] = $serial_no->value;
        $newSale = Sale::create($request->all());

        $request['sales_id'] = $newSale->id;
        $newSaleFour = SaleFour::create($request->all());
        
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
                  'source' => $source['name'],
                  'source_id'=> $source['id'],
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
            $client_name = $request['client_name'];
            $item_name = $source['name'];
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
        return [$newSale, $newSaleFour, $newAcc, $newFR, $newNotif, $stocks];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SaleFour  $saleOne
     * @return \Illuminate\Http\Response
     */
    public function show(SaleFour $saleOne)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SaleFour  $saleOne
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleFour $saleOne)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SaleFour  $saleOne
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleFour $saleOne)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SaleFour  $saleOne
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleFour $saleOne)
    {
        //
    }
}
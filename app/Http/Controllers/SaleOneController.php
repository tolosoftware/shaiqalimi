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
        $sales = [];
        $sales1= Sale::with(['saleS1.project', 'source'])->get();
        $sales2= Sale::with(['saleS2.storage', 'source'])->get();

        // //both arrays will be merged including duplicates
        // $result = array_merge( $sales1, $sales2 );
        // //duplicate objects will be removed
        // $result = array_map("unserialize", array_unique(array_map("serialize", $result)));
        // //array is sorted on the bases of id
        // sort( $result );

        return [$sales1 , $sales2];
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
        $serial_no = getSerialNo('sale1', 'sale');
        $this->validate($request, [
            // 'title' => 'required|min:2',
            // 'formula' => 'required|min:2',
            // 'serial_no' => 'required',
            'project_id' => 'required',
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
            // 'source_type' => 'required',
            'user_id' => 'required',
            'currency_id' => 'required',
            'datatime' => 'required',
            'item' => 'required',
        ]);

        $project = $request->project_id;
        $storage = $request->source_id;
        $request['serial_no'] = $serial_no->value;
        foreach (['source_id', 'project_id'] as $key) {
            $request[$key] = $request[$key]['id'];
        }
        // return $request;
        $newSale = Sale::create($request->all());
        $request['sales_id'] = $newSale->id;
        // return $request;
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
                  'increment'=> ($valueItem['ammount']) ? $valueItem['ammount'] : $valueItem['equivalent'],
                  'decrement'=> 0,
                  'uom_id' => $valueItem['item_id']['measurment_unites_min']['id'],
                  'increment_equiv'=> $valueItem['equivalent'],
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
    public function allSales()
    {
        // $sales1 = SaleOne::all();
        $sales1 = Sale::join('sales_ones AS s', 'sales.id', '=', 's.sales_id')
            ->selectRaw("s.sales_id, s.serial_no, s.total, s.service_cost, sales.type, sales.source_type, sales.source_id");
            
        $sales2 = Sale::join('sales_twos AS s', 'sales.id', '=', 's.sales_id')
            ->selectRaw("s.sales_id, s.serial_no, s.total, s.service_cost, sales.type, sales.source_type, sales.source_id");
            
        $sales3 = Sale::join('sales_threes AS s', 'sales.id', '=', 's.sales_id')
            ->selectRaw("s.sales_id, s.serial_no, s.total, s.service_cost, sales.type, sales.source_type, sales.source_id");
            
        $sales4 = Sale::join('sales_fours AS s', 'sales.id', '=', 's.sales_id')
            ->selectRaw("s.sales_id, s.serial_no, s.total, s.additional_cost as service_cost, sales.type, sales.source_type, sales.source_id");
            
        $all = $sales1->union($sales2)->union($sales3)->union($sales4)->get();

        return $all;
    }
}

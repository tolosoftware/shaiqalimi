<?php

namespace App\Http\Controllers;

use App\Helper\Helper;

use App\Models\SaleThree;
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

class SaleThreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return SaleThree::with('storage')->get();
        return Sale::with(['saleS3.storage'])->has('saleS3.storage')->with('source')->has('source')->get();
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
        $serial_no = Helper::getSerialNo('sale3', 'sale');
        $this->validate($request, [
            'serial_no' => 'required',
            'project_id' => 'required',
            'driver_name' => 'required',
            'plate_no' => 'required',
            'driver_phone' => 'required',
            'service_cost' => 'required',
            'tax' => 'required',
            'deposit' => 'required',
            'total' => 'required',
            'steps' => 'required',
            'description' => 'required',
            'item' => 'required',
        ]);

        $source = $request->source_id;

        $project = $request->project_id;
        foreach (['source_id', 'project_id'] as $key) {
            $request[$key] = $request[$key]['id'];
        }
        $request['serial_no'] = $serial_no->value;
        $newSale = Sale::create($request->all());

        $request['sales_id'] = $newSale->id;
        $newSaleThree = SaleThree::create($request->all());

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

            $newFR = Helper::createDoubleFR($newSale, $newAcc, $request);
        }
        if ($newAcc) {
            $stocks = [];
            $totalmoney = 0;
            $stocks = Helper::salesCreateStockRecords($request->item, $newSale, $source, $request, $totalmoney, $source['name'], $source['id']);
        }

        // Create the Notification
        if ($newFR) {
            $client_name = $project['pro_data']['client']['name'];
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
        return [$newSale, $newSaleThree, $newAcc, $newFR, $newNotif, $stocks];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SaleThree  $saleOne
     * @return \Illuminate\Http\Response
     */
    public function show(SaleThree $saleOne)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SaleThree  $saleOne
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleThree $saleOne)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SaleThree  $saleOne
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleThree $saleOne)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SaleThree  $saleOne
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $id;
    }
}

<?php

namespace App\Http\Controllers;

use App\Helper\Helper;

use App\Models\SaleTwo;
use App\Models\Sale;
use App\Models\ProItem;
use App\Models\AccountType;
use App\Models\Account;
use App\Models\ExchangeRate;
use App\Models\FinancialRecord;
use App\Models\Currency;
use App\Models\Project;
use App\Models\Client;
use App\Models\Notification;
use App\Models\StockRecord;
use App\Models\SerialNumber;
use Illuminate\Http\Request;
use Carbon\Carbon as Carbon;
use Illuminate\Support\Facades\DB;

class SaleTwoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return SaleTwo::with('storage')->get();
        return Sale::with(['saleS2.storage'])->has('saleS2.storage')->with('source')->has('source')->get();
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
            $serial_no = Helper::getSerialNo('sale2', 'sale');
            $this->validate($request, [
                // 'title' => 'required|min:2',
                // 'formula' => 'required|min:2',
                'serial_no' => 'required',
                // 'storage_id' => 'required',
                'destination' => 'required',
                'transport_cost' => 'required',
                'service_cost' => 'required',
                'tax' => 'required',
                // 'deposit' => 'required',
                'total' => 'required',
                // 'steps' => 'required',
                // 'description' => 'required',
                'type' => 'required',
                'source_id' => 'required',
                'source_type' => 'required',
                'user_id' => 'required',
                'currency_id' => 'required',
                'datatime' => 'required',
                'item' => 'required',
            ]);

            $source = $request->source_id;

            $client = $request->client_id;
            foreach (['source_id', 'client_id'] as $key) {
                $request[$key] = $request[$key]['id'];
            }
            $request['serial_no'] = $serial_no->value;
            $newSale = Sale::create($request->all());

            $request['sales_id'] = $newSale->id;
            $newSaleTwo = SaleTwo::create($request->all());

            // $typeId = AccountType::latest()->first()->id;
            // $accData = [
            //     'user_id' => $request->user_id,
            //     'type_id' => $typeId,
            //     'name' => 'اکانت ساخته شده برای فروشات',
            //     'ref_code' => 'فروشات - ' . $newSale->id,
            //     'status' => 1,
            //     'description' => 'اکانت ساخته شده برای فروشات',
            //     'system' => 0,
            // ];
            $newAcc = Account::find(Client::find($client['id'])->account_id);

            if ($newAcc) {

                $newFR = Helper::createDoubleFR('sale', $newSale, $newAcc, $request);
            }
            if ($newAcc) {
                $stocks = [];
                $totalmoney = 0;
                $stocks = Helper::salesCreateStockRecords('sale', $request->item, $newSale, $source, $request, $totalmoney, $request['source_type'], $source['id']);
            }

            // Create the Notification
            if ($newFR) {
                $client_name = $client['name'];
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
            DB::commit();
            return [$newSale, $newSaleTwo, $newAcc, $newFR, $newNotif, $stocks];
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SaleTwo  $saleOne
     * @return \Illuminate\Http\Response
     */
    public function show(SaleTwo $saleOne)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SaleTwo  $saleOne
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleTwo $saleOne)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SaleTwo  $saleOne
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleTwo $saleOne)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SaleTwo  $saleOne
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $id;
    }
}

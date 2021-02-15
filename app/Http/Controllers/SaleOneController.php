<?php

namespace App\Http\Controllers;

use App\Helper\Helper;

use App\Models\SaleOne;
use App\Models\Sale;
use App\Models\Account;
use App\Models\ProItem;
use App\Models\SerialNumber;
use App\Models\AccountType;
use App\Models\ExchangeRate;
use App\Models\FinancialRecord;
use App\Models\Currency;
use App\Models\Project;
use App\Models\Notification;
use App\Models\StockRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $sales1 = Sale::with(['saleS1.project', 'source'])->get();
        $sales2 = Sale::with(['saleS2.storage', 'source'])->get();

        // //both arrays will be merged including duplicates
        // $result = array_merge( $sales1, $sales2 );
        // //duplicate objects will be removed
        // $result = array_map("unserialize", array_unique(array_map("serialize", $result)));
        // //array is sorted on the bases of id
        // sort( $result );

        return [$sales1, $sales2];
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

            $serial_no = Helper::getSerialNo('proj-' . $request->project_id['id'], 'sale');
            $this->validate($request, [
                // 'title' => 'required|min:2',
                // 'formula' => 'required|min:2',
                // 'serial_no' => 'required',
                'project_id' => 'required',
                // 'destination' => 'required',
                'transport_cost' => 'required',
                'service_cost' => 'required',
                'tax' => 'required',
                'deposit' => 'required',
                'total' => 'required',
                // 'steps' => 'required',
                // 'description' => 'required',
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
            $newAcc = Account::where('type_id', config('app.contract_account_type'))->where('ref_code', $project['id'])->first();
            if ($newAcc) {
                $newFR = Helper::createDoubleFR('sale', $newSale, $newAcc, $request);
            }
            if ($newAcc) {
                $stocks = [];
                $totalmoney = 0;
                $stocks = Helper::salesCreateStockRecords('sale', $request->item, $newSale, $storage, $request, $totalmoney, $request['source_type'], $storage['id']);
            }

            // Create the Notification
            if ($newFR) {
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
                if ($newNotif) {
                    Helper::createUserAssign($newNotif->id, "nor");
                }
            }
            DB::commit();
            return [$newSale, $newSaleOne, $newAcc, $newFR, $newNotif, $stocks];
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SaleOne  $saleOne
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = Sale::findOrFail($id);
        if ($sale->type == "s1") {
            $sales1 = Sale::join('sales_ones AS s', 'sales.id', '=', 's.sales_id')
                ->selectRaw("s.sales_id, s.serial_no, s.total, s.service_cost, sales.type, sales.source_type, sales.source_id")->where('s.sales_id', $id)->get();
        } else if ($sale->type == "s2") {
            $sales1 = Sale::join('sales_twos AS s1', 'sales.id', '=', 's1.sales_id')
                ->selectRaw("s1.sales_id, s1.serial_no, s1.total, s1.service_cost, sales.type, sales.source_type, sales.source_id")->where('s1.sales_id', $id)->get();
        } else if ($sale->type == "s3") {
            $sales1 = Sale::join('sales_threes AS s', 'sales.id', '=', 's.sales_id')
                ->selectRaw("s.sales_id, s.serial_no, s.total, s.service_cost, sales.type, sales.source_type, sales.source_id")->where('s.sales_id', $id)->get();
        } else if ($sale->type == "s4") {
            $sales1 = Sale::join('sales_fours AS s', 'sales.id', '=', 's.sales_id')
                ->selectRaw("s.sales_id, s.serial_no, s.total, s.service_cost, sales.type, sales.source_type, sales.source_id")->where('s.sales_id', $id)->get();
        }

        return $sales1;
    }
    public function showSale($id)
    {
        $base = Sale::findOrFail($id);
        if ($base->type == "s1") {
            $sale = Sale::with(['saleS1.project.pro_data', 'source_id'])->where('id', $id)->first();
            $sale['sales'] = $sale->saleS1;
        } else if ($base->type == "s2") {
            $sale = Sale::with(['saleS2.client', 'source_id'])->where('id', $id)->first();
            $sale['sales'] = $sale->saleS2;
        } else if ($base->type == "s3") {
            $sale = Sale::with(['saleS3.project.pro_data', 'source_id'])->where('id', $id)->first();
            $sale['sales'] = $sale->saleS3;
        } else if ($base->type == "s4") {
            $sale = Sale::with(['saleS4.client', 'source_id'])->where('id', $id)->first();
            $sale['sales'] = $sale->saleS4;
        }
        // return $sale->saleS1;
        $sale->currency_id = Currency::find($sale->currency_id);
        $sale->bank_account = Account::find($sale->bank_account);
        $sale['stock_records'] = StockRecord::where('type', 'sale')->where('type_id', $sale->id)
            ->with([
                'item_id',
                'item_id.uom_equiv_id',
                'item_id.uom_id',
                'uom_equiv_id',
                'uom_id',
                'operation_id',
                'measur_unit',
                'source_id'
            ])->get();


        return $sale;
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
    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $helperDele = Helper::deleteSales($sale->id, $sale->type);
        if ($helperDele) {
            $sale->delete();
        }
    }
    public function allSales()
    {
        $sales1 = Sale::join('sales_ones AS s', 'sales.id', '=', 's.sales_id')
            ->selectRaw("s.sales_id, s.serial_no, s.total, s.service_cost, sales.type, sales.source_type, sales.source_id");

        $sales2 = Sale::join('sales_twos AS s', 'sales.id', '=', 's.sales_id')
            ->selectRaw("s.sales_id, s.serial_no, s.total, s.service_cost, sales.type, sales.source_type, sales.source_id");

        $sales3 = Sale::join('sales_threes AS s', 'sales.id', '=', 's.sales_id')
            ->selectRaw("s.sales_id, s.serial_no, s.total, s.service_cost, sales.type, sales.source_type, sales.source_id");

        $sales4 = Sale::join('sales_fours AS s', 'sales.id', '=', 's.sales_id')
            ->selectRaw("s.sales_id, s.serial_no, s.total, s.additional_cost as service_cost, sales.type, sales.source_type, sales.source_id");

        $sales_data = $sales1->union($sales2)->union($sales3)->union($sales4)->orderBy('sales_id', 'desc')->get();
        foreach ($sales_data as $key => $sale) {
            $base = Sale::findOrFail($sale['sales_id']);
            if ($base->type == "s1") {
                $sale = Sale::with(['saleS1.project.pro_data', 'source_id'])->where('id', $sale['sales_id'])->first();
                $sales_data[$key]['sales'] = $sale->saleS1;
            } else if ($base->type == "s3") {
                $sale = Sale::with(['saleS3.project.pro_data', 'source_id'])->where('id', $sale['sales_id'])->first();
                $sales_data[$key]['sales'] = $sale->saleS3;
            }
        }
        return $sales_data;
    }
}

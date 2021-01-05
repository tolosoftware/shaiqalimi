<?php

use App\Models;
use App\Models\SerialNumber;
use App\Models\User;
use App\Models\UserNotification;
use App\Models\ExchangeRate;
use App\Models\SaleOne;
use App\Models\Sale;
use App\Models\Account;
use App\Models\FinancialRecord;
use App\Models\SaleFour;
use App\Models\SaleThree;
use App\Models\SaleTwo;
use App\Models\StockRecord;
// use Auth;

function getSerialNo($type, $prefix)
{
    $serial_no = SerialNumber::where('type', $type)->first();
    if (!empty($serial_no)) {
        $serial_no->update(['value' => $serial_no->value + 1]);
    } else {
        $serial_no = SerialNumber::create(['type' => $type, 'prefix' => $prefix, 'value' => 101]);
    }
    return $serial_no;
}
function createUserAssign($notif_id, $status = "nor")
{
    $user = User::all();
    foreach ($user as $value) {
        if ($value->user_type == 1 || $value->user_type == 2) {
            UserNotification::create([
                'user_id' => $value->id,
                'notification_id' => $notif_id,
                'status' => $status,
                'pin' => 0,
                'done' => 0,
            ]);
        }
    }
}
function createDoubleFR($newSale, $newAcc, $request)
{
    // Create opening FR for the created Sales
    $FRData = [
        'type' => 'sale', // here the type of financial record is project
        'type_id' => $newSale->id, //Project Id will be used here as type id
        'account_id' => $newAcc->id,
        'description' => 'عملیه مالی ثبت شده برای فروشات - ' . $newSale->id,
        'currency_id' => $request->currency_id,
        'credit' => 0,
        'debit' => $request->total,
        'ex_rate_id' => ExchangeRate::latest()->first()->id,
        'status' => 'OPN'
    ];
    $newFR = FinancialRecord::create($FRData);


    // Create opening FR for the created Sales
    $FRDataCashInHand = [
        'type' => 'sale', // here the type of financial record is project
        'type_id' => $newSale->id, //Project Id will be used here as type id
        'account_id' => ($request->currency_id == 1) ? config('app.cash_in_hand_afn') : config('app.cash_in_hand_usd'),
        'description' => 'عملیه مالی ثبت شده برای فروشات - ' . $newSale->id,
        'currency_id' => $request->currency_id,
        'credit' => $request->total,
        'debit' => 0,
        'ex_rate_id' => ExchangeRate::latest()->first()->id,
        'status' => 'INC'
    ];
    $newFRCashInHand = FinancialRecord::create($FRDataCashInHand);
    return [$newFR, $newFRCashInHand];
}

function salesCreateStockRecords($items, $newSale, $storage, $request, &$totalmoney, $source, $source_id)
{
    foreach ($items as $valueItem) {
        $stocks[] = StockRecord::create([
            'type' => "sale",
            'type_id' => $newSale->id,
            'source' => $source,
            'source_id' => $source_id,
            'item_id' => $valueItem['item_id']['id'],
            'increment' => ($valueItem['ammount']) ? $valueItem['ammount'] : $valueItem['equivalent'],
            'decrement' => 0,
            'uom_id' => $valueItem['item_id']['measurment_unites_min']['id'],
            'increment_equiv' => ($valueItem['equivalent']) ? $valueItem['equivalent'] : 0,
            'decrement_equiv' => 0,
            'uom_equiv_id' => $valueItem['item_id']['measurment_unites_sub']['id'],
            'density' => $valueItem['density'],
            'operation_id' => $valueItem['operation_id']['id'],
            'unit_price' => $valueItem['unit_price'],
            'total_price' => $valueItem['total_price'],
            'remark' => $request['description'],
        ]);
        $totalmoney = $totalmoney + $valueItem['total_price'];
    }
    return $stocks;
}
function deleteSales($id, $type)
{
    if ($type == "s1") {
        $saleitem = SaleOne::where('sales_id', $id);
    } else if ($type == "s2") {
        $saleitem = SaleTwo::where('sales_id', $id);
    } else if ($type == "s3") {
        $saleitem = SaleThree::where('sales_id', $id);
    } else if ($type == "s4") {
        $saleitem = SaleFour::where('sales_id', $id);
    }
    if ($saleitem) {
        $saleitem->delete();
    }
    // $serialNumber = SerialNumber::where('type','sale1');
    // $Account = Account::where(['ref_code' => 'فروشات - ' + $sale->id]);
    $FinancialRecord = FinancialRecord::where(['type' => 'sale', 'type_id' => $id]);
    $StockRecord = StockRecord::where(['type' => 'sale', 'type_id' => $id]);

    if ($StockRecord) {
        $StockRecord->delete();
    }
    if ($FinancialRecord) {
        $FinancialRecord->delete();
    }
    return 1;
    // if ($Account) {
    //     $Account->delete();
    // }

}

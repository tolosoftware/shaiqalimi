<?php

namespace App\Helper;

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
use App\Models\Transfer;

class Helper
{
    public static function getInformation()
    {
        return "getInformation()";
    }
    public static function getSerialNo($type, $prefix)
    {
        $serial_no = SerialNumber::where('type', $type)->first();
        if (!empty($serial_no)) {
            $serial_no->update(['value' => $serial_no->value + 1]);
        } else {
            $serial_no = SerialNumber::create(['type' => $type, 'prefix' => $prefix, 'value' => 101]);
        }
        return $serial_no;
    }
    public static function createUserAssign($notif_id, $status = "nor")
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
    public static function createDoubleFR($type, $newEntity, $newAcc, $request)
    {
        // Create opening FR for the created Sales
        $FRData = [
            'type' => $type, // here the type of financial record is project
            'type_id' => $newEntity->id, //Project Id will be used here as type id
            'account_id' => $newAcc->id,
            'description' => 'عملیه مالی ثبت شده برای - ' . $newEntity->id,
            'currency_id' => $request->currency_id,
            'credit' => 0,
            'debit' => $request->total,
            'ex_rate_id' => ExchangeRate::latest()->first()->id,
            'status' => 'OPN'
        ];
        $newFR = FinancialRecord::create($FRData);

        // Create opening FR for the created Sales
        if($request->bank_account) {
            $bA_id = $request->bank_account;
        }else{
            $bA_id = ($request->currency_id == 1) ? config('app.cash_in_hand_afn') : config('app.cash_in_hand_usd');            
        }
        $FRdestinationAccount = [
            'type' => $type, // here the type of financial record is project
            'type_id' => $newEntity->id, //Project Id will be used here as type id
            'account_id' => $bA_id,
            'description' => 'عملیه مالی ثبت شده برای - ' . $newEntity->id,
            'currency_id' => $request->currency_id,
            'credit' => $request->total,
            'debit' => 0,
            'ex_rate_id' => ExchangeRate::latest()->first()->id,
            'status' => 'INC'
        ];
        $newFRCashInHand = FinancialRecord::create($FRdestinationAccount);
        return [$newFR, $newFRCashInHand];
    }

    public static function salesCreateStockRecords($type, $items, $newSale, $storage, $request, &$totalmoney, $source, $source_id)
    {
        foreach ($items as $valueItem) {

            $stocks[] = StockRecord::create([
                'type' => $type,
                'type_id' => $newSale->id,
                'source' => $source,
                'source_id' => $source_id,
                'item_id' => $valueItem['item_id']['id'],
                'decrement' => (array_key_exists("ammount", $valueItem) && $valueItem['ammount']) ? $valueItem['ammount'] : $valueItem['increment'],
                'increment' => 0,
                'uom_id' => (array_key_exists('measurment_unites_min', $valueItem['item_id'])) ? $valueItem['item_id']['measurment_unites_min']['id'] : $valueItem['item_id']['uom_id']['id'],
                'decrement_equiv' => (array_key_exists("equivalent", $valueItem) && $valueItem['equivalent']) ? $valueItem['equivalent'] : $valueItem['increment_equiv'],
                'increment_equiv' => 0,
                'uom_equiv_id' => array_key_exists('measurment_unites_sub', $valueItem['item_id']) ? $valueItem['item_id']['measurment_unites_sub']['id'] : (gettype($valueItem['item_id']['uom_equiv_id']) != 'object' ? $valueItem['item_id']['uom_equiv_id'] : $valueItem['item_id']['uom_equiv_id']['id']),
                'density' => array_key_exists('density', $valueItem) ? $valueItem['density'] : null,
                'operation_id' => $valueItem['operation_id']['id'],
                'unit_price' => (array_key_exists("unit_price", $valueItem) && $valueItem['unit_price'] != null) ? $valueItem['unit_price'] : 0,
                'total_price' => (array_key_exists("total_price", $valueItem) && $valueItem['total_price'] != null) ? $valueItem['total_price'] : 0,
                'remark' => $request['description'],
            ]);
            $totalmoney = $totalmoney + $valueItem['total_price'];
        }
        return $stocks;
    }
    public static function incrementCreateStockRecords($type, $items, $newSale, $storage, $request, &$totalmoney, $source, $source_id)
    {
        foreach ($items as $valueItem) {

            $stocks[] = StockRecord::create([
                'type' => $type,
                'type_id' => $newSale->id,
                'source' => $source,
                'source_id' => $source_id,
                'item_id' => $valueItem['item_id']['id'],
                'increment' => (array_key_exists("ammount", $valueItem) && $valueItem['ammount']) ? $valueItem['ammount'] : $valueItem['increment'],
                'decrement' => 0,
                'uom_id' => (array_key_exists('measurment_unites_min', $valueItem['item_id'])) ? $valueItem['item_id']['measurment_unites_min']['id'] : $valueItem['item_id']['uom_id']['id'],
                'increment_equiv' => (array_key_exists("equivalent", $valueItem) && $valueItem['equivalent']) ? $valueItem['equivalent'] : $valueItem['increment_equiv'],
                'deccrement_equiv' => 0,
                'uom_equiv_id' => array_key_exists('measurment_unites_sub', $valueItem['item_id']) ? $valueItem['item_id']['measurment_unites_sub']['id'] : (gettype($valueItem['item_id']['uom_equiv_id']) != 'object' ? $valueItem['item_id']['uom_equiv_id'] : $valueItem['item_id']['uom_equiv_id']['id']),
                'density' => array_key_exists('density', $valueItem) ? $valueItem['density'] : null,
                'operation_id' => $valueItem['operation_id']['id'],
                'unit_price' => (array_key_exists("unit_price", $valueItem) && $valueItem['unit_price'] != null) ? $valueItem['unit_price'] : 0,
                'total_price' => (array_key_exists("total_price", $valueItem) && $valueItem['total_price'] != null) ? $valueItem['total_price'] : 0,
                'remark' => $request['description'],
            ]);
            $totalmoney = $totalmoney + $valueItem['total_price'];
        }
        return $stocks;
    }
    public static function  deleteSales($id, $type)
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
    }
    public static function deleteTransfer($id)
    {
        $trans = Transfer::findOrFail($id);
        $TRSStockRecord = StockRecord::where(['type' => 'TRS', 'type_id' => $id]);
        $TRSFinancialRecord = FinancialRecord::where(['type' => 'TRS', 'type_id' => $id]);

        $trans->delete();
        $TRSFinancialRecord->delete();
        $TRSStockRecord->delete();
    }

    public static function calc_account_balance($financial_records, &$total_af, &$total_usd){
        foreach ($financial_records as $key => $fr) {
            $rates['afn'] = ExchangeRate::where('counter', $fr['exchange_rate']['counter'])->where('currency_id', config('app.currency_afn'))->first();
            $rates['usd'] = ExchangeRate::where('counter', $fr['exchange_rate']['counter'])->where('currency_id', config('app.currency_usd'))->first();
            $rates['afn'] = ($rates['afn']['system_rate'] != 0) ? $rates['afn']['system_rate'] : 1;
            $rates['usd'] = ($rates['usd']['system_rate'] != 0) ? $rates['usd']['system_rate'] : 1;
            $total_af += ($fr['credit'] / $rates['afn'])-($fr['debit'] / $rates['afn']);
            $total_usd += ($fr['credit'] * $rates['usd'])-($fr['debit'] * $rates['usd']);
        }
    }
    public static function purchase_financial_records_balance($financial_records, &$total_af, &$total_usd){
        foreach ($financial_records as $key => $fr) {
            $rates['afn'] = ExchangeRate::where('counter', $fr['exchange_rate']['counter'])->where('currency_id', config('app.currency_afn'))->first();
            $rates['usd'] = ExchangeRate::where('counter', $fr['exchange_rate']['counter'])->where('currency_id', config('app.currency_usd'))->first();
            $rates['afn'] = ($rates['afn']['system_rate'] != 0) ? $rates['afn']['system_rate'] : 1;
            $rates['usd'] = ($rates['usd']['system_rate'] != 0) ? $rates['usd']['system_rate'] : 1;
            $total_af += $fr['debit'] / $rates['afn'];
            $total_usd += $fr['debit'] * $rates['usd'];
        }
    }
    public static function sales_financial_records_balance($financial_records, &$total_af, &$total_usd){
        foreach ($financial_records as $key => $fr) {
            $rates['afn'] = ExchangeRate::where('counter', $fr['exchange_rate']['counter'])->where('currency_id', config('app.currency_afn'))->first();
            $rates['usd'] = ExchangeRate::where('counter', $fr['exchange_rate']['counter'])->where('currency_id', config('app.currency_usd'))->first();
            $rates['afn'] = ($rates['afn']['system_rate'] != 0) ? $rates['afn']['system_rate'] : 1;
            $rates['usd'] = ($rates['usd']['system_rate'] != 0) ? $rates['usd']['system_rate'] : 1;
            $total_af += $fr['credit'] / $rates['afn'];
            $total_usd += $fr['credit'] * $rates['usd'];
        }
    }
}

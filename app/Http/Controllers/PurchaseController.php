<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\Purchase;
use App\Models\StockRecord;
use App\Models\FinancialRecord;
use App\Models\SerialNumber;
use App\Models\Notification;
use App\Models\UserNotification;
use App\Models\User;
use App\Models\Storage;
use App\Models\Item;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon as Carbon;

class PurchaseController extends Controller
{

    public function serial()
    {
        $serial_number = SerialNumber::where('type', 'pur')->latest()->first();
        if ($serial_number) {
            return $serial_number->value + 1;
        } else {
            return 101;
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return config('app.cash_in_hand');
        return Purchase::with('user', 'vendor')->get();
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

            $serial_number = SerialNumber::where('type', 'pur')->latest()->first();
            if ($serial_number) {
                if ($serial_number->value > $request['serial_no']) {
                    $request['serial_no'] = $serial_number->value + 1;
                    $serial_number->value =  $request['serial_no'];
                    $serial_number->save();
                } else {
                    $serial_number->value =  $request['serial_no'];
                    $serial_number->save();
                }
            } else {
                SerialNumber::create([
                    'type' => 'pur',
                    'prefix' => 'pur',
                    'value' => $request['serial_no'],
                ]);
            }

            Purchase::create([
                'serial_no' => $request['serial_no'],
                'vendor_id' => $request['vendor_id'],
                'date_time' => $request['date_time'],
                'user_id' => $request['user_id'],
                'description' => $request['description'],
                'currency_id' => $request['currency_id'],
            ]);
            $purchase =  Purchase::latest()->first();
            $totalmony = 0;
            foreach ($request->item as $valueItem) {
                StockRecord::create([
                    'type' => "purchase",
                    'type_id' => $purchase->id,
                    'source' => $request->source,
                    'source_id' => $request['source_id']['id'],
                    'item_id' => $valueItem['item_id']['id'],
                    'increment' => $valueItem['increment'],
                    'decrement' => 0,
                    'uom_id' => $valueItem['item_id']['measurment_unites_min']['id'],
                    'increment_equiv' => $valueItem['increment_equiv'],
                    'decrement_equiv' => 0,
                    'uom_equiv_id' => $valueItem['item_id']['measurment_unites_sub']['id'],
                    'density' => $valueItem['density'],
                    'operation_id' => $valueItem['operation_id']['id'],
                    'unit_price' => $valueItem['unit_price'],
                    'total_price' => $valueItem['total_price'],
                    'remark' => $request['description'],
                ]);

                $totalmony = $totalmony + $valueItem['total_price'];
            }

            // Create opening FR for the created Projet
            $data = [
                'type' => 'purchase',
                'type_id' => $purchase->id,
                'account_id' => $request['account_id'],
                'description' => $request['description'],
                'currency_id' => $request['currency_id'],
                'credit' => $totalmony,
                'debit' => 0,
                'ex_rate_id' => $request['currency_id'],
                'status' => 'INC'

            ];
            FinancialRecord::create($data);

            $account_id = 1;
            if ($request['currency_id'] == 2) {
                $account_id = config('app.cash_in_hand_usd');
            } else {
                $account_id = config('app.cash_in_hand_afn');
            }
            $datacasinhand = [
                'type' => 'purchase',
                'type_id' => $purchase->id,
                'account_id' => $account_id,
                'description' => $request['description'],
                'currency_id' => $request['currency_id'],
                'credit' => 0,
                'debit' => $totalmony,
                'ex_rate_id' => $request['currency_id'],
                'status' => 'EXP'

            ];
            FinancialRecord::create($datacasinhand);

            //change needed

            //create nofifications

            $nofication = [
                'title' => 'خریداری جدید',
                'text' => 'یک خریداری جدید از ' . $request['vendor_name'] . ' به منبع ' . $request['source_id']['name'] . ' در سیستم ثبت گردید.',
                'type' => 'success',
                'gen_date' => Carbon::now(),
                'exp_date' => Carbon::now()->endOfDay(),
                'action' => 'view',
                'url' => '/procurment',
                'user_id' => $request['user_id'],
            ];
            $newNotif = Notification::create($nofication);
            $notification = Notification::latest()->first();
            $user = User::all();
            foreach ($user as $value) {
                if ($value->user_type == 1 || $value->user_type == 2) {
                    UserNotification::create([
                        'user_id' => $value->id,
                        'notification_id' => $notification->id,
                        'status' => 'nor',
                        'pin' => 0,
                        'done' => 0,
                    ]);
                }
            }


            DB::commit();
            return ['msg' => 'purchase successfully inserted'];
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
    public function show($id)
    {
        return Purchase::with([
            'vendor', 'user',
            'stock.item_id',
            'stock.uom_equiv_id',
            'stock.uom_id',
            'stock.operation_id',
        ])->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return Purchase::findOrFail($id)->with('vendor_id');
        return $purchase =  Purchase::with(['vendor_id', 'item.item_id.type', 'item.operation_id', 'item.source_id'])->latest()->find($id);
        //  $source = Storage::where('id',$purchase->item[0]->source_id)->first();
        // // return $purchase::push('source_id', $source);
        // $merged = $purchase->merge($source);
        // return $merged;
        // $items->put('products', $product);

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
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $purchase = Purchase::findOrFail($id);
            $purchase->delete();

            $stockrecord = StockRecord::all();
            foreach ($stockrecord as $val) {
                if ($val->type == "purchase" && $val->type_id == $purchase->id) {
                    $record = StockRecord::findOrFail($val->id);
                    $record->delete();
                }
            }

            $finanrecord = FinancialRecord::where('type_id', $id)->get()->first();
            if ($finanrecord) {
                $finanrecord->delete();
            }

            DB::commit();
            return 1;
        } catch (Exception $e) {
            DB::rollback();
        }
    }
    public function changeStep($id, $stepNo)
    {
        // return response(['id'=>$id,'stid'=>$stepNo]);
        $purchase = Purchase::findOrFail($id);
        $purchase->step = $stepNo;
        $purchase->save();
    }
}

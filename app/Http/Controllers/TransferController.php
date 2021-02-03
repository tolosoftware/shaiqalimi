<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as Carbon;

use App\Models\Transfer;
use App\Models\Account;
use App\Models\Notification;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Transfer::latest()->get();
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
            $serial_no = Helper::getSerialNo('transfer', 'transfer');
            $request['serial_no'] = $serial_no->value;

            // Default AFN currency ID.
            $request['currency_id'] = 1;
            $request['ammount'] = $request->total;
            $source = $request->source_id;

            $t = Transfer::create($request->all());
            $account = Account::find(config('app.base_transfer_account'));

            Helper::createDoubleFR('TRS', $t, $account, $request);

            $totalmoney = 0;
            $stocks = Helper::salesCreateStockRecords('TRS', $request->item, $t, $source, $request, $totalmoney, $source['name'], $source['id']);
            $stocks = Helper::incrementCreateStockRecords('TRS', $request->item, $t, $request['destination_id'], $request, $totalmoney, $request['destination_id']['name'], $request['destination_id']['id']);

            $target = $request->destination;
            $source = $source['name'];
            $nofication = [
                'title' => 'انتقال جدید',
                'text' => 'یک انتقال جدید از ' . $source . ' به ' . $target . ' در سیستم ثبت گردید.',
                'type' => 'normal',
                'gen_date' => Carbon::now(),
                'exp_date' => Carbon::now()->endOfDay(),
                'action' => 'view',
                'url' => 'sales?list',
                'user_id' => $request->user_id,
            ];
            $newNotif = Notification::create($nofication);
            DB::commit();
            return $t;
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Transfer::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function edit(transfer $transfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transfer $transfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Helper::deleteTransfer($id);
            DB::commit();
            return $id;
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function changeStep($id, $stepNo)
    {
        // return response(['id'=>$id,'stid'=>$stepNo]);
        $transfer = Transfer::findOrFail($id);
        $transfer->step = $stepNo;
        $transfer->save();
    }
}

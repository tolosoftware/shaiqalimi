<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\SerialNumber;
use App\Models\FinancialRecord;
use App\Models\ExchangeRate;
use Exception;
use Illuminate\Support\Facades\DB;

class ExpensesController extends Controller
{

    public function serial()
    {
        $serial_number = SerialNumber::where('type', 'EXP')->latest()->first();
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
        return Expense::with('user', 'currency')->get();
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

            $serial_number = SerialNumber::where('type', 'EXP')->latest()->first();
            $exchange_id = ExchangeRate::where('currency_id', $request['currency_id'])->latest()->first()->id;
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
                    'type' => 'EXP',
                    'prefix' => 'EXP',
                    'value' => $request['serial_no'],
                ]);
            }

            $expenses = Expense::create([
                'serial_no' => $request['serial_no'],
                'currency_id' => $request['currency_id'],
                'datetime' => $request['datetime'],
                'title' => $request['title'],
                'ammount' => $request['ammount'],
                'description' => $request['description'],
                'user_id' => $request['user_id'],
            ]);

            // Create opening FR for the created Projet
            $data = [
                'type' => 'EXP',
                'type_id' => $expenses->id,
                'account_id' => $request['credit_account']['id'],
                'description' => $request['credit_desc'],
                'currency_id' => $request['currency_id'],
                'credit' => $request['ammount'],
                'debit' => 0,
                'ex_rate_id' => $exchange_id,
                'status' => 'INC'

            ];
            $financialRecord1 = FinancialRecord::create($data);

            // Create opening FR for the created Projet
            $data = [
                'type' => 'EXP',
                'type_id' => $expenses->id,
                'account_id' => $request['debit_account']['id'],
                'description' => $request['debit_desc'],
                'currency_id' => $request['currency_id'],
                'credit' => 0,
                'debit' => $request['ammount'],
                'ex_rate_id' => $exchange_id,
                'status' => 'EXP'

            ];
            $financialRecord2 = FinancialRecord::create($data);


            DB::commit();
            return ['msg' => 'expenses successfully inserted', [$financialRecord1, $financialRecord2]];
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense = Expense::with('user', 'currency')->find($id);
        $creditFinancialRecord = FinancialRecord::with('account')->where('type_id', $id)->where('credit', '>', 0)->where('type', 'EXP')->first();
        $expense['credit_account'] = $creditFinancialRecord->account;
        $debitFinancialRecord = FinancialRecord::with('account')->where('type_id', $id)->where('debit', '>', 0)->where('type', 'EXP')->first();
        $expense['debit_account'] = $debitFinancialRecord->account;
        return $expense;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            $expense = Expense::find($id);
            $expense->update($request->all());

            $creditFinancialRecord = FinancialRecord::where('type_id', $id)->where('credit', '>', 0)->where('type', 'EXP')->first();
            $data = [
                'account_id' => $request['credit_account']['id'],
                'description' => $request['credit_desc'],
                'currency_id' => $request['currency_id'],
                'credit' => $request['ammount'],
                'ex_rate_id' => $request['currency_id'],
            ];
            $creditFinancialRecord->update($data);

            $debitFinancialRecord = FinancialRecord::where('type_id', $id)->where('debit', '>', 0)->where('type', 'EXP')->first();
            $data = [
                'account_id' => $request['debit_account']['id'],
                'description' => $request['debit_desc'],
                'currency_id' => $request['currency_id'],
                'debit' => $request['ammount'],
                'ex_rate_id' => $request['currency_id'],
            ];
            $debitFinancialRecord->update($data);

            DB::commit();
            return ['msg' => 'expenses successfully inserted', $expense];
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $expenses = Expense::findOrFail($id);
            $expenses->delete();
            $finanrecord = FinancialRecord::where('type_id', $id)->where('type', 'EXP')->get();
            if ($finanrecord) {
                foreach ($finanrecord as $val) {
                    $record = FinancialRecord::findOrFail($val->id);
                    $record->delete();
                }
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
        $expenses = Expense::findOrFail($id);
        $expenses->step = $stepNo;
        $expenses->save();
    }
}

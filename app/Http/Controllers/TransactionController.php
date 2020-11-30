<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{

    public function getserialnumber()
    {
        $serial_number = Transaction::latest('id')->first()->deal_serial_number;
        if ($serial_number) {
            $serial_number = $serial_number + 1;
        } else {
            $serial_number = 100;
        }
        return response()->json($serial_number);

        // return $serial_number;
    }
    // get all transactions
    public function getAllTransaction()
    {
        $Transaction = Transaction::all();
    }

    public function savetransaction(Request $request)
    {
        // return redirect("/home");

        $transactionData = $this->validate($request, [
            'deal_serial_number' => 'required',
            'deal_currency' => 'required',
            'deal_amount' => 'required',
            'deal_status' => 'required',
            'deal_date' => 'required',
            'deal_title' => 'required|string|min:3',
            'deal_debit_account' => 'required',
            'deal_dbt_acnt_desc' => 'required',
            'deal_credit_account' => 'required',
            'deal_crdt_acnt_desc' => 'required',
            'deal_description' => 'required'
        ]);
        Transaction::create($transactionData);
        return response()->json(['status' => 'success']);
    }

    public function getTransactionData()
    {
        $transaction = Transaction::all();
        return response()->json($transaction);
    }
}

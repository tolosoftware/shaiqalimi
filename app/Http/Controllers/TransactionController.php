<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{

    // get all transactions
    public function getAllTransaction()
    {
        $Transaction = Transaction::all();
    }

    public function savetransaction()
    {
        dd("sfsf");
    }
}

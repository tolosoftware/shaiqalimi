<?php

namespace App\Http\Controllers;
use App\Helper\Helper;

use App\Models\Account;
use App\Models\FinancialRecord;
use App\Models\Currency;
use App\Models\ExchangeRate;

use Illuminate\Http\Request;

class AccountController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getaccount(){
        return Account::all();
    }
    
    public function index()
    {
        return Account::with('financial_records')->get();
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
        $this->validate($request, [
            'type_id' => 'required',
            'ref_code' => 'required',
            'name' => 'required',
        ]);
        if(gettype($request->type_id) != 'integer') {
            $request->type_id = $request['type_id']['id'];
        }

        $data = [
            'user_id' => 4,
            'type_id' => $request->type_id,
            'name' => $request->name,
            'ref_code' => $request->ref_code,
            'status' => $request->status,
            'description' => $request->description,
            // 'system' => $request->system,    
        ];
        if($request->debit > 0) {
            $request->credit = null;
        }
        if($new = Account::create($data)){
            $data = [
                'type' => 'account',
                'type_id' => $request->type_id,
                'account_id' => $new->id,
                'description' => 'Dynamically Created From Account.',
                'currency_id' => Currency::latest()->first()->id,
                'credit' => $request->credit,
                'debit' => $request->debit,
                'ex_rate_id' => ExchangeRate::latest()->first()->id,
                'status' => 'opn'    
            ];
            FinancialRecord::create($data);
            return $new;
        }else{
            return $new;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        return Account::with('financial_records')->find($account->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $this->validate($request, [
            'type_id' => 'required',
            'ref_code' => 'required',
            'name' => 'required',
        ]);
        if(gettype($request->type_id) != 'integer') {
            $request->type_id = $request['type_id']['id'];
        }

        $data = [
            'user_id' => 4,
            'type_id' => $request->type_id,
            'name' => $request->name,
            'ref_code' => $request->ref_code,
            'status' => $request->status,
            'description' => $request->description,
            // 'system' => $request->system,    
        ];
        if($new = Account::find($account->id)->update($data)){
            return $new;
        }else{
            return $new;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        // \Schema::disableForeignKeyConstraints();
        FinancialRecord::where('account_id', $account->id)->delete();
        return $account->delete();
    }
}

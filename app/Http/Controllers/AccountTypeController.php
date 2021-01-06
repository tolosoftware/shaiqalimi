<?php

namespace App\Http\Controllers;
use App\Helper\Helper;

use App\Models\AccountType;
use Illuminate\Http\Request;

class AccountTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     

        $accounts =  AccountType::with('accounts.financial_records')->get();
       

        return $accounts;
        // return AccountType::all();
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
        // $this->validate($request, [
        //     'title' => 'required|min:2',
        //     'type_id' => 'required|numeric',
        //     'system' => 'required'
        // ]);
        
         AccountType::create([
           
            'title' => $request['title'],
            'type_id' => $request['type_id']['id'],
            'system' => 0,
        ]);

        return ['msg', 'succefully inserted'];
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccountType  $accountType
     * @return \Illuminate\Http\Response
     */
    public function show(AccountType $accountType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccountType  $accountType
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountType $accountType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccountType  $accountType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:2',
            'type_id' => 'required',
        ]);
        // // return $accountType->update($request->all());
        // if ($accountType->update($request->all())) {
        //     return $accountType;
        // } else {
        //     return 0;
        // }

        $acountType = AccountType::findOrFail($id);
        $request['type_id'] = $request['type_id']['id'];
        $acountType->update($request->all());
        return "ok";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountType  $accountType
     * @return \Illuminate\Http\Response
     */
    public function destroy($accountTypeID)
    {
        $acountType = AccountType::findOrFail($accountTypeID);
       
        return $acountType->delete();
    }
}

<?php

namespace App\Http\Controllers;

use App\models\Currency;
use App\models\ExchangeRate;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Currency::all();
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
            'sign_en' => 'required|unique:currencies|min:2',
            'sign_fa' => 'required|unique:currencies|min:2',
        ]);
        return $request->all();
        if ($new = Currency::create($request->all())->id){
            // $ex = new ExchangeRate::create($request->all());
            return $new;
        }else{
            return 0;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
        $this->validate($request, [
            'sign_en' => 'required|min:2',
            'sign_fa' => 'required|min:2',
        ]);
        if ($currency->update($request->all())) {
            return $currency;
        }else{
            return 0;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        //
    }
}

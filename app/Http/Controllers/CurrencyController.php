<?php

namespace App\Http\Controllers;

use App\models\Currency;
use App\models\User;
use App\models\ExchangeRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Currency::with(['last_rate'])->get();
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
        if($last = ExchangeRate::latest()->first()){
            $lastCounter = $last->counter + 1;
        }else{
            $lastCounter = 1;
        }

        if ($new = Currency::create($request->all())){
            $rate = [
                'currency_id' => $new->id,
                'user_id' => 1,
                'rate' => $request->rate,
                'counter' => $lastCounter
            ];
            if($ex = ExchangeRate::create($rate)){
                return $ex;
            }else{
                Currency::find($new->id)->delete();
                return $ex;
            }
        }else{
            return $new;
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

    public function rates(Request $request)
    {
        $new_counter = 1;
        $rates = [];
        if($request['currencies'][0]) {
            $new_counter = $request['currencies'][0]['last_rate']['counter'] + 1;
        }
        foreach ($request['currencies'] as $key => $value) {
            // return $value['id'];
            $rate = [
                'currency_id' => $value['id'],
                'user_id' => 1,
                'rate' => $value['last_rate']['rate'],
                'counter' => $new_counter
            ];
            // return $rate;
            $rates[] = ExchangeRate::create($rate);
        }
        return $rates;

    }

}

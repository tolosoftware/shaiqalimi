<?php

namespace App\Http\Controllers;

use App\Models\SaleOne;
use App\Models\Sale;
use App\Models\ProItem;
use Illuminate\Http\Request;

class SaleOneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // return 1;
        foreach (['source_id', 'storage_id'] as $key) {
            $request[$key] = $request[$key]['id'];
        }
        // return $request;
        $newSale = Sale::create($request->all());
        $request['sales_id'] = $newSale->id;
        return SaleOne::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SaleOne  $saleOne
     * @return \Illuminate\Http\Response
     */
    public function show(SaleOne $saleOne)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SaleOne  $saleOne
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleOne $saleOne)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SaleOne  $saleOne
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleOne $saleOne)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SaleOne  $saleOne
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleOne $saleOne)
    {
        //
    }
}

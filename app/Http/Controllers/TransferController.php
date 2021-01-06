<?php

namespace App\Http\Controllers;
use App\Helper\Helper;
use Illuminate\Support\Facades\DB;

use App\Models\Transfer;
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
        DB::beginTransaction();
        try {
            $serial_no = Helper::getSerialNo('transfer', 'transfer');
            $request['serial_no'] = $serial_no->value;
            $t = Transfer::create($request->all());
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
    public function show(transfer $transfer)
    {
        //
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
    public function destroy(transfer $transfer)
    {
        //
    }
}

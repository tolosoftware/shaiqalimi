<?php

namespace App\Http\Controllers;

use App\models\Proposal;
use App\models\SerialNumber;
use App\models\ProItem;
use App\models\ProData;
use App\models\Currency;

use Illuminate\Http\Request;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Proposal::with(['pro_datas', 'pro_items'])->latest()->get();
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
            'client_id' => 'required',
            'title' => 'required',
            'reference_no' => 'required',
            'pr_worth' => 'required',
            'deposit' => 'required',
            'tax' => 'required',
            'transit' => 'required',
            'others' => 'required',
            'total_price' => 'required',

        ]);
        // Get The last serial number for the proposal.
        $serial_number = SerialNumber::where('type', 'prop')->latest()->first();
        if($serial_number) {
            $request['serial_no'] = $serial_number->integer + 1;
        }
        else{
            $request['serial_no'] = 101;
        }
        // return $request;
        $serial_number = [
            'type' => 'prop',
            'prefix' => 'pro',
            'integer' => $request['serial_no'],
        ];
        $request['client_id'] = $request->client_id['id'];
        
        if ($resp = Proposal::create($request->all())){
            $proData = [
                'proposal_id' => $resp->id,
                'client_id' => $request->client_id,
                'title' => $request->title,
                'reference_no' => $request->reference_no,
                'pr_worth' => $request->pr_worth,
                'deposit' => $request->deposit,
                'tax' => $request->tax,
                'transit' => $request->transit,
                'others' => $request->others,
                'currency_id' => Currency::latest()->first()->id,
                'total_price' => 1000,
                'total_price' => $request->total_price,
            ];
            ProData::create($proData);
    
            SerialNumber::create($serial_number);

            // Create Pro Items Record for selected Items
            foreach ($request->item as $key => $item) {
                $item = [
                    'unit_id' => $item['item_id']['uom_id'],
                    'uom_equiv_id' => $item['item_id']['uom_equiv_id'],
                    'item_id' => $item['item_id']['id'],
                    'proposal_id' => $resp->id,
                    'operation_id' => $item['operation_id']['id'],
                    'ammount' => $item['ammount'],
                    'unit_price' => $item['unit_price'],
                    'equivalent' => $item['equivalent'],
                    'total_price' => $item['total_price'],
                ];
                // return $item;
                ProItem::create($item);
            }
            return $resp;
        }
        else{
            return $resp;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function show(Proposal $proposal)
    {
        // return $proposal::with(['pro_datas', 'pro_items']);
        return Proposal::with(['pro_datas', 'pro_items'])->latest()->find($proposal->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function edit(Proposal $proposal)
    {
        return $proposal;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proposal $proposal)
    {
        $this->validate($request, [
            'client_id' => 'required',
            'title' => 'required',
            'reference_no' => 'required',
            'pr_worth' => 'required',
            'deposit' => 'required',
            'tax' => 'required',
            'transit' => 'required',
            'others' => 'required',
            'total_price' => 'required',
        ]);
            // return $proposal;
        // $request['client_id'] = $request->client_id['id'];        
        if ($resp = Proposal::find($proposal->id)->update($request->all())){
            $proData = [
                'client_id' => $request->client_id,
                'title' => $request->title,
                'reference_no' => $request->reference_no,
                'pr_worth' => $request->pr_worth,
                'deposit' => $request->deposit,
                'tax' => $request->tax,
                'transit' => $request->transit,
                'others' => $request->others,
                'currency_id' => Currency::latest()->first()->id,
                'total_price' => 1000,
                'total_price' => $request->total_price,
            ];
            ProData::where('proposal_id', $proposal->id)->update($proData);

            // Create Pro Items Record for selected Items
            foreach ($request->item as $key => $item) {
                $item = [
                    'id' => $item['id'],
                    'unit_id' => (gettype($item['item_id']) == 'integer') ? $item['item_id'] : $item['item_id']['uom_id'],
                    'uom_equiv_id' => (gettype($item['item_id']) == 'integer') ? $item['item_id'] : $item['item_id']['uom_equiv_id'],
                    'item_id' => (gettype($item['item_id']) == 'integer') ? $item['item_id'] : $item['item_id']['id'],
                    'proposal_id' => $proposal->id,
                    'operation_id' => (gettype($item['operation_id']) == 'integer') ? $item['operation_id'] : $item['operation_id']['id'],
                    'ammount' => $item['ammount'],
                    'unit_price' => $item['unit_price'],
                    'equivalent' => $item['equivalent'],
                    'total_price' => $item['total_price'],
                ];
                // return $item;
                ProItem::find($item['id'])->update($item);
            }
            return $resp;
        }
        else{
            return $resp;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proposal $proposal)
    {
        ProData::where('proposal_id', $proposal->id)->delete();
        ProItem::where('proposal_id', $proposal->id)->delete();
        return $proposal->delete();
    }
}

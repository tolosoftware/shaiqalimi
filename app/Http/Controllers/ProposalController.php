<?php

namespace App\Http\Controllers;

use App\models\Proposal;
use App\models\SerialNumber;
use App\models\ProItem;

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
        $this->validate($request, [
            // 'serial_no' => 'required|unique',
            'client_id' => 'required',
            // 'type' => 'required',
            // 'price' => 'required:max:20',
            // 'offer_date' => 'required|date',
            // 'close_date' => 'required|date',
            // 'offer_price' => 'required|max:20',
            // 'project_price' => 'required|max:20',
            // 'announce_id' => 'required',
            // 'organization_id' => 'required',
            // 'title' => 'required|min:3',
            // 'issue_address' => 'required|min:3',
            // 'source_address' => 'required|min:3',
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function edit(Proposal $proposal)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proposal $proposal)
    {
        //
    }
}

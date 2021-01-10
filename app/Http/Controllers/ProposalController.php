<?php

namespace App\Http\Controllers;
use App\Helper\Helper;

use App\Models\Proposal;
use App\Models\SerialNumber;
use App\Models\ProItem;
use App\Models\ProData;
use App\Models\Currency;
use Illuminate\Support\Facades\DB;

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

        return Proposal::with(['pro_data.client', 'pro_items.item_id.uom_equiv_id', 'pro_items.item_id.uom_id', 'pro_items.unit_id', 'pro_items.uom_equiv_id', 'pro_items.operation_id'])->whereHas('pro_data', function ($query) {
            return $query->where('proposal_id', '!=', null);
        })->latest()->get();
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

            $this->validate($request, [
                'client_id' => 'required',
                'title' => 'required',
                'reference_no' => 'required',
                'pr_worth' => 'required',
                // 'deposit' => 'required',
                // 'tax' => 'required',
                'transit' => 'required',
                'others' => 'required',
                'total_price' => 'required',

            ]);
            // Get The last serial number for the proposal.
            $company_sign = $request->company_id['sign'];
            $serial_number = Helper::getSerialNo('prop-' . $company_sign, 'pro');
            $request['serial_no'] = $serial_number->value;
            
            $client_id = null;
            if (gettype($request->client_id) != 'integer') {
                $request['client_id'] = $request->client_id['id'];
                // return $request;
            }
            $resp = Proposal::create($request->all());
            $proData = [
                'proposal_id' => $resp->id,
                'client_id' => $request->client_id,
                'company_id' => $request->company_id['id'],
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


            // Create Pro Items Record for selected Items
            foreach ($request->item as $key => $item) {
                if (gettype($item['item_id']) != 'integer') {
                    $item = [
                        'unit_id' => $item['item_id']['uom_id']['id'],
                        'uom_equiv_id' => $item['item_id']['uom_equiv_id']['id'],
                        'item_id' => $item['item_id']['id'],
                        'proposal_id' => $resp->id,
                        'operation_id' => $item['operation_id']['id'],
                        'ammount' => $item['ammount'],
                        'unit_price' => $item['unit_price'],
                        'equivalent' => $item['equivalent'],
                        'total_price' => $item['total_price'],
                    ];

                    ProItem::create($item);
                }
            }
            DB::commit();
            return $resp;
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return $proposal::with(['pro_data', 'pro_items']);
        // return Proposal::with(['pro_data.client_id', 'pro_items'])->latest()->find($id);
        return ProData::join('clients AS c', 'pro_data.client_id', '=', 'c.id')
            ->selectRaw("c.name, pro_data.title")->where('pro_data.proposal_id', $id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proposal  $proposal
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
     * @param  \App\Models\Proposal  $proposal
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
        if (gettype($request->client_id) != 'integer') {
            $request['client_id'] = $request->client_id['id'];
        }
        if ($resp = Proposal::find($proposal->id)->update($request->all())) {
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
        } else {
            return $resp;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proposal $proposal)
    {
        ProData::where('proposal_id', $proposal->id)->delete();
        ProItem::where('proposal_id', $proposal->id)->delete();
        return $proposal->delete();
    }
}

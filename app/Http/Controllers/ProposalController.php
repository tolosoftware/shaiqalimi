<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Helper\Helper;
use App\Models\ProData;
use App\Models\ProItem;
use App\Models\Currency;
use App\Models\Proposal;
use App\Models\Participator;
use App\Models\ProposalStep;
use App\Models\Company;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Proposal::with([
            'pro_data.client',
            'pro_items.item_id.uom_equiv_id',
            'pro_items.item_id.uom_id',
            'pro_items.item_id.type',
            'pro_items.unit_id',
            'pro_items.uom_equiv_id',
            'pro_items.operation_id',
            'pro_data.company_id'
        ])->whereHas('pro_data', function ($query) {
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
                        'density' => $item['density'],
                        'total_price' => $item['total_price'],
                    ];
                    ProItem::create($item);
                }
            }

            $proposal = Proposal::with([
                'pro_data.company_id'
            ])->find($resp->id);
            $com = Company::find($proposal->pro_data->company_id);
            $sn = strval($proposal['serial_no']);
            $co =  ($proposal['pro_data'] && $proposal['pro_data']['company_id']) ? ' - ' . $com['sign'] : '';
            $notif_data = [
                'title' => 'آفر جدید(' . $sn . $co . ')',
                'text' => 'اعلان (' . $proposal['pro_data']['title'] . ') آمادهء طی مراحل است.',
                'type' => 'suc-b',
                'exp_date' => Carbon::now()->endOfDay(),
                'action' => 'btn-modal',
                'url' => '/model/step2',
                'user_id' => auth()->guard('api')->user()->id,
                'status' => null,
                'notif_number' => '2',
                'notif_source' => 'offer',
                'notif_source_id' => $resp->id,
            ];
            $notification = Helper::add_notification($notif_data, '>=', Carbon::now()->startOfDay());
            Helper::user_notification_assign('مدیریت آفرها', $notification, 'nor');
    
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
        // return ProData::join('clients AS c', 'pro_data.client_id', '=', 'c.id')
        //     ->selectRaw("c.name, pro_data.title")->where('pro_data.proposal_id', $id)->get();
        return Proposal::with([
            'pro_data.client',
            'pro_items.item_id.uom_equiv_id',
            'pro_items.item_id.uom_id',
            'pro_items.item_id.type',
            'pro_items.unit_id',
            'pro_items.uom_equiv_id',
            'pro_data.company_id',
            'pro_items.operation_id'
        ])->whereHas('pro_data', function ($query) {
            return $query->where('proposal_id', '!=', null);
        })->find($id);
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

    public function getrecent()
    {
        $propsal = Proposal::latest()->first();
        return $propsal->id;
    }
    public function changeStep(Request $request, $id)
    {
        $proposastep = ProposalStep::where(['proposal_id' => $id])->get();

        if (sizeof($proposastep) == 1) {
            if ($request->step == 2) {
                foreach ($proposastep as $proposal) {
                    $proposal->step = 2;
                    $proposal->save();
                    Helper::offerGenNotifS2($id);
                }
            } else if ($request->step == 3) {
                foreach ($proposastep as $proposal) {
                    $proposal->step = 3;
                    $proposal->res_person = $request->res_person;
                    $proposal->save();
                    Helper::offerGenNotifS3($id);
                }
            } else if ($request->step == 4) {
                foreach ($proposastep as $proposal) {
                    $proposal->step = 4;
                    $proposal->is_recieved_cont = $request->is_recieved_cont;
                    $proposal->save();
                    Helper::offerGenNotifS4($id);
                }
            } else if ($request->step == 5) {
                foreach ($proposastep as $proposal) {
                    $proposal->step = 5;
                    $proposal->is_participated = $request->is_participated;
                    $proposal->save();
                    Helper::offerGenNotifS6($id);
                }
            } else if ($request->step == 6) {
                foreach ($proposastep as $proposal) {
                    $proposal->step = 6;
                    // this is place for inserting participants
                    $proposal->save();
                    Helper::offerGenNotifS7($id);
                }
            } else if ($request->step == 7) {
                foreach ($proposastep as $proposal) {
                    $proposal->prop_recieved_or_allow = $request->prop_recieved_or_allow;
                    $proposal->winner = $request->winner;
                    $proposal->save();
                    Helper::offerGenNotifS8($id);
                    Helper::offerGenNotifS9($id);
                }
            }
            return $proposastep;
        } else if (sizeof($proposastep) == 0) {
            $newProjectSt = ProposalStep::create([
                'step' => 1,
                'proposal_id' => $id,
                'res_person' => $request['res_person'],
                'is_recieved_cont' => $request['is_recieved_cont'],
                'is_participated' => $request['is_participated'],
                'prop_recieved_or_allow' => $request['prop_recieved_or_allow'],
                'winner' => $request['winner']
            ]);
        }
    }

    public function getproposalStep($proposalid)
    {
        $proposaltep = ProposalStep::where(['proposal_id' => $proposalid])->get();
        if (sizeof($proposaltep) >= 1) {
            return $proposaltep;
        } else {
            return response(['status' => 'no']);
        }
        // 
    }
    public function getParticipators($id)
    {
        $participators = Participator::where(['proposal_id' => $id])->get();
        if (sizeof($participators) >= 1) {
            return $participators;
        } else {
            return response(['status' => 'no']);
        }
    }
}

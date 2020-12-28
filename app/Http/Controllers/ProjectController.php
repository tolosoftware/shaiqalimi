<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\SerialNumber;
use App\Models\Currency;
use App\Models\ProData;
use App\Models\ProItem;
use App\Models\Account;
use App\Models\AccountType;
use App\Models\FinancialRecord;
use App\Models\ExchangeRate;


use Illuminate\Http\Request;
use Carbon\Carbon as Carbon;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Project::with(['pro_data',
         'pro_items'])->latest()->get();;
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

        // return $request;
        // return Carbon::parse($request->issue_date);
        $this->validate($request, [
            // 's_number' => 'required|unique',
            // 'issue_date' => 'required|date',
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
        $serial_number = SerialNumber::where('type',
         'pro')->latest()->first();
        if($serial_number) {
            $request['serial_no'] = $serial_number->value + 1;
        }
        else{
            $request['serial_no'] = 101;
        }
        // return $request;
        $serial_number = [
            'type' => 'pro',
            'prefix' => 'pro',
            'value' => $request['serial_no'],
        ];
        if(gettype($request->client_id) != 'integer') {
            $request['client_id'] = $request->client_id['id'];
        }
        if(gettype($request->proposal_id) != 'integer') {
            $request['proposal_id'] = ($request->proposal_id) ? $request->proposal_id['id'] : null;
        }
        SerialNumber::create($serial_number);
        if ($resp = Project::create($request->all())){
            if($request['proposal_id']) {
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
                    // 'proposal_id' => null,
                    'project_id' => $resp->id, 
                ];
                ProData::where('proposal_id', $request['proposal_id'])->update($proData);    
            }else{
                $proData = [
                    'project_id' => $resp->id,
                    'client_id' => $request->client_id,
                    'title' => $request->title,
                    'reference_no' => $request->reference_no,
                    'pr_worth' => $request->pr_worth,
                    'deposit' => $request->deposit,
                    'tax' => $request->tax,
                    'transit' => $request->transit,
                    'others' => $request->others,
                    'currency_id' => Currency::latest()->first()->id,
                    'total_price' => $request->total_price,
                ];
                ProData::create($proData);
            }

            // Create Pro Items Record for selected Items
            foreach ($request->item as $key => $item) {
                if(gettype($item['item_id']) != 'integer') {

                    $item = [
                        'unit_id' => $item['item_id']['uom_id'],
                        'uom_equiv_id' => $item['item_id']['uom_equiv_id'],
                        'item_id' => $item['item_id']['id'],
                        'project_id' => $resp->id,
                        'operation_id' => $item['operation_id']['id'],
                        'ammount' => $item['ammount'],
                        'unit_price' => $item['unit_price'],
                        'equivalent' => $item['equivalent'],
                        'total_price' => $item['total_price'],
                    ];
                    ProItem::create($item);
                }
                // return $item;
            }

            // Create the Account beside the project
            $typeId = AccountType::latest()->first()->id;
            $data = [
                'user_id' => 4,
                'type_id' => $typeId,
                'name' => $request->title,
                'ref_code' => $resp->id,
                'status' => 1,
                'description' => $request->title,
                // 'system' => $request->system,    
            ];
            if($new = Account::create($data)){

                // Create opening FR for the created Projet
                $data = [
                    'type' => 'project', // here the type of financial record is project
                    'type_id' => $resp->id, //Project Id will be used here as type id
                    'account_id' => $new->id,
                    'description' => 'Dynamically Created For Project.' . $resp->id,
                    'currency_id' => Currency::latest()->first()->id,
                    'credit' => $request->pr_worth,
                    'debit' => 0,
                    'ex_rate_id' => ExchangeRate::latest()->first()->id,
                    'status' => 'opn'   
                ];
                FinancialRecord::create($data);
            }
            return response()->json([$resp], 200);
        }
        else{
            return $resp;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return Project::with(['pro_data.client',
         'pro_items.item_id',
         'pro_items.operation_id',
         'pro_items.item_id.uom_equiv_id',
         'pro_items.item_id.uom_id',
         'proposal_id.pro_data.client'])->latest()->find($project->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        if ($project->update($request->all())) {
            return $project;
        }else{
            return 0;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        ProData::where('project_id', $project->id)->delete();
        ProItem::where('project_id', $project->id)->delete();
        return $project->delete();
    }
    
    public function latest(){
        return Project::withTrashed()->max('s_number') + 1;
    }
}

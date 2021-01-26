<?php

namespace App\Http\Controllers;

use App\Helper\Helper;

use App\Models\Project;
use App\Models\SerialNumber;
use App\Models\Currency;
use App\Models\ProData;
use App\Models\ProItem;
use App\Models\Account;
use App\Models\AccountType;
use App\Models\FinancialRecord;
use App\Models\ExchangeRate;
use App\Models\Sale;
use App\Models\StockRecord;
use Illuminate\Support\Facades\DB;


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
        return Project::with([
            'pro_data.client',
            'pro_data.company_id',
            'pro_items.operation_id',
            'pro_items.item_id.type',
            'pro_items.item_id.uom_id',
            'pro_items.unit_id',
            'pro_items.uom_equiv_id',
        ])->latest()->get();;
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
        $default_afn = Currency::where('sign_en', 'AFN')->first()->id;
        DB::beginTransaction();
        try {
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
            if (gettype($request->client_id) != 'integer') {
                $request['client_id'] = $request->client_id['id'];
            }
            if (gettype($request->proposal_id) != 'integer') {
                $request['proposal_id'] = ($request->proposal_id) ? $request->proposal_id['id'] : null;
            }
            // Get The last serial number for the proposal.
            $company_sign = $request->company_id['sign'];
            $serial_no = Helper::getSerialNo('pro-' . $company_sign, 'pro');
            $request['serial_no'] = $serial_no->value;

            $resp = Project::create($request->all());

            if ($request['proposal_id']) {

                $proData = [
                    'client_id' => $request->client_id,
                    'title' => $request->title,
                    'company_id' => $request->company_id['id'],
                    'reference_no' => $request->reference_no,
                    'pr_worth' => $request->pr_worth,
                    'deposit' => $request->deposit,
                    'tax' => $request->tax,
                    'transit' => $request->transit,
                    'others' => $request->others,
                    'currency_id' => $default_afn,
                    'total_price' => 1000,
                    'total_price' => $request->total_price,
                    // 'proposal_id' => null,
                    'project_id' => $resp->id,
                ];
                ProData::where('proposal_id', $request['proposal_id'])->update($proData);
            } else {
                $proData = [
                    'project_id' => $resp->id,
                    'client_id' => $request->client_id,
                    'company_id' => $request->company_id['id'],
                    'title' => $request->title,
                    'reference_no' => $request->reference_no,
                    'pr_worth' => $request->pr_worth,
                    'deposit' => $request->deposit,
                    'tax' => $request->tax,
                    'transit' => $request->transit,
                    'others' => $request->others,
                    'currency_id' => $default_afn,
                    'total_price' => $request->total_price,
                ];
                ProData::create($proData);
            }

            // Create Pro Items Record for selected Items
            foreach ($request->item as $key => $item) {
                if (gettype($item['item_id']) != 'integer') {

                    $item = [
                        'unit_id' => $item['item_id']['uom_id']['id'],
                        'uom_equiv_id' => $item['item_id']['uom_equiv_id']['id'],
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
            // $typeId = AccountType::latest()->first()->id;
            $data = [
                'user_id' => $request->user_id,
                'type_id' => config('app.contract_account_type'),
                'name' => $request->title,
                'ref_code' => $resp->id,
                'status' => 1,
                'description' => $request->title,
                // 'system' => $request->system,    
            ];
            if ($new = Account::create($data)) {
                // Create opening FR for the created Projet
                $data = [
                    'type' => 'project', // here the type of financial record is project
                    'type_id' => $resp->id, //Project Id will be used here as type id
                    'account_id' => $new->id,
                    'description' => 'Dynamically Created For Project.' . $resp->id,
                    'currency_id' => config('app.currency_afn'),
                    'credit' => $request->pr_worth,
                    'debit' => 0,
                    'ex_rate_id' => ExchangeRate::latest()->first()->id,
                    'status' => 'opn'
                ];
                FinancialRecord::create($data);
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
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return Project::with([
            'pro_data.client',
            'pro_data.company_id',
            'pro_items.item_id',
            'pro_items.operation_id',
            'pro_items.item_id.uom_equiv_id',
            'pro_items.item_id.uom_id',
            'proposal_id.pro_data.client'
        ])->latest()->find($project->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return ProData::join('clients AS c', 'pro_data.client_id', '=', 'c.id')
            ->selectRaw("c.name, pro_data.title")->where('pro_data.project_id', $id)->get();
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
        } else {
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

    public function latest()
    {
        return Project::withTrashed()->max('s_number') + 1;
    }
    public function latestProject()
    {
        // return Project::latest()->limit(3)->get();
        return Project::with([
            'pro_data',
            'pro_items'
        ])->latest()->limit(3)->get();
    }
    public function activeProject()
    {
        // return Project::with([
        //     'pro_data',
        //     'pro_items'
        // ])->where('active', 1)->limit(3)->get();
        return Project::with([
            'pro_data',
            'pro_items'
        ])->latest()->limit(3)->get();
    }
    public function projectSales($id)
    {
        $sales1 = Sale::join('sales_ones AS s', 'sales.id', '=', 's.sales_id')
            ->selectRaw("s.sales_id, s.project_id, s.total, s.deposit, s.tax, s.service_cost, s.serial_no")
            ->where('project_id', $id);

        $sales3 = Sale::join('sales_threes AS s', 'sales.id', '=', 's.sales_id')
            ->selectRaw("s.sales_id, s.project_id, s.total, s.deposit, s.tax, s.service_cost, s.serial_no")
            ->where('project_id', $id);
        // $data[] = $sales1->union($sales3)->get();
        $data['deposit'] = $sales1->union($sales3)->sum('deposit');
        $data['total'] = $sales1->union($sales3)->sum('total');
        $data['service_cost'] = $sales1->union($sales3)->sum('service_cost');
        return $data;
    }


    public function projectTypeChart($id)
    {
        $sales1 = Sale::join('sales_ones AS s', 'sales.id', '=', 's.sales_id')
            ->selectRaw("s.sales_id, s.project_id")->where('project_id', $id);

        $sales3 = Sale::join('sales_threes AS s', 'sales.id', '=', 's.sales_id')
            ->selectRaw("s.sales_id, s.project_id")->where('project_id', $id);
        $matched_sales = $sales1->union($sales3)->pluck('sales_id');
        $stocks = StockRecord::with(['measur_unit', 'item'])->where('type', 'sale')->whereIn('type_id', $matched_sales)->get();
        $chart_data = [];
        // return $stocks;
        foreach ($stocks as $key => $value) {
            // $chart_data[$value['item']['name']] = [$value['uom_equiv_id'], $value['increment_equiv']];
            if (isset($chart_data[$value['measur_unit']['title']])) {
                $chart_data[$value['measur_unit']['title']] += $value['increment_equiv'];
            } else {
                $chart_data[$value['measur_unit']['title']] = $value['increment_equiv'];
            }
        }
        return $chart_data;
    }


    public function projectItemChart($id)
    {

        $data = Project::with([
            'pro_items.item_id',
            'pro_items.item_id.uom_equiv_id',
            'pro_items.item_id.uom_id',
        ])->latest()->find($id);
        // return $data;
        $chart_data = [];
        foreach ($data['pro_items'] as $key => $value) {
            if (array_key_exists($value['item']['name'], $chart_data)) {
                $chart_data[$value['item']['name']] += $value['total_price'];
            } else {
                $chart_data[$value['item']['name']] = $value['total_price'];
            }
        }
        return $chart_data;
    }
}

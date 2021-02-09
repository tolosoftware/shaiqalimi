<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;

use App\Helper\Helper;
use App\Models\SaleOne;
use App\Models\SaleTwo;
use App\Models\Purchase;
use App\Models\SaleFour;
use App\Models\SaleThree;
use App\Models\ExchangeRate;
use Illuminate\Http\Request;
use App\Models\FinancialRecord;

class GraphsController extends Controller
{
  public $datas = [];
  public function __construct()
  {
    $this->dates[] = [date("Y-m-d", strtotime('-5 days')), date("Y-m-d", strtotime('-4 days'))];
    $this->dates[] = [date("Y-m-d", strtotime('-4 days')), date("Y-m-d", strtotime('-3 days'))];
    $this->dates[] = [date("Y-m-d", strtotime('-3 days')), date("Y-m-d", strtotime('-2 days'))];
    $this->dates[] = [date("Y-m-d", strtotime('-2 days')), date("Y-m-d", strtotime('-1 days'))];
    $this->dates[] = [date("Y-m-d", strtotime('-1 days')), date("Y-m-d", strtotime('0 days'))];
    // $this->dates[] = [date("Y-m-d", strtotime('0 days')), date("Y-m-d", strtotime('1 days'))];
  }
  public function purchase(Request $request)
  {
    $debitFinancialRecordByDays = [];
    foreach ($this->dates as $key => $date) {
      $fr = FinancialRecord::with('exchange_rate')
        ->where('debit', '>', 0)
        ->where('status', 'EXP')
        ->whereBetween('created_at', $date)
        ->get();
        $total_af = 0;
        Helper::purchase_financial_records_balance($fr, $total_af, $total_usd);
        $debitFinancialRecordByDays['data'][$key] = $total_af;
        $debitFinancialRecordByDays['name'] = 'مصارف';
    }
    
    $debitFinancialRecord = FinancialRecord::with('exchange_rate')
    ->where('debit', '>', 0)
    // ->where('type', 'EXP')
    ->whereBetween('created_at', [date("Y-m-d", strtotime('-5 days')), date("Y-m-d", strtotime('0 days'))])
    ->where('status', 'EXP')
    ->get();
    $total_af = 0;
    $total_usd = 0;
    Helper::purchase_financial_records_balance($debitFinancialRecord, $total_af, $total_usd);
    return ['total_af' => $total_af, 'total_usd' => $total_usd, 'byDays' => ['series' => [$debitFinancialRecordByDays]]];
  }
  public function saleValue(Request $request)
  {
    $creditFinancialRecordByDays = [];
    foreach ($this->dates as $key => $date) {
      $fr = FinancialRecord::with('exchange_rate')
        ->where('credit', '>', 0)
        ->where('status', 'INC')
        ->where('type', 'sale')
        ->whereBetween('created_at', $date)
        ->get();
        $total_af = 0;
        $x []=  $fr;
        Helper::sales_financial_records_balance($fr, $total_af, $total_usd);
        $creditFinancialRecordByDays['data'][$key] = $total_af;
      $creditFinancialRecordByDays['name'] = 'عواید';
    }
    $creditFinancialRecord = FinancialRecord::with('exchange_rate')
    ->where('credit', '>', 0)
    ->where('status', 'INC')
    ->where('type', 'sale')
    ->whereBetween('created_at', [date("Y-m-d", strtotime('-5 days')), date("Y-m-d", strtotime('0 days'))])
    ->get();
    $total_af = 0;
    $total_usd = 0;
    Helper::sales_financial_records_balance($creditFinancialRecord, $total_af, $total_usd);
    return ['total_af' => $total_af, 'total_usd' => $total_usd, 'byDays' => ['series' => [$creditFinancialRecordByDays]]];

  }
  public function saleLastMonthG(Request $request)
  {
    $s1s3sales = Sale::whereIn('type', ['s1', 's3'])->get()->pluck('id');

    $days[] = [date("Y-m-d", strtotime('-5 days')), date("Y-m-d", strtotime('0 days'))];
    $days[] = [date("Y-m-d", strtotime('-10 days')), date("Y-m-d", strtotime('-5 days'))];
    $days[] = [date("Y-m-d", strtotime('-15 days')), date("Y-m-d", strtotime('-10 days'))];
    $days[] = [date("Y-m-d", strtotime('-20 days')), date("Y-m-d", strtotime('-15 days'))];
    $days[] = [date("Y-m-d", strtotime('-25 days')), date("Y-m-d", strtotime('-20 days'))];
    $days[] = [date("Y-m-d", strtotime('-30 days')), date("Y-m-d", strtotime('-25 days'))];
    $debitFinancialRecordBy5Days = [];
    $debitFinancialRecordBy5DaysContract = [];
    foreach ($days as $key => $date) {
      $fr = FinancialRecord::with('exchange_rate')
        ->where('credit', '>', 0)
        ->where('type', 'sale')
        ->whereBetween('created_at', $date)
        ->get();
        $total_af = 0;
        Helper::sales_financial_records_balance($fr, $total_af, $total_usd);
        $debitFinancialRecordBy5Days['data'][$key] = $total_af;
        $debitFinancialRecordBy5Days['name'] = 'فروشات';
    }
    foreach ($days as $key => $date) {
      $fr = FinancialRecord::with('exchange_rate')
        ->where('credit', '>', 0)
        ->where('type', 'sale')
        ->whereIn('type_id', $s1s3sales)
        ->whereBetween('created_at', $date)
        ->get();
        $total_af = 0;
        Helper::sales_financial_records_balance($fr, $total_af, $total_usd);

        $debitFinancialRecordBy5DaysContract['data'][$key] = $total_af;
        $debitFinancialRecordBy5DaysContract['name'] = 'فروشات قراردادها';
    }

    return [$debitFinancialRecordBy5Days, $debitFinancialRecordBy5DaysContract ];

  }
}

<?php

namespace App\Http\Controllers\admin\thai_lottery_manager;

use Carbon\Carbon;
use App\Models\Thaidprice;
use App\Models\Thaidbetslip;
use App\Models\Thaidcomfirm;
use App\Models\Thaidsection;
use Illuminate\Http\Request;
use App\Models\Thaidpricenumber;
use App\Http\Controllers\Controller;

class ThaiLotteryManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bet = Thaidbetslip::with(['section'])->get();
        $finalArray = [];
        $reward = 0;
        foreach ($bet as $item) {
            $ToalAmount = 0;
            $Data = Thaidcomfirm::where('thaibetslip_id', $item['id'])->orderBy('created_at', 'desc')->get();
            foreach ($Data as $datas) {
                $ToalAmount += $datas['price'];
                $reward += $datas['reward'];
            }
            array_push($finalArray, [
                'id' => $item['id'],
                'slip_number' => $item['slip_number'],
                'amount' => $ToalAmount,
                'reward' => $reward,
                'draw_date' => $item['draw_date'],
                'status' => $item->status === null ? Carbon::now()->lte(Carbon::parse($item->section?->opening_date)) : $item->status,
                'bet_date' => $item['bet_date'],
                'is_reject' => $item['is_reject'],
                'data' => $Data->toArray(),
            ]);
        }
        $sectionDate = Thaidsection::all();
        return view('admin.thai_lottery_manager.index', compact(['finalArray', 'sectionDate']));
    }

    public function thaidcomfrim()
    {
        $data = Thaidprice::get();
        $dataCalender = Thaidpricenumber::with('thaidprice')->get();
        $groupedData = collect($dataCalender)->groupBy('thaidsection_id')->toArray();
        $sectionDate = Thaidsection::all();
        return view('admin.thai_lottery_manager.ComfirmThaid', compact('groupedData', 'sectionDate'));
    }

    public function thaidcomfrimlist(Request $request)
    {
        $bet = Thaidbetslip::get();
        $finalArray = [];
        $reward = 0;
        foreach ($bet as $item) {
            $ToalAmount = 0;
            $Data = Thaidcomfirm::where('thaibetslip_id', $item['id'])->orderBy('created_at', 'desc')->get();
            foreach ($Data as $datas) {
                $ToalAmount += $datas['price'];
                $reward += $datas['reward'];
            }
            array_push($finalArray, [
                'id' => $item['id'],
                'slip_number' => $item['slip_number'],
                'amount' => $ToalAmount,
                'reward' => $reward,
                'draw_date' => $item['draw_date'],
                'status' => $item['status'],
                'is_reject' => $item['is_reject'],
                'bet_date' => $item['bet_date'],
                'data' => $Data->toArray(),
            ]);
        }
        Thaidsection::where('id', $request->id)->update([
            'is_comfirm' => 1,
        ]);

        $section = Thaidsection::where('id', $request->id)->where('is_comfirm', 1)->get();
        if ($section) {
            $bet = Thaidbetslip::where('thaidsection_id', $request->id)->get();
            foreach ($bet as $b) {
                $thaidc =  Thaidcomfirm::where('thaibetslip_id', $b['id'])->get();
            }
        }

        $sectionId = $request->id;
        $num = Thaidcomfirm::with(['betslip'])->whereHas('betslip', function ($query) use ($sectionId) {
            $query->where('thaidsection_id', $sectionId)->where('is_reject',0);
        })->get()->toArray();

        foreach ($num as $n) {
            $winningNumberFirstThreeDigits = substr($n['bet_number'], 0, 3);
            $prizefirst = "First 3 Digits";
            $winnerNumone = Thaidpricenumber::with(['thaidprice'])->where('thaidsection_id', $sectionId)->where('winning_number', $winningNumberFirstThreeDigits)
                ->whereHas('thaidprice', function ($query) use ($prizefirst) {
                    $query->where('price', "First 3 Digits");
                })
                ->get();
            foreach($winnerNumone as $win){
                Thaidcomfirm::where('id', $n['id'])->update([
                    'thaidprice' => $win['id']
                ]);
            }

            $winningNumberLastThreeDigits = substr($n['bet_number'], 3, 6);
            $prizefirst = "Last 3 Digits";
            $winnerNumone = Thaidpricenumber::with(['thaidprice'])->where('thaidsection_id', $sectionId)->where('winning_number', $winningNumberLastThreeDigits)
                ->whereHas('thaidprice', function ($query) use ($prizefirst) {
                    $query->where('price', "Last 3 Digits");
                })
                ->get();
            foreach($winnerNumone as $win){
                Thaidcomfirm::where('id', $n['id'])->update([
                    'thaidprice' => $win['id']
                ]);
            }

            $winningNumberLastTwoDigits = substr($n['bet_number'], 4, 6);
            $prizefirst = "Last 2 Digits";
            $winnerNumone = Thaidpricenumber::with(['thaidprice'])->where('thaidsection_id', $sectionId)->where('winning_number', $winningNumberLastTwoDigits)
            ->whereHas('thaidprice', function ($query) use ($prizefirst) {
                $query->where('price', "Last 2 Digits");
            })
            ->get();
            foreach ($winnerNumone as $win) {
                Thaidcomfirm::where('id', $n['id'])->update([
                    'thaidprice' => $win['id']
                ]);
            }

            $winnerNum = Thaidpricenumber::where('thaidsection_id', $sectionId)->where('winning_number', $n['bet_number'])->get();
            foreach($winnerNum as $w){
            Thaidcomfirm::where('id',$n['id'])->update([
                'thaidprice' => $w['id']
             ]);
            }
            
        }
        $sectionDate = Thaidsection::all();
        return view('admin.thai_lottery_manager.index', compact(['finalArray', 'sectionDate']));
    }

    public function thaidoption(Request $request)
    {
        $id = $request->selectedOption;
        if ($id) {
            Thaidbetslip::where('id', $id)->update([
                'status' => 'rejected',
            ]);
            return response()->json(['message' => 'successfully created!']);
        }
    }

    public function searchthaid(Request $request)
    {
        $searchNumber = $request->searchnumber;
        $Data = Thaidcomfirm::where('bet_number', $searchNumber)->get();
        $totalAmount = 0;
        foreach ($Data as $d) {
            $totalAmount += $d['price'];
        }
        $Obj = [
            'total_price' => $totalAmount,
            'data' => $Data,
        ];
        return view('admin.thai_lottery_manager.thai_lottery_number_details.index', compact('Obj'));
    }

    public function searchthaidbet(Request $request)
    {
        $searchDate = $request->searchDate;
        $bet = Thaidbetslip::with(['section'])->whereDate('bet_date', $searchDate)->get();
        $finalArray = [];
        $reward = 0;
        foreach ($bet as $item) {
            $ToalAmount = 0;
            $Data = Thaidcomfirm::where('thaibetslip_id', $item['id'])->orderBy('created_at', 'desc')->get();
            foreach ($Data as $datas) {
                $ToalAmount += $datas['price'];
                $reward += $datas['reward'];
            }
            array_push($finalArray, [
                'id' => $item['id'],
                'slip_number' => $item['slip_number'],
                'amount' => $ToalAmount,
                'reward' => $reward,
                'draw_date' => $item['draw_date'],
                'status' => $item->status === null ? Carbon::now()->lte(Carbon::parse($item->section->opening_date)) : $item->status,
                'bet_date' => $item['bet_date'],
                'is_reject' => $item['is_reject'],
                'data' => $Data->toArray(),
            ]);
        }
        $sectionDate = Thaidsection::all();
        return view('admin.thai_lottery_manager.index', compact(['finalArray', 'sectionDate']));
    }

    public function thaidwinningnumbersection(Request $request)
    {
        $sectionId = $request->selectedOption;
        $data = Thaidprice::get();
        $dataCalender = Thaidpricenumber::with('thaidprice')->where('thaidsection_id', $sectionId)->get();
        $groupedData = collect($dataCalender)->groupBy('thaidsection_id')->toArray();
        logger($groupedData);
        $sectionDate = Thaidsection::all();
        return view('admin.thai_lottery_manager.ComfirmThaid', compact('groupedData', 'sectionDate'));
    }

    public function editthaidwinningnumber(Request $request)
    {
        $dateId = $request->selectedOption;
        $data = Thaidpricenumber::with(['thaidprice'])->where('thaidsection_id', $dateId)->get();
        logger($data);
        return response()->json($data);
    }

    public function reject($id){
        Thaidbetslip::where('id',$id)->update([
            'is_reject' => 1,
        ]);
        $bet = Thaidbetslip::with(['section'])->get();
        $finalArray = [];
        $reward = 0;
        foreach ($bet as $item) {
            $ToalAmount = 0;
            $Data = Thaidcomfirm::where('thaibetslip_id', $item['id'])->orderBy('created_at', 'desc')->get();
            foreach ($Data as $datas) {
                $ToalAmount += $datas['price'];
                $reward += $datas['reward'];
            }
            array_push($finalArray, [
                'id' => $item['id'],
                'slip_number' => $item['slip_number'],
                'amount' => $ToalAmount,
                'reward' => $reward,
                'draw_date' => $item['draw_date'],
                'status' => $item->status === null ? Carbon::now()->lte(Carbon::parse($item->section?->opening_date)) : $item->status,
                'bet_date' => $item['bet_date'],
                'is_reject' => $item['is_reject'],
                'data' => $Data->toArray(),
            ]);
        }
        $sectionDate = Thaidsection::all();
        return view('admin.thai_lottery_manager.index', compact(['finalArray', 'sectionDate']));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

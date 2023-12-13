<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ThaidCalendar;
use App\Models\Thaidprice;
use App\Models\Thaidsection;
use App\Models\ThreedCalendar;
use App\Models\TwodCalendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $data = TwodCalendar::all();
        $threed = ThreedCalendar::all();
        $section = Thaidsection::all();
        $thaid = ThaidCalendar::with(['thaidsection'])->groupBy('thaidsection_id')->get();
        return view('admin.calendar.index',compact('data', 'threed', 'section', 'thaid'));
    }

    public function store(Request $request){
       TwodCalendar::create([
        'date' => $request->date,
        'morning_modern' => $request->morning_modern,
        'morning_internet' => $request->morning_internet,
        'morning_number' => $request->morning_number,
        'evening_modern' => $request->evening_modern,
        'evening_internet' => $request->evening_internet,
        'evening_number' =>$request->evening_number,
       ]);
        $data = TwodCalendar::all();
        $thaid = ThaidCalendar::with(['thaidsection'])->groupBy('thaidsection_id')->get();
       return back()->with('data','thaid');
    }

    public function destory($id){
        TwodCalendar::where('id',$id)->delete();
        $data = TwodCalendar::all();
        $threed = ThreedCalendar::all();
        $section = Thaidsection::all();
        $thaid = ThaidCalendar::with(['thaidsection'])->groupBy('thaidsection_id')->get();
        return view('admin.calendar.index', compact('data','threed', 'thaid', 'section'));
    }

    public function destoryThreed($id){
        ThreedCalendar::where('id',$id)->delete();
        $data = TwodCalendar::all();
        $threed = ThreedCalendar::all();
        $section = Thaidsection::all();
        $thaid = ThaidCalendar::with(['thaidsection'])->groupBy('thaidsection_id')->get();
        return view('admin.calendar.index', compact('data', 'threed', 'thaid', 'section'));
    }

    public function destoryThaid($id){
        ThaidCalendar::where('thaidsection_id',$id)->delete();
        $data = TwodCalendar::all();
        $threed = ThreedCalendar::all();
        $section = Thaidsection::all();
        $thaid = ThaidCalendar::with(['thaidsection'])->groupBy('thaidsection_id')->get();
        return view('admin.calendar.index', compact('data', 'threed', 'thaid', 'section'));
    }

    public function storeThreed(Request $request){
        ThreedCalendar::create([
            'date' => $request->date,
            'roundone' => $request->roundone,
            'roundtwo' => $request->roundtwo,
            'roundthree' => $request->roundthree,
        ]);
        $data = TwodCalendar::all();
        $threed = ThreedCalendar::all();
        $thaid = ThaidCalendar::with(['thaidsection'])->groupBy('thaidsection_id')->get();
        return back()->with('data', 'threed','thaid');
    }

    public function editthaidwinningnumberCalendar(Request $request)
    {
        $dateId = $request->selectedOption;
        $data = ThaidCalendar::with(['thaidprice'])->where('thaidsection_id', $dateId)->get();
        logger($data);
        return response()->json($data);
    }

    public function storeThaid(Request $request){ {
            if ($request->hiddenvalue !== null) {
                $sectionId = $request->sectiondate;
                ThaidCalendar::where('thaidsection_id', $sectionId)->delete();
                Thaidsection::where('id', $sectionId)->update([
                    'is_comfirm' => 0,
                ]);
                $ThaidPrice = Thaidprice::all();
                $first_price = $request->first_price;
                $first_three_price = $request->first_three_price;
                $last_three_price = $request->last_three_price;
                $last_two_price = $request->last_two_price;
                $side_first_price = $request->side_first_price;
                $second_price = $request->second_price;
                $third_price = $request->third_price;
                $fourth_price = $request->fourth_price;
                $fifth_price = $request->fifth_price;

                if (
                    $first_price && $first_three_price && $last_three_price
                    && $last_two_price && $side_first_price && $second_price
                    && $third_price && $fourth_price && $fifth_price
                ) {

                    if ($first_price) {
                        ThaidCalendar::create([
                            'thaidprice_id' => $ThaidPrice[0]->id,
                            'winning_number' => $first_price,
                            'thaidsection_id' => $sectionId,
                        ]);
                    }

                    if ($first_three_price) {
                        $firstthreenumber = explode(',', $first_three_price);
                        foreach ($firstthreenumber as $num) {
                            ThaidCalendar::create([
                                'thaidprice_id' => $ThaidPrice[1]->id,
                                'winning_number' => $num,
                                'thaidsection_id' => $sectionId,
                            ]);
                        }
                    }

                    if ($last_three_price) {
                        $lastthreenumber = explode(',', $last_three_price);
                        foreach ($lastthreenumber as $num) {
                            ThaidCalendar::create([
                                'thaidprice_id' => $ThaidPrice[2]->id,
                                'winning_number' => $num,
                                'thaidsection_id' => $sectionId,
                            ]);
                        }
                    }


                    if ($last_two_price) {
                        $lasttwonumber = explode(',', $last_two_price);
                        foreach ($lasttwonumber as $num) {
                            ThaidCalendar::create([
                                'thaidprice_id' => $ThaidPrice[3]->id,
                                'winning_number' => $num,
                                'thaidsection_id' => $sectionId,
                            ]);
                        }
                    }



                    if ($side_first_price) {
                        $sidefirstnumber = explode(',', $side_first_price);
                        foreach ($sidefirstnumber as $num) {
                            ThaidCalendar::create([
                                'thaidprice_id' => $ThaidPrice[4]->id,
                                'winning_number' => $num,
                                'thaidsection_id' => $sectionId,
                            ]);
                        }
                    }


                    if ($second_price) {
                        $secondpricenumber = explode(',', $second_price);
                        foreach ($secondpricenumber as $num) {
                            ThaidCalendar::create([
                                'thaidprice_id' => $ThaidPrice[5]->id,
                                'winning_number' => $num,
                                'thaidsection_id' => $sectionId,
                            ]);
                        }
                    }


                    if ($third_price) {
                        $thirdpricenumber = explode(',', $third_price);
                        foreach ($thirdpricenumber as $num) {
                            ThaidCalendar::create([
                                'thaidprice_id' => $ThaidPrice[6]->id,
                                'winning_number' => $num,
                                'thaidsection_id' => $sectionId,
                            ]);
                        }
                    }

                    if ($fourth_price) {
                        $fourthpricenumber = explode(',', $fourth_price);
                        foreach ($fourthpricenumber as $num) {
                            ThaidCalendar::create([
                                'thaidprice_id' => $ThaidPrice[7]->id,
                                'winning_number' => $num,
                                'thaidsection_id' => $sectionId,
                            ]);
                        }
                    }

                    if ($fifth_price) {
                        $fifthpricenumber = explode(
                            ',',
                            $fifth_price
                        );
                        foreach ($fifthpricenumber as $num) {
                            ThaidCalendar::create([
                                'thaidprice_id' => $ThaidPrice[8]->id,
                                'winning_number' => $num,
                                'thaidsection_id' => $sectionId,
                            ]);
                        }
                    }
                    return back();
                }
            } else {
                $ThaidPrice = Thaidprice::all();
                $first_price = $request->first_price;
                $first_three_price = $request->first_three_price;
                $last_three_price = $request->last_three_price;
                $last_two_price = $request->last_two_price;
                $side_first_price = $request->side_first_price;
                $second_price = $request->second_price;
                $third_price = $request->third_price;
                $fourth_price = $request->fourth_price;
                $fifth_price = $request->fifth_price;
                $sectionId = $request->sectiondate;

                if (
                    $first_price && $first_three_price && $last_three_price
                    && $last_two_price && $side_first_price && $second_price
                    && $third_price && $fourth_price && $fifth_price
                ) {

                    if ($first_price) {
                        ThaidCalendar::create([
                            'thaidprice_id' => $ThaidPrice[0]->id,
                            'winning_number' => $first_price,
                            'thaidsection_id' => $sectionId,
                        ]);
                    }

                    if ($first_three_price) {
                        $firstthreenumber = explode(',', $first_three_price);
                        foreach ($firstthreenumber as $num) {
                            ThaidCalendar::create([
                                'thaidprice_id' => $ThaidPrice[1]->id,
                                'winning_number' => $num,
                                'thaidsection_id' => $sectionId,
                            ]);
                        }
                    }

                    if ($last_three_price) {
                        $lastthreenumber = explode(',', $last_three_price);
                        foreach ($lastthreenumber as $num) {
                            ThaidCalendar::create([
                                'thaidprice_id' => $ThaidPrice[2]->id,
                                'winning_number' => $num,
                                'thaidsection_id' => $sectionId,
                            ]);
                        }
                    }


                    if ($last_two_price) {
                        $lasttwonumber = explode(',', $last_two_price);
                        foreach ($lasttwonumber as $num) {
                            ThaidCalendar::create([
                                'thaidprice_id' => $ThaidPrice[3]->id,
                                'winning_number' => $num,
                                'thaidsection_id' => $sectionId,
                            ]);
                        }
                    }



                    if ($side_first_price) {
                        $sidefirstnumber = explode(',', $side_first_price);
                        foreach ($sidefirstnumber as $num) {
                            ThaidCalendar::create([
                                'thaidprice_id' => $ThaidPrice[4]->id,
                                'winning_number' => $num,
                                'thaidsection_id' => $sectionId,
                            ]);
                        }
                    }


                    if ($second_price) {
                        $secondpricenumber = explode(',', $second_price);
                        foreach ($secondpricenumber as $num) {
                            ThaidCalendar::create([
                                'thaidprice_id' => $ThaidPrice[5]->id,
                                'winning_number' => $num,
                                'thaidsection_id' => $sectionId,
                            ]);
                        }
                    }


                    if ($third_price) {
                        $thirdpricenumber = explode(',', $third_price);
                        foreach ($thirdpricenumber as $num) {
                            ThaidCalendar::create([
                                'thaidprice_id' => $ThaidPrice[6]->id,
                                'winning_number' => $num,
                                'thaidsection_id' => $sectionId,
                            ]);
                        }
                    }

                    if ($fourth_price) {
                        $fourthpricenumber = explode(',', $fourth_price);
                        foreach ($fourthpricenumber as $num) {
                            ThaidCalendar::create([
                                'thaidprice_id' => $ThaidPrice[7]->id,
                                'winning_number' => $num,
                                'thaidsection_id' => $sectionId,
                            ]);
                        }
                    }

                    if ($fifth_price) {
                        $fifthpricenumber = explode(
                            ',',
                            $fifth_price
                        );
                        foreach ($fifthpricenumber as $num) {
                            ThaidCalendar::create([
                                'thaidprice_id' => $ThaidPrice[8]->id,
                                'winning_number' => $num,
                                'thaidsection_id' => $sectionId,
                            ]);
                        }
                    }


                    return back();
                }
            }
        }
    }
}

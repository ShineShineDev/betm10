<?php

namespace App\Http\Controllers\admin\thai_lottery_manager;

use App\Http\Controllers\Controller;
use App\Models\Thaidprice;
use App\Models\Thaidpricenumber;
use App\Models\Thaidsection;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ThaidpriceController extends Controller
{
    public function thaidpricecreate(Request $request)
    {
        $priceName = $request->price;
        $amount = $request->amount;
        Thaidprice::create([
            'price' => $priceName,
            'amount' => $amount,
        ]);
        return back();
    }

    public function thaidpricelist()
    {
        $data = Thaidprice::all();
        return view('admin.thai_lottery_manager.price.index', compact('data'));
    }

    public function thaidpricedelete($id)
    {
        Thaidprice::where('id', $id)->delete();
        return back();
    }

    public function store(Request $request)
    {
        if ($request->hiddenvalue !== null) {
            $sectionId = $request->sectiondate;
            Thaidpricenumber::where('thaidsection_id', $sectionId)->delete();
            Thaidsection::where('id',$sectionId)->update([
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
                    Thaidpricenumber::create([
                        'thaidprice_id' => $ThaidPrice[0]->id,
                        'winning_number' => $first_price,
                        'thaidsection_id' => $sectionId,
                    ]);
                }

                if ($first_three_price) {
                    $firstthreenumber = explode(',', $first_three_price);
                    foreach ($firstthreenumber as $num) {
                        Thaidpricenumber::create([
                            'thaidprice_id' => $ThaidPrice[1]->id,
                            'winning_number' => $num,
                            'thaidsection_id' => $sectionId,
                        ]);
                    }
                }

                if ($last_three_price) {
                    $lastthreenumber = explode(',', $last_three_price);
                    foreach ($lastthreenumber as $num) {
                        Thaidpricenumber::create([
                            'thaidprice_id' => $ThaidPrice[2]->id,
                            'winning_number' => $num,
                            'thaidsection_id' => $sectionId,
                        ]);
                    }
                }


                if ($last_two_price) {
                    $lasttwonumber = explode(',', $last_two_price);
                    foreach ($lasttwonumber as $num) {
                        Thaidpricenumber::create([
                            'thaidprice_id' => $ThaidPrice[3]->id,
                            'winning_number' => $num,
                            'thaidsection_id' => $sectionId,
                        ]);
                    }
                }



                if ($side_first_price) {
                    $sidefirstnumber = explode(',', $side_first_price);
                    foreach ($sidefirstnumber as $num) {
                        Thaidpricenumber::create([
                            'thaidprice_id' => $ThaidPrice[4]->id,
                            'winning_number' => $num,
                            'thaidsection_id' => $sectionId,
                        ]);
                    }
                }


                if ($second_price) {
                    $secondpricenumber = explode(',', $second_price);
                    foreach ($secondpricenumber as $num) {
                        Thaidpricenumber::create([
                            'thaidprice_id' => $ThaidPrice[5]->id,
                            'winning_number' => $num,
                            'thaidsection_id' => $sectionId,
                        ]);
                    }
                }


                if ($third_price) {
                    $thirdpricenumber = explode(',', $third_price);
                    foreach ($thirdpricenumber as $num) {
                        Thaidpricenumber::create([
                            'thaidprice_id' => $ThaidPrice[6]->id,
                            'winning_number' => $num,
                            'thaidsection_id' => $sectionId,
                        ]);
                    }
                }

                if ($fourth_price) {
                    $fourthpricenumber = explode(',', $fourth_price);
                    foreach ($fourthpricenumber as $num) {
                        Thaidpricenumber::create([
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
                        Thaidpricenumber::create([
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
                    Thaidpricenumber::create([
                        'thaidprice_id' => $ThaidPrice[0]->id,
                        'winning_number' => $first_price,
                        'thaidsection_id' => $sectionId,
                    ]);
                }

                if ($first_three_price) {
                    $firstthreenumber = explode(',', $first_three_price);
                    foreach ($firstthreenumber as $num) {
                        Thaidpricenumber::create([
                            'thaidprice_id' => $ThaidPrice[1]->id,
                            'winning_number' => $num,
                            'thaidsection_id' => $sectionId,
                        ]);
                    }
                }

                if ($last_three_price) {
                    $lastthreenumber = explode(',', $last_three_price);
                    foreach ($lastthreenumber as $num) {
                        Thaidpricenumber::create([
                            'thaidprice_id' => $ThaidPrice[2]->id,
                            'winning_number' => $num,
                            'thaidsection_id' => $sectionId,
                        ]);
                    }
                }


                if ($last_two_price) {
                    $lasttwonumber = explode(',', $last_two_price);
                    foreach ($lasttwonumber as $num) {
                        Thaidpricenumber::create([
                            'thaidprice_id' => $ThaidPrice[3]->id,
                            'winning_number' => $num,
                            'thaidsection_id' => $sectionId,
                        ]);
                    }
                }



                if ($side_first_price) {
                    $sidefirstnumber = explode(',', $side_first_price);
                    foreach ($sidefirstnumber as $num) {
                        Thaidpricenumber::create([
                            'thaidprice_id' => $ThaidPrice[4]->id,
                            'winning_number' => $num,
                            'thaidsection_id' => $sectionId,
                        ]);
                    }
                }


                if ($second_price) {
                    $secondpricenumber = explode(',', $second_price);
                    foreach ($secondpricenumber as $num) {
                        Thaidpricenumber::create([
                            'thaidprice_id' => $ThaidPrice[5]->id,
                            'winning_number' => $num,
                            'thaidsection_id' => $sectionId,
                        ]);
                    }
                }


                if ($third_price) {
                    $thirdpricenumber = explode(',', $third_price);
                    foreach ($thirdpricenumber as $num) {
                        Thaidpricenumber::create([
                            'thaidprice_id' => $ThaidPrice[6]->id,
                            'winning_number' => $num,
                            'thaidsection_id' => $sectionId,
                        ]);
                    }
                }

                if ($fourth_price) {
                    $fourthpricenumber = explode(',', $fourth_price);
                    foreach ($fourthpricenumber as $num) {
                        Thaidpricenumber::create([
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
                        Thaidpricenumber::create([
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

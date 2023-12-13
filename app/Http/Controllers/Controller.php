<?php

namespace App\Http\Controllers;

use App\Models\ThaiDSection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;
use App\Models\ThreeDBettingLog;
use App\Models\ThreeDSection;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected function latestSection()
    {
        $dateOnly = Carbon::now()->toDateString();
        return ThreeDSection::where('opening_date', '>=', $dateOnly)->with(['threedBlockNumbers', 'threedNumberLimits'])->orderByDesc('id')->first();
    }
    protected function getThaiDlatestSection()
    {
        $dateOnly = Carbon::now()->toDateString();
        return ThaiDSection::where('opening_date', '>=', $dateOnly)->orderByDesc('opening_date')->first();
    }
    protected function currentTotalBetAmountWithProvidedSectionIdAndNum($section_id, $bet_number)
    {
        return ThreeDBettingLog::query()->where("threed_section_id", $section_id)->where("bet_number", $bet_number)->sum('bet_amount');
    }
}

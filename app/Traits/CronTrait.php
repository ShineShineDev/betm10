<?php
namespace App\Traits;

use Carbon\Carbon;
use App\Models\TwodSection;
use App\Models\TwodSchedule;
use App\Models\TwodBlockNumber;
use Illuminate\Support\Facades\Log;

trait CronTrait{
    public function generate2DSection(){
        Log::info("2D Cron Running...");

        // if (!Carbon::now()->gt(Carbon::createFromTimeString('15:00'))) return;
        
        $twod_schedules = TwodSchedule::active()->get();

        foreach ($twod_schedules as $schedule) {
        Log::info("in 1st loop...");

            $opening_datetime = Carbon::parse(Carbon::today()->addDay()->format('Y-m-d') . ' ' . Carbon::parse($schedule->opening_time)->format('H:i'))->format('Y-m-d H:i');
          
			//$opening_datetime = Carbon::parse(Carbon::today()->addDay(3)->format('Y-m-d') . ' ' . Carbon::parse($schedule->opening_time)->format('H:i'))->format('Y-m-d H:i');
          
            $is_section_exists = TwodSection::where('opening_datetime', $opening_datetime)->doesntExist();

            $is_weekday = Carbon::parse($opening_datetime)->isWeekday();
          
          	//$is_weekday = true;
          
            Log::info($is_weekday);

            if ($is_section_exists && $is_weekday) {
                    Log::info("in 2nd loop...");

                    $closing_datetime = Carbon::parse($opening_datetime)->subMinutes($schedule->closing_time);

                    $data  = [
                        'twod_type_id'     => $schedule->twod_type_id,
                        'opening_datetime' => $opening_datetime,
                        'closing_datetime' => $closing_datetime,
                        'odd'              => $schedule->odd,
                        'min_amount'       => $schedule->min_amount,
                        'max_amount'       => $schedule->max_amount,
                        'user_commission'  => $schedule->user_commission,
                        'agent_commission' => $schedule->agent_commission,
                    ];

                    $section = TwodSection::create($data);

                    if($schedule->block_numbers){
                        
                        $block_numbers_data = $this->getTwodBlockNumber($schedule->block_numbers, $section->id);
    
                        TwodBlockNumber::insert($block_numbers_data);
                    }
                    
                    Log::info("New 2D Sections Set!");
            }
        }
        Log::info("2D Cron Running Complete...");
    }

    public function set3DSection(){
        Log::info("3D Cron Running...");

        Log::info("3D Cron Running Complete...");
    }

    private function getTwodBlockNumber($numbers, $section_id)
    {
        if ($numbers)  $num_arr = explode(',', $numbers);
        $data = [];
        foreach ($num_arr as $item) {
            $data[] = [
                'twod_section_id' => $section_id,
                'number' => $item,
            ];
        }
        return $data;
    }

}

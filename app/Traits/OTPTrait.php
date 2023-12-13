<?php

namespace App\Traits;

use App\Models\OTP;
use App\Models\SmsSetting;
use Carbon\Carbon;
use Throwable;

trait OTPTrait
{

    public function getOTP($phone, $type)
    {
        $otp_code = $this->generateOTPCode();
        if ($this->storeOTP($phone, $type, $otp_code)) {
            return $this->getOTPContent($otp_code);
        }
        return false;
    }

    public function storeOTP($phone, $type, $code)
    {
        $otp = new OTP();
        $otp->phone = $phone;
        $otp->type = $type;
        $otp->code = $code;
        $otp->ip = request()->ip();
        return $otp->save();
    }

    public function checkOTPExists($phone)
    {
        if (OTP::where('phone', $phone)->whereDate('created_at', Carbon::today())->count() > 9) {
            return 'Your phone number ' . $phone . ' has exceeded the daily limit for OTP!';
        }

        $minute = Carbon::now()->subMinute();
        if (OTP::where('phone', $phone)->where('created_at', '>', $minute)->exists()) {
            $last_send_time = OTP::where('phone', $phone)->latest()->first()->created_at;
            $minute = 60 - Carbon::parse($last_send_time)->diffInSeconds(Carbon::now());
            return 'Please wait ' . ($minute) . ' seconds to send again!';
        }

        return false;
    }

    public function checkOTP($phone, $code)
    {
        return OTP::where(function ($query) use ($phone, $code) {
            $query->where('phone', $phone)->where('created_at', '>', Carbon::now()->subMinutes(15))->where('code', $code);
        })->exists();
    }

    public function generateOTPCode()
    {
        $number = random_int(000000, 999999);
        return str_pad(strval($number), 6, '0', STR_PAD_LEFT);
    }

    public function getOTPContent($code)
    {
        return 'Your OTP for Aladdin is ' . $code . '. It is valid for next 15 minutes. Please do not share it to anyone. Thanks for using Aladdin!';
    }
}

<?php

namespace App\Traits;

use App\Models\SmsSetting;

trait SendSms
{
    public function sendSms($to, $content)
    {
        $sms_setting = $this->getSMSSetting();
        if ($sms_setting) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $sms_setting->api_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",

                CURLOPT_POSTFIELDS => '{
                    "messages": [
                        {
                            "channel": "sms",
                            "recipients": ["' . $to . '"],
                            "content": "' . $content . '",
                            "msg_type": "text",
                            "data_coding": "text"
                        }
                    ],
                    "message_globals": {
                        "originator": "SignOTP",
                        "report_url": "https://the_url_to_recieve_delivery_report.com"
                    }
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Accept: application/json',
                    'Authorization: Bearer '.$sms_setting->auth_token
                ),
            ));
            $response = curl_exec($curl);
            $response = json_decode($response);
            if (property_exists($response,'status') && $response->status == 'accepted') {
                return true;
            }
        }

        return false;
    }

    private function getSMSSetting()
    {
        return SmsSetting::active()->first();
    }
}

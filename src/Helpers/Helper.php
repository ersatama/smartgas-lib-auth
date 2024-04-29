<?php

namespace Ruslan_sgs\SmartgasLibAuth\Helpers;

abstract class Helper
{
    public function curl($data)
    {
        $params = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTP_VERSION  => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
        ];
        foreach ($data as $key => $val) {
            $params[$key] = $val;
        }
        /*
         * [
            CURLOPT_PORT => "14579",
            CURLOPT_URL  => $url,
            CURLOPT_POSTFIELDS    => "{\n    \"version\": \"1.0\",\n    \"method\": \"XML.verify\",\n    \"params\": {\n        \"xml\":\""
                . addslashes($signature) . "\"\n    }\n}",
            CURLOPT_HTTPHEADER    => [
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 7cba8c1b-29d5-5728-868f-26a35b218aa8"
            ],
        ]
         */
        $curl = curl_init();
        curl_setopt_array($curl, $params);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return $err;
        }
        return json_decode($response, true);
    }
}

<?php 

        // $sms = $_POST['message'];
        // $number = $_POST['phone_number'];
        $sms="hello";
        $number="01516158298";

        function callApi($url, $params) {
            $ch = curl_init(); // Initialize cURL
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($params),
                'accept: application/json'
            ));
    
            $response = curl_exec($ch);
            $data = json_decode($response);
            return $data->status;
    
            curl_close($ch);
        }
        
        function bulkSms($msisdns, $messageBody, $batchCsmsId) {
            $API_TOKEN = "4214672c-9c52-469b-bd2e-0c293e59614f";
            $SID = "IHBDNON";
            $DOMAIN = "https://smsplus.sslwireless.com";
    
            $params = [
                "api_token" => $API_TOKEN,
                "sid" => $SID,
                "msisdn" => $msisdns,
                "sms" => $messageBody,
                "batch_csms_id" => $batchCsmsId
            ];
            $url = $DOMAIN."/api/v3/send-sms/bulk";
            $params = json_encode($params);
            return callApi($url, $params);
        }
        
        
        echo $send = bulkSms($number, $sms, "01675342612");	

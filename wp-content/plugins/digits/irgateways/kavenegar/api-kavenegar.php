<?php
class digits_kavenegarapi
{
    protected $apiKey;
    const APIPATH = "https://api.kavenegar.com/v1/%s/%s/%s.json/";
    const VERSION = "1.1.0";
    public function __construct($apiKey)
    {
        if (!extension_loaded('curl')) {
            die('cURL library is not loaded');
            exit;
        }
        if (is_null($apiKey)) {
            die('apiKey is empty');
            exit;
        }
        $this->apiKey = $apiKey;
    }   
	protected function get_path($method, $base = 'sms')
    {
        return sprintf(self::APIPATH, $this->apiKey, $base, $method);
    }
	protected function execute($url, $data = null)
    {        
        $headers       = array(
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded',
            'charset: utf-8'
        );
        $fields_string = "";
        if (!is_null($data)) {
            $fields_string = http_build_query($data);
        }
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $fields_string);

        $response     = curl_exec($handle);
        $code         = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        $content_type = curl_getinfo($handle, CURLINFO_CONTENT_TYPE);
        $curl_errno   = curl_errno($handle);
        $curl_error   = curl_error($handle);
        if ($curl_errno) {
            digitsDebug($curl_error . ' - ' . $curl_errno);
        }
        $json_response = json_decode($response);
        if ($code != 200 && is_null($json_response)) {
            digitsDebug("Request have errors : ". $code);
        } else {
            $json_return = $json_response->return;
            if ($json_return->status != 200) {
                digitsDebug($json_return->message, $json_return->status);
            }
            return $json_response->entries;
        }
    }
    public function Send($sender, $receptor, $message, $date = null, $type = null, $localid = null)
    {
        if (is_array($receptor)) {
            $receptor = implode(",", $receptor);
        }
        if (is_array($localid)) {
            $localid = implode(",", $localid);
        }
        $path   = $this->get_path("send");
        $params = array(
            "receptor" => $receptor,
            "sender" => $sender,
            "message" => $message,
            "date" => $date,
            "type" => $type,
            "localid" => $localid
        );
        return $this->execute($path, $params);
    }
    public function SendLookup($api, $mobile,$template , $token)
    {
		$url = "http://api.kavenegar.com/v1/".$api."/verify/lookup.json?receptor={$mobile}&type=sms&token={$token}&template={$template}";
		$handler = curl_init($url);
		curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($handler);
        return $response;
    }
}
?>
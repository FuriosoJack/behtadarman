<?php
class digits_raygansmsapi {
    private $username;
    private $Password;
    private $sender;
    private $sendCode;
    public
    function __construct($arg, array $options = array()) {
        if (empty($arg)) {
            digitsDebug("Username and Password and Sender can't be blank");
        } else {
            $this -> username = $arg['username'];
            $this -> password = $arg['password'];
            $this -> sender = $arg['sender'];
            $this -> sendCode = $arg['sendcode'];
        }
    }
    public
    function send(array $sms) {
        if (!is_array($sms)) {
            digitsDebug("sms parameter must be an array");
        }
        $message = $sms['message'];
        $to = $sms['to'];
        if ($this -> sendCode == 1) {
            $url = str_replace(' ', '%20', "https://raygansms.com/SendMessageWithCode.ashx?Username=".$this -> username.
                "&Password=".$this -> password.
                "&Mobile=".$to.
                "&Message=".$message);
        } else {
            $url = str_replace(' ', '%20', "https://raygansms.com/SendMessageWithUrl.ashx?Username=".$this -> username.
                "&Password=".$this -> password.
                "&PhoneNumber=".$this -> sender.
                "&MessageBody=".$message.
                "&RecNumber=".$to.
                "&Smsclass=1");
        }
        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($handler);
        if ($response > 12) {
            return array('success' => true);
        } else {
            digitsDebug("RayganSMS : SMS failed json query:".json_encode(array('message' => $message, 'to' => $to, 'error' => $response ? $response : 'Unknow Error.')));
            return array('success' => false);
        }
    }

}
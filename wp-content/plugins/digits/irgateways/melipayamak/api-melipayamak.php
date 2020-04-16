<?php
class digits_melipayamak {
    private $username;
    private $Password;
    private $sender;
    public
    function __construct($arg, array $options = array()) {

        if (empty($arg)) {
            digitsDebug("Username and Password and Sender can't be blank");
            wp_die("Username and Password and Sender can't be blank");
        } else {
            $this -> username = $arg['username'];
            $this -> password = $arg['password'];
            $this -> sender = $arg['sender'];
        }
    }
    public
    function send(array $sms) {
        if (!is_array($sms)) {
            digitsDebug("sms parameter must be an array");
            return array('success' => false);
        }
        $client = new SoapClient('http://api.payamak-panel.com/post/send.asmx?wsdl', array('encoding' => 'UTF-8'));
        $sendsms_parameters = array(
            'username' => $this -> username,
            'password' => $this -> password,
            'from' => $this -> sender,
            'to' => $sms['to'],
            'text' => $sms['message'],
            'isflash' => false,
        );
        $status = $client -> SendSimpleSMS2($sendsms_parameters) -> SendSimpleSMS2Result;
        if ($status > 12) {
            return array('success' => true);
        } else {
            return array('success' => false);
        }
    }
    public
    function sendPattern(array $sms) {
        if (!is_array($sms)) {
            digitsDebug("sms parameter must be an array");
            return array('success' => false);
        }
        $url = "http://api.payamak-panel.com/post/Send.asmx?wsdl";
        $client = new SoapClient($url, array('encoding' => 'UTF-8'));
        $sendsms_parameters = array(
            'username' => $this -> username,
            'password' => $this -> password,
            'to' => $sms['to'],
            'text' => array($sms['message']),
            'bodyId' => $sms['template'],
        );
        $status = $client -> SendByBaseNumber($sendsms_parameters) -> SendByBaseNumberResult;

        if (strlen($status) > 15) {
            return array('success' => true);
        } else {
            digitsDebug("melipayamak : SMS failed json query:".json_encode(array('message' => $sms['message'], 'to' => $sms['to'], 'error' => $status ? $status : 'Unknow Error.')));
            return array('success' => false);
        }
    }
}
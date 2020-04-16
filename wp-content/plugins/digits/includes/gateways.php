<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if(function_exists('digit_send_message')){
	return;
}

function digit_send_message( $digit_gateway, $countrycode, $mobile, $otp, $dig_messagetemplate, $testCall = false ) {
	if(!$testCall) {
		$debug = apply_filters( 'digits_debug', false );
		if ( $debug ) {
			return true;
		}
	}
	switch ( $digit_gateway ) {
        case 1:
            return true;
	     
	    	    case 380:	//melipayamak
		try
		{
			require_once plugin_dir_path( __DIR__ ).'irgateways/melipayamak/api-melipayamak.php';//api-class
			$meliPayamakclass = get_option('digit_meliPayamak');//api-sett
            $meliPayamak = new digits_melipayamak( $meliPayamakclass );
			$param = array
				(
					'message' => $dig_messagetemplate,
					'to' => $mobile,
					'template' => $meliPayamakclass['template'],
				);
				// Setup and send a message
				if($meliPayamakclass['pattern'] == 1){
					$result = $meliPayamak->sendPattern( $param );
				} else {
					$result = $meliPayamak->send( $param );
				}
                // Check if the send was successful
                if($result['success']) {
                    return true;
                } else {
			return false;
                }
			}
            catch (Exception $e)
            {
                return false;
            }

	   
	    case 382:	//kavenegar
		
		try
		{
			require_once plugin_dir_path( __DIR__ ).'irgateways/kavenegar/api-kavenegar.php';
			$gateway = get_option('digit_kavenegar');
			if(!isset($gateway['kavenegarapi']) || $gateway['kavenegarapi'] == '') return false;
			$api = new digits_kavenegarapi($gateway['kavenegarapi']);
			$sender = $gateway['from'];
			$message = $dig_messagetemplate;
			$receptor = array($mobile);
			if($gateway['pattern'] == 1){
				$result = $api->SendLookup($gateway['kavenegarapi'],$mobile,$gateway['template'], $otp);
				$resultarray = json_decode($result,true);
				if($resultarray['return']['status'] == 200) return true; else return false;
			} else {
				$result = $api->Send($sender,$receptor,$message);
			}
			
			if($result){
				foreach($result as $r){
					if(in_array($r->status,array(1,4,5))) return true;
				}		
			}
		}
		catch(\Kavenegar\Exceptions\ApiException $e){
			echo $e->errorMessage();
			return false;
		}
		catch(\Kavenegar\Exceptions\HttpException $e){
			echo $e->errorMessage();
			return false;
		}
		return false;

	    

		
		
		
		
	    case 386:	//FaraPayamak

		try
		{
			require_once plugin_dir_path( __DIR__ ).'irgateways/melipayamak/api-melipayamak.php';
            $meliPayamak = new digits_MeliPayamak( get_option('digit_farapayamak') );
			$param = array
				(
					'message' => $dig_messagetemplate,
					'to' => $mobile,
				);
                // Setup and send a message
                $result = $meliPayamak->send( $param );
                // Check if the send was successful
                if($result['success']) {
                    return true;
                } else {
			return false;
                }
			}
            catch (Exception $e)
            {
                return false;
            }
	    

	
	    case 391:	//raygansms

		try
		{
			require_once plugin_dir_path( __DIR__ ).'irgateways/raygansms/api-raygansms.php';
			$raygansmsgateway = get_option('digit_raygansms');
            $raygansms = new digits_raygansmsapi( $raygansmsgateway );
			$param = array
				(
					'message' => $dig_messagetemplate,
					'to' => $mobile,
				);
	                // Setup and send a message
	                $result = $raygansms->send( $param );
	                // Check if the send was successful
	                if($result['success']) {
                    return true;
                } else {
			return false;
                }
		}
		catch (Exception $e)
		{
			return false;
		}
		default:
			return false;

	}


}

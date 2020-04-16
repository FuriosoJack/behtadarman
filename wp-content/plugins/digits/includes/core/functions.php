<?php

if (!defined('ABSPATH')) {
    exit;
}

require_once('functionUnicode.php');
require_once('dig_geo.php');
require_once('phandler.php');

require_once 'enqueue/enqueue_scripts.php';
require_once 'enqueue/gateway_scripts.php';


function digits_update_mobile($user_id, $countrycode, $phone)
{
    update_user_meta($user_id, 'digt_countrycode', $countrycode);
    update_user_meta($user_id, 'digits_phone_no', $phone);
    update_user_meta($user_id, 'digits_phone', $countrycode . $phone);
}

function getCountryList()
{
    return array(

        "Iran" => "98",
        "Turkey" => "90"
    );

}

function getTranslatedCountryName($countryName)
{
    $data = array(

        "Iran" => __("Iran", "digits"),
        "Turkey" => __("Turkey", "digits")

    );

    return $data[$countryName];

}


function getCountryCode($country)
{

    if ($country == "") {
        return '';
    }
    $countryarray = getCountryList();


    $whiteListCountryCodes = get_option("whitelistcountrycodes");

    if (is_array($whiteListCountryCodes)) {
        $size = sizeof($whiteListCountryCodes);

        if ($size > 0) {
            if (!in_array($country, $whiteListCountryCodes)) {
                $defaultccode = get_option("dig_default_ccode");
                if (!in_array($defaultccode, $whiteListCountryCodes)) {
                    return $countryarray[$whiteListCountryCodes[0]];
                } else {
                    return $countryarray[$defaultccode];
                }
            }
        }

    }

    if (array_key_exists($country, $countryarray)) {
        return $countryarray[$country];
    } else {
        return '';
    }
}

function digCountry()
{

    $countryList = getCountryList();
    $valCon = "";
    $currentCountry = getUserCountryCode();
    $whiteListCountryCodes = get_option("whitelistcountrycodes");
    $blacklistcountrycodes = get_option("dig_blacklistcountrycodes");

    $size = 0;
    if (is_array($whiteListCountryCodes)) {
        $size = sizeof($whiteListCountryCodes);
    }

    $is_mobile = wp_is_mobile();


    foreach ($countryList as $key => $value) {
        $ac = "";


        if (is_array($whiteListCountryCodes) && !empty($whiteListCountryCodes)) {
            if ($size > 0) {
                if (!in_array($key, $whiteListCountryCodes)) {
                    continue;
                }
            }
        }
        if (!empty($blacklistcountrycodes)) {
            if (in_array($key, $blacklistcountrycodes)) {
                continue;
            }
        }


        if ($currentCountry == '+' . $value) {
            $ac = "selected";
        }


        $valCon .= '<li class="dig-cc-visible ' . $ac . '" value="' . $value . '" data-country="' . strtolower($key) . '">(+' . $value . ') ' . getTranslatedCountryName($key) . '</li>';
    }

    $class = '';
    $stype = 'list';
    if ($is_mobile) {
        $stype = 'mobile';
        $class = 'digits-mobile-list';
        $valCon .= '<li class="spacer" disabled=""></li>';
    }


    $list = '<ul class="digit_cs-list digits_scrollbar ' . $class . '" style="display: none;" data-type="' . $stype . '">' . $valCon . '</ul>';

    if ($is_mobile) {
        $search = '<div class="digits-countrycode-search"><div class="digits-hide-countrycode"></div><input type="text" class="countrycode_search regular-text"></div>';
        $list = '<div class="digits-fullscreen">' . $list . $search . '</div>';
    }
    echo $list;
}


function dig_sanitize($input)
{

    // Initialize the new array that will hold the sanitize values
    $new_input = array();

    // Loop through the input and sanitize each of the values
    foreach ($input as $key => $val) {
        $new_input[$key] = sanitize_text_field($val);
    }

    return $new_input;

}


function dig_isWhatsAppEnabled()
{
    $whatsapp_gateway = get_option('digit_whatsapp_gateway', -1);

    return $whatsapp_gateway == -1 ? false : true;
}
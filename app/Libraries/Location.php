<?php

namespace App\Libraries;

use CodeIgniter\Config\BaseConfig;

class Location extends BaseConfig
{
    public $shareOptions = false;

  
    function __construct(){

        $ch = curl_init(); 

        curl_setopt($ch,CURLOPT_URL,"https://api.ipify.org");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HEADER, false);

        $this->ip = curl_exec($ch);
        curl_close($ch);
        
    }

    public function getIP(){
        return $this->ip;
    }

    public function getLocation($ip){
        //http://ip-api.com/php/{$ip}
        //https://ipapi.co/{$ip}/json/

        $ch = curl_init(); 

        curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/php/${ip}");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HEADER, false);
        $this->location = curl_exec($ch);

        curl_close($ch);


        return $this->location;
    }
}


?>
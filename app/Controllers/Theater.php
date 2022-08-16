<?php

namespace App\Controllers;
use App\Libraries\Location;
use App\Libraries\InputFilter;
use App\Models\TheaterModel;


class Theater extends BaseController
{
    function __construct(){
        $this->session = \Config\Services::session();

     
    }

    public function fillUp(){

       if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $data = [];
            $data['error_message'] = [];

            $this->theater_name = InputFilter::filter($this->request->getVar('theater_name'));
            $this->building = InputFilter::filter($this->request->getVar('building'));
            $this->floor = InputFilter::filter($this->request->getVar('floor'));
            $this->address = InputFilter::filter($this->request->getVar('address'));
            $this->business_license = InputFilter::filter($this->request->getVar('business_license'));


            if(empty($this->theater_name)){
                $data['error_message']['theater_name'] = 'This field is required';
            }else{
                $theater_model = new TheaterModel();
                $theater_exist = $theater_model->find_theater_name($this->theater_name);

                if($theater_exist){
                    $data['error_message']['theater_name'] = 'This theater already exist.';
                }
            }

             if(empty($this->building)){
                $data['error_message']['building'] = 'This field is required';
            }

             if(empty($this->floor)){
                $data['error_message']['floor'] = 'This field is required';
            }

            if(empty($this->address)){
                $data['error_message']['address'] = 'This field is required';
            }

            if(empty($this->business_license)){
                $data['error_message']['business_license'] = 'This field is required';
            }

            if(!empty($data['error_message'])){
                return json_encode($data);
            }
            
            //                         // [status] => success
            //                         // [country] => Philippines
            //                         // [countryCode] => PH
            //                         // [region] => 10
            //                         // [regionName] => Northern Mindanao
            //                         // [city] => Cagayan de Oro
            //                         // [zip] => 9000
            //                         // [lat] => 8.485
            //                         // [lon] => 124.648
            //                         // [timezone] => Asia/Manila
            //                         // [isp] => Philippine Long Distance Telephone Co.
            //                         // [org] => Piph LL
            //                         // [as] => AS9299 Philippine Long Distance Telephone Company
            //                         // [query] => 210.1.130.148
            //'zip_code'=>$location_infos['zip']
            $location = new Location();
            $location_infos = unserialize($location->getLocation($location->getIP()));

            $this->session->set('theater_infos',[
                'theater_name'=>$this->theater_name,
                'business_license'=>$this->business_license,
                'building'=>$this->building,
                'floor'=>$this->floor,
                'address'=>$this->address,
                'country'=>$location_infos['country'],
                'city'=>$location_infos['city'],
                'region'=>$location_infos['region'],
                'region_name'=>$location_infos['regionName'],
                'zip_code'=>$location_infos['zip']
            ]);

           return json_encode(['status'=>1,'redirect_uri'=>'/admin/register/admin']);

       }

        return view('theater_fill_up');

    }

   
}



?>
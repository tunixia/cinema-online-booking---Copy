<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;

use CodeIgniter\API\ResponseTrait;

class Home extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        return view('test');
    }

    public function test(){
        return view('test');
    }

    public function test1(){

        if($_SERVER['REQUEST_METHOD']=='GET'){
            
        $data = [
            'success' => FALSE,
            'id'      => 123,
        ];
          // return $this->failNotFound('User 13 cannot be found.');
           return $this->respond($data,200);
           
        }
    }

    public function testLayout(){
        return view('test1');
    }

    public function testLayout1(){
        return view('test2');
    }

    public function tl(){
        return redirect()->to('/layout');
    }
     public function tl1(){
        return redirect()->to('/layout1');
    }


    public function timeTest(){
        // $myTime = Time::parse('2022-08-01 23:08:55','Asia/Manila');
        // echo $myTime->toDateTimeString();

        // $current = Time::parse('2022-08-01 23:03', 'America/Chicago');
        // $test    = Time::parse('2022-08-01 23:08', 'America/Chicago');

        // $diff = $current->difference($test);

        // echo $diff->humanize(); // 1 year ago

        // $time = Time::parse('March 9, 2016 12:00:00', 'America/Chicago');
        // echo $time->toLocalizedString('MMM d, yyyy hh'); // March 9, 2016

        $start=date_create("2022-08-01 23:00:55");
        $end=date_create("2022-09-01 24:00:55");


        $my_time = date_create('2022-08-01 1:18:55');

        echo 'Start: '. date_format($start,"Y-m-d h:i a");
        echo '<br>';
        echo 'End: '. date_format($end,"Y-m-d h:i a");

        echo '<br>';  echo '<br>';

        if($my_time <= $end && $my_time >= $start){
            echo 'Start: '. date_format($start,"Y-m-d h:i a");
            echo '<br>';
            echo 'End: '. date_format($end,"Y-m-d h:i a");
            echo '<br>';
            echo 'Your time: '. date_format($my_time,"Y-m-d h:i a");
            echo '<br>' . 'Time is conflicted';
        }else{
             echo '<br>' . 'Time is !conflicted';
              echo '<br>';
            echo 'Your time: '. date_format($my_time,"Y-m-d h:i a");
        }


    }
    
}

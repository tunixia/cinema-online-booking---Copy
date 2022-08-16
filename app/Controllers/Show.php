<?php
namespace App\Controllers;

use App\Libraries\InputFilter;

use CodeIgniter\I18n\Time;
use CodeIgniter\API\ResponseTrait;

use App\Models\ShowModel;


class Show extends BaseController{
    use ResponseTrait;


    function __construct(){
        $this->session = \Config\Services::session();
        define('VALID', 'ok');
        define('REQUEST_BAD',400);
        define('REQUEST_OK',200);
    }

    public function index(){
        return view('shows_panel',$this->session->get('user_infos'));
    }

    public function add(){

        $data = [];
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(isset($this->session->user_infos)){
            
                $data['cinema_infos'] =[
                    'cinema_name'=>InputFilter::filter($this->request->getVar('cinema_name')),
                ];

                if(empty($data['cinema_infos']['cinema_name'])){
                    $data['error_message']['cinema_name'] = 'This field is required.';
                }

                
                if(!empty($data['error_message'])){
                   return $this->respond($data['error_message'],REQUEST_BAD);
                }

                $data['cinema_infos']['created_at'] = new Time('now');
                $data['cinema_infos']['theater_id'] = $this->session->get('user_infos')['theater_id'];

                $cinema_model = new CinemaModel();

                $theater_id = $this->session->get('user_infos')['theater_id'];

                if(!$cinema_model->find($data['cinema_infos']['cinema_name'],$theater_id)){
                    $cinema_model->insert($data['cinema_infos']);
                    return $this->respond(
                        ['message'=>"{$data['cinema_infos']['cinema_name']} added successfully"],REQUEST_OK);
                }

                return $this->respond(['message'=>"Cinema {$data['cinema_infos']['cinema_name']} already exist."],REQUEST_BAD);
              
            }

        }
        return $this->fail(['message'=>'Unauthorized Access']);
    }

    public function edit(){
   

        
        $data = [];
        
        if($_SERVER['REQUEST_METHOD']=='POST'){

                if(isset($this->session->user_infos)){
            
                
                $theater_id = $this->session->get('user_infos')['theater_id'];
                
                $cinema_id=InputFilter::filter($this->request->getVar('cinema_id'));
                
                $data['cinema_infos'] = [
                    'cinema_name'=>InputFilter::filter($this->request->getVar('cinema_name')),
                ];
    
    
                    if(empty($data['cinema_infos']['cinema_name'])){  
                        $data['error_message']['cinema_name'] = 'This field is required.';
                    }
      
                    if(!empty($data['error_message'])){
                       return $this->respond($data['error_message'],REQUEST_BAD);
                    }
                    
                    $cinema_model = new CinemaModel();

                    $id_found = $cinema_model->find_id($cinema_id,$theater_id);

                    if($id_found){

                        if(!$cinema_model->find($data['cinema_infos']['cinema_name'],$theater_id)){
                            $cinema_model->update($cinema_id,$data['cinema_infos']);
                            return $this->respond(['message'=>"Edited successfully"],REQUEST_OK);
                        }

                        return $this->respond(['message'=>"Cinema {$data['cinema_infos']['cinema_name']} already exist."],REQUEST_BAD);
                    }

                    
                    return $this->respond(['message'=>"Cinema ID: {$cinema_id} Unknown."],REQUEST_BAD);

            }
        }
        return $this->fail(['message'=>'Unauthorized Access']);



    }

    public function delete(){

        if(isset($this->session->user_infos)){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $theater_id = $this->session->get('user_infos')['theater_id'];

                $cinema_id = InputFilter::filter($this->request->getVar('cinema_id'));
                
                $cinema_model = new CinemaModel();
                $cinema_deleted = $cinema_model->delete($theater_id,$cinema_id);

                if($cinema_deleted){
                    return $this->respond(['message'=>'Deleted Successfully'],REQUEST_OK);
                }
                
                return $this->failNotFound("Cinema ID {$data['cinema_id']} not found.");
                //return $this->respond(['message'=>'Unknown ID'],REQUEST_BAD);               
            }
        }
        return $this->fail(['status'=>400,'message'=>'Unauthorized Access']);

    }

    public function getAll(){

        $data = [];
           
        if(isset($this->session->user_infos)){
            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                    $cinema_model = new CinemaModel();
                    $data = $cinema_model->read($this->session->get('user_infos')['theater_id']);
                    return $this->respond($data,200);
                }
        }
        
        return $this->fail(['status'=>400,'message'=>'Unauthorized Access']);
    }



}










?>

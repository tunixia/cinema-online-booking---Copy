<?php
namespace App\Controllers;

use App\Libraries\InputFilter;

use CodeIgniter\I18n\Time;
use CodeIgniter\API\ResponseTrait;

use App\Models\MovieModel;


class Movie extends BaseController{

    use ResponseTrait;

    function __construct(){ 
        $this->session = \Config\Services::session();
        define('VALID', 'ok');
        define('REQUEST_BAD',400);
        define('REQUEST_OK',200);
    }

    public function index(){
        return view('movies_panel',$this->session->get('user_infos'));
    }

    public function add(){

        $data = [];
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(isset($this->session->user_infos)){
            
                $data['movie_infos'] =[
                    'title'=>InputFilter::filter($this->request->getVar('title')),
                    'description'=> InputFilter::filter($this->request->getVar('description')),
                    'directors'=> InputFilter::filter($this->request->getVar('directors')),
                    'casts'=> InputFilter::filter($this->request->getVar('casts')),
                    'genres'=> InputFilter::filter($this->request->getVar('genres')),
                    'length'=> InputFilter::filter($this->request->getVar('length')),
                    'rated'=> InputFilter::filter($this->request->getVar('rated')),
                    'poster'=> InputFilter::filter($this->request->getVar('poster')),
                    'trailer'=> InputFilter::filter($this->request->getVar('trailer')),
                    'price'=> InputFilter::filter($this->request->getVar('price'))
                ];

                if(empty($data['movie_infos']['title'])){
                    $data['error_message']['title'] = 'This field is required.';
                }

                if(empty($data['movie_infos']['description'])){
                    $data['error_message']['description'] = 'This field is required.';
                }
                
                if(empty($data['movie_infos']['directors'])){
                    $data['error_message']['directors'] = 'This field is required.';
                }
                
                if(empty($data['movie_infos']['casts'])){
                    $data['error_message']['casts'] = 'This field is required.';
                }
                if(empty($data['movie_infos']['length'])){
                    $data['error_message']['length'] = 'This field is required.';
                }else if(!is_numeric($data['movie_infos']['length']) || InputFilter::numbers_with_dot($data['movie_infos']['length'])){
                    $data['error_message']['length'] = 'Whole number only.';
                }
                

                if(empty($data['movie_infos']['genres'])){
                    $data['error_message']['genres'] = 'This field is required.';
                }
                
                if(empty($data['movie_infos']['rated'])){
                    $data['error_message']['rated'] = 'This field is required.';
                }

                if(empty($data['movie_infos']['poster'])){
                    $data['error_message']['poster'] = 'This field is required.';
                }

                if(empty($data['movie_infos']['trailer'])){
                    $data['error_message']['trailer'] = 'This field is required.';
                }

                if(empty($data['movie_infos']['price'])){
                    $data['error_message']['price'] = 'This field is required.';
                }else if(!is_numeric($data['movie_infos']['price'])){
                    $data['error_message']['price'] = 'Numbers only.';
                }
               
  
                if(!empty($data['error_message'])){
                   return $this->respond($data['error_message'],REQUEST_BAD);
                }

                $data['movie_infos']['created_at'] = new Time('now');
                $data['movie_infos']['theater_id'] = $this->session->get('user_infos')['theater_id'];

                $movie_model = new MovieModel();
                $theater_id = $this->session->get('user_infos')['theater_id'];

                if(!$movie_model->find($data['movie_infos']['title'],$theater_id)){
                    $movie_model->insert($data['movie_infos']);
                    return $this->respond(
                        ['message'=>"{$data['movie_infos']['title']} added successfully"],REQUEST_OK);
                }

                return $this->respond(['message'=>"Movie {$data['movie_infos']['title']} already exist."],REQUEST_BAD);
              
            }

        }
        return $this->fail(['message'=>'Unauthorized Access']);
    }

    public function edit(){
        $data = [];
        
        if($_SERVER['REQUEST_METHOD']=='POST'){
                if(isset($this->session->user_infos)){
            
                
                $theater_id = $this->session->get('user_infos')['theater_id'];
                $movie_id = InputFilter::filter($this->request->getVar('movie_id'));

                $data['movie_infos'] = [
                    'title'=>InputFilter::filter($this->request->getVar('title')),
                    'description'=> InputFilter::filter($this->request->getVar('description')),
                    'directors'=> InputFilter::filter($this->request->getVar('directors')),
                    'casts'=> InputFilter::filter($this->request->getVar('casts')),
                    'genres'=> InputFilter::filter($this->request->getVar('genres')),
                    'length'=> InputFilter::filter($this->request->getVar('length')),
                    'rated'=> InputFilter::filter($this->request->getVar('rated')),
                    'poster'=> InputFilter::filter($this->request->getVar('poster')),
                    'trailer'=> InputFilter::filter($this->request->getVar('trailer')),
                    'price'=> InputFilter::filter($this->request->getVar('price'))
                ];
    
    
                    if(empty($data['movie_infos']['title'])){  
                        $data['error_message']['title'] = 'This field is required.';
                    }
    
                    if(empty($data['movie_infos']['description'])){
                        $data['error_message']['description'] = 'This field is required.';
                    }
                    
                    if(empty($data['movie_infos']['directors'])){
                        $data['error_message']['directors'] = 'This field is required.';
                    }
                    
                    if(empty($data['movie_infos']['casts'])){
                        $data['error_message']['casts'] = 'This field is required.';
                    }
                    if(empty($data['movie_infos']['length'])){
                        $data['error_message']['length'] = 'This field is required.';
                    }else if(!is_numeric($data['movie_infos']['length']) || InputFilter::numbers_with_dot($data['movie_infos']['length'])){
                        $data['error_message']['length'] = 'Whole number only.';
                    }
                    
    
                    if(empty($data['movie_infos']['genres'])){
                        $data['error_message']['genres'] = 'This field is required.';
                    }
                    
                    if(empty($data['movie_infos']['rated'])){
                        $data['error_message']['rated'] = 'This field is required.';
                    }
    
                    if(empty($data['movie_infos']['poster'])){
                        $data['error_message']['poster'] = 'This field is required.';
                    }
    
                    if(empty($data['movie_infos']['trailer'])){
                        $data['error_message']['trailer'] = 'This field is required.';
                    }
    
                    if(empty($data['movie_infos']['price'])){
                        $data['error_message']['price'] = 'This field is required.';
                    }else if(!is_numeric($data['movie_infos']['price'])){
                        $data['error_message']['price'] = 'Numbers only.';
                    }
                   
      
                    if(!empty($data['error_message'])){
                       return $this->respond($data['error_message'],REQUEST_BAD);
                    }
                    
                    $movie_model = new MovieModel();
                    $id_found = $movie_model->find_id($movie_id,$theater_id);
                    
                    $movie_titles = $movie_model->get_titles($movie_id,$theater_id);
                    $movie_exist = false;

                    for($i = 0;$i<count($movie_titles);$i++){
                        if($movie_titles[$i]->title == $data['movie_infos']['title']){
                            $movie_exist = true;
                            break;
                        }
                    }

                   if($id_found){

                        if(!$movie_exist){
                            $movie_model->update($theater_id,$movie_id,$data['movie_infos']);
                            return $this->respond(['message'=>"Edited successfully"],REQUEST_OK);
                        }
                        
                        return $this->respond(['message'=>"Movie {$data['movie_infos']['title']} already exist."],REQUEST_BAD);
                   }
                  return $this->respond(['message'=>"Movie ID: {$movie_id} Unknown."],REQUEST_BAD);
            }
        }
        return $this->fail(['message'=>'Unauthorized Access']);

       
    }

    public function delete(){

        if(isset($this->session->user_infos)){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $theater_id = $this->session->get('user_infos')['theater_id'];

                $movie_id = InputFilter::filter($this->request->getVar('movie_id'));
                
                $movie_model = new MovieModel();
                $movie_deleted = $movie_model->delete($theater_id,$movie_id);

                if($movie_deleted){
                    return $this->respond(['message'=>'Deleted Successfully'],REQUEST_OK);
                }
                
                return $this->failNotFound("Movie ID {$data['movie_id']} not found.");
                //return $this->respond(['message'=>'Unknown ID'],REQUEST_BAD);               
            }
        }
        return $this->fail(['status'=>400,'message'=>'Unauthorized Access']);

        

    }

    public function getAll(){

        $data = [];
           
        if(isset($this->session->user_infos)){
            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                    $movie_model = new MovieModel();
                    $data = $movie_model->read($this->session->get('user_infos')['theater_id']);
                    return $this->respond($data,200);
                }
        }
        
        return $this->fail(['status'=>400,'message'=>'Unauthorized Access']);
    }

}

?>
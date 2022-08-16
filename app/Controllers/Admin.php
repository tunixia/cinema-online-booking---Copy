<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

use App\Libraries\Location;
use App\Libraries\InputFilter;

use App\Models\TheaterModel;
use App\Models\UserModel;



class Admin extends BaseController
{

    function __construct(){

        include_once APPPATH . "libraries/vendor/autoload.php";

        $this->session = \Config\Services::session();

        $this->google_client = new \Google_Client();
 
        $this->google_client->setClientId('1064214219295-rqj52o6ddaftup93fgldihl1pg87jkt0.apps.googleusercontent.com'); //Define your ClientID
        
        $this->google_client->setClientSecret('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'); //Define your Client Secret Key
        
        $this->google_client->setRedirectUri('http://localhost:8080/admin/login'); //Define your Redirect Uri
        
        $this->google_client->addScope('email');
        $this->google_client->addScope('profile');

    }

    public function index()
    {   
        return 'Admin dashboard';
    }

    public function dashboard(){


        if(isset($this->session->logged_in) && $this->session->logged_in){
            return view('admin_dashboard',$this->session->get('user_infos'));
        }

        return redirect()->to('/admin/login');

    }

    public function logout(){
        $this->session->destroy();
        return redirect()->to('admin/login');
    }

    public function login(){

        if(isset($this->session->logged_in) && $this->session->has('logged_in')){
            return redirect()->to('admin/dashboard');
        }

        $data = []; 
    
        if(isset($_GET["code"])){
                
            $token = $this->google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
            
            if(!isset($token["error"])){
                
                $this->google_client->setAccessToken($token['access_token']);
                
                $this->google_service = new \Google\Service\Oauth2($this->google_client);
                
                $data = $this->google_service->userinfo->get();
                
                $user_model = new UserModel();

                if($data['verifiedEmail'] && $user_model->find_email($data['email'])){

                    $data['email_credentials'] = [
                        'first_name' => $data['givenName'],
                        'last_name'=>$data['familyName'],
                        'img_url'=>$data['picture'],
                        'email'=>$data['email']
                    ];

                    $user_model->insert_email_credentials($data['email_credentials']); 


                    $user_model = new UserModel();

                    

                    $user_type = $user_model->get_user_type($user_model->get_id_by_email($data['email'])[0]->id)[0]->type;

                    if($user_type==='admin'){

                        $this->session->set('logged_in',true);
                        
                        $this->session->set('user_infos',[
                            'user_id'=> $user_model->get_id_by_email($data['email'])[0]->id,
                            'theater_id'=>$user_model->get_theater_id_by_email($data['email'])[0]->theater_id,
                            'first_name'=>$user_model->get_first_name_by_email($data['email'])[0]->first_name,
                            'last_name'=>$user_model->get_last_name_by_email($data['email'])[0]->last_name,
                            'image'=>$user_model->get_image_by_email($data['email'])[0]->img_url
                        ]);

                        return redirect()->to('admin/dashboard');
                    }
            
                    return redirect()->to('admin/errorlogin');
                }

                return redirect()->to('admin/errorlogin');

            }
        }

        if(!isset($this->session->logged_in) && !$this->session->has('logged_in')){
            $login_button = '<a style="font-size:32px;" class="p-3 btn btn-primary btn-lg text-light rounded fa fa-google" href="'.$this->google_client->createAuthUrl().'"> Google Sign-in</a>';
            $data['login_button'] = $login_button;
            return view('admin_login', $data);
        }
        
    }
    
    public function register(){
        
        if(!isset($this->session->theater_infos)){
            return redirect()->to('/admin/register/theater');
         }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

    
            $this->session->set('user_infos',[
                'email'=>InputFilter::filter($this->request->getVar('email')),
                'contact_number'=> InputFilter::filter($this->request->getVar('contact_number'))
            ]);


            if(empty($this->session->user_infos['email'])){
                $data['error_message']['email'] = 'This field is required';
            }

             if(empty($this->session->user_infos['contact_number'])){
                $data['error_message']['contact_number'] = 'This field is required';
            }else{

                $has_dot = strpos($this->session->get('user_infos')['contact_number'],'.');

                if(!is_numeric($this->session->user_infos['contact_number']) || $has_dot 
                || strlen($this->session->get('user_infos')['contact_number']) > 11){
                    $data['error_message']['contact_number'] = 'Enter proper a phone number.';
                }

            }

            if(!empty($data['error_message'])){
                return json_encode($data);
            }

            $time_stamp = new Time('now');

            $theater_infos = $this->session->theater_infos;
            $theater_infos['created_at'] = $time_stamp;

            $user_infos = $this->session->user_infos;
            $user_infos['type'] = 'admin';
            $user_infos['created_at'] = $time_stamp;

            $theater_model = new TheaterModel();
            $theater_model->insert($theater_infos);

            $user_infos['theater_id'] = $theater_model->getInsertedID();

            $user_model = new UserModel();
            $user_model->insert($user_infos);

            return json_encode(['status'=>1,'redirect_uri'=>'/admin/login']);

        }
       
        return view('admin_register');
    }


    public function errorLogin(){
        return view('errors/admin_account_error', ['account_not_found'=>'This account is not found. Perhaps you want to consider to register']);
    }


    public function paginate(){
        return view('paginate');
    }

    
}

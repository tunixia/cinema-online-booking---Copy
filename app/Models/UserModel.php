<?php
namespace App\Models;


class UserModel{


    function __construct(){$this->db = db_connect();}


    public function insert($data)
    {
        $db = db_connect();
        $db->table('users')
            ->insert($data);
    }

    public function get_id_by_email($email){
    
        $result =
            $this->db->table('users')
            ->select('id')
            ->where('email =', $email)
            ->get()
            ->getResult();


        return $result;
  

    }

    public function get_theater_id_by_email($email){
    
        $result =
            $this->db->table('users')
            ->select('theater_id')
            ->where('email =', $email)
            ->get()
            ->getResult();

 
        return $result;


    }
    
    public function get_first_name_by_email($email){
        
        $result =
            $this->db->table('users')
            ->select('first_name')
            ->where('email =', $email)
            ->get()
            ->getResult();

 
        return $result;
    }

    public function get_last_name_by_email($email){
        
        $result =
            $this->db->table('users')
            ->select('last_name')
            ->where('email =', $email)
            ->get()
            ->getResult();

        return $result;
    }

    public function get_image_by_email($email){
        
        $result =
            $this->db->table('users')
            ->select('img_url')
            ->where('email =', $email)
            ->get()
            ->getResult();

 
        return $result;
    }

    public function insert_email_credentials($data){
        $db = db_connect();

        $db->table('users')
            ->set('first_name', $data['first_name'])
            ->set('last_name', $data['last_name'])
            ->set('img_url', $data['img_url'])
            ->where('email =',$data['email'])
            ->update($data);

    }

    public function get_user_type($id){
        
        $result =
            $this->db->table('users')
            ->select('type')
            ->where('id =', $id)
            ->get()
            ->getResult();

 
        return $result;
    }

    

    public function find_email($email){

        $db = db_connect();

        $result =
            $db->table('users')
            ->select('email')
            ->where('email =', $email)
            ->get()
            ->getResult();

        if ($result != null) {
            return true;
        }

        return false;
    }

}

?>
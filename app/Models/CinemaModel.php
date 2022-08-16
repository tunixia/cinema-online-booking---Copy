<?php
namespace App\Models;


class CinemaModel{


    function __construct(){
        $this->db = db_connect();
    }


    public function insert($data){

        $this->db->table('cinemas')
            ->insert($data);
    }

    public function read($theater_id){

        $result =
            $this->db->table('cinemas')
            ->where('theater_id =', $theater_id)
            ->get()
            ->getResult();

        if($result != null){

            return $result;
        }

        return false;
        
    }

    public function update($cinema_id,$data){

        $result =
            $this->db->table('cinemas')
            ->set($data)
            ->where('cinema_id =',$cinema_id)
            ->update();

        if ($result != null) {
            return true;
        }

        return false;
    }

    public function delete($theater_id,$cinema_id)
    {
        $result =
            $this->db->table('cinemas')
            ->where('theater_id =', $theater_id)
            ->where('cinema_id =', $cinema_id)
            ->delete();

        if ($result != null) {
            return true;
        }

        return false;
    }

    public function find($cinema_name,$theater_id){

        $result =
            $this->db->table('cinemas')
            ->select('cinema_name')
            ->where('cinema_name =', $cinema_name)
            ->where('theater_id =',$theater_id)
            ->get()
            ->getResult();

        if ($result != null) {
            return true;
        }

        return false;
    }


    public function find_id($cinema_id,$theater_id){

        $result =
            $this->db->table('cinemas')
            ->select('cinema_id')
            ->where('cinema_id =', $cinema_id)
            ->where('theater_id =',$theater_id)
            ->get()
            ->getResult();

        if ($result != null) {
            return true;
        }

        return false;
    }

    public function get_id_by_name($cinema_name,$theater_id){

        $result =
            $this->db->table('cinemas')
            ->select('cinema_id')
            ->where('theater_id =', $theater_id)
            ->where('cinema_name',$cinema_name)
            ->get()
            ->getResult();


        if($result){

            return $result;
        }

        return false;
        

    }


}

?>
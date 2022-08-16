<?php
namespace App\Models;


class MovieModel{


    function __construct(){
        $this->db = db_connect();
    }


    public function insert($data){

        $this->db->table('movies')
            ->insert($data);
    }

    public function read($theater_id){

        $result =
            $this->db->table('movies')
            ->where('theater_id =', $theater_id)
            ->get()
            ->getResult();

        if($result != null){

            return $result;
        }

        return false;
        
    }

    public function update($theater_id,$movie_id,$data){

        $result =
            $this->db->table('movies')
            ->set($data)
            ->where('movie_id =',$movie_id)
            ->where('theater_id =', $theater_id)
            ->update();

        if ($result != null) {
            return true;
        }

        return false;
    }

    public function delete($theater_id,$movie_id)
    {
        $result =
            $this->db->table('movies')
            ->where('theater_id =', $theater_id)
            ->where('movie_id =', $movie_id)
            ->delete();

        if ($result != null) {
            return true;
        }

        return false;
    }

    public function find($title,$theater_id){

        $result =
            $this->db->table('movies')
            ->select('title')
            ->where('title =', $title)
            ->where('theater_id =',$theater_id)
            ->get()
            ->getResult();

        if ($result != null) {
            return true;
        }

        return false;
    }

    public function find_id($movie_id,$theater_id){

        $result =
            $this->db->table('movies')
            ->select('movie_id')
            ->where('movie_id =', $movie_id)
            ->where('theater_id =', $theater_id)
            ->get()
            ->getResult();

        if ($result != null) {
            return true;
        }

        return false;
    }

    public function get_titles($movie_id,$theater_id){
        
        $result =
            $this->db->table('movies')
            ->select('title')
            ->where('theater_id =', $theater_id)
            ->where('movie_id <>', $movie_id)
            ->get()
            ->getResult();

        if ($result != null) {
            return $result;
        }

        return false;
    }


    public function get_id_by_title($title,$theater_id){

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
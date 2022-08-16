<?php
namespace App\Models;


class TheaterModel{


    function __construct(){$this->db = db_connect();}


    public function insert($data)
    {

      
        $db = db_connect();
        $db->table('theaters')
            ->insert($data);

        $this->inserted_theater_id = $db->insertID();
    }

    public function find_theater_name($theater_name){
        $db = db_connect();

        $result =
            $db->table('theaters')
            ->select('theater_name')
            ->where('theater_name =', $theater_name)
            ->get()
            ->getResult();

        if ($result != null) {
            return true;
        }

        return false;
    }

    public function getInsertedID()
    {
        return $this->inserted_theater_id;
    }
}

?>
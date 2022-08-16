<?php
namespace App\Libraries;

class InputFilter {
    
    static function filter($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    static function numbers_with_dot($val){
        $pos = strpos($val,'.');
        
        if($pos > 0){
            return TRUE;
        }

        return FALSE;
    }

}

?>
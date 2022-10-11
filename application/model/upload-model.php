<?php

class uploadModel
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }
    public function uploadFile($name,$formats=['png','jpg','jpeg','pdf'])
    {
        $date = new DateTime();
        $target_dir = "uploads/";
        $filenameExploded = explode('.',$_FILES[$name]['name']);
        $target_file = $target_dir . base64_encode($filenameExploded[0].$date->getTimestamp()).'.'.$filenameExploded[count($filenameExploded)-1];    
        $check = in_array(strtolower($filenameExploded[count($filenameExploded)-1]),$formats);
        if($check){
            if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
                return $target_file;
            } else {
                return 'img/empty.png';
            }
        }else{
            return  'img/empty.png';
        }
    }
}

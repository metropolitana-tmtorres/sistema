<?php

class loginModel
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

    public function login($mail,$pass) {
        $sql = "SELECT * FROM tb_adm WHERE strAdmMail = :mail AND strAdmPass = :pass";
        $query = $this->db->prepare($sql);
        $parameters = array( ':mail' => $mail, ':pass' => $pass );
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
        $number_of_rows = $query->rowCount();
        if($number_of_rows >= 1){
            $adm = $query->fetch();

            if($adm->strAdmStatus == 'a') {
                return $adm;
            }else{
                return "inactive";
            }
        }else{
            return false;
        }
        
    }

    
}


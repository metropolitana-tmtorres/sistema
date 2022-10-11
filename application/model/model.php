<?php

class Model
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

    public function cadastraCrm($code,$fantasia,$contato,$mail,$telefone,$funcao,$status) {
        $sql = "INSERT INTO tb_crm (strCrmCode,strCrmFantasia,strCrmContact,strCrmMail,strCrmPhone,strCrmFunction,strCrmStatus)
        VALUES (:code,:fantasia,:contato,:mail,:fone,:funcao,:stats)";
        $query = $this->db->prepare($sql);
        $parameters = array( ':code' => $code, ':fantasia' => $fantasia, ':contato' => $contato, ':mail' => $mail, ':fone' => $telefone, ':funcao' => $funcao, ':stats' => $status);
        echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);

        return true; 
    }

    public function login($mail,$pass) {
        $sql = "SELECT * FROM tb_adm WHERE strAdmMail = :mail AND strAdmPass = :pass";
        $query = $this->db->prepare($sql);
        $parameters = array( ':mail' => $mail, ':pass' => $pass );
        $query->execute($parameters);
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $number_of_rows = $query->rowCount();
        // echo $number_of_rows; exit;
        if($number_of_rows >= 1){
            $adm = $query->fetch();
            var_dump($adm); exit;
            $registerLog = $this->coreModel->registerLog($adm->intAdmID, "fez login no sistema");
            return $adm;
        }else{
            return false;
        }
        
    }

    public function getAdmByID($id) {
        $sql = "SELECT * FROM tb_adm WHERE intAdmID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array( ':id' => $id );
        $query->execute($parameters);

        return $query->fetch();

    }

    public function addAdm($name,$mail,$pass) {
        $sql = "INSERT INTO tb_adm (strAdmNome,strAdmMail,strAdmPass) VALUES (:aname,:mail,:pass)";
        $query = $this->db->prepare($sql);
        $parameters = array(':aname' => $name, ':mail' => $mail, ':pass');
        $query->execute($parameters);

        return true;
    }
}

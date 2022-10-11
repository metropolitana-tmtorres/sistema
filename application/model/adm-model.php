<?php

class admModel
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

    public function getAdmByID($id) {
        $sql = "SELECT a.*, d.intDepartamentoID, d.strDepartamentoNome, c.intCargoID, c.strCargoNome FROM tb_adm AS a 
        INNER JOIN tb_departamentos AS d ON a.intDepartamentoID = d.intDepartamentoID 
        INNER JOIN tb_cargo AS c ON a.intCargoID = c.intCargoID
        WHERE a.intAdmID = :id";
        // $sql = "SELECT a.*, d.*, c.* FROM tb_adm AS a INNER JOIN tb_departamentos AS d ON a.intDepartamentoID = d.intDepartamentoID
        // INNER JOIN tb_cargo AS c ON a.intCargoID = c.intCargoID WHERE a.intAdmID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array( ':id' => $id );
        $query->execute($parameters);

        return $query->fetch();

    }

    public function registerAdm($name,$mail,$pass,$depto, $cargo) {
        $sql = "INSERT INTO tb_adm (strAdmNome,strAdmMail,strAdmPass,intDepartamentoID,intCargoID) VALUES (:aname,:mail,:pass,:depto, :cargo)";
        $query = $this->db->prepare($sql);
        $parameters = array(':aname' => $name, ':mail' => $mail, ':pass' => $pass, ':depto' => $depto, ':cargo' => $cargo);
        $query->execute($parameters);

        return true;
    }

    public function editAdm($name,$mail,$depto,$cargo,$id) {
        $sql = "UPDATE tb_adm SET strAdmNome = :aname, strAdmMail = :mail, intDepartamentoID = :depto, intCargoID = :cargo WHERE intAdmID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':aname' => $name, ':mail' => $mail, ':depto'=> $depto, ':cargo' => $cargo, ':id' => $id);
        $query->execute($parameters);

        return true;
    }

    public function editAdmPassword($pass,$id) {
        $sql = "UPDATE tb_adm SET strAdmPass = :pass WHERE intAdmID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':pass' => $pass, ':id' => $id);
        $query->execute($parameters);

        return true;
    }

    public function excAdm($id) {
        $sql = "DELETE FROM tb_adm WHERE intAdmID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return true; 
    }

    public function getAllAdm() {
        $sql = "SELECT a.*, d.intDepartamentoID, d.strDepartamentoNome, c.intCargoID, c.strCargoNome FROM tb_adm AS a 
        INNER JOIN tb_departamentos AS d ON a.intDepartamentoID = d.intDepartamentoID 
        INNER JOIN tb_cargo AS c ON a.intCargoID = c.intCargoID";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function registerJobRole($depto, $role) {
        $sql = "INSERT INTO tb_cargo (intDepartamentoID, strCargoNome) VALUES (:depto, :nome)";
        $query = $this->db->prepare($sql);
        $parameters = array(':depto' => $depto, ':nome' => $role);
        $query->execute($parameters);

        return $this->db->lastInsertId();
    }

    public function getAllJobRole() {
        $sql = "SELECT c.*, d.* FROM tb_cargo AS c INNER JOIN tb_departamentos AS d ON c.intDepartamentoID = d.intDepartamentoID ORDER BY strCargoNome ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();

    }

    public function getJobRoleByID($id) {
        $sql = "SELECT * FROM tb_cargo WHERE intCargoID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return $query->fetch();
    }

    public function getAllUsersByJobRoleID($id) {
        $sql = " SELECT * FROM tb_adm WHERE intAdmID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return $query->fetchAll();
    }

    public function getAllRolesByDeptoID($id) {
        $sql = "SELECT * FROM tb_cargo WHERE intDepartamentoID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id'=> $id);
        $query->execute($parameters);

        return $query->fetchAll();
    }

    public function getAllUsersByJobRoleIDNum($id) {
        $sql = " SELECT * FROM tb_adm WHERE intAdmID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return $query->rowCount();
    }

    public function deleteJobRole($id) {
        $sql = "DELETE FROM tb_cargo WHERE intCargoID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return true;
    }

    public function changeUsersJobRole($old,$new) {
        $sql = "UPDATE tb_adm SET intCargoID = :new WHERE intCargoID = :old";
        $query = $this->db->prepare($sql);
        $parameters = array( ':old' => $old, ':new' => $new );
        $query->execute($parameters);

        return true;
    }

    public function registerPermission($id,$p) {
        $sql = "UPDATE tb_cargo SET strCargoAccess = :p WHERE intCargoID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id, ':p' => $p);
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);

        return true;
    }

    public function getJobRolePermissionsByID($jid) {
        $sql = "SELECT strCargoAccess FROM tb_cargo WHERE intCargoID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $jid);
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);

        return $query->fetch();
    }


    public function getAdmNameByID($id) {
        $sql = "SELECT strAdmNome FROM tb_adm WHERE intAdmID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);

        $n = $query->fetch();

        return $n->strAdmNome;
    }

    public function getAdmJobRoleByID($id) {
        $sql = "SELECT intCargoID FROM tb_adm WHERE intAdmID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);

        $n = $query->fetch();

        return $n->intCargoID;
    }

    public function getAdmJobRoleNameByID($id) {
        $sql = "SELECT a.intCargoID, c.intCargoID, c.strCargoNome FROM tb_adm WHERE intAdmID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);

        $n = $query->fetch();

        return $n->intCargoID;
    }

    // function testSql() {
    //     $sql = "SELECT * FROM tb_adm";
    //     $query = $this->db->prepare($sql);
    //     $query->execute();

    //     return $query->fetchall();
    // }
 }

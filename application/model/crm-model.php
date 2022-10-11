<?php

class crmModel
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

    public function cadastraCrm($contato,$mail,$telefone,$funcao,$status,$adm,$cliente,$conta) {
        $sql = "INSERT INTO tb_crm (strCrmContact,strCrmMail,strCrmPhone,strCrmFunction,strCrmStatus,intAdmID,intClienteID,intContaID)
        VALUES (:contato,:mail,:fone,:funcao,:stats,:adm,:cliente,:conta)";
        $query = $this->db->prepare($sql);
        $parameters = array(':contato' => $contato, ':mail' => $mail, ':fone' => $telefone, ':funcao' => $funcao, ':stats' => $status, ':adm' => $adm, ':cliente' => $cliente, ':conta' => $conta);
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);

        return true; 
    }

    public function getAllCrm() {
        $sql = "SELECT c.*, cl.*, co.*, s.* FROM tb_crm AS c INNER JOIN tb_clientes AS cl ON c.intClienteID = cl.intClienteID INNER JOIN tb_contas AS co ON c.intContaID = co.intContaID LEFT JOIN tb_segmentos as s ON co.intSegmentoID = s.intSegmentoID ";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    

    public function getAllCrmByStatus($s) {
        $sql = "SELECT c.*, cl.*, co.*, s.* FROM tb_crm AS c INNER JOIN tb_clientes AS cl ON c.intClienteID = cl.intClienteID INNER JOIN tb_contas AS co ON c.intContaID = co.intContaID LEFT JOIN tb_segmentos as s ON co.intSegmentoID = s.intSegmentoID  WHERE strCrmStatus = :s";
        $query = $this->db->prepare($sql);
        $parameters = array(':s' => $s);
        $query->execute($parameters);

        return $query->fetchAll();
    }

    public function getAllCrmByUser($u) {
        $sql = "SELECT c.*, cl.*, co.* , s.* FROM tb_crm AS c INNER JOIN tb_clientes AS cl ON c.intClienteID = cl.intClienteID INNER JOIN tb_contas AS co ON c.intContaID = co.intContaID LEFT JOIN tb_segmentos as s ON co.intSegmentoID = s.intSegmentoID  WHERE c.intAdmID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $u);
        $query->execute($parameters);

        return $query->fetchAll();
    }
    

    public function getAllCrmByStatusByUser($s,$u) {
        $sql = "SELECT c.*, cl.*, co.*, s.* FROM tb_crm AS c INNER JOIN tb_clientes AS cl ON c.intClienteID = cl.intClienteID INNER JOIN tb_contas AS co ON c.intContaID = co.intContaID LEFT JOIN tb_segmentos as s ON co.intSegmentoID = s.intSegmentoID  WHERE strCrmStatus = :s AND intAdmID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':s' => $s, ':id'=> $u);
        $query->execute($parameters);

        return $query->fetchAll();
    }

    public function getAllCrmNum() {
        $sql = "SELECT * FROM tb_crm";
        $query = $this->db->prepare($sql);
        $query->execute();
        $number_of_rows = $query->rowCount();
        return $number_of_rows;
    }

    public function getCrmByID($id) {
        $sql = "SELECT c.*, cl.*, co.*, s.* FROM tb_crm AS c INNER JOIN tb_clientes AS cl ON c.intClienteID = cl.intClienteID INNER JOIN tb_contas AS co ON c.intContaID = co.intContaID LEFT JOIN tb_segmentos as s ON co.intSegmentoID = s.intSegmentoID  WHERE intCrmID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return $query->fetch();
    }

    public function getAllIntervencoesByID($id) {
        $sql = "SELECT * FROM tb_intervencao WHERE intCrmID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return $query->fetchAll();
    }

    public function getAllIntervencoesNumByID($id) {
        $sql = "SELECT * FROM tb_intervencao WHERE intCrmID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
        $number_of_rows = $query->rowCount();
        return $number_of_rows;
    }

    public function addIntervencao($historico,$id) {
        $sql = "INSERT INTO tb_intervencao (intCrmID,strIntervencaoHistorico) VALUES (:id,:historico)";
        $query = $this->db->prepare($sql);
        $parameters = array(':historico' => $historico, ':id' => $id);
        $query->execute($parameters);

        return true;
    }

    public function getLastID() {
        $sql = "SELECT intCrmID FROM tb_crm ORDER BY intCrmID DESC LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch();
    }

}

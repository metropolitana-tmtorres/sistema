<?php

class briefingModel
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

    public function saveBriefing($adm,$crm) {
        $sql = "INSERT INTO tb_briefing (intAdmID,intCrmID) VALUES (:adm,:crm)";
        $query = $this->db->prepare($sql);
        $parameters = array(':adm' => $adm, ':crm' => $crm);

        $query->execute($parameters);

        $sql = "SELECT intBriefingID FROM tb_briefing ORDER BY intBriefingID DESC";
        $query = $this->db->prepare($sql);
        $query->execute($parameters);

        return $query->fetch();
    }

    public function getAllBriefings() {
        $sql = "SELECT b.*, c.*, a.* FROM tb_briefing AS b INNER JOIN tb_crm AS c ON b.intCrmID = c.intCrmID INNER JOIN tb_adm AS a 
        ON b.intAdmID = a.intAdmID";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getAllBriefingsByID($id) {
        $sql = "SELECT b.*, c.*, a.* FROM tb_briefing AS b INNER JOIN tb_crm AS c ON b.intCrmID = c.intCrmID INNER JOIN tb_adm AS a 
        ON c.intAdmID = a.intAdmID WHERE intBriefingID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return $query->fetch();
    }

    public function getAllBriefingByCRM($id) {
        $sql = "select b.*, c.*, a.* FROM tb_briefing AS b INNER JOIN tb_crm AS c ON b.intCrmID = c.intCrmID INNER JOIN tb_adm AS a 
        ON c.intAdmID = a.intAdmID WHERE intBriefingID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return $query->fetch();
    }

    public function saveBriefingStatus($status,$id) {
        $sql = "UPDATE tb_crm SET strCrmStatus = :stats WHERE intCrmID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':stats' => $status, ':id' => $id);
        $query->execute($parameters);

        return true;
    }

    public function getBriefingsByCrmID($id) {
        $sql = "SELECT * FROM tb_briefing WHERE intCrmID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return $query->fetchAll();
    }

    public function getAllBriefingByID($id) {
        $sql = "select b.*, c.*, a.* FROM tb_briefing AS b INNER JOIN tb_crm AS c ON b.intCrmID = c.intCrmID INNER JOIN tb_adm AS a 
        ON c.intAdmID = a.intAdmID WHERE intBriefingID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return $query->fetch();
    }

    public function addBriefingItem($produto,$briefing) {
        $sql = "INSERT INTO tb_briefing_produtos (intBriefingID,intProdutoID) VALUES (:briefing,:produto)";
        $query = $this->db->prepare($sql);
        $parameters = array(':produto' => $produto, ':briefing' => $briefing);

        $query->execute($parameters);

        return true;
    }


    public function addBriefingDetail($brief,$prod,$date,$qtd) {
        $sql = "INSERT INTO tb_briefing_produtos_data (intBriefingID,intProdutoID,strBriefingProdutoData,intBriefingProdutoDataQtd)
        VALUES (:briefing,:produto,:dt,:qtd)";
        $query = $this->db->prepare($sql);
        $parameters = array(':produto' => $prod, ':briefing' => $brief,':dt' => $date,':qtd' => $qtd);

        $query->execute($parameters);

        return true;
    }

    public function getProdutosByBriefingID($briefing) {
        $sql = "SELECT bp.*, p.* FROM tb_briefing_produtos AS bp INNER JOIN tb_produtos AS p ON bp.intProdutoID = p.intProdutoID WHERE intBriefingID = :briefing ORDER BY intBriefingProdutoID ASC";
        $query = $this->db->prepare($sql);
        $parameters = array(':briefing' => $briefing);

        $query->execute($parameters);

        return $query->fetchAll();
    }

    public function delBriefingItem($produto, $briefing) {
        $sql = "DELETE FROM tb_briefing_produtos WHERE intBriefingID = :briefing AND intProdutoID = :produto";
        $query = $this->db->prepare($sql);
        $parameters = array(':briefing' => $briefing, ':produto'=> $produto);

        $query->execute($parameters);

        return true;
    }

    public function getAllBriefingDetalhesByProdID($prod,$brief) {
        $sql = "SELECT * FROM tb_briefing_produtos_data WHERE intBriefingID = :briefing AND intProdutoID = :produto";
        $query = $this->db->prepare($sql);
        $parameters = array(':briefing' => $brief, ':produto' => $prod);

        $query->execute($parameters);

        return $query->fetchAll();
    }

    public function excluirBriefingDetail($id) {
        $sql = "DELETE FROM tb_briefing_produtos_data WHERE intBriefingProdutoDataID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id'=> $id);

        $query->execute($parameters);

        return true;
    }

    public function excluirBriefingDetailTotal($prod,$brief) {
        $sql = "DELETE FROM tb_briefing_produtos_data WHERE intProdutoID = :prod AND intBriefingID = :brief";
        $query = $this->db->prepare($sql);
        $parameters = array(':prod'=> $prod, ':brief' => $brief);

        $query->execute($parameters);

        return true;
    }

    public function checkBriefingDetail($date,$brief) {
        $sql = "SELECT * FROM tb_briefing_produtos_data WHERE strBriefingProdutoData = :d AND intBriefingID = :b";
        $query = $this->db->prepare($sql);
        $parameters = array(':d'=> $date, ':b' => $brief);

        $query->execute($parameters);
        return $query->fetch();
    }

    public function updateBriefingDetail($id,$qtd) {
        $sql = "UPDATE tb_briefing_produtos_data SET intBriefingProdutoDataQtd = :qtd WHERE intBriefingProdutoDataID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id'=> $id, ':qtd' => $qtd);

        $query->execute($parameters);
        return true;
    }
}

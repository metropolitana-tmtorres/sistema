<?php

class recebimentosModel
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

    public function getAllRecebimentos() {
        $sql = "SELECT cr.*, ct.*, cl.* FROM tb_contas_receber AS cr INNER JOIN tb_contratos AS ct ON cr.intContratoID = ct.intContratoID INNER JOIN tb_clientes AS cl ON ct.intClienteID = cl.intClienteID";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function addRecebimento($adm,$contrato,$datavencimento,$valor,$status) {
        $sql = "INSERT INTO tb_contas_receber (intContratoID,strContaReceberDateVenc,strContaReceberValor,strContaReceberStatus,intAdmID) 
        VALUES (:contrato,:venc,:valor,:stats,:adm)";
        $query = $this->db->prepare($sql);
        $parameters = array(':contrato'=> $contrato, ':venc' => $datavencimento, ':valor' => $valor, ':stats' => $status, ':adm' => $adm);
        $query->execute($parameters);

        return true;
    }
}

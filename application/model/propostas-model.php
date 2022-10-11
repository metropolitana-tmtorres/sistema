<?php 

class propostasModel
{
  function __construct($db)
  {
      try {
          $this->db = $db;
      } catch (PDOException $e) {
          exit('Database connection could not be established.');
      }
  }

  public function addProposta($codigo, $dataSolicitada, $dataEnvio)
  {
    $sql = "INSERT INTO tb_propostas (intPoID,strPropostaDataSolicitada,strPropostaDataEnvio)
    VALUES (:codigo,:dataSolicitada,:dataEnvio)";
    $query = $this->db->prepare($sql);
    $parameters = array(':codigo' => $codigo,':dataSolicitada' => $dataSolicitada, ':dataEnvio' => $dataEnvio);
    $query->execute($parameters);

    return true;
  }

  public function getAllPropostas()
  {
    $sql = "SELECT * FROM  tb_propostas";
    $query = $this->db->prepare($sql);
    $query->execute();

    return $query->fetchAll();
  }

  public function getClienteByPoID($id)
  {
    $sql = "SELECT strClienteFantasia FROM tb_clientes 
    INNER JOIN tb_po ON tb_clientes.intClienteID = tb_po.intClienteID
    WHERE tb_po.intPoID =:id";

    $query = $this->db->prepare($sql);
    $parameters = array(':id' => $id);
    $query->execute($parameters);

    return $query->fetch();
  }

  public function getCrmByPoID($id)
  {
    $sql = "SELECT strCrmFantasia FROM tb_crm 
    INNER JOIN tb_po ON tb_crm.intCrmID = tb_po.intCrmID
    WHERE tb_po.intPoID =:id";

    $query = $this->db->prepare($sql);
    $parameters = array(':id' => $id);
    $query->execute($parameters);

    return $query->fetch();
  }

  public function getStatusByPoID($id)
  {
    $sql = "SELECT strPoStatus FROM tb_po WHERE intPoID = :id";
    
    $query = $this->db->prepare($sql);
    $parameters = array(':id' => $id);
    $query->execute($parameters);

    return $query->fetch();
  }

  public function getBriefingIdByPoID($id)
  {
    $sql = "SELECT intBriefingID FROM tb_briefing 
    INNER JOIN tb_po ON tb_briefing.intCrmID = tb_po.intCrmID
    WHERE intPoID = :id";
    
    $query = $this->db->prepare($sql);
    $parameters = array(':id' => $id);
    $query->execute($parameters);

    return $query->fetch();
  }
}
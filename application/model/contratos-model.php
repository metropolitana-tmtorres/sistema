<?php 

class contratosModel
{
  function __construct($db)
  {
      try {
          $this->db = $db;
      } catch (PDOException $e) {
          exit('Database connection could not be established.');
      }
  }

  public function addContrato($tipo,$autorizacao,$clienteCnpj,$agenciaCnpj,$nomeProjeto,$vendedor,$valor,$contratoData,$contratoPdf)
  {
    $sql = "INSERT INTO tb_contratos (strContratoTipo,strContratoAutorizacao, intClienteID, intAgenciaID, 
    strProjetoNome, intAdmID, strContratoValor, strContratoData, strContratoPDF)
    VALUES (:tipo,:autorizacao,:clienteCnpj,:agenciaCnpj,:nomeProjeto,:vendedor,:valor,:contratoData,:contratoPdf)";
    $query = $this->db->prepare($sql);
    $parameters = array(':tipo' => $tipo,':autorizacao' => $autorizacao,':clienteCnpj' => $clienteCnpj,
    ':agenciaCnpj' => $agenciaCnpj,':nomeProjeto' => $nomeProjeto,':vendedor' => $vendedor,
    ':valor' => $valor,':contratoData' => $contratoData, ':contratoPdf' => $contratoPdf);
    $query->execute($parameters);

    return true;
  }

  public function editContrato($tipo,$autorizacao,$clienteCnpj,$agenciaCnpj,$nomeProjeto,$vendedor,$valor,$contratoData,$id) {
    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE tb_contratos
    SET strContratoTipo = :tipo, 
    strContratoAutorizacao = :autorizacao, 
    intClienteID = :clienteCnpj, 
    intAgenciaID = :agenciaCnpj,
    strProjetoNome = :nomeProjeto, 
    intAdmID = :vendedor,
    strContratoValor = :valor,
    strContratoData = :contratoData
    WHERE intContratoID = :id";
    $statement = $this->db->prepare($sql);
    try{
        $parameters = array(':tipo' => $tipo,':autorizacao' => $autorizacao,':clienteCnpj' => $clienteCnpj,
        ':agenciaCnpj' => $agenciaCnpj,':nomeProjeto' => $nomeProjeto,':vendedor' => $vendedor,
        ':valor' => $valor,':contratoData' => $contratoData, ':id' => (int) $id);
        $statement->execute($parameters);

        return true;
    }catch(Exception $ex){
        var_dump($ex->getMessage());
    }
  }

  public function editContratoPdf($contratoPdf,$id) {
        $sql = "UPDATE tb_contratos SET strContratoPDF = :contratoPdf WHERE intContratoID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':contratoPdf' => $contratoPdf, ':id' => (int) $id);
        $query->execute($parameters);

        return true;
    }

  public function getAllContratos()
  {
    $sql = "SELECT * FROM  tb_contratos";
    $query = $this->db->prepare($sql);
    $query->execute();

    return $query->fetchAll();
  }

  public function getAllClientes()
  {
    $sql = "SELECT * FROM  tb_clientes";
    $query = $this->db->prepare($sql);
    $query->execute();

    return $query->fetchAll();
  }

  public function getAllVendedores()
  {
    $sql = "SELECT * FROM  tb_adm";
    $query = $this->db->prepare($sql);
    $query->execute();

    return $query->fetchAll();
  }

  public function getAllAgencias()
  {
    $sql = "SELECT * FROM  tb_agencias";
    $query = $this->db->prepare($sql);
    $query->execute();

    return $query->fetchAll();
  }

  public function getClienteCnpjByID($id)
  {
    $sql = "SELECT strClienteCNPJ FROM tb_clientes WHERE intClienteID = :id";
    
    $query = $this->db->prepare($sql);
    $parameters = array(':id' => $id);
    $query->execute($parameters);

    return $query->fetch();
  }

  public function getAgenciaCnpjByID($id)
  {
    $sql = "SELECT strAgenciaCNPJ FROM tb_agencias WHERE intAgenciaID = :id";
    
    $query = $this->db->prepare($sql);
    $parameters = array(':id' => $id);
    $query->execute($parameters);

    return $query->fetch();
  }

  public function getAdmNomeByID($id)
  {
    $sql = "SELECT strAdmNome FROM tb_adm WHERE intAdmID = :id";
    
    $query = $this->db->prepare($sql);
    $parameters = array(':id' => $id);
    $query->execute($parameters);

    return $query->fetch();
  }

  public function getContratoByID($id){
    $sql = "SELECT * FROM tb_contratos WHERE intContratoID = :id";
    $query = $this->db->prepare($sql);
    $parameters = array(':id' => $id); 
        
    $query->execute($parameters);
    
    return $query->fetch();
}
}
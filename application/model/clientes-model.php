<?php

class clientesModel
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

    public function getAllClientes() {
        $sql = "SELECT * FROM  tb_clientes WHERE strClienteStatus != 'i'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getAllClientesInactive() {
        $sql = "SELECT c.*, a.* FROM  tb_clientes AS c INNER JOIN tb_adm AS a ON c.intUserAdmID = a.intAdmID WHERE strClienteStatus = 'i'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getAllContasInactive() {
        $sql = "SELECT c.*, cl.*, a.* FROM  tb_contas AS c INNER JOIN tb_clientes AS cl ON c.intClienteID = cl.intClienteID INNER JOIN tb_adm AS a ON c.intAdmID = a.intAdmID WHERE strContaStatus = 'i'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function addCliente($admid, $cnpj, $razao, $fantasia, $agencia, $segmento, $cep, $endereco, $cidade, $estado, $responsavel, $rg,
     $cpf, $contato, $cargo, $email, $telefone, $celular) {
        $sql = "INSERT INTO tb_clientes (intUserAdmID, strClienteCNPJ, strClienteRazao, strClienteFantasia, intAgenciaID, intSegmentoID, 
        strClienteCEP, strClienteEndereco, strClienteCidade, strClienteEstado, strClienteResponsavel, strClienteRg, strClienteCpf, 
        strClienteContato, strClienteContatoCargo, strClienteEmail, strClienteTelefone, strClienteCelular) 
        VALUES (:admid, :cnpj,:razao,:fantasia,:agencia,:segmento,:cep,:endereco,:cidade,:estado,
        :responsavel,:rg,:cpf,:contato,:cargo,:email,:telefone,:celular)";
        $query = $this->db->prepare($sql);
        $parameters = array(':admid' => $admid, ':cnpj' => $cnpj, ':razao' => $razao, ':fantasia' => $fantasia, ':agencia' => $agencia,
        ':segmento' => $segmento, ':cep' => $cep,':endereco' => $endereco, ':cidade' => $cidade, ':estado' => $estado,
        ':responsavel' => $responsavel, ':rg' => $rg, ':cpf' => $cpf, ':contato' => $contato, ':cargo' => $cargo,
        ':email' => $email, ':telefone' => $telefone, ':celular' => $celular);
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
        return true;
    }

    public function editCliente($cnpj, $razao, $fantasia, $agencia, $segmento, $cep, $endereco, $cidade, $estado, $responsavel, $rg,
     $cpf, $contato, $cargo, $email, $telefone, $celular, $id) {
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE tb_clientes SET 
        strClienteCNPJ =:cnpj, 
        strClienteRazao =:razao,
        strClienteFantasia =:fantasia,
        intSegmentoID =:segmento,
        strClienteEndereco =:endereco,
        intAgenciaID =:agencia, 
        strClienteCEP =:cep, 
        strClienteCidade =:cidade,
        strClienteEstado =:estado, 
        strClienteResponsavel =:responsavel,
        strClienteRg =:rg, 
        strClienteCpf =:cpf,
        strClienteContato =:contato,
        strClienteContatoCargo =:cargo,
        strClienteEmail =:email,
        strClienteTelefone =:telefone,
        strClienteCelular =:celular
        WHERE intClienteID =:id";
        $statement = $this->db->prepare($sql);
        try {
            $parameters = array(':cnpj' => $cnpj, ':razao' => $razao, ':fantasia' => $fantasia, ':agencia' =>(int) $agencia,
            ':segmento' =>(int) $segmento, ':cep' => $cep,':endereco' => $endereco, ':cidade' => $cidade, ':estado' => $estado,
            ':responsavel' => $responsavel, ':rg' => $rg, ':cpf' => $cpf, ':contato' => $contato, ':cargo' => $cargo,
            ':email' => $email, ':telefone' => $telefone, ':celular' => $celular, ':id' => (int) $id);

            $statement->execute($parameters);

            return true;
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function getAllClienteNum() {
        $sql = "SELECT * FROM tb_clientes";
        $query = $this->db->prepare($sql);
        $query->execute();
        $number_of_rows = $query->rowCount();
        return $number_of_rows;
    }

    public function getClienteByID($id) {
        $sql = "SELECT * FROM tb_clientes WHERE intClienteID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        // echo mysqli_error($db); exit;
        return $query->fetch();
    }

    public function getClienteByName($fantasia) {
        $sql = "SELECT c.*, a.* FROM tb_clientes AS c INNER JOIN tb_adm AS a ON c.intUserAdmID = a.intUserAdmID WHERE strClienteFantasia LIKE :fantasia";
        $query = $this->db->prepare($sql);
        $parameters = array(':fantasia' => '%'.$fantasia.'%');
        $query->execute($parameters);

        // echo mysqli_error($db); exit;
        return $query->fetchAll();
    }

    public function getAllContas() {
        $sql = "SELECT c.*, cl.*, s.*, a.* FROM tb_contas AS c INNER JOIN tb_clientes AS cl ON c.intClienteID = cl.intClienteID INNER JOIN tb_segmentos AS s ON c.intSegmentoID = s.intSegmentoID LEFT JOIN tb_agencias AS a ON c.intAgenciaID = a.intAgenciaID";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getAllContasByClienteID($id) {
        $sql = "SELECT c.*, cl.*, s.*, a.* FROM tb_contas AS c INNER JOIN tb_clientes AS cl ON c.intClienteID = cl.intClienteID INNER JOIN tb_segmentos AS s ON c.intSegmentoID = s.intSegmentoID LEFT JOIN tb_agencias AS a ON c.intAgenciaID = a.intAgenciaID WHERE c.intClienteID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return $query->fetchAll();
    }

    public function getAllContasByClienteIDforCrm($id) {
        $sql = "SELECT * FROM tb_contas WHERE intClienteID = :id AND strContaStatus != 'i'";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return $query->fetchAll();
    }

    public function addConta($nome, $segmento, $agencia, $contato, $cargo, $email, $telefone, $celular, $cliente, $adm) {
        $sql = "INSERT INTO tb_contas (strContaNome, intSegmentoID, intAgenciaID, strContaContato, strContaContatoCargo, strContaContatoEmail, strContaContatoTelefone, 
        strContaContatoCelular, intClienteID, intAdmID) VALUES (:nome, :segmento, :agencia, :contato, :cargo, :email, :telefone, :celular, :cliente, :adm)";
        $query = $this->db->prepare($sql);
        $parameters = array(':nome' => $nome, ':segmento' => $segmento, ':agencia' => $agencia, ':contato' => $contato, ':cargo' => $cargo, ':email' => $email, ':telefone' => $telefone, 
        ':celular' => $celular, ':cliente' => $cliente, ':adm' => $adm);
        $query->execute($parameters);

        return true;
    }

    public function editConta($nome, $segmento, $agencia, $contato, $cargo, $email, $telefone, $celular, $cliente, $adm, $contaID) {
        $sql = "UPDATE tb_contas SET strContaNome = :nome, intSegmentoID = :segmento, intAgenciaID = :agencia, strContaContato = :contato, strContaContatoCargo = :cargo, 
        strContaContatoEmail = :email, strContaContatoTelefone = :telefone, strContaContatoCelular = :celular, intClienteID = :cliente, intAdmID = :adm WHERE intContaID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':nome' => $nome, ':segmento' => $segmento, ':agencia' => $agencia, ':contato' => $contato, ':cargo' => $cargo, ':email' => $email, ':telefone' => $telefone,
        ':celular' => $celular, ':cliente' => $cliente, ':adm' => $adm, ':id' => $contaID);
        $query->execute($parameters);

        return true;
    }

    public function getContaByID($id) {
        $sql = "SELECT c.*, s.*, a.*, cl.* FROM tb_contas AS c INNER JOIN tb_clientes AS cl ON c.intClienteID = cl.intClienteID INNER JOIN tb_segmentos AS s ON c.intSegmentoID = s.intSegmentoID LEFT JOIN tb_agencias AS a ON c.intAgenciaID = a.intAgenciaID WHERE intContaID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return $query->fetch();
    }

    public function approveClient($id) {
        $sql = "UPDATE tb_clientes SET strClienteStatus = 'a' WHERE intClienteID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return true;
    }

    public function approveAccount($id) {
        $sql = "UPDATE tb_contas SET strContaStatus = 'a' WHERE intContaID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return true;
    }
    public function createInstitucional($client,$adm,$name,$contato,$cargo,$email,$telefone,$celular) {
        $sql = "INSERT INTO tb_contas (strContaNome, intClienteID, intAdmID, strContaStatus, strContaContato, strContaContatoCargo, strContaContatoEmail,
        strContaContatoTelefone, strContaContatoCelular) VALUES (:nome, :cliente, :adm, :stats, :contato, :cargo, :email, :telefone, :celular)";
        $query = $this->db->prepare($sql);
        $parameters = array(':nome' => $name . " Institucional", ':cliente' => $client, ':adm' => $adm, ':stats' => 'a', ':contato' => $contato, ':cargo' => $cargo, ':email' => $email,
        ':telefone' => $telefone, ':celular' => $celular);
        $query->execute($parameters);

        return true;
    }

    public function findApprovalClient()
    {
        $sql = "SELECT COUNT(intClienteID) AS amount_of_songs FROM tb_clientes WHERE strClienteStatus = 'i'";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_songs;
    }

    public function findReproveClient()
    {
        $sql = "SELECT COUNT(intClienteID) AS amount_of_songs FROM tb_clientes WHERE strClienteStatus = 'r'";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_songs;
    }

    public function getReprovedClient() {
        $sql = "SELECT DISTINCT tb_clientes.*,tb_reprove.strReproveReason,tb_reprove.strReproveAdm,tb_reprove.strReproveDateCad FROM tb_clientes INNER JOIN tb_reprove on tb_clientes.intClienteID=tb_reprove.intReproveID WHERE strClienteStatus = 'r'";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function findApprovalAccount()
    {
        $sql = "SELECT COUNT(intClienteID) AS amount_of_songs FROM tb_contas WHERE strContaStatus = 'i'";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_songs;
    }

    public function findTeste()
    {
        $sql = "SELECT COUNT(intTesteID) AS amount_of_songs FROM tb_teste WHERE strTesteStatus = 'r'";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_songs;
    }

    public function getAllTeste() {
        $sql = "SELECT * FROM  tb_teste WHERE strTesteStatus = 'a'";
          $query = $this->db->prepare($sql);
         $query->execute();
  
        return $query->fetchAll();
      }

    public function findReproveAccount()
    {
        $sql = "SELECT COUNT(intClienteID) AS amount_of_songs FROM tb_contas WHERE strContaStatus = 'i'";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_songs;
    }

    public function getReprovedAccount() {
        $sql = "SELECT DISTINCT tb_contas.*,tb_reprove.strReproveReason,tb_reprove.strReproveAdm,tb_reprove.strReproveDateCad FROM tb_contas INNER JOIN tb_reprove on tb_contas.intClienteID=tb_reprove.intReproveID WHERE strContaStatus = 'r'";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function getContaContatoByID($id) {
        $sql = "SELECT strContaContato, strContaContatoEmail, strContaContatoTelefone, strContaContatoCargo FROM tb_contas WHERE intContaID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return $query->fetch();
    }

    public function registerReproveClient($reason,$solicitante,$fantasia,$adm) {
        $sql = "INSERT INTO tb_reprove (strReproveNome, strReproveSolicitante, strReproveAdm, strReproveReason) VALUES (:fantasia,:solicitante,:adm,:reason)";
        $query = $this->db->prepare($sql);
        $parameters = array(':fantasia' => $fantasia,':solicitante' => $solicitante,':adm' => $adm,':reason' => $reason);
        $query->execute($parameters);

        return true;
    }

    public function setReproved($id) {
        $sql = "DELETE FROM tb_clientes WHERE intClienteID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return true;
    }

    public function deleteAllContasByClienteID($id) {
        $sql = "DELETE FROM tb_contas WHERE intClienteID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return true;
    }

    public function deleteContaByID($id) {
        $sql = "DELETE FROM tb_contas WHERE intContaID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return true;
    }

    public function getMyClients($id) {
        $sql = "SELECT * FROM tb_clientes WHERE intUserAdmID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        // echo mysqli_error($db); exit;
        return $query->fetchAll();
    }

    public function getMyContas($id) {
        $sql = "SELECT c.*, cl.*, s.*, a.* FROM tb_contas AS c INNER JOIN tb_clientes AS cl ON c.intClienteID = cl.intClienteID INNER JOIN tb_segmentos AS s ON c.intSegmentoID = s.intSegmentoID INNER JOIN tb_agencias AS a ON c.intAgenciaID = a.intAgenciaID WHERE intAdmID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        // echo mysqli_error($db); exit;
        return $query->fetchAll();
    }

    public function getMyCarteiraContas($id) {
        $sql = "SELECT c.*, cl.* FROM tb_contas AS c INNER JOIN tb_clientes AS cl ON c.intClienteID = cl.intClienteID  WHERE intAdmID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        // echo mysqli_error($db); exit;
        return $query->fetchAll();
    }

    public function checkDuplicated($cnpj) {
        $sql = "SELECT * FROM tb_clientes WHERE strClienteCNPJ = :cnpj";
        $query = $this->db->prepare($sql);
        $parameters = array(':cnpj' => $cnpj);
        $query->execute($parameters);

        // echo mysqli_error($db); exit;
        return $query->fetch();
    }
}

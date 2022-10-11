<?php

class carteiraModel
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

   public function getAllVendors() {
       $sql = "SELECT * FROM tb_adm WHERE intCargoID = 3";
       $query = $this->db->prepare($sql);
       $query->execute();

       return $query->fetchAll();
   }

   public function getAllClientsByVendorID($id) {
    $sql = "SELECT c.*, cl.* FROM tb_carteira AS c INNER JOIN tb_clientes AS cl ON c.intClienteID = cl.intClienteID WHERE c.intAdmID = :id";
    $query = $this->db->prepare($sql);
    $parameters = array(':id' => $id);
    $query->execute($parameters);

    return $query->fetchAll();
   }

   public function getAllAgenciesByVendorID($id) {
    $sql = "SELECT c.*, ag.* FROM tb_carteira AS c INNER JOIN tb_agencias AS ag ON c.intAgenciaID = ag.intAgenciaID WHERE c.intAdmID = :id";
    $query = $this->db->prepare($sql);
    $parameters = array(':id' => $id);
    $query->execute($parameters);

    return $query->fetchAll();
   }

   public function addCarteira($vendor,$cliente,$agencia) {
    $sql = "INSERT INTO tb_carteira (intAdmID, intClienteID, intAgenciaID) VALUES (:adm,:cliente,:agencia)";
    $query = $this->db->prepare($sql);
    $parameters = array(':adm' => $vendor, ':cliente' => $cliente, ':agencia' => $agencia);
    $query->execute($parameters);

    return true;
   }

   public function checkCarteira($type, $id) {
       switch ($type) {
           case 'cl':
               $field = "intClienteID";
               break;
           
           default:
               $field = 'intAgenciaID';
               break;
       }

       $sql = "SELECT * FROM tb_carteira WHERE $field = :id";
       $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return $query->fetch();
   }

   public function mudarCarteiraCliente($cliente,$vendor) {
    $sql = "UPDATE tb_clientes SET intUserAdmID = :vendor WHERE intClienteID = :cliente";
    $query = $this->db->prepare($sql);
    $parameters = array(':vendor' => $vendor, ':cliente' => $cliente);

    $query->execute($parameters);

    return true;
   }

   public function mudarCarteiraConta($cliente,$vendor) {
    $sql = "UPDATE tb_contas SET intAdmID = :vendor WHERE intContaID = :cliente";
    $query = $this->db->prepare($sql);
    $parameters = array(':vendor' => $vendor, ':cliente' => $cliente);

    $query->execute($parameters);

    return true;
   }
}

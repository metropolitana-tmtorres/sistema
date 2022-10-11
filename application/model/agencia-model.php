<?php

class agenciaModel
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

    public function getAllAgencias() {
        $sql = "SELECT * FROM  tb_agencias";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function addAgencia($nome, $email, $telefone, $contato, $cnpj) {
        $sql = "INSERT INTO tb_agencias (strAgenciaNome, strAgenciaEmail, strAgenciaTelefone, strAgenciaContato, strAgenciaCNPJ)
        VALUES (:nome,:email,:telefone,:contato,:cnpj)";
        $query = $this->db->prepare($sql);
        $parameters = array(':nome' => $nome, ':email' => $email, ':telefone' => $telefone, ':contato' => $contato, ':cnpj' => $cnpj);
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);

        return true;
    }

    public function editAgencia($nome, $contato, $email, $telefone, $cnpj, $id) {
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE tb_agencias SET 
        strAgenciaNome =:nome, 
        strAgenciaContato =:contato, 
        strAgenciaEmail =:email,
        strAgenciaTelefone =:telefone, 
        strAgenciaCNPJ =:cnpj
        WHERE intAgenciaID = :id";
        $statement = $this->db->prepare($sql);
        try{
            $parameters = array(':nome' => $nome,':contato' => $contato,
            ':email' => $email, ':telefone' => $telefone, ':cnpj' => $cnpj, ':id' => (int) $id);

            $statement->execute($parameters);

            return true;
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function getAllAgenciaNum() {
        $sql = "SELECT * FROM tb_agencias";
        $query = $this->db->prepare($sql);
        $query->execute();
        $number_of_rows = $query->rowCount();
        return $number_of_rows;
    }

    public function getAgenciaByID($id) {
        $sql = "SELECT * FROM tb_agencias WHERE intAgenciaID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return $query->fetch();
    }

    public function getAgenciaNomeByID($id) {
        $sql = "SELECT strAgenciaNome FROM tb_agencias WHERE intAgenciaID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return $query->fetch()->strAgenciaNome;
    }
    
}

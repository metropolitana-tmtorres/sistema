<?php

class contatosModel
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

    public function getAllContatos() {
        $sql = "SELECT * FROM tb_contatos";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function addContato($nome,$email,$cargo,$telefone,$celular) {
        $sql = "INSERT INTO tb_contatos (strContatoNome,strContatoEmail,strContatoCargo,strContatoTelefone,strContatoCelular)
        VALUES (:nome,:email,:cargo,:telefone,:celular)";
        $query = $this->db->preapre($sql);
        $parameters = array(':nome' => $nome, ':email' => $email, ':cargo' => $cargo, ':telefone' => $telefone, ':celular' => $celular);
        $query->execute($parameters);

        return true;
    }

    public function editContato($nome,$email,$cargo,$telefone,$celular,$id) {
        $sql = "UPDATE tb_contatos SET strContatoNome = :nome, strContatoEmail = :email, strContatoCargo = :cargo, strContatoTelefone = :telefone,
        strContatoCelular = :celular WHERE intContatoID = :id";
        $query = $this->db->preapre($sql);
        $parameters = array(':nome' => $nome, ':email' => $email, ':cargo' => $cargo, ':telefone' => $telefone, ':celular' => $celular, ':id' => $id);
        $query->execute($parameters);

        return true;
    }

    public function delContato($id) {
        $sql = "DELETE FROM tb_contatos WHERE intContatoID = :id";
        $query = $this->db->preapre($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return true;
    }

    public function getContatoByID($id) {
        $sql = "SELECT * FROM tb_contatos WHERE intContatoID = :id";
        $query = $this->db->preapre($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return true;
    }
}

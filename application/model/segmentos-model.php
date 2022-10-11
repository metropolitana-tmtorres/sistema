<?php

class segmentosModel
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

    public function editSegmento($name,$id) {
        $sql = "UPDATE tb_segmentos SET strSegmentoNome = :nome, WHERE intSegmentoID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':nome' => $name, ':id' => $id);
        $query->execute($parameters);

        return true;
    }

    public function registerSegmento($nome) {
        $sql = "INSERT INTO tb_segmentos (strSegmentoNome) VALUES (:nome)";
        $query = $this->db->prepare($sql);
        $parameters = array(':nome' => $nome);
        $query->execute($parameters);

        // return $this->db->lastInsertId();
        return true;
    }

    public function getAllSegmentos() {
        $sql = "SELECT * FROM tb_segmentos ORDER BY strSegmentoNome ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();

    }

    public function deleteSegmento($id) {
        $sql = "DELETE FROM tb_segmentos WHERE intSegmentoID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return true;
    }

    public function getSegmentoNomeByID($id) {
        $sql = "SELECT strSegmentoNome FROM tb_segmentos WHERE intSegmentoID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return $query->fetch()->strSegmentoNome;
    }

    
}

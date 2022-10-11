<?php

class moedasModel
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

    public function editAdm($name,$sinal,$id) {
        $sql = "UPDATE tb_moedas SET strMoedaNome = :aname, strMoedaSign = :sinal WHERE intMoedaID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':aname' => $name, ':sinal' => $sinal, ':id' => $id);
        $query->execute($parameters);

        return true;
    }

    public function registerMoeda($nome,$sinal) {
        $sql = "INSERT INTO tb_moedas (strMoedaNome,strMoedaSign) VALUES (:nome,:sinal)";
        $query = $this->db->prepare($sql);
        $parameters = array(':nome' => $nome, ':sinal' => $sinal);
        $query->execute($parameters);

        // return $this->db->lastInsertId();
        return true;
    }

    public function getAllMoedas() {
        $sql = "SELECT * FROM tb_moedas ORDER BY strMoedaNome ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();

    }

    public function deleteMoeda($id) {
        $sql = "DELETE FROM tb_moedas WHERE intMoedaID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return true;
    }

    
}

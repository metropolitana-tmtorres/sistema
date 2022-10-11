<?php

class perfilModel
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

    public function getPerfilUsuario() {
        $sql = "SELECT * FROM  tb_teste WHERE strTesteStatus = 'i'";
          $query = $this->db->prepare($sql);
          $query->execute();
  
          return $query->fetchAll();
      }
}

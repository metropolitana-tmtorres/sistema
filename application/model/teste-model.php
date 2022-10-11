<?php

class testeModel{
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

    //OBTER TODAS AS INFORMAÇÕES DO BANCO DE DADOS.
    public function getAllInfoTeste()
    {
        $sql = "SELECT intTesteID, strTesteNome, strTesteStatus FROM tb_teste";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    public function getAllTeste() {
        $sql = "SELECT * FROM  tb_teste WHERE strTesteStatus = 'a'";
          $query = $this->db->prepare($sql);
         $query->execute();
  
        return $query->fetchAll();
      }
      public function getAllTesteInactive() {
        $sql = "SELECT * FROM  tb_teste WHERE strTesteStatus = 'i'";
          $query = $this->db->prepare($sql);
          $query->execute();
  
          return $query->fetchAll();
      }

        //CONTAGEM DE REPROVADOS
        public function findTesterReproved()
        {
            $sql = "SELECT COUNT(intTesteID) AS amount_of_songs FROM tb_teste WHERE strTesteStatus = 'r'";
            $query = $this->db->prepare($sql);
            $query->execute();
    
            // fetch() is the PDO method that get exactly one result
            return $query->fetch()->amount_of_songs;
        }

    

}
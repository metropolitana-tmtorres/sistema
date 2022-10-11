<?php

class centroCustosModel
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
    public function consultarCentroCustos()
    {
        $sql = "SELECT * FROM tb_centro_custos";           
        $query = $this->db->prepare($sql);    
        $query->execute();     
        $CentroCustos = $query->fetchAll(); 

        return $CentroCustos;
    }
    public function consultarMeusCentroCustos($intAdmID)
    {
        $sql = "SELECT * FROM tb_centro_custos WHERE intAdmID=:intAdmID";           
        $query = $this->db->prepare($sql);    
        $query->execute([':intAdmID'=>$intAdmID]);     
        $CentroCustos = $query->fetchAll(); 

        return $CentroCustos;
    }
    public function cadastrarCentroCustos($nome,$desc,$intAdmID)
    {
        $sql = "INSERT INTO tb_centro_custos (strCentroCustosNome,strCentroCustosDesc,intAdmID) VALUES(:nome,:desc,:intAdmID)";           
        $query = $this->db->prepare($sql);    
        $parameters=[
            ':nome'=>$nome,
            ':desc'=>$desc,
            ':intAdmID'=>$intAdmID
        ];
        $query->execute($parameters);  
        return true;      
    }
    public function editarCentroCustos($nome,$desc,$id)
    {
        $sql = "UPDATE tb_centro_custos SET strCentroCustosNome=:nome ,strCentroCustosDesc= :desc WHERE intCentroCustosID = :id";           
        $query = $this->db->prepare($sql);    
        $parameters=[
            ':nome'=>$nome,
            ':desc'=>$desc,
            ':id'=>$id
        ];
        $query->execute($parameters);  
        return json_encode(['success'=>true]); 
    }
    public function excluirCentroCustos($id)
    {
        $sql = "DELETE FROM tb_centro_custos WHERE intCentroCustosID = :id";           
        $query = $this->db->prepare($sql);    
        $parameters=[
            ':id'=>$id           
        ];
        $query->execute($parameters);  
        return true;      
    }   
}

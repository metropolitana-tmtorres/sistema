<?php

class planoContasModel
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
    public function consultarPlanoContas()
    {
        $sql = "SELECT * FROM tb_plano_contas";           
        $query = $this->db->prepare($sql);    
        $query->execute();     
        $PlanoContas = $query->fetchAll(); 

        return $PlanoContas;
    }
    public function consultarMeusPlanoContas($intAdmID)
    {
        $sql = "SELECT * FROM tb_plano_contas WHERE intAdmID=:intAdmID";           
        $query = $this->db->prepare($sql);    
        $query->execute();     
        $PlanoContas = $query->fetchAll([':intAdmID'=>$intAdmID]); 

        return $PlanoContas;
    }
    public function cadastrarPlanoContas($nome,$desc,$intAdmID)
    {
        $sql = "INSERT INTO tb_plano_contas (strPlanoContasNome,strPlanoContasDesc,intAdmID) VALUES(:nome,:desc,:intAdmID)";           
        $query = $this->db->prepare($sql);    
        $parameters=[
            ':nome'=>$nome,
            ':desc'=>$desc,
            ':intAdmID'=>$intAdmID
        ];
        $query->execute($parameters);  
        return true;      
    }
    public function editarPlanoContas($nome,$desc,$id)
    {
        $sql = "UPDATE tb_plano_contas SET strPlanoContasNome=:nome ,strPlanoContasDesc=:desc WHERE intPlanoContasID = :id";           
        $query = $this->db->prepare($sql);    
        $parameters=[
            ':nome'=>$nome,
            ':desc'=>$desc,
            ':id'=>$id
        ];
        $query->execute($parameters);  
        return json_encode(['success'=>true]); 
    }
    public function excluirPlanoContas($id)
    {
        $sql = "DELETE FROM tb_plano_contas WHERE intPlanoContasID = :id";           
        $query = $this->db->prepare($sql);    
        $parameters=[
            ':id'=>$id           
        ];
        $query->execute($parameters);  
        return true;      
    }   
}

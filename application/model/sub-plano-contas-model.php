<?php

class SubPlanoContasModel
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
    public function consultarSubPlanoContas($id)
    {   
        $idtext='';
        if($id!=null)
            $idtext="WHERE tb_sub_plano_contas.intPlanoContasID=$id"; 
        $sql = "SELECT distinct intSubPlanoContasID,strSubPlanoContasNome,strSubPlanoContasDesc,strPlanoContasNome FROM tb_sub_plano_contas INNER JOIN tb_plano_contas ON tb_plano_contas.intPlanoContasID=tb_sub_plano_contas.intPlanoContasID  $idtext";           
        $query = $this->db->prepare($sql);    
        $query->execute();     
        $SubPlanoContas = $query->fetchAll(); 

        return $SubPlanoContas;
    }
    public function consultarMeusSubPlanoContas($id,$intAdmID)
    {   
        $idtext='';
        if($id!=null)
            $idtext="tb_sub_plano_contas.intPlanoContasID=$id"; 
        $sql = "SELECT distinct intSubPlanoContasID,strSubPlanoContasNome,strSubPlanoContasDesc,strPlanoContasNome FROM tb_sub_plano_contas INNER JOIN tb_plano_contas ON tb_plano_contas.intPlanoContasID=tb_sub_plano_contas.intPlanoContasID WHERE intAdmID=:intAdmID  $idtext";           
        $query = $this->db->prepare($sql);    
        $query->execute([':intAdmID'=>$intAdmID]);     
        $SubPlanoContas = $query->fetchAll(); 

        return $SubPlanoContas;
    }
    public function cadastrarSubPlanoContas($nome,$desc,$planoContasID,$intAdmID)
    {
        $sql = "INSERT INTO tb_sub_plano_contas (strSubPlanoContasNome,strSubPlanoContasDesc,intPlanoContasID,intAdmID) VALUES(:nome,:desc,:planoContasID,:intAdmID)";   
                
        $query = $this->db->prepare($sql);    
        $parameters=[
            ':nome'=>$nome,
            ':desc'=>$desc,
            ':planoContasID'=>$planoContasID,
            ':intAdmID'=>$intAdmID
        ];
        $query->execute($parameters);  
        return true;      
    }
    public function editarSubPlanoContas($nome,$desc,$id,$planoContasID)
    {
        $sql = "UPDATE tb_sub_plano_contas SET strSubPlanoContasNome=:nome ,strSubPlanoContasDesc=:desc , intPlanoContasID=:planoContasID WHERE intSubPlanoContasID = :id";           
        $query = $this->db->prepare($sql);    
        $parameters=[
            ':nome'=>$nome,
            ':desc'=>$desc,
            ':id'=>$id,
            ':planoContasID'=>$planoContasID
        ];
        $query->execute($parameters);  
        return json_encode(['success'=>true]); 
    }
    public function excluirSubPlanoContas($id)
    {
        $sql = "DELETE FROM tb_sub_plano_contas WHERE intSubPlanoContasID = :id";           
        $query = $this->db->prepare($sql);    
        $parameters=[
            ':id'=>$id           
        ];
        $query->execute($parameters);  
        return true;      
    }   
}

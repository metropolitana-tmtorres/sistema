<?php

class contasAPagarModel
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
    public function generateInStatement($array){
        $inText=[0];
        foreach($array as $value){
            $inText[]="'{$value}'";
        }
        return implode(',',$inText);
    }
    public function consultarContasAPagar($mesRef,$anoRef,$status,$CentroCustosIDS,$PlanosContasIDS)
    {
        $CentroCustosText=$this->generateInStatement(explode(",",$CentroCustosIDS));
        $statusText=$this->generateInStatement(explode(",",$status));
        $contasintSubPlanoContasID='';
        $contasintCentroCustosID='';
        $contasstrContasAPagarStatus='';
        if(!$PlanosContasIDS=='')
            $contasintSubPlanoContasID="AND tb_contas_a_pagar.intSubPlanoContasID IN ({$PlanosContasIDS})";
        if(!$CentroCustosIDS=='')
            $contasintCentroCustosID="AND rel_centro_custos_contas_a_pagar.intCentroCustosID IN ({$CentroCustosText})";
        if(!$status=='')
            $contasstrContasAPagarStatus=" AND strContasAPagarStatus IN ( {$statusText} )";

        $sql = "SELECT distinct tb_contas_a_pagar.intContasAPagarID,strContasAPagarNome,strContasAPagarVencimento,strContasAPagarDesc,decContasAPagarValor,strContasAPagarStatus,intContasAPagarAnoRef,intContasAPagarMesRef,tb_contas_a_pagar.intSubPlanoContasID,
        GROUP_CONCAT(DISTINCT rel_centro_custos_contas_a_pagar.intCentroCustosID
                    ORDER BY  tb_contas_a_pagar.intContasAPagarID ASC SEPARATOR ',') as intCentroCustosID
                FROM tb_contas_a_pagar 
                INNER JOIN rel_centro_custos_contas_a_pagar 
                ON tb_contas_a_pagar.intContasAPagarID = rel_centro_custos_contas_a_pagar.intContasAPagarID 
                {$contasintSubPlanoContasID}
                {$contasintCentroCustosID}                
                WHERE intContasAPagarAnoRef = :ano 
                AND intContasAPagarMesRef = :mes 
                {$contasstrContasAPagarStatus}  
                GROUP BY tb_contas_a_pagar.intContasAPagarID             
                ";           
        $query = $this->db->prepare($sql); 
        $parameters=[
            ':mes'=>$mesRef,
            ':ano'=>$anoRef                               
        ];   
        $query->execute($parameters);    
        $contas = $query->fetchAll(); 
        

        return $contas;
    }
    public function cadastrarContaAPagar($strContasAPagarNome,$strContasAPagarVencimento,$decContasAPagarValor,$strContasAPagarDesc,$strContasAPagarStatus,$intContasAPagarMesRef,$intContasAPagarAnoRef,$CentroCustosIDS,$PlanosContas,$intAdmID)
    {
        $sql = "INSERT INTO tb_contas_a_pagar (strContasAPagarNome,strContasAPagarVencimento,strContasAPagarDesc,decContasAPagarValor,strContasAPagarStatus,intContasAPagarMesRef,intContasAPagarAnoRef,intSubPlanoContasID,intAdmID) VALUES(:strContasAPagarNome,:strContasAPagarVencimento,:strContasAPagarDesc,:decContasAPagarValor,:strContasAPagarStatus,:intContasAPagarMesRef,:intContasAPagarAnoRef,:intSubPlanoContasID,:intAdmID)";           
        $query = $this->db->prepare($sql);    
        $parameters=[
            ':strContasAPagarNome'=>$strContasAPagarNome,
            ':strContasAPagarVencimento'=>$strContasAPagarVencimento,
            ':strContasAPagarDesc'=>$strContasAPagarDesc,
            ':decContasAPagarValor'=>$decContasAPagarValor,
            ':strContasAPagarStatus'=>$strContasAPagarStatus,
            ':intContasAPagarMesRef'=>$intContasAPagarMesRef,
            ':intContasAPagarAnoRef'=>$intContasAPagarAnoRef,
            ':intSubPlanoContasID'=>$PlanosContas,
            ':intAdmID'=>$intAdmID
        ];
        $query->execute($parameters);  
        $contaId=$this->db->lastInsertId();
        foreach($CentroCustosIDS as $CentroCustos){
            $sql = "INSERT INTO rel_centro_custos_contas_a_pagar (intCentroCustosID,intContasAPagarID) VALUES(:intCentroCustosID,:intContasAPagarID)";           
            $query = $this->db->prepare($sql);    
            $parameters=[
                ':intCentroCustosID'=>$CentroCustos,
                ':intContasAPagarID'=>$contaId               
            ];
            $query->execute($parameters);  
        }
        return json_encode(['success'=>true]);       
    }
    public function editarContasAPagar($strContasAPagarNome,$strContasAPagarVencimento,$decContasAPagarValor,$strContasAPagarDesc,$strContasAPagarStatus,$intContasAPagarMesRef,$intContasAPagarAnoRef,$CentroCustosIDS,$PlanosContas,$contaId)
    {
        $sql = "UPDATE tb_contas_a_pagar SET 
                strContasAPagarNome = :strContasAPagarNome , 
                strContasAPagarVencimento = :strContasAPagarVencimento , 
                strContasAPagarDesc = :strContasAPagarDesc, 
                decContasAPagarValor = :decContasAPagarValor, 
                strContasAPagarStatus = :strContasAPagarStatus , 
                intContasAPagarMesRef = :intContasAPagarMesRef , 
                intContasAPagarAnoRef = :intContasAPagarAnoRef,
                intSubPlanoContasID = :intSubPlanoContasID
                WHERE intContasAPagarID = :id";          
        $query = $this->db->prepare($sql);    
        $parameters=[
            ':strContasAPagarNome'=>$strContasAPagarNome,
            ':strContasAPagarVencimento'=>$strContasAPagarVencimento,
            ':strContasAPagarDesc'=>$strContasAPagarDesc,
            ':decContasAPagarValor'=>$decContasAPagarValor,
            ':strContasAPagarStatus'=>$strContasAPagarStatus,
            ':intContasAPagarMesRef'=>$intContasAPagarMesRef,
            ':intContasAPagarAnoRef'=>$intContasAPagarAnoRef,
            ':intSubPlanoContasID'=>$PlanosContas,
            ':id'=>$contaId
        ];
        $query->execute($parameters);  

        $sql = "DELETE FROM rel_centro_custos_contas_a_pagar WHERE intContasAPagarID = :id";           
        $query = $this->db->prepare($sql);   
        $parameters=[
            ':id'=>$contaId            
        ]; 
        $query->execute($parameters);  


        foreach($CentroCustosIDS as $CentroCustos){
            $sql = "INSERT INTO rel_centro_custos_contas_a_pagar (intCentroCustosID,intContasAPagarID) VALUES(:intCentroCustosID,:intContasAPagarID)";           
            $query = $this->db->prepare($sql);    
            $parameters=[
                ':intCentroCustosID'=>$CentroCustos,
                ':intContasAPagarID'=>$contaId               
            ];
            $query->execute($parameters);  
        }


        return json_encode(['success'=>true]); 
    }
    public function excluirConta($id)
    {
        $parameters=[
            ':id'=>$id           
        ];
        $sql = "DELETE FROM rel_centro_custos_contas_a_pagar WHERE intContasAPagarID = :id";           
        $query = $this->db->prepare($sql);    
        $query->execute($parameters);        
        $sql = "DELETE FROM tb_contas_a_pagar WHERE intContasAPagarID = :id";           
        $query = $this->db->prepare($sql);    
        $query->execute($parameters); 
        return true;      
    }   
}

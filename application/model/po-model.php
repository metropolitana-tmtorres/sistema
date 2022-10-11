<?php

class poModel
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

    public function addPo($cliente,$status,$crm,$validade,$prazo,$podate,$intContaID) {
        $sql = "INSERT INTO tb_po (intClienteID,strPoStatus,intCrmID,strPoValidade,strPoPrazo, strPoDate,intContaID)
        VALUES (:cliente,:stats,:crm,:validade,:prazo,:podate,:intContaID)";
        $query = $this->db->prepare($sql);
        $parameters = array(':cliente' => $cliente,':stats' => $status, ':crm' => $crm, ':validade' => $validade, ':prazo' => $prazo, ':podate' => $podate,':intContaID'=>$intContaID);
        $query->execute($parameters);

        return true;
    }

    public function editPo($cliente,$status,$crm,$validade,$prazo,$podate,$id) {
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE tb_po 
        SET intClienteID = :cliente, 
        strPoStatus = :stats, 
        intCrmID = :crm, 
        strPoDate = :podate,
        strPoValidade = :validade, 
        strPoPrazo = :prazo 
        WHERE intPoID = :id";
        $statement = $this->db->prepare($sql);
        try{
            $parameters = array(':cliente' => (int) $cliente,':stats' => $status, 
            ':crm' => (int) $crm, ':validade' => $validade, ':prazo' => $prazo, 
            ':podate' => $podate,':id' => (int) $id);
            $statement->execute($parameters);
    
            return true;
        }catch(Exception $ex){
            var_dump($ex->getMessage());
        }
    }
    public function addPoData($poId,$item,$espec,$topic,$data,$fornecedor,$qtd,$moeda,$unit,$cotacao,$total,$totalrs,$pagamento,$prazoprod) {
        $sql = "INSERT INTO tb_po_data (intPoID,strPoDataItem,strPoDataEspecificacao,strPoDataTopico,
        strPoDataData,intFornecedorID,intPoDataQtd,intMoedaID,strPoDataValorUnitario,strPoDataCotacao,
        strPoDataValorTotal,strPoDataValorTotalRs,strPoDataFormaPagamento,strPoDataPrazoProd,intContaID)
        VALUES (:po,:item,:espec,:topic,:datas,:fornecedor,:qtd,:moeda,:unit,:cotacao,
        :total,:totalrs,:pagamento,:prazoprod)";
        $query = $this->db->prepare($sql);
        $parameters = array(':po' => $poId, ':item' => $item, ':espec' => $espec, 
        ':topic' => $topic, ':datas' => $data, ':fornecedor' => $fornecedor, ':qtd' => $qtd, ':moeda' => $moeda, 
        ':unit' => $unit, ':cotacao' => $cotacao, ':total' => $total, ':totalrs' => $totalrs, 
        ':pagamento' => $pagamento, ':prazoprod' => $prazoprod);
        $query->execute($parameters);

        return true;
    }

    public function editPoData($poId,$item,$espec,$topic,$data,$fornecedor,$qtd,$moeda,$unit,$cotacao,$total,$totalrs,$pagamento,$prazoprod,$id,$intContaID) {
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE tb_po_data 
        SET intPoID = :po, 
        strPoDataItem = :item, 
        strPoDataEspecificacao = :espec, 
        strPoDataTopico = :topic,
        strPoDataData = :datas, 
        intFornecedorID = :fornecedor,
        intPoDataQtd = :qtd,
        intMoedaID = :moeda,
        strPoDataValorUnitario = :unit,
        strPoDataCotacao = :cotacao,
        strPoDataValorTotal = :total,
        strPoDataValorTotalRs = :totalrs,
        strPoDataFormaPagamento = :pagamento,
        strPoDataPrazoProd = :prazoprod
        intContaID = :intContaID
        WHERE intPoDataID = :id";
        $statement = $this->db->prepare($sql);
        try{
            $parameters = array(':po' => $poId, ':item' => $item, ':espec' => $espec, 
            ':topic' => $topic, ':datas' => $data, ':fornecedor' => $fornecedor, ':qtd' => $qtd, ':moeda' => $moeda ,
            ':unit' => $unit, ':cotacao' => $cotacao, ':total' => $total, ':totalrs' => $totalrs, 
            ':pagamento' => $pagamento, ':prazoprod' => $prazoprod, ':id' => (int) $id,':intContaID'=>$intContaID);
            $statement->execute($parameters);
    
            return true;
        }catch(Exception $ex){
            var_dump($ex->getMessage());
        }
    }
    
    public function deletePoDataById($id)
    {
        $sql = "DELETE FROM tb_po_data WHERE intPoDataID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return true;
    }

    public function editPoStatus($status,$id) {
        $sql = "UPDATE tb_po SET strPoStatus = :stats WHERE intPoID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':stats' => $status, ':id' => $id);
        $query->execute($parameters);

        return true;
    }

    public function getAllPo(){
        $sql = "SELECT tb_po.*,tb_contas.*,tb_clientes.* FROM  tb_po inner join tb_contas on tb_po.intContaID=tb_contas.intContaID inner join tb_clientes on tb_po.intClienteID=tb_contas.intClienteID";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getAllPoData(){
        $sql = "SELECT * FROM  tb_po_data";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    } 

    public function getPoByID($id){
        $sql = "SELECT * FROM tb_po WHERE intPoID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id); 
            
        $query->execute($parameters);
        
        return $query->fetch();
    }

    public function getPoDataByID($id){
        $sql = "SELECT * FROM tb_po_data WHERE intPoDataID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id); 
            
        $query->execute($parameters);
        
        return $query->fetch();
    }

    public function getClienteNameByPoID($id){
        $sql = "SELECT strClienteFantasia
        FROM  tb_clientes
        WHERE intClienteID = :id ";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id); 
            
        $query->execute($parameters);
        
        return $query->fetch();
    }

    public function getFornecedorNomeByPoID($id){
        $sql = "SELECT strFornecedorNome
        FROM  tb_fornecedor
        WHERE intFornecedorID = :id ";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id); 
            
        $query->execute($parameters);
        
        return $query->fetch();
    }

    public function getMoedaByPoId($id)
    {
        $sql = "SELECT *
        FROM  tb_moedas
        WHERE intMoedaID = :id ";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id); 
            
        $query->execute($parameters);
        
        return $query->fetch();
    }

    public function getAllMoedas()
    {
        $sql = "SELECT * FROM  tb_moedas";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getAllFornecedores()
    {
        $sql = "SELECT * FROM  tb_fornecedor";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getAllClientes(){
        $sql = "SELECT * FROM  tb_clientes";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getAllClientesAccounts($intClienteID)
    {
        $sql = "SELECT * FROM  tb_contas WHERE intClienteID=:intClienteID";
        $query = $this->db->prepare($sql);
        $query->execute([':intClienteID'=>$intClienteID]);

        return $query->fetchAll();
    }

    public function getAllCrm(){
        $sql = "SELECT * FROM  tb_crm";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getCrmNameByPoID($id){
        $sql = "SELECT strCrmFantasia
        FROM  tb_crm
        WHERE intCrmID = :id ";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id); 
            
        $query->execute($parameters);
        
        return $query->fetch();
    }

    public function getAllPoStatus() {
        $sql = "SELECT * FROM tb_po ORDER BY strPoStatus ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();

    }
}

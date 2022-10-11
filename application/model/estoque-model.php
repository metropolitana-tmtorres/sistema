<?php

class estoqueModel
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

    public function addEstoque($cliente,$produto,$qtd,$validade,$setor,$fila,$caixa,$obs) {
        $sql = "INSERT INTO tb_estoque (strEstoqueCliente,strEstoqueNomeProduto,intEstoqueQtd,strEstoqueValidade,strEstoqueObs,strEstoqueSetor,strEstoqueFila,strEstoqueCaixa)
        VALUES (:cliente,:produto,:qtd,:validade,:obs,:setor,:fila,:caixa)";
        $query = $this->db->prepare($sql);
        $parameters = array( ':cliente' => $cliente, ':produto' => $produto, ':qtd' => $qtd, ':validade' => $validade, ':obs' => $obs, ':setor' => $setor, ':fila' => $fila, ':caixa' => $caixa);
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
        // echo mysqli_error($conn); exit;

        return true; 
    }

    public function editFornecedor($nome, $email, $telefone, $contato, $id) {
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE tb_fornecedor SET 
        strEstoqueCliente =:cliente, 
        strEstoqueNomeProduto =:produto,
        intEstoqueQtd =:qtd, 
        strEstoqueValidade =:validade,
        strEstoqueObs =:obs,
        strEstoqueSetor =:setor,
        strEstoqueFila =:fila,
        strEstoqueCaixa =:caixa
        WHERE intFornecedorID = :id";
        $statement = $this->db->prepare($sql);
        try{
            $parameters = array(':cliente' => $cliente, ':produto' => $produto, 
            ':qtd' => $qtd, ':validade' => $validade, ':obs' => $obs, ':setor' => $setor, 
            ':fila' => $fila, ':caixa' => $caixa, ':id' => (int) $id);

            $statement->execute($parameters);

            return true;
        } catch (Exception $ex){
            var_dump($ex->getMessage());
        }   
    }

    public function getAllEstoque() {
        $sql = "SELECT * FROM tb_estoque";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getAllEstoqueNum() {
        $sql = "SELECT * FROM tb_estoque";
        $query = $this->db->prepare($sql);
        $query->execute();
        $number_of_rows = $query->rowCount();
        return $number_of_rows;
    }

    public function getEstoqueByID($id) {
        $sql = "SELECT * FROM tb_estoque WHERE intEstoqueID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return $query->fetch();
    }

    public function getSaidasByProdutoID($id) {
        $sql = "SELECT * FROM tb_estoque_saida WHERE intEstoqueID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);

        return $query->fetchAll();
    }

    public function getEntradasByProdutoID($id) {
        $sql = "SELECT * FROM tb_estoque_entrada WHERE intEstoqueID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);

        return $query->fetchAll();
    }

    public function registrarSaida($retirou,$entregou,$estoqueID,$obs,$qtd) {
        $sql = "INSERT INTO tb_estoque_saida (strEstoqueRetirou,intAdmID,intEstoqueID,strEstoqueRetiradaObs,intEstoqueRetiradaQtd)
        VALUES (:retirou,:entregou,:estoqueID,:obs,:qtd)";
        $query = $this->db->prepare($sql);
        $parameters = array(':retirou' => $retirou, ':entregou' => $entregou, ':estoqueID' => $estoqueID, ':obs' => $obs, ':qtd' => $qtd);
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
        // echo mysqli_error($conn); exit;

        return true;
    }

    public function registrarEntrada($retirou,$entregou,$estoqueID,$obs,$qtd) {
        $sql = "INSERT INTO tb_estoque_entrada (strEstoqueEntregou,intAdmID,intEstoqueID,strEstoqueEntregaObs,intEstoqueEntradaQtd)
        VALUES (:retirou,:entregou,:estoqueID,:obs,:qtd)";
        $query = $this->db->prepare($sql);
        $parameters = array(':retirou' => $retirou, ':entregou' => $entregou, ':estoqueID' => $estoqueID, ':obs' => $obs, ':qtd' => $qtd);
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
        // echo mysqli_error($conn); exit;

        return true;
    }

    public function atualizaEstoque($produto,$qtd,$num)
    {
        if($num == 1) {
            $sql = "UPDATE tb_estoque SET intEstoqueQtd = intEstoqueQtd - :qtd WHERE intEstoqueID = :produto";
        }else{
            $sql = "UPDATE tb_estoque SET intEstoqueQtd = intEstoqueQtd + :qtd WHERE intEstoqueID = :produto";
        }

        $query = $this->db->prepare($sql);
        $parameters = array(':produto' => $produto, ':qtd' => $qtd);

        $query->execute($parameters);

        return true;
    }

    public function getEstoqueEntregaObsByEstoqueEntradaID($id)
    {
        $sql = "SELECT DISTINCT strEstoqueEntregaObs FROM tb_estoque_entrada WHERE intEstoqueEntradaID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);

        return $query->fetch();
    }

    public function getEstoqueEntregaObsByEstoqueSaidaID($id)
    {
        $sql = "SELECT DISTINCT strEstoqueRetiradaObs FROM tb_estoque_saida WHERE intEstoqueSaida = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);

        return $query->fetch();
    }
}

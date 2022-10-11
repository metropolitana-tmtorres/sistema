<?php

class produtosModel
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

    // CATEGORIAS DE PRODUTOS
    public function getAllProductCateg() {
        $sql = "SELECT * FROM tb_produtos_categ ORDER BY strProdutoCategNome ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function addProdCateg($categoria) {
        $sql = "INSERT INTO tb_produtos_categ (strProdutoCategNome) VALUES (:categoria)";
        $query = $this->db->prepare($sql);
        $parameters = array(':categoria' => $categoria);
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
        return true;
    }

    public function getProdCategById($id) {
        $sql = "SELECT * FROM tb_produtos_categ WHERE intProdutoCategID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);

        return $query->fetch();
    }

    public function editProdCateg($cname,$id) {
        $sql = "UPDATE tb_produtos_categ SET strProdutoCategNome = :cname WHERE intProdutoCategID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':cname' => $cname, ':id' => $id);

        $query->execute($parameters);

        return true;
    }

    public function excProdCateg($id) {
        $sql = "DELETE FROM tb_produtos_categ WHERE intProdutoCategID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);

        return true;
    }


    // PRODUTOS
    public function getAllProdutos() {
        $sql = "SELECT p.*, c.* FROM  tb_produtos AS p INNER JOIN tb_produtos_categ AS c ON p.intProdutoCategID = c.intProdutoCategID";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    
    public function getProdutoById($id) {
        $sql = "SELECT p.*, c.* FROM  tb_produtos AS p INNER JOIN tb_produtos_categ AS c ON p.intProdutoCategID = c.intProdutoCategID WHERE intProdutoID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return $query->fetch();
    }

    public function addProduto($produto,$categoria,$desc,$val) {
        $sql = "INSERT INTO tb_produtos (strProdutoNome,intProdutoCategID,strProdutoDesc,strProdutoVal) VALUES (:produto,:categoria,:descricao,:val)";
        $query = $this->db->prepare($sql);
        $parameters = array(':produto' => $produto, ':categoria' => $categoria, ':descricao' => $desc, ':val' => $val);
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
        return true;
    }

    public function editProduto($produto,$categoria,$desc,$val,$id) {
        $sql = "UPDATE tb_produtos SET strProdutoNome = :produto,intProdutoCategID = :categoria,strProdutoDesc = :descricao,strProdutoVal = :val WHERE intProdutoID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':produto' => $produto, ':categoria' => $categoria, ':descricao' => $desc, ':val' => $val,':id' => $id);
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
        return true;
    }

    public function delProduto($id) {
        $sql = "DELETE FROM tb_produtos WHERE intProdutoID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
        return true;
    }

    // PACOTES DE PRODUTOS
    public function getAllPacotes() {
        $sql = "SELECT * FROM  tb_pacotes ORDER BY strPacoteNome ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getPacoteById($id) {
        $sql = "SELECT * FROM tb_pacotes WHERE intPacoteID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return $query->fetch();
    }

    public function addPacote($pacote) {
        $sql = "INSERT INTO tb_pacotes (strPacoteNome) VALUES (:pacote)";
        $query = $this->db->prepare($sql);
        $parameters = array(':pacote' => $pacote);
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
        return true;
    }

    public function editarPacote($pacote,$id) {
        $sql = "UPDATE tb_pacotes SET strPacoteNome = :pacote WHERE intPacoteID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':pacote' => $pacote, ':id' => $id);
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
        return true;
    }

    public function delPacote($id) {
        $sql = "DELETE FROM tb_pacotes WHERE intPacoteID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
        return true;
    }

    public function addProdutoPacote($pacote,$produto,$qtd) {
        $sql = "INSERT INTO tb_produtos_pacotes (intPacoteID,intProdutoID,intPacoteProdutoQtd) VALUES (:pacote,:produto,:qtd)";
        $query = $this->db->prepare($sql);
        $parameters = array(':pacote' => $pacote, ':produto' => $produto, ':qtd' => $qtd);
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
        return true;
    }

    public function getAllProdutosByPacoteID($id) {
        $sql = "SELECT pp.*, p.* FROM tb_produtos_pacotes AS pp INNER JOIN tb_produtos AS p ON pp.intProdutoID = p.intProdutoID WHERE intPacoteID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return $query->fetchAll();
    }
    
    public function excluirProdutoPacote($id) {
        $sql = "DELETE FROM tb_produtos_pacotes WHERE intProdutoPacoteID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
        return true;
    }

    public function getProductPrice($id) {
        $sql = "SELECT strProdutoVal FROM tb_produtos WHERE intProdutoID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return $query->fetch();
    }
}

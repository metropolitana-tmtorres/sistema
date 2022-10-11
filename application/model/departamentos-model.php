<?php

class departamentosModel
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

    public function getAllDepartamentos() {
        $sql = "SELECT * FROM  tb_departamentos";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function addDepartamento($nome) {
        $sql = "INSERT INTO tb_departamentos (strDepartamentoNome) VALUES (:nome)";
        $query = $this->db->prepare($sql);
        $parameters = array(':nome' => $nome);
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
        return true;
    }

    public function editCliente($cnpj, $razao, $fantasia, $agencia, $segmento, $cep, $endereco, $cidade, $estado, $responsavel, $rg,
     $cpf, $contato, $cargo, $email, $telefone, $celular, $id) {
        $sql = "UPDATE tb_departamentos SET strClienteCNPJ = ':cnpj', strClienteRazao = ':razao',
        strClienteFantasia = ':fantasia', intSegmentoID = ':segmento', strClienteEndereco = ':endereco', intCidadeID = ':cidade',
        intEstadoID = ':estado' WHERE intClienteID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':cnpj' => $cnpj, ':razao' => $razao, ':fantasia' => $fantasia, ':segmento' => $segmento, 
        ':endereco' => $endereco, ':cidade' => $cidade, ':estado' => $estado, ':id' => $id);

        $query->execute($parameters);

        return true;
    }

    public function getAllClienteNum() {
        $sql = "SELECT * FROM tb_departamentos";
        $query = $this->db->prepare($sql);
        $query->execute();
        $number_of_rows = $query->rowCount();
        return $number_of_rows;
    }

    public function getDepartamentoByID($id) {
        $sql = "SELECT * FROM tb_departamentos WHERE intDepartamentoID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        // echo mysqli_error($db); exit;
        return $query->fetch();
    }
    
}

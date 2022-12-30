<?php

class fornecedorModel
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

   /* public function getExportDados()
    {
        $sql = "SELECT * FROM  tb_fornecedor WHERE strFornecedorStatus = 'a'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }*/

    public function getAllFornecedores()
    {
        $sql = "SELECT * FROM  tb_fornecedor WHERE strFornecedorStatus = 'a'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getAllFornecedoresInactive()
    {
        $sql = "SELECT * FROM  tb_fornecedor WHERE strFornecedorStatus = 'i'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getMyFornecedores($intAdmID)
    {
        $sql = "SELECT * FROM  tb_fornecedor WHERE strFornecedorStatus = 'a' AND intAdmID=:intAdmID";
        $query = $this->db->prepare($sql);
        $query->execute([':intAdmID' => $intAdmID]);

        return $query->fetchAll();
    }
    public function getReprovedFornecedores()
    {
        $sql = "SELECT DISTINCT tb_fornecedor.*,tb_reprove.strReproveReason,tb_reprove.strReproveAdm,tb_reprove.strReproveDateCad FROM  tb_fornecedor INNER JOIN tb_reprove ON tb_fornecedor.intFornecedorID=tb_reprove.intFornecedorID WHERE strFornecedorStatus = 'r' ";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function addFornecedor($nome, $email, $telefone, $contato, $vip,$cnpj,$razao,$fantasia,$endereco,$complemento,$cidade,$uf,$banco,$agencia,$conta,$fav,$rg,$cpf,
                                  $nascimento,$valor,$cep,$vt,$vr,$planoMedico,$extra,$descontoVT,$cargoId,$obs,$po,$fileFornecedorCPF,$fileFornecedorRG,$fileFornecedorComprovanteEndereço,$fileFornecedorContratoSocial,$fileFornecedorCartãoCNPJ,$fileFornecedorContratoPrestação) {


        $sql = "INSERT INTO tb_fornecedor (
            strFornecedorNome,
            strFornecedorEmail,
            strFornecedorTelefone, 
            strFornecedorContato,
            strFornecedorVip,
            strFornecedorCnpj,
            strFornecedorRazao,
            strFornecedorFantasia,
            strFornecedorEndereco,
            strFornecedorComplemento,
            strFornecedorCidade,
            strFornecedorEstado,
            strFornecedorBanco,
            strFornecedorAgencia,
            strFornecedorConta,
            strFornecedorFavorecido,
            strFornecedorRg,
            strFornecedorCpf,
            strFornecedorNascimento,
            strFornecedorValor,
            strFornecedorCep,
            strFornecedorVT,
            strFornecedorVR,
            strFornecedorPlanoMedico,
            strFornecedorExtra,
            intFornecedorDescontoVT,
            intCargoID,strFornecedorObservacoes,
            strFornecedorPlanoOdontologico,
            fileFornecedorCPF,
            fileFornecedorRG,
            fileFornecedorComprovanteEndereço,
            fileFornecedorContratoSocial,
            fileFornecedorCartãoCNPJ,
            fileFornecedorContratoPrestação)
        VALUES (
            :nome,
            :email,
            :telefone,
            :contato,
            :vip,
            :cnpj,
            :razao,
            :fantasia,
            :endereco,
            :complemento,
            :cidade,
            :estado,
            :banco,
            :agencia,
            :conta,
            :fav,
            :rg,
            :cpf,
            :nascimento,
            :valor,
            :cep,
            :VT,
            :VR,
            :planoMedico,
            :extra,
            :descontoVT,
            :cargo,
            :obs,
            :po,
            '$fileFornecedorCPF',
            '$fileFornecedorRG',
            '$fileFornecedorComprovanteEndereço',
            '$fileFornecedorContratoSocial',
            '$fileFornecedorCartãoCNPJ',
            '$fileFornecedorContratoPrestação')";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':nome' => $nome,
            ':email' => $email,
            ':telefone' => $telefone,
            ':contato' => $contato,
            ':vip' => $vip,
            ':razao' => $razao,
            ':cnpj' => $cnpj,
            ':fantasia' => $fantasia,
            ':endereco' => $endereco,
            ':complemento' => $complemento,
            ':cidade' => $cidade,
            ':estado' => $uf,
            ':banco' => $banco,
            ':agencia' => $agencia,
            ':conta' => $conta,
            ':fav' => $fav,
            ':rg' => $rg,
            ':cpf' => $cpf,
            ':nascimento' => $nascimento,
            ':valor' => $valor,
            ':cep' => $cep,
            ':VT'=>$vt,
            ':VR'=>$vr,
            ':planoMedico'=>$planoMedico,
            ':extra'=>$extra,
            ':descontoVT' => $descontoVT,
            ':cargo'=>$cargoId,
            ':obs'=>$obs,
            ':po'=>$po
        ];

         echo "<pre>";
         echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);
         echo "</pre>";

        // echo "<pre>";
        // print_r($sql);
        // echo "</pre>";

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);

        return true;
    }

   /* public function addFornecedor(
        $nome,
        $email,
        $telefone,
        $contato,
        $vip,
        $cnpj,
        $razao,
        $fantasia,
        $endereco,
        $complemento,
        $cidade,
        $uf,
        $banco,
        $agencia,
        $conta,
        $fav,
        $rg,
        $cpf,
        $nascimento,
        $valor,
        $cep,
        $vt,
        $vr,
        $planoMedico,
        $extra,
        $descontoVT,
        $cargoId,
        $obs,
        $po,
        $fileFornecedorCPF,
        $fileFornecedorRG,
        $fileFornecedorComprovanteEndereço,
        $fileFornecedorContratoSocial,
        $fileFornecedorCartãoCNPJ,
        $fileFornecedorContratoPrestação,
        $valorTotal
    ) {


        $sql = "INSERT INTO tb_fornecedor (
            strFornecedorNome,
            strFornecedorEmail,
            strFornecedorTelefone, 
            strFornecedorContato,
            strFornecedorVip,
            strFornecedorCnpj,
            strFornecedorRazao,
            strFornecedorFantasia,
            strFornecedorEndereco,
            strFornecedorComplemento,
            strFornecedorCidade,
            strFornecedorEstado,
            strFornecedorBanco,
            strFornecedorAgencia,
            strFornecedorConta,
            strFornecedorFavorecido,
            strFornecedorRg,
            strFornecedorCpf,
            strFornecedorNascimento,
            strFornecedorValor,
            strFornecedorCep,
            strFornecedorVT,
            strFornecedorVR,
            strFornecedorPlanoMedico,
            strFornecedorExtra,
            intFornecedorDescontoVT,
            intCargoID,strFornecedorObservacoes,
            strFornecedorPlanoOdontologico,
            fileFornecedorCPF,
            fileFornecedorRG,
            fileFornecedorComprovanteEndereço,
            fileFornecedorContratoSocial,
            fileFornecedorCartãoCNPJ,
            fileFornecedorContratoPrestação
            )
        VALUES (
            :nome,
            :email,
            :telefone,
            :contato,
            :vip,
            :cnpj,
            :razao,
            :fantasia,
            :endereco,
            :complemento,
            :cidade,
            :estado,
            :banco,
            :agencia,
            :conta,
            :fav,
            :rg,
            :cpf,
            :nascimento,
            :valor,
            :cep,
            :VT,
            :VR,
            :planoMedico,
            :extra,
            :descontoVT,
            :cargo,
            :obs,
            :po,
            '$fileFornecedorCPF',
            '$fileFornecedorRG',
            '$fileFornecedorComprovanteEndereço',
            '$fileFornecedorContratoSocial',
            '$fileFornecedorCartãoCNPJ',
            '$fileFornecedorContratoPrestação')";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':nome' => $nome,
            ':email' => $email,
            ':telefone' => $telefone,
            ':contato' => $contato,
            ':vip' => $vip,
            ':razao' => $razao,
            ':cnpj' => $cnpj,
            ':fantasia' => $fantasia,
            ':endereco' => $endereco,
            ':complemento' => $complemento,
            ':cidade' => $cidade,
            ':estado' => $uf,
            ':banco' => $banco,
            ':agencia' => $agencia,
            ':conta' => $conta,
            ':fav' => $fav,
            ':rg' => $rg,
            ':cpf' => $cpf,
            ':nascimento' => $nascimento,
            ':valor' => $valor,
            ':cep' => $cep,
            ':VT' => $vt,
            ':VR' => $vr,
            ':planoMedico' => $planoMedico,
            ':extra' => $extra,
            ':descontoVT' => $descontoVT,
            ':cargo' => $cargoId,
            ':obs' => $obs,
            ':po' => $po
        ];

         echo "<pre>";
         echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
         echo "</pre>";

        // echo "<pre>";
         //print_r($sql);
         //echo "</pre>";

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);

        return true;
    }*/

    public function editFornecedor(
        $nome,
        $email,
        $telefone,
        $contato,
        $vip,
        $cnpj,
        $razao,
        $fantasia,
        $endereco,
        $complemento,
        $cidade,
        $uf,
        $banco,
        $agencia,
        $conta,
        $fav,
        $rg,
        $cpf,
        $nascimento,
        $valor,
        $cep,
        $id,
        $vt,
        $vr,
        $planoMedico,
        $extra,
        $descontoVT,
        $cargoId,
        $obs,
        $po,
        $fileFornecedorCPF,
        $fileFornecedorRG,
        $fileFornecedorComprovanteEndereço,
        $fileFornecedorContratoSocial,
        $fileFornecedorCartãoCNPJ,
        $fileFornecedorContratoPrestação
    ) {

        $fornecedor = $this->getFornecedorByID($id);


        if ($fileFornecedorCPF == 'img/empty.png') {
            $fileFornecedorCPF = $fornecedor->fileFornecedorCPF;
        }
        if ($fileFornecedorRG == 'img/empty.png') {
            $fileFornecedorRG = $fornecedor->fileFornecedorRG;
        }
        if ($fileFornecedorComprovanteEndereço == 'img/empty.png') {
            $fileFornecedorComprovanteEndereço = $fornecedor->fileFornecedorComprovanteEndereço;
        }
        if ($fileFornecedorContratoSocial == 'img/empty.png') {
            $fileFornecedorContratoSocial = $fornecedor->fileFornecedorContratoSocial;
        }
        if ($fileFornecedorCartãoCNPJ == 'img/empty.png') {
            $fileFornecedorCartãoCNPJ = $fornecedor->fileFornecedorCartãoCNPJ;
        }
        if ($fileFornecedorContratoPrestação == 'img/empty.png') {
            $fileFornecedorContratoPrestação = $fornecedor->fileFornecedorContratoPrestação;
        }

        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE tb_fornecedor SET 
        strFornecedorNome =:nome, 
        strFornecedorEmail =:email,
        strFornecedorTelefone =:telefone, 
        strFornecedorContato =:contato, 
        strFornecedorVip =:vip,
        strFornecedorRazao = :razao,
        strFornecedorCnpj = :cnpj,
        strFornecedorFantasia = :fantasia,
        strFornecedorEndereco = :endereco,
        strFornecedorComplemento = :complemento,
        strFornecedorCidade = :cidade,
        strFornecedorEstado = :estado,
        strFornecedorBanco = :banco,
        strFornecedorAgencia = :agencia,
        strFornecedorConta = :conta,
        strFornecedorFavorecido = :fav,
        strFornecedorRg = :rg,
        strFornecedorCpf = :cpf,
        strFornecedorNascimento = :nascimento,
        strFornecedorValor = :valor,
        strFornecedorCep = :cep,
        strFornecedorVT = :vt,
        strFornecedorVR = :vr,
        strFornecedorPlanoMedico = :planoMedico,
        strFornecedorExtra = :extra,
        intFornecedorDescontoVT = :descontoVT,
        intCargoID = :cargo,
        strFornecedorObservacoes= :obs,
        strFornecedorPlanoOdontologico = :po,
        fileFornecedorCPF='$fileFornecedorCPF',
        fileFornecedorRG='$fileFornecedorRG',
        fileFornecedorComprovanteEndereço='$fileFornecedorComprovanteEndereço',
        fileFornecedorContratoSocial='$fileFornecedorContratoSocial',
        fileFornecedorCartãoCNPJ='$fileFornecedorCartãoCNPJ',
        fileFornecedorContratoPrestação='$fileFornecedorContratoPrestação',
        strFornecedorStatus='i'


        WHERE intFornecedorID = :id";
        $statement = $this->db->prepare($sql);
        try {
            $parameters = [
                ':nome' => $nome,
                ':email' => $email,
                ':telefone' => $telefone,
                ':contato' => $contato,
                ':vip' => $vip,
                ':razao' => $razao,
                ':cnpj' => $cnpj,
                ':fantasia' => $fantasia,
                ':endereco' => $endereco,
                ':complemento' => $complemento,
                ':cidade' => $cidade,
                ':estado' => $uf,
                ':banco' => $banco,
                ':agencia' => $agencia,
                ':conta' => $conta,
                ':fav' => $fav,
                ':rg' => $rg,
                ':cpf' => $cpf,
                ':nascimento' => $nascimento,
                ':valor' => $valor,
                ':cep' => $cep,
                ':id' => (int) $id,
                ':vt' => $vt,
                ':vr' => $vr,
                ':planoMedico' => $planoMedico,
                ':extra' => $extra,
                ':descontoVT' => $descontoVT,
                ':cargo' => $cargoId,
                ':obs' => $obs,
                ':po' => $po
            ];
            // echo "<pre>";
            // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);
            // echo "</pre>";
            $statement->execute($parameters);

            return true;
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function getAllFornecedorNum()
    {
        $sql = "SELECT * FROM tb_fornecedor";
        $query = $this->db->prepare($sql);
        $query->execute();
        $number_of_rows = $query->rowCount();
        return $number_of_rows;
    }

    public function getFornecedorByID($id)
    {
        $sql = "SELECT * FROM tb_fornecedor WHERE intFornecedorID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return $query->fetch();
    }

    public function findApprovalFornecedor()
    {
        $sql = "SELECT COUNT(intFornecedorID) AS amount_of_songs FROM tb_fornecedor WHERE strFornecedorStatus = 'i'";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_songs;
    }


    public function findReproveFornecedor()
    {
        $sql = "SELECT COUNT(intFornecedorID) AS amount_of_songs FROM tb_fornecedor WHERE strFornecedorStatus = 'r'";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_songs;
    }



    public function approveFornecedor($id)
    {
        $sql = "UPDATE tb_fornecedor SET strFornecedorStatus = 'a' WHERE intFornecedorID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return true;
    }

    public function registerReproveFornecedor($strReproveNome, $strReproveSolicitante, $strReproveAdm, $strReproveReason, $intFornecedorID)
    {
        $sql = "INSERT INTO tb_reprove (
            strReproveNome,
            strReproveSolicitante,
            strReproveAdm,
            strReproveReason,
            intFornecedorID
        ) VALUES (
            :strReproveNome,
            :strReproveSolicitante,
            :strReproveAdm,
            :strReproveReason,
            :intFornecedorID
            
            )";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':strReproveNome' => $strReproveNome,
            ':strReproveSolicitante' => $strReproveSolicitante,
            ':strReproveAdm' => $strReproveAdm,
            ':strReproveReason' => $strReproveReason,
            ':intFornecedorID' => $intFornecedorID
        ];
        $query->execute($parameters);

        return true;
    }

    public function delFornecedor($id)
    {
        $sql = "UPDATE tb_fornecedor SET strFornecedorStatus='r' WHERE intFornecedorID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return true;
    }

    public function checkDuplicated($cnpj)
    {
        $sql = "SELECT * FROM tb_fornecedor WHERE strFornecedorCnpj = :cnpj";
        $query = $this->db->prepare($sql);
        $parameters = array(':cnpj' => $cnpj);
        $query->execute($parameters);

        // echo mysqli_error($db); exit;
        return $query->fetch();
    }

    public function reapproveFornecedor($id)
    {
        $sql = "UPDATE tb_fornecedor SET strFornecedorStatus = 'i' WHERE intFornecedorID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return true;
    }
}

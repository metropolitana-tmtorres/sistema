<?php

class funcionariosModel
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

    public function getAllFuncionarios()
    {
        $sql = "SELECT f.*, c.*, d.* FROM tb_funcionarios AS f INNER JOIN tb_cargo AS c ON f.intCargoID = c.intCargoID INNER JOIN tb_departamentos AS d ON c.intDepartamentoID = d.intDepartamentoID WHERE strFuncionarioStatus='a' ORDER BY strFuncionarioNome ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getSalario()
    {
        $sql = "SELECT intFuncionarioID, sum(strFuncionarioSalarioBase + strFuncionarioCreditos + strFuncionarioPorFora + strFuncionarioVR + strFuncionarioConvenio + strFuncionarioAdicional + strFuncionarioPlanoOdontologico) as strFuncionarioSalarioBruto from tb_funcionarios group by intFuncionarioID ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getAllFuncionariosToApprove()
    {
        $sql = "SELECT f.*, c.*, d.* FROM tb_funcionarios AS f INNER JOIN tb_cargo AS c ON f.intCargoID = c.intCargoID INNER JOIN tb_departamentos AS d ON c.intDepartamentoID = d.intDepartamentoID WHERE strFuncionarioStatus='i' ORDER BY strFuncionarioNome ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getReprovedFuncionarios()
    {
        $sql = "SELECT DISTINCT tb_funcionarios.*,tb_reprove.strReproveReason,tb_reprove.strReproveAdm,tb_reprove.strReproveDateCad FROM  tb_funcionarios INNER JOIN tb_reprove ON tb_funcionarios.intFuncionarioID=tb_reprove.intFuncionarioID WHERE strFuncionarioStatus = 'r' ";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function findApprovalFuncionario()
    {
        $sql = "SELECT COUNT(intFuncionarioID) AS amount_of_songs FROM tb_funcionarios WHERE strFuncionarioStatus = 'i'";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_songs;
    }

    public function findReproveFuncionario()
    {
        $sql = "SELECT COUNT(intFuncionarioID) AS amount_of_songs FROM tb_funcionarios WHERE strFuncionarioStatus = 'r'";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_songs;
    }



    public function getFuncionarioByID($id)
    {
        $sql = "SELECT f.*, c.* FROM tb_funcionarios AS f INNER JOIN tb_cargo AS c ON f.intCargoID = c.intCargoID WHERE intFuncionarioID = :id ORDER BY strFuncionarioNome ASC";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return $query->fetch();
    }
    public function approveFuncionario($intFuncionarioID)
    {
        $sql = "UPDATE tb_funcionarios SET strFuncionarioStatus='a' WHERE intFuncionarioID=:intFuncionarioID ";
        $query = $this->db->prepare($sql);
        $parameters = [':intFuncionarioID' => $intFuncionarioID];
        $query->execute($parameters);
        return true;
    }
    public function registerReproveFuncionario($strReproveNome, $strReproveSolicitante, $strReproveAdm, $strReproveReason, $intFuncionarioID)
    {
        $sql = "INSERT INTO tb_reprove (
            strReproveNome,
            strReproveSolicitante,
            strReproveAdm,
            strReproveReason,
            intFuncionarioID
        ) VALUES (
            :strReproveNome,
            :strReproveSolicitante,
            :strReproveAdm,
            :strReproveReason,
            :intFuncionarioID
            
            )";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':strReproveNome' => $strReproveNome,
            ':strReproveSolicitante' => $strReproveSolicitante,
            ':strReproveAdm' => $strReproveAdm,
            ':strReproveReason' => $strReproveReason,
            ':intFuncionarioID' => $intFuncionarioID
        ];
        $query->execute($parameters);

        return true;
    }

    public function delFuncionario($id)
    {
        $sql = "UPDATE tb_funcionarios SET strFuncionarioStatus='r' WHERE intFuncionarioID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return true;
    }

    // public function addFuncionario($nome,$pagamento,$cpf,$rg,$salario,$credito,$total,$fora,$registro,$admissao,$nascimento,$cargo,$banco,$ag,$cc,$vr,$vt,$convenio,$ac,$po,$fileFuncionarioCPF,$fileFuncionarioRG,$fileFuncionarioCarteiraTrabalho,$fileFuncionarioPis,$fileFuncionarioComprovanteEndereco,$fileFuncionarioTituloEleitor,$fileFuncionarioExameMedico) {
    //     $sql = "INSERT INTO tb_funcionarios (strFuncionarioNome, strFuncionarioDatePagamento, strFuncionarioCPF, strFuncionarioRG, strFuncionarioSalarioBase,
    //     strFuncionarioCreditos, strFuncionarioSalarioBruto, strFuncionarioPorFora, strFuncionarioDateRegistro, strFuncionarioDateAdmissao,
    //     strFuncionarioDateNascimento, intCargoID, strFuncionarioBanco, strFuncionarioAgencia, strFuncionarioConta, strFuncionarioVR, strFuncionarioVT, strFuncionarioConvenio, strFuncionarioAdicional, strFuncionarioPlanoOdontologico,
    //     fileFuncionarioCPF,fileFuncionarioRG,fileFuncionarioCarteiraTrabalho,fileFuncionarioPis,fileFuncionarioComprovanteEndereco,fileFuncionarioTituloEleitor,fileFuncionarioExameMedico) VALUES (:nome, :pagamento, :cpf, :rg, :salario,
    //     :credito,  :total, :fora, :registro, :admissao, :nascimento, :cargo, :banco, :ag, :cc, :vr, :vt, :convenio, :ac, :po,
    //     '$fileFuncionarioCPF','$fileFuncionarioRG','$fileFuncionarioCarteiraTrabalho','$fileFuncionarioPis','$fileFuncionarioComprovanteEndereco','$fileFuncionarioTituloEleitor','$fileFuncionarioExameMedico')";
    //     $query = $this->db->prepare($sql);
    //     $parameters = array(':nome' => $nome, ':pagamento' => $pagamento, ':cpf' => $cpf, ':rg' => $rg, ':salario' => $salario, ':credito' => $credito, 
    //     ':total' => $total, ':fora' => $fora, ':registro' => $registro, ':admissao' => $admissao, ':nascimento' => $nascimento, ':cargo' => $cargo, ':banco' => $banco, 
    //     ':ag' => $ag, ':cc' => $cc, ':vr'=> $vr, ':vt' => $vt, ':convenio'=> $convenio, ':ac' => $ac, ':po' => $po        
    //     );

    //     $query->execute($parameters);
    //     echo mysqli_error($db); exit;
    //     return true;
    // }

    // public function addColaborador($nome,$pagamento,$cpf,$rg,$salario,$credito,$total,$fora,$registro,$admissao,$nascimento,$cargo,$banco,$ag,$cc,$vr,$vt,$convenio,$ac,$po,$fileFuncionarioCPF,$fileFuncionarioRG,$fileFuncionarioCarteiraTrabalho,$fileFuncionarioPis,$fileFuncionarioComprovanteEndereco,$fileFuncionarioTituloEleitor,$fileFuncionarioExameMedico,$admID) {
    //     $sql = "INSERT INTO tb_funcionarios (
    //         strFuncionarioNome, 
    //         strFuncionarioDatePagamento, 
    //         strFuncionarioCPF, 
    //         strFuncionarioRG, 
    //         strFuncionarioSalarioBase,
    //         strFuncionarioCreditos, 
    //         strFuncionarioSalarioBruto, 
    //         strFuncionarioPorFora, 
    //         strFuncionarioDateRegistro, 
    //         strFuncionarioDateAdmissao,
    //         strFuncionarioDateNascimento, 
    //         intCargoID, 
    //         strFuncionarioBanco, 
    //         strFuncionarioAgencia, 
    //         strFuncionarioConta, 
    //         strFuncionarioVR, 
    //         strFuncionarioVT, 
    //         strFuncionarioConvenio, 
    //         strFuncionarioAdicional, 
    //         strFuncionarioPlanoOdontologico,
    //         fileFuncionarioCPF,
    //         fileFuncionarioRG,
    //         fileFuncionarioCarteiraTrabalho,
    //         fileFuncionarioPis,
    //         fileFuncionarioComprovanteEndereco,
    //         fileFuncionarioTituloEleitor,
    //         fileFuncionarioExameMedico,
    //         intAdmID
    //         ) VALUES (
    //             :nome, 
    //             :pagamento, 
    //             :cpf, 
    //             :rg, 
    //             :salario,
    //             :credito,  
    //             :total, 
    //             :fora, 
    //             :registro, 
    //             :admissao, 
    //             :nascimento, 
    //             :cargo, 
    //             :banco, 
    //             :ag, 
    //             :cc, 
    //             :vr, 
    //             :vt, 
    //             :convenio, 
    //             :ac, 
    //             :po,
    //             '$fileFuncionarioCPF',
    //             '$fileFuncionarioRG',
    //             '$fileFuncionarioCarteiraTrabalho',
    //             '$fileFuncionarioPis',
    //             '$fileFuncionarioComprovanteEndereco',
    //             '$fileFuncionarioTituloEleitor',
    //             '$fileFuncionarioExameMedico',
    //             ':admID')";
    //     $query = $this->db->prepare($sql);
    //     $parameters = array(':nome' => $nome, ':pagamento' => $pagamento, ':cpf' => $cpf, ':rg' => $rg, ':salario' => $salario, ':credito' => $credito, 
    //     ':total' => $total, ':fora' => $fora, ':registro' => $registro, ':admissao' => $admissao, ':nascimento' => $nascimento, ':cargo' => $cargo, ':banco' => $banco, 
    //     ':ag' => $ag, ':cc' => $cc, ':vr'=> $vr, ':vt' => $vt, ':convenio'=> $convenio, ':ac' => $ac, ':po' => $po, ':admID' => $admID);

    //     // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters); 
    //     $query->execute($parameters);
    //     // echo mysqli_error($this->db); exit;

    //     return true;
    // }

    public function addColaborador(
        $nome,
        $pagamento,
        $cpf,
        $rg,
        $salario,
        $credito,
        $fora,
        $registro,
        $admissao,
        $nascimento,
        $cargo,
        $banco,
        $ag,
        $cc,
        $vt,
        $vr,
        $convenio,
        $ac,
        $po,
        $fileFuncionarioCPF,
        $fileFuncionarioRG,
        $fileFuncionarioCarteiraTrabalho,
        $fileFuncionarioPis,
        $fileFuncionarioComprovanteEndereco,
        $fileFuncionarioTituloEleitor,
        $fileFuncionarioExameMedico,
        $admID
    ) {
        $sql = "INSERT INTO tb_funcionarios (
                strFuncionarioNome,
                strFuncionarioDatePagamento, 
                strFuncionarioCPF, 
                strFuncionarioRG, 
                strFuncionarioSalarioBase,
                strFuncionarioCreditos, 
                strFuncionarioPorFora,
                strFuncionarioDateRegistro,
                strFuncionarioDateAdmissao, 
                strFuncionarioDateNascimento, 
                intCargoID,
                strFuncionarioBanco, 
                strFuncionarioAgencia,
                strFuncionarioConta,
                strFuncionarioVT,
                strFuncionarioVR,
                strFuncionarioConvenio,
                strFuncionarioAdicional,
                strFuncionarioPlanoOdontologico, 
                fileFuncionarioCPF, 
                fileFuncionarioRG, 
                fileFuncionarioCarteiraTrabalho,
                fileFuncionarioPis, 
                fileFuncionarioComprovanteEndereco, 
                fileFuncionarioTituloEleitor, 
                fileFuncionarioExameMedico,
                intAdmID
                ) 
                VALUES (
                :nome,
                :pagamento, 
                :cpf, 
                :rg,
                :salario,
                :credito,
                :fora, 
                :registro,
                :admissao,
                :nascimento,
                :cargo,
                :banco,
                :ag,
                :cc,
                :vt,
                :vr,
                :convenio,
                :ac,
                :po,
                '$fileFuncionarioCPF', 
                '$fileFuncionarioRG', 
                '$fileFuncionarioCarteiraTrabalho',
                '$fileFuncionarioPis', 
                '$fileFuncionarioComprovanteEndereco', 
                '$fileFuncionarioTituloEleitor', 
                '$fileFuncionarioExameMedico',
                :id
                              )";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':nome' => $nome,
            ':pagamento' => $pagamento,
            ':cpf' => $cpf,
            ':rg' => $rg,
            ':salario' => $salario,
            ':credito' => $credito,
            ':fora' => $fora,
            ':registro' => $registro,
            ':admissao' => $admissao,
            ':nascimento' => $nascimento,
            ':cargo' => $cargo,
            ':banco' => $banco,
            ':ag' => $ag,
            ':cc' => $cc,
            ':vt' => $vt,
            ':vr' => $vr,
            ':convenio' => $convenio,
            ':ac' => $ac,
            ':po' => $po,
            ':id' => $admID
        );

        $query->execute($parameters);
        // echo mysqli_error($this->db); exit;
        return true;
    }

    public function editFuncionario($nome, $pagamento, $cpf, $rg, $salario, $credito, $fora, $registro, $admissao, $nascimento, $cargo, $banco, $ag, $cc, $vr, $vt, $convenio, $ac, $id, $po, $fileFuncionarioCPF, $fileFuncionarioRG, $fileFuncionarioCarteiraTrabalho, $fileFuncionarioPis, $fileFuncionarioComprovanteEndereco, $fileFuncionarioTituloEleitor, $fileFuncionarioExameMedico)
    {
        $funcionario = $this->getFuncionarioByID($id);
        if ($fileFuncionarioCPF == 'img/empty.png') {
            $fileFuncionarioCPF = $funcionario->fileFuncionarioCPF;
        }
        if ($fileFuncionarioRG == 'img/empty.png') {
            $fileFuncionarioRG = $funcionario->fileFuncionarioRG;
        }
        if ($fileFuncionarioCarteiraTrabalho == 'img/empty.png') {
            $fileFuncionarioCarteiraTrabalho = $funcionario->fileFuncionarioCarteiraTrabalho;
        }
        if ($fileFuncionarioPis == 'img/empty.png') {
            $fileFuncionarioPis = $funcionario->fileFuncionarioPis;
        }
        if ($fileFuncionarioComprovanteEndereco == 'img/empty.png') {
            $fileFuncionarioComprovanteEndereco = $funcionario->fileFuncionarioComprovanteEndereco;
        }
        if ($fileFuncionarioTituloEleitor == 'img/empty.png') {
            $fileFuncionarioTituloEleitor = $funcionario->fileFuncionarioTituloEleitor;
        }
        if ($fileFuncionarioExameMedico == 'img/empty.png') {
            $fileFuncionarioExameMedico = $funcionario->fileFuncionarioExameMedico;
        }
        $sql = "UPDATE tb_funcionarios SET 
        strFuncionarioNome = :nome,
        strFuncionarioDatePagamento = :pagamento,
        strFuncionarioCPF = :cpf,
        strFuncionarioRG = :rg,
        strFuncionarioSalarioBase = :salario,
        strFuncionarioCreditos = :credito,  
        strFuncionarioPorFora = :fora,
        strFuncionarioDateRegistro = :registro, 
        strFuncionarioDateAdmissao = :admissao, 
        strFuncionarioDateNascimento = :nascimento, 
        intCargoID = :cargo,
        strFuncionarioBanco = :banco, 
        strFuncionarioAgencia = :ag, 
        strFuncionarioConta = :cc, 
        strFuncionarioVR = :vr, 
        strFuncionarioVT = :vt, 
        strFuncionarioConvenio = :convenio, 
        strFuncionarioAdicional = :ac, 
        strFuncionarioPlanoOdontologico = :po,
        fileFuncionarioCPF = :cpfFile,
        fileFuncionarioRG = :rgFile,
        fileFuncionarioCarteiraTrabalho = :trabalhoFile,
        fileFuncionarioPis = :pisFile,
        fileFuncionarioComprovanteEndereco = :enderecoFile,
        fileFuncionarioTituloEleitor = :eleitorFile,
        fileFuncionarioExameMedico = :exameFile  
        WHERE intFuncionarioID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':nome' => $nome,
            ':pagamento' => $pagamento,
            ':cpf' => $cpf,
            ':rg' => $rg,
            ':salario' => $salario,
            ':credito' => $credito,
            ':fora' => $fora,
            ':registro' => $registro,
            ':admissao' => $admissao,
            ':nascimento' => $nascimento,
            ':cargo' => $cargo,
            ':banco' => $banco,
            ':ag' => $ag,
            ':cc' => $cc,
            ':vr' => $vr,
            ':vt' => $vt,
            ':convenio' => $convenio,
            ':ac' => $ac,
            ':po' => $po,
            ':cpfFile' => $fileFuncionarioCPF,
            ':rgFile' => $fileFuncionarioRG,
            ':trabalhoFile' => $fileFuncionarioCarteiraTrabalho,
            ':pisFile' => $fileFuncionarioPis,
            ':enderecoFile' => $fileFuncionarioComprovanteEndereco,
            ':eleitorFile' => $fileFuncionarioTituloEleitor,
            ':exameFile' => $fileFuncionarioExameMedico,
            ':id' => $id
        );

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
        // echo mysqli_error($db); exit;
        return true;
    }

    public function deleteFuncionario($id)
    {
        $sql = "DELETE FROM tb_funcionarios WHERE intFuncionarioID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);

        return true;
    }

    public function reapproveColaborador($id)
    {
        $sql = "UPDATE tb_funcionarios SET strFuncionarioStatus = 'i' WHERE intFuncionarioID = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        return true;
    }

    public function getAllMyFuncionarios($id)
    {
        $sql = "SELECT f.*, c.* FROM tb_funcionarios AS f INNER JOIN tb_cargo AS c ON f.intCargoID = c.intCargoID WHERE intAdmID = :adm";
        $query = $this->db->prepare($sql);
        $parameters = array(':adm' => $id);
        $query->execute($parameters);

        return $query->fetchAll();
    }
}

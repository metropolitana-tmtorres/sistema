<?php

class fechamentoContasModel
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

    public function gerarContas($tipoConta,$ano,$mes,$sobrescrever,$intAdmID) {
        $contas=[];
        $contas= $this->consultarContas($tipoConta,$ano,$mes);
        if($sobrescrever==1){
            $sql = "DELETE FROM tb_fechamento_contas WHERE intFechamentoContasAnoRef={$ano} AND intFechamentoContasMesRef={$mes} AND intFechamentoContasTipo={$tipoConta}";           
            $query = $this->db->prepare($sql);    
            $query->execute();     
        }else if(count($contas)>0){
            return true;
        }
        
       
        if($tipoConta==0){       
            $sql = "SELECT strFornecedorNome as nome, 
            intFornecedorID as ID,
            strFornecedorValor as valorParcial, 
            0 as debito, 
            (strFornecedorValor -  (strFornecedorPlanoMedico * 0.3) - strFornecedorExtra - (strFornecedorValor * 0.06 * intFornecedorDescontoVT) - strFornecedorPlanoOdontologico) as valorTotal, 
            '20/{$mes}/{$ano}' as vencimento,
            strFornecedorPlanoOdontologico as strFechamentoContasPlanoOdontologico,
            (strFornecedorPlanoMedico * 0.3) as strFechamentoContasPlanoSaude,
            strFornecedorExtra as strFechamentoContasPlanoSaudeExtra,           
            (strFornecedorValor * 0.06 * intFornecedorDescontoVT) as strFechamentoContasValorVT,
            0 as strFechamentoContasValorVR
            FROM tb_fornecedor 
            WHERE strFornecedorVip = 'y'  AND strFornecedorStatus = 'a' ";   
        }else{                 
            $sql = "SELECT strFuncionarioNome as nome, 
            intFuncionarioID as ID,
            strFuncionarioSalarioBase as valorParcial, 
            strFuncionarioDebitos as debito, 
            (strFuncionarioSalarioBase - (strFuncionarioSalarioBase * 0.06) - (strFuncionarioConvenio * 0.3) - strFuncionarioAdicional - strFuncionarioPlanoOdontologico) as valorTotal, 
            '20/{$mes}/{$ano}' as vencimento,
            strFuncionarioPlanoOdontologico as strFechamentoContasPlanoOdontologico,
            (strFuncionarioSalarioBase * 0.06 ) as strFechamentoContasValorVT,           
            (strFuncionarioConvenio * 0.3) as strFechamentoContasPlanoSaude,
            strFuncionarioAdicional as strFechamentoContasPlanoSaudeExtra,            
            0 as strFechamentoContasValorVR
            FROM tb_funcionarios WHERE strFuncionarioStatus= 'a' ";           
        }
        $query = $this->db->prepare($sql);    
        $query->execute();     
        
        $contas = $query->fetchAll(); 
        // print_r($contas);
        

        foreach($contas as $conta)
        {
            $sql = "INSERT INTO tb_fechamento_contas (
                strFechamentoContasNome,
                strFechamentoContasValorParcial,
                strFechamentoContasDebito,
                strFechamentoContasValorTotal,
                strFechamentoContasVencimento,
                intFechamentoContasAnoRef,
                intFechamentoContasMesRef,
                intFechamentoContasTipo, 
                strFechamentoContasPlanoOdontologico,
                strFechamentoContasPlanoSaude,
                strFechamentoContasPlanoSaudeExtra,
                strFechamentoContasValorVT,
                strFechamentoContasValorVR, 
                intFornecedorFuncionarioID,
                intAdmID) 
            values(
                :nome,
                :valorParcial,
                :debito,
                :valorTotal,
                :vencimento,
                :ano,
                :mes,
                :tipoConta,
                :strFechamentoContasPlanoOdontologico,
                :strFechamentoContasPlanoSaude,
                :strFechamentoContasPlanoSaudeExtra,               
                :strFechamentoContasValorVT,
                :strFechamentoContasValorVR,
                :ID,
                :intAdmID
                )
            "; 
            $parameters=[
                ':nome'=>$conta->nome,
                ':valorParcial'=>$conta->valorParcial,
                ':debito'=>$conta->debito,
                ':valorTotal'=>$conta->valorTotal,
                ':vencimento'=>$conta->vencimento,
                ':ano'=>$ano,
                ':mes'=>$mes,
                ':tipoConta'=>$tipoConta,
                ':strFechamentoContasPlanoOdontologico'=>$conta->strFechamentoContasPlanoOdontologico,
                ':strFechamentoContasPlanoSaude'=>$conta->strFechamentoContasPlanoSaude,
                ':strFechamentoContasPlanoSaudeExtra'=>$conta->strFechamentoContasPlanoSaudeExtra,  
                ':strFechamentoContasValorVR'=>$conta->strFechamentoContasValorVR,              
                ':strFechamentoContasValorVT'=>$conta->strFechamentoContasValorVT,
                ':ID'=>$conta->ID,
                ':intAdmID'=>$intAdmID
            ];
            $query = $this->db->prepare($sql);  
            
            // echo '<pre>[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters).'</pre>';
            $query->execute( $parameters);         
        }
       
        return true;
    }
    public function consultarMinhasContas($tipoConta,$ano,$mes,$intAdmID)
    {
        $sql = "SELECT * FROM tb_fechamento_contas WHERE intFechamentoContasAnoRef=:ano AND intFechamentoContasMesRef=:mes AND intFechamentoContasTipo=:tipoConta AND intAdmID=:intAdmID";           
        $query = $this->db->prepare($sql);    
        $query->execute([":ano"=>$ano,":mes"=>$mes,":tipoConta"=>$tipoConta,":intAdmID"=>$intAdmID]);     
        $contas = $query->fetchAll(); 
        // echo '<pre>[ PDO DEBUG ]: ' . Helper::debugPDO($sql, [":ano"=>$ano,":mes"=>$mes,":tipoConta"=>$tipoConta,":intAdmID"=>$intAdmID]).'</pre>';
        return $contas;
    }
    public function consultarContas($tipoConta,$ano,$mes)
    {
        $sql = "SELECT * FROM tb_fechamento_contas WHERE intFechamentoContasAnoRef=:ano AND intFechamentoContasMesRef=:mes AND intFechamentoContasTipo=:tipoConta";           
        $query = $this->db->prepare($sql);    
        $query->execute([":ano"=>$ano,":mes"=>$mes,":tipoConta"=>$tipoConta]);     
        $contas = $query->fetchAll(); 
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, [":ano"=>$ano,":mes"=>$mes,":tipoConta"=>$tipoConta]);
        return $contas;
    }
    public function consultarConta($id)
    {
        $sql = "SELECT * FROM tb_fechamento_contas WHERE intFechamentoContasID = :id";           
        $query = $this->db->prepare($sql);    
        $query->execute([':id'=>$id]);     
        $contas = $query->fetchAll(); 

        return $contas;
    }
    public function editarInfoConta($intFechamentoContasID,$strFechamentoContasNome,$strFechamentoContasValorParcial,$strFechamentoContasDebito,$strFechamentoContasValorTotal,$strFechamentoContasVencimento,$strFechamentoContasPlanoOdontologico,$strFechamentoContasPlanoSaude,$strFechamentoContasPlanoSaudeExtra,$strFechamentoContasValorVR,$strFechamentoContasValorVT)
    {
        $sql = "UPDATE tb_fechamento_contas SET 
        strFechamentoContasNome = :strFechamentoContasNome, 
        strFechamentoContasValorParcial = :strFechamentoContasValorParcial, 
        strFechamentoContasDebito = :strFechamentoContasDebito, 
        strFechamentoContasPlanoOdontologico= :strFechamentoContasPlanoOdontologico,
        strFechamentoContasPlanoSaude= :strFechamentoContasPlanoSaude,
        strFechamentoContasPlanoSaudeExtra= :strFechamentoContasPlanoSaudeExtra,
        strFechamentoContasValorVR= :strFechamentoContasValorVR,
        strFechamentoContasValorVT= :strFechamentoContasValorVT,
        strFechamentoContasValorTotal = :strFechamentoContasValorTotal, 
        strFechamentoContasVencimento= :strFechamentoContasVencimento        
        WHERE intFechamentoContasID = :intFechamentoContasID";
        $query = $this->db->prepare($sql);    
        
        $parameters=[
            ':strFechamentoContasNome'=>$strFechamentoContasNome,
            ':strFechamentoContasValorParcial'=>$strFechamentoContasValorParcial,
            ':strFechamentoContasDebito'=>$strFechamentoContasDebito,
            ':strFechamentoContasPlanoOdontologico'=>$strFechamentoContasPlanoOdontologico,
            ':strFechamentoContasPlanoSaude'=>$strFechamentoContasPlanoSaude,
            ':strFechamentoContasPlanoSaudeExtra'=>$strFechamentoContasPlanoSaudeExtra,
            ':strFechamentoContasValorVR'=>$strFechamentoContasValorVR,
            ':strFechamentoContasValorVT'=>$strFechamentoContasValorVT,
            ':strFechamentoContasValorTotal'=>$strFechamentoContasValorTotal,
            ':strFechamentoContasVencimento'=>$strFechamentoContasVencimento,
            ':intFechamentoContasID'=>$intFechamentoContasID

        ];
        $query->execute($parameters);  
        return json_encode(['success'=>true]);
    }
    public function inserirContasAPagar($tipoConta,$ano,$mes,$CentroCustos,$IDS,$intAdmID){
        $this->contasAPagarModel = new contasAPagarModel($this->db);

        $this->fornecedorModel = new fornecedorModel($this->db);
        $this->funcionariosModel = new funcionariosModel($this->db);

        $contas=$this->consultarContas($tipoConta,$ano,$mes);
        foreach($contas as $conta){
            if(!in_array($conta->intFechamentoContasID,$IDS)) continue;

            $strContasAPagarNome="Conta Salario - {$conta->strFechamentoContasNome}";
            $strContasAPagarVencimento=$conta->strFechamentoContasVencimento;
            $decContasAPagarValor=$conta->strFechamentoContasValorTotal;
            $strContasAPagarDesc='Conta salario gerada automaticamente';
            $strContasAPagarStatus='aberto';
            $intContasAPagarMesRef=$mes;
            $intContasAPagarAnoRef=$ano;
            $CentroCustosIDS=$CentroCustos;
            if($tipoConta==0){
                //fornecedor
                $fornecedor= $this->fornecedorModel->getFornecedorByID($conta->intFornecedorFuncionarioID);
                $this->contasAPagarModel->cadastrarContaAPagar($strContasAPagarNome,$strContasAPagarVencimento,$decContasAPagarValor,$strContasAPagarDesc,$strContasAPagarStatus,$intContasAPagarMesRef,$intContasAPagarAnoRef,$CentroCustosIDS,1);  
                //VT
                $this->contasAPagarModel->cadastrarContaAPagar(
                    "VT - {$conta->strFechamentoContasNome}",
                    date("t/m/Y", strtotime("{$intContasAPagarAnoRef}-{$intContasAPagarMesRef}-01")),
                    $fornecedor->strFornecedorVT,'Conta VT gerada automáticamente',
                    $strContasAPagarStatus,
                    $intContasAPagarMesRef,
                    $intContasAPagarAnoRef,
                    $CentroCustosIDS,
                    2,
                    $intAdmID);
                //VR
                $this->contasAPagarModel->cadastrarContaAPagar(
                    "VR - {$conta->strFechamentoContasNome}",
                    "15/{$intContasAPagarMesRef}/{$intContasAPagarAnoRef}",
                    $fornecedor->strFornecedorVR,
                    'Conta VR gerada automáticamente',
                    $strContasAPagarStatus,
                    $intContasAPagarMesRef,
                    $intContasAPagarAnoRef,
                    $CentroCustosIDS,
                    2,
                    $intAdmID);
                //PlanoMedico
                $this->contasAPagarModel->cadastrarContaAPagar(
                    "Plano Medico - {$conta->strFechamentoContasNome}",
                    "15/{$intContasAPagarMesRef}/{$intContasAPagarAnoRef}",
                    ($fornecedor->strFornecedorPlanoMedico+$fornecedor->strFornecedorExtra),
                    'Conta do plano Medico gerada automáticamente',
                    $strContasAPagarStatus,
                    $intContasAPagarMesRef,
                    $intContasAPagarAnoRef,
                    $CentroCustosIDS,
                    2,
                    $intAdmID);
                
                
            }else{ 
                //colaborador
                $colaborador= $this->funcionariosModel-> getFuncionarioByID($conta->intFornecedorFuncionarioID);
                
                //busca na tabela a dedução do INSS
                $deducao = function ( $fatorINSS,$inssArray){
                    foreach($inssArray as $aliquota){
                        if($fatorINSS==$aliquota['aliquota']){
                            return $aliquota['dedução INSS'];  
                        }
                    }
                }; 
                //busca na tabela a aliquota do INSS           
                $aliquota = function ($valorBruto,$inssArray){
                    foreach($inssArray as $aliquota){
                        if($valorBruto>=$aliquota['min'] && $valorBruto<=$aliquota['max']){
                            return $aliquota['aliquota'];  
                        }
                    }
                };
                //busca na tabela a aliquota do IRRF
                $fatorIR = function ($valorBase,$irrfArray){
                    foreach($irrfArray as $irrf){
                        if($valorBase>=$irrf['min'] && $valorBase<=$irrf['max']){
                            return $irrf['aliquota'];  
                        }
                    }
                };

                // impostos
                $valorBruto=$colaborador->strFuncionarioSalarioBase;
                //tabela de imposto de renda
                $irrfArray=[   
                    [
                        'min'=>0,
                        'max'=>1903.98,
                        'aliquota'=>0,
                        'value'=>0
                    ],
                    [
                        'min'=>1903.99,
                        'max'=>2826.65,
                        'aliquota'=>0.075,
                        'value'=>142.80
                    ],
                    [
                        'min'=>2826.66,
                        'max'=>3751.05,
                        'aliquota'=>0.15,
                        'value'=>354.80
                    ],
                    [
                        'min'=>3751.06,
                        'max'=>4664.68,
                        'aliquota'=>0.225,
                        'value'=>636.13
                    ],
                    [
                        'min'=>4664.69,
                        'max'=>9999,
                        'aliquota'=>0.275,
                        'value'=>869.36
                    ]
                ];
                //tabela de inss
                $inssArray=[
                        [
                            'min'=>0.00,
                            'max'=>0.00,
                            'aliquota'=>0,
                            'dedução INSS'=>0
                        ],
                        [
                            'min'=>0.01,
                            'max'=>1100.00,
                            'aliquota'=>0.075,
                            'dedução INSS'=>0
                        ],
                        [
                            'min'=>1100.01,
                            'max'=>2203.48,
                            'aliquota'=>0.09,
                            'dedução INSS'=>16.5
                        ],
                        [
                            'min'=>2203.49,
                            'max'=>3305.22,
                            'aliquota'=>0.12,
                            'dedução INSS'=>82.6
                        ],
                        [
                            'min'=>3305.23,
                            'max'=>6433.56,
                            'aliquota'=>0.14,
                            'dedução INSS'=>148.71
                        ]
                    ];
                
                
                
                //calculo do fator de INSS
                if($valorBruto>6433.37){
                    $fatorINSS=0; 
                    $INSS=751.99;
                }else{
                    $fatorINSS=$aliquota($valorBruto,$inssArray);
                    $deducaoINSS=$deducao( $fatorINSS,$inssArray);
                    $INSS=$valorBruto*$fatorINSS-$deducaoINSS;
                }
                $FGTS=$valorBruto*0.08;
                $baseIrrf=$valorBruto-$INSS;
                $IRRF=$baseIrrf*$fatorIR($baseIrrf, $irrfArray);

                if($IRRF<10){
                    $IRRFFerias=0;
                }else{
                    $IRRFFerias=$IRRF;
                }

                $LIQUIDO=$valorBruto-$INSS-$IRRF-$FGTS;
                $LIQUIDOferias=($valorBruto-$INSS-$IRRFFerias)/12;

                //INSS
                $this->contasAPagarModel->cadastrarContaAPagar(
                "INSS - {$conta->strFechamentoContasNome}",
                "15/{$intContasAPagarMesRef}/{$intContasAPagarAnoRef}",
                $INSS,
                'Conta INSS gerada automáticamente',
                $strContasAPagarStatus,
                $intContasAPagarMesRef,
                $intContasAPagarAnoRef,
                $CentroCustosIDS,
                114,
                $intAdmID);
                //IRRF
                $this->contasAPagarModel->cadastrarContaAPagar(
                    "IRRF - {$conta->strFechamentoContasNome}",
                    "15/{$intContasAPagarMesRef}/{$intContasAPagarAnoRef}",
                    $IRRF,
                    'Conta IRFF gerada automáticamente',
                    $strContasAPagarStatus,
                    $intContasAPagarMesRef,
                    $intContasAPagarAnoRef,
                    $CentroCustosIDS,
                    114,
                    $intAdmID);
                //FGTS
                $this->contasAPagarModel->cadastrarContaAPagar(
                    "FGTS - {$conta->strFechamentoContasNome}",
                    "15/{$intContasAPagarMesRef}/{$intContasAPagarAnoRef}",
                    $FGTS,
                    'Conta FGTS gerada automáticamente',
                    $strContasAPagarStatus,
                    $intContasAPagarMesRef,
                    $intContasAPagarAnoRef,
                    $CentroCustosIDS,
                    114,
                    $intAdmID);
                
                //salário
                $this->contasAPagarModel->cadastrarContaAPagar(
                    $strContasAPagarNome,
                    $strContasAPagarVencimento,
                    $decContasAPagarValor-$INSS-$IRRF-$FGTS,
                    $strContasAPagarDesc,
                    $strContasAPagarStatus,
                    $intContasAPagarMesRef,
                    $intContasAPagarAnoRef,
                    $CentroCustosIDS,
                    1,
                    $intAdmID); 

                //VT
                $this->contasAPagarModel->cadastrarContaAPagar(
                    "VT - {$conta->strFechamentoContasNome}",
                    date("t/m/Y", strtotime("{$intContasAPagarAnoRef}-{$intContasAPagarMesRef}-01")),
                    $colaborador->strFuncionarioVT,
                    'Conta VT gerada automáticamente',
                    $strContasAPagarStatus,
                    $intContasAPagarMesRef,
                    $intContasAPagarAnoRef,
                    $CentroCustosIDS,
                    2,
                    $intAdmID);
                //VR
                $this->contasAPagarModel->cadastrarContaAPagar(
                    "VR - {$conta->strFechamentoContasNome}",
                    "15/{$intContasAPagarMesRef}/{$intContasAPagarAnoRef}",
                    $colaborador->strFuncionarioVR,
                    'Conta VR gerada automáticamente',
                    $strContasAPagarStatus,
                    $intContasAPagarMesRef,
                    $intContasAPagarAnoRef,
                    $CentroCustosIDS,
                    2,
                    $intAdmID);
                //PlanoMedico
                $this->contasAPagarModel->cadastrarContaAPagar(
                    "Plano Medico - {$conta->strFechamentoContasNome}",
                    "15/{$intContasAPagarMesRef}/{$intContasAPagarAnoRef}",
                    ($colaborador->strFuncionarioConvenio+$colaborador->strFuncionarioAdicional),
                    'Conta do plano Medico gerada automáticamente',
                    $strContasAPagarStatus,
                    $intContasAPagarMesRef,
                    $intContasAPagarAnoRef,
                    $CentroCustosIDS,
                    2,
                    $intAdmID);    
                //Ferias parcial
                $this->contasAPagarModel->cadastrarContaAPagar(
                    "Parcial Ferias - {$conta->strFechamentoContasNome}",
                    "15/{$intContasAPagarMesRef}/{$intContasAPagarAnoRef}",
                    $LIQUIDOferias,
                    'Conta Parcial Ferias gerada automáticamente',
                    $strContasAPagarStatus,
                    $intContasAPagarMesRef,
                    $intContasAPagarAnoRef,
                    $CentroCustosIDS,
                    114,
                    $intAdmID);     
            }


            $sql = "UPDATE tb_fechamento_contas SET 
            strFechamentoContasStatus = 'inserido'               
            WHERE intFechamentoContasID = :intFechamentoContasID";
            $query = $this->db->prepare($sql);   
            $query->execute([
                ':intFechamentoContasID'=>$conta->intFechamentoContasID
            ]);  
            
        }
        return true;
    }
}

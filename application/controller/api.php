<?php
session_start();


class Api extends Controller
{
    public function index()
    {
        require APP . 'view/home/index.php';
    }
    public function editarContas()
    {                                   
        echo $this->fechamentoModel->editarInfoConta($_POST['intFechamentoContasID'],$_POST['strFechamentoContasNome'],$_POST['strFechamentoContasValorParcial'],$_POST['strFechamentoContasDebito'],$_POST['strFechamentoContasValorTotal'],$_POST['strFechamentoContasVencimento'],$_POST['strFechamentoContasPlanoOdontologico'],$_POST['strFechamentoContasPlanoSaude'],$_POST['strFechamentoContasPlanoSaudeExtra'],$_POST['strFechamentoContasValorVR'],$_POST['strFechamentoContasValorVT']);
    }
    public function editarCentroCustos()
    {
        echo $this->CentroCustosModel->editarCentroCustos($_POST['strCentroCustosNome'],$_POST['strCentroCustosDesc'],$_POST['intCentroCustosID']);                              
    }
    public function editarPlanoContas()
    {
        echo $this->planoContasModel->editarPlanoContas($_POST['strPlanoContasNome'],$_POST['strPlanoContasDesc'],$_POST['intPlanoContasID']);                              
    }
    public function editarSubPlanoContas()
    {
        echo $this->subPlanoContasModel->editarSubPlanoContas($_POST['strSubPlanoContasNome'],$_POST['strSubPlanoContasDesc'],$_POST['intSubPlanoContasID'],$_POST['intPlanoContasID']);                              
    }
    public function gerarContasAPagar()
    {       
        echo json_encode($this->contasAPagarModel->consultarContasAPagar($_POST['mes'],$_POST['ano'],$_POST['status'],$_POST['CentroCustos'],$_POST['PlanoContas']));    
    }
    public function cadastrarContaAPagar()
    {     
        $vencimento=explode('-',$_POST['vencimentoConta']);
        $vencimento="{$vencimento[2]}/{$vencimento[1]}/{$vencimento[0]}";        
        echo $this->contasAPagarModel-> cadastrarContaAPagar($_POST['nome'],$vencimento,$_POST['valor'],$_POST['desc'],$_POST['status'],$_POST['mes'],$_POST['ano'],$_POST['CentroCustos'],$_POST['PlanoContas']);   
    }
    public function editarContaAPagar()
    {     
        $vencimento=explode('-',$_POST['vencimentoConta']);
        $vencimento="{$vencimento[2]}/{$vencimento[1]}/{$vencimento[0]}";        
        echo $this->contasAPagarModel-> editarContasAPagar($_POST['nome'],$vencimento,$_POST['valor'],$_POST['desc'],$_POST['status'],$_POST['mes'],$_POST['ano'],$_POST['CentroCustos'],$_POST['PlanoContas'],$_GET['id']);   
    }
    public function contas($intClienteID)
    {
        echo json_encode($this->poModel->getAllClientesAccounts($intClienteID));    
    }


}

    

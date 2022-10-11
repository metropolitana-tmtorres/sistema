<?php

class Controller
{
    /**
     * @var null Database Connection
     */
    public $db = null;

    /**
     * @var null Model
     */
    public $model = null;
    public $crmModel = null;
    public $admModel = null;
    public $briefingModel = null;
    public $estoqueModel = null;
    public $coreModel = null;
    public $agenciaModel = null;
    public $fornecedorModel = null;
    public $poModel = null;
    public $moedasModel = null;
    public $clientesModel = null;
    public $segmentosModel = null;
    public $departamentosModel = null;
    public $produtosModel = null;
    public $propostasModel = null;
    public $contratosModel = null;
    public $recebimentosModel = null;
    public $funcionariosModel = null;
    public $carteiraModel = null;
    public $contatosModel = null;
    public $fechamentoModel = null;
    public $CentroCustosModel = null;
    public $contasAPagarModel = null;
    public $planoContasModel = null;
    public $subPlanoContasModel = null;
    public $uploadModel = null;
    public $testeModel = null; //CRIAÇÃO DE NOVA MODEL
    
    /**
     * Whenever controller is created, open a database connection too and load "the model".
     */
    function __construct()
    {
        $this->openDatabaseConnection();
        $this->loadModel();
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
    }

    /**
     * Loads the "model".
     * @return object model
     */
    public function loadModel()
    {
        require APP . 'model/model.php';
        require APP . 'model/crm-model.php';
        require APP . 'model/adm-model.php';
        require APP . 'model/login-model.php';
        require APP . 'model/briefing-model.php';
        require APP . 'model/estoque-model.php';
        require APP . 'model/core-model.php';
        require APP . 'model/agencia-model.php';
        require APP . 'model/fornecedor-model.php';
        require APP . 'model/po-model.php';
        require APP . 'model/moedas-model.php';
        require APP . 'model/clientes-model.php';
        require APP . 'model/segmentos-model.php';
        require APP . 'model/departamentos-model.php';
        require APP . 'model/produtos-model.php';
        require APP . 'model/propostas-model.php';
        require APP . 'model/contratos-model.php';
        require APP . 'model/recebimentos-model.php';
        require APP . 'model/funcionarios-model.php';
        require APP . 'model/carteira-model.php';
        require APP . 'model/contatos-model.php';
        require APP . 'model/fechamento-contas-model.php';
        require APP . 'model/centro-custos-model.php';
        require APP . 'model/contas-a-pagar-model.php';
        require APP . 'model/plano-contas-model.php';
        require APP . 'model/sub-plano-contas-model.php';
        require APP . 'model/upload-model.php';
        require APP . 'model/teste-model.php'; //CRIAÇÃO DE NOVA MODEL
        require APP . 'model/perfil.php'; //CRIAÇÃO DE NOVA MODEL
                
        // create new "model" (and pass the database connection)
        $this->model = new Model($this->db);
        $this->crmModel = new crmModel($this->db);
        $this->admModel = new admModel($this->db);
        $this->loginModel = new loginModel($this->db);
        $this->briefingModel = new briefingModel($this->db);
        $this->estoqueModel = new estoqueModel($this->db);
        $this->coreModel = new coreModel($this->db);
        $this->agenciaModel = new agenciaModel($this->db);
        $this->fornecedorModel = new fornecedorModel($this->db);
        $this->poModel = new poModel($this->db);
        $this->moedasModel = new moedasModel($this->db);
        $this->clientesModel = new clientesModel($this->db);
        $this->segmentosModel = new segmentosModel($this->db);
        $this->departamentosModel = new departamentosModel($this->db);
        $this->produtosModel = new produtosModel($this->db);
        $this->propostasModel = new propostasModel($this->db);
        $this->contratosModel = new contratosModel($this->db);
        $this->recebimentosModel = new recebimentosModel($this->db);
        $this->funcionariosModel = new funcionariosModel($this->db);
        $this->carteiraModel = new carteiraModel($this->db);
        $this->contatosModel = new contatosModel($this->db);
        $this->fechamentoModel = new fechamentoContasModel($this->db);
        $this->CentroCustosModel = new centroCustosModel($this->db);
        $this->contasAPagarModel = new contasAPagarModel($this->db);
        $this->planoContasModel = new planoContasModel($this->db);
        $this->subPlanoContasModel = new SubPlanoContasModel($this->db);
        $this->uploadModel = new uploadModel($this->db);
        $this->testeModel = new testeModel($this->db); //CRIAÇÃO DE NOVA MODEL
        $this->perfilModel = new perfilModel($this->db); //CRIAÇÃO DE NOVA MODEL
    }
}

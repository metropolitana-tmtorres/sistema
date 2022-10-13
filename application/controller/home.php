<?php
session_start();

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

class Home extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        require APP . 'view/home/index.php';
    }

    public function pacotesProdutos($id)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $pacote = $this->produtosModel->getPacoteById($id);

            $ps = $this->produtosModel->getAllProdutosByPacoteID($id);

            // var_dump($ps); exit;

            $produtos = $this->produtosModel->getAllProdutos();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/pacotesprodutos.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function adm()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $deptos = $this->departamentosModel->getAllDepartamentos();

            $usrs = $this->admModel->getAllAdm();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/adm.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function produtos($id = null)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            if (isset($id) && $id != null) {
                $prod = $this->produtosModel->getProdutoById($id);
            }

            $produtos = $this->produtosModel->getAllProdutos();

            $categs = $this->produtosModel->getAllProductCateg();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/produtos.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function rebecimento($id = null)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $contas = $this->contasReceberModel->getAllContasReceber();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/recebimentos.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function cadastraProduto()
    {
        $money = $this->formatMoney($_POST['preco']);
        $money = $this->currencyToDecimal($money);
        $obj = $this->produtosModel->addProduto($_POST['name'], $_POST['categoria'], $_POST['descricao'], $money);

        if ($obj) {
            header("Location: " . URL . "home/produtos?salvo=true");
        } else {
            header("Location: " . URL . "home/produtos?erro=true");
        }
    }

    public function editarProduto()
    {
        $money = $this->formatMoney($_POST['preco']);
        $money = $this->currencyToDecimal($money);
        $obj = $this->produtosModel->editProduto($_POST['name'], $_POST['categoria'], $_POST['descricao'], $money, $_POST['id']);

        if ($obj) {
            header("Location: " . URL . "home/produtos?salvo=true");
        } else {
            header("Location: " . URL . "home/produtos?erro=true");
        }
    }

    public function excluirProduto($id)
    {
        $obj = $this->produtosModel->delProduto($id);

        if ($obj) {
            header("Location: " . URL . "home/produtos?salvo=true");
        } else {
            header("Location: " . URL . "home/produtos?erro=true");
        }
    }

    public function pacotes($id = null)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            if (isset($id) && $id != null) {
                $pacote = $this->produtosModel->getPacoteById($id);
                // $c = explode(',', $pacote->strPacoteProdutos);
            }

            $pacotes = $this->produtosModel->getAllPacotes();
            $produtos = $this->produtosModel->getAllProdutos();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/pacotes.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function cadastraPacote()
    {
        // $ids = implode(",",$_POST["p"]);
        $obj = $this->produtosModel->addPacote($_POST['pacote']);

        if ($obj) {
            header("Location: " . URL . "home/pacotes?salvo=true");
        } else {
            header("Location: " . URL . "home/pacotes?erro=true");
        }
    }

    public function editarPacote()
    {
        // $ids = implode(",",$_POST["p"]);
        $obj = $this->produtosModel->editarPacote($_POST['pacote'], $_POST['id']);

        if ($obj) {
            header("Location: " . URL . "home/pacotes?salvo=true");
        } else {
            header("Location: " . URL . "home/pacotes?erro=true");
        }
    }

    public function excluirPacote($id)
    {
        $obj = $this->produtosModel->delPacote($id);

        if ($obj) {
            header("Location: " . URL . "home/pacotes?salvo=true");
        } else {
            header("Location: " . URL . "home/pacotes?erro=true");
        }
    }

    public function produtosCategoria($id = null)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            if (isset($id) && $id != null) {
                $categ = $this->produtosModel->getProdCategById($id);
            }

            $categorias = $this->produtosModel->getAllProductCateg();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/produtos-categorias.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function cadastraProdCateg()
    {
        $obj = $this->produtosModel->addProdCateg($_POST['categoria']);

        if ($obj) {
            header("Location: " . URL . "home/produtosCategoria?salvo=true");
        } else {
            header("Location: " . URL . "home/produtosCategoria?erro=true");
        }
    }

    public function excluirProdCateg($id)
    {
        $obj = $this->produtosModel->excProdCateg($id);

        if ($obj) {
            header("Location: " . URL . "home/produtosCategoria?salvo=true");
        } else {
            header("Location: " . URL . "home/produtosCategoria?erro=true");
        }
    }

    public function editaProdCateg()
    {
        $obj = $this->produtosModel->editProdCateg($_POST['categoria'], $_POST['categid']);

        if ($obj) {
            header("Location: " . URL . "home/produtosCategoria?salvo=true");
        } else {
            header("Location: " . URL . "home/produtosCategoria?erro=true");
        }
    }

    public function departamentos()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $deptos = $this->departamentosModel->getAllDepartamentos();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/departamentos.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function registerDepartamento()
    {
        $obj = $this->departamentosModel->addDepartamento($_POST['name']);

        if ($obj) {
            header("Location: " . URL . "home/departamentos?salvo=true");
        } else {
            header("Location: " . URL . "home/departamentos?erro=true");
        }
    }


    public function addDeptoCargo($id)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $depto = $this->departamentosModel->getDepartamentoByID($id);

            $cargos = $this->admModel->getAllJobRole();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/add-depto-cargo.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function getAllRolesByDeptoID($id)
    {
        $obj = $this->admModel->getAllRolesByDeptoID($id);

?>
        <label for="">Cargo</label>
        <select name="cargo" class="form-control">
            <?php foreach ($obj as $c) : ?>
                <option value="<?php echo $c->intCargoID; ?>"><?php echo $c->strCargoNome; ?></option>
            <?php endforeach; ?>
        </select>
    <?php

    }

    public function teste()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $teste = $this->testeModel->getAllTesteInactive();

            // var_dump($adm); exit;

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/teste.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function dashboard()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            // var_dump($adm); exit;

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/dashboard.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function estoque()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $estoque = $this->estoqueModel->getAllEstoque();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/estoque.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function verCliente($id)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $c = $this->clientesModel->getClienteByID($id);
            if ($c->intAgenciaID != 0) :
                $agencia = $this->agenciaModel->getAgenciaNomeByID($c->intAgenciaID);
            endif;
            $segmento = $this->segmentosModel->getSegmentoNomeByID($c->intSegmentoID);

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/ver-cliente.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function agencias()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $cargos = $this->admModel->getAllJobRole();

            $agencias = $this->agenciaModel->getAllAgencias();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/agencias.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }



    public function checkVisible($role)
    {
        switch ($role) {
            case '4':
                $visibility = 'all';
                break;

            case '2':
                $visibility = 'all';
                break;

            case '1':
                $visibility = 'all';
                break;

            default:
                $visibility = 'my';
                break;
        }

        return $visibility;
    }

    public function contas()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $visib = $this->checkVisible($adm->intCargoID);

            if ($visib == "all") :
                $contas = $this->clientesModel->getAllContas();
            else :
                $contas = $this->clientesModel->getMyContas($_SESSION['admID']);
            endif;


            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/contas.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function contatos()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            // $visib = $this->checkVisible($adm->intCargoID);

            $contas = $this->clientesModel->getAllContatos();


            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/contato.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function verConta($id)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $c = $this->clientesModel->getContaByID($id);

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/ver-conta.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function adicionarConta()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $segmentos = $this->segmentosModel->getAllSegmentos();
            $agencias = $this->agenciaModel->getAllAgencias();
            $clientes = $this->clientesModel->getAllClientes();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/contasform.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function addConta()
    {
        if (!isset($_POST['agencia'])) {
            $agencia = 0;
        } else {
            $agencia = $_POST['agencia'];
        }

        $obj = $this->clientesModel->addConta(
            $_POST['nome'],
            $_POST['segmento'],
            $agencia,
            $_POST['contato'],
            $_POST['cargo'],
            $_POST['email'],
            $_POST['telefone'],
            $_POST['celular'],
            $_POST['cliente'],
            $_POST['adm']
        );

        if ($obj) {
            header("Location: " . URL . "home/contas?salvo=true");
        } else {
            header("Location: " . URL . "home/contas?erro=true");
        }
    }

    public function editarConta($id)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $segmentos = $this->segmentosModel->getAllSegmentos();
            $agencias = $this->agenciaModel->getAllAgencias();
            $clientes = $this->clientesModel->getAllClientes();
            $conta = $this->clientesModel->getContaByID($id);

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/contasform-editar.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function editConta()
    {
        $obj = $this->clientesModel->editConta($_POST['nome'], $_POST['segmento'], $_POST['agencia'], $_POST['contato'], $_POST['cargo'], $_POST['email'], $_POST['telefone'], $_POST['celular'], $_POST['cliente'], $_POST['adm'], $_POST['conta']);
        if ($obj) {
            header("Location: " . URL . "home/contas?salvo=true");
        } else {
            header("Location: " . URL . "home/contas?erro=true");
        }
    }

    public function po()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $po = $this->poModel->getAllPo();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/po.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function propostas()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $propostas = $this->propostasModel->getAllPropostas();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/propostas.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function getClienteByID($id)
    {
        $cliente = $this->propostasModel->getClienteByPoID($id);

        return $cliente;
    }

    public function getStatusByID($id)
    {
        $status = $this->propostasModel->getStatusByPoID($id);

        return $status;
    }

    public function getCrmByID($id)
    {
        $crm = $this->propostasModel->getCrmByPoID($id);

        return $crm;
    }

    public function getBriefingsByCrmID($id)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $codeShow = $this->showCode($id, 'C');
            $crm = $this->crmModel->getCrmByID($id);
            $briefings = $this->briefingModel->getBriefingsByCrmID($id);
            $conta = $this->clientesModel->getContaByID($crm->intContaID);
            $cliente = $this->clientesModel->getClienteByID($crm->intClienteID);

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/crm-briefings.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function getBriefingIdByID($id)
    {
        $briefingId = $this->propostasModel->getBriefingIdByPoID($id);

        return $briefingId;
    }

    public function getClienteNameByID($id)
    {
        $clienteName = $this->poModel->getClienteNameByPoID($id);

        return $clienteName;
    }

    public function getCrmNameByID($id)
    {
        $crmName = $this->poModel->getCrmNameByPoID($id);

        return $crmName;
    }

    public function getFornecedorByID($id)
    {
        $fornecedor = $this->fornecedorModel->getFornecedorByID($id);

        return $fornecedor;
    }

    public function getFornecedorNomeByID($id)
    {
        $fornecedorNome = $this->poModel->getFornecedorNomeByPoID($id);

        return $fornecedorNome;
    }

    public function getClienteCnpj($id)
    {
        $clienteCnpj = $this->contratosModel->getClienteCnpjByID($id);

        return $clienteCnpj;
    }

    public function getAgenciaCnpj($id)
    {
        $agenciaCnpj = $this->contratosModel->getAgenciaCnpjByID($id);

        return $agenciaCnpj;
    }

    public function getAdmNome($id)
    {
        $admNome = $this->contratosModel->getAdmNomeById($id);

        return $admNome;
    }

    public function getMoedaByID($id)
    {
        $moeda = $this->poModel->getMoedaByPoId($id);

        return $moeda;
    }

    public function podata($id = NULL)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $po = $this->poModel->getPoByID($id);
            $poData = $this->poModel->getAllPoData();
            $c = $this->getClienteNameByID($po->intClienteID);
            $conta = $this->clientesModel->getContaByID($po->intContaID);

            $crm = $this->crmModel->getCrmByID($po->intCrmID);
            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/podata.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function verPoData($id)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $po = $this->poModel->getPoDataByID($id);

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/verpodata.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function contratos($id = NULL)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $contratos = $this->contratosModel->getAllContratos();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/contratos.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function verContrato($id)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $c = $this->contratosModel->getContratoByID($id);

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/vercontrato.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function fornecedores()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $fornecedor = $this->fornecedorModel->getAllFornecedores();

            //$cargos = $this->admModel->getAllJobRole();
            //$jobRole = $this->admModel->getAdmJobRoleByID($_SESSION['admID']);
            //$perm = $this->admModel->getJobRolePermissionsByID($jobRole);
            //$permissions = explode(',', $perm->strCargoAccess);
            // $fornecedor = [];
            // if (in_array('fornecedores-ver-tudo', $permissions))
            //   $fornecedor = $this->fornecedorModel->getAllFornecedores();
            // else if (in_array('fornecedores-ver-meus', $permissions))
            //    $fornecedor = $this->fornecedorModel->getMyFornecedores($_SESSION['admID']);
            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/fornecedores.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }


    public function createBriefing($crmID, $briefingID = null)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $crm = $this->crmModel->getCrmByID($crmID);
            $codeShow = $this->showCode($crm->intCrmID, 'C');
            $prod = $this->produtosModel->getAllProdutos();
            $pack = $this->produtosModel->getAllPacotes();
            $conta = $this->clientesModel->getContaByID($crm->intContaID);
            $cliente = $this->clientesModel->getClienteByID($crm->intClienteID);
            if ($briefingID == null) :
                $obj = $this->briefingModel->saveBriefing($_SESSION['admID'], $crm->intCrmID);
                $briefingID = $obj->intBriefingID;
            else :
                $item = $this->briefingModel->getProdutosByBriefingID($briefingID);
            endif;

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/new-briefing.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function briefings($crm, $brief = null)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $crm = $this->crmModel->getCrmByID($crm);
            $codeShow = $this->showCode($crm->intCrmID, 'C');
            $b = $this->briefingModel->getAllBriefingByID($brief);
            $prod = $this->produtosModel->getAllProdutos();
            $pack = $this->produtosModel->getAllPacotes();

            $product = explode(',', $b->strBriefingProds);
            $package = explode(',', $b->strBriefingPacks);
            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/briefing.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function allBriefings()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $briefings = $this->briefingModel->getAllBriefings();
            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/briefings.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function saveBriefingStatus()
    {
        if ($_POST['status'] == 'a') :
            $obj = $this->briefingModel->saveBriefingStatus($_POST['status'], $_POST['crmID']);
            $crm = $this->crmModel->getCrmByID($_POST['crmID']);
        else :
            $obj = $this->briefingModel->saveBriefingStatus($_POST['status'], $_POST['crmID']);
        endif;

        if (isset($crm)) {
            header("Location: " . URL . "home/clientes?add=true&client=" . $crm->strCrmFantasia);
        } elseif (isset($obj)) {
            header("Location: " . URL . "home/allbriefings?salvo=true");
        } else {
            header("Location: " . URL . "home/allbriefings?erro=true");
        }
    }

    public function estoqueItem($id)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $p = $this->estoqueModel->getEstoqueByID($id);
            $saidas = $this->estoqueModel->getSaidasByProdutoID($id);
            $entradas = $this->estoqueModel->getEntradasByProdutoID($id);
            $entregaObs = $this->estoqueModel->getEstoqueEntregaObsByEstoqueEntradaID($id);
            $saidaObs = $this->estoqueModel->getEstoqueEntregaObsByEstoqueSaidaID($id);
            // $entradas = $this->estoqueModel->getEntradasByProdutoID($id);
            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/ver-estoque.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function crm()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $jobRole = $this->admModel->getAdmJobRoleByID($_SESSION['admID']);
            $perm = $this->admModel->getJobRolePermissionsByID($jobRole);
            $permissions = explode(',', $perm->strCargoAccess);

            $clients = $this->clientesModel->getAllClientes();

            if (isset($_POST['filtrastatus']) && $_POST['filtrastatus'] != 't') {
                if (in_array('crm-ver-meus', $permissions)) {

                    $crm = $this->crmModel->getAllCrmByStatusByUser($_POST['filtrastatus'], $adm->intAdmID);
                } else if (in_array('crm-ver-tudo', $permissions)) {

                    $crm = $this->crmModel->getAllCrmByStatus($_POST['filtrastatus']);
                }
            } else {
                if (in_array('crm-ver-meus', $permissions)) {
                    $crm = $this->crmModel->getAllCrmByUser($adm->intAdmID);
                } else if (in_array('crm-ver-tudo', $permissions)) {
                    $crm = $this->crmModel->getAllCrm();
                }
            }
            $crm = $this->crmModel->getAllCrm();
            if (!empty($crm)) {
                $code = $this->generateCode();
            } else {
                $code = "C0001";
            }


            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/crm.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function orcamentos()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $jobRole = $this->admModel->getAdmJobRoleByID($_SESSION['admID']);
            $code = $this->generateCode();
            $crm = $this->crmModel->getAllCrmByStatus('o');

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/orcamentos.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function cargos()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $cargos = $this->admModel->getAllJobRole();
            $deptos = $this->departamentosModel->getAllDepartamentos();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/cargo.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function moedas()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $moedas = $this->moedasModel->getAllMoedas();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/moedas.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function segmentos()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $segmentos = $this->segmentosModel->getAllSegmentos();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/segmentos.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function registerSegmento()
    {
        $obj = $this->segmentosModel->registerSegmento($_POST['name']);

        if ($obj) {
            header("Location: " . URL . "home/segmentos?salvo=true");
        } else {
            header("Location: " . URL . "home/segmentos?erro=true");
        }
    }

    public function registerMoeda()
    {
        $obj = $this->moedasModel->registerMoeda($_POST['name'], $_POST['sinal']);

        if ($obj) {
            header("Location: " . URL . "home/moedas?salvo=true");
        } else {
            header("Location: " . URL . "home/moedas?erro=true");
        }
    }

    public function intervencoes($id)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $int = $this->crmModel->getAllIntervencoesByID($id);
            $b = $this->briefingModel->getAllBriefingByCRM($id);
            $crm = $this->crmModel->getCrmByID($id);
            $codeShow = $this->showCode($crm->intCrmID, 'C');

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/intervencao.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }


    public function mudarCargo($id)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $cargos = $this->admModel->getAllJobRole();
            $cargoID = $id;

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/mudar-cargo.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function excluirAdm($id)
    {
        header("Location: " . URL . "home/deladm/" . $id);
    }

    public function delAdm($id)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $u = $this->admModel->getAdmByID($id);
            $usrID = $id;

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/del-adm.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function permissoes()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $cargos = $this->admModel->getAllJobRole();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/permissoes.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function excAdm($id)
    {
        $obj = $this->admModel->excAdm($id);

        if ($obj) {
            header("Location: " . URL . "home/adm?salvo=true");
        }
    }

    public function cadastraCrm()
    {
        $obj = $this->crmModel->cadastraCrm($_POST['contato'], $_POST['mail'], $_POST['telefone'], $_POST['funcao'], $_POST['status'], $_POST['adm'], $_POST['cliente'], $_POST['conta']);

        if ($obj) {
            header("Location: " . URL . "home/crm?salvo=true");
        } else {
            header("Location: " . URL . "home/crm?erro=true");
        }
    }

    public function login()
    {

        $obj = $this->loginModel->login($_POST['mail'], md5($_POST['pass']));

        if ($obj != 'inactive') :
            if (isset($obj->intAdmID)) {
                $_SESSION['admID'] = $obj->intAdmID;
                header("Location: " . URL . "home/dashboard");
            } else {
                header("Location: " . URL . "home?error=data");
            }
        else :
            header("Location: " . URL . "home?error=inactive");
        endif;
    }

    public function isLogged()
    {
        if (isset($_SESSION['admID'])) {
            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        unset($_SESSION['admID']);
        session_destroy();
        header("Location: " . URL . "?logout=true");
    }

    public function gen_uid($l = 6)
    {
        return substr(str_shuffle("0123456789"), 0, $l);
    }

    public function addAdm()
    {
        $obj = $this->admModel->addAdm($_POST['name'], $_POST['mail'], md5($_POST['pass']), $_POST['depto'], $_POST['cargo']);

        if ($obj) {
            header("Location: " . URL . "home/adm?salvo=true");
        } else {
            header("Location: " . URL . "home/adm?erro=true");
        }
    }

    public function editAdm()
    {

        if (empty($_POST['pass'])) {
            $obj = $this->admModel->editAdm($_POST['name'], $_POST['mail'], $_POST['depto'], $_POST['cargo'], $_POST['id']);
        } else {
            $obj = $this->admModel->editAdmPassword(md5($_POST['pass']), $_POST['id']);
            $obj = $this->admModel->editAdm($_POST['name'], $_POST['mail'], $_POST['depto'], $_POST['cargo'], $_POST['id']);
        }

        if ($obj) {
            header("Location: " . URL . "home/adm?salvo=true");
        } else {
            header("Location: " . URL . "home/adm?erro=true");
        }
    }

    public function cadastraCargo()
    {
        $obj = $this->admModel->registerJobRole($_POST['depto'], $_POST['cargo']);
        // $cp = $this->admModel->createJobRolePermission($obj);

        if ($obj) {
            header("Location: " . URL . "home/cargos?salvo=true");
        } else {
            header("Location: " . URL . "home/cargos?erro=true");
        }
    }

    public function excluirCargo($id)
    {
        $cargoCount = $this->admModel->getAllUsersByJobRoleIDNum($id);

        if ($cargoCount >= 1) {
            header("Location: " . URL . "home/mudarcargo/" . $id);
        } else {
            $obj = $this->admModel->deleteJobRole($id);

            if ($obj) {
                header("Location: " . URL . "home/cargos?salvo=true");
            } else {
                header("Location: " . URL . "home/cargos?erro=true");
            }
        }
    }

    public function changeAndDeleteUsersJobRole()
    {
        $obj = $this->admModel->changeUsersJobRole($_POST['old'], $_POST['new']);

        if ($obj) {
            $del = $this->admModel->deleteJobRole($_POST['old']);

            header("Location: " . URL . "home/cargos?salvo=true");
        }
    }

    public function cadastraIntervencao()
    {
        $obj = $this->crmModel->addIntervencao($_POST['historico'], $_POST['crmid']);
        if ($obj) {
            header("Location: " . URL . "home/intervencoes/" . $_POST['crmid'] . "?salvo=true");
        } else {
            header("Location: " . URL . "home/intervencoes/" . $_POST['crmid'] . "?erro=true");
        }
    }

    public function gravaData($data)
    {
        $d = explode('/', $data);
        $nd = $d[2] . '-' . $d[1] . '-' . $d[0];

        return $nd;
    }

    public function mostraData($data)
    {
        $d = explode('-', $data);
        $nd = $d[2] . '/' . $d[1] . '/' . $d[0];

        return $nd;
    }

    public function mostraStatus($status)
    {
        if ($status == "NE") {
            echo "Negativa";
        } elseif ($status == "AN") {
            echo "Andamento";
        } elseif ($status == "AP") {
            echo "Aprovada";
        } else {
            echo "Entregue";
        }
    }

    public function mostraTipo($tipo)
    {
        if ($tipo == "pp") {
            echo "PP";
        } elseif ($tipo == "c") {
            echo "Contrato";
        } else {
            echo "PI";
        }
    }

    public function showCode($id, $preffix)
    {
        return $preffix . '_' . str_pad($id, 4, "0", STR_PAD_LEFT);
    }

    public function checkAccess($url, $id)
    {
        $cID = $this->admModel->getAdmJobRoleByID($id);
        $jID = $this->admModel->getJobRolePermissionsByID($cID);
        if (in_array($url, $jID)) {
            return true;
        } else {
            return false;
        }
    }

    public function getUrl()
    {
        $base = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);

        return $base;
    }

    public function registerPermission()
    {
        $ids = implode(",", $_POST["p"]);
        $obj = $this->admModel->registerPermission($_POST['cargo'], $ids);

        if ($obj) {
            header("Location: " . URL . "home/permissoes?salvo=true");
        } else {
            header("Location: " . URL . "home/permissoes?erro=true");
        }
    }

    public function getJobRolePermissionsByID($id)
    {
        $p = $this->admModel->getJobRolePermissionsByID($id);

        $c = explode(',', $p->strCargoAccess ?? '');
    ?>

        <div class="content">
            <fieldset>
                <legend>Comercial</legend>
                <div class="checkbox">
                    <label>
                        <input name="p[]" value="crm" <?php if (in_array('crm', $c)) {
                                                            echo 'checked';
                                                        } ?> type="checkbox" onclick="showHide('crmOpt')"> CRM
                    </label>
                    <div id="crmOpt" class="optPerm" <?php if (in_array('crm', $c)) {
                                                            echo 'style="display:block;"';
                                                        } else {
                                                            echo 'style="display:none;"';
                                                        } ?>>
                        <label>
                            <input name="p[]" <?php if (in_array('crm-ver-tudo', $c)) {
                                                    echo 'checked';
                                                } ?> value="crm-ver-tudo" type="checkbox"> Ver Tudo
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('crm-ver-meus', $c)) {
                                                    echo 'checked';
                                                } ?> value="crm-ver-meus" type="checkbox"> Ver Meus
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('crm-add', $c)) {
                                                    echo 'checked';
                                                } ?> value="crm-add" type="checkbox"> Cadastrar
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('crm-editar', $c)) {
                                                    echo 'checked';
                                                } ?> value="crm-editar" type="checkbox"> Editar
                        </label>
                        <!-- <label>
                    <input name="p[]" <?php if (in_array('crm-approve', $c)) {
                                            echo 'checked';
                                        } ?>  value="crm-approve" type="checkbox"> Aprovar
                </label> -->
                    </div>
                </div>
                <div class="checkbox">
                    <label>
                        <input name="p[]" value="briefing" <?php if (in_array('briefing', $c)) {
                                                                echo 'checked';
                                                            } ?> type="checkbox" onclick="showHide('briefingOpt')"> Briefing
                    </label>
                    <div id="briefingOpt" class="optPerm" <?php if (in_array('briefing', $c)) {
                                                                echo 'style="display:block;"';
                                                            } else {
                                                                echo 'style="display:none;"';
                                                            } ?>>
                        <label>
                            <input name="p[]" <?php if (in_array('briefing-ver', $c)) {
                                                    echo 'checked';
                                                } ?> value="briefing-ver" type="checkbox"> Ver
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('briefing-add', $c)) {
                                                    echo 'checked';
                                                } ?> value="briefing-add" type="checkbox"> Cadastrar
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('briefing-editar', $c)) {
                                                    echo 'checked';
                                                } ?> value="briefing-editar" type="checkbox"> Editar
                        </label>
                        <!-- <label>
                    <input name="p[]" <?php if (in_array('briefing-approve', $c)) {
                                            echo 'checked';
                                        } ?>  value="briefing-approve" type="checkbox"> Aprovar
                </label> -->
                    </div>
                </div>
                <div class="checkbox">
                    <label>
                        <input name="p[]" value="contratos" <?php if (in_array('contratos', $c)) {
                                                                echo 'checked';
                                                            } ?> type="checkbox" onclick="showHide('contratosOpt')"> Contratos
                    </label>
                    <div id="contratosOpt" class="optPerm" <?php if (in_array('contratos', $c)) {
                                                                echo 'style="display:block;"';
                                                            } else {
                                                                echo 'style="display:none;"';
                                                            } ?>>
                        <label>
                            <input name="p[]" <?php if (in_array('contratos-ver', $c)) {
                                                    echo 'checked';
                                                } ?> value="contratos-ver" type="checkbox"> Ver
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('contratos-add"', $c)) {
                                                    echo 'checked';
                                                } ?> value="contratos-add" type="checkbox"> Cadastrar
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('contratos-editar', $c)) {
                                                    echo 'checked';
                                                } ?> value="contratos-editar" type="checkbox"> Editar
                        </label>
                        <!-- <label>
                    <input name="p[]" <?php if (in_array('contratos-approve', $c)) {
                                            echo 'checked';
                                        } ?>  value="contratos-approve" type="checkbox"> Aprovar
                </label> -->
                    </div>
                </div>
                <div class="checkbox">
                    <label>
                        <input name="p[]" value="vendedores" <?php if (in_array('vendedores', $c)) {
                                                                    echo 'checked';
                                                                } ?> type="checkbox" onclick="showHide('vendedoresOpt')"> Vendedores
                    </label>
                    <div id="vendedoresOpt" class="optPerm" <?php if (in_array('vendedores', $c)) {
                                                                echo 'style="display:block;"';
                                                            } else {
                                                                echo 'style="display:none;"';
                                                            } ?>>
                        <label>
                            <input name="p[]" <?php if (in_array('vendedores-ver', $c)) {
                                                    echo 'checked';
                                                } ?> value="vendedores-ver" type="checkbox"> Ver
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('vendedores-add', $c)) {
                                                    echo 'checked';
                                                } ?> value="vendedores-add" type="checkbox"> Cadastrar
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('vendedores-editar', $c)) {
                                                    echo 'checked';
                                                } ?> value="vendedores-editar" type="checkbox"> Editar
                        </label>
                        <!-- <label>
                    <input name="p[]" <?php if (in_array('vendedores-approve', $c)) {
                                            echo 'checked';
                                        } ?>  value="vendedores-approve" type="checkbox"> Aprovar
                </label> -->
                    </div>
                </div>
                <div class="checkbox">
                    <label>
                        <input name="p[]" value="agencias" <?php if (in_array('agencias', $c)) {
                                                                echo 'checked';
                                                            } ?> type="checkbox" onclick="showHide('agenciasOpt')"> Agências
                    </label>
                    <div id="agenciasOpt" class="optPerm" <?php if (in_array('agencias', $c)) {
                                                                echo 'style="display:block;"';
                                                            } else {
                                                                echo 'style="display:none;"';
                                                            } ?>>
                        <label>
                            <input name="p[]" <?php if (in_array('agencias-ver', $c)) {
                                                    echo 'checked';
                                                } ?> value="agencias-ver" type="checkbox"> Ver
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('agencias-add', $c)) {
                                                    echo 'checked';
                                                } ?> value="agencias-add" type="checkbox"> Cadastrar
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('agencias-editar', $c)) {
                                                    echo 'checked';
                                                } ?> value="agencias-editar" type="checkbox"> Editar
                        </label>
                        <!-- <label>
                    <input name="p[]" <?php if (in_array('agencias-approve', $c)) {
                                            echo 'checked';
                                        } ?>  value="agencias-approve" type="checkbox"> Aprovar
                </label> -->
                    </div>
                </div>
                <div class="checkbox">
                    <label>
                        <input name="p[]" value="clientes" <?php if (in_array('clientes', $c)) {
                                                                echo 'checked';
                                                            } ?> type="checkbox" onclick="showHide('clientesOpt')"> Clientes
                    </label>
                    <div id="clientesOpt" class="optPerm" <?php if (in_array('clientes', $c)) {
                                                                echo 'style="display:block;"';
                                                            } else {
                                                                echo 'style="display:none;"';
                                                            } ?>>
                        <label>
                            <input name="p[]" <?php if (in_array('clientes-ver', $c)) {
                                                    echo 'checked';
                                                } ?> value="clientes-ver" type="checkbox"> Ver
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('clientes-add', $c)) {
                                                    echo 'checked';
                                                } ?> value="clientes-add" type="checkbox"> Cadastrar
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('clientes-editar"', $c)) {
                                                    echo 'checked';
                                                } ?> value="clientes-editar" type="checkbox"> Editar
                        </label>
                        <!-- <label>
                    <input name="p[]" <?php if (in_array('clientes-approve', $c)) {
                                            echo 'checked';
                                        } ?>  value="clientes-approve" type="checkbox"> Aprovar
                </label> -->
                    </div>
                </div>
                <div class="checkbox">
                    <label>
                        <input name="p[]" value="propostas" <?php if (in_array('propostas', $c)) {
                                                                echo 'checked';
                                                            } ?> type="checkbox" onclick="showHide('propostasOpt')"> Propostas (Orçamentos)
                    </label>
                    <div id="propostasOpt" class="optPerm" <?php if (in_array('propostas', $c)) {
                                                                echo 'style="display:block;"';
                                                            } else {
                                                                echo 'style="display:none;"';
                                                            } ?>>
                        <label>
                            <input name="p[]" <?php if (in_array('propostas-ver', $c)) {
                                                    echo 'checked';
                                                } ?> value="propostas-ver" type="checkbox"> Ver
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('propostas-add', $c)) {
                                                    echo 'checked';
                                                } ?> value="propostas-add" type="checkbox"> Cadastrar
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('propostas-editar', $c)) {
                                                    echo 'checked';
                                                } ?> value="propostas-editar" type="checkbox"> Editar
                        </label>
                        <!-- <label>
                    <input name="p[]" <?php if (in_array('propostas-approve', $c)) {
                                            echo 'checked';
                                        } ?>  value="propostas-approve" type="checkbox"> Aprovar
                </label> -->
                    </div>
                </div>
                <div class="checkbox">
                    <label>
                        <input name="p[]" value="po" <?php if (in_array('po', $c)) {
                                                            echo 'checked';
                                                        } ?> type="checkbox" onclick="showHide('poOpt')"> Planilha Orçamentária
                    </label>
                    <div id="poOpt" class="optPerm" <?php if (in_array('po', $c)) {
                                                        echo 'style="display:block;"';
                                                    } else {
                                                        echo 'style="display:none;"';
                                                    } ?>>
                        <label>
                            <input name="p[]" <?php if (in_array('po-ver', $c)) {
                                                    echo 'checked';
                                                } ?> value="po-ver" type="checkbox"> Ver
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('po-add', $c)) {
                                                    echo 'checked';
                                                } ?> value="po-add" type="checkbox"> Cadastrar
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('po-editar', $c)) {
                                                    echo 'checked';
                                                } ?> value="po-editar" type="checkbox"> Editar
                        </label>
                        <!-- <label>
                    <input name="p[]" <?php if (in_array('po-approve', $c)) {
                                            echo 'checked';
                                        } ?>  value="po-approve" type="checkbox"> Aprovar
                </label> -->
                    </div>
                </div>
                <div class="checkbox">
                    <label>
                        <input name="p[]" value="dc" <?php if (in_array('dc', $c)) {
                                                            echo 'checked';
                                                        } ?> type="checkbox" onclick="showHide('dcOpt')"> Divisão de Contrato
                    </label>
                    <div id="dcOpt" class="optPerm" <?php if (in_array('dc', $c)) {
                                                        echo 'style="display:block;"';
                                                    } else {
                                                        echo 'style="display:none;"';
                                                    } ?>>
                        <label>
                            <input name="p[]" <?php if (in_array('dc-ver', $c)) {
                                                    echo 'checked';
                                                } ?> value="dc-ver" type="checkbox"> Ver
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('dc-add', $c)) {
                                                    echo 'checked';
                                                } ?> value="dc-add" type="checkbox"> Cadastrar
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('dc-editar', $c)) {
                                                    echo 'checked';
                                                } ?> value="dc-editar" type="checkbox"> Editar
                        </label>
                        <!-- <label>
                    <input name="p[]" <?php if (in_array('dc-approve', $c)) {
                                            echo 'checked';
                                        } ?>  value="dc-approve" type="checkbox"> Aprovar
                </label> -->
                    </div>
                </div>
                <div class="checkbox">
                    <label>
                        <input name="p[]" value="segmentos" <?php if (in_array('segmentos', $c)) {
                                                                echo 'checked';
                                                            } ?> type="checkbox" onclick="showHide('segmentosOpt')"> Segmentos
                    </label>
                    <div id="segmentosOpt" class="optPerm" <?php if (in_array('segmentos', $c)) {
                                                                echo 'style="display:block;"';
                                                            } else {
                                                                echo 'style="display:none;"';
                                                            } ?>>
                        <label>
                            <input name="p[]" <?php if (in_array('segmentos-ver', $c)) {
                                                    echo 'checked';
                                                } ?> value="segmentos-ver" type="checkbox"> Ver
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('segmentos-add', $c)) {
                                                    echo 'checked';
                                                } ?> value="segmentos-add" type="checkbox"> Cadastrar
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('segmentos-editar', $c)) {
                                                    echo 'checked';
                                                } ?> value="segmentos-editar" type="checkbox"> Editar
                        </label>
                        <!-- <label>
                    <input name="p[]" <?php if (in_array('segmentos-approve', $c)) {
                                            echo 'checked';
                                        } ?>  value="segmentos-approve" type="checkbox"> Aprovar
                </label> -->
                    </div>
                </div>
                <div class="checkbox">
                    <label>
                        <input name="p[]" value="contas" <?php if (in_array('contas', $c)) {
                                                                echo 'checked';
                                                            } ?> type="checkbox" onclick="showHide('contasOpt')"> Contas
                    </label>
                    <div id="contasOpt" class="optPerm" <?php if (in_array('contas', $c)) {
                                                            echo 'style="display:block;"';
                                                        } else {
                                                            echo 'style="display:none;"';
                                                        } ?>>
                        <label>
                            <input name="p[]" <?php if (in_array('contas-ver', $c)) {
                                                    echo 'checked';
                                                } ?> value="contas-ver" type="checkbox"> Ver
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('contas-add', $c)) {
                                                    echo 'checked';
                                                } ?> value="contas-add" type="checkbox"> Cadastrar
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('contas-editar', $c)) {
                                                    echo 'checked';
                                                } ?> value="contas-editar" type="checkbox"> Editar
                        </label>
                        <!-- <label>
                    <input name="p[]" <?php if (in_array('contas-approve', $c)) {
                                            echo 'checked';
                                        } ?>  value="contas-approve" type="checkbox"> Aprovar
                </label> -->
                    </div>
                </div>
                <div class="checkbox">
                    <label>
                        <input name="p[]" value="carteira" <?php if (in_array('carteira', $c)) {
                                                                echo 'checked';
                                                            } ?> type="checkbox" onclick="showHide('carteiraOpt')"> Carteira de Clientes
                    </label>
                    <div id="carteiraOpt" class="optPerm" <?php if (in_array('carteira', $c)) {
                                                                echo 'style="display:block;"';
                                                            } else {
                                                                echo 'style="display:none;"';
                                                            } ?>>
                        <label>
                            <input name="p[]" <?php if (in_array('carteira-ver', $c)) {
                                                    echo 'checked';
                                                } ?> value="carteira-ver" type="checkbox"> Ver
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('carteira-add', $c)) {
                                                    echo 'checked';
                                                } ?> value="carteira-add" type="checkbox"> Cadastrar
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('carteira-editar', $c)) {
                                                    echo 'checked';
                                                } ?> value="carteira-editar" type="checkbox"> Editar
                        </label>
                        <!-- <label>
                    <input name="p[]" <?php if (in_array('carteira-approve', $c)) {
                                            echo 'checked';
                                        } ?>  value="carteira-approve" type="checkbox"> Aprovar
                </label> -->
                    </div>
                </div>
                <div class="checkbox">
                    <label>
                        <input name="p[]" value="produtos" <?php if (in_array('produtos', $c)) {
                                                                echo 'checked';
                                                            } ?> type="checkbox" onclick="showHide('produtosOpt')"> Produtos e Pacotes
                    </label>
                    <div id="produtosOpt" class="optPerm" <?php if (in_array('produtos', $c)) {
                                                                echo 'style="display:block;"';
                                                            } else {
                                                                echo 'style="display:none;"';
                                                            } ?>>
                        <label>
                            <input name="p[]" <?php if (in_array('produtos-ver', $c)) {
                                                    echo 'checked';
                                                } ?> value="produtos-ver" type="checkbox"> Ver
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('produtos-add', $c)) {
                                                    echo 'checked';
                                                } ?> value="produtos-add" type="checkbox"> Cadastrar
                        </label>
                        <label>
                            <input name="p[]" <?php if (in_array('produtos-editar', $c)) {
                                                    echo 'checked';
                                                } ?> value="produtos-editar" type="checkbox"> Editar
                        </label>
                        <!-- <label>
                    <input name="p[]" <?php if (in_array('produtos-approve', $c)) {
                                            echo 'checked';
                                        } ?>  value="produtos-approve" type="checkbox"> Aprovar
                </label> -->
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="content">
            <fieldset>
                <legend>Administrativo</legend>
                <div class="checkbox">
                    <label>
                        <input name="p[]" value="departamentos" <?php if (in_array('departamentos', $c)) {
                                                                    echo 'checked';
                                                                } ?> type="checkbox" onclick="showHide('departamentosOpt')"> Departamentos
                    </label>
                </div>
                <div id="departamentosOpt" class="optPerm" <?php if (in_array('departamentos', $c)) {
                                                                echo 'style="display:block;"';
                                                            } else {
                                                                echo 'style="display:none;"';
                                                            } ?>>
                    <label>
                        <input name="p[]" <?php if (in_array('departamentos-ver-tudo', $c)) {
                                                echo 'checked';
                                            } ?> value="departamentos-ver-tudo" type="checkbox"> Ver Tudo
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('departamentos-ver-meus', $c)) {
                                                echo 'checked';
                                            } ?> value="departamentos-ver-meus" type="checkbox"> Ver Meus
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('departamentos-add', $c)) {
                                                echo 'checked';
                                            } ?> value="departamentos-add" type="checkbox"> Cadastrar
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('departamentos-editar', $c)) {
                                                echo 'checked';
                                            } ?> value="departamentos-editar" type="checkbox"> Editar
                    </label>
                </div>

                <div class="checkbox">
                    <label>
                        <input name="p[]" value="cargos" <?php if (in_array('cargos', $c)) {
                                                                echo 'checked';
                                                            } ?> type="checkbox" onclick="showHide('cargosOpt')"> Cargos
                    </label>
                </div>
                <div id="cargosOpt" class="optPerm" <?php if (in_array('cargos', $c)) {
                                                        echo 'style="display:block;"';
                                                    } else {
                                                        echo 'style="display:none;"';
                                                    } ?>>
                    <label>
                        <input name="p[]" <?php if (in_array('cargos-ver-tudo', $c)) {
                                                echo 'checked';
                                            } ?> value="cargos-ver-tudo" type="checkbox"> Ver Tudo
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('cargos-ver-meus', $c)) {
                                                echo 'checked';
                                            } ?> value="cargos-ver-meus" type="checkbox"> Ver Meus
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('cargos-add', $c)) {
                                                echo 'checked';
                                            } ?> value="cargos-add" type="checkbox"> Cadastrar
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('cargos-editar', $c)) {
                                                echo 'checked';
                                            } ?> value="cargos-editar" type="checkbox"> Editar
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input name="p[]" value="moedas" <?php if (in_array('moedas', $c)) {
                                                                echo 'checked';
                                                            } ?> type="checkbox" onclick="showHide('moedasOpt')"> Moedas
                    </label>
                </div>
                <div id="moedasOpt" class="optPerm" <?php if (in_array('moedas', $c)) {
                                                        echo 'style="display:block;"';
                                                    } else {
                                                        echo 'style="display:none;"';
                                                    } ?>>
                    <label>
                        <input name="p[]" <?php if (in_array('moedas-ver-tudo', $c)) {
                                                echo 'checked';
                                            } ?> value="moedas-ver-tudo" type="checkbox"> Ver Tudo
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('moedas-ver-meus', $c)) {
                                                echo 'checked';
                                            } ?> value="moedas-ver-meus" type="checkbox"> Ver Meus
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('moedas-add', $c)) {
                                                echo 'checked';
                                            } ?> value="moedas-add" type="checkbox"> Cadastrar
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('moedas-editar', $c)) {
                                                echo 'checked';
                                            } ?> value="moedas-editar" type="checkbox"> Editar
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input name="p[]" value="fornecedores" <?php if (in_array('fornecedores', $c)) {
                                                                    echo 'checked';
                                                                } ?> type="checkbox" onclick="showHide('fornecedoresOpt')"> Fornecedores
                    </label>
                </div>
                <div id="fornecedoresOpt" class="optPerm" <?php if (in_array('fornecedores', $c)) {
                                                                echo 'style="display:block;"';
                                                            } else {
                                                                echo 'style="display:none;"';
                                                            } ?>>
                    <label>
                        <input name="p[]" <?php if (in_array('fornecedores-ver-tudo', $c)) {
                                                echo 'checked';
                                            } ?> value="fornecedores-ver-tudo" type="checkbox"> Ver Tudo
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('fornecedores-ver-meus', $c)) {
                                                echo 'checked';
                                            } ?> value="fornecedores-ver-meus" type="checkbox"> Ver Meus
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('fornecedores-add', $c)) {
                                                echo 'checked';
                                            } ?> value="fornecedores-add" type="checkbox"> Cadastrar
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('fornecedores-editar', $c)) {
                                                echo 'checked';
                                            } ?> value="fornecedores-editar" type="checkbox"> Editar
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input name="p[]" value="centroCustos" <?php if (in_array('centroCustos', $c)) {
                                                                    echo 'checked';
                                                                } ?> type="checkbox" onclick="showHide('centroCustosOpt')"> Centro de Custos
                    </label>
                </div>
                <div id="centroCustosOpt" class="optPerm" <?php if (in_array('centroCustos', $c)) {
                                                                echo 'style="display:block;"';
                                                            } else {
                                                                echo 'style="display:none;"';
                                                            } ?>>
                    <label>
                        <input name="p[]" <?php if (in_array('centroCustos-ver-tudo', $c)) {
                                                echo 'checked';
                                            } ?> value="centroCustos-ver-tudo" type="checkbox"> Ver Tudo
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('centroCustos-ver-meus', $c)) {
                                                echo 'checked';
                                            } ?> value="centroCustos-ver-meus" type="checkbox"> Ver Meus
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('centroCustos-add', $c)) {
                                                echo 'checked';
                                            } ?> value="centroCustos-add" type="checkbox"> Cadastrar
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('centroCustos-editar', $c)) {
                                                echo 'checked';
                                            } ?> value="centroCustos-editar" type="checkbox"> Editar
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input name="p[]" value="planoContas" <?php if (in_array('planoContas', $c)) {
                                                                    echo 'checked';
                                                                } ?> type="checkbox" onclick="showHide('planoContasOpt')"> Plano de contas
                    </label>
                </div>
                <div id="planoContasOpt" class="optPerm" <?php if (in_array('planoContas', $c)) {
                                                                echo 'style="display:block;"';
                                                            } else {
                                                                echo 'style="display:none;"';
                                                            } ?>>
                    <label>
                        <input name="p[]" <?php if (in_array('planoContas-ver-tudo', $c)) {
                                                echo 'checked';
                                            } ?> value="planoContas-ver-tudo" type="checkbox"> Ver Tudo
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('planoContas-ver-meus', $c)) {
                                                echo 'checked';
                                            } ?> value="planoContas-ver-meus" type="checkbox"> Ver Meus
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('planoContas-add', $c)) {
                                                echo 'checked';
                                            } ?> value="planoContas-add" type="checkbox"> Cadastrar
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('planoContas-editar', $c)) {
                                                echo 'checked';
                                            } ?> value="planoContas-editar" type="checkbox"> Editar
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input name="p[]" value="subPlanoContas" <?php if (in_array('subPlanoContas', $c)) {
                                                                        echo 'checked';
                                                                    } ?> type="checkbox" onclick="showHide('subPlanoContasOpt')">Sub plano de contas
                    </label>
                </div>
                <div id="subPlanoContasOpt" class="optPerm" <?php if (in_array('subPlanoContas', $c)) {
                                                                echo 'style="display:block;"';
                                                            } else {
                                                                echo 'style="display:none;"';
                                                            } ?>>
                    <label>
                        <input name="p[]" <?php if (in_array('subPlanoContas-ver-tudo', $c)) {
                                                echo 'checked';
                                            } ?> value="subPlanoContas-ver-tudo" type="checkbox"> Ver Tudo
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('subPlanoContas-ver-meus', $c)) {
                                                echo 'checked';
                                            } ?> value="subPlanoContas-ver-meus" type="checkbox"> Ver Meus
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('subPlanoContas-add', $c)) {
                                                echo 'checked';
                                            } ?> value="subPlanoContas-add" type="checkbox"> Cadastrar
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('subPlanoContas-editar', $c)) {
                                                echo 'checked';
                                            } ?> value="subPlanoContas-editar" type="checkbox"> Editar
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input name="p[]" value="fechamentoContas" <?php if (in_array('fechamentoContas', $c)) {
                                                                        echo 'checked';
                                                                    } ?> type="checkbox" onclick="showHide('fechamentoContasOpt')"> Fechamento de contas
                    </label>
                </div>
                <div id="fechamentoContasOpt" class="optPerm" <?php if (in_array('fechamentoContas', $c)) {
                                                                    echo 'style="display:block;"';
                                                                } else {
                                                                    echo 'style="display:none;"';
                                                                } ?>>
                    <label>
                        <input name="p[]" <?php if (in_array('fechamentoContas-ver-tudo', $c)) {
                                                echo 'checked';
                                            } ?> value="fechamentoContas-ver-tudo" type="checkbox"> Ver Tudo
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('fechamentoContas-ver-meus', $c)) {
                                                echo 'checked';
                                            } ?> value="fechamentoContas-ver-meus" type="checkbox"> Ver Meus
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('fechamentoContas-add', $c)) {
                                                echo 'checked';
                                            } ?> value="fechamentoContas-add" type="checkbox"> Cadastrar
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('fechamentoContas-editar', $c)) {
                                                echo 'checked';
                                            } ?> value="fechamentoContas-editar" type="checkbox"> Editar
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input name="p[]" value="contasAPagar" <?php if (in_array('contasAPagar', $c)) {
                                                                    echo 'checked';
                                                                } ?> type="checkbox" onclick="showHide('contasAPagarOpt')"> Contas a pagar
                    </label>
                </div>
                <div id="contasAPagarOpt" class="optPerm" <?php if (in_array('contasAPagar', $c)) {
                                                                echo 'style="display:block;"';
                                                            } else {
                                                                echo 'style="display:none;"';
                                                            } ?>>
                    <label>
                        <input name="p[]" <?php if (in_array('contasAPagar-ver-tudo', $c)) {
                                                echo 'checked';
                                            } ?> value="contasAPagar-ver-tudo" type="checkbox"> Ver Tudo
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('contasAPagar-ver-meus', $c)) {
                                                echo 'checked';
                                            } ?> value="contasAPagar-ver-meus" type="checkbox"> Ver Meus
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('contasAPagar-add', $c)) {
                                                echo 'checked';
                                            } ?> value="contasAPagar-add" type="checkbox"> Cadastrar
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('contasAPagar-editar', $c)) {
                                                echo 'checked';
                                            } ?> value="contasAPagar-editar" type="checkbox"> Editar
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input name="p[]" value="colaboradores" <?php if (in_array('colaboradores', $c)) {
                                                                    echo 'checked';
                                                                } ?> type="checkbox" onclick="showHide('colaboradoresOpt')"> Colaboradores
                    </label>
                </div>
                <div id="colaboradoresOpt" class="optPerm" <?php if (in_array('colaboradores', $c)) {
                                                                echo 'style="display:block;"';
                                                            } else {
                                                                echo 'style="display:none;"';
                                                            } ?>>
                    <label>
                        <input name="p[]" <?php if (in_array('colaboradores-ver-tudo', $c)) {
                                                echo 'checked';
                                            } ?> value="colaboradores-ver-tudo" type="checkbox"> Ver Tudo
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('colaboradores-ver-meus', $c)) {
                                                echo 'checked';
                                            } ?> value="colaboradores-ver-meus" type="checkbox"> Ver Meus
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('colaboradores-add', $c)) {
                                                echo 'checked';
                                            } ?> value="colaboradores-add" type="checkbox"> Cadastrar
                    </label>
                    <label>
                        <input name="p[]" <?php if (in_array('colaboradores-editar', $c)) {
                                                echo 'checked';
                                            } ?> value="colaboradores-editar" type="checkbox"> Editar
                    </label>
                </div>
            </fieldset>
        </div>
        <div class="content">
            <fieldset>
                <legend>Ordem de Serviço</legend>
                <div class="checkbox">
                    <label>
                        <input name="p[]" value="os" <?php if (in_array('os', $c)) {
                                                            echo 'checked';
                                                        } ?> type="checkbox"> Ordem de Serviço (O.S)
                    </label>
                </div>
            </fieldset>
        </div>
        <div class="content">
            <fieldset>
                <legend>Logística</legend>
                <div class="checkbox">
                    <label>
                        <input name="p[]" value="estoque" <?php if (in_array('estoque', $c)) {
                                                                echo 'checked';
                                                            } ?> type="checkbox"> Estoque
                    </label>
                </div>
            </fieldset>
        </div>
        <div class="content">
            <fieldset>
                <legend>Sistema</legend>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <div class="checkbox">
                            <label>
                                <input name="p[]" value="usuarios" <?php if (in_array('usuarios', $c)) {
                                                                        echo 'checked';
                                                                    } ?> type="checkbox"> Usuários
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <div class="checkbox">
                            <label>
                                <input name="p[]" value="permissoes" <?php if (in_array('permissoes', $c)) {
                                                                            echo 'checked';
                                                                        } ?> type="checkbox"> Permissões
                            </label>
                        </div>
                    </div>
                </div>


            </fieldset>
        </div>
        <div class="content">
            <fieldset>
                <legend>Aprovações</legend>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <div class="checkbox">
                            <label>
                                <input name="p[]" value="aprovarColaboradores" <?php if (in_array('aprovarColaboradores', $c)) {
                                                                                    echo 'checked';
                                                                                } ?> type="checkbox"> Aprovar Colaboradores
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <div class="checkbox">
                            <label>
                                <input name="p[]" value="aprovarClientes" <?php if (in_array('aprovarClientes', $c)) {
                                                                                echo 'checked';
                                                                            } ?> type="checkbox"> Aprovar Clientes
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <div class="checkbox">
                            <label>
                                <input name="p[]" value="aprovarContas" <?php if (in_array('aprovarContas', $c)) {
                                                                            echo 'checked';
                                                                        } ?> type="checkbox"> Aprovar Contas
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <div class="checkbox">
                            <label>
                                <input name="p[]" value="aprovarFornecedores" <?php if (in_array('aprovarFornecedores', $c)) {
                                                                                    echo 'checked';
                                                                                } ?> type="checkbox"> Aprovar Fornecedores
                            </label>
                        </div>
                    </div>
                </div>




            </fieldset>
        </div>

        <!--div class="col-md-6 col-xs-12">
            <h4>Comercial</h4>

            <h4>Ordem de Serviço</h4>

            <h4>Logística</h4>

            <h4>Sistema</h4>



            <h4>Aprovações</h4>


        </div>

        <div class="col-md-6 col-xs-12">
            <h4>Administrativo</h4>





        </div-->
<?php

    }

    public function generateCode()
    {
        $id = $this->crmModel->getLastID();
        $nid = $id->intCrmID + 1;
        if ($nid < 10) {
            $code = "C000" . $nid;
        } elseif ($nid < 100) {
            $code = "C00" . $nid;
        } else {
            $code = "C" . $nid;
        }

        return $code;
    }

    public function saveBriefing()
    {
        if (isset($_POST['pa'])) {
            $packs = $ids = implode(",", $_POST["pa"]);
        } else {
            $packs = '';
        }
        if (isset($_POST['pr'])) {
            $prods = $ids = implode(",", $_POST["pr"]);
        } else {
            $prods = '';
        }

        $obj = $this->briefingModel->saveBriefing(
            $_POST['qtdacoes'],
            $_POST['acoessimultaneas'],
            $_POST['datainicio'],
            $_POST['dataconclusao'],
            $_POST['feriado'],
            $_POST['acaofds'],
            $_POST['noturno'],
            $_POST['duracao'],
            $_POST['local'],
            $_POST['equipe'],
            $_POST['modelo'],
            $_POST['fotografo'],
            $_POST['videomaker'],
            $_POST['mecanica'],
            $_POST['equipamentos'],
            $_POST['brindes'],
            $_POST['qtdprodutos'],
            $_POST['mailing'],
            $_POST['flyers'],
            $_POST['uniforme'],
            $_POST['plotado'],
            $_POST['fotos'],
            $_POST['video'],
            $_POST['ppt'],
            $_POST['prazo'],
            $_POST['adm'],
            $_POST['crm'],
            $prods,
            $packs
        );

        if ($obj) {
            header("Location: " . URL . "home/allbriefings?salvo=true");
        } else {
            header("Location: " . URL . "home/createbriefing/" . $_POST['crm'] . "?erro=true");
        }
    }

    public function registerLog($user, $action)
    {
        $obj = $this->coreModel->registerLog($user, $action);
        return true;
    }

    public function convertTimestamp($timestamp)
    {
        $t = explode(" ", $timestamp);
        $d = explode('-', $t[0]);
        $nd = $d[2] . '/' . $d[1] . '/' . $d[0];

        $newData = $nd . " - " . $t[1];
        return $newData;
    }

    public function addAgencia()
    {
        $obj = $this->agenciaModel->addAgencia($_POST['nome'], $_POST['email'], $_POST['telefone'], $_POST['contato'], $_POST['cnpj']);

        if ($obj) {
            header("Location: " . URL . "home/agencias?salvo=true");
        } else {
            header("Location: " . URL . "home/agencias?erro=true");
        }
    }

    public function editAgencia()
    {
        $obj = $this->agenciaModel->editAgencia(
            $_POST['nome'],
            $_POST['contato'],
            $_POST['email'],
            $_POST['telefone'],
            $_POST['cnpj'],
            $_POST['agenciaId']
        );

        if ($obj) {
            header("Location: " . URL . "home/agencias?salvo=true");
        } else {
            header("Location: " . URL . "home/agencias?erro=true");
        }
    }





    public function addEstoque()
    {
        $obj = $this->estoqueModel->addEstoque($_POST['cliente'], $_POST['produto'], $_POST['qtd'], $_POST['validade'], $_POST['setor'], $_POST['fila'], $_POST['caixa'], $_POST['obs']);

        if ($obj) {
            header("Location: " . URL . "home/estoque?salvo=true");
        } else {
            header("Location: " . URL . "home/estoque?erro=true");
        }
    }

    public function editEstoque()
    {
        $obj = $this->estoqueModel->addEstoque(
            $_POST['cliente'],
            $_POST['produto'],
            $_POST['qtd'],
            $_POST['validade'],
            $_POST['setor'],
            $_POST['fila'],
            $_POST['caixa'],
            $_POST['obs'],
            $_POST['estoqueId']
        );

        if ($obj) {
            header("Location: " . URL . "home/estoque?salvo=true");
        } else {
            header("Location: " . URL . "home/estoque?erro=true");
        }
    }

    public function addPo()
    {
        // print_r($_POST);
        $obj = $this->poModel->addPo(
            $_POST['cliente'],
            $_POST['stats'],
            $_POST['crm'],
            $_POST['validade'],
            $_POST['prazo'],
            $_POST['podate'],
            $_POST['conta']
        );

        if ($obj) {
            header("Location: " . URL . "home/po?salvo=true");
        } else {
            header("Location: " . URL . "home/po?erro=true");
        }
    }

    public function editPo()
    {
        $obj = $this->poModel->editPo(
            $_POST['cliente'],
            $_POST['stats'],
            $_POST['crm'],
            $_POST['validade'],
            $_POST['prazo'],
            $_POST['podate'],
            $_POST['poId'],
            $_POST['conta']
        );

        if ($obj) {
            header("Location: " . URL . "home/po?salvo=true");
        } else {
            header("Location: " . URL . "home/po?erro=true");
        }
    }

    public function addContrato()
    {
        $obj = $this->contratosModel->addContrato(
            $_POST['tipo'],
            $_POST['autorizacao'],
            $_POST['clienteCnpj'],
            $_POST['agenciaCnpj'],
            $_POST['nomeProjeto'],
            $_POST['vendedor'],
            $_POST['valor'],
            $_POST['contratoData'],
            $_FILES['contratoPdf']['name']
        );

        $targetDir = "../public/uploads/";
        $targetFile = $targetDir . $_FILES['contratoPdf']['name'];
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $upload = move_uploaded_file($_FILES['contratoPdf']['tmp_name'], $targetFile);


        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "pdf") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if ($upload) {
                echo "The file " . htmlspecialchars(basename($_FILES['contratoPdf']['name'])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        if ($obj) {
            header("Location: " . URL . "home/contratos?salvo=true");
        } else {
            header("Location: " . URL . "home/contratos?erro=true");
        }
    }

    public function editContrato()
    {
        $obj = $this->contratosModel->editContrato(
            $_POST['tipo'],
            $_POST['autorizacao'],
            $_POST['clienteCnpj'],
            $_POST['agenciaCnpj'],
            $_POST['nomeProjeto'],
            $_POST['vendedor'],
            $_POST['valor'],
            $_POST['contratoData'],
            $_POST['contratoId']
        );

        if ($obj) {
            header("Location: " . URL . "home/contratos?salvo=true");
        } else {
            header("Location: " . URL . "home/contratos?erro=true");
        }
    }

    public function editContratoPdf()
    {
        $obj = $this->contratosModel->editContratoPdf($_FILES['contratoPdf']['name'], $_POST['contratoId']);

        $targetDir = "../public/uploads/";
        $targetFile = $targetDir . $_FILES['contratoPdf']['name'];
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $upload = move_uploaded_file($_FILES['contratoPdf']['tmp_name'], $targetFile);


        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "pdf") {
            echo "Sorry, only PDF allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if ($upload) {
                echo "The file " . htmlspecialchars(basename($_FILES['contratoPdf']['name'])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        if ($obj) {
            header("Location: " . URL . "home/vercontrato/" . $_POST['contratoId'] . "?salvo=true");
        } else {
            header("Location: " . URL . "home/vercontrato/" . $_POST['contratoId'] . "?erro=true");
        }
    }

    public function editPoStatus()
    {
        $obj = $this->poModel->editPoStatus($_POST['stats'], $_POST['poId']);

        if ($obj) {
            header("Location: " . URL . "home/podata/" . $_POST['poId'] . "?salvo=true");
        } else {
            header("Location: " . URL . "home/podata/" . $_POST['poId'] . "?erro=true");
        }
    }

    public function addPoData()
    {
        $obj = $this->poModel->addPoData(
            $_POST['poId'],
            $_POST['item'],
            $_POST['espec'],
            $_POST['topic'],
            $_POST['datas'],
            $_POST['fornecedor'],
            $_POST['qtd'],
            $_POST['moeda'],
            $_POST['unit'],
            $_POST['cotacao'],
            $_POST['total'],
            $_POST['totalrs'],
            $_POST['pagamento'],
            $_POST['prazoprod']
        );

        if ($obj) {
            header("Location: " . URL . "home/podata/" . $_POST['poId'] . "?salvo=true");
        } else {
            header("Location: " . URL . "home/podata/" . $_POST['poId'] . "?erro=true");
        }
    }

    public function editPoData()
    {
        $obj = $this->poModel->editPoData(
            $_POST['poId'],
            $_POST['item'],
            $_POST['espec'],
            $_POST['topic'],
            $_POST['datas'],
            $_POST['fornecedor'],
            $_POST['qtd'],
            $_POST['moeda'],
            $_POST['unit'],
            $_POST['cotacao'],
            $_POST['total'],
            $_POST['totalrs'],
            $_POST['pagamento'],
            $_POST['prazoprod'],
            $_POST['poDataId']
        );

        if ($obj) {
            header("Location: " . URL . "home/podata/" . $_POST['poId'] . "?salvo=true");
        } else {
            header("Location: " . URL . "home/podata/" . $_POST['poId'] . "?erro=true");
        }
    }

    public function deletePoData($id, $poId)
    {
        $obj = $this->poModel->deletePoDataById($id);

        if ($obj) {
            header("Location: " . URL . "home/podata/" . $poId . "?salvo=true");
        } else {
            header("Location: " . URL . "home/podata/" . $poId . "?erro=true");
        }
    }

    public function registrarSaida()
    {

        $obj = $this->estoqueModel->registrarSaida($_POST['retirou'], $_POST['entregador'], $_POST['produto'], $_POST['obs'], $_POST['qtd']);

        if ($obj) {
            $ae = $this->estoqueModel->atualizaEstoque($_POST['produto'], $_POST['qtd'], 1);
            header("Location: " . URL . "home/estoqueitem/" . $_POST['produto'] . "?salvo=true");
        } else {
            header("Location: " . URL . "home/estoqueitem/" . $_POST['produto'] . "?erro=true");
        }
    }

    public function registrarEntrada()
    {

        $obj = $this->estoqueModel->registrarEntrada($_POST['entregou'], $_POST['entregador'], $_POST['produto'], $_POST['obs'], $_POST['qtd']);

        if ($obj) {
            $ae = $this->estoqueModel->atualizaEstoque($_POST['produto'], $_POST['qtd'], 2);
            header("Location: " . URL . "home/estoqueitem/" . $_POST['produto'] . "?salvo=true");
        } else {
            header("Location: " . URL . "home/estoqueitem/" . $_POST['produto'] . "?erro=true");
        }
    }

    public function addProposta()
    {
        $obj = $this->propostasModel->addProposta($_POST['codigo'], $_POST['dataSolicitada'], $_POST['dataEnvio']);

        if ($obj) {
            header("Location: " . URL . "home/propostas?salvo=true");
        } else {
            header("Location: " . URL . "home/propostas?erro=true");
        }
    }

    public function clienteForm($id = NULL)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $segmentos = $this->segmentosModel->getAllSegmentos();
            $clients = $this->clientesModel->getAllClientes();
            $agencias = $this->agenciaModel->getAllAgencias();

            // var_dump($clients); exit;

            if (isset($id) && $id != NULL) {
                $obj = $this->clientesModel->getClienteByID($id);
            }

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/clienteform.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function agenciaForm($id = NULL)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            if (isset($id) && $id != NULL) {
                $obj = $this->agenciaModel->getAgenciaByID($id);
            }

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/agenciaform.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }



    public function estoqueForm($id = NULL)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            if (isset($id) && $id != NULL) {
                $obj = $this->estoqueModel->getEstoqueByID($id);
            }

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/estoqueform.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function admform($id = NULL)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $deptos = $this->departamentosModel->getAllDepartamentos();
            $cargos = $this->admModel->getAllJobRole();

            if (isset($id) && $id != NULL) {
                $obj = $this->admModel->getAdmByID($id);
            }

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/admform.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function poForm($id = NULL)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $status = $this->poModel->getAllPoStatus();
            $clientes = $this->poModel->getAllClientes();
            $crms = $this->crmModel->getAllCrmByUser($_SESSION['admID']);


            if (isset($id) && $id != NULL) {
                $obj = $this->poModel->getPoByID($id);
                $c = $this->getClienteNameByID($obj->intClienteID);
            }

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/poform.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function poDataForm($poId = NULL, $id = NULL)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $fornecedores = $this->poModel->getAllFornecedores();
            $produtos = $this->produtosModel->getAllProdutos();
            $moedas = $this->poModel->getAllMoedas();
            if (isset($id) && $id != NULL) {
                $obj = $this->poModel->getPoDataByID($id);
            }

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/podataform.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function contratoForm($id = NULL)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $clientes = $this->contratosModel->getAllClientes();
            $agencias = $this->contratosModel->getAllAgencias();
            $vendedores = $this->contratosModel->getAllVendedores();

            if (isset($id) && $id != NULL) {
                $obj = $this->contratosModel->getContratoByID($id);
            }

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/contratoform.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }


    // funcionarios


    // public function addColaborador() {
    //     $salario =$this->formatMoney($_POST['salario']);
    //     $salario = $this->currencyToDecimal($salario);
    //     $creditos =$this->formatMoney($_POST['creditos']);
    //     $creditos = $this->currencyToDecimal($creditos);       
    //     $total =$this->formatMoney($_POST['total']);
    //     $total = $this->currencyToDecimal($total);
    //     $fora =$this->formatMoney($_POST['fora']);
    //     $fora = $this->currencyToDecimal($fora);
    //     $vr =$this->formatMoney($_POST['vr']);
    //     $vr = $this->currencyToDecimal($vr);
    //     $vt =$this->formatMoney($_POST['vt']);
    //     $vt = $this->currencyToDecimal($vt);
    //     $convenio =$this->formatMoney($_POST['convenio']);
    //     $convenio = $this->currencyToDecimal($convenio);
    //     $ac =$this->formatMoney($_POST['ac']);
    //     $ac = $this->currencyToDecimal($ac);
    //     $po= $this->currencyToDecimal($this->formatMoney($_POST['po']));

    //     $fileFuncionarioCPF=$this->uploadModel->uploadFile('fileFuncionarioCPF');
    //     $fileFuncionarioRG=$this->uploadModel->uploadFile('fileFuncionarioRG');
    //     $fileFuncionarioCarteiraTrabalho=$this->uploadModel->uploadFile('fileFuncionarioCarteiraTrabalho');
    //     $fileFuncionarioPis=$this->uploadModel->uploadFile('fileFuncionarioPis');
    //     $fileFuncionarioComprovanteEndereco=$this->uploadModel->uploadFile('fileFuncionarioComprovanteEndereco');
    //     $fileFuncionarioTituloEleitor=$this->uploadModel->uploadFile('fileFuncionarioTituloEleitor');
    //     $fileFuncionarioExameMedico=$this->uploadModel->uploadFile('fileFuncionarioExameMedico');

    //     // $obj = $this->funcionariosModel->addFuncionario($_POST['nome'],$_SESSION['admID']);
    //     $obj = $this->funcionariosModel->addColaborador($_POST['nome'],$_POST['pagamento'],$_POST['cpf'],$_POST['rg'],$salario,$creditos,
    //     $total,$fora,$_POST['registro'],$_POST['admissao'],$_POST['nascimento'],$_POST['cargo'],$_POST['banco'],$_POST['agencia'],
    //     $_POST['conta'],$vr,$vt,$convenio,$ac,$po,$fileFuncionarioCPF,$fileFuncionarioRG,$fileFuncionarioCarteiraTrabalho,$fileFuncionarioPis,
    //     $fileFuncionarioComprovanteEndereco,$fileFuncionarioTituloEleitor,$fileFuncionarioExameMedico,$_SESSION['admID']);

    //     if($obj) {
    //         header("Location: " . URL . "home/funcionarios?salvo=true");
    //     }else{
    //         header("Location: " . URL . "home/funcionarios?erro=true");
    //     }
    // }




    // carteira
    public function carteira()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $vendors = $this->carteiraModel->getAllVendors();
            $clientes = $this->clientesModel->getAllClientes();
            $agencias = $this->agenciaModel->getAllAgencias();

            if (isset($_POST['vendor'])) {
                $v = $this->admModel->getAdmNameByID($_POST['vendor']);
                $clients = $this->clientesModel->getMyClients($_POST['vendor']);
                $agencies = $this->clientesModel->getMyCarteiraContas($_POST['vendor']);
            }

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/carteira-clientes.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function addCarteira()
    {
        if ($_POST['cliente'] >= 1) {
            $check = $this->carteiraModel->checkCarteira('cl', $_POST['cliente']);

            if (isset($check->intCarteiraID)) {
                header("Location: " . URL . "home/carteira?clienteAdded=true");
            } else {
                $obj = $this->carteiraModel->addCarteira($_POST['vendor'], $_POST['cliente'], $_POST['agencia']);
            }
        } elseif ($_POST['agencia'] >= 1) {
            $check = $this->carteiraModel->checkCarteira('ag', $_POST['agencia']);

            if (isset($check->intCarteiraID)) {
                header("Location: " . URL . "home/carteira?agenciaAdded=true");
            } else {
                $obj = $this->carteiraModel->addCarteira($_POST['vendor'], $_POST['cliente'], $_POST['agencia']);
            }
        }

        if ($obj) {
            header("Location: " . URL . "home/carteira?salvo=true");
        } else {
            header("Location: " . URL . "home/carteira?erro=true");
        }
    }

    public function getClienteByName($fantasia)
    {

        $obj = $this->clientesModel->getClienteByName($fantasia);

        if (!empty($obj)) {
            // echo "<ul class='clientlist'>";
            foreach ($obj as $o) :
                if ($o->intAdmID == $_SESSION['admID']) :
                    echo "<button class='btn btn-block btn-primary' type='button' onclick='setCliente(" . $o->intClienteID . ",\"$o->strClienteFantasia\")'>" . $o->strClienteFantasia . " <small>(" . $o->strAdmNome . ")</small></button>";
                else :
                    echo "<button class='btn btn-block btn-default' type='button'  disabled>" . $o->strClienteFantasia . " <small>(" . $o->strAdmNome . ")</small></button>";
                endif;
            endforeach;
            // echo "</ul>";
        } else {
            echo "Não existe cliente com este nome <a href='#'>clique aqui para cadastrar</a>.";
        }
    }

    public function getAllContasByClienteID($id)
    {
        $obj = $this->clientesModel->getAllContasByClienteIDforCrm($id);

        if (!empty($obj)) {
            echo "<div class=\"form-group\">
                        <label>Conta</label>
                        <select class=\"form-control select2\" style=\"width: 100%;\" onchange='getContaContato(this.value)' name='conta'>
                            <option value='' disabled selected>Selecione a Conta</option>";
            foreach ($obj as $o) :
                $admName = $this->admModel->getAdmNameByID($o->intAdmID);
                if ($o->intAdmID == $_SESSION['admID']) :
                    echo "<option value=" . $o->intContaID . ">" . $o->strContaNome . " (" . $admName . ")</option>";
                else :
                    echo "<option value=" . $o->intContaID . " disabled='true'>" . $o->strContaNome . " (" . $admName . ")</option>";
                endif;
            endforeach;
            echo     "</select>
                            <br><a href='" . URL . "home/adicionarconta' class=\"btn btn-block btn-primary\">Clique aqui para cadastrar a conta</a>
                    </div>";
        } else {
            echo     "<br><a href='" . URL . "home/adicionarconta' class=\"btn btn-block btn-primary\">Este cliente ainda não possui conta clique aqui para cadastrar</a>";
        }
    }








    /*public function approval()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $clientes = $this->clientesModel->getAllClientesInactive();
            $contas = $this->clientesModel->getAllContasInactive();
            $fornecedores = $this->fornecedorModel->getAllFornecedoresInactive();
            $funcionarios = $this->funcionariosModel->getAllFuncionariosToApprove();

            // var_dump($fornecedores); exit;

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/clientes-approve.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }*/




    /** CONTAS
     * Função onde trás a tela de aprovação dos contas.
     * Função para aprovação e reprovação dos contas.
     */
    public function aprovarContas()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $contas = $this->clientesModel->getAllContasInactive();

            // var_dump($fornecedores); exit;

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/aprovarcontas.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function approveConta($id)
    {
        $obj = $this->clientesModel->approveAccount($id);

        if ($obj) {
            header("Location: " . URL . "home/aprovarcontas?approved=true");
        } else {
            header("Location: " . URL . "home/aprovarcontas?approved=error");
        }
    }

    /** FORNECEDORES
     * Função onde trás a tela de aprovação dos fornecedores.
     * Função para aprovação e reprovação dos fornecedores.
     */


    /** COLABORADORES
     * Função onde trás a tela de aprovação dos colaboradores.
     * Função para aprovação e reprovação dos colaboradores.
     */



    public function getContaContatoByID($id)
    {
        $obj = $this->clientesModel->getContaContatoByID($id);

        if ($obj) {
            echo '<div class="form-group">
            <label for="">Contato</label>
            <input id="contato" type="text" name="contato" class="form-control" value="' . $obj->strContaContato . '">
        </div>
        <div class="form-group">
            <label for="">E-Mail</label>
            <input type="mail" name="mail" class="form-control" value="' . $obj->strContaContatoEmail . '">
        </div>
        <div class="form-group">
            <label for="">Telefone</label>
            <input id="telefone" type="text" name="telefone" class="form-control" value="' . $obj->strContaContatoTelefone . '">
        </div>
        <div class="form-group">
            <label for="">Função</label>
            <input id="funcao" type="text" name="funcao" class="form-control" value="' . $obj->strContaContatoCargo . '">
        </div>';
        }
    }



    public function reproveAccount()
    {
        $obj = $this->clientesModel->registerReproveClient($_POST['reason'], $_POST['solicitante'], $_POST['fantasia'], $_POST['adm']);
        $rc = $this->clientesModel->deleteContaByID($_POST['id']);

        if ($obj) {
            header("Location: " . URL . "home/approval?reproved=true");
        } else {
            header("Location: " . URL . "home/approval?reproved=error");
        }
    }

    public function contasReprovadas()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $contas = $this->clientesModel->getReprovedAccount();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/contasreprovadas.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }






    public function mudarConta()
    {
        $obj = $this->carteiraModel->mudarCarteiraConta($_POST['cliente'], $_POST['vendedor']);

        if ($obj) {
            header("Location: " . URL . "home/carteira?changed=true");
        } else {
            header("Location: " . URL . "home/carteira?changed=error");
        }
    }

    // public function callIncludes($url) {
    //     switch ($url) {
    //         case 'value':
    //             $includes = 'view/_templates/includes/forms.php';
    //             break;

    //         default:
    //             # code...
    //             break;
    //     }

    //     return $includes;
    // }

    public function checkCnpj($cnpj, $cnpj2)
    {
        $correctCnpj = $cnpj . "/" . $cnpj2;
        $newCnpj = str_replace(['.', '/', '-'], [''], $correctCnpj);

        $checkDuplicated = $this->fornecedorModel->checkDuplicated($correctCnpj);
        $info = null;
        $data = null;
        if (empty($checkDuplicated)) :

            $url = "https://receitaws.com.br/v1/cnpj/" . $newCnpj;

            $result = file_get_contents($url);
            // Will dump a beauty json :3
            $r = json_decode($result, true);

            if (isset($r["status"]) && $r["status"] === "ERROR") {
                $info = $r["message"] ;
            } else {
                $info = "Situação do CNPJ: " . $r["situacao"];
                $data = $r;
            }


        else :
            $info = "CNPJ já cadastrado no sistema.";

        endif;

        echo json_encode([
                'info' => $info,
                'data' => $data
        ]);
    }

    public function checkCnpjFornecedor($cnpj, $cnpj2)
    {
        $correctCnpj = $cnpj . "/" . $cnpj2;
        $newCnpj = str_replace(['.', '/', '-'], [''], $correctCnpj);

        $checkDuplicated = $this->clientesModel->checkDuplicated($correctCnpj);

        if (empty($checkDuplicated)) :
            $url = "https://receitaws.com.br/v1/cnpj/" . $newCnpj;

            $result = file_get_contents($url);
            // Will dump a beauty json :3
            $r = json_decode($result, true);

            if ($r["situacao"] == "ATIVA") {
                $alert = "<div class='alert alert-success'>Situação do CNPJ: " . $r["situacao"] . "</div>";
                $disabled = "";
            } else {
                $alert = "<div class='alert alert-danger'>Situação do CNPJ: " . $r["situacao"] . "</div>";
                $disabled = " disabled='true' ";
            }

            if (isset($r["status"]) && $r["status"] === "ERROR") {
                $return = "<div class='alert alert-danger'>" . $r["message"] . "</div>";
            } else {
                $return = $alert . "
                <div class='form-group'>
                    <label for=''>Razão Social</label>
                    <input id='razao' type='text' value='" . $r['nome'] . "' " . $disabled . " name='razao' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for=''>Nome Fantasia</label>
                    <input id='fantasia' type='text' required value='" . $r['fantasia'] . "' " . $disabled . " name='fantasia' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for='cep'>CEP</label>
                    <input id='cep' type='text' value='" . $r['cep'] . "' " . $disabled . " name='cep' id='cep' class='form-control' placeholder='Informe um CEP' />
                    <input type='button' id='VerificarCEP' class='btn btn-primary' value='Verificar' />
                </div>
                <div class='form-group'>
                    <label for=''>Endereço</label>
                    <input id='endereco' type='text' value='" . $r['logradouro'] . ", " . $r['numero'] . "' " . $disabled . " name='endereco' id='endereco' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for='cidade'>Cidade</label>
                    <input id='cidade' type='text' value='" . $r['municipio'] . "' " . $disabled . " class='form-control' name='cidade' id='cidade' readonly />
                </div>
                <div class='form-group'>
                    <label for='cidade'>Estado</label>
                    <input type='text' value='' " . $disabled . " class='form-control' name='estado' id='estado' />
                </div>
                <div class='form-group'>
                    <label for=''>Responsável</label>
                    <input type='text' value='' " . $disabled . "  name='responsavel' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for=''>RG do Responsável</label>
                    <input type='text' value='' " . $disabled . "  name='rg' id='rg' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for=''>CPF do Responsável</label>
                    <input type='text' value='' " . $disabled . "  id='cpf' name='cpf' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for=''>Contato</label>
                    <input type='text' value='' " . $disabled . "  name='contato' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for=''>Cargo do Contato</label>
                    <input type='text' value='' " . $disabled . "  name='cargo' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for=''>E-Mail</label>
                    <input type='mail' value='' " . $disabled . " name='email' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for=''>Telefone</label>
                    <input type='text' value='' " . $disabled . " name='telefone' id='telefone' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for=''>Celular</label>
                    <input type='text' value='' " . $disabled . " name='celular' id='celular' class='form-control'>
                </div>
            ";
            }

        else :
            $alert = "<div class='alert alert-danger'>CNPJ já cadastrado no sistema.</div>";
            $disabled = " disabled='true' ";
            $return = $alert . "
                <div class='form-group'>
                    <label for=''>Razão Social</label>
                    <input id='razao' type='text' value='' " . $disabled . " name='razao' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for=''>Nome Fantasia</label>
                    <input id='fantasia' type='text' required value='' " . $disabled . " name='fantasia' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for='cep'>CEP</label>
                    <input id='cep' type='text' value='' " . $disabled . " name='cep' id='cep' class='form-control' placeholder='Informe um CEP' />
                    <input type='button' id='VerificarCEP' class='btn btn-primary' value='Verificar' />
                </div>
                <div class='form-group'>
                    <label for=''>Endereço</label>
                    <input id='endereco' type='text' value='' " . $disabled . " name='endereco' id='endereco' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for='cidade'>Cidade</label>
                    <input id='cidade' type='text' value='' " . $disabled . " class='form-control' name='cidade' id='cidade' readonly />
                </div>
                <div class='form-group'>
                    <label for='cidade'>Estado</label>
                    <input type='text' value='' " . $disabled . " class='form-control' name='estado' id='estado' />
                </div>
                <div class='form-group'>
                    <label for=''>Responsável</label>
                    <input type='text' value='' " . $disabled . "  name='responsavel' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for=''>RG do Responsável</label>
                    <input type='text' value='' " . $disabled . "  name='rg' id='rg' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for=''>CPF do Responsável</label>
                    <input type='text' value='' " . $disabled . "  id='cpf' name='cpf' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for=''>Contato</label>
                    <input type='text' value='' " . $disabled . "  name='contato' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for=''>Cargo do Contato</label>
                    <input type='text' value='' " . $disabled . "  name='cargo' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for=''>E-Mail</label>
                    <input type='mail' value='' " . $disabled . " name='email' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for=''>Telefone</label>
                    <input type='text' value='' " . $disabled . " name='telefone' id='telefone' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for=''>Celular</label>
                    <input type='text' value='' " . $disabled . " name='celular' id='celular' class='form-control'>
                </div>
            ";
        endif;

        echo $return;
    }


    public function formatMoney($val)
    {
        if (!function_exists('str_contains')) {
            function str_contains(string $haystack, string $needle): bool
            {
                return '' === $needle || false !== strpos($haystack, $needle);
            }
        }
        if ($val == '')
            return 0;
        if (str_contains($val, 'R$'))
            $ma = explode('R$', $val);
        else
            $ma = [0, $val];
        $mb = str_replace('.', '', $ma[1]);
        $mc = str_replace(',', '.', $mb);
        $money = trim($mc);

        return $money;
    }

    public function currencyToDecimal($value)
    {

        // Ensure string does not have leading/trailing spaces
        $value = trim($value);

        /**
         * Standardize readability delimiters
         *****************************************************/

        // Space used as thousands separator between digits
        $value = preg_replace('/(\d)(\s)(\d)/', '$1$3', $value);

        // Decimal used as delimiter when comma used as radix
        if (stristr($value, '.') && stristr($value, ',')) {
            // Ensure last period is BEFORE first comma
            if (strrpos($value, '.') < strpos($value, ',')) {
                $value = str_replace('.', '', $value);
            }
        }

        // Comma used as delimiter when decimal used as radix
        if (stristr($value, ',') && stristr($value, '.')) {
            // Ensure last period is BEFORE first comma
            if (strrpos($value, ',') < strpos($value, '.')) {
                $value = str_replace(',', '', $value);
            }
        }

        /**
         * Standardize radix (decimal separator)
         *****************************************************/

        // Possible radix options
        $radixOptions = [',', ' '];

        // Convert comma radix to "point" or "period"
        $value = str_replace(',', '.', $value);

        /**
         * Strip non-numeric and non-radix characters
         *****************************************************/

        // Remove other symbols like currency characters
        $value = preg_replace('/[^\d\.]/', '', $value);

        /**
         * Convert to float value
         *****************************************************/

        // String to float first before formatting
        $value = floatval($value);

        /**
         * Give final value 
         *****************************************************/

        return $value;
    }


    public function addBriefingItem()
    {
        $obj = $this->briefingModel->addBriefingItem($_POST['produto'], $_POST['briefingID']);

        header("Location: " . URL . "home/createbriefing/" . $_POST['crmID'] . "/" . $_POST['briefingID']);
    }

    public function delBriefingItem($produto, $briefing)
    {
        $del = $this->briefingModel->excluirBriefingDetailTotal($produto, $briefing);
        $obj = $this->briefingModel->delBriefingItem($produto, $briefing);

        $item = $this->briefingModel->getProdutosByBriefingID($briefing);
        if (!empty($item)) :
            $return = "
        <table class='table table-striped table-hover'>
        <tr>
            <th>Nome do Item</th>
            <th>Detalhes</th>
            <th>Remover</th>
        </tr>";
            foreach ($item as $i) :
                $return .= "<tr>
            <td>" . $i->strProdutoNome . "</td>
            <td><a href='" . URL . "home/editarbriefingdetalhes/" . $i->intProdutoID . "/" . $briefing . "' target='_blank' class='btn btn-info'>Detalhes</a></td>
            <td><button class='btn btn-danger' onclick='delBriefingItem(" . $i->intProdutoID . "," . $briefing . ");'>Remover</a></td></tr>";
            endforeach;

            $return .= "</table>";
        else :
            $return = "<p>Briefing Vazio!</p>";
        endif;

        echo $return;
    }

    public function editarBriefingDetalhes($prod, $brief, $crm)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $p = $this->produtosModel->getProdutoByID($prod);
            $dates = $this->briefingModel->getAllBriefingDetalhesByProdID($prod, $brief);

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/briefing-details-new.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }


    public function addBriefingDetail($brief, $prod, $date, $qtd, $crm)
    {
        $check = $this->briefingModel->checkBriefingDetail($date, $brief);

        if (isset($check->intBriefingProdutoDataID)) {
            $obj = $this->briefingModel->updateBriefingDetail($check->intBriefingProdutoDataID, $qtd);
        } else {
            $obj = $this->briefingModel->addBriefingDetail($brief, $prod, $date, $qtd);
        }

        $dates = $this->briefingModel->getAllBriefingDetalhesByProdID($prod, $brief);
        $return = '
        <table id="data" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Data</th>
                <th>Veiculações</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
        ';
        foreach ($dates as $d) :
            $return .= '
            <tr>
                <td>' . $this->mostraData($d->strBriefingProdutoData) . '</td>
                <td>' . $d->intBriefingProdutoDataQtd . '</td>
                <td><a href="' . URL . 'home/excluirbriefingdetail/' . $d->intBriefingProdutoDataID . '/' . $prod . '/' . $brief . '/' . $crm . '">Excluir</a></td>
            </tr> ';
        endforeach;
        $return .= '
        </tbody>
        <tfoot>
            <tr>
                <th>Data</th>
                <th>Veiculações</th>
                <th>Excluir</th>
            </tr>
        </tfoot>
    </table>
        ';

        echo $return;
    }

    public function excluirBriefingDetail($detail, $prod, $brief, $crm)
    {
        $obj = $this->briefingModel->excluirBriefingDetail($detail);

        if ($obj) {
            header("Location: " . URL . "home/editarBriefingDetalhes/" . $prod . "/" . $brief . "/" . $crm . "?salvo=true");
        } else {
            header("Location: " . URL . "home/editarBriefingDetalhes/" . $prod . "/" . $brief . "/" . $crm . "?error=true");
        }
    }


    public function registerAdm()
    {
        $obj = $this->admModel->registerAdm($_POST['name'], $_POST['mail'], md5($_POST['pass']), $_POST['depto'], $_POST['cargo']);

        if ($obj) {
            header("Location: " . URL . "home/adm?salvo=true");
        } else {
            header("Location: " . URL . "home/adm?error=true");
        }
    }

    public function showMoney($val)
    {
        return str_replace('.', ',', $val);
    }

    public function addProdutoPacote()
    {
        $obj = $this->produtosModel->addProdutoPacote($_POST['pacote'], $_POST['produto'], $_POST['qtd']);

        if ($obj) {
            header("Location: " . URL . "home/pacotesprodutos/" . $_POST['pacote'] . "?salvo=true");
        } else {
            header("Location: " . URL . "home/pacotesprodutos/" . $_POST['pacote'] . "?error=true");
        }
    }

    public function excluirProdutoPacote($id, $pacote)
    {
        $obj = $this->produtosModel->excluirProdutoPacote($id);

        if ($obj) {
            header("Location: " . URL . "home/pacotesprodutos/" . $pacote . "?salvo=true");
        } else {
            header("Location: " . URL . "home/pacotesprodutos/" . $pacote . "?error=true");
        }
    }

    public function getBriefingValue($id)
    {
        $prods = $this->briefingModel->getProdutosByBriefingID($id);
        $total = 0;

        foreach ($prods as $p) :
            $pt = $this->briefingModel->getAllBriefingDetalhesByProdID($p->intProdutoID, $id);
            $veic = 0;
            foreach ($pt as $pn) :
                $veic += (int)$pn->intBriefingProdutoDataQtd;
            endforeach;
            $total += $veic * $p->strProdutoVal;
        endforeach;
        $val = number_format($total, 2, ",", ".");

        return $val;
    }

    public function showCalendar()
    {


        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/calendar.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function diasMeses()
    {
        $retorno = array();

        for ($i = 1; $i <= 12; $i++) {
            $retorno[$i] = cal_days_in_month(CAL_GREGORIAN, $i, date('Y'));
        }

        return $retorno;
    }

    public function montaCalendario($prod, $brief, $crm)
    {
        $daysWeek = array(
            'Sun',
            'Mon',
            'Tue',
            'Wed',
            'Thu',
            'Fri',
            'Sat'
        );

        $diasSemana = array(
            'Domingo',
            'Segunda',
            'Terça',
            'Quarta',
            'Quinta',
            'Sexta',
            'Sábado'
        );

        $arrayMes = array(
            1 => 'Janeiro',
            2 => 'Fevereiro',
            3 => 'Março',
            4 => 'Abril',
            5 => 'Maio',
            6 => 'Junho',
            7 => 'Julho',
            8 => 'Agosto',
            9 => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro'
        );

        $diasMeses = $this->diasMeses();
        $arrayRetorno = array();

        for ($i = 1; $i <= 12; $i++) {
            $arrayRetorno[$i] = array();
            for ($n = 1; $n <= $diasMeses[$i]; $n++) {
                $dayMonth = gregoriantojd($i, $n, date('Y'));
                $weekMonth = jddayofweek($dayMonth, 2);
                if ($weekMonth == 'Mun') $weekMonth = 'Mon';
                $arrayRetorno[$i][$n] = $weekMonth;
            }
        }

        echo "<a href='#' id='volta'>&laquo;</a><a href='#' id='vai'>&raquo;</a>";
        echo "<form action='URLhome/addBriefingDetail' method='post'>";
        echo "<table class='table table-striped table-border'>";
        foreach ($arrayMes as $num => $mes) {
            echo "<tbody id='mes_" . $num . "' class='mes'>";
            echo "<tr><td colspan='7' class='mes_title'>" . $mes . "</td></tr>";
            echo "<tr>";
            foreach ($diasSemana as $i => $day) {
                echo "<td class='day_title'>" . $day . "</td>";
            }
            echo "</tr><tr>";
            $y = 0;
            foreach ($arrayRetorno[$num] as $numero => $dia) {
                $y++;
                if ($numero == 1) {
                    $qtd = array_search($dia, $daysWeek);
                    for ($i = 1; $i <= $qtd; $i++) {
                        echo "<td></td>";
                        $y += 1;
                    }
                }
                $dataVeic = '2021-' . $num . '-' . $numero;
                echo "<td class='day'>" . $numero . "<input min='0' type='number' name='veic[]' onchange='javascript:addVeiculacao(this.value,\"" . $dataVeic . "\"," . $prod . "," . $brief . "," . $crm . ");' class='form-control'></td>";

                if ($y == 7) {
                    $y = 0;
                    echo "<tr></tr>";
                }
            }
            echo "</tr>";
            echo "</tbody>";
        }
        echo "</table></form>";

        // print_r($arrayRetorno);
    }

    public function fechamentoDeContas()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/fechamento-contas.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }
    public function gerarFechamentoContas()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $_POST['mes'] = $_REQUEST['mes'];
            $_POST['ano'] = $_REQUEST['ano'];
            $_POST['tipoFuncionario'] = $_REQUEST['tipoFuncionario'];
            $_POST['sobrescrever'] = $_REQUEST['sobrescrever'];

            $jobRole = $this->admModel->getAdmJobRoleByID($_SESSION['admID']);
            $perm = $this->admModel->getJobRolePermissionsByID($jobRole);
            $permissions = explode(',', $perm->strCargoAccess);



            if (in_array('fechamentoContas-add', $permissions))
                $gerarContas = $this->fechamentoModel->gerarContas($_POST['tipoFuncionario'], $_POST['ano'], $_POST['mes'], $_POST['sobrescrever'], $_SESSION['admID']);


            if (in_array('fechamentoContas-ver-tudo', $permissions))
                $contasGeradas = $this->fechamentoModel->consultarContas($_POST['tipoFuncionario'], $_POST['ano'], $_POST['mes']);
            else if (in_array('fechamentoContas-ver-meus', $permissions))
                $contasGeradas = $this->fechamentoModel->consultarMinhasContas($_POST['tipoFuncionario'], $_POST['ano'], $_POST['mes'], $_SESSION['admID']);

            $CentroCustos = $this->CentroCustosModel->consultarCentroCustos();
            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/fechamento-contas.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function inserirContasFechadasAPagar()
    {

        if ($this->fechamentoModel->inserirContasAPagar($_POST['tipoFuncionario'], $_POST['ano'], $_POST['mes'], $_POST['CentroCustos'], $_POST['IDS'])) {
            header("Location: " . URL . "home/gerarFechamentoContas?mes={$_POST['mes']}&ano={$_POST['ano']}&tipoFuncionario={$_POST['tipoFuncionario']}&sobrescrever=0");
        }
    }
    public function centroDeCustos()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $jobRole = $this->admModel->getAdmJobRoleByID($_SESSION['admID']);
            $perm = $this->admModel->getJobRolePermissionsByID($jobRole);
            $permissions = explode(',', $perm->strCargoAccess);

            if (in_array('centroCustos-ver-tudo', $permissions))
                $CentroCustos = $this->CentroCustosModel->consultarCentroCustos();
            else if (in_array('centroCustos-ver-meus', $permissions))
                $CentroCustos = $this->CentroCustosModel->consultarMeusCentroCustos($_SESSION['admID']);
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/centro-custos.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }
    public function cadastrarCentro()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $jobRole = $this->admModel->getAdmJobRoleByID($_SESSION['admID']);
            $perm = $this->admModel->getJobRolePermissionsByID($jobRole);
            $permissions = explode(',', $perm->strCargoAccess);

            if (in_array('centroCustos-add', $permissions)) {
                $obj = $this->CentroCustosModel->cadastrarCentroCustos($_POST['nome'], $_POST['desc'], $_SESSION['admID']);
            }
            if ($obj) {
                header("Location: " . URL . "home/centroDeCustos/");
            }
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }
    public function excluirCentro()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $jobRole = $this->admModel->getAdmJobRoleByID($_SESSION['admID']);
            $perm = $this->admModel->getJobRolePermissionsByID($jobRole);
            $permissions = explode(',', $perm->strCargoAccess);
            if (in_array('centroCustos-editar', $permissions)) {
                $obj = $this->CentroCustosModel->excluirCentroCustos($_GET['id']);
            }
            if ($obj) {
                header("Location: " . URL . "home/centroDeCustos/");
            }
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }



    public function planoDeContas()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $jobRole = $this->admModel->getAdmJobRoleByID($_SESSION['admID']);
            $perm = $this->admModel->getJobRolePermissionsByID($jobRole);
            $permissions = explode(',', $perm->strCargoAccess);
            if (in_array('planoContas-ver-tudo', $permissions))
                $PlanoContas = $this->planoContasModel->consultarPlanoContas();
            else if (in_array('planoContas-ver-meus', $permissions))
                $PlanoContas = $this->planoContasModel->consultarMeusPlanoContas($_SESSION['admID']);
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/plano-contas.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }
    public function cadastrarPlano()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $jobRole = $this->admModel->getAdmJobRoleByID($_SESSION['admID']);
            $perm = $this->admModel->getJobRolePermissionsByID($jobRole);
            $permissions = explode(',', $perm->strCargoAccess);
            if (in_array('planoContas-add', $permissions))
                $obj = $this->planoContasModel->cadastrarPlanoContas($_POST['nome'], $_POST['desc'], $_SESSION['admID']);
            else
                header("Location: " . URL . "home/planoDeContas/");
            if ($obj) {
                header("Location: " . URL . "home/planoDeContas/");
            }
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }
    public function excluirPlano()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $jobRole = $this->admModel->getAdmJobRoleByID($_SESSION['admID']);
            $perm = $this->admModel->getJobRolePermissionsByID($jobRole);
            $permissions = explode(',', $perm->strCargoAccess);
            if (in_array('planoContas-editar', $permissions))
                $obj = $this->planoContasModel->excluirPlanoContas($_GET['id']);
            else
                header("Location: " . URL . "home/planoDeContas/");
            if ($obj) {
                header("Location: " . URL . "home/planoDeContas/");
            }
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }


    public function subPlanoDeContas($id = null)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $jobRole = $this->admModel->getAdmJobRoleByID($_SESSION['admID']);
            $perm = $this->admModel->getJobRolePermissionsByID($jobRole);
            $permissions = explode(',', $perm->strCargoAccess);
            if (in_array('planoContas-ver-tudo', $permissions))
                $PlanoContas = $this->planoContasModel->consultarPlanoContas();
            else if (in_array('planoContas-ver-meus', $permissions))
                $PlanoContas = $this->planoContasModel->consultarMeusPlanoContas($_SESSION['admID']);

            if (in_array('subPlanoContas-ver-tudo', $permissions))
                $SubPlanoContas = $this->subPlanoContasModel->consultarSubPlanoContas($id);
            else if (in_array('subPlanoContas-ver-meus', $permissions))
                $SubPlanoContas = $this->subPlanoContasModel->consultarMeusSubPlanoContas($id, $_SESSION['admID']);
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/sub-plano-contas.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }
    public function cadastrarSubPlano()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $jobRole = $this->admModel->getAdmJobRoleByID($_SESSION['admID']);
            $perm = $this->admModel->getJobRolePermissionsByID($jobRole);
            $permissions = explode(',', $perm->strCargoAccess);
            if (in_array('subPlanoContas-add', $permissions))
                $obj = $this->subPlanoContasModel->cadastrarSubPlanoContas($_POST['nome'], $_POST['desc'], $_POST['planoContas'], $_SESSION['admID']);
            else
                header("Location: " . URL . "home/subPlanoDeContas/");
            if ($obj) {
                header("Location: " . URL . "home/subPlanoDeContas/");
            }
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }
    public function excluirSubPlano()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $obj = $this->subPlanoContasModel->excluirSubPlanoContas($_GET['id']);
            if ($obj) {
                header("Location: " . URL . "home/subPlanoDeContas/");
            }
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function contasAPagar($id = null)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $SubPlanoContas = $this->subPlanoContasModel->consultarSubPlanoContas($id);
            $CentroCustos = $this->CentroCustosModel->consultarCentroCustos();


            $jobRole = $this->admModel->getAdmJobRoleByID($_SESSION['admID']);
            $perm = $this->admModel->getJobRolePermissionsByID($jobRole);
            $permissions = explode(',', $perm->strCargoAccess);
            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/contas-a-pagar.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function excluirContaAPagar()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $obj = $this->contasAPagarModel->excluirConta($_GET['id']);
            if ($obj) {
                header("Location: " . URL . "home/contasAPagar/");
            }
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function reapproveFornecedor($id)
    {
        if ($this->isLogged()) {
            $reapprove = $this->fornecedorModel->reapproveFornecedor($id);

            if ($reapprove) {
                header("Location: " . URL . "home/fornecedorform/" . $id . "?reapprove=true");
            } else {
                header("Location: " . URL . "home/fornecedorform/" . $id . "?reapprove=error");
            }
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }




    // function test() {
    //     $test = $this->admModel->testSql();

    //     var_dump($test);
    // }

    //MEU PERFIL

    //REPROVADOS
    public function reprovados()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);


            //$fornecedor = $this->fornecedorModel->getReprovedFornecedores();
            $funcionario = $this->funcionariosModel->getReprovedFuncionarios();
            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/reprovados.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }


    //ADM

    /** CLIENTE
     * Função onde trás a tela de aprovação dos clientes.
     * Função para aprovação e reprovação dos clientes
     */
    public function aprovarClientes()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $clientes = $this->clientesModel->getAllClientesInactive();

            // var_dump($fornecedores); exit;

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/aprovarclientes.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }
    public function approveClient($client, $adm, $name)
    {
        $obj = $this->clientesModel->approveClient($client);
        $c = $this->clientesModel->getClienteByID($client);

        if ($obj) {
            $i = $this->clientesModel->createInstitucional(
                $client,
                $adm,
                $name,
                $c->strClienteContato,
                $c->strClienteContatoCargo,
                $c->strClienteEmail,
                $c->strClienteTelefone,
                $c->strClienteCelular
            );
            if ($i) {
                header("Location: " . URL . "home/aprovarclientes?approved=true");
            } else {
                header("Location: " . URL . "home/aprovarclientes?approved=error");
            }
        }
    }
    public function reproveClient()
    {
        $obj = $this->clientesModel->registerReproveClient($_POST['reason'], $_POST['solicitante'], $_POST['fantasia'], $_POST['adm']);
        $r = $this->clientesModel->setReproved($_POST['id']);
        $rc = $this->clientesModel->deleteAllContasByClienteID($_POST['id']);

        if ($obj) {
            header("Location: " . URL . "home/approval?reproved=true");
        } else {
            header("Location: " . URL . "home/approval?reproved=error");
        }
    }
    public function clientesReprovados()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $clientes = $this->clientesModel->getReprovedClient();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/clientesreprovados.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function mudarCliente()
    {
        $obj = $this->carteiraModel->mudarCarteiraCliente($_POST['cliente'], $_POST['vendedor']);

        if ($obj) {
            header("Location: " . URL . "home/carteira?changed=true");
        } else {
            header("Location: " . URL . "home/carteira?changed=error");
        }
    }
    public function addCliente()
    {
        $obj = $this->clientesModel->addCliente(
            $_POST['adm'],
            $_POST['cnpj'],
            $_POST['razao'],
            $_POST['fantasia'],
            $_POST['agencia'],
            $_POST['segmento'],
            $_POST['cep'],
            $_POST['endereco'],
            $_POST['cidade'],
            $_POST['estado'],
            $_POST['responsavel'],
            $_POST['rg'],
            $_POST['cpf'],
            $_POST['contato'],
            $_POST['cargo'],
            $_POST['email'],
            $_POST['telefone'],
            $_POST['celular']
        );

        // $nome = $_POST['fantasia'] . " Institucional";
        // $conta = $this->clientesModel->addConta($nome, $_POST['segmento'], $_POST['agencia'], $_POST['responsavel'], $_POST['cargo'],
        // $_POST['email'], $_POST['telefone'], $_POST['celular'], $cliente, '1');

        if ($obj) {
            header("Location: " . URL . "home/clientes?salvo=true");
        } else {
            header("Location: " . URL . "home/clientes?erro=true");
        }
    }

    public function editCliente()
    {
        $obj = $this->clientesModel->editCliente(
            $_POST['cnpj'],
            $_POST['razao'],
            $_POST['fantasia'],
            $_POST['agencia'],
            $_POST['segmento'],
            $_POST['cep'],
            $_POST['endereco'],
            $_POST['cidade'],
            $_POST['estado'],
            $_POST['responsavel'],
            $_POST['rg'],
            $_POST['cpf'],
            $_POST['contato'],
            $_POST['cargo'],
            $_POST['email'],
            $_POST['telefone'],
            $_POST['celular'],
            $_POST['clienteId']
        );

        if ($obj) {
            header("Location: " . URL . "home/clientes?salvo=true");
        } else {
            header("Location: " . URL . "home/clientes?erro=true");
        }
    }

    //CONTA

    //FORNECEDOR
    public function fornecedoresReprovados()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $fornecedor = $this->fornecedorModel->getReprovedFornecedores();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/fornecedoresreprovados.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }
    public function addFornecedor()
    {

        $money = $this->formatMoney($_POST['valor']);
        $money = $this->currencyToDecimal($money);
        $vt = $this->currencyToDecimal($this->formatMoney($_POST['VT']));
        $vr = $this->currencyToDecimal($this->formatMoney($_POST['VR']));
        $po = $this->currencyToDecimal($this->formatMoney($_POST['po']));
        $planoMedico = $this->currencyToDecimal($this->formatMoney($_POST['planoMedico']));
        $extra = $this->currencyToDecimal($this->formatMoney($_POST['Extra']));

        $fileFornecedorCPF = $this->uploadModel->uploadFile('fileFornecedorCPF');
        $fileFornecedorRG = $this->uploadModel->uploadFile('fileFornecedorRG');
        $fileFornecedorComprovanteEndereço = $this->uploadModel->uploadFile('fileFornecedorComprovanteEndereço');
        $fileFornecedorContratoSocial = $this->uploadModel->uploadFile('fileFornecedorContratoSocial');
        $fileFornecedorCartãoCNPJ = $this->uploadModel->uploadFile('fileFornecedorCartãoCNPJ');
        $fileFornecedorContratoPrestação = $this->uploadModel->uploadFile('fileFornecedorContratoPrestação');

        if (isset($_POST['descontoVT'])) {
            $descontoVT = 1;
        } else {
            $descontoVT = 0;
        }

        $obj = $this->fornecedorModel->addFornecedor(
            $_POST['nome'],
            $_POST['email'],
            $_POST['telefone'],
            $_POST['contato'],
            $_POST['vip'],
            $_POST['cnpj'],
            $_POST['razao'],
            $_POST['fantasia'],
            $_POST['endereco'],
            $_POST['complemento'],
            $_POST['cidade'],
            $_POST['estado'],
            $_POST['banco'],
            $_POST['agencia'],
            $_POST['conta'],
            $_POST['favorecido'],
            $_POST['rg'],
            $_POST['cpf'],
            $_POST['nascimento'],
            $money,
            $_POST['cep'],
            $vt,
            $vr,
            $planoMedico,
            $extra,
            $descontoVT,
            $_POST['cargo'],
            $_POST['obs'],
            $po,
            $fileFornecedorCPF,
            $fileFornecedorRG,
            $fileFornecedorComprovanteEndereço,
            $fileFornecedorContratoSocial,
            $fileFornecedorCartãoCNPJ,
            $fileFornecedorContratoPrestação
        );

        if ($obj) {
            header("Location: " . URL . "home/fornecedores?salvo=true");
        } else {
            header("Location: " . URL . "home/fornecedores?erro=true");
        }
    }

    public function editFornecedor()
    {
        $money = $this->formatMoney($_POST['valor']);
        $money = $this->currencyToDecimal($money);
        $vt = $this->currencyToDecimal($this->formatMoney($_POST['VT']));
        $vr = $this->currencyToDecimal($this->formatMoney($_POST['VR']));
        $po = $this->currencyToDecimal($this->formatMoney($_POST['po']));
        $planoMedico = $this->currencyToDecimal($this->formatMoney($_POST['planoMedico']));
        $extra = $this->currencyToDecimal($this->formatMoney($_POST['Extra']));

        $fileFornecedorCPF = $this->uploadModel->uploadFile('fileFornecedorCPF');
        $fileFornecedorRG = $this->uploadModel->uploadFile('fileFornecedorRG');
        $fileFornecedorComprovanteEndereço = $this->uploadModel->uploadFile('fileFornecedorComprovanteEndereço');
        $fileFornecedorContratoSocial = $this->uploadModel->uploadFile('fileFornecedorContratoSocial');
        $fileFornecedorCartãoCNPJ = $this->uploadModel->uploadFile('fileFornecedorCartãoCNPJ');
        $fileFornecedorContratoPrestação = $this->uploadModel->uploadFile('fileFornecedorContratoPrestação');





        if (isset($_POST['descontar'])) {
            $descontoVT = 0;
        } else {
            $descontoVT = 1;
        }
        $obj = $this->fornecedorModel->editFornecedor(
            $_POST['nome'],
            $_POST['email'],
            $_POST['telefone'],
            $_POST['contato'],
            $_POST['vip'],
            $_POST['cnpj'],
            $_POST['razao'],
            $_POST['fantasia'],
            $_POST['endereco'],
            $_POST['complemento'],
            $_POST['cidade'],
            $_POST['estado'],
            $_POST['banco'],
            $_POST['agencia'],
            $_POST['conta'],
            $_POST['favorecido'],
            $_POST['rg'],
            $_POST['cpf'],
            $_POST['nascimento'],
            $money,
            $_POST['cep'],
            $_POST['fornecedorId'],
            $vt,
            $vr,
            $planoMedico,
            $extra,
            $descontoVT,
            $_POST['cargo'],
            $_POST['obs'],
            $po,
            $fileFornecedorCPF,
            $fileFornecedorRG,
            $fileFornecedorComprovanteEndereço,
            $fileFornecedorContratoSocial,
            $fileFornecedorCartãoCNPJ,
            $fileFornecedorContratoPrestação
        );

        if ($obj) {
            if (isset($_GET['aprovar']))
                header("Location: " . URL . "home/fornecedorform/{$_POST['fornecedorId']}?salvo=true&aprovar=true");
            else
                header("Location: " . URL . "home/fornecedorform/{$_POST['fornecedorId']}?salvo=true");
        } else {
            header("Location: " . URL . "home/fornecedorform/{$_POST['fornecedorId']}?erro=true");
        }
    }
    public function fornecedorForm($id = NULL)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $cargoID = $this->admModel->getAdmJobRoleByID($_SESSION['admID']);

            // Pega as permissões do cargo
            $getPermissions = $this->admModel->getJobRolePermissionsByID($cargoID);
            $permissions = explode(',', $getPermissions->strCargoAccess);

            // var_dump($permissions); exit;

            $cargos = $this->admModel->getAllJobRole();
            $obj = null;
            if (isset($id) && $id != NULL) {
                $obj = $this->fornecedorModel->getFornecedorByID($id);
            }

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/fornecedorform.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }
    public function fornecedor($id = NULL)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $cargos = $this->admModel->getAllJobRole();
            if (isset($id) && $id != NULL) {
                $obj = $this->fornecedorModel->getFornecedorByID($id);
            }

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/fornecedor.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }
    public function aprovarFornecedores()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $fornecedores = $this->fornecedorModel->getAllFornecedoresInactive();

            // var_dump($fornecedores); exit;

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/aprovarfornecedores.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }
    public function approveFornecedor($id)
    {
        $obj = $this->fornecedorModel->approveFornecedor($id);

        if ($obj) {
            header("Location: " . URL . "home/aprovarfornecedores?approved=true");
        } else {
            header("Location: " . URL . "home/aprovarfornecedores?approved=error");
        }
    }
    public function reproveFornecedor()
    {
        $obj = $this->fornecedorModel->registerReproveFornecedor($_POST['fantasia'], $_POST['solicitante'], $_POST['adm'], $_POST['reason'], $_POST['id']);
        $rc = $this->fornecedorModel->delFornecedor($_POST['id']);

        if ($obj) {
            header("Location: " . URL . "home/aprovarfornecedores?reproved=true");
        } else {
            header("Location: " . URL . "home/aprovarfornecedores?reproved=error");
        }
    }

    public function salarioBase()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $funcionarios = $this->funcionariosModel->getSalario();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/funcionario-cadastro.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    /*public function exportDados()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $fornecedores = $this->fornecedorModel->getExportDados();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/fornecedores.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }*/

    //COLABORADOR - FUNCIONARIO
    public function aprovarcolaboradores()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $funcionarios = $this->funcionariosModel->getAllFuncionariosToApprove();

            // var_dump($fornecedores); exit;

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/aprovarcolaboradores.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }
    public function approveFuncionario($id)
    {
        $obj = $this->funcionariosModel->approveFuncionario($id);

        if ($obj) {
            header("Location: " . URL . "home/aprovarcolaboradores?approved=true");
        } else {
            header("Location: " . URL . "home/aprovarcolaboradores?approved=error");
        }
    }
    public function reproveFuncionario()
    {
        $obj = $this->funcionariosModel->registerReproveFuncionario($_POST['nome'], $_POST['solicitante'], $_POST['adm'], $_POST['reason'], $_POST['id']);
        $rc = $this->funcionariosModel->delFuncionario($_POST['id']);

        if ($obj) {
            header("Location: " . URL . "home/aprovarcolaboradores?reproved=true");
        } else {
            header("Location: " . URL . "home/aprovarcolaboradores?reproved=error");
        }
    }
    public function addColaborador()
    {

        $salario = $this->formatMoney($_POST['salario']);
        $salario = $this->currencyToDecimal($salario);
        $creditos = $this->formatMoney($_POST['creditos']);
        $creditos = $this->currencyToDecimal($creditos);
        $total = $this->formatMoney($_POST['total']);
        $total = $this->currencyToDecimal($total);
        $fora = $this->formatMoney($_POST['fora']);
        $fora = $this->currencyToDecimal($fora);
        $vt = $this->formatMoney($_POST['vt']);
        $vt = $this->currencyToDecimal($vt);
        $vr = $this->formatMoney($_POST['vr']);
        $vr = $this->currencyToDecimal($vr);
        $convenio = $this->formatMoney($_POST['convenio']);
        $convenio = $this->currencyToDecimal($convenio);
        $ac = $this->formatMoney($_POST['ac']);
        $ac = $this->currencyToDecimal($ac);
        $po = $this->currencyToDecimal($this->formatMoney($_POST['po']));


        $fileFuncionarioCPF = $this->uploadModel->uploadFile('fileFuncionarioCPF');
        $fileFuncionarioRG = $this->uploadModel->uploadFile('fileFuncionarioRG');
        $fileFuncionarioCarteiraTrabalho = $this->uploadModel->uploadFile('fileFuncionarioCarteiraTrabalho');
        $fileFuncionarioPis = $this->uploadModel->uploadFile('fileFuncionarioPis');
        $fileFuncionarioComprovanteEndereco = $this->uploadModel->uploadFile('fileFuncionarioComprovanteEndereco');
        $fileFuncionarioTituloEleitor = $this->uploadModel->uploadFile('fileFuncionarioTituloEleitor');
        $fileFuncionarioExameMedico = $this->uploadModel->uploadFile('fileFuncionarioExameMedico');

        $obj = $this->funcionariosModel->addColaborador(
            $_POST['nome'],
            $_POST['pagamento'],
            $_POST['cpf'],
            $_POST['rg'],
            $salario,
            $creditos,
            $total,
            $fora,
            $_POST['registro'],
            $_POST['admissao'],
            $_POST['nascimento'],
            $_POST['cargo'],
            $_POST['banco'],
            $_POST['agencia'],
            $_POST['conta'],
            $vt,
            $vr,
            $convenio,
            $ac,
            $po,
            $total,
            $fileFuncionarioCPF,
            $fileFuncionarioRG,
            $fileFuncionarioCarteiraTrabalho,
            $fileFuncionarioPis,
            $fileFuncionarioComprovanteEndereco,
            $fileFuncionarioTituloEleitor,
            $fileFuncionarioExameMedico,
            $_SESSION['admID']
        );

        if ($obj) {
            header("Location: " . URL . "home/funcionarios?salvo=true");
        } else {
            header("Location: " . URL . "home/funcionarios?erro=true");
        }
    }

    public function editarFuncionario($id)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $cargos = $this->admModel->getAllJobRole();
            $funcionario = $this->funcionariosModel->getFuncionarioByID($id);

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/funcionario-cadastro.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }
    public function verFuncionario($id)
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $cargos = $this->admModel->getAllJobRole();
            $funcionario = $this->funcionariosModel->getFuncionarioByID($id);

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/funcionario.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function editFuncionario()
    {
        $salario = $this->formatMoney($_POST['salario']);
        $salario = $this->currencyToDecimal($salario);
        $creditos = $this->formatMoney($_POST['creditos']);
        $creditos = $this->currencyToDecimal($creditos);
        $total = $this->formatMoney($_POST['total']);
        $total = $this->currencyToDecimal($total);
        $fora = $this->formatMoney($_POST['fora']);
        $fora = $this->currencyToDecimal($fora);
        $vr = $this->formatMoney($_POST['vr']);
        $vr = $this->currencyToDecimal($vr);
        $vt = $this->formatMoney($_POST['vt']);
        $vt = $this->currencyToDecimal($vt);
        $convenio = $this->formatMoney($_POST['convenio']);
        $convenio = $this->currencyToDecimal($convenio);
        $ac = $this->formatMoney($_POST['ac']);
        $ac = $this->currencyToDecimal($ac);

        $po = $this->currencyToDecimal($this->formatMoney($_POST['po']));


        $fileFuncionarioCPF = $this->uploadModel->uploadFile('fileFuncionarioCPF');
        $fileFuncionarioRG = $this->uploadModel->uploadFile('fileFuncionarioRG');
        $fileFuncionarioCarteiraTrabalho = $this->uploadModel->uploadFile('fileFuncionarioCarteiraTrabalho');
        $fileFuncionarioPis = $this->uploadModel->uploadFile('fileFuncionarioPis');
        $fileFuncionarioComprovanteEndereco = $this->uploadModel->uploadFile('fileFuncionarioComprovanteEndereco');
        $fileFuncionarioTituloEleitor = $this->uploadModel->uploadFile('fileFuncionarioTituloEleitor');
        $fileFuncionarioExameMedico = $this->uploadModel->uploadFile('fileFuncionarioExameMedico');


        $obj = $this->funcionariosModel->editFuncionario(
            $_POST['nome'],
            $_POST['pagamento'],
            $_POST['cpf'],
            $_POST['rg'],
            $salario,
            $creditos,
            $total,
            $fora,
            $_POST['registro'],
            $_POST['admissao'],
            $_POST['nascimento'],
            $_POST['cargo'],
            $_POST['banco'],
            $_POST['agencia'],
            $_POST['conta'],
            $vr,
            $vt,
            $convenio,
            $ac,
            $_POST['fID'],
            $po,
            $fileFuncionarioCPF,
            $fileFuncionarioRG,
            $fileFuncionarioCarteiraTrabalho,
            $fileFuncionarioPis,
            $fileFuncionarioComprovanteEndereco,
            $fileFuncionarioTituloEleitor,
            $fileFuncionarioExameMedico
        );

        if ($obj) {
            if (isset($_GET['aprovar'])) {

                $link = "home/editarfuncionario/{$_POST['fID']}?salvo=true&aprovar=true";
            } else {
                $link = "home/funcionarios?salvo=true";
            }
            header("Location: " . URL . $link);
        } else {
            header("Location: " . URL . "home/funcionarios?erro=true");
        }
    }
    public function funcionarios()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $jobRole = $this->admModel->getAdmJobRoleByID($_SESSION['admID']);
            $perm = $this->admModel->getJobRolePermissionsByID($jobRole);
            $permissions = explode(',', $perm->strCargoAccess);
            $funcionarios = $this->funcionariosModel->getAllFuncionarios($_SESSION['admID']);
            //echo '<pre>', var_dump($funcionarios); echo '</pre>';

            /* exit;

            if (in_array('colaboradores-ver-meus', $permissions)) {
                $funcionarios = $this->funcionariosModel->getAllFuncionarios($_SESSION['admID']);

                exit;
            } elseif (in_array('colaborades-ver-tudo', $permissions)) {
                $funcionarios = $this->funcionariosModel->getAllFuncionarios($_SESSION['admID']);
                echo '<pre>', var_dump($funcionarios); echo '</pre>';
            } else {
                $funcionarios = array();
                echo '<pre>', var_dump($funcionarios); echo '</pre>';
            }*/

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/funcionarios.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function clientes()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $visib = $this->checkVisible($adm->intCargoID);

            if ($visib == "all") :
                $clientes = $this->clientesModel->getAllClientes();
            else :
                $clientes = $this->clientesModel->getMyClients($_SESSION['admID']);
            endif;


            $segmentos = $this->segmentosModel->getAllSegmentos();
            $agencias = $this->agenciaModel->getAllAgencias();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/clientes.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function cadastrarFuncionario()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $cargos = $this->admModel->getAllJobRole();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/funcionario-cadastro.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }
    public function funcionariosReprovados()
    {
        if ($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $funcionario = $this->funcionariosModel->getReprovedFuncionarios();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/funcionariosreprovados.php';
            require APP . 'view/_templates/footer.php';
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }

    public function reapproveColaborador($id)
    {
        if ($this->isLogged()) {
            $reapprove = $this->funcionariosModel->reapproveColaborador($id);

            if ($reapprove) {
                header("Location: " . URL . "home/editarfuncionario/" . $id . "?reapprove=true");
            } else {
                header("Location: " . URL . "home/editarfuncionario/" . $id . "?reapprove=error");
            }
        } else {
            header("Location: " . URL . "home?error=log");
        }
    }
}

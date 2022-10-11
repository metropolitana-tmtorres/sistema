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

    public function adm()
    {
        if($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            
            $cargos = $this->admModel->getAllJobRole();

            $usrs = $this->admModel->getAllAdm();
        
            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/adm.php';
            require APP . 'view/_templates/footer.php';
        }else{
            header("Location: " . URL . "home?error=log");
        }
    }

    public function admForm($id)
    {
        if($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);

            $usr = $this->admModel->getAdmByID($id);

            $cargo = $this->admModel->getJobRoleByID($usr->intCargoID);
            $cargos = $this->admModel->getAllJobRole();

        
            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/admform.php';
            require APP . 'view/_templates/footer.php';
        }else{
            header("Location: " . URL . "home?error=log");
        }
    }

    public function createBriefing($code)
    {
        if($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $crm = $this->crmModel->getCrmByID($code);
            $codeShow = $this->showCode($crm->intCrmID, 'C');
            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/briefing.php';
            require APP . 'view/_templates/footer.php';
        }else{
            header("Location: " . URL . "home?error=log");
        }
    }

    public function briefings() {
        if($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $crm = $this->crmModel->getCrmByID($code);
            $codeShow = $this->showCode($crm->intCrmID, 'C');
            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/briefing.php';
            require APP . 'view/_templates/footer.php';
        }else{
            header("Location: " . URL . "home?error=log");
        }
    }

    public function crm()
    {
        if($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $code = $this->generateCode();
            $crm = $this->crmModel->getAllCrm();
        
            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/crm.php';
            require APP . 'view/_templates/footer.php';
        }else{
            header("Location: " . URL . "home?error=log");
        }
    }

    public function cargos()
    {
        if($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $cargos = $this->admModel->getAllJobRole();
        
            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/cargo.php';
            require APP . 'view/_templates/footer.php';
        }else{
            header("Location: " . URL . "home?error=log");
        }
    }

    public function intervencoes($id)
    {
        if($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $int = $this->crmModel->getAllIntervencoesByID($id);
            $crm = $this->crmModel->getCrmByID($id);
            $codeShow = $this->showCode($crm->intCrmID, 'C');
        
            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/intervencao.php';
            require APP . 'view/_templates/footer.php';
        }else{
            header("Location: " . URL . "home?error=log");
        }
    }

    public function mudarCargo($id)
    {
        if($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $cargos = $this->admModel->getAllJobRole();
            $cargoID = $id;

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/mudar-cargo.php';
            require APP . 'view/_templates/footer.php';

        }else{
            header("Location: " . URL . "home?error=log");
        }
    }

    public function excluirAdm($id) {
        header("Location: " . URL . "home/deladm/" . $id);
    }

    public function delAdm($id) {
        if($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $u = $this->admModel->getAdmByID($id);
            $usrID = $id;

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/del-adm.php';
            require APP . 'view/_templates/footer.php';

        }else{
            header("Location: " . URL . "home?error=log");
        }
    }

    public function permissoes() {
        if($this->isLogged()) {
            $adm = $this->admModel->getAdmByID($_SESSION['admID']);
            $cargos = $this->admModel->getAllJobRole();

            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/permissoes.php';
            require APP . 'view/_templates/footer.php';

        }else{
            header("Location: " . URL . "home?error=log");
        }
    }

    public function excAdm($id) {
        $obj = $this->admModel->excAdm($id);

        if($obj) {
            header("Location: " . URL . "home/adm?salvo=true");
        }
    }

    public function cadastraCrm()
    {
        $obj = $this->crmModel->cadastraCrm($_POST['fantasia'],$_POST['contato'],$_POST['mail'],$_POST['telefone'],$_POST['funcao'],$_POST['status'],$_POST['adm']);

        if($obj){
            header("Location: " . URL . "home/crm?salvo=true");
        }else{
            header("Location: " . URL . "home/crm?erro=true");
        }
    }

    public function login() {

        $obj = $this->loginModel->login($_POST['mail'], md5($_POST['pass']));

        if(isset($obj->intAdmID)) {
            $_SESSION['admID'] = $obj->intAdmID;
            header("Location: " . URL . "home/crm");
        }
    }

    public function isLogged() {
        if(isset($_SESSION['admID'])) {
            return true;
        }else{
            return false;
        }
    }

    public function logout() {
        unset($_SESSION['admID']);
        session_destroy();
        header("Location: " . URL);
    }

    public function gen_uid($l=6){
        return substr(str_shuffle("0123456789"), 0, $l);
    }

    public function addAdm() {
        $obj = $this->admModel->addAdm($_POST['name'],$_POST['mail'],md5($_POST['pass']),$_POST['cargo']);

        if($obj) {
            header("Location: " . URL . "home/adm?salvo=true");
        }else{
            header("Location: " . URL . "home/adm?erro=true");
        }
    }

    public function editAdm() {
        $obj = $this->admModel->editAdm($_POST['name'],$_POST['mail'],$_POST['cargo'],$_POST['id']);

        if($obj) {
            header("Location: " . URL . "home/adm?salvo=true");
        }else{
            header("Location: " . URL . "home/adm?erro=true");
        }
    }

    public function cadastraCargo() {
        $obj = $this->admModel->registerJobRole($_POST['cargo']);
        $cp = $this->admModel->createJobRolePermission($obj);

        if($obj) {
            header("Location: " . URL . "home/cargos?salvo=true");
        }else{
            header("Location: " . URL . "home/cargos?erro=true");
        }
    }

    public function excluirCargo($id) {
        $cargoCount = $this->admModel->getAllUsersByJobRoleIDNum($id);

        if($cargoCount >= 1) {
            header("Location: " . URL . "home/mudarcargo/" . $id);
        }else{
            $obj = $this->admModel->deleteJobRole($id);

            if($obj) {
                header("Location: " . URL . "home/cargos?salvo=true");
            }else{
                header("Location: " . URL . "home/cargos?erro=true");
            }
        }
    }

    public function changeAndDeleteUsersJobRole() {
        $obj = $this->admModel->changeUsersJobRole($_POST['old'], $_POST['new']);

        if($obj) {
            $del = $this->admModel->deleteJobRole($_POST['old']);

            header("Location: " . URL . "home/cargos?salvo=true");
        }
    }

    public function cadastraIntervencao() {
        $obj = $this->crmModel->addIntervencao($_POST['historico'],$_POST['data'],$_POST['crmid']);
        if($obj) {
            header("Location: " . URL . "home/intervencoes/" . $_POST['crmid'] . "?salvo=true");
        }else{
            header("Location: " . URL . "home/intervencoes/" . $_POST['crmid'] . "?erro=true");
        }
    }

    public function gravaData($data) {
        $d = explode('/', $data);
        $nd = $d[2] . '-' . $d[1] . '-' . $d[0];

        return $nd;
    }

    public function mostraData($data) {
        $d = explode('-', $data);
        $nd = $d[2] . '/' . $d[1] . '/' . $d[0];

        return $nd;
    }

    public function checkAccess($url,$id) {
        $jID = $this->admModel->getJobRolePermissionsByID($id);
        //busca cargo com id
        //busca acesso do cargo
        //comparar in_array url
        //return true/false
    }

    public function getUrl() {
        $base = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);

        return $base;
    }

    public function registerPermission() {
        $ids = implode(",",$_POST["p"]);
        $obj = $this->admModel->registerPermission($_POST['cargo'],$ids);

        if($obj) {
            header("Location: " . URL . "home/permissoes?salvo=true");
        }else{
            header("Location: " . URL . "home/permissoes?erro=true");
        }
        
    }

    public function getJobRolePermissionsByID($id) {
        $p = $this->admModel->getJobRolePermissionsByID($id);

        $c = explode(',', $p->strCargoAccess);
?>
    <div class="col-md-6 col-xs-12">
        <div class="checkbox">
            <label>
                <input name="p[]" value="agencias" <?php if(in_array('agencias', $c)) { echo 'checked'; } ?> type="checkbox"> Agências
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input name="p[]" value="briefing" <?php if(in_array('briefing', $c)) { echo 'checked'; } ?> type="checkbox"> Briefing
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input name="p[]" value="segmentos" <?php if(in_array('segmentos', $c)) { echo 'checked'; } ?> type="checkbox"> Segmento de Clientes
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input name="p[]" value="clientes" <?php if(in_array('clientes', $c)) { echo 'checked'; } ?> type="checkbox"> Clientes
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input name="p[]" value="contratos" <?php if(in_array('contratos', $c)) { echo 'checked'; } ?> type="checkbox"> Contratos
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input name="p[]" value="crm" <?php if(in_array('crm', $c)) { echo 'checked'; } ?> type="checkbox"> CRM
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input name="p[]" value="intervencoes" <?php if(in_array('intervencoes', $c)) { echo 'checked'; } ?> type="checkbox"> Intervenções
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input name="p[]" value="metas" <?php if(in_array('metas', $c)) { echo 'checked'; } ?> type="checkbox"> Metas
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input name="p[]" value="moedas" <?php if(in_array('moedas', $c)) { echo 'checked'; } ?> type="checkbox"> Moedas
            </label>
        </div>
    </div>
    <div class="col-md-6 col-xs-12">
        <div class="checkbox">
            <label>
                <input name="p[]" value="propostas" <?php if(in_array('propostas', $c)) { echo 'checked'; } ?> type="checkbox"> Propostas
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input name="p[]" value="po" <?php if(in_array('po', $c)) { echo 'checked'; } ?> type="checkbox"> P.O.
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input name="p[]" value="pagamentos" <?php if(in_array('pagamentos', $c)) { echo 'checked'; } ?> type="checkbox"> Pagamentos
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input name="p[]" value="comissao" <?php if(in_array('comissao', $c)) { echo 'checked'; } ?> type="checkbox"> Regras de Comissão
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input name="p[]" value="topicos" <?php if(in_array('topicos', $c)) { echo 'checked'; } ?> type="checkbox"> Tópicos
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input name="p[]" value="cargos" <?php if(in_array('cargos', $c)) { echo 'checked'; } ?> type="checkbox"> Cargos
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input name="p[]" value="vendedores" <?php if(in_array('vendedores', $c)) { echo 'checked'; } ?> type="checkbox"> Vendedores
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input name="p[]" value="clientes" <?php if(in_array('clientes', $c)) { echo 'checked'; } ?> type="checkbox"> Clientes
            </label>
        </div>
    </div>
    <?php

    }

    public function generateCode() {
        $id = $this->crmModel->getLastID();
        $nid = $id->intCrmID+1;
        if($nid < 10){
            $code = "C000".$nid;
        }elseif($nid < 100 ) {
            $code = "C00".$nid;
        }else{
            $code = "C".$nid;
        }

        return $code;
    }

    public function saveBriefing() {
        $obj = $this->briefingModel->saveBriefing($_POST['code'],$_POST['qtdacoes'],$_POST['acoessimultaneas'],
        $_POST['datainicio'],$_POST['dataconclusao'],$_POST['feriado'],$_POST['acaofds'],
        $_POST['noturno'],$_POST['duracao'],$_POST['local'],$_POST['equipe'],$_POST['modelo'],
        $_POST['fotografo'],$_POST['videomaker'],$_POST['mecanica'],$_POST['equipamentos'],
        $_POST['brindes'],$_POST['qtdprodutos'],$_POST['flyers'],$_POST['uniforme'],$_POST['plotado'],
        $_POST['fotos'],$_POST['video'],$_POST['ppt'],$_POST['prazo'],$_POST['adm'],$_POST['crm']);

        if($obj) {
            header("Location: " . URL . "home/briefings?salvo=true");
        }else{
            header("Location: " . URL . "home/createbriefing/".$_POST['crm']."?erro=true");
        }
    }
}

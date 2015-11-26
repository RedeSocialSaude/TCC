<?php

session_start();

require_once 'Model_Login.php';

class Controler_Login{
    
    public $model_login;
    
    function __construct() {
        $this->model_login = new Model_Login;
    }
    
    public function Adapta_Dados($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    public function Cadastro(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){  
            $erro = false;
            
            $Nome = $this->Adapta_Dados($_POST["nome"]); 
            $Sobrenome = $this->Adapta_Dados($_POST["sobrenome"]); 
            $Email = $this->Adapta_Dados($_POST["email"]); 
            $Senha = $this->Adapta_Dados($_POST["senha"]);
            $Senha_Confirm = $this->Adapta_Dados($_POST["conf_senha"]);
            $Telefone = $this->Adapta_Dados($_POST["telefone"]);
            $Estado = $this->Adapta_Dados($_POST["estado"]);
            $Cidade = $this->Adapta_Dados($_POST["cidade"]);
            $Sexo = $this->Adapta_Dados($_POST["sexo"]); 
            $TipoUsuario = $this->Adapta_Dados($_POST["tipoUsuario"]); 
            $Dia = $this->Adapta_Dados($_POST["dia"]); 
            $Mes = $this->Adapta_Dados($_POST["mes"]); 
            $Ano = $this->Adapta_Dados($_POST["ano"]); 
            $crm = $this->Adapta_Dados($_POST["crm"]); 
            
            $Data_Nasc = $Ano."-".$Mes."-".$Dia;  

            $this->ConsultaCRM($Nome, $Estado, $crm);
            
        }

        if($TipoUsuario == '1'){
            $retorno = $this->model_login->Cadastra_Usuario($Nome, $Sobrenome, $Email, $Senha, $Senha_Confirm, $Telefone, $Estado, $Cidade, $Sexo, $Data_Nasc, $TipoUsuario);    
        }else{
            $retorno = $this->model_login->Cadastra_ProfissionalSaude($Nome, $Sobrenome, $Email, $Senha, $Senha_Confirm, $Telefone, $Estado, $Cidade, $Sexo, $Data_Nasc, $TipoUsuario, $crm, '', '');
        }
                
                
        //$retorno = $this->model_login->Cadastra_ProfissionalSaude($Nome, $Sobrenome, $Email, $Senha, $Telefone, $Estado, $Cidade, $Sexo, $Data_Nasc, $CRM, $Curso);
        if($retorno){
            //Pega ID
            $cod = 'id_pessoa';
            $id = $this->model_login->RetornaBanco($Email, $cod);
            $_SESSION['Id'] = $id;
            //Pega Nome
            $cod = 'nome_pessoa';
            $id = $this->model_login->RetornaBanco($Email, $cod);
            $_SESSION['Nome'] = $id;
            //Pega caminho da imagem
            $cod = 'imagem_perfil';
            $id = $this->model_login->RetornaBanco($Email, $cod);
            $_SESSION['Imagem'] = $id;
            header("Location: feed.php");
            //echo "ok";
        }else{
            echo "erro";
            //header("Location: index.php");
        }
    }

    public function Verifica_Login(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){ 
            $Email_Login = $this->Adapta_Dados($_POST["email"]); 
            $Senha_Login = $this->Adapta_Dados($_POST["senha"]); 
        }
        
        $aux = $this->model_login->Login($Email_Login, $Senha_Login);
        
        if($aux != false){
            //Pega ID
            $cod = 'id_pessoa';
            $id = $this->model_login->RetornaBanco($Email_Login, $cod);
            $_SESSION['Id'] = $id;
            //Pega Nome
            $cod = 'nome_pessoa';
            $id = $this->model_login->RetornaBanco($Email_Login, $cod);
            $_SESSION['Nome'] = $id;
            //Pega caminho da imagem
            $cod = 'imagem_perfil';
            $img = $this->model_login->RetornaBanco($Email_Login, $cod);
            $_SESSION['Imagem'] = $img;
            $_SESSION['idDados'] = 0;
            header("Location: feed.php");
            //echo $img;
            //echo "teste";
        }else{
            //echo "erro";
            //header("Location: index.php");
            echo"<script language='javascript' type='text/javascript'>alert('O email ou a senha está incorreto.');window.location.href='index.php';</script>";
        } 
    }
    
    public function Verifica(){
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'cadastro') {                
                //chama o metodo responsavel por realizar as configurações de cadastro
                $this->Cadastro();
                
            }else if ($_GET['action'] == 'login') {                
                //chama o metodo responsavel por realizar as configurações de login
                $this->Verifica_Login();
                
            }else if($_GET['action'] == 'sair'){
                //Limpa $_SESSION[] e sai do sistema
                session_unset();
                header("Location: index.php");
                
            }else if ($_GET['action'] == 'senha'){
                //verifca se o email existe
                //se sim, manda email
                //se não, menssagem de pedindo email
            }
        }
    }
    
    public function ConsultaCRM($Nome, $UF, $CRM){
        $retorno = $this->model_login->VerificaCRM($Nome, $UF, $CRM);
        if($retorno == false){
            echo"<script language='javascript' type='text/javascript'>alert('O CRM está incorreto.');</script>";
        }
    }
    
}

$controler = new Controler_Login;
$controler->Verifica();

//$controler->ConsultaCRM();

?>
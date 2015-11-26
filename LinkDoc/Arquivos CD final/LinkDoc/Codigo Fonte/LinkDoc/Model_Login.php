<?php

include 'DAO.php';

//curl_setopt_array($onda, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://www.consultacrm.com.br/api/index.php?tipo=crm&uf=MG&q=12&chave=6574946388&destino=xml' ));

class Model_Login{
    
    public function CriptografaSenha($senha){
        $senha_crip = md5($senha); 
        return $senha_crip;
    }

    public function Login($Email, $Senha){
        if($Email != null && $Senha != null){
            $host="127.0.0.1";
            $port=3306;
            $socket="";
            $user="root";
            $password="";
            $dbname="mydb";
                            
            $Senha = $this->CriptografaSenha($Senha); 
            
            $con = new mysqli($host, $user, $password, $dbname, $port, $socket) or die 
                    ('Could not connect to the database server' . mysqli_connect_error());

            if ($con != NULL) {
                
                $aux = Verifica_Login($Email, $Senha, $con);        
                        
                closeBD($con);
                
                return $aux;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    public function RetornaBanco($Email, $cod){
        if($Email != null){
            $host="127.0.0.1";
            $port=3306;
            $socket="";
            $user="root";
            $password="";
            $dbname="mydb";
            
            $con = new mysqli($host, $user, $password, $dbname, $port, $socket) or die 
                    ('Could not connect to the database server' . mysqli_connect_error());

            if ($con != NULL) {
                
                $aux = RetornaDados($Email, $cod, $con);        
                        
                closeBD($con);
                
                return $aux;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    public function Cadastra_Usuario($Nome, $Sobrenome, $Email, $Senha, $Senha_Confirm, $Telefone, $Estado, $Cidade, $Sexo, $Data_Nasc, $TipoUsuario){
        if($Nome != null && $Sobrenome != null && $Email != null && $Senha != null && $Senha_Confirm != null && $Telefone != null && $Estado != null && $Cidade != null && $Sexo != null && $Data_Nasc != null){
            //$con = connectMysql('localhost', 'root', 'photomod');
            
            $host="127.0.0.1";
            $port=3306;
            $socket="";
            $user="root";
            $password="";
            $dbname="mydb";
                            
            $Senha = $this->CriptografaSenha($Senha);
            
            $con = new mysqli($host, $user, $password, $dbname, $port, $socket) or die 
                    ('Could not connect to the database server' . mysqli_connect_error());

            if ($con != NULL) {
                $VerificaDuplicidade = Verifica_Duplicidade($Email, $con);
                if($VerificaDuplicidade == true){
                    $retorno = InserePessoa($Nome, $Sobrenome, $Email, $Senha, $Telefone, $Estado, $Cidade, $Sexo, $Data_Nasc, $TipoUsuario, $con);   
                    //$retorno2 = InsereTelefone($Telefone, $con);
                    //$id_Telefone = RetornaTelefone($Telefone, $con);
                    //$id_Pessoa = RetornaDados($Email, "id_pessoa", $con);
                    //$retorno3 = Insere_Telefone_Pessoa($id_Telefone, $id_Pessoa, $con);
                    //if($retorno2 == false){
                      //  return false;
                    //}
                    //if($retorno3 == false){
                      //  return false;
                    //}
                    closeBD($con);                
                    return $retorno;
                }else{
                    return false;
                }                
            }else{
                return false;
            }
        }
    }    

    public function Cadastra_ProfissionalSaude($Nome, $Sobrenome, $Email, $Senha, $Senha_Confirm, $Telefone, $Estado, $Cidade, $Sexo, $Data_Nasc, $TipoUsuario, $CRM, $Curso, $LocalTrabalho){
        if($Nome != null && $Sobrenome != null && $Email != null && $Senha != null && $Senha_Confirm != null && $Telefone != null && $Estado != null && $Cidade != null && $Sexo != null && $Data_Nasc != null && $CRM != null){
            //$con = connectMysql('localhost', 'root', 'photomod');
            
            $host="127.0.0.1";
            $port=3306;
            $socket="";
            $user="root";
            $password="";
            $dbname="mydb";
                            
            $Senha = $this->CriptografaSenha($Senha);
            
            $con = new mysqli($host, $user, $password, $dbname, $port, $socket) or die 
                    ('Could not connect to the database server' . mysqli_connect_error());

            if ($con != NULL) {
                $VerificaDuplicidade = Verifica_Duplicidade($Email, $con);
                if($VerificaDuplicidade == true){
                    $retorno = InserePessoa($Nome, $Sobrenome, $Email, $Senha, $Telefone, $Estado, $Cidade, $Sexo, $Data_Nasc, $TipoUsuario, $con);   
                    
                    $con2 = new mysqli($host, $user, $password, $dbname, $port, $socket) or die 
                    ('Could not connect to the database server' . mysqli_connect_error());
                    if ($con2 != NULL) {
                        //Pega ID
                        $cod = 'id_pessoa';
                        $id = $this->RetornaBanco($Email, $cod);
                        $retorno2 = InsereProfissional($id, $CRM, $Curso, $LocalTrabalho, $con2);
                    }

                    closeBD($con);                
                    return $retorno;
                }else{
                    return false;
                }                
            }else{
                return false;
            }
        }
    }
    
    public function processXML($node){
        foreach($node->children() as $books => $data){

            if(trim($data) != ""){
        
                if($books == "total"){
                    $GLOBALS["total"] = $data;
                }

                if($books == "nome"){
                    $GLOBALS["nome"] = $data;
                }
        
                if($books == "uf"){
                    $GLOBALS["estado"] = $data;
                }
        
                if($books == "situacao"){
                    $GLOBALS["situacao"] = $data;
                }
        
                //echo $books.": ".$data;
                //echo "<br />";
            }

            $this->processXML($data);
        }
    }
    
    public function VerificaCRM($Nome, $UF, $CRM){        
        $api = curl_init();
   
        if(curl_setopt_array($api, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://www.consultacrm.com.br/api/index.php?tipo=crm&uf='.$UF.'&q='.$CRM.'&chave=6574946388&destino=xml' ))){
    
            $result = curl_exec($api);
            curl_close($api);
            $xml = simplexml_load_string($result);
    
            $this->processXML($xml);

            if($GLOBALS["nome"] == $Nome && $GLOBALS["estado"] == $UF){
                /*
                echo $GLOBALS["total"];
                echo '<br>';
                echo $GLOBALS["nome"];
                echo '<br>';
                echo $GLOBALS["estado"];
                echo '<br>';
                echo $GLOBALS["situacao"];
                */
                return true;
            }else{
                return false;
            } 
        }else{    
            return false;    
        }
        
    }
    
}

?>
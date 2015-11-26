<?php
session_start();

include 'DAO.php';

//Valida se usuario esta logado
if ($_SESSION['Id'] == null && $_SESSION['Nome'] == null) {
    header("Location: index.php");
}else{

    //não mostra erros
    error_reporting(0);
    ini_set(“display_errors”, 0 );

    $id = $_SESSION['Id'];

    $host = "localhost";
    $port = 3306;
    $socket = "";
    $user = "root";
    $password = "";
    $dbname = "mydb";

    $con = mysqli_connect($host, $user, $password, $dbname)
        or die('Could not connect to the database server' . mysqli_connect_error());
    $sql = "SELECT nome_pessoa, sobrenome_pessoa, caminho_imagem FROM mydb.pessoa where id_pessoa = '$id'";
    if ($resultado = mysqli_query($con, $sql)) {
        while ($row = mysqli_fetch_object($resultado)) {
            $aux = $row->nome_pessoa;
            $nome = $aux . " " . $row->sobrenome_pessoa;
            $_SESSION['Nome'] = $nome;
            $_SESSION['Imagem'] = $row->caminho_imagem;
        }
    }

    closeBD($con);

    $x = 0;
    $idPes = $_SESSION['Id'];

    $con = mysqli_connect($host, $user, $password, $dbname)
        or die('Could not connect to the database server' . mysqli_connect_error());
    $sql = "SELECT cidade FROM mydb.pessoa where id_pessoa = '$id'";
    if ($resultado = mysqli_query($con, $sql)) {
        while ($row = mysqli_fetch_object($resultado)) {
            $_SESSION['cidade'] = $row->cidade;
        }
    }

    closeBD($con);

    //Pega idade
    $host = "localhost";
    $port = 3306;
    $socket = "";
    $user = "root";
    $password = "";
    $dbname = "mydb";

    $con2 = mysqli_connect($host, $user, $password, $dbname)
        or die('Could not connect to the database server' . mysqli_connect_error());
    $sql2 = "SELECT data_nasc, email, estado FROM mydb.pessoa where id_pessoa = '$id'";
    if ($resultado2 = mysqli_query($con2, $sql2)) {
        while ($row = mysqli_fetch_object($resultado2)) {
            $idadeBruta = $row->data_nasc;
            $ano = substr($idadeBruta, 0, 4);
            $mes = substr($idadeBruta, 5, 2);
            $dia = substr($idadeBruta, 8, 2);

            $dataAno = date("Y");
            $dataMes = date("m");
            $dataDia = date("d");

            $aux1 = $dataAno - $ano;

            $_SESSION['idade'] = $aux1;
            $_SESSION['email'] = $row->email;
            $_SESSION['estado'] = $row->estado;
        }
    }

    closeBD($con2);

    $con = mysqli_connect($host, $user, $password, $dbname)
        or die('Could not connect to the database server' . mysqli_connect_error());
    $sql = "SELECT grupo_id_grupo FROM mydb.pessoa_has_grupo where pessoa_id_pessoa = '$idPes'";
    if ($resultado = mysqli_query($con, $sql)) {
        while ($row = mysqli_fetch_object($resultado)) {
            $id_grupos = $row->grupo_id_grupo;
            $vet[] = $id_grupos;
        }
    }
mysqli_close($con);
    
    $con = mysqli_connect($host, $user, $password, $dbname)
        or die('Could not connect to the database server' . mysqli_connect_error());
for($x=0; $x<=count($vet); $x++){
        //Seleciona dados   
        $sql = "SELECT nome_grupo FROM grupo where id_grupo= '$vet[$x]'";
        if ($resultado = mysqli_query($con, $sql)) {
            while ($row = mysqli_fetch_object($resultado)) {
                $tes = $row->nome_grupo;
                $tes2 = $vet[$x];

                $nomes[$x] = $tes;
                $ids[$x] = $tes2;

                $x = $x + 1;
            }
        } 
    }
mysqli_close($con);

}

function AlteraImg($img){
    
    //header("Location: teste.php");
    $host = "localhost";
    $port = 3306;
    $socket = "";
    $user = "root";
    $password = "";
    $dbname = "mydb";

    $idPes = $_SESSION['Id'];

    $con = mysqli_connect($host, $user, $password, $dbname)
    or die('Could not connect to the database server' . mysqli_connect_error());
    $sql = "UPDATE `mydb`.`pessoa` SET `caminho_imagem`='$img' WHERE `id_pessoa`='$idPes'";
    if (mysqli_query($con, $sql)) {
        $_SESSION['Imagem'] = $img;
        //header("Location: perfil.php");
        //echo "Nome";
    } else {
        echo"<script language='javascript' type='text/javascript'>alert('Falha no upload da imagem.');window.location.href='perfil.php';</script>";
                
    }
}

function uploadFile($arquivo, $destino, $tamMax, $extensoes, $renomeia) {

    //header("Location: hora.php");
            
    if(isset($_FILES['arquivo'])) { 
        
        if(isset($_POST['submit'])) {
            
            $_SESSION['img'][0] = $_FILES['arquivo']['name'][0];

            $_UP['pasta'] = $destino;
            $_UP['tamanho'] = $tamMax; //1024 * 1024 *2; // 2Mb
            $_UP['extensoes'] = $extensoes;
            $_UP['renomeia'] = $renomeia;
            
            // Arraycom os tipos de erros de upload do PHP
            $_UP['erros'][0] ='Não houve erro'; 
            $_UP['erros'][1] ='O arquivo no upload é maior do que o limite do PHP'; 
            $_UP['erros'][2] ='O arquivo ultrapassa o limite de tamanho especifiadono HTML'; 
            $_UP['erros'][3] ='O upload do arquivo foi feito parcialmente'; 
            $_UP['erros'][4] ='Não foi feito o upload do arquivo';

            //print_r($_FILES);

            if($_FILES['arquivo']['error'] == 1) {
                die("Impossível fazer o upload, erro: ".$_UP['erros'][1]); 
                exit; // Para a execução do script
            }
            if($_FILES['arquivo']['error'] == 2) {
                die("Impossível fazer o upload, erro: ".$_UP['erros'][2]); 
                exit; // Para a execução do script
            }
            if($_FILES['arquivo']['error'] == 3) {
                die("Impossível fazer o upload, erro: ".$_UP['erros'][3]); 
                exit; // Para a execução do script
            }
            if($_FILES['arquivo']['error'] == 4) {
                die("Impossível fazer o upload, erro: ".$_UP['erros'][4]); 
                exit; // Para a execução do script
            }
            
            $aux = $_FILES['arquivo']['name'];
            $nome = $aux[0];
            
                        
            $extensao = strtolower( end(explode('.', $nome) ) ); 
            if(array_search($extensao, $_UP['extensoes']) === false) { 
                echo"Por favor, envie arquivos com as seguintes extensões:";
                foreach($_UP['extensoes'] as $ext){
                    echo".$ext";
                }
                exit;
            }

            $aux2 = $_FILES['arquivo']['size'];
            $tamanho = $aux2[0];
            
            if($_UP['tamanho'] < $tamanho) { 
                echo"O arquivo enviado é muito grande, envie arquivos de até 2Mb."; 
                exit;
            }

            //if($_UP['renomeia'] == $renomeia) { 
            // Cria um nome baseado no UNIX TIMESTAMP atual e concatena a extensão 
              //  $nome_final= md5(microtime()).".".$extensao; 
                
            //} else{ // Mantém o nome original do arquivo 
                $nome_final_aux = $_FILES['arquivo']['name']; 
                $nome_final = $nome_final_aux[0];
            //}

            $aux3 = $_FILES['arquivo']['tmp_name'];
            $caminho = $aux3[0];
            if(move_uploaded_file($caminho, $_UP['pasta'] . $nome_final)) {
                //echo"Upload efetuado com sucesso!"; 
                //echo'<a href="' .$_UP['pasta'] .$nome_final. '">Clique aqui para acessar o arquivo</a>'; 
                //echo "<meta HTTP-EQUIV='refresh' CONTENT='5;URL=uploadAndShow.php'>"; //atualiza a página
                
                $nom = $_UP['pasta'] . $nome_final;
                
                $num = count($_SESSION['imagem']);
                $_SESSION['imagem'][$num + 1] = $_UP['pasta'] .$nome_final;
                $_SESSION['id'][$num + 1]  = $num + 1;
                //$_SESSION['contagem'][0] = $_SESSION['contagem'][0] + 1;
                //echo $nom;
                //Mostra($nom);    
                $caminhoImg = $_SESSION['Imagem'][0];
                AlteraImg($nome_final);     
           
            } else{ 
                echo"<script language='javascript' type='text/javascript'>alert('Falha no upload da imagem.');window.location.href='perfil.php';</script>";            
            }
        }
    }  
}

function getArrayOfPixelsFromImage($image) {
    $width = imagesx($image);
    $height = imagesy($image);
    $colors = array();

    for ($y = 0; $y < $height; $y++) {
        $y_array = array();
        for ($x = 0; $x < $width; $x++) {
            //Seleciona a cor localizada em ($x, $y)
            $rgb = imagecolorat($image, $x, $y);
            //echo $rgb." = ".decbin($rgb),"<br>";
            //Seleciona os primeiros dois bytes que representam vermelho
            $r = ($rgb >> 16) & 0xFF;
            //Seleciona os dois bytes do meio que representam o verde
            $g = ($rgb >> 8) & 0xFF;
            //Seleciona os dois Ãºltimos bytes que representam o azul
            $b = $rgb & 0xFF;
            $x_array = array($r, $g, $b);
            $y_array[] = $x_array;
        }
        $colors[] = $y_array;
    }
    return $colors;
}

if($_GET['action'] == 'upload'){
    $tamMax = 1024 * 1024 *2;
    $renomeia = true;
    $destino = "C:\wamp\www\Final\imagens\\";
    $extensoes = array('jpg','png','gif');
    $arquivo = $_FILES['arquivo'];

    uploadFile($arquivo, $destino, $tamMax, $extensoes, $renomeia);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LinkDoc</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="feed.php">LinkDoc</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <?php for ($z = 0; $z < 1; $z++) { ?>
                                
                        <li class="message-preview">
                            <a href="grupos.php?action=<?php echo $ids[$z]; ?>">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="img-circle" src="imagens\<?php echo $_SESSION['Imagem']; ?>" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong> <?php echo $nomes[$z]; ?></strong>
                                        </h5>

                                        <p class="small text-muted"><i class="fa fa-user"></i> <?php echo $_SESSION['Nome']; ?></p>
                                        <p><?php echo $_SESSION['Nome']; ?> você está participando do grupo <?php echo $nomes[$z]; ?>.</p>

                                    </div>
                                </div>
                            </a>
                        </li>

                        
                        
                        <li class="message-footer">
                            <a href="grupos.php?action=<?php echo $ids[$z]; ?>"> Leia mais mensagens</a>
                        </li>

                        <?php } ?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                     <?php
                     $con = mysqli_connect($host, $user, $password, $dbname)
        or die('Could not connect to the database server' . mysqli_connect_error());
                        $sql = "SELECT dados_id_dados FROM mydb.pessoa_has_dados where pessoa_id_pessoa = '$idPes'";
                        if ($resultado = mysqli_query($con, $sql)) {
                            while ($row = mysqli_fetch_object($resultado)) {
                                $idDados = $row->dados_id_dados;
                            }
                        } mysqli_close($con);

                        $con = mysqli_connect($host, $user, $password, $dbname)
        or die('Could not connect to the database server' . mysqli_connect_error());
                        $sql = "SELECT peso, altura FROM mydb.dados where id_dados = '$idDados'";
                        if ($resultado = mysqli_query($con, $sql)) {
                            while ($row = mysqli_fetch_object($resultado)) {
                                $Peso = $row->peso;
                                $Altura = $row->altura;
                            }
                        }

                        $IMC = $Peso / ($Altura ^ 2);

                        mysqli_close($con);

                        if (($Peso == null) || ($Altura == null)) {
                            //Ruim
                            ?>     

                            
                            <img class="img-circle" src="imagens\sem_dados.jpg" alt="" style="position:relative; left:65px;">
                                            
                            <li>
                                <a href="feed.php">Você ainda não possui nenhum gráfico, por favor insira os dados.</a>                                
                            </li>
                            
                        <?php  } else {
                        if (($IMC >= 18) && ($IMC <= 24) && ($IMC != null)) {
                            ?>
                            <img class="img-circle" src="imagens\bom.jpg" alt="" style="position:relative; left:65px;">
                            <li>
                                <a href="#">Parabêns, você possui um ótimo indice de massa corporal (IMC).</a>
                            </li>

                            <li class="divider"></li>
                            <li>
                                <a href="graficos.php">Visualizar gráficos</a>
                            </li>
                        <?php
                        } else {

                        if (($IMC < 18) || ($IMC > 24) && ($Peso != null) || ($Altura != null)) {
                            ?>
                            <img class="img-circle" src="imagens\ruim.jpg" alt="" style="position:relative; left:65px;">
                            <li>
                                <a href="#">Ops! O seu indice de massa corporal (IMC) não está muito bom.</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="graficos.php">Visualizar gráficos</a>
                            </li>
<?php } } } ?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['Nome']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="perfil.php"><i class="fa fa-fw fa-user"></i> Perfil</a>
                        </li>
                       <?php for ($z = 0; $z < 1; $z++) { ?>
                        <li>
                            <?php
                            if($ids[$z] == ''){ ?>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Mensagens</a>
                            <?php }else{ ?>
                            <a href="grupos.php?action=<?php echo $ids[$z]; ?>"><i class="fa fa-fw fa-envelope"></i> Mensagens</a>
                            <?php } ?>
                        </li>
                        <?php } ?>
                        <li class="divider"></li>
                        <li>
                            <a href="Controler_Login.php?action=sair"><i class="fa fa-fw fa-power-off"></i> Sair</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                   
                          
                            <img class="img-gran img-circle"  src="imagens\<?php echo $_SESSION['Imagem']; ?>"></img>
                          <div class="name" style="text-align:center;">
                                <a href="perfil.php"> <?php echo $_SESSION['Nome']; ?></a>
                            </div>
                          
                       <hr>
                    <li style="margin-top:15px;">
                        <a href="feed.php"><i class="fa fa-fw fa-dashboard"></i> Feed</a>
                    </li>
                    <li>
                        <a href="graficos.php"><i class="fa fa-fw fa-bar-chart-o"></i> Gráficos</a>
                    </li>
                    <li>
                        <a href="areaInformativa.php"><i class="fa fa-fw fa-table"></i> Área Informativa</a>
                    </li>

                    <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Grupos <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="demo" class="collapse">
                                <?php for ($z = 0; $z < $x; $z++) { ?>
                                    <li>
                                        <a href="grupos.php?action=<?php echo $ids[$z]; ?>"> <?php echo $nomes[$z]; ?> </a>
                                    </li>
                                <?php } ?>
                                <li>
                                    <a href="#" id="myBtn">Criar novo grupo</a>
                                </li>
                            </ul>
                        </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                <div class="profile-header text-center" style="background-image: url(header.jpeg); ">
                      <div class="container-fluid">
                        <div class="container-inner">
                          <center><img class="img-circle media-object" src="imagens\<?php echo $_SESSION['Imagem']; ?>" style="margin-top:15px;"></center>
                          <h3 class="profile-header-user"> <?php echo $_SESSION['Nome']; ?></h3>
                          <p class="profile-header-bio"> ... </p>
                        </div>
                      </div>
                      <nav class="profile-header-nav">
                        <ul class="nav nav-tabs">
                          <li class="active"><a data-toggle="tab" href="#d">Dados Pessoais</a></li>
                          <li><a data-toggle="tab" href="#seg">Segurança</a></li>
                          <li><a  data-toggle="tab" href="#fotos">Fotos</a></li>
                        </ul>
                        <div class="tab-content">
                         
                            <div id="d" class="tab-pane fade in active">
                                <h3>Perfil</h3>
                                <p>Nome: <?php echo $_SESSION['Nome']; ?><br></p>
                                <p>Idade: <?php echo $_SESSION['idade']; ?> anos<br></p>

                                <p>Estado: <?php echo $_SESSION['estado']; ?><br></p>
                                <p>Cidade: <?php echo $_SESSION['cidade']; ?><br></p>
                                <p>Email: <?php echo $_SESSION['email']; ?><br></p>
                                
                                <?php
                                $con = mysqli_connect($host, $user, $password, $dbname)
        or die('Could not connect to the database server' . mysqli_connect_error());
    $sql = "SELECT cod_dif FROM mydb.pessoa where id_pessoa = '$idPes'";
    if ($resultado = mysqli_query($con, $sql)) {
        while ($row = mysqli_fetch_object($resultado)) {
            $id_AI = $row->cod_dif;
        }
    }

    if($id_AI == 0){ 
        $con2 = mysqli_connect($host, $user, $password, $dbname)
        or die('Could not connect to the database server' . mysqli_connect_error());
    $sql2 = "SELECT curso, local_trabalho FROM mydb.profissional_saude where pessoa_id_pessoa = '$idPes'";
    if ($resultado2 = mysqli_query($con2, $sql2)) {
        while ($row = mysqli_fetch_object($resultado2)) {
            $curso = $row->curso;
            $local = $row->local_trabalho;
        }
    }
    mysqli_close($con2);
        ?>

                            <p>Graduação: <?php echo $curso; ?><br></p>
                            <p>Local de trabalho: <?php echo $local; ?><br></p>

    <?php }  mysqli_close($con);
 ?>

<hr>
                            <h4>Alterar dados pessoais</h4>
                            <br>
                            <form class="form-inline" action="controler_Perfil.php?action=AlterarDados" method="post">
                                <div class="form-group">
                               <div class="col-lg-6">
                                        <div class="input-group">
                                          <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                          <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" size="50" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="input-group">
                                          <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                          <input type="text" class="form-control" name="sobrenome" id="sobrenome" placeholder="Sobrenome" size="50" required>
                                        </div>
                                      </div>  

                                        <div class="col-lg-6" style="text-align:left;">
                                            <br>
                                        <div class="input-group">
                                          <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                          <input type="text" class="form-control" name="idade" id="idade" placeholder="Data de Nascimento (xxxx-xx-xx)" size="50" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6" style="text-align:left;">
                                        <br>
                                        <div class="input-group">
                                          <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                          <input type="text" class="form-control" name="email" id="email" placeholder="Email" size="50" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6" style="text-align:left;">
                                        <br>
                                        <div class="input-group">
                                          <div class="input-group-addon"><i class="fa fa-home"></i></div>
                                          <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade" size="50" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6" style="text-align:left;">
                                        <br>
                                        <div class="input-group">
                                          <div class="input-group-addon"><i class="fa fa-home"></i></div>
                                          <input type="text" class="form-control" name="estado" id="estado" placeholder="Estado" size="50" required>
                                        </div>
                                    </div>

                                    <br><br>
                                    <p>

                                    <div class="col-lg-12" style="text-align:right;">
                                        <br>
                                        <div class="input-group">
                                          <button class="btn" name="salvar"> Enviar</button></p>
                                        </div>
                                    </div>

                                    
                                    </div>
                                    </form>
                                    </hr>

                                    <?php 

                            $con = mysqli_connect($host, $user, $password, $dbname)
        or die('Could not connect to the database server' . mysqli_connect_error());
    $sql = "SELECT cod_dif FROM mydb.pessoa where id_pessoa = '$idPes'";
    if ($resultado = mysqli_query($con, $sql)) {
        while ($row = mysqli_fetch_object($resultado)) {
            $id_M = $row->cod_dif;
        }
    }

    if($id_M == 0){

     ?>
                          <hr>
                            <h4>Alterar dados profissionais</h4>
                            <br>
                            <form class="form-inline" action="controler_Perfil.php?action=AlterarDadosP" method="post">
                                <div class="form-group">
                               <div class="col-lg-6">
                                        <div class="input-group">
                                          <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                          <input type="text" class="form-control" name="curso" id="curso" placeholder="Graduação" size="50" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="input-group">
                                          <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                          <input type="text" class="form-control" name="local" id="local" placeholder="Local de trabalho" size="50" required>
                                        </div>
                                      
                                    </div>

                                    <br><br>
                                    <p>

                                    <div class="col-lg-12" style="text-align:right;">
                                        <br>
                                        <div class="input-group">
                                          <button class="btn" name="salvar"> Enviar</button></p>
                                        </div>
                                    </div>

                                    
                                    </div>
                                    </form>
                                    </hr>
    <?php }  mysqli_close($con);
 ?>

                                    
                                </div>      

                            <div id="seg" class="tab-pane fade">
                                <h3>Alterar senha</h3>
                                <form class="form-inline" action="controler_Perfil.php?action=AlterarSenha" method="post">
                                <p> <br><div class="col-lg-5" style="width: 900px;">                                
                                    <div class="input-group">
                                      <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                      <input type="password" class="form-control" name="senha" id="senha" placeholder="Digite a senha atual" size="50" required>
                                    </div>
                                </div></p>

                                <p> <br><br><div class="col-lg-6">
                                    <div class="input-group">
                                      <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                      <input type="password" class="form-control" name="NovaSenha" id="NovaSenha" placeholder="Digite a nova senha" size="50" required>
                                    </div>
                                </div></p>

                                <p> <div class="col-lg-6">
                                    <div class="input-group">
                                      <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                      <input type="password" class="form-control" name="ConfSenha" id="ConfSenha" placeholder="Confirme a nova senha" size="50" required>
                                    </div>
                                </div></p>
                                <p style="padding-right:105px;">
                                    <br><br>
                                    <button class="btn btn-ad">Confirmar</button>
                                </p>
                                </form>
                            </div>
                            <div id="fotos" class="tab-pane fade">
                                <h3>Fotos</h3>
                                <br>
                                <form action="perfil.php?action=upload" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="arquivoId"><h4>Selecione uma foto para fazer o upload</h4></label>
                                            <br> <br>
                                            <input type="file" name="arquivo[]" id="arquivoId" style="padding-left: 280px;" multiple>
                                        </div>
                                        <br>
                                        <input type="submit" class="btn btn-default" value="Upload" name="submit">                
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                      </nav>
                    </div> 
                    </div>  
                    </div>             



        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


    <!-- jQuery -->
    

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Crie um novo grupo</h4>
        </div>

        <div class="modal-body">
          <div class="form-group">
              <div class="col-lg-12">
                <p>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-user"></i></div>
                      <form action="criar.php" method="post">
                      <input type="text" class="form-control" id="nomeGrupo" placeholder="Nome do Grupo" size="60">
                    </div>
                </p>
                </div>

            </div>
            
        </div>    

        <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Criar</button>
              </form>
        </div>
    </div>
      
    </div>
</div>

<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });
});
</script>

</body>

</html>


          
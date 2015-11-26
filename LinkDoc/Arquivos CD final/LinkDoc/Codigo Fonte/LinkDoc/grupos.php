<?php
session_start();
//Valida se usuario esta logado
if ($_SESSION['Id'] == null && $_SESSION['Nome'] == null) {
    header("Location: index.php");
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

    </head>

    <body>

        <?php
        $host = "localhost";
        $port = 3306;
        $socket = "";
        $user = "root";
        $password = "";
        $dbname = "mydb";

        $aux = array();
        $i = 0;
        $x = 0;
        $y = 0;
        $t = 0;
        $q = 0;
        $idPes = $_SESSION['Id'];
        $idGrup = $_GET['action'];

        $con = mysqli_connect($host, $user, $password, $dbname)
                or die('Could not connect to the database server' . mysqli_connect_error());
        $sql = "SELECT comentario, pessoa_id_pessoa FROM comentario where '$idGrup'=grupo_id_grupo";
        if ($resultado = mysqli_query($con, $sql)) {
            while ($row = mysqli_fetch_object($resultado)) {
                $tes = $row->comentario;
                $tes2 = $row->pessoa_id_pessoa;

                $aux[$i] = $tes;
                $auxId[$i] = $tes2;


                $i = $i + 1;
            }
        }
        mysqli_close($con);



        $con = mysqli_connect($host, $user, $password, $dbname)
                or die('Could not connect to the database server' . mysqli_connect_error());
        for ($t = 0; $t < $i; $t++) {
            $sql = "SELECT nome_pessoa, sobrenome_pessoa, caminho_imagem FROM pessoa where '$auxId[$t]'=id_pessoa";
            if ($resultado = mysqli_query($con, $sql)) {
                while ($row = mysqli_fetch_object($resultado)) {
                    $tes = $row->nome_pessoa;
                    $tes2 = $row->sobrenome_pessoa;
                    $tes3 = $row->caminho_imagem;

                    $auxNome[$q] = $tes;
                    $auxSobrenome[$q] = $tes2;
                    $auxImagem[$q] = $tes3;


                    $q = $q + 1;
                }
            }
        }
        mysqli_close($con);


        $con = mysqli_connect($host, $user, $password, $dbname)
                or die('Could not connect to the database server' . mysqli_connect_error());
        $sql = "SELECT nome_grupo, id_grupo FROM grupo where pessoa_id_pessoa = '$idPes'";
        if ($resultado = mysqli_query($con, $sql)) {
            while ($row = mysqli_fetch_object($resultado)) {
                $tes = $row->nome_grupo;
                $tes2 = $row->id_grupo;

                $nomes[$x] = $tes;
                $ids[$x] = $tes2;

                $x = $x + 1;
            }
        }
        mysqli_close($con);


        $con = mysqli_connect($host, $user, $password, $dbname)
                or die('Could not connect to the database server' . mysqli_connect_error());

        $sql = "SELECT nome_pessoa, sobrenome_pessoa, id_pessoa, cidade, estado, caminho_imagem FROM mydb.pessoa";
        if ($resultado = mysqli_query($con, $sql)) {
            while ($row = mysqli_fetch_object($resultado)) {
                $tes = $row->nome_pessoa;
                $tes2 = $row->id_pessoa;
                $tes3 = $row->cidade;
                $tes4 = $row->sobrenome_pessoa;
                $tes5 = $row->estado;
                $tes6 = $row->caminho_imagem;

                $nomep[$y] = $tes;
                $idp[$y] = $tes2;
                $cidades[$y] = $tes3;
                $sobrenomes[$y] = $tes4;
                $estados[$y] = $tes5;
                $caminhodaImagem[$y] = $tes6;

                $y = $y + 1;
            }
        }
        mysqli_close($con);

        $con = mysqli_connect($host, $user, $password, $dbname)
                or die('Could not connect to the database server' . mysqli_connect_error());
        $sql = "SELECT nome_grupo FROM mydb.grupo where id_grupo = '$idGrup'";
        if ($resultado = mysqli_query($con, $sql)) {
            while ($row = mysqli_fetch_object($resultado)) {
                $tes = $row->nome_grupo;

                $nomedoGrupoAtual = $tes;
                $_SESSION["idGrupo"] = $idGrup;
            }
        }
        mysqli_close($con);

//Verifica se a corrida está boa
        
           $con = mysqli_connect($host, $user, $password, $dbname)
                or die('Could not connect to the database server' . mysqli_connect_error());
          $sql = "SELECT dados_id_dados FROM mydb.pessoa_has_dados where pessoa_id_pessoa = '$idPes'";
          if ($resultado = mysqli_query($con, $sql)) {
            while ($row = mysqli_fetch_object($resultado)) {
                $idDados = $row->dados_id_dados;
            }
          }
          mysqli_close($con);
          /*

           $con = mysqli_connect($host, $user, $password, $dbname)
                or die('Could not connect to the database server' . mysqli_connect_error());
          $sql = "SELECT metros_percorridos FROM mydb.dados where id_dados = '$idDados'";
          if ($resultado = mysqli_query($con, $sql)) {
            while ($row = mysqli_fetch_object($resultado)) {
                $Metros = $row->metros_percorridos;
            }
          }

          mysqli_close($con);

          if($Metros < 15){

                //header("Location: abandonar.php?action=".$idGrup."&idPes=".$idPes);

          } */
        ?>
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
                            <!-- <?php for ($z = 0; $z < 1; $z++) { ?>
                                     
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
                                             <p><?php echo $_SESSION['Nome']; ?> vocÃª estÃ¡ participando do grupo <?php echo $nomes[$z]; ?>.</p>
     
                                         </div>
                                     </div>
                                 </a>
                             </li>
     
                             
                             
                             <li class="message-footer">
                                 <a href="grupos.php?action=<?php echo $ids[$z]; ?>"> Leia mais mensagens</a>
                             </li>
     
<?php } ?> -->
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
                                    <a href="grupos.php?action=<?php echo $ids[$z]; ?>"><i class="fa fa-fw fa-envelope"></i> Mensagens</a>
                                </li>
<?php } ?>
                            <li class="divider"></li>
                            <li>
                                <a href="Controler_Login.php?action=sair"><i class="fa fa-fw fa-power-off"></i> Sair</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">


                        <img class="img-gran img-circle"  src="imagens\<?php echo $_SESSION['Imagem']; ?>"></img>
                             <div class="name" style="text-align:center;">
                             <a href="perfil.php"> <?php echo $_SESSION['Nome']; ?></a>
                </div>

                <hr>
                <li style="margin-top:15px;">
                    <a href="feed.php" style="color: black;"><i class="fa fa-fw fa-dashboard"></i> Feed</a>
                </li>
                <li>
                    <a href="graficos.php" style="color: black;"><i class="fa fa-fw fa-bar-chart-o"></i> Gráficos</a>
                </li>
                <li>
                    <a href="areaInformativa.php" style="color: black;"><i class="fa fa-fw fa-table"></i> Área Informativa</a>
                </li>

                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo" style="color: black;"><i class="fa fa-fw fa-arrows-v"></i> Grupos <i class="fa fa-fw fa-caret-down"></i></a>
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

    <div id="page-wrapper" style="height: 593px;">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Grupos <small>Comunique-se com os amigos</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="feed.php">Feed</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-comment-o"></i> Grupos
                        </li>
                    </ol>
                </div>
            </div>

            <!-- /.row -->

            <hr>
            <h4> <a href="#" id="myBtn2"> <i class="fa fa-users"></i> Adicionar participante</a></h4>

            <div id="nomedogrupo"> <br>
                <h3 class="page-header"style="text-align: right; padding-bottom:20px; margin-top:-50px;">
<?php echo $nomedoGrupoAtual;
?> <br>

                </h3>

                <div class="row" style="margin-left:80px;">
                    <div class="col-lg-10 col-md-6">
                        <ul class="media-list media-list-conversation c-w-md">

<?php for ($j = 0; $j < $i; $j++) { ?>

                                <li class="media m-b-md">
                                    <a class="media-left" href="#">
                                        <img class="img-circle media-object" src="imagens\<?php echo $auxImagem[$j]; ?>">
                                             </a>
                                             <div class="media-body">
                                             <div class="media-body-text">
    <?php echo $aux[$j]; ?>
                                            </br>
                                        </div>
                                        <div class="media-footer">
                                            <small class="text-muted">
                                                <a href="#"><?php echo $auxNome[$j] . " " . $auxSobrenome[$j]; ?></a> 
                                            </small>
                                        </div>
                                        </div>
                                </li>
<?php } ?>



                            <div class="col-lg-10" style="margin-bottom:50px;">
                                <hr>
                                <form action="comentar.php?action=<?php echo $idGrup ?>&idPes=<?php echo $idPes ?>" method="post">
                                    <input type="text" name="texto" class="form-control" placeholder="Messagem..." size="" style="margin-bottom:50px;">
                                    </div>
                                    <div class="col-lg-2" style="padding-top:48px; padding-bottom:50px;">
                                        <button class="btn" name="salvar"> Enviar</button>
                                </form>
                            </div>

                    </div>
                    <form action="abandonar.php?action=<?php echo $idGrup ?>&idPes=<?php echo $idPes ?>" method="post">
                        <h4> <input name="abandonar" type="submit" class="btn btn-ad" value="Abandonar Grupo" style="position:relative; right:180px;"></h4>
                    </form>
                </div>
                <!-- /.row -->



            </div>
            <!-- /.container-fluid -->

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
                                <form action="criar.php?action=<?php echo $idGrup; ?>&idPes=<?php echo $idPes; ?>" method="POST">
                                    <input type="text" name="nomeGrup" class="form-control" id="nomeGrupo" placeholder="Nome do Grupo" size="60">

                                    </div>
                                    </p>
                                    </div>


                            </div>

                        </div>    

                        <div class="modal-footer">
                            <input type="submit" name="criar" value="Criar" class="btn btn-primary btn-xl">
                            </form>
                        </div>
                    </div>

                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="myModal2" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Crie um novo grupo</h4>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <h4>Adicione participantes</h4>

                                <div class="checkbox custom-control custom-checkbox"
                                     <div class="col-lg-12">
                                        <div class="input-group">
                                            <ul class="media-list media-list-users list-group">

<?php for ($b = 0; $b < $y; $b++) { ?>
                                                    <li class="list-group-item">
                                                        <div class="media">
                                                            <a class="media-left" href="#">
                                                                <img class="media-object img-circle" src="imagens\<?php echo $caminhodaImagem[$b]; ?>" alt="">
                                                            </a>
                                                            <div class="media-body">
                                                                <form action="adicionar.php?action=<?php echo $idGrup ?>&idPes=<?php echo $idp[$b] ?>" method="post">
                                                                   <strong><?php echo $nomep[$b] . " " . $sobrenomes[$b]; ?></strong> <br>
                                                                    <small><?php echo $cidades[$b] . "-" . $estados[$b]; ?></small> 
                                                                    <b style="padding-left:220px;">

                                                                        <input type="submit" name="Adicionar" value="Adicionar" class="btn btn-primary btn-xl">
                                                                        </form>

                                                                        <span class="custom-control-indicator"></span></b>
                                                            </div>
                                                        </div>
                                                    </li>
<?php } ?>
                                            </ul>
                                        </div>
                                    </div>

                                </div>

                            </div>    

                            <div class="modal-footer">

                                </form>
                            </div>
                        </div>

                    </div>
                </div>



                <script>
                    $(document).ready(function() {
                        $("#myBtn").click(function() {
                            $("#myModal").modal();
                        });
                    });

                    $(document).ready(function() {
                        $("#myBtn2").click(function() {
                            $("#myModal2").modal();
                        });
                    });
                </script>

                </body>

                </html>

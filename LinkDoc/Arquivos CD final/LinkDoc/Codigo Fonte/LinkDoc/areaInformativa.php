<?php
session_start();

//Valida se usuario esta logado
if ($_SESSION['Id'] == null && $_SESSION['Nome'] == null) {
    header("Location: index.php");
} else {

    //nÃ£o mostra erros
    error_reporting(0);
    ini_set("display_errors", 0);

    $host = "localhost";
    $port = 3306;
    $socket = "";
    $user = "root";
    $password = "";
    $dbname = "mydb";

    $x = 0;
    $idPes = $_SESSION['Id'];

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
    for ($x = 0; $x <= count($vet); $x++) {
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
                        

<?php
$con = mysqli_connect($host, $user, $password, $dbname)
        or die('Could not connect to the database server' . mysqli_connect_error());
$sql = "SELECT grupo_id_grupo FROM mydb.pessoa_has_grupo where pessoa_id_pessoa = '$idPes'";
if ($resultado = mysqli_query($con, $sql)) {
    while ($row = mysqli_fetch_object($resultado)) {
        $ExisteGrupos = $row->grupo_id_grupo;
    }
}

if ($ExisteGrupos > 0) {

    for ($z = 0; $z < 1; $z++) {
        ?>

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

                                </ul>
                            </li>
    <?php }
} else {
    ?>

                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="img-circle" src="imagens\<?php echo $_SESSION['Imagem']; ?>" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong> <?php echo $nomes[$z]; ?></strong>
                                        </h5>

                                        <p class="small text-muted"><i class="fa fa-user"></i> <?php echo $_SESSION['Nome']; ?></p>
                                        <p><?php echo $_SESSION['Nome']; ?> você ainda não está participando de nenhum grupo.</p>

                                    </div>
                                </div>
                            </a>
                        </li>  

                    </ul>
                    </li>

                <?php } mysqli_close($con); ?>
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
                                <?php if ($ids[$z] == '') { ?>
                                        <a href="#"><i class="fa fa-fw fa-envelope"></i> Mensagens</a>
                                    <?php } else { ?>
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
                <ul class="nav navbar-nav side-nav" >


                    <img class="img-circle"  src="imagens\<?php echo $_SESSION['Imagem']; ?>"></img>
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
    </li>

</ul>
</div>
<!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Área Informativa <small>Saiba mais sobre as Áreas médicas</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Feed
                    </li>
                    <li class="active">
                        <i class="fa fa-book"></i> Wiki
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <?php
            $con = mysqli_connect($host, $user, $password, $dbname)
                        or die('Could not connect to the database server' . mysqli_connect_error());
                $sql = "SELECT titulo, id_area_informativa FROM mydb.area_informativa";
                if ($resultado = mysqli_query($con, $sql)) {
                    while ($row = mysqli_fetch_object($resultado)) {
                        $Titulo[] = $row->titulo;
                        $idAI[] = $row->id_area_informativa;
                    }
                }

                if($Titulo != null){ 
                    for ($i=1; $i < count($Titulo); $i++) {                        
                    
                    ?>

                     <div class="col-lg-4 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-5">
                            <i class="fa fa-user-md fa-5x"></i>
                        </div>
                        <div class="col-xs-12 text-right">
                            <div class="huge"><?php echo $Titulo[$i]; ?></div>
                            <div>Lista médica</div>
                        </div>
                    </div>
                </div>
                <a href="conteudo.php?action=<?php echo $idAI[$i]; ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Ver detalhes</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
<?php
               } } ?>      


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

                    <script>
                        $(document).ready(function() {
                            $("#myBtn").click(function() {
                                $("#myModal").modal();
                            });
                        });
                    </script>

                    </body>

                    </html>

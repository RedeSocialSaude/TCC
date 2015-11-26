<?php
session_start();

//Valida se usuario esta logado
if ($_SESSION['Id'] == null && $_SESSION['Nome'] == null) {
    header("Location: index.php");
}

//nÃ£o mostra erros
error_reporting(0);
ini_set("display_errors", 0);

function RetornaNome($id_pessoa) {
    $host = "localhost";
    $port = 3306;
    $socket = "";
    $user = "root";
    $password = "";
    $dbname = "mydb";

    $con = mysqli_connect($host, $user, $password, $dbname)
            or die('Could not connect to the database server' . mysqli_connect_error());
    $sql = "SELECT nome_pessoa, sobrenome_pessoa FROM mydb.pessoa where id_pessoa = '$id_pessoa'";
    if ($resultado = mysqli_query($con, $sql)) {
        while ($row = mysqli_fetch_object($resultado)) {
            $aux = $row->nome_pessoa;
            $nome = $aux . " " . $row->sobrenome_pessoa;
        }
    }

    mysqli_close($con);

    return $nome;
}

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
$idPes = $_SESSION['Id'];
$id = $_SESSION['Id'];

$con = mysqli_connect($host, $user, $password, $dbname)
        or die('Could not connect to the database server' . mysqli_connect_error());
$sql = "SELECT nome_pessoa, sobrenome_pessoa, caminho_imagem, cidade FROM mydb.pessoa where id_pessoa = '$id'";
if ($resultado = mysqli_query($con, $sql)) {
    while ($row = mysqli_fetch_object($resultado)) {
        $aux = $row->nome_pessoa;
        $nome = $aux . " " . $row->sobrenome_pessoa;
        $_SESSION['Nome'] = $nome;
        $_SESSION['Imagem'] = $row->caminho_imagem;
        $_SESSION['Cidade'] = $row->cidade;
    }
}

mysqli_close($con);

$con = mysqli_connect($host, $user, $password, $dbname)
        or die('Could not connect to the database server' . mysqli_connect_error());
$sql = "SELECT comentario FROM comentario";
if ($resultado = mysqli_query($con, $sql)) {
    while ($row = mysqli_fetch_object($resultado)) {
        $tes = $row->comentario;

        $aux[$i] = $tes;


        $i = $i + 1;
    }
}
mysqli_close($con);

//Mostra os nomes dos grupos na lateral
$con = mysqli_connect($host, $user, $password, $dbname) or die('Could not connect to the database server' . mysqli_connect_error());
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

$con = mysqli_connect($host, $user, $password, $dbname)
        or die('Could not connect to the database server' . mysqli_connect_error());

$sql = "SELECT nome_pessoa, sobrenome_pessoa, id_pessoa, cidade, estado FROM pessoa";
if ($resultado = mysqli_query($con, $sql)) {
    while ($row = mysqli_fetch_object($resultado)) {
        $tes = $row->nome_pessoa;
        $tes2 = $row->id_pessoa;
        $tes3 = $row->cidade;
        $tes4 = $row->sobrenome_pessoa;
        $tes5 = $row->estado;

        $nomep[$y] = $tes;
        $idp[$y] = $tes2;
        $cidades[$y] = $tes3;
        $sobrenomes[$y] = $tes4;
        $estados[$y] = $tes5;

        $y = $y + 1;
    }
}
mysqli_close($con);


$glicose = array();
$data = array();
$cor = array();
$colesterol = array();
$imc = array();
$pressao = array();
$metros_percorridos = array();
$temp_percorridos = array();
$arrayaux = array();
$arrayaux2 = array();
$i = 0;
$cor[0] = "green";
$cor[1] = "silver";
$cor[2] = "gold";
$cor[3] = "blue";

    

$con = mysqli_connect($host, $user, $password, $dbname) or die('Could not connect to the database server' . mysqli_connect_error());
$sql = "SELECT dados_id_dados FROM pessoa_has_dados where pessoa_id_pessoa = '$idPes'";
if ($resultado = mysqli_query($con, $sql)) {
    while ($row = mysqli_fetch_object($resultado)) {
        
        $vet2[] = $row->dados_id_dados;
    }
}
mysqli_close($con);

    //header("Location: feed.php?action=");
    //if(count($vet) >= 1){
    $con = mysqli_connect($host, $user, $password, $dbname)
        or die('Could not connect to the database server' . mysqli_connect_error());
    for ($x2 = 0; $x2 <= count($vet2); $x2++) {
        //Seleciona dados    
        $sql = "SELECT * FROM dados where id_dados = '$vet2[$x2]'";
        if ($resultado = mysqli_query($con, $sql)) {
            while ($row = mysqli_fetch_object($resultado)) {

                $pes = $row->peso;
                $alt = $row->altura;
                $tot = $pes / ($alt * $alt);
                $glic = $row->glicose;
                $col = $row->colesterol;
                $pres = $row->pressao;
                $met = $row->metros_percorridos;
                $tem = $row->temp_percor_min;

                $date = $row->data_insercao;

                $imc[$i] = number_format($tot, 2);
                $data[$i] = $date;
                $glicose[$i] = $glic;
                $colesterol[$i] = $col;
                $pressao[$i] = $pres;
                $metros_percorridos[$i] = $met;
                $temp_percorridos[$i] = $tem;

                $i = $i + 1;
            }
        } else {
            echo "Erro no query";
        }
    }

    mysqli_close($con);
    //}
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

    <!-- GrÃ¡ficos -->

    <!-- Grafico de pressao -->
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load("visualization", "1", {packages: ["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["Data", "Pressao", {role: "style"}],
<?php
if (isset($_POST["quinze"])) {
    $k = 15;
} else {
    if (isset($_POST["trinta"])) {
        $k = 30;
    } else {
        $k = $i;
    }
}
for ($i = 0; $i < $k; $i++) {
    ?>
                    ['<?php echo $data[$i] ?>', <?php echo $pressao[$i] ?>, '<?php echo $cor[$i] ?>'],
<?php } ?>
            ]);

            var options = {
                title: "",
                width: 790,
                height: 300,
                //pieHole: 0.4,
                //is3D : true,
            };
            var chart = new google.visualization.AreaChart(document.getElementById("areachart_values"));
            chart.draw(data, options);
        }
    </script>

    <!-- Glicose -->
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
            google.load("visualization", "1", {packages: ['corechart']});
            google.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ["Data", "Glicose", {role: "style"}],
<?php
if (isset($_POST["quinze"])) {
    $k = 15;
} else {
    if (isset($_POST["trinta"])) {
        $k = 30;
    } else {
        $k = $i;
    }
}
for ($i = 0; $i < $k; $i++) {
    ?>
                        ["<?php echo $data[$i] ?>", <?php echo $glicose[$i] ?>, '<?php echo $cor[$i] ?>'],
<?php } ?>
                ]);

                var view = new google.visualization.DataView(data);
                view.setColumns([0, 1,
                    {calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation"},
                    2]);

                var options = {
                    title: "",
                    width: 535,
                    height: 400,
                    //is3D: true,
                    bar: {groupWidth: "75%"},
                    legend: {position: "none"},
                };
                var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                chart.draw(view, options);
            }
    </script>

    <!-- Colesterol -->
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
            google.load("visualization", "1", {packages: ["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ["Data", "Colesterol"],
<?php
if (isset($_POST["quinze"])) {
    $k = 15;
} else {
    if (isset($_POST["trinta"])) {
        $k = 30;
    } else {
        $k = $i;
    }
}
for ($i = 0; $i < $k; $i++) {
    ?>
                        ['<?php echo $data[$i] ?>', <?php echo $colesterol[$i] ?>],
<?php } ?>
                ]);

                var options = {
                    title: "",
                    width: 850,
                    height: 400,
                    pieHole: 0.4,
                    is3D: true,
                };
                var chart = new google.visualization.PieChart(document.getElementById("piechart_values"));
                chart.draw(data, options);
            }
    </script>

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
                         <a href="perfil.php"><?php echo $_SESSION['Nome']; ?></a>
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

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Feed <small>Veja o que está acontecendo agora</small>
                </h1>

                <?php
                $con = mysqli_connect($host, $user, $password, $dbname)
                        or die('Could not connect to the database server' . mysqli_connect_error());
                $sql = "SELECT area_informativa_id_area_informativa FROM mydb.profissional_saude where pessoa_id_pessoa = '$idPes';";
                if ($resultado = mysqli_query($con, $sql)) {
                    while ($row = mysqli_fetch_object($resultado)) {
                        $id_AI = $row->area_informativa_id_area_informativa;
                    }
                }

                if ($id_AI == 5) {
                    ?>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-info alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="fa fa-info-circle"></i>  <strong><?php echo $_SESSION['Nome']; ?></strong> você possui algumas pendências no seu <a href="perfil.php" class="alert-link">perfil</a>!
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                <?php } ?>

                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Feed
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->



        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-pencil-square-o fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"></div>
                                <div>Novos Dados!</div>
                            </div>
                        </div>
                    </div>
                    <a href="#" id="myBtn2">
                        <div class="panel-footer">
                            <span class="pull-left">Adicionar</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"></div>
                                <div>Novas Mensagens!</div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($ExisteGrupos > 0) { ?>

                    <?php for ($z = 0; $z < 1; $z++) { 
                        
                        ?>
                        <a href="grupos.php?action=<?php echo $ids[$z]; ?>">
              <?php }  
                        } else {
                            ?>
                            <a href="feed.php">
                            <?php } ?>
                        <div class="panel-footer">
                            <span class="pull-left">Ver detalhes</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right "></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a> 
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-line-chart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"></div>
                                <div>Novos gráficos!</div>
                            </div>
                        </div>
                    </div>
                    <a href="graficos.php">
                        <div class="panel-footer">
                            <span class="pull-left">Ver detalhes</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
        <!-- /.row -->

        <!-- GrÃ¡ficos -->
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Pressão</h3>
                    </div>
                    <div class="panel-body">
                        <div id="areachart_values" style="width: 900px; height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- Glicose -->
        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> Glicose</h3>
                    </div>
                    <div class="panel-body">
                        <div id="columnchart_values"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Últimos comentários</h3>
                    </div>
                    <div class="panel-body">
                        <div class="list-group">
                        
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
                                    $auxId = $ids[$z];
                                    ?>
                                    <li>
                                        <a href="grupos.php?action=<?php echo $ids[$z]; ?>"><i class="fa fa-fw fa-comment"></i> <?php echo $nomes[$z]; ?> </a>
                                    </li>
                                <?php
                                }
                                $con = mysqli_connect($host, $user, $password, $dbname)
                                        or die('Could not connect to the database server' . mysqli_connect_error());

                                $sql = "SELECT comentario, pessoa_id_pessoa FROM comentario where grupo_id_grupo = '$auxId'";
                                if ($resultado = mysqli_query($con, $sql)) {
                                    while ($row = mysqli_fetch_object($resultado)) {

                                        //$idP = $row->pessoa_id_pessoa;
                                        $comentario[] = $row->comentario;
                                        $pessoa[] = $row->pessoa_id_pessoa;
                                    }
                                }
                                mysqli_close($con);
                                ?>                                          
                                <?php
                                for ($w = (count($comentario) - 4); $w < count($comentario); $w++) {
                                    if($comentario[$w] == null){
                                        ?> 

                                        <?php
                                    }else{
                                    ?>
                                    <li class="media m-b-md">
                                        <div class="list-group-item">
                                            <div>
        <?php echo $comentario[$w]; ?>


                                                </br>
                                                <span class="help-block"><?php echo RetornaNome($pessoa[$w]); ?></span>
                                            </div>
                                        </div>
                                    </li>
        <?php }
    }
} else {
    ?>

                                <li>
                                    <a href="#"><i class="fa fa-fw fa-comment"></i> <?php echo "Você ainda não está participando de nenhum grupo."; ?> </a>
                                </li>

    <?php
}

mysqli_close($con);
?>

                        </div>
                        <div class="text-right"> <!--
                            <a href="grupos.php?action=<?php echo $ids[$z]; ?>">Continue lendo <i class="fa fa-arrow-circle-right"></i></a> -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- GrÃ¡ficos -->
            <div class="row">
                <div class="col-lg-12 col-md-6" >
                    <div class="panel panel-default" style="height: 470px;">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Colesterol</h3>
                        </div>
                        <div class="panel-body">
                            <div id="piechart_values" style="width: 450px; height: 400px; align=center; "></div>
                        </div>
                    </div>
                </div>
            </div>

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

                <form action="criar.php?action=<?php echo $idPes; ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-lg-12">
                            
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    
                                        <input type="text" name="nomeGrup" class="form-control" id="nomeGrupo" placeholder="Nome do Grupo" size="60">

                                </div>
                                    
                            </div>
                        </div>

                    </div>    

                    <div class="modal-footer">
                        <input type="submit" name="criar" value="Criar" class="btn btn-primary btn-xl">
                            
                    </div>
                </div>
                </form>
                
            </div>
                
            </div>

            <div class="modal fade" id="myModal2" role="dialog">
                <div class="modal-dialog modal-lg">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <center><h4 class="modal-title">Insira seus dados</h4></center>
                                    </div>

                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="col-lg-6">
                                                <p>
                                                <form action="Controler_Dados.php?action=EntradaDados" method="POST">
                                                    <div class="input-group">
                                                        <div class="input-group-addon"><i class="fa fa-cutlery"></i></div>
                                                        <input type="text" class="form-control" name="peso" id="peso" placeholder="Peso" size="60" required>
                                                    </div>
                                                    </p>
                                            </div>


                                            <div class="col-lg-6">
                                                <p>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-arrows-v"></i></div>
                                                    <input type="text" class="form-control" name="altura" id="altura" placeholder="Altura" size="60" required>
                                                </div>
                                                </p>
                                            </div>

                                            <div class="col-lg-6">
                                                <p>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-line-chart"></i></div>
                                                    <input type="text" class="form-control" name="colesterol" id="colesterol" placeholder="Taxa de colesterol" size="60" required>
                                                </div>
                                                </p>
                                            </div>


                                            <div class="col-lg-6">
                                                <p>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-cutlery"></i></div>
                                                    <input type="text" class="form-control" name="glicose" id="glicose" placeholder="Taxa de glicose" size="60" required>
                                                </div>
                                                </p>
                                            </div>

                                            <div class="col-lg-6">
                                                <p>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-line-chart"></i></div>
                                                    <input type="text" class="form-control" name="pressao" id="pressao" placeholder="PressÃ£o" size="60" required>
                                                </div>
                                                </p>
                                            </div>


                                            <div class="col-lg-6">
                                                <p>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-bicycle"></i></div>
                                                    <input type="text" class="form-control" name="MPercorrido" id="MPercorrido" placeholder="Metros percorridos" size="60" required>
                                                </div>
                                                </p>
                                            </div>

                                            <div class="col-lg-6">
                                                <p>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                                    <input type="text" class="form-control" name="TPercurso" id="TPercurso" placeholder="Tempo do percurso" size="60" required>
                                                </div>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-default" name="enviarDados" value="Enviar">
                                        </div>
                                    </div>
                                    </form>   
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

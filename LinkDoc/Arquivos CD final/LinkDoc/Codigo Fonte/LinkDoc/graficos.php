<?php
session_start();

//Valida se usuario esta logado
if ($_SESSION['Id'] == null && $_SESSION['Nome'] == null) {
    header("Location: index.php");
}

//nÃ£o mostra erros
error_reporting(0);
ini_set("display_errors", 0);

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


if (isset($_POST["combinar"])) {
    $r1 = $_POST["g1"];
    $r2 = $_POST["g2"];
    $sql = "SELECT $r1, $r2,data_insercao FROM dados";
    if ($resultado = mysqli_query($con, $sql)) {
        while ($row = mysqli_fetch_object($resultado)) {
            $tes = $row->$r1;
            $tes2 = $row->$r2;
            $date = $row->data_insercao;

            $arrayaux[$i] = $tes;
            $arrayaux2[$i] = $tes2;
            $data[$i] = $date;

            $i = $i + 1;
        }
    } else
        echo "Erro no query";
}else {

    //Pega id_dados
    $id = $_SESSION['Id'];

    $host = "localhost";
    $port = 3306;
    $socket = "";
    $user = "root";
    $password = "";
    $dbname = "mydb";

    $con2 = mysqli_connect($host, $user, $password, $dbname)
            or die('Could not connect to the database server' . mysqli_connect_error());
    $sql2 = "SELECT dados_id_dados FROM mydb.pessoa_has_dados where pessoa_id_pessoa = '$id'";
    if ($resultado2 = mysqli_query($con2, $sql2)) {
        while ($row = mysqli_fetch_object($resultado2)) {
            $id_dados = $row->dados_id_dados;
            $vet2[] = $id_dados;
        }
    }

    //header("Location: teste.php");
    //if(count($vet) >= 1){
    for ($x = 0; $x <= count($vet2); $x++) {
        //Seleciona dados    
        $sql = "SELECT * FROM dados where id_dados = '$vet2[$x]'";
        if ($resultado = mysqli_query($con, $sql)) {
            while ($row = mysqli_fetch_object($resultado)) {

                $pes = $row->peso;
                $alt = $row->altura;
                $tot = $pes / ($alt * $alt);
                $glic = $row->glicose;
                $col = $row->colesterol;
                $pres = $row->pressao;
                $met = $row->metros_percorridos;
                $tem = $row->temp_percorrido_min;

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
        } else
            echo "Erro no query";
    }
    //}
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

    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
                google.load("visualization", "1", {packages:['corechart']});
                google.setOnLoadCallback(drawChart);
                function drawChart() {
                var data = google.visualization.arrayToDataTable([
                        ["Data", "Imc", { role: "style" } ],
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
                    ["<?php echo $data[$i] ?>", <?php echo $imc[$i] ?>, '<?php echo $cor[$i] ?>'],
<?php } ?>
                ]);
                        var view = new google.visualization.DataView(data);
                        view.setColumns([0, 1,
                        { calc: "stringify",
                                sourceColumn: 1,
                                type: "string",
                                role: "annotation" },
                                2]);
                        var options = {
                        title: "",
                                width: 750,
                                height: 500,
                                is3D: true,
                                bar: {groupWidth: "65%"},
                                legend: { position: "none" },
                        };
                        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values2"));
                        chart.draw(view, options);
                }
    </script>

    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
                google.load("visualization", "1", {packages:['corechart']});
                google.setOnLoadCallback(drawChart);
                function drawChart() {
                var data = google.visualization.arrayToDataTable([
                        ["Data", "Glicose", { role: "style" } ],
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
                        { calc: "stringify",
                                sourceColumn: 1,
                                type: "string",
                                role: "annotation" },
                                2]);
                        var options = {
                        title: "",
                                width: 700,
                                height: 500,
                                //is3D: true,
                                bar: {groupWidth: "75%"},
                                legend: { position: "none" },
                        };
                        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                        chart.draw(view, options);
                }
    </script>

    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
                google.load("visualization", "1", {packages:["corechart"]});
                google.setOnLoadCallback(drawChart);
                function drawChart() {
                var data = google.visualization.arrayToDataTable([
                        ["Data", "Pressao", { role: "style" } ],
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
                                width: 800,
                                height: 500,
                                //pieHole: 0.4,
                                //is3D : true,
                        };
                        var chart = new google.visualization.AreaChart(document.getElementById("areachart_values"));
                        chart.draw(data, options);
                }
    </script>

    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
                google.load("visualization", "1", {packages:["corechart"]});
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
                                width: 800,
                                height: 500,
                                pieHole: 0.4,
                                is3D : true,
                        };
                        var chart = new google.visualization.PieChart(document.getElementById("piechart_values"));
                        chart.draw(data, options);
                }
    </script>

    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
                google.load("visualization", "1", {packages:["corechart"]});
                google.setOnLoadCallback(drawChart);
                function drawChart() {
                var data = google.visualization.arrayToDataTable([
                        ["Data", "Metros", "Tempo"],
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
                    ['<?php echo $data[$i] ?>', <?php echo $metros_percorridos[$i] ?>, <?php echo $temp_percorridos[$i] ?>],
<?php } ?>
                ]);
                        var options = {
                        title: "",
                                width: 800,
                                height: 500,
                                vAxis : {title : "Metros/Tempo"},
                                isStacked : true,
                        };
                        var chart = new google.visualization.SteppedAreaChart(document.getElementById("steppedareachart_values"));
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
    </div>
    <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Gráficos <small>Acompanhe seus dados</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Feed
                    </li>
                    <li class="active">
                        <i class="fa fa-bar-chart-o"></i> Gráficos
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <h4 style="color: black;"> <a href="#" id="myBtn2">Opções de gráficos</a></h4>

<?php
if (isset($_POST["combinar"])) {
    ?>
            <script type="text/javascript"
                    src="https://www.google.com/jsapi?autoload={
                    'modules':[{
                    'name':'visualization',
                    'version':'1',
                    'packages':['corechart']
                    }]
            }"></script>

            <script type="text/javascript">
                    google.setOnLoadCallback(drawChart);
                    function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                            ['Data', '<?php echo $r1 ?>', '<?php echo $r2 ?>'],
    <?php
    $k = $i;
    for ($i = 0; $i < $k; $i++) {
        ?>
                        ['<?php echo $data[$i] ?>', <?php echo $arrayaux[$i] ?>, <?php echo $arrayaux2[$i] ?>],
    <?php } ?>
                    ]);
                            var options = {
                            title: '',
                                    curveType: 'function',
                                    legend: { position: 'bottom' }
                            };
                            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
                            chart.draw(data, options);
                    }
            </script>


            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> <?php echo  $r1 . " e " . $r2; ?></h3>
                        </div>
                        <div class="panel-body">
                            <div id="curve_chart" style="height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
<?php } else { ?>

            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Gráfico de IMC</h3>
                        </div>
                        <div class="panel-body">
                            <div id="columnchart_values2"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Gráfico de Pressão</h3>
                        </div>
                        <div class="panel-body">
                            <div id="areachart_values"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Taxa de Glicose</h3>
                        </div>
                        <div class="panel-body">
                            <div id="columnchart_values"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Taxa de Colesterol</h3>
                        </div>
                        <div class="panel-body">
                            <div id="piechart_values"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Relação entre Metros percorridos e Tempo</h3>
                        </div>
                        <div class="panel-body">
                            <div id="steppedareachart_values"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

<?php } ?>

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
                <h4 class="modal-title">Opções dos Gráficos</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <form action="graficos.php" method="post">

                        <p style="padding-left:25px;">
                            <input type="checkbox" name="trinta">
                            <label style="position:relative; left:10px;"> Mostrar gráficos do último mês</label>                    
                        </p>

                        <p style="padding-left:25px;">
                            <input type="checkbox" name="quinze">
                            <label style="position:relative; left:10px;"> Mostrar gráficos da última quinzena</label>                    
                        </p>

                        <p style="padding-left:25px;">
                            <input type="checkbox" name="combinar">
                            <label style="position:relative; left:10px;"> Combinar Gráficos:</label>  
                            <input type="text" name="g1" id="chart1" placeholder="Ex: glicose" style="position:relative; left:20px;"> 
                            <input type="text" name="g2" id="chart2" placeholder="Ex: colesterol" style="position:relative; left:25px;">
                            <br>
                            <span class="help-block" style="position:relative; left:25px;">Somente os gráficos de glicose, colesterol e pressão podem ser combinados.</span>

                            </div>
                            </div>

                        <div class="modal-footer">
                            <input type="submit" class="btn" value="Enviar" name="enviar">
                        </div>
                </div>
                </form>
            </div>
        </div>




        <script>
                    $(document).ready(function(){
            $("#myBtn").click(function(){
            $("#myModal").modal();
            });
                    });
                    $(document).ready(function(){
            $("#myBtn2").click(function(){
            $("#myModal2").modal();
            });
                    });
        </script>

        </body>

        </html>

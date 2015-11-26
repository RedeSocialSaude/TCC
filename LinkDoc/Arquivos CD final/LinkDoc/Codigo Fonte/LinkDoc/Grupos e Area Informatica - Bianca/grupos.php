
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
   
    <?php
     $host="localhost";
        $port=3306;
        $socket="";
        $user="root";
        $password="";
        $dbname="mydb";
        
        $aux = array();
        $i = 0;
        $x = 0;
        $y = 0;
        $t = 0;
        $q = 0;
        $idPes = 1;
        
        $idGrup = $_GET['action'];

    $con = mysqli_connect($host, $user, $password, $dbname)
	   or die ('Could not connect to the database server' . mysqli_connect_error());
        
   
    $sql = "SELECT comentario, pessoa_id_pessoa FROM comentario where '$idGrup'=grupo_id_grupo";
    if($resultado = mysqli_query($con, $sql)){
        while($row = mysqli_fetch_object($resultado)){
             $tes = $row->comentario;
             $tes2 = $row->pessoa_id_pessoa;
             
             $aux[$i] = $tes;
             $auxId[$i] = $tes2;
             
             
             $i = $i+1;
        }
    }
    mysqli_close($con);
    
    
    
    $con = mysqli_connect($host, $user, $password, $dbname)
	   or die ('Could not connect to the database server' . mysqli_connect_error());
        
   for($t=0;$t<$i;$t++){
    $sql = "SELECT nome_pessoa, sobrenome_pessoa, caminho_imagem FROM pessoa where '$auxId[$t]'=id_pessoa";
    if($resultado = mysqli_query($con, $sql)){
        while($row = mysqli_fetch_object($resultado)){
             $tes = $row->nome_pessoa;
             $tes2 = $row->sobrenome_pessoa;
             $tes3 = $row->caminho_imagem;
             
             $auxNome[$q] = $tes;
             $auxSobrenome[$q] = $tes2;
             $auxImagem[$q] = $tes3;
             
             
             $q = $q+1;
        }
    }
   }
    mysqli_close($con);
    
    
    
    $con = mysqli_connect($host, $user, $password, $dbname)
	   or die ('Could not connect to the database server' . mysqli_connect_error());
    
    $sql = "SELECT nome_grupo, id_grupo FROM grupo";
    if($resultado = mysqli_query($con, $sql)){
        while($row = mysqli_fetch_object($resultado)){
             $tes = $row->nome_grupo;
             $tes2 = $row->id_grupo;
             
             $nomes[$x] = $tes;
             $ids[$x] = $tes2;
             
             $x = $x+1;
        }
    }
    mysqli_close($con);
    
   
    $con = mysqli_connect($host, $user, $password, $dbname)
	   or die ('Could not connect to the database server' . mysqli_connect_error());
    
    $sql = "SELECT nome_pessoa, sobrenome_pessoa, id_pessoa, cidade, estado, caminho_imagem FROM pessoa";
    if($resultado = mysqli_query($con, $sql)){
        while($row = mysqli_fetch_object($resultado)){
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
             
             $y = $y+1;
        }
    }
    mysqli_close($con);
    
    
    
    
    
    $con = mysqli_connect($host, $user, $password, $dbname)
	   or die ('Could not connect to the database server' . mysqli_connect_error());
    
    $sql = "SELECT nome_grupo FROM grupo where '$idGrup'=id_grupo";
    if($resultado = mysqli_query($con, $sql)){
        while($row = mysqli_fetch_object($resultado)){
             $tes = $row->nome_grupo;
             
             $nomedoGrupoAtual = $tes;
        }
    }
    mysqli_close($con);
   
   
    
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
                <a class="navbar-brand" href="index.html">LinkDoc</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                   
                          
                            <img class="img-gran img-circle"  src="foto.png"></img>
                          <div class="name" style="text-align:center;">
                                <a href="perfil.html"> Fernanda K</a>
                            </div>
                          
                       
                    <li style="margin-top:15px;">
                        <a href="index.html"><i class="fa fa-fw fa-dashboard"></i> Feed</a>
                    </li>
                    <li>
                        <a href="charts.html"><i class="fa fa-fw fa-bar-chart-o"></i> Gr√°ficos</a>
                    </li>
                    <li>
                        <a href="tables.html"><i class="fa fa-fw fa-table"></i> √?rea Informativa</a>
                    </li>
                    
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Grupos <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <?php for($z=0;$z<$x;$z++){?>
                            <li>
                                <a href="grupos.php?action=<?php echo $ids[$z];?>"> <?php echo $nomes[$z]; ?> </a>
                            </li>
                            <?php } ?>
                            <li>
                                <a href="#"id="myBtn">Criar novo grupo</a>
                            </li>
                        </ul>
                    </li
                    
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
                            Grupos <small>Comunique-se com os amigos</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Feed</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart-o"></i> Grupos
                            </li>
                        </ol>
                    </div>
                </div>
                
                <!-- /.row -->
                <div id="nomedogrupo">
                    <h3 class="page-header"style="text-align: right; padding-bottom:20px; margin-top:-50px;" >
                           <?php echo $nomedoGrupoAtual;?>
                          
                        </h3>
               
                <div class="row" style="margin-left:80px;">
                    <div class="col-lg-10 col-md-6">
                        <ul class="media-list media-list-conversation c-w-md">
                            
                            <?php for($j=0;$j<$i;$j++){?>
                          
                          <li class="media m-b-md">
                            <a class="media-left" href="#">
                              <img class="img-circle media-object" src="<?php echo $auxImagem[$j];?>">
                            </a>
                            <div class="media-body">
                              <div class="media-body-text">
                               <?php echo $aux[$j]; ?>
                                  </br>
                              </div>
                              <div class="media-footer">
                                <small class="text-muted">
                                  <a href="#"><?php echo $auxNome[$j]." ".$auxSobrenome[$j];?></a> 
                                </small>
                              </div>
                            </div>
                          </li>
                            <?php } ?>
                          
                    

                       <div class="col-lg-10" style="padding-bottom:50px;">
                       <hr>
                        <form action="comentar.php?action=<?php echo $idGrup?>&idPes=<?php echo $idPes?>" method="post">
                        <input type="text" name="texto" class="form-control" placeholder="Messagem..." size="">
                    </div>
                    <div class="col-lg-2" style="padding-top:48px; padding-bottom:50px;">
                        <button class="btn" name="salvar"> Enviar</button>
                        </form>
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
    <script src="js/jquery.js"></script>

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

                   <h4>Adicione participantes</h4>
                    <div class="checkbox custom-control custom-checkbox"
                    <div class="col-lg-12">
                    <div class="input-group">
                      <ul class="media-list media-list-users list-group">
                          <?php for($b=0;$b<$y;$b++) { ?>
                          
                          <li class="list-group-item">
                            <div class="media">
                              <a class="media-left" href="#">
                                <img class="media-object img-circle" src="<?php echo $caminhodaImagem[$b];?>">
                              </a>
                              <div class="media-body">
                                
                                <strong><?php echo $nomep[$b]." ".$sobrenomes[$b];?></strong>
                                <small><?php echo $cidades[$b]."-".$estados[$b];?></small>
                                <b style="padding-left:220px;">
                                    
                                    <input name="check<?php echo $b?>" value=false type="checkbox">
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
          <button type="button" class="btn btn-default" data-dismiss="modal">Criar</button>
          </form>
        </div>
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

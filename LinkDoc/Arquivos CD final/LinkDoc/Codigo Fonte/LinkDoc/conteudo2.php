<!DOCTYPE html>
<html lang="pt-br">

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
                <strong>
                    <a class="navbar-brand" href="index.html" style="color:#363636; font-size:25px; padding-left: 40px;font:'bould';">LinkDoc</a>
                </strong>
                
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
                                        <h5 class="media-heading"><strong>João Verde</strong>
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
                                        <h5 class="media-heading"><strong>João Verde</strong>
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
                                        <h5 class="media-heading"><strong>João Verde</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">Ler Todas as mensagens</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alerta Nome <span class="label label-default">Alerta Usuário</span></a>
                        </li>
                        <li>
                            <a href="#">Alerta Nome <span class="label label-primary">Alerta Usuário</span></a>
                        </li>
                        <li>
                            <a href="#">Alerta Nome <span class="label label-success">Alerta Usuário</span></a>
                        </li>
                        <li>
                            <a href="#">Alerta Nome <span class="label label-info">Alerta Usuário</span></a>
                        </li>
                        <li>
                            <a href="#">Alerta Nome <span class="label label-warning">Alerta Usuário</span></a>
                        </li>
                        <li>
                            <a href="#">Alerta Nome <span class="label label-danger">Alerta Usuário</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">Ver todos</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>  João Verde <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Perfil</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Mensagens</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Configurações</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Sair</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="index.html" style="color:#fff; "><i class="fa fa-fw fa-list"></i> Feed </a>
                    </li>
                    <li>
                        <a href="charts.html" style="color:#fff; "><i class="fa fa-fw fa-bar-chart-o"></i> Gráficos</a>
                    </li>
                    <li>
                        <a href="forms.html" style="color:#fff;"><i class="fa fa-fw fa-table"></i> Consultas</a>
                    </li>
                    <li>
                        <a href="#" style="color:#fff; "><i class="fa fa-fw fa-edit"></i> Fórum</a>
                    </li>
                    <li>
                        <a href="tables.html" style="color:#fff; "><i class="fa fa-fw fa-desktop"></i> Área informativa</a>
                    </li>
                    <li>
                        <a href="#" style="color:#fff; "><i class="fa fa-fw fa-inbox"></i> Caixa de Mensagem</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo" style="color:#fff; "><i class="fa fa-fw fa-users"></i> Amigos <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse" style="color:#fff; ">
                            <li>
                                <a href="#" style="color:#fff; ">Paientes</a>
                            </li>
                            <li>
                                <a href="#" style="color:#fff; ">Médicos</a>
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
                            Alergista <small>Especificações da área:</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Area informativa
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div>
                <p><img width="350px" height="350px" src="alergista.jpg"></p></div>
               
        </div>
                
              <p><div id="txt"><p>O alergista é o médico que concluiu com êxito um período de treinamento especializado em alergia e imunologia e um período de treinamento em medicina interna e/ou pediatria. Os alergistas também são imunologistas clínicos especializados, devido à base imunológica das doenças que diagnosticam e tratam. Na maioria dos países, o período aprovado de formação na especialidade em alergia e imunologia é de dois a três anos de treinamento intenso e específico. <p>
              Dependendo dos sistemas de credenciamento nacionais, a conclusão desse treinamento será reconhecida por um certificado de treinamento especializado em alergia, em alergia e imunologia ou em alergia e imunologia clínica, outorgado por uma comissão diretiva. Em alguns países, isso acompanha a conclusão bem-sucedida de um exame de qualificação e, em outros, as competências apresentadas por um supervisor de treinamento. <p>
              Os alergistas totalmente treinados fazem uma importante contribuição para o delineamento dos sistemas de atendimento local e proporcionam o atendimento necessário aos pacientes com doenças alérgicas. Os alergistas agem como defensores do paciente, e apóiam e questionam o caso para melhorar a educação dos médicos de atendimento primário e secundário, assim como de outros profissionais de saúde que também atendem pacientes alérgicos. <p>
              Os alergistas devem estar disponíveis para fazer o atendimento dos casos mais complicados, que estão além do campo de ação de médicos de atendimento primário e secundário e de outros profissionais de saúde com bom treinamento. As principais características que definem um alergista são a apreciação da importância dos desencadeantes externos que causam a doença e o conhecimento de como identificar e tratar essas doenças, juntamente com a experiência nas terapias imunológicas e fármacos apropriados. Essa conduta no diagnóstico e na terapia é um valor essencial do especialista em alergia, e destaca o alergista entre muitos especialistas cujas bases de pacientes podem sobrepor-se com a especialidade.</pre></div> </p>  

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

</body>

</html>

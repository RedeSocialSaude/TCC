<!DOCTYPE html>
<html lang="en">

    <head>

        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <title>LinkDoc</title>

        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

        <!-- Custom Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">

        <!-- Plugin CSS -->
        <link rel="stylesheet" href="css/animate.min.css" type="text/css">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="css/creative.css" type="text/css">

        <SCRIPT LANGUAGE='JavaScript'>

            function Estado(){
                var estado = (document.getElementById("estado").value);
                return (estado);
            }

</SCRIPT>

    </head>

    <body id="page-top">

        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand page-scroll" href="#page-top">LinkDoc</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="page-scroll" href="#about">Sobre</a>
                        </li>
                        <li>
                            <a  href="#modalID" id="myBtn">cadastro</a>

                        </li>
                        <li>
                            <a href="#modalID" id="myBtn2" style="margin-right:65px;">Login</a>
                        </li>

                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

        <header>
            <div class="header-content">
                <div class="header-content-inner">
                    <h1>A rede social da sua saúde, e bem estar</h1>
                    <hr>
                    <p>O linkDoc é a rede social que pode atuar de forma bem interessante na vida de seus usuários! Ele ajuda a acompanhar seu bem estar e saúde.</p>
                    <a href="#about" class="btn btn-primary btn-xl page-scroll">Continuar</a>
                </div>
            </div>
        </header>

        <section class="bg-primary" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <h2 class="section-heading">SOBRE</h2>
                        <hr class="light">
                        <p class="text-faded">O LinkDoc é um Site da Web, que tem o intuito de gerar a interação entre os profissionais da saúde com os outros usuários, para que assim, não ocorra aquele relacionamento seco e impessoal, como ocorre geralmente nas consultas.
   <br> Além disso, o LinkDoc busca o monitoramento da saúde e o bem-estar dos usuários, através de gráficos, já que, o mesmo gera uma melhor visão e entendimento de ambas as partes, seja essa profissional ou paciente. Dessa maneira, as pessoas irão tentar melhorar a sua saúde, e ainda, poderão acompanhar o seu desenvolvimento físico.
 </p>
                        <a href="#contact" class="btn btn-default btn-xl">Continuar!</a>
                    </div>
                </div>
            </div>
        </section>



        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <h2 class="section-heading">DESENVOLVEDORES</h2>
                        <hr class="primary">
                        <p>Arthur Gomes Batista de Souza, Bianca dos Reis Santos, Ítalo Augusto Silva Ferreira, Jade Moreira e Michel Pires Silva. <br><br>
    <btr>Arthur Gomes Batista de Souza – Criador do LinkDoc
<br>Bianca dos Reis Santos – Criadora do LinkDoc
<br>Ítalo Augusto Silva Ferreira – Criador do LinkDoc
<br>Jade Moreira – Criadora do LinkDoc
<br>Michel Pires Silva – Orientador do LinkDoc
</p>
                    </div>

                </div>
            </div>
        </section>

        <!-- jQuery -->
        <script src="js/jquery.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Plugin JavaScript -->
        <script src="js/jquery.easing.min.js"></script>
        <script src="js/jquery.fittext.js"></script>
        <script src="js/wow.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="js/creative.js"></script>

        <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog ">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close " data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Acesse sua conta!</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                        <form class="form-inline" name="formulario_Login" id="formulario_Login" action="Controler_Login.php?action=login" method="post">
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" size="40" required>
                                    </div>
                                </div>
                                </p>
                                <p>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                        <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" size="40" required>
                                    </div>
                                </div>
                                <p>
                                    <a href="#" style="text-decoration:none;  font-size:12px; padding-left:25px;"> Esqueceu a senha?</a>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" value="Entrar" class="btn btn-primary btn-xl">
                        
                            </div>

                        </form>
                    </div>
                    
                    
                </div>

            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close " data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Cadastre-se</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-inline" name="formulario_Cadastro" id="formulario_Cadastro" action="Controler_Login.php?action=cadastro" method="post">
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

                                <div class="col-lg-12" style="text-align:left;">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-at"></i></div>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" size="100" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                        <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" size="50" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                        <input type="password" class="form-control" name="conf_senha" id="ConfSenha" placeholder="Confirme a senha" size="50" required>
                                    </div>

                                </div>
                                <div class="col-lg-6">

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                        <input type="tel" class="form-control" name="telefone" id="tel" placeholder="Telefone" size="50" required>
                                    </div>

                                </div>
                                <div class="col-lg-6" style="text-align: left;">
                                    <br>
                                    <table>
                                        <tr>
                                            <td style="padding-bottom:10px; width:150px;"><label>Data de Nascimento:</label></td>
                                            <td style="padding-bottom:10px;">

                                                <select name="dia" id="dia" class="selct" style="width:60px;" required>
                                                    <option>Dia</option>
                                                    <?php
                                                        for($i=1; $i<=31; $i++){ 
                                                            ?> <option> <?php echo $i; ?> </option> <?php
                                                        }
                                                    ?> 

                                                    </select>
                                                    <select name="mes" id="mes" class="selct" style="width:120px;" required>
                                                        <option>Mês</option>
                                                        <option value="01">Janeiro</option>
                                                        <option value="02">Fevereiro</option>
                                                        <option value="03">Março</option>
                                                        <option value="04">Abril</option>
                                                        <option value="05">Maio</option>
                                                        <option value="06">Junho</option>
                                                        <option value="07">Julho</option>
                                                        <option value="08">Agosto</option>
                                                        <option value="09">Setembro</option>
                                                        <option value=10>Outubro</option>
                                                        <option value="11">Novembro</option>
                                                        <option value="12">Dezembro</option>
                                                    </select>
                                                    <select name="ano" id="ano" class="selct" style="width:60px;" required>
                                                        <option>Ano</option>
                                                        <?php
                                                            for($i=2015; $i>=1910; $i--){ 
                                                                ?> <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option> <?php
                                                            }
                                                        ?>
                                                </select></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-lg-6" style="text-align:left;">

                                <?php

                                    include 'DAO.php';

                                    $host="127.0.0.1";
                                    $port=3306;
                                    $socket="";
                                    $user="root";
                                    $password="";
                                    $dbname="mydb";
                            
            
                                    $con = new mysqli($host, $user, $password, $dbname, $port, $socket) or die 
                                        ('Could not connect to the database server' . mysqli_connect_error());                                                                  

                                ?>

                                    <label>Estado:</label>
                                    <select name="estado" id="estado" required>
                                        <option value="">Selecione o estado </option>
                                        <option value=""> - </option>
                                        <?php

                                            if ($con != NULL) {
                                                $sql = "SELECT uf, nome FROM mydb.tb_estados";
                                                $result = mysqli_query($con, $sql);
                                                //Se o número de linhas retornadas é melhor do que zero
                                                if (mysqli_num_rows($result) > 0) {
                                                    //Percorre todas as linhas retornadas
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $uf = $row["uf"];
                                                        $estado = $row['nome'];
                                                        echo '<option value='.$uf.'>'.$estado.'</option>';
                                                    };
                                                }     
                        
                                                closeBD($con);
                                            }

                                        ?>
                                        
                                    </select>
                                </div>
                                <div class="col-lg-6" style="text-align:left;">


                                    <label>Cidade:</label>
                                    <select name="cidade" id="cidade" onchange="Estado()" required>
                                        <option value="">Selecione a cidade</option>
                                        <option value=""> - </option>
                                        <?php
                                            $con2 = new mysqli($host, $user, $password, $dbname, $port, $socket) or die 
                                        ('Could not connect to the database server' . mysqli_connect_error()); 
                                            $estado = $_POST['estado'];
                                            if ($con2 != NULL) {
                                                //select cidades
                                                $sql2 = "SELECT nome FROM mydb.tb_cidades ORDER BY nome";
                                                $result2 = mysqli_query($con2, $sql2);
                                                //Se o número de linhas retornadas é melhor do que zero
                                                if (mysqli_num_rows($result2) > 0) {
                                                    //Percorre todas as linhas retornadas
                                                    while ($row = mysqli_fetch_assoc($result2)) {
                                                        $cidade = $row['nome'];
                                                        echo '<option value='.$cidade.'>'.$cidade.'</option>';
                                                    };
                                                }     
                        
                                                closeBD($con2);
                                            }
                                        ?>
                                    </select>


                                </div>

                                <div class="col-lg-6" style="text-align:left; padding-bottom: 15px;">
                                    <br>
                                    <b>Sexo: </b> 
                                    <input type="radio" name="sexo" value="M" style="margin-left:10px;" required> Masculino<br>
                                    <input type="radio" name="sexo" value="F" style="margin-left:53px;" required> Feminino

                                </div>

                                <div class="col-lg-6" style="text-align: left;padding-bottom: 15px;">

                                    <br><b>Tipo usuário:</b>
                                    <br>
                                    <input type="radio" id="tipoUsuario" name="tipoUsuario" value="1" style="margin-left:10px;" 
                                    onclick="if(document.getElementById('crm').disabled==true){document.getElementById('crm').disabled=true}" required /> Paciente<br>
                                    <input type="radio" id="tipoUsuario" name="tipoUsuario" value="0" style="margin-left:10px;" 
                                    onclick="if(document.getElementById('crm').disabled==true){document.getElementById('crm').disabled=false}" required /> Profissional da saúde<br>
                                    
                                    
                                </div>

                                <div class="col-lg-12" style="text-align:right;">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-stethoscope"></i></div>
                                        <input type="text" class="form-control" name="crm" id="crm" disabled="disabled" placeholder="CRM" size="42" required>
                                    </div>
                                </div>
                                <br>                                
                                <div class="modal-footer">
                                    <input type="submit" value="Criar conta" class="btn btn-primary btn-xl" style="position:relative; top:15px;">                      
                                </div>
                            </div>
                            
                        </form>

                    </div>
                </div>

            </div>
        </div>
        <script>
            $(document).ready(function() {
                $("#myBtn").click(function() {
                    $("#myModal").modal({backdrop: "static"});
                    ;
                });
            });

            $(document).ready(function() {
                $("#myBtn2").click(function() {
                    $("#myModal2").modal({backdrop: "static"});
                    ;
                });
            });


            $(function () {
  $('[data-toggle="popover"]').popover()
})
        </script>
    </body>
</html>

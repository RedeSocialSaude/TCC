<?php

session_start();

//Valida se usuario esta logado
if ($_SESSION['Id'] == null && $_SESSION['Nome'] == null) {
    header("Location: index.php");
}

$host = "localhost";
$port = 3306;
$socket = "";
$user = "root";
$password = "";
$dbname = "mydb";

if (isset($_GET['action'])) {

    //Altera Dados
    if ($_GET['action'] == 'AlterarDados') {

        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $idade = $_POST['idade'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $email = $_POST['email'];
        $id = $_SESSION['Id'];

        $con = mysqli_connect($host, $user, $password, $dbname)
                or die('Could not connect to the database server' . mysqli_connect_error());
        $sql = "UPDATE `mydb`.`pessoa` SET `nome_pessoa`='$nome', `sobrenome_pessoa`='$sobrenome', `data_nasc`='$idade', `cidade`='$cidade', `estado`='$estado', `email`='$email' WHERE `id_pessoa`='$id'";
        if (mysqli_query($con, $sql)) {
            header("Location: perfil.php");
            //echo "Nome";
        } else {
            echo"<script language='javascript' type='text/javascript'>alert('Falha na atualização dos dados.');window.location.href='perfil.php';</script>";
        }

        mysqli_close($con);
    }

    //Altera Dados
    if ($_GET['action'] == 'AlterarDadosP') {

        $curso = $_POST['curso'];
        $local = $_POST['local'];
        $id = $_SESSION['Id'];

        $con = mysqli_connect($host, $user, $password, $dbname)
                or die('Could not connect to the database server' . mysqli_connect_error());
        $sql = "UPDATE `mydb`.`profissional_saude` SET `curso`='$curso', `local_trabalho`='$local' WHERE `pessoa_id_pessoa`='$id'";
        if (mysqli_query($con, $sql)) {

            $con2 = mysqli_connect($host, $user, $password, $dbname)
                    or die('Could not connect to the database server' . mysqli_connect_error());
            $sql2 = "SELECT id_area_informativa FROM mydb.profissional_saude, mydb.area_informativa where titulo = '$curso'";
            if ($resultado = mysqli_query($con2, $sql2)) {
                while ($row = mysqli_fetch_object($resultado)) {
                    $idAI = $row->id_area_informativa;
                }
            }

            mysqli_close($con2);

            $con2 = mysqli_connect($host, $user, $password, $dbname)
                    or die('Could not connect to the database server' . mysqli_connect_error());
            $sql2 = "UPDATE `mydb`.`profissional_saude` SET `area_informativa_id_area_informativa`='$idAI' WHERE `pessoa_id_pessoa`='$id'";
            if (mysqli_query($con, $sql2)) {
                
            } else {
                echo"<script language='javascript' type='text/javascript'>alert('Falha na atualização dos dados.');window.location.href='perfil.php';</script>";
            }

            mysqli_close($con2);

            header("Location: perfil.php");
            //echo "Nome";
        } else {
            echo"<script language='javascript' type='text/javascript'>alert('Falha na atualização dos dados.');window.location.href='perfil.php';</script>";
        }

        mysqli_close($con2);
    }

    //Altera Senha
    if ($_GET['action'] == 'AlterarSenha') {

        $senhaAntiga = $_POST['senha'];
        $novaSenha = $_POST['NovaSenha'];
        $confSenha = $_POST['ConfSenha'];
        $SenhaBanco = '';
        $id = $_SESSION['Id'];

        //Pega senha antiga
        $con = mysqli_connect($host, $user, $password, $dbname)
                or die('Could not connect to the database server' . mysqli_connect_error());
        $sql = "SELECT senha FROM mydb.pessoa where id_pessoa = '$id'";
        if ($resultado = mysqli_query($con, $sql)) {
            while ($row = mysqli_fetch_object($resultado)) {
                $SenhaBanco = $row->senha;
            }
        }

        mysqli_close($con);

        $senha_crip = md5($senhaAntiga);
        if ($SenhaBanco == $senha_crip && $novaSenha = $confSenha) {
            //altera a senha no banco

            $senha_crip_nova = md5($novaSenha);

            $con = mysqli_connect($host, $user, $password, $dbname)
                    or die('Could not connect to the database server' . mysqli_connect_error());
            $sql = "UPDATE `mydb`.`pessoa` SET `senha`='$senha_crip_nova' WHERE `id_pessoa`='$id'";
            if (mysqli_query($con, $sql)) {
                header("Location: perfil.php");
                //echo "Nome";
            } else {
                echo"<script language='javascript' type='text/javascript'>alert('Falha na alteração da senha.');window.location.href='perfil.php';</script>";
            }

            mysqli_close($con);
        } else {
            echo"<script language='javascript' type='text/javascript'>alert('Senha incorreta.');window.location.href='perfil.php';</script>";
        }
    }
}
?>
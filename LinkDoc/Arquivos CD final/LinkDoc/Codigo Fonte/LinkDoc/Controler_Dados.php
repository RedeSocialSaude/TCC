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
    if ($_GET['action'] == 'EntradaDados') {

        $peso = $_POST['peso'];
        $altura = $_POST['altura'];
        $colesterol = $_POST['colesterol'];
        $glicose = $_POST['glicose'];
        $pressao = $_POST['pressao'];
        $MPercorrido = $_POST['MPercorrido'];
        $TPercurso = $_POST['TPercurso'];
        $id = $_SESSION['Id'];

        $dataAtual = date("Y-m-d");

        //Insere na tabela de dados
        $con = mysqli_connect($host, $user, $password, $dbname)
                or die('Could not connect to the database server' . mysqli_connect_error());
        $sql = "INSERT INTO `mydb`.`dados` (`data_insercao`, `peso`, `altura`, `glicose`, `colesterol`, `pressao`, `metros_percorridos`, `temp_percorrido_min`) VALUES ('$dataAtual', '$peso', '$altura', '$glicose', '$colesterol', '$pressao', '$MPercorrido', '$TPercurso')";
        if (mysqli_query($con, $sql)) {
            //header("Location: perfil.php");
            //echo "Nome";
        } else {
            echo"<script language='javascript' type='text/javascript'>alert('Falha na inserção dos dados.');window.location.href='feed.php';</script>";
        }

        mysqli_close($con);

        //Pega o id dos dados
        $con = mysqli_connect($host, $user, $password, $dbname)
                or die('Could not connect to the database server' . mysqli_connect_error());
        $sql = "SELECT id_dados FROM mydb.dados where data_insercao = '$dataAtual' and peso = '$peso' and metros_percorridos = '$MPercorrido'";
        if ($resultado = mysqli_query($con, $sql)) {
            while ($row = mysqli_fetch_object($resultado)) {
                $idDados = $row->id_dados;
            }
        }

        mysqli_close($con);

        //Insere na tabela dados_has_pessoa
        $con = mysqli_connect($host, $user, $password, $dbname)
                or die('Could not connect to the database server' . mysqli_connect_error());
        $sql = "INSERT INTO `mydb`.`pessoa_has_dados` (`pessoa_id_pessoa`, `dados_id_dados`) VALUES ('$id', '$idDados')";
        if (mysqli_query($con, $sql)) {
            //header("Location: perfil.php");
            //echo "Nome";
        } else {
            echo"<script language='javascript' type='text/javascript'>alert('Falha na inserção dos dados.');window.location.href='feed.php';</script>";
        }

        mysqli_close($con);

        header("Location: feed.php");
    }
}
?>
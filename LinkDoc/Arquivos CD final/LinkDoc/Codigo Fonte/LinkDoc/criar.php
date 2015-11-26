<?php

$host = "localhost";
$port = 3306;
$socket = "";
$user = "root";
$password = "";
$dbname = "mydb";

$aux = array();
$i = 0;

$idPes = $_GET['action'];
$NomeGrupo = $_POST["nomeGrup"];

//Insere Grupo ono banco
$con = mysqli_connect($host, $user, $password, $dbname)
        or die('Could not connect to the database server' . mysqli_connect_error());
$strSQL = "INSERT INTO `mydb`.`grupo` (`nome_grupo`, `pessoa_id_pessoa`) VALUES ('" . $_POST["nomeGrup"] . "', '$idPes')";
mysqli_query($con, $strSQL);
mysqli_close($con);

//Retorna o id do grupo inserido
$con = mysqli_connect($host, $user, $password, $dbname) or die('Could not connect to the database server' . mysqli_connect_error());
$sql = "SELECT id_grupo FROM mydb.grupo where pessoa_id_pessoa = '$idPes' and nome_grupo = '$NomeGrupo'";
if ($resultado = mysqli_query($con, $sql)) {
    while ($row = mysqli_fetch_object($resultado)) {
        $id_grupo = $row->id_grupo;
    }
}
mysqli_close($con);

//Insere na tabela grupo_has_pessoa
$con = mysqli_connect($host, $user, $password, $dbname)
        or die('Could not connect to the database server' . mysqli_connect_error());
$strSQL = "INSERT INTO `mydb`.`pessoa_has_grupo` (`pessoa_id_pessoa`, `grupo_id_grupo`) VALUES ('$idPes', '$id_grupo')";
mysqli_query($con, $strSQL);
mysqli_close($con);

header("Location: grupos.php?action=$id_grupo");
?>
        

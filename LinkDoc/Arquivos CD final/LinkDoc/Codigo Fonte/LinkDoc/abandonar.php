<?php

$host = "localhost";
$port = 3306;
$socket = "";
$user = "root";
$password = "";
$dbname = "mydb";

$aux = array();
$i = 0;

$idGrup = $_GET['action'];
$idPes = $_GET['idPes'];

$con = mysqli_connect($host, $user, $password, $dbname)
        or die('Could not connect to the database server' . mysqli_connect_error());
$strSQL = "DELETE FROM `mydb`.`pessoa_has_grupo` WHERE `pessoa_id_pessoa`='$idPes' and `grupo_id_grupo`='$idGrup'";
mysqli_query($con, $strSQL);

//Pega o id do ADM do grupo
$con = mysqli_connect($host, $user, $password, $dbname) or die('Could not connect to the database server' . mysqli_connect_error());
$sql = "SELECT pessoa_id_pessoa FROM mydb.grupo where id_grupo = '$idGrup'";
if ($resultado = mysqli_query($con, $sql)) {
    while ($row = mysqli_fetch_object($resultado)) {
        $idADM = $row->pessoa_id_pessoa;
    }
}
mysqli_close($con);

if($idPes == $idADM){
	$con = mysqli_connect($host, $user, $password, $dbname)
        or die('Could not connect to the database server' . mysqli_connect_error());
	$strSQL = "DELETE FROM `mydb`.`grupo` WHERE `pessoa_id_pessoa`='$idPes' and `id_grupo`='$idGrup'";
	mysqli_query($con, $strSQL);
}

mysqli_close($con);
header("Location: feed.php");

?>






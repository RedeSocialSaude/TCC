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

//echo $idPes;
//echo $idGrup;

$con = mysqli_connect($host, $user, $password, $dbname)
        or die('Could not connect to the database server' . mysqli_connect_error());

//if(isset($_POST["adicionar"])){
//echo "teste";
$strSQL = "INSERT INTO `mydb`.`pessoa_has_grupo` (`pessoa_id_pessoa`, `grupo_id_grupo`) VALUES ('$idPes', '$idGrup')";
mysqli_query($con, $strSQL);
//}


mysqli_close($con);
header("Location: grupos.php?action=$idGrup");
?>


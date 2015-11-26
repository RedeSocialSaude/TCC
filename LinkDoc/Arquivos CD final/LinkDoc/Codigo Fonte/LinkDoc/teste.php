<?php
    session_start();

    $idPes = $_SESSION['Id'];

    $host="localhost";
        $port=3306;
        $socket="";
        $user="root";
        $password="";
        $dbname="mydb";

        $idPes = 10;
        $idADM = 10;
      
        $con = mysqli_connect($host, $user, $password, $dbname)
                or die('Could not connect to the database server' . mysqli_connect_error());
        $sql = "SELECT nome_grupo FROM mydb.grupo where id_grupo = '2'";
        if ($resultado = mysqli_query($con, $sql)) {
            while ($row = mysqli_fetch_object($resultado)) {
                $tes = $row->nome_grupo;

                $nomedoGrupoAtual = $tes;
                $_SESSION["idGrupo"] = $idGrup;
            }
        }
        mysqli_close($con);



        echo $nomedoGrupoAtual;

    
?>
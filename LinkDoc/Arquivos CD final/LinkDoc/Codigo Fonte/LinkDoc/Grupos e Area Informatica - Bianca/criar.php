<?php
     $host="localhost";
        $port=3306;
        $socket="";
        $user="root";
        $password="";
        $dbname="mydb";
        
        $aux = array();
        $i = 0;

        $con = mysqli_connect($host, $user, $password, $dbname)
	   or die ('Could not connect to the database server' . mysqli_connect_error());
        
      if(isset($_POST["salvar"])){
        $strSQL = "INSERT INTO grupo(nome_grupo) values('" . $_POST["nomeGrupo"] . "')";
        mysqli_query($con, $strSQL);
      }
       
       
    mysqli_close($con);
    header("Location: grupos.php");
        

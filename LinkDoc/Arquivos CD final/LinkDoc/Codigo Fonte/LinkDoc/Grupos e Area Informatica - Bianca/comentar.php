<?php
     $host="localhost";
        $port=3306;
        $socket="";
        $user="root";
        $password="";
        $dbname="mydb";
        
        $aux = array();
        $i = 0;
        
        $idGrup = $_GET['action'];
        $idPes = $_GET['idPes'];

        $con = mysqli_connect($host, $user, $password, $dbname)
	   or die ('Could not connect to the database server' . mysqli_connect_error());
        
      if(isset($_POST["salvar"])){
        $strSQL = "INSERT INTO comentario(id_comentario, comentario, pessoa_id_pessoa, grupo_id_grupo) values(3, '" . $_POST["texto"] . "', '$idPes', '$idGrup' )";
        mysqli_query($con, $strSQL);
      }
       
       
    mysqli_close($con);
    header("Location: grupos.php?action=$idGrup");
        
   

   
   



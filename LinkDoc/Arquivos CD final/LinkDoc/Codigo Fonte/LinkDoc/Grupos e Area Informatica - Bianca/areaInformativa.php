<?php
     $host="localhost";
        $port=3306;
        $socket="";
        $user="root";
        $password="";
        $dbname="mydb";
        
        $aux = array();
        $f = 0;
        $v = 0;
        $idUsuario = 1;
        
        
    $con = mysqli_connect($host, $user, $password, $dbname)
	   or die ('Could not connect to the database server' . mysqli_connect_error());
        
   
    $sql = "SELECT cidade FROM pessoa where '$idUsuario'=id_pessoa";
    if($resultado = mysqli_query($con, $sql)){
        while($row = mysqli_fetch_object($resultado)){
             $tes = $row->cidade;
       
             $cidadeUsuario = $tes;
             
             $v = $v+1;
        }
    }
    mysqli_close($con);
    
    
    
    
    $v = 0;
    
    
    
    $con = mysqli_connect($host, $user, $password, $dbname)
	   or die ('Could not connect to the database server' . mysqli_connect_error());
        
   
    $sql = "SELECT id_pessoa, nome_pessoa, sobrenome_pessoa FROM pessoa";
    if($resultado = mysqli_query($con, $sql)){
        while($row = mysqli_fetch_object($resultado)){
             
             $tes2 = $row->id_pessoa;
             $tes3 = $row->nome_pessoa;
             $tes4 = $row->sobrenome_pessoa;
             
             $IddaPessoa[$v] = $tes2;
             $NomedaPessoa[$v] = $tes3;
             $sobrenomedaPessoa[$v] = $tes4;
             
             $v = $v+1;
        }
    }
    mysqli_close($con);
    
    
    
    
     

    $con = mysqli_connect($host, $user, $password, $dbname)
	   or die ('Could not connect to the database server' . mysqli_connect_error());
        
   
    $sql = "SELECT local_trabalho, pessoa_id_pessoa FROM profissional_saude";
    if($resultado = mysqli_query($con, $sql)){
        while($row = mysqli_fetch_object($resultado)){
             $tes = $row->local_trabalho;
             $tes2 = $row->pessoa_id_pessoa;
             
             $localidade[$f] = $tes;
             $IddoProfissional[$f] = $tes2;
             
             
             $f = $f+1;
        }
        for($m=0;$m<$f;$m++){
            if($localidade[$m] == $cidadeUsuario){
                for($n=0;$n<$v;$n++){
                    if($IddaPessoa[$n] == $IddoProfissional[$m]){
                      echo $NomedaPessoa[$n]." ".$sobrenomedaPessoa[$n];
                    }
                   
                }
                echo '<br>';
            }
        }
    }
    mysqli_close($con);
        
   

   
   




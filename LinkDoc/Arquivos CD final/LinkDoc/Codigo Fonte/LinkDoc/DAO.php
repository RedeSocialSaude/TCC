<?php

//DAO TCC
//ESTABELECE A CONEXÃO COM O BANCO DE DADOS
function connectMysql($servername, $username, $database) {
    $con = mysqli_connect($servername, $username, $database);
    //Verifica a conexão
    if (!$con) {
        die("Conexão falhou! " . mysqli_connect_error() . ".<br>");
        return NULL;
    }
    echo "Conexão efetuada com sucesso.<br>";
    return $con;
}

//SELECIONA TODOS OS USUÁRIOS CADASTRADOS
function selectUsers(&$con) {
    $sql = "SELECT * FROM user";
    $result = mysqli_query($con, $sql);
    //Se o número de linhas retornadas é melhor do que zero
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>";
        echo "<tr><td>Id</td><td>Nome</td><td>Sobrenome</td><tr>";
        //Percorre todas as linhas retornadas
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["idUser"] . "</td><td>" . $row["firstname"] . "</td><td>" . $row["lastname"] . "</td><tr>";
        }
        echo "</table>";
    } else {
        echo "0 resultados<br>";
    }
}

//SELECIONA TODOS OS USUÁRIOS CADASTRADOS
function Amigos($id, &$con) {
    $sql = "SELECT * FROM user";
    $result = mysqli_query($con, $sql);
    //Se o número de linhas retornadas é melhor do que zero
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        //Percorre todas as linhas retornadas
        while ($row = mysqli_fetch_assoc($result)) {
            $id2 = $row["idUser"];
            if ($id2 != $id) {
                echo '<tr><td> <src img = "' . $row["profileImage"] . '">' . $row["firstname"] . " " . $row["lastname"] . '</td><td>';
            }
        }
        echo "</table>";
    } else {
        echo "<br>";
    }
}

function perfil($id, &$con) {
    //$sql = "SELECT path from photomod.image as i WHERE (select idAlbum from photomod.album as a, photomod.user as u where a.idUser = '$id' and a.name = 'Perfil') = i.idAlbum";
    $sql = "SELECT profileImage FROM photomod.user WHERE idUser = '$id'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $foto = $row["profileImage"];
        $_SESSION['perfil'] = $foto;
    }
}

function estados(&$con) {
    $sql = "SELECT uf FROM mydb.tb_estados";
    $result = mysqli_query($con, $sql);
    //Se o número de linhas retornadas é melhor do que zero
    if (mysqli_num_rows($result) > 0) {
        //Percorre todas as linhas retornadas
        while ($row = mysqli_fetch_assoc($result)) {
            $uf = $row["uf"];
            echo $uf;
            echo '<br>';
        };
    } else {
        echo "<br>";
    }
}

//Confere o login
function Login($password, $user, &$con) {
    $sql = "SELECT idUser, user, password, firstname, lastname FROM photomod.user WHERE user = '$user' AND password = '$password'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row["idUser"];
        $_SESSION['identificador'] = $id;

        $Nome1 = $row["firstname"];
        $Nome = $Nome1;
        $_SESSION['nome'] = $Nome;

        perfil($id, $con);

        $_SESSION['logado'] = true;

        header("Location: Direciona.php?action=ok");
    } else {
        $_SESSION['logado'] = FALSE;
        //return false;
    }
}

//ATUALIZA A SENHA E O NOME DO USUÁRIO ATRAVÉS DE $idUser
function updateUser($idUser, $password, $user, &$con) {
    $sql = "UPDATE user SET password='$password', user='$user' WHERE idUser=$idUser";
    if (mysqli_query($con, $sql)) {
        echo "Dados atualizados.";
        return true;
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($con);
        return false;
    }
}

//Insere Pessoa
function InserePessoa($Nome, $Sobrenome, $Email, $Senha, $Telefone, $Estado, $Cidade, $Sexo, $Data_Nasc, $tipoUsuario, &$con) {
    if ($Sexo == 'F') {
        $caminho_img = 'img1.jpg';
    }
    if ($Sexo == 'M') {
        $caminho_img = 'img2.jpg';
    }
    if ($tipoUsuario == 0) {
        $caminho_img = 'img3.jpg';
    }

    $sql = "INSERT INTO pessoa (`nome_pessoa`, `sobrenome_pessoa`, `cidade`, `estado`, `sexo`, `email`, `senha`, `data_nasc`, `cod_dif`, `num_pessoa`, `caminho_imagem`) VALUES ('$Nome', '$Sobrenome', '$Cidade', '$Estado', '$Sexo', '$Email', '$Senha', '$Data_Nasc', '$tipoUsuario', '$Telefone', '$caminho_img')";
    if (mysqli_query($con, $sql)) {
        return true;
    } else {
        //echo "Erro: " . $sql . "<br>" . mysqli_error($con);
        return false;
    }
}

//Insere Pessoa
function AreaInformativa($Titulo, $Texto, &$con) {

    $sql = "INSERT INTO `mydb`.`area_informativa` (`titulo`, `conteudo`) VALUES ('$Titulo', '$Texto');";
    if (mysqli_query($con, $sql)) {
        return true;
    } else {
        //echo "Erro: " . $sql . "<br>" . mysqli_error($con);
        return false;
    }
}

//Insere Pessoa
function InsereProfissional($id, $crm, $curso, $local_trabalho, &$con) {

    $sql = "INSERT INTO `mydb`.`profissional_saude` (`pessoa_id_pessoa`, `identificacao`, `curso`, `local_trabalho`, `area_informativa_id_area_informativa`) VALUES ('$id', '$crm', '$curso', '$local_trabalho', '5')";
    if (mysqli_query($con, $sql)) {
        return true;
    } else {
        //echo "Erro: " . $sql . "<br>" . mysqli_error($con);
        return false;
    }
}

//Verifica se o email já esta cadastrado
function Verifica_Duplicidade($Email, &$con) {
    $sql = "SELECT id_pessoa FROM mydb.pessoa where email = '$Email';";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        //Email já cadastrado no sistema
        return false;
    } else {
        //Email ainda não cadastrado
        return true;
    }
}

function Verifica_Login($Email, $Senha, &$con) {
    $sql = "select id_pessoa, senha from mydb.pessoa where email = '$Email'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $Senha_banco = $row["senha"];

        if ($Senha == $Senha_banco) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function RetornaDados($Email, $cod, &$con) {

    if ($cod == "id_pessoa") {
        $sql = "select id_pessoa from mydb.pessoa where email = '$Email'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $Id = $row['id_pessoa'];

            return $Id;
        } else {
            return false;
        }
    } else {
        if ($cod == "nome_pessoa") {
            $sql = "select nome_pessoa, sobrenome_pessoa from mydb.pessoa where email = '$Email'";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $aux = $row['nome_pessoa'];
                $nome = $aux . " " . $row['sobrenome_pessoa'];

                return $nome;
            } else {
                return false;
            }
        } else {
            if ($cod == "imagem_perfil") {
                $sql = "select caminho_imagem from mydb.pessoa where email = '$Email'";
                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $img = $row['caminho_imagem'];

                    return $img;
                } else {
                    return false;
                }
            } else {
                return FALSE;
            }
        }
    }
}

function RetornaImg() {
    
}

//FECHA A CONEXÃO COM O BD
function closeBD(&$con) {
    mysqli_close($con);
}

//APAGA UM USUÁRIO COM ID = $idUser
function deleteUser($idUser, $con) {
    $sql = "DELETE FROM user WHERE idUser=$idUser";
    if (mysqli_query($con, $sql)) {
        //echo "Usuário apagado com sucesso!";
    } else {
        echo "Impossível apagar usuário";
    }
}

//EXEMPLO DE EXECUÇÃO
/* $con = connectMysql("localhost", "root", "123456", "photomod");
  if ($con != NULL) {
  insertUser('mphelps', 'usausa', 'Michael', 'Phelps', 'mpheps@gmail.com', '1990-11-23', 'M', $con);
  selectUsers($con);
  //deleteUser(1, $con);
  //updateUser(38, "senhanova", "usernovo", $con);
  closeBD($con);

  echo "<br>DATA ATUAL:".date("Y-m-d", time());
  } */
?>
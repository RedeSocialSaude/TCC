<?php
    $email = 'arthurgomes33@gmail.com'; // email para onde a mensagem deve ir
    $resultado = mail($email, 'Testando nossa configura��o', 'Ol�, nossa configura��o funcionou.');
    if($resultado)
    {
        echo 'Seu email foi enviado com sucesso.';
    }
    else
    {
        echo 'N�o foi poss�vel enviar seu email.';
    }
?>
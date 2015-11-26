<?php
    $email = 'arthurgomes33@gmail.com'; // email para onde a mensagem deve ir
    $resultado = mail($email, 'Testando nossa configuraзгo', 'Olб, nossa configuraзгo funcionou.');
    if($resultado)
    {
        echo 'Seu email foi enviado com sucesso.';
    }
    else
    {
        echo 'Nгo foi possнvel enviar seu email.';
    }
?>
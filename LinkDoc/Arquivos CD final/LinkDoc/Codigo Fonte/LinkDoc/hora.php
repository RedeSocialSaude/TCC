<?php
$hora = date("h");
$hora = $hora + 9;
$dataHora = date("Y-m-d ".$hora.":i:s");
echo $dataHora;
?>
<?php

require '../Modelo/ModeloSeguimientoSemanal.php';

$a = $_GET['c_a'];
//b = codigo del calendario de la grupoempresa
$b = $_GET['b'];
//c = codigo del registro de un detalle
$c = $_GET['c'];


//$codUGE = $_GET['i_u']; // codigo de usuario de la grupo empresa
$cod_cons = $_GET['a']; // $a -> codigo del consultor
//$usr_cons = $_GET['u']; // $u -> codigo de usuario del consultor
$detalle = $_POST['detalle'];
$realizado = $_POST['realizado'];
$observaciones = $_POST['observaciones'];

ingresarDetalleConsultor($a, $b, $c, $realizado, $observaciones, $detalle,$cod_cons);

header("Location: ../Vista/iuTablaSeguimientoDocenteGE.php?a=$a&b=$b");

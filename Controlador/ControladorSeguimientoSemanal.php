<?php
require '../Modelo/ModeloSeguimientoSemanal.php';

$cod_grupoempresa =  $_GET['a'];
$cod_evaluacionsemanal = $_GET['b'];
$rol_seleccionado = $_POST['cbox_roles'];
$avance_esperado = $_POST['avance'];
insertar($cod_grupoempresa, $cod_evaluacionsemanal, $rol_seleccionado, $avance_esperado);
header("Location: ../Vista/iuSeguimientoGrupoEmpresa.php?a=$cod_grupoempresa&b=$cod_evaluacionsemanal");
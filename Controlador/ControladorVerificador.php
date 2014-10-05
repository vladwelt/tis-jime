<?php

require '../Modelo/ModeloVerificador.php';
$valor = $_GET['x'];
switch ($valor) {
    case 1:
        $login = $_GET['nombre_usuario'];
        $str = strtolower($login); //TODO MINUSCULA
        echo verificarLogin($str);
        break;

    case 2:
        $nombreLargo = $_GET['nombre_largo_ge'];
        $str = strtolower($nombreLargo);
        echo verificarNombreLargoEmpresa($str);
        break;

    case 3:
        $nombreCorto = $_GET['nombre_corto_ge'];
        $str = strtolower($nombreCorto);
        echo verificarNombreCortoEmpresa($str);
        break;

    case 4:
        $correo = $_GET['correo_ge'];
        $str = strtolower($correo);
        echo verificarCorreoEmpresa($str);
        break;

    case 5:
        $telefono = $_GET['telefono_ge'];
        $str = strtolower($telefono);
        echo verificarTelefonoEmpresa($str);
        break;

    case 6:
        $login = $_GET['usuario_consultor'];
        $str = strtolower($login);
        echo verificarLogin($str);
        break;

    case 7:
        $correo = $_GET['correo_consultor'];
        $str = strtolower($correo);
        echo verificarCorreoConsultor($str);
        break;

    case 8:
        $telefono = $_GET['telefono_consultor'];
        $str = strtolower($telefono);
        echo verificarTelefonoConsultor($str);
        break;
}
?>
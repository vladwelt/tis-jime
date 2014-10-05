<?php

require('../Controlador/Conexion.php');

function RegistrarUsuario($usuario, $contrasena1, $habilitada) {
    $conec = new Conexion();
    $con = $conec->getConection();

    $nombre_usuario_ge = strtolower($usuario);
    $contrasena_usuario_ge = $contrasena1;
    $estado_cuenta = strtolower($habilitada);

    $sql = "INSERT INTO Usuario (login,passwd,habilitada)";
    $sql.= "VALUES ('$nombre_usuario_ge','$contrasena_usuario_ge','$estado_cuenta')";
    pg_query($con, $sql) or die("ERROR :( " . pg_last_error());
}

function RegistrarGrupoEmpresa($usuario, $nombre_largo, $nombre_corto, $correo, $direccion, $telefono) {

    $conec = new Conexion();
    $con = $conec->getConection();

    $nom_usuario = strtolower($usuario);
    $nombre_largo_ge = strtolower($nombre_largo);
    $nombre_corto_ge = strtolower($nombre_corto);
    $corrreo_ge = strtolower($correo);
    $direccion_ge = strtolower($direccion);
    $telefono_ge = $telefono;

    $sql_id = "SELECT idusuario FROM Usuario WHERE login='$nom_usuario'";
    $filas = pg_query($con, $sql_id);
    $idusr = pg_fetch_object($filas);
    $idusuario = $idusr->idusuario;
    $sql_rol = "INSERT INTO user_rol(usuario_idusuario,rol_codrol)";
    $sql_rol.="VALUES($idusuario,3)";
    pg_query($con, $sql_rol) or die("ERROR :(" . pg_last_error());
    $sql = "INSERT INTO Grupo_Empresa (usuario_idusuario,nombrelargoge,nombrecortoge,correoge,direccionge,telefonoge)";
    $sql.= "VALUES ($idusuario,'$nombre_largo_ge','$nombre_corto_ge','$corrreo_ge','$direccion_ge','$telefono_ge')";
    pg_query($con, $sql) or die("ERROR :( " . pg_last_error());

    crear_calendario($idusuario);
    header("Location: ../Vista/iuIngresar.php");
}

function crear_calendario($idusuario) {
    $conec = new Conexion();
    $con = $conec->getConection();

    $sql_cod = "select codgrupo_empresa from grupo_empresa where usuario_idusuario = $idusuario;";
    $filas = pg_query($con, $sql_cod);
    $cod_ge = pg_fetch_object($filas);
    $cod_grupoempresa = $cod_ge->codgrupo_empresa;

    $sql = "INSERT INTO calendario(grupo_empresa_codgrupo_empresa, grupo_empresa_usuario_idusuario, dia_reunion_fijado)";
    $sql.= "VALUES ($cod_grupoempresa,$idusuario,FALSE)";
    pg_query($con, $sql) or die("ERROR :(" . pg_last_error());
}

?>
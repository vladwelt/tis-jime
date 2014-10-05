<?php

require ('../Controlador/Conexion.php');

function RegistrarUsuario($usuario, $contrasena1_consul,$habilitada) {
    $conec = new Conexion();
    $con = $conec->getConection();

    $nombre_usuario_consultor = strtolower($usuario);
    $contrasena_usuario_consultor = $contrasena1_consul;
    $estado_cuenta = $habilitada;

    $sql = "INSERT INTO Usuario (login,passwd,habilitada)";
    $sql.= "VALUES ('$nombre_usuario_consultor','$contrasena_usuario_consultor','$estado_cuenta')";
    pg_query($con, $sql) or die("ERROR :( " . pg_last_error());
}

function RegistrarConsultor($usuario, $nombre_consul,$correo_consul,$telefono_consul ) {

    $conec = new Conexion();
    $con = $conec->getConection();

    $nom_usuario = strtolower($usuario);
    $nombre_consultor = strtolower($nombre_consul);
    $correo_consultor = strtolower($correo_consul);
    $telefono_consultor = $telefono_consul;

    $sql_id = "SELECT idusuario FROM Usuario WHERE login='$nom_usuario'";
    $filas = pg_query($con, $sql_id);
    $idusr = pg_fetch_object($filas);
    $idusuario = $idusr->idusuario;
    $sql_rol = "INSERT INTO user_rol(usuario_idusuario,rol_codrol)";
    $sql_rol.="VALUES($idusuario,2)";
    pg_query($con, $sql_rol) or die("ERROR :(" . pg_last_error());
    
    $sql = "INSERT INTO consultor (usuario_idusuario,nombreconsultor,correoconsultor,telefonoconsultor)";
    $sql.= "VALUES ($idusuario,'$nombre_consultor','$correo_consultor','$telefono_consultor')";
    pg_query($con, $sql) or die("ERROR :( " . pg_last_error());
    
    header("Location: ../Vista/iuRegistroConsultor.php");
}

?>
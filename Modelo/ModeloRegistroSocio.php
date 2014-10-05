<?php

require('../Controlador/Conexion.php');
function cantidadDeSocios($codGrupoempresa) {
    $conec = new Conexion();
    $con = $conec->getConection();


    $sql = "SELECT nombresocio, apellidossocio, estadocivil, direccion, profesion
            FROM socio
            where grupo_empresa_codgrupo_empresa='$codGrupoempresa';";
    $result=pg_query($con, $sql);
   
    return pg_num_rows($result);
}

function RegistrarUsuario($usuario, $contrasena) {
    $conec = new Conexion();
    $con = $conec->getConection();

    $nombre_usuario = strtolower($usuario);
    $contrasena_usuario = $contrasena;

    $sql = "INSERT INTO Usuario (login,passwd,habilitada)
                        VALUES ('$nombre_usuario','$contrasena_usuario',true)";
    pg_query($con, $sql) or die("ERROR :( " . pg_last_error());
}

function RegistrarSocio($login,$codGrupoempresa,$tipoSocio,$usuario_grupoEmpresa,$nombre,$apellidos,$estado_civil,$direccion,$profesion) {

    $conec = new Conexion();
    $con = $conec->getConection();
    
    $sql_id = "SELECT idusuario FROM Usuario WHERE login='$login'";
    $filas = pg_query($con, $sql_id);
    $idusr = pg_fetch_object($filas);
    $idusuario = $idusr->idusuario;
    
    $sql_rol = "INSERT INTO user_rol(usuario_idusuario,rol_codrol)";
    $sql_rol.="VALUES($idusuario,4)";
    pg_query($con,$sql_rol) or die("ERROR :(".pg_last_error());
    
    $sql="INSERT INTO socio(grupo_empresa_codgrupo_empresa, tipo_socio_codtipo_socio, grupo_empresa_usuario_idusuario,usuario_idusuario, nombresocio, apellidossocio, estadocivil, direccion, profesion)
          VALUES ( '$codGrupoempresa','$tipoSocio','$usuario_grupoEmpresa','$idusuario', '$nombre','$apellidos','$estado_civil','$direccion','$profesion')";
    pg_query($con, $sql) or die("ERROR :( " . pg_last_error());
    
         
}
?>


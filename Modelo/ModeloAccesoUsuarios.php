<?php

require('../Controlador/Conexion.php');

function iniciarSesion($nombre_usuario, $contrasena_usuario) {
    $conec = new Conexion();
    $con = $conec->getConection();

    $ingreso_nombre_usuario = strtolower($nombre_usuario);
    $ingreso_contrasena_usuario = $contrasena_usuario;

    if (!isset($_SESSION)) {
        session_start();
    }

    $consulta_usuario = "SELECT * FROM usuario WHERE login='$ingreso_nombre_usuario' AND passwd='$ingreso_contrasena_usuario' AND habilitada = TRUE";
    $consulta = pg_query($con, $consulta_usuario);
    $filas = pg_fetch_array($consulta);
    if (!$filas[0]) { //opcion1: Si el usuario NO existe o los datos son INCORRRECTOS
        echo '<script language = javascript>
	alert("Usuario o Password errados, por favor verifique."
	</script>';
        header("Location: ../Vista/iuIngresar.php");
    } else { //opcion2: Usuario logueado correctamente
        //Definimos las variables de sesión y redirigimos a la página de usuario
        $idusuario = $filas['idusuario'];
        $_SESSION['id_usuario'] = $filas['idusuario'];
        $_SESSION['nombre'] = $filas['login'];

        $consulta_rol = "SELECT rol_codrol FROM user_rol WHERE usuario_idusuario ='$idusuario'";
        $roles = pg_query($con, $consulta_rol);
        $fila = pg_fetch_array($roles);
        $rol_usuario = $fila['rol_codrol'];
        $_SESSION['rol'] = $fila['rol_codrol'];
        
        $consulta_id_grupoEmpresa = "SELECT codgrupo_empresa FROM grupo_empresa WHERE usuario_idusuario='$idusuario'";
        $cod_grupoEmpresa= pg_query($con,$consulta_id_grupoEmpresa);
        $fila_cod_grupo = pg_fetch_array($cod_grupoEmpresa);
        $codigo_grupoEmpresa = $fila_cod_grupo['codgrupo_empresa'];
        
        $consulta_id_consultor = "SELECT idconsultor FROM consultor WHERE usuario_idusuario='$idusuario'";
        $cod_consultor= pg_query($con,$consulta_id_consultor);
        $fila_cod_consultor = pg_fetch_array($cod_consultor);
        echo $codigo_consultor = $fila_cod_consultor ['idconsultor'];
        
        switch ($rol_usuario){
            case 1: //administrador 
                header("Location: ../Vista/iuAdminCuentasConsultores.php");
                break;
            case 2: // consultor
                header("Location: ../Vista/iu.consultor.php?a=$codigo_consultor&u=$idusuario");
                break;
            case 3://grupo empresa
                header("Location: ../Vista/iuGrupoEmpresa.php?a=$codigo_grupoEmpresa&u=$idusuario");
                break;
            case 4 ://socio 
                
                $consulta_id_grupoEmpresaSocio = "SELECT grupo_empresa_codgrupo_empresa FROM socio WHERE usuario_idusuario=$idusuario";
                $cod_grupoEmpresa= pg_query($con,$consulta_id_grupoEmpresaSocio);
                $fila_cod_grupo = pg_fetch_array($cod_grupoEmpresa);
                $codigo_grupoEmpresa = $fila_cod_grupo['grupo_empresa_codgrupo_empresa'];
                
                
                header("Location: ../Vista/iuGrupoEmpresa.php?a=$codigo_grupoEmpresa&u=$idusuario");
                break;
            
        }
        
    }
}

?>

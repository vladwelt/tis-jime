<?php
session_start();
if (!$_SESSION['id_usuario']) {
     header("Location: ../Vista/iuIngresar.php");
} else {
    if ($_SESSION['rol'] != 1) {
        session_destroy();
         header("Location: ../Vista/iuIngresar.php");
    }
}
?>
<!DOCTYPE html >
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>REGISTRAR</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="css/administrador.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="imagenes/favicon.ico">
        <link rel="stylesheet" href="css/foundation.css" />
        <link rel="stylesheet" href="css/campos_correctos.css"/>
        <script src="js/modernizr.js"></script>
    </head>

    <body id="body">
        <div id="principal">

            <header id="cabecera"><img src="imagenes/encabezado_logo.jpg" width="50%" height="200" alt="cabecera1" /><img src="imagenes/encabezado2.jpg" width="50%" height="200" alt="encabezado2" /></header>
            <article id="contenido"> 
                <nav id="menu_administrador" >
                    <a href="iuAdminCuentasConsultores.php"><img width="100%" height="48" src="imagenes/btn_admin_consultores.png"/></a>
                    <a href="iuAdminCuentasEmpresas.php"><img width="100%" height="48" src="imagenes/btn_admin_empresas.png"/></a>
                    <a href="iuRegistroConsultor.php"><img width="100%" height="48" src="imagenes/btn_crearCuenta.png"/></a>
                    <a href='../Controlador/ControladorFinalizarSesion.php'><img src='imagenes/btn_cerrarSesion.png' width='100%' height='46' /></a>
                </nav>
                <section id="contenido_administrador">
                    <form action="../Controlador/ControladorRegistroConsultor.php" method="post" enctype="multipart/form-data" name="registro_consultor" id="form2">
                        <h2>Registro Consultor</h2>
                        <fieldset>
                            <legend>Datos de Cuenta</legend>
                            <table width="383" border="0">
                                <tr>
                                    <td width="127" align="right">Usuario:</td>
                                    <td width="168"><input type="text" name="usuario_consultor" id="usuario_consultor"  autofocus /></td>
                                </tr>
                                <tr>
                                    <td align="right">Contraseña:</td>
                                    <td><input type="password" name="contraseña_consultor1" id="contraseña_consultor1"   /></td>
                                </tr>
                                <tr>
                                    <td align="right">Repita la Contraseña:</td>
                                    <td><input type="password" name="contraseña_consultor2" id="contraseña_consultor2"  /></td>
                                </tr>
                            </table>
                        </fieldset>
                        <fieldset>
                            <legend>Datos de Perfil</legend>
                            <table width="383" border="0">
                                <tr>
                                    <td width="127" align="right">Nombre Completo:</td>
                                    <td width="168"><input type="text" name="nombreCompleto_consultor" id="nombreCompleto_consultor"  /></td>
                                </tr>
                                <tr>
                                    <td align="right">Correo electrónico:</td>
                                    <td><input type="email" name="correo_consultor" id="correo_consultor"  /></td>
                                </tr>
                                <tr>
                                    <td align="right">Teléfono:</td>
                                    <td><input type="tel" name="telefono_consultor" id="telefono_consultor"/></td>
                                </tr>
                            </table>
                        </fieldset>
                        <input type="submit" name="btn_registrar" id="btn_registrar" value="Registrar" /><a href="iuAdminCuentas.php"><input type="button" name="btn_cancelar" id="btn_cancelar" value="Cancelar" /></a>
                    </form>
                </section>
            </article>
            <footer id="pie">
                <p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleón Software </p>
            </footer>


        </div>
        <script src="js/jquery.js"></script>
        <script src="js/foundation.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src='js/validar.js'></script>
        <script> $(document).foundation();</script>
    </body>
</html>

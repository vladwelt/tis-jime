<?php
session_start();
if (!$_SESSION['id_usuario']) {
    header("Location: ../Vista/iuIngresar.php");
} else {
    if ($_SESSION['rol'] != 3) {
        if ($_SESSION['rol'] != 4) {
            session_destroy();
            header("Location: ../Vista/iuIngresar.php");
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Grupo-Empresa</title>
        <link rel="shortcut icon" href="imagenes/favicon.ico" />
        <link href="css/grupo_empresa_registrar_socio.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="css/foundation.css" />
        <link rel="stylesheet" href="css/campos_correctos.css"/>
        <script src="js/modernizr.js"></script>

    </head>

    <body id="body">
        <div id="principal_grupo_empresa">
            <header id="cabecera_grupo_empresa"><img src="imagenes/encabezado_logo.jpg" width="50%" height="200" alt="cabecera1" /><img src="imagenes/encabezado2.jpg" width="50%" height="200" alt="cabecera2" /></header>
            <article id="contenido_usuarios">
                <?php
                $a;
                $a = $_GET['a'];

                echo "<nav id='menu_grupo_empresa'>
                            <a href='iu.propuestaDePago.php?a=$a'><img width='100%' height='48' src='imagenes/btn_planDePagos.jpg'/></a>
                            <a href='iu.mostrarPlanDePago.php?a=$a'><img width='100%' height='48' src='imagenes/btn_verPlanDePagos.jpg'/></a>    
                            <a href='../Vista/iuDiaReunionGE.php?a=$a'><img src='imagenes/btn_diaDeReunion.jpg' width='100%' height='46' alt='btn_1' /></a>
                            <a href='../Vista/iuCalendarioGrupoEmpresa.php?a=$a'><img src='imagenes/btn_calendario.jpg' width='100%' height='46' alt='btn_1' /></a>
                            <a href='../Vista/iuGrupoEmpresa.php?a=$a'><img src='imagenes/btn_volverMiPagina.jpg' width='100%' height='46' alt='btn_1' /></a>  
                                <a href='../Vista/iuGrupoEmpresaRegistrarSocio.php?a=$a'><img src='imagenes/btn_registrarSocio.jpg' width='100%' height='46' alt='btn_1' /></a>
                      </nav>"
                ?>
                <div id="noticias_grupoEmpresa">
                    <section id="registrar">
                        <fieldset>
                            <legend>Registrar Socio</legend>
                            <form action="../Controlador/ControladorRegistrarSocio.php" method="post"> 
                                <table id="tabla_formulario_registro">
                                    <tr>
                                        <td align="right" id="nombre_usuario">Nombre de usuario:</td>
                                        <td ><input title="Se necesita un nombre de usuario" type="text" name="nombre_usuario" id="nombre_usuario_registro" placeholder="nombre de usuario" pattern="[a-zA-Z]" autocomplete="" required /></td>
                                    </tr>
                                    <tr>
                                        <td align="right" id="nombre">Nombre:</td>
                                        <td ><input title="Se necesita un nombre" type="text" name="nombre" id="nombre_registro" placeholder="nombre" pattern="[a-zA-Zñáéíóú ]+[a-zA-Zñáéíóú ]" autocomplete="" required /></td>
                                    </tr>
                                    <tr>
                                        <td align="right" id="apellido">Apellidos:</td>
                                        <td ><input title="Se necesita un apellido" type="text" name="apellido" id="apellido_registro" placeholder="apellidos" pattern="[a-zA-Zñáéíóú ]+[a-zA-Zñáéíóú ]"  required /></td>
                                    </tr>
                                    <tr>
                                        <td align="right" id="estado_civil">Estado civil: </td>
                                        <td> 

                                            <select name="combo_estado_civil" id="combo_estado_civil" width="15 px">
                                                <option value="soltero">Soltero(a)</option>
                                                <option value="casado">Casado(a)      </option>
                                                <option value="divorciado">Divorsiado(a)              </option>
                                                <option value="viudo">Viudo(a)</option>
                                            </select>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" id="direccion">Dirección:</td>
                                        <td ><input title="Se necesita una dirección" type="text" name="direccion" id="direccion_registro" o placeholder="dirección" pattern="[a-zA-Z0-9]+"  required /></td>
                                    </tr>  
                                    <tr>
                                        <td align="right" id="profesion">Profesión:</td>
                                        <td ><input title="Se necesita una profesión" type="text" name="profesion" id="profesion_registro" placeholder="profesión" pattern="[a-zA-Z]+"  required /></td>
                                    </tr>
                                    <tr>
                                        <td align="right" id="correo">Correo electrónico:</td>
                                        <td ><input title="Se necesita una direccón de correo electrónico" type="email" name="correo" id="correo_registro" placeholder="correo electrónico"  required /></td>
                                    </tr>
                                    <tr>
                                        <td align="right" id="clave">Contraseña: </td>
                                        <td><input title="Se necesita una contraseña" type="password" name="clave" id="clave_registro" placeholder="contraseña"  required /></td>
                                    </tr>
                                    <tr>
                                        <td align="right" id="clave_repetida">Repita contraseña: </td>
                                        <td><input title="Repita su contraseña" type="password" name="claveRepetida" id="clave_repetida_registro" placeholder="repita su contraseña"  required /></td>
                                    </tr>

                                </table>
                        </fieldset>
                        <input type="submit" id='btn_registrar' name="registrar" value="Registrar" /><a href="iuGrupoEmpresa.php"><input type='button'id='btn_cancelar' value="Cancelar"></a></td>


                        </form>

                    </section>
                </div>   
            </article>
            <footer id="pie_grupo_empresa"><p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleon Software </p></footer>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/foundation.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="js/validador.js"></script>
        <script>
            $(document).foundation();
        </script>
    </body>
</html>

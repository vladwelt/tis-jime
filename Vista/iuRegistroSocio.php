<?php
session_start();
if (!$_SESSION['id_usuario']) {
    header("Location: ../Vista/iuIngresar.php");
} else {
    if ($_SESSION['rol'] != 3) {
        session_destroy();
        header("Location: ../Vista/iuIngresar.php");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Registro-Socio</title>
        <link rel="shortcut icon" href="imagenes/favicon.ico" />
        <link href="css/registroSocio.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="css/foundation.css" />
        <link rel="stylesheet" href="css/campos_correctos.css"/>
        <script src="js/modernizr.js"></script>
    </head>

    <body id="body">
        <div id="principal_grupo_empresa">
            <header id="cabecera_grupo_empresa"><img src="imagenes/encabezado_logo.jpg" width="50%" height="200" alt="cabecera1" /><img src="imagenes/encabezado2.jpg" width="50%" height="200" alt="cabecera2" /></header>
            <article id="contenido_usuarios">
                <?php
                $a = $_GET['a']; // $a -> codigo grupo empresa
                $u = $_GET['u']; //$u -> codigo usuario grupo empresa
                echo "<nav id='menu_grupo_empresa'>"
                . "<a href='iu.propuestaDePago.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_planDePagos.jpg'/></a>
                                    <a href='iu.mostrarPlanDePago.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_verPlanDePagos.jpg'/></a>    
                                    <a href='iu.foroGrupoEmpresa.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_foro.jpg'/></a>
                                    <a href='../Vista/iuDiaReunionGE.php?a=$a&u=$u'><img src='imagenes/btn_diaDeReunion.jpg' width='100%' height='46' alt='btn_1' /></a>
                                    <a href='../Vista/iuCalendarioGrupoEmpresa.php?a=$a&u=$u'><img src='imagenes/btn_calendario.jpg' width='100%' height='46' alt='btn_1' /></a>
                                    <a href='../Vista/iuRecursosGrupoEmpresa.php?a=$a&u=$u'><img src='imagenes/btn_recursos.jpg' width='100%' height='46' alt='btn_1' /></a>
                                    <a href='../Vista/iuGrupoEmpresa.php?a=$a&u=$u'><img src='imagenes/btn_volverMiPagina.jpg' width='100%' height='46' alt='btn_1' /></a>
                                    <a href='../Vista/iuRegistroSocio.php?a=$a&u=$u'><img src='imagenes/btn_registrarSocio.jpg' width='100%' height='46' alt='btn_1' /></a>
                                    <a href='../Controlador/ControladorFinalizarSesion.php'><img src='imagenes/btn_cerrarSesion.png' width='100%' height='46' alt='btn_1' /></a>
                                    </nav>";
                ?>
                <div id="registro_socio">
                    <section id="registrar">
                        <?php
                        if(isset($_GET['m'])){
                           echo" <H3><span style='color:#867979'>Registro existoso</span>  </H3>";
                        }
                        else{
                        echo "<form action='../Controlador/ControladorRegistroSocio.php?a=$a&u=$u' method='post'>";
                             echo $formulario="<fieldset id='datos_cuenta_socio'>
                            <legend id='datos_usuario_socio'>Datos de la Cuenta</legend>
                            <table width='370' border='0'>
                                <tr>
                                    <td width='127' align='right'>Usuario:</td>
                                    <td width='168'><input  type='text' name='nombre_usuario' id='nombre_usuario' autofocus /></td>

                                </tr>
                                <tr>
                                    <td align='right'>Contraseña:</td>
                                    <td><input type='password' name='contraseña_usuario1' id='contraseña_usuario1' /></td>
                                </tr>
                                <tr>
                                    <td align='right'>Repita la Contraseña:</td>
                                    <td><input type='password' name='contraseña_usuario2' id='contraseña_usuario2'  /></td>
                                </tr>
                            </table>
                        </fieldset>
                        <fieldset id='datos_perfil_socio'>
                            <legend>Datos de perfil</legend>
                            <table width='460' border='0' id='tabla_datos_perfil'>
                                <tr>
                                    <td width='127' align='right'>Nombre:</td>
                                    <td width='168'><input type='text' name='nombre_socio' id='nombre_socio' /></td>
                                </tr>
                                <tr>
                                    <td align='right'>Apellidos:</td>
                                    <td><input type='text' name='apellidos_socio' id='apellidos_socio' /></td>
                                </tr>

                                <tr>
                                    <td align='right'>Correo electrónico:</td>
                                    <td><input type='email' name='correo_socio' id='correo_socio' /></td>
                                </tr>

                                <tr>
                                    <td align='right'>Direccion:</td>
                                    <td><input type='text' name='direccion_socio' id='direccion_socio' /></td>
                                </tr>
                                <tr>
                                    <td align='right'>Profesion:</td>
                                    <td><input type='tel' name='profesion_socio' id='profesion_socio' /></td>
                                </tr>
                                <tr>
                                    <td align='right' id='estado_civil'>Estado civil: </td>
                                    <td> 
                                        <select name='combo_estado_civil' id='combo_estado_civil' >
                                            <option value='soltero'>Soltero(a)</option>
                                            <option value='casado'>Casado(a)      </option>
                                            <option value='divorciado'>Divorsiado(a)              </option>
                                            <option value='viudo'>Viudo(a)</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td align='right' id='estado_civil'>Cargo: </td>
                                    <td> 
                                        <select name='combo_cargo' id='combo_cargo' >";
                                            
                                            echo "<option value='2'>Socio regular</option>";

                                            require '../Controlador/ControladorComboCargo.php';
                                            echo existeRepresentanteLegal($a);
                                            
echo "
                                        </select>
                                    </td>
                                </tr>

                            </table>
                        </fieldset>";
                        
                        echo "<input type='submit' id='btn_registrar' name='registrar' value='Registrar' /><a href='../Vista/iuGrupoEmpresa.php?a=$a&u=$u'><input type='button'id='btn_cancelar' value='Cancelar'></a></td>";
                        
                                        }
                                        ?>
                        </form>

                    </section>
                </div>   
            </article>
            <footer id="pie_grupo_empresa"><p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleon Software </p></footer>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/foundation.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src='js/validar.js'></script>
        <script> $(document).foundation();</script>
    </body>
</html>

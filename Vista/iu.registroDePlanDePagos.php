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
<title>GRUPO-EMPRESA</title>
<link href="css/grupo_empresa_2.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="imagenes/favicon.ico"/>
<link href="js/custom-theme/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css" />
<link href="js/custom-theme/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/jquery-ui-1.8.20.js"></script>

<script>
    $(document).ready(function(){
        $( "#fecha_pago" ).datepicker({ dateFormat: "yy/mm/dd", minDate: '0' });
        var endingDate = $(this).attr('endingDate');
    });
</script>
</head>

<body id="body">
<div id="principal_grupoEmpresa">
    <header id="cabecera_grupoEmpresa"><img src="imagenes/encabezado_logo.jpg" width="50%" height="200" alt="cabecera1" /><img src="imagenes/encabezado2.jpg" width="50%" height="200" alt="cabecera2" /></header>
    <article id="contenido_grupoEmpresa">
                <?php
                $a = $_GET['a'];
                $u = $_GET['u'];
                echo "<nav id='menu_grupoEmpresa'>
                            <a title='PORFAVOR DEBE TERMINAR DE REGISTRAR EL FORMULARIO PLAN DE PAGOS'><img width='100%' height='48' src='imagenes/btn_planDePagos.jpg'/></a>
                            <a title='PORFAVOR DEBE TERMINAR DE REGISTRAR EL FORMULARIO PLAN DE PAGOS'><img width='100%' height='48' src='imagenes/btn_verPlanDePagos.jpg'/></a>    
                            <a title='PORFAVOR DEBE TERMINAR DE REGISTRAR EL FORMULARIO PLAN DE PAGOS'><img width='100%' height='48' src='imagenes/btn_foro.jpg'/></a>
                            <a title='PORFAVOR DEBE TERMINAR DE REGISTRAR EL FORMULARIO PLAN DE PAGOS'><img src='imagenes/btn_diaDeReunion.jpg' width='100%' height='46' alt='btn_1' /></a>
                            <a title='PORFAVOR DEBE TERMINAR DE REGISTRAR EL FORMULARIO PLAN DE PAGOS'><img src='imagenes/btn_calendario.jpg' width='100%' height='46' alt='btn_1' /></a>
                            <a title='PORFAVOR DEBE TERMINAR DE REGISTRAR EL FORMULARIO PLAN DE PAGOS'><img src='imagenes/btn_volverMiPagina.jpg' width='100%' height='46' alt='btn_1' /></a>
                            <a title='PORFAVOR DEBE TERMINAR DE REGISTRAR EL FORMULARIO PLAN DE PAGOS'><img src='imagenes/btn_cerrarSesion.png' width='100%' height='46' alt='btn_1' /></a>
                      </nav>"
                ?>
    <div id="noticias_grupoEmpresa">
        <fieldset id="fieldsetForo" > 
        <legend>Formulario Plan De Pagos</legend>
         <?php if(isset($_REQUEST['AVI'])){ ?> 
            <?php 
            echo "<form action='../Controlador/ControladorPropuestaPlanDePago.php?2&a=$a&u=$u' method='post'>"; 
            ?>
            <h2>Registro Plan de Pagos</h2>
            <table width="100%" border="2" cellspacing="2" cellpadding="2">
                <tr>
                    <td>
                        <table width="400" border="2">
                            <tr>
                                <td align="right"><Strong>Hito o Evento :</strong></td>
                               <td width="130"><input type="text" name="hito_evento" id="hito_evento"  required /></td>    
                                </tr>
                            <tr>
                                <td align="right"><Strong>Porcentaje de Pago :</strong></td>
                                <td width="130"><input type="text" name="porcentaje_pago" id="porcentaje_pago" required title="{10, 25.5, 100,}" pattern="[0-9.]+"/><strong> (%)</strong></td>
                               </tr>
                            <tr>
                                <td align="right"><strong>Fecha de Pago :</strong></td>
                                <td width="130"><input type="text" name="fecha_pago" id="fecha_pago" placeholder="Seleccione una fecha" required /></td>
                               </tr>
                            <tr>
                                <td width="130"><input name="codPlan_pago" value="<?=$_GET['c_p'];?>" type="hidden"></td>
                            </tr>   
                        </table>
                    </td>
                    <td>    
                        <table width="270" border="2">
                            <tr>
                                <td align="center"><strong>Monto Restante :</strong></td>         
                            </tr>
                            <tr>
                                <td width="100" align="center"><input value="<?=$_GET['m_t'];?>" type="text" name="monto_total" id="monto_total" readonly="readonly"/><strong> (Bolivianos)</strong></td>  
                            </tr>
                            <tr>
                                <td align="center"><strong>Porcentaje Restante :</strong></td>         
                            </tr>
                            <tr>
                                <td width="100" align="center"><input size="3" value="<?=$_GET['p_r'];?>" type="text" name="porcentaje_restante" id="porcentaje_satisfaccion" readonly="readonly"/><strong> (%)</strong></td>  
                            </tr>
                        </table>
                    </td> 
                </tr>
                <tr>
                <?php 
                if ($_GET['m_t']!=0){
                ?>    
                <td width='20'>
                    <label>
                        <input type='submit' name='btn_registroPago' id='btn_registroHitoEvento' value='Añadir Hito Evento' />
                    </label>
                </td>
                <?php
                }else if ($_GET['m_t']==0) {
                    $c_ge=$_GET['a'];
                    $c_uge=$_GET['u'];
                    $c_p=$_GET['c_p'];
           echo "<td width='60' >"
                  ."<a href='../Controlador/ControladorPropuestaPlanDePago.php?insert&a=$c_ge&u=$c_uge&c_p=$c_p'><strong>Terminar plan de Pagos</strong></a>"
               ."</td>";
                 }   
                 ?>
                </tr>
            </table>
        </form>
        <?php }?>
        
        <?php
        if(isset($_REQUEST['c_h'])){
            $hito_evento = $_GET['h_e'];
            $porcentaje_pago = $_GET['p_p'];
            $fecha_pago = $_GET['f_p'];
            
            echo "<table bgcolor=#C6E1E1 border='0'>"
                    ."<tr>"
                        ."<td><Strong>Hito o Evento :</strong></td>"
                        ."<td> $hito_evento</td>"
                    ."</tr>"
                    ."<tr>"
                        ."<td><Strong>Porcentaje de Pago :</strong></td>"
                        ."<td> $porcentaje_pago</td>"
                    ."</tr>"
                    ."<tr>"
                        ."<td><strong>Fecha de Pago :</strong></td>"
                        ."<td> $fecha_pago</td>"
                    ."</tr>"
                ."</table>";
        
        ?>
        <br />
        <?php
                if(isset($_REQUEST['tabla'])){
                    $codplan_papo=$_GET['c_p'];
                    $cod_hito = $_GET['c_h'];
                    $cod_ge=$_GET['a'];
                    $cod_usuarioGE=$_GET['u'];
                    $montoT=$_GET['m_t'];
                    $porcentajeR=$_GET['p_r'];
                    echo"<fieldset id='fieldsetForo' >" 
                       ."<legend>Entregables</legend>";
                    echo"<form name'f' action='../Controlador/ContriladorMostrarPlanDePago.php' method='post'>"
                            ."<table align='center' width='50%' border='2' cellspacing='2' cellpadding='2' bgcolor=#C6E1E1>"
                                ."<thead>"
                                    ."<tbody  style='font:  1.1em/1.1em 'FB Armada' arial'>"
                                    ."<tr><th>Entregables</th><th>Eliminar</th></tr>";
                                        require '../Controlador/ControladorMostrarEntregables.php';
                                        $lista = mostrarPlanPagoEntregables($codplan_papo,$cod_hito,$cod_ge,$cod_usuarioGE,$montoT,$porcentajeR,$hito_evento,$porcentaje_pago,$fecha_pago);
                                        $contador = 0;
                                        while ($contador <= sizeof($lista)-1){?>
                                                <tr>
                                                    <td><?php echo $lista[$contador]?></td>
                                                    <td><?php echo $lista[$contador+1]?></td>
                                        <?php  
                                        $contador=$contador+2;
                                        }
                    echo            "</tbody>"
                                ."</thead>"
                            ."</table>"
                       ."</form>"
                       ."</fieldset>";
                    
                }else {
                    echo"<input size='112xp' type='text' style='background-color:#6B2C37; color: #FFFFFF; border:2px solid #6B2C37' value=' REGISTRE LOS ENTREGABLES DEL HITO O EVENTO : $hito_evento ' readonly='readonly' />";
                }
                ?>
       <br /> 
       
            <?php
            //if($_GET){
                
                $c_h = $_GET['c_h'];
                $c_p =$_GET['c_p'];
                $m_t=$_GET['m_t'];
                $p_r=$_GET['p_r'];

            echo "<form action='../Controlador/ControladorRegistroEntregables.php?2&a=$a&u=$u&c_h=$c_h&c_p=$c_p&m_t=$m_t&p_r=$p_r&hito=$hito_evento&porpa=$porcentaje_pago&fepa=$fecha_pago' method='post'>"; 
            
            echo "<table width='100%' border='2' cellspacing='2' cellpadding='2'>"   
                        ."<tr>"
                            ."<td width='30%' align='right'><strong>Entregable :</strong></td>"
                            ."<td><textarea name='entregable' cols='64%' rows='1%' required></textarea></td>"
                        ."</tr>"
                        ."<tr>"
                            ."<td width='20'>"
                                ."<label>"
                                    ."<input  type='submit' name='btn_registroEntregable' id='btn_registroEntregable' value='Añadir Entregable' />"
                                ."</label>"
                            ."</td>";
                    if(isset($_REQUEST['TR'])){
            echo             "<td width='20'>"
                                ." <a href='iu.registroDePlanDePagos.php?AVI&a=$a&u=$u&m_t=$m_t&p_r=$p_r&c_p=$c_p'><strong>Terminar Registro</strong></a>"
                            ."</td>"; }
            echo         "</tr>"                   
                ."</table>"
                ."</form>";
        }?>    
      
 </fieldset>
    </div>
    </article>
    <footer id="pie_grupoEmpresa"><p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleon Software </p></footer>
</div>
</body>
</html>
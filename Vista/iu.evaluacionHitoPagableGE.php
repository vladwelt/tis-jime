<?php
session_start();
if (!$_SESSION['id_usuario']) {
    header("Location: ../Vista/iuIngresar.php");
} else {
    if ($_SESSION['rol'] != 2) {
        session_destroy();
        header("Location: ../Vista/iuIngresar.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CONSULTOR</title>
<link href="css/consultorVistaGE.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="imagenes/favicon.ico"/>
</head>

<body id="body">
<div id="principal_consultor_vistaGE">
    <header id="cabecera_consultor_vistaGE"><img src="imagenes/encabezado_logo.jpg" width="50%" height="200" alt="cabecera1" /><img src="imagenes/encabezado2.jpg" width="50%" height="200" alt="cabecera2" /></header>
    <article id="contenido_consultor_vistaGE">
       <?php
       $codGE=$_GET['c_a'];//codigo grupo empresa
       $codUGE=$_GET['i_u'];//codigo usuario grupo empresa
       $codC=$_GET['a'];//codigo consultor
       $codUC=$_GET['u'];//codigo usuario consultor
            echo "<nav id='menu_consultor_vistaGE'>"
                    ."<a title='PORFAVOR DEBE TERMINAR DE REGISTRAR LA EVALUACION DEL HITO O EVETO'><img width='100%' height='48' src='imagenes/btn_generarContrato.jpg'/></a>"
                    ."<a title='PORFAVOR DEBE TERMINAR DE REGISTRAR LA EVALUACION DEL HITO O EVETO'><img width='100%' height='48' src='imagenes/btn_verPlanDePagos.jpg'/></a>"     
                    ."<a title='PORFAVOR DEBE TERMINAR DE REGISTRAR LA EVALUACION DEL HITO O EVETO'><img width='100%' height='48' src='imagenes/btn_verEvaluacionPlanDePagos.jpg'/></a>"     
                    ."<a title='PORFAVOR DEBE TERMINAR DE REGISTRAR LA EVALUACION DEL HITO O EVETO'><img width='100%' height='48' src='imagenes/btn_listaEmpresas.jpg'/></a>"
                    ."<a title='PORFAVOR DEBE TERMINAR DE REGISTRAR LA EVALUACION DEL HITO O EVETO'><img src='imagenes/btn_calendario_docenteGE.jpg' width='100%' height='48' alt='btn_1' /></a>"
                    ."<a title='PORFAVOR DEBE TERMINAR DE REGISTRAR LA EVALUACION DEL HITO O EVETO'><img src='imagenes/btn_evaluacion_final.jpg' width='100%' height='48' alt='btn_1' /></a>"
                    ."<a title='PORFAVOR DEBE TERMINAR DE REGISTRAR LA EVALUACION DEL HITO O EVETO'><img src='imagenes/btn_cerrarSesion.png' width='100%' height='46' /></a>"
                ."</nav>";
        ?>
        <div id="campoBlanco_consultor_vistaGE">
            <fieldset id="fieldsetForo"> 
            <legend>Evaluacion Plan de Pagos</legend>
            <?php
            $codHE=$_GET['c_h'];
            $nombreHE=$_GET['n_h'];
            $codPlanP = $_GET['c_p'];
      echo" <form name='formulario' action='../Controlador/ContoladorRegistroEvaluacionHitoPagable.php?a=$codC&u=$codUC&c_a=$codGE&i_u=$codUGE&c_h=$codHE&n_h=$nombreHE&c_p=$codPlanP' method='post'>"
            ?>
                <table width="96%" border="2" cellspacing="2" cellpadding="2">
                    <tr>
                        <td width="30%" align="right"><strong>Hito o Evento :</strong></td>
                        <td><input type="text" name="hitoEvento" value="<?=$_GET['n_h'];?>" readonly="readonly"></td>
                    </tr>
                    <tr>
                        <td width="30%" align="right"><strong>Entregables :</strong></td>
                        <td><table border="2" cellspacing="2" cellpadding="2">
                            <?php
                                $codHito=$_GET['c_h'];
                               require '../Controlador/ControladorEvaluacionHitoPagableGE.php';
                                        $lista = mostrarEntregables($codHito);
                                        foreach($lista as $post):?>
                                            <tr>
                                            <td><?php echo "- ".$post?></td>
                                            </tr>        
                                        <?php endforeach;
                            ?> 
                            </table></td>
                    </tr>
                    <tr>
                        <td width="30%" align="right"><strong>Monto De Pago :</strong></td>
                        <td><input type="text" name="monto_pago" value="<?=$_GET['monto'];?>" readonly="readonly"> <strong> (Bolivianos)</strong></td>
                    </tr>
                    <tr>
                        <td width="30%" align="right"><strong>Porcentaje de Satisfaccion :</strong></td>
                        <td><input type="text" name="porcentajeSatisfaccion" value="<?=$_GET['p_s'];?>" readonly="readonly"> <strong> (%)</strong></td>
                    </tr>
                    <tr>
                        <td width="30%" align="right"><strong>Porcentaje Alcazado Total :</strong></td>
                        <td><input type="text" name="porcentajeAlcanzado" required pattern='[0-9.]+'> <strong> (%)</strong></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center" ><input  type="submit" name="Submit" value="Terminar"></td>
                    </tr>
                </table>
           
           </form>
            <?php
            $nombreH=$_GET['n_h'];
                if(isset($_REQUEST['tabla'])){
                    //$codE = $_GET['codE'];
                    //$cod_ge=$_GET['a'];
                    echo"<fieldset id='fieldsetForo' width='90%'>" 
                       ."<legend>Registro de los Entregables</legend>";
                    echo"<form name'f' action='../Controlador/ContriladorMostrarPlanDePago.php' method='post'>"
                            ."<table align='center' border='2' cellspacing='2' cellpadding='2' width='70%' bgcolor=#C6E1E1>"
                                ."<thead>"
                                    ."<tbody align='center' style='font:  1.1em/1.1em 'FB Armada' arial'>"
                                    ."<tr>
                                        <th>Entregables</th>
                                        <th>porcentaje</th>
                                        <th>Alcance</th>
                                        <th>Suma Del Alcance</th>
                                      </tr>";
                                        include ("Otros/EvaluacionHitosGE/".$codHito."_".$nombreH.".data");
                    //echo             "<tr>"
                    //                    ."<th>Suma Total</th>"
                    //                    ."<th>100</th>"
                    //                    ."<th>100</th>"    
                    //                ."</tr>"   ;  
                    echo            "</tbody>"
                                ."</thead>"
                            ."</table>"
                       ."</form>"
                       ."</fieldset>";
                }?>
            <br>
            <?php
            $codPPago = $_GET['c_p'];
            $monto=$_GET['monto'];
            $p_s=$_GET['p_s'];
           // echo"
           // <form name='formulario' action='../Controlador/ControladorEvaluacionHitoPagableGE.php?registarEPPGE&codGE=$codGE&codH=$codHito&nombreH=$nombreH&monto=$monto&p_s=$p_s' method='post'>";
            $estado = mostaraEstadoTablaRegistros();
            if ($estado == "basio") {
                echo ' <strong>"A TERMINADO LA EVALUACION" Registre el Procentaje alacanzado total</strong> ';
            }else if ($estado == "lleno") {
            ?>
                <table  width="80%" border="2" cellspacing="2" cellpadding="2" >
                    <thead>
                    <tr>
                        <th width='40%' align="center">Entregables</th>
                        <th width='5%' align="center">Porcentaje (%)</th>
                        <th width='5%' align="center">Alcansado (%)</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    
                        <?php
                        if (isset($_REQUEST['mensajeEVA'])) {
                            echo '<strong>ERROR: "</strong>El <strong>Porcentaje Alcanzado</strong> tiene que ser menor o igual al <strong>Porcentaje</strong> establesido por la grupo empresa<strong>"</strong>';
                            echo"<br>";
                        }
                        if(isset($_REQUEST['tablaEvaluacion'])){
                            require_once '../Controlador/ControladorEvaluacionHitoPagableGE.php';    
                        $nuevaLista= mostrarRegistrosEtregables($codHito);
                        $con=0;
                        foreach($nuevaLista as $post):
                        echo"<form name='formulario' action='../Controlador/ControladorEvaluacionHitoPagableGE.php?registarEPPGE&true&a=$codC&u=$codUC&c_a=$codGE&i_u=$codUGE&c_h=$codHito&n_h=$nombreH&monto=$monto&p_s=$p_s&c_p=$codPPago' method='post'>
                            <tr>"
                                ."<td ><input size='70%' name='entregable' value='$post' readonly='readonly'></td>"
                                ."<td ><input size='8%' name='porcentaje' required pattern='[0-9.]+'></td>"
                                ."<td ><input size='8%' name='porcentajeAlcansado' required pattern='[0-9.]+'></td>"
                                ."<td width='5%'><input size='6%' type='submit' name='Submit' value='Guardar$con'></td>"
                            ."</tr>
                             </form>" ;
                        $con=$con+1;
                        endforeach;
                        }?>
                        
                        <?php
                        
                          if(isset($_REQUEST['tablaEvaluacionNueva'])){
                            $listaNueva= retornarRegistro($codHito);
                            $con=0;
                            foreach($listaNueva as $post):
                            echo"<form name='formulario' action='../Controlador/ControladorEvaluacionHitoPagableGE.php?registarEPPGE&true&contador=$con&a=$codC&u=$codUC&c_a=$codGE&i_u=$codUGE&c_h=$codHito&n_h=$nombreH&monto=$monto&p_s=$p_s&c_p=$codPPago' method='post'>
                                <tr>"
                                    ."<td ><input size='70%' name='entregable' value='$post' readonly='readonly'></td>"
                                    ."<td ><input size='8%' name='porcentaje' required pattern='[0-9.]+'></td>"
                                    ."<td ><input size='8%' name='porcentajeAlcansado' required pattern='[0-9.]+'></td>"
                                    ."<td width='5%'><input size='6%' type='submit' name='Submit' value='Guardar$con'></td>"
                                ."</tr>
                                </form>" ;
                            $con=$con+1;
                            endforeach;
                         }
                        }?> 
                    </tbody>
                </table>
            </fieldset>
        </div> 
    </article>
    <footer id="pie_consultor_vistaGE"><p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleon Software </p></footer>
</div>
</body>
</html>
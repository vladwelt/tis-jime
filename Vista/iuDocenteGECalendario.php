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
<title>CALENDARIO</title>
<link href="css/calendario_grupoempresa.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="imagenes/favicon.ico"/>
<link href="calendar.min.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/calendarDocenteGE.min.js"></script>
</head>

<body id="body">
<div id="principal_calendarioGE">
    <header id="cabecera_calendario"><img src="imagenes/encabezado_logo.jpg" width="50%" height="200" alt="cabecera1" /><img src="imagenes/encabezado2.jpg" width="50%" height="200" alt="cabecera2" /></header>
    <article id="contenido_usuarios">
      <?php
        $codGE=$_GET['c_a']; //codigo de la grupo empresa
       $codUGE=$_GET['i_u']; // codigo de usuario de la grupo empresa
       $a=$_GET['a'];// $a -> codigo del consultor
       $u=$_GET['u'];// $u -> codigo de usuario del consultor
      echo "<div id='menu_grupoEmpresa'>"
        ."<a href='../Controlador/ControladorContrato.php?a=$a&u=$u&c_a=$codGE&i_u=$codUGE'><img width='100%' height='48' src='imagenes/btn_generarContrato.jpg'/></a>"
                    ."<a href='iu.mostrarPlanDePagosGE.php?a=$a&u=$u&c_a=$codGE&i_u=$codUGE'><img width='100%' height='48' src='imagenes/btn_verPlanDePagos.jpg'/></a>"     
                    ."<a href='iu.estadoDeEvaluacionPlanDePagos.php?a=$a&u=$u&c_a=$codGE&i_u=$codUGE'><img width='100%' height='48' src='imagenes/btn_verEvaluacionPlanDePagos.jpg'/></a>"     
                    ."<a href='iuListaEmpresas.php?a=$a&u=$u'><img width='100%' height='48' src='imagenes/btn_listaEmpresas.jpg'/></a>"
                    . "<a href='../Vista/iuDocenteGECalendario.php?a=$a&u=$u&c_a=$codGE&i_u=$codUGE'><img src='imagenes/btn_calendario_docenteGE.jpg' width='100%' height='48' alt='btn_1' /></a>"
                        . "<a href='../Vista/iuTablaCriteriosEvaluacion.php?a=$a&u=$u&c_a=$codGE&i_u=$codUGE'><img src='imagenes/btn_evaluacion_final.jpg' width='100%' height='48' alt='btn_1' /></a>"
                    ."<a href='../Controlador/ControladorFinalizarSesion.php'><img src='imagenes/btn_cerrarSesion.png' width='100%' height='46' /></a>";
      ?>
        </div>
        <div id="noticias_grupoEmpresa">
        
      <div id="calendario_seguimientoGE" class="calendar" data-color="normal">Calendario de la grupo empresa
       <?php
      require_once '../Controlador/ControladorCalendarioGrupoEmpresa.php';
                mostrar_reuniones($codGE, $codUGE);
               
                ?>
      </div>
      </div>
    <script>
	var yy;
	var calendarArray =[];
	var monthOffset = [6,7,8,9,10,11,0,1,2,3,4,5];
	var monthArray = [["ENE","enero"],["FEB","Febrero"],["MAR","Marzo"],["ABR","Abril"],["MAY","Mayo"],["JUN","Junio"],["JUL","Julio"],["AGO","Agosto"],["SEP","Septiembre"],["OCT","Octubre"],["NOV","Noviembre"],["DIC","Diciembre"]];
	var letrasArray = ["Lunes","Martes","Miercoles","Jueves","Viernes","Sabado","Domingo"];
	var dayArray = ["7","1","2","3","4","5","6"];
	$(document).ready(function() {
		$(document).on('click','.calendar-day.have-events',activateDay);
		$(document).on('click','.specific-day',activatecalendar);
		$(document).on('click','.calendar-month-view-arrow',offsetcalendar);
		$(window).resize(calendarScale);
		
	calendarSet();
		});
	</script>
      </article>
      <footer id="pie_calendario"><p>  Sistema Apoyo T.I.S. <br> Derechos Reservados Camaleon Software </p></footer>
</div>
</body>
</html>
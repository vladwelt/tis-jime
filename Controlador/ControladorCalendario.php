<?php
require '../Modelo/ModeloCalendarioGrupoEmpresa.php';

$numero_dia = $_POST["cbox_dias"];
echo $numero_dia;
$codigo_ge = $_GET['a'];
$u = $_GET['u'];
registrar_fechas_semanales();
header("Location: ../Vista/iuCalendarioGrupoEmpresa.php?a=$codigo_ge&u=$u");

function diaSemana($anio,$mes,$dia)
{       // 0->domingo	 | 6->sabado
	$dia= date("w",mktime(0, 0, 0, $mes, $dia, $anio));
	return $dia;
}
function registrar_fechas_semanales(){
    global $codigo_ge;
    global $numero_dia;
    $diaseleccionado = $numero_dia;
    $fechaInicio=strtotime("now");
    $fechaFin= strtotime(conseguir_ff_proyecto($codigo_ge));
    
    //$fechaFin=strtotime("20-07-2014");
    for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
            $di = date("d", $i);
            $me = date("m", $i);
            $an = date("y", $i);
            $diaSemana = diaSemana($an, $me, $di);
            if($diaSemana == $diaseleccionado){
                $dia_insertar = date("d/m/Y", mktime(0, 0, 0, $me, $di, $an));
                insertar_fecha($codigo_ge, $dia_insertar);
            }
        }
        marcar_dia_fijado($codigo_ge);
}

function conseguir_ff_proyecto($cod_ge) {
   return conseguir_fin_proyecto($cod_ge);
}


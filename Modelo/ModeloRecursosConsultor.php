<?php

require_once '../Modelo/ModeloGenerarDescarga.php';
require_once '../Controlador/Conexion.php';

function obtenerRecursosActividades($usuarioConsultor) {
    $res = "";
    $conec = new Conexion();
    $con = $conec->getConection();
    $divParcial = "";

    $sql1 = "        SELECT titulo,ruta, archivo
                     FROM  cons_actividad
                     where (visiblepara ='publica' or consultor_usuario_idusuario='$usuarioConsultor') and ruta!='' 
                     ORDER BY codcons_actividad DESC";
    $resultado1 = pg_query($con, $sql1);
    $divParcial = "<div class='titulos'id='recursos' ><font size='5'>Recursos&nbspde&nbspactividades</font></div>";

    while ($fila1 = pg_fetch_row($resultado1)) {
        $titulo = $fila1[0];
        $ruta = $fila1[1];
        $nombre_documento = $fila1[2];
        $divParcial = $divParcial . "
                <div class='correcto' >
                        $titulo<br/>
                        <a href='$ruta'>$nombre_documento</a><br/> 
                </div>";
    }
    pg_close();

    $rutaPublicos = '../Archivos/'.$usuarioConsultor.'/Archivos de Actividades/';
    $tituloZip = 'recursos de actividades';

if (file_exists($rutaPublicos))
{
    $rutaDescarga = generarDescarga($rutaPublicos, "../Descargas/", $tituloZip);
    
    $divParcial = $divParcial . "
                <div class='correcto' >
                       
                         $rutaDescarga
                </div>";
    $res = $divParcial;
    echo $res;
}
}

function obtenerRespuestasActividades($usuarioConsultor) {
    $res = "";
    $conec = new Conexion();
    $con = $conec->getConection();
    $divParcial = "";

    $sql1 = "SELECT titulo,codcons_actividad, fechainicio, fechafin, horainicio,horafin 
                    FROM cons_actividad 
                    where requiererespuesta='si_requiere'  
                    order by codcons_actividad desc";
    $resultado1 = pg_query($con, $sql1);
    $divParcial = "<div class='titulos'id='recursos' ><font size='5'>Respuestas&nbspde&nbspactividades</font></div>";

    $divParcial = $divParcial ."<div class='correcto' >";
    while ($fila1 = pg_fetch_row($resultado1)) {
        $titulo = $fila1[0];
        $codActividad = $fila1[1];
        $fechainicio = $fila1[2];
        $fechafin = $fila1[3];
        $horainicio = $fila1[4];
        $horafin = $fila1[5];

        $divParcial = $divParcial . "
                
                       ______________________________________________________<br/>
                       $titulo<br/>"
                . "Fecha inicio:&nbsp$fechainicio<br/>"
                . "&nbsp Fecha fin:&nbsp$fechafin <br/>
                ";

        $sql2 = "SELECT ged.nombredocumento ,ged.pathdocumentoge
                 FROM repuesta_actividad as r, ge_documento as ged
                 Where cons_actividad_codcons_actividad = '$codActividad' and ged.idge_documento = r.ge_documento_idge_documento
                 Order by codrepuesta_actividad desc ";
        $resultado2 = pg_query($con, $sql2);
        while ($fila2 = pg_fetch_row($resultado2)) {
            $nombredocumento = $fila2[0];
            $pathdocumentoge = $fila2[1];

            $divParcial = $divParcial . "
               
                        Respuesta:<br/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                     
                        <a href='$pathdocumentoge'>$nombredocumento</a><br><br/>";
        }
        
        
    }
    
    $divParcial = $divParcial . "<div/>";
    pg_close();

    $rutaPublicos = '../Archivos/'.$usuarioConsultor."/Archivos de Actividades/";
    $tituloZip = 'respuestas de actividades';

if (file_exists($rutaPublicos)) {
    $rutaDescarga = generarDescarga($rutaPublicos, "../Descargas/", $tituloZip);
    
    $divParcial = $divParcial . "
                <div class='correcto' >
                       
                         $rutaDescarga
                </div>";
    $res = $divParcial;
    echo $res;
}
}
function ArchivosGE($usuarioGE,$usuarioConsultor) {
    
    $res = "";
    $conec = new Conexion();
    $con = $conec->getConection();
    $divParcial = "";

    $sql1 = "SELECT nombredocumento, pathdocumentoge, titulo_gedocumento
             FROM ge_documento
             where grupo_empresa_usuario_idusuario ='$usuarioGE'
            order by idge_documento desc ";
    $resultado1 = pg_query($con, $sql1);
    $divParcial = "<div class='titulos'id='recursos' ><font size='5'>Recursos&nbspde&nbspactividades</font></div>";

    while ($fila1 = pg_fetch_row($resultado1)) {
        $nombredocumento = $fila1[0];
        $pathdocumentoge = $fila1[1];
        $titulo_gedocumento = $fila1[2];
        $divParcial = $divParcial . "
                <div class='correcto' >
                        $titulo_gedocumento<br/>
                        <a href='$pathdocumentoge'>$nombredocumento</a><br/> 
                </div>";
    }
    pg_close();

    $gestion=date('Y');
    $ruta = "../Archivos/".$usuarioConsultor."/Respuestas de Actividades/".$gestion."/".$usuarioGE."/";
    
    
if (file_exists($ruta)) {

    $tituloZip = 'GrupoEmpresa'.$usuarioGE;


    $rutaDescarga = generarDescarga($ruta, "../Descargas/", $tituloZip);
    
    $divParcial = $divParcial . "
                <div class='correcto' >
                       
                         $rutaDescarga
                </div>";
    $res = $divParcial;
    echo $res;
}
}
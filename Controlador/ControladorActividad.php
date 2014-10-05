<?php

require_once '../Controlador/Conexion.php';

function obtenerActividades() {
    $conexion = new Conexion();
    $conexion->getConection();
    $sql = "select codcons_actividad, visiblepara,requiererespuesta,fechainicio,fechafin,horainicio,horafin,titulo,descripcion,archivo,ruta
            from cons_actividad 
            where current_date>=fechainicio and current_date<=fechafin and current_time>=horainicio and current_time<=horafin and visiblepara = 'publica' ORDER BY fechainicio desc";
    
    
    $rows = $conexion->ejecutarSql($sql);
    for ($i = 0; $i < count($rows); $i++) {
        $row = $rows[$i];
        $codigo_actividad = $row['codcons_actividad'];
        $visible = $row['visiblepara'];
        $requiere = $row['requiererespuesta'];
        $fechaini = $row['fechainicio'];
        $fechafin = $row['fechafin'];
        $horaini = $row['horainicio'];
        $horafin = $row['horafin'];
        $titulo = $row['titulo'];
        $descripcion = $row['descripcion'];
        $ruta=$row['ruta'];
        $archivo=$row['archivo'];


        echo "<lbl3><strong>$titulo</strong></lbl3><br/>";
        echo "<lbl2><strong>$descripcion</strong></lbl2><br/>";
        echo "&nbsp;<lbl2><strong>Fecha de inicio:</strong> $fechaini</lbl2>&nbsp;<lbl2><strong>Comienza a:</strong> $horaini hrs.</lbl2><br />";
        echo "&nbsp;<lbl2><strong>Fecha de conclusion:</strong> $fechafin</lbl2> &nbsp;<lbl2><strong>Termina a:</strong> $horafin hrs.</lbl2><br />";
        
        if(!$ruta==""&&!$archivo=="")
        {
        echo "&nbsp; <a href='$ruta'>$archivo</a>&nbsp;&nbsp;";
        }
        
        if ($requiere == "si_requiere") {
            ;
        }
        
        echo "<br><lbl2>______________________________________________________________________________________________</lbl2><br/>";
    }
}



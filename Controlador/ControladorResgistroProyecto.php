<?php
require ('../Modelo/ModeloRegistroProyecto.php');
    $codC=$_GET['a'];
    $codUsuarioC=$_GET['u'];
    $nombre_proyecto = $_POST['nombre_proyecto'];
    $codigo_proyecto = $_POST['codigo_proyecto'];
    $fecha_fin_proyecto = $_POST['fecha_fin_proyecto'];
     if(verificarSiExisteCodigoDelProyecto($codigo_proyecto)){
        header("Location: ../Vista/iu.registroProyecto.php?mensaje2&cp=$codigo_proyecto&a=$codC&u=$codUsuarioC&np=$nombre_proyecto&fp=$fecha_fin_proyecto");
    }  else if (verificarSiExisteProyecto($codigo_proyecto, $nombre_proyecto, $fecha_fin_proyecto)){
        header("Location: ../Vista/iu.registroProyecto.php?mensaje1&cp=$codigo_proyecto&np=$nombre_proyecto&fp=$fecha_fin_proyecto&a=$codC&u=$codUsuarioC");
    
    } else {
        insertarProyecto($codigo_proyecto, $nombre_proyecto, $fecha_fin_proyecto);
        header("Location: ../Vista/iu.registroProyecto.php?mensaje3&cp=$codigo_proyecto&np=$nombre_proyecto&fp=$fecha_fin_proyecto&a=$codC&u=$codUsuarioC");

    }   
    
 ?>

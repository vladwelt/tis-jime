<?php
require '../Modelo/ModeloMostrarTemaConsultor.php';

function mostrarTemaAComentarConsultor($codF){
    $listaTemas = retornarTemaConsultor($codF);
return $listaTemas;    
} 


?>

<?php
require '../Modelo/ModeloMostrarTemaGrupoEmpresa.php';

function mostrarTemaAComentarGE($codF){
    $listaTemas = retornarTemaGrupoEmpresa($codF);
return $listaTemas;    
} 

?>

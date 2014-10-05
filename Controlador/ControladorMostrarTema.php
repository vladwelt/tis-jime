<?php
require '../Modelo/mostrarTema.php';

function mostrarTemaAComentar($codF){
    $listaTemas = mostrarTema($codF);
return $listaTemas;    
} 


?>

<?php
require '../Modelo/ModeloEvaluacion.php';

function mostrarTabla($cod_cons,$usr_cons, $cod_ge,$usr_ge){
   $lista =  mostrar_lista_criterios($cod_cons,$usr_cons, $cod_ge,$usr_ge);
   return $lista;
}
function mostrar_tabla_evaluados($cod_cons,$usr_cons, $cod_ge,$usr_ge){
   $lista =  mostrar_lista_criterios_evaluados($cod_cons,$usr_cons, $cod_ge,$usr_ge);
   return $lista;
}

function mostrar_nota($cod_GE) {
    $nota = suma_nota($cod_GE);
    return $nota;
}

function mostrar_tabla_registro($cod_cons, $cod_proyecto){
    mostrar_lista_registro_criterios($cod_cons, $cod_proyecto);
    require_once '../Vista/iuTablaCriteriosEvaluacion.php';
}
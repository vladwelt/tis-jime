<?php
require_once '../Modelo/ModeloGrupoEmpresa.php';
function empresa_registrada($cod_GE){
    return esta_registrado($cod_GE);
}

function mostrar_proyectos() {
    conseguir_proyectos();
}

function mostrar_docentes() {
    conseguir_docentes();
}

function mostrar_actividades($cod_us_GE,$cod_GE) {
    obtenerActividadesGE($cod_us_GE,$cod_GE);
}

?>
<?php
require '../Modelo/ModeloEvaluacion.php';

function mostrar_tipo_calificacion($id_tipo, $cod_criterio){
    if($id_tipo==1){
        echo "<input type=radio name=verdadero_falso value=verdadero>Verdadero<br>";
        echo "<input type=radio name=verdadero_falso value=falso>Falso<br>";
    }elseif ($id_tipo==2) {
        echo "<textarea name='nota' required='required'></textarea>";
    }elseif ($id_tipo==3) {
        conseguir_detalle_criterio($cod_criterio);
    }elseif ($id_tipo==4) {
        conseguir_detalle_criterio($cod_criterio);
    }
}

function conseguir_detalle_criterio($cod_criterio) {
    mostrar_detalle_criterio($cod_criterio);
}
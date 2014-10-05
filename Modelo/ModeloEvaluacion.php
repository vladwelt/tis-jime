<?php

require '../Controlador/Conexion.php';

function conseguir_proyectos() {
    $con = new Conexion();
    $c = $con->getConection();
    $consulta_proyectos = pg_query($c, "select nombreproyecto, codproyecto from proyecto;");
    while ($f_proyectos = pg_fetch_object($consulta_proyectos)) {
        $nombre_proyecto = $f_proyectos->nombreproyecto;
        $cod_proyecto = $f_proyectos->codproyecto;
        echo "<option value='" . $cod_proyecto . "'>" . $nombre_proyecto . "</option>";
    }
    pg_close($c);
}

function insertar_registro_evaluacion($cod_proyecto, $id_cons, $usr_cons) {
    $con = new Conexion();
    $c = $con->getConection();
    //cambiar los valores de usuario y codigo de docente
    pg_query($c, "INSERT INTO registro_evaluacion_final(consultor_usuario_idusuario, consultor_idconsultor, proyecto_codproyecto) VALUES ($usr_cons, $id_cons, '$cod_proyecto');");
    pg_close($c);
}

function insertar_registro_criterio($tipo_crit, $cod_proy, $usr_cons, $id_cons, $nombre, $porcentaje_calif) {
    $con = new Conexion();
    $c = $con->getConection();

    $cons_id_registro = pg_query($c, "select idregistro_evaluacion_final from registro_evaluacion_final where consultor_idconsultor = $id_cons and proyecto_codproyecto = '$cod_proy';;");
    $id_conseguido = pg_fetch_object($cons_id_registro);
    $id_reg_EF = $id_conseguido->idregistro_evaluacion_final;

    pg_query($c, "INSERT INTO criterio(tipo_criterio_id_tipo, registro_evaluacion_final_proyecto_codproyecto, registro_evaluacion_final_consultor_idconsultor, registro_evaluacion_final_consultor_usuario_idusuario, registro_evaluacion_final_idregistro_evaluacion_final, nombre, porcentaje_calificacion)"
            . "VALUES ($tipo_crit, '$cod_proy', $id_cons, $usr_cons, $id_reg_EF, '$nombre', $porcentaje_calif);");

    pg_close($c);
}

function registrar_verdadero_falso($tipo_crit, $cod_proy, $usr_cons, $id_cons, $nombre) {
    $con = new Conexion();
    $c = $con->getConection();

    $cons_id_registro = pg_query($c, "select idregistro_evaluacion_final from registro_evaluacion_final where consultor_idconsultor = $id_cons and proyecto_codproyecto = '$cod_proy';;");
    $id_conseguido = pg_fetch_object($cons_id_registro);
    $id_reg_EF = $id_conseguido->idregistro_evaluacion_final;


    $cons_id_criterio = pg_query($c, "select id_criterio from criterio where registro_evaluacion_final_proyecto_codproyecto = '$cod_proy' and registro_evaluacion_final_consultor_idconsultor = $id_cons and nombre = '$nombre';");
    $id_crit_conseguido = pg_fetch_object($cons_id_criterio);
    $id_criterio = $id_crit_conseguido->id_criterio;

    pg_query($c, "INSERT INTO detalle_criterio(
            criterio_registro_evaluacion_final_idregistro_evaluacion_final, 
            criterio_registro_evaluacion_final_consultor_usuario_idusuario, 
            criterio_registro_evaluacion_final_consultor_idconsultor, criterio_registro_evaluacion_final_proyecto_codproyecto, 
            criterio_tipo_criterio_id_tipo, criterio_id_criterio, porcentaje, nombre_concepto)
            VALUES ($id_reg_EF, 
                    $usr_cons, 
                    $id_cons, '$cod_proy', 
                    $tipo_crit, $id_criterio , 100, 'verdadero');");

    pg_query($c, "INSERT INTO detalle_criterio(
            criterio_registro_evaluacion_final_idregistro_evaluacion_final, 
            criterio_registro_evaluacion_final_consultor_usuario_idusuario, 
            criterio_registro_evaluacion_final_consultor_idconsultor, criterio_registro_evaluacion_final_proyecto_codproyecto, 
            criterio_tipo_criterio_id_tipo, criterio_id_criterio, porcentaje, nombre_concepto)
            VALUES ($id_reg_EF, 
                    $usr_cons, 
                    $id_cons, '$cod_proy', 
                    $tipo_crit, $id_criterio , 0, 'falso');");
    pg_close($c);
}

function registrar_numerico($tipo_crit, $cod_proy, $usr_cons, $id_cons, $nombre) {
    $con = new Conexion();
    $c = $con->getConection();

    $cons_id_registro = pg_query($c, "select idregistro_evaluacion_final from registro_evaluacion_final where consultor_idconsultor = $id_cons and proyecto_codproyecto = '$cod_proy';;");
    $id_conseguido = pg_fetch_object($cons_id_registro);
    $id_reg_EF = $id_conseguido->idregistro_evaluacion_final;

    $cons_id_criterio = pg_query($c, "select id_criterio from criterio where registro_evaluacion_final_proyecto_codproyecto = '$cod_proy' and registro_evaluacion_final_consultor_idconsultor = $id_cons and nombre = '$nombre';");
    $id_crit_conseguido = pg_fetch_object($cons_id_criterio);
    $id_criterio = $id_crit_conseguido->id_criterio;

    pg_query($c, "INSERT INTO detalle_criterio(
            criterio_registro_evaluacion_final_idregistro_evaluacion_final, 
            criterio_registro_evaluacion_final_consultor_usuario_idusuario, 
            criterio_registro_evaluacion_final_consultor_idconsultor, criterio_registro_evaluacion_final_proyecto_codproyecto, 
            criterio_tipo_criterio_id_tipo, criterio_id_criterio, porcentaje, nombre_concepto)
            VALUES ($id_reg_EF, 
                    $usr_cons, 
                    $id_cons, '$cod_proy', 
                    $tipo_crit, $id_criterio , 100, 'nota_numerica');");

    pg_close($c);
}

function registrar_escala_conceptual($tipo_crit, $cod_proy, $usr_cons, $id_cons, $nombre, $nombre_concepto, $porcentaje_concepto) {
    $con = new Conexion();
    $c = $con->getConection();

    $cons_id_registro = pg_query($c, "select idregistro_evaluacion_final from registro_evaluacion_final where consultor_idconsultor = $id_cons and proyecto_codproyecto = '$cod_proy';;");
    $id_conseguido = pg_fetch_object($cons_id_registro);
    $id_reg_EF = $id_conseguido->idregistro_evaluacion_final;

    $cons_id_criterio = pg_query($c, "select id_criterio from criterio where registro_evaluacion_final_proyecto_codproyecto = '$cod_proy' and registro_evaluacion_final_consultor_idconsultor = $id_cons and nombre = '$nombre';");
    $id_crit_conseguido = pg_fetch_object($cons_id_criterio);
    $id_criterio = $id_crit_conseguido->id_criterio;

    pg_query($c, "INSERT INTO detalle_criterio(
            criterio_registro_evaluacion_final_idregistro_evaluacion_final, 
            criterio_registro_evaluacion_final_consultor_usuario_idusuario, 
            criterio_registro_evaluacion_final_consultor_idconsultor, criterio_registro_evaluacion_final_proyecto_codproyecto, 
            criterio_tipo_criterio_id_tipo, criterio_id_criterio, porcentaje, nombre_concepto)
            VALUES ($id_reg_EF, 
                    $usr_cons, 
                    $id_cons, '$cod_proy', 
                    $tipo_crit, $id_criterio , $porcentaje_concepto, '$nombre_concepto');");

    pg_close($c);
}

function registrar_escala_numeral($tipo_crit, $cod_proy, $usr_cons, $id_cons, $nombre, $rango_concepto, $porcentaje_concepto_rango) {
    $con = new Conexion();
    $c = $con->getConection();

    $cons_id_registro = pg_query($c, "select idregistro_evaluacion_final from registro_evaluacion_final where consultor_idconsultor = $id_cons and proyecto_codproyecto = '$cod_proy';;");
    $id_conseguido = pg_fetch_object($cons_id_registro);
    $id_reg_EF = $id_conseguido->idregistro_evaluacion_final;

    $cons_id_criterio = pg_query($c, "select id_criterio from criterio where registro_evaluacion_final_proyecto_codproyecto = '$cod_proy' and registro_evaluacion_final_consultor_idconsultor = $id_cons and nombre = '$nombre';");
    $id_crit_conseguido = pg_fetch_object($cons_id_criterio);
    $id_criterio = $id_crit_conseguido->id_criterio;

    pg_query($c, "INSERT INTO detalle_criterio(
            criterio_registro_evaluacion_final_idregistro_evaluacion_final, 
            criterio_registro_evaluacion_final_consultor_usuario_idusuario, 
            criterio_registro_evaluacion_final_consultor_idconsultor, criterio_registro_evaluacion_final_proyecto_codproyecto, 
            criterio_tipo_criterio_id_tipo, criterio_id_criterio, porcentaje, nombre_concepto)
            VALUES ($id_reg_EF, 
                    $usr_cons, 
                    $id_cons, '$cod_proy', 
                    $tipo_crit, $id_criterio , $porcentaje_concepto_rango, '$rango_concepto');");

    pg_close($c);
}

function mostrar_lista_criterios($cod_consultor, $usr_consultor, $cod_ge, $usr_ge) {
    $con = new Conexion();
    $c = $con->getConection();

    $cons_cod_proyecto = pg_query($c, "select proyecto_codproyecto from consultor_proyecto_grupo_empresa where grupo_empresa_codgrupo_empresa = $cod_ge;");
    $cod_proy_conseguido = pg_fetch_object($cons_cod_proyecto);
    $cod_proyecto_GE = $cod_proy_conseguido->proyecto_codproyecto;

    $consulta = pg_query($c, "select id_criterio, nombre, tipo, id_tipo, porcentaje_calificacion from criterio c, tipo_criterio tc where c.tipo_criterio_id_tipo = tc.id_tipo and registro_evaluacion_final_consultor_idconsultor=" . $cod_consultor . "and c.registro_evaluacion_final_proyecto_codproyecto= '" . $cod_proyecto_GE . "';");
    $array_criterios = array();
    while ($f = pg_fetch_object($consulta)) {
        $id_crit = $f->id_criterio;
        $nombre = $f->nombre;
        $tipo = $f->tipo;
        $id_tipo = $f->id_tipo;
        $porcen_calif = $f->porcentaje_calificacion;
        if (!criterio_evaluado($id_crit)) {
            
            $array_criterios[] = "<a href='../Vista/iuEvaluacionFinalDocenteGE.php?a=$cod_consultor&u=$usr_consultor&c_a=$cod_ge&i_u=$usr_ge&cc=$id_crit&nc=$nombre&pc=$porcen_calif&tc=$tipo&it=$id_tipo'>".$nombre;
                $array_criterios[] = $tipo;
                $array_criterios[] = $porcen_calif;
                $array_criterios[] = 0;
            }
        }
        return $array_criterios;
       // exit();
    pg_close($c);
}


function mostrar_lista_criterios_evaluados($cod_consultor, $usr_consultor, $cod_ge, $usr_ge) {
$con = new Conexion();
    $c = $con->getConection();

    $cons_cod_proyecto = pg_query($c, "select proyecto_codproyecto from consultor_proyecto_grupo_empresa where grupo_empresa_codgrupo_empresa = $cod_ge;");
    $cod_proy_conseguido = pg_fetch_object($cons_cod_proyecto);
    $cod_proyecto_GE = $cod_proy_conseguido->proyecto_codproyecto;

    $consulta = pg_query($c, "select id_criterio, nombre, tipo, id_tipo, porcentaje_calificacion from criterio c, tipo_criterio tc where c.tipo_criterio_id_tipo = tc.id_tipo and registro_evaluacion_final_consultor_idconsultor=" . $cod_consultor . "and c.registro_evaluacion_final_proyecto_codproyecto= '" . $cod_proyecto_GE . "';");
    $array_criterios_e = array();
    
    while ($f = pg_fetch_object($consulta)) {
        $id_crit = $f->id_criterio;
        if (criterio_evaluado($id_crit)) {
            $consulta_evaluado = pg_query($c, "select ef.detalle_criterio_criterio_id_criterio, c.nombre, t.tipo, t.id_tipo, c.porcentaje_calificacion, ef.nota from evaluacion_final ef, criterio c, tipo_criterio t where detalle_criterio_criterio_id_criterio=id_criterio and ef.detalle_criterio_criterio_tipo_criterio_id_tipo = t.id_tipo and detalle_criterio_criterio_id_criterio = $id_crit;");
            
            while ($f_e = pg_fetch_object($consulta_evaluado)) {
                $nombre_e = $f_e->nombre;
                $tipo_e = $f_e->tipo;
                $id_tipo_e = $f_e->id_tipo;
                $porcen_calif_e = $f_e->porcentaje_calificacion;
                $nota_e = $f_e->nota;
                
                $array_criterios_e[] = "<a href='../Vista/iuEvaluacionFinalDocenteGE.php?a=$cod_consultor&u=$usr_consultor&c_a=$cod_ge&i_u=$usr_ge&cc=$id_crit&nc=$nombre_e&pc=$porcen_calif_e&tc=$tipo_e&it=$id_tipo_e'>".$nombre_e;
                $array_criterios_e[] = $tipo_e;
                $array_criterios_e[] = $porcen_calif_e;
                $array_criterios_e[] = $nota_e;

            }
    }}
        return $array_criterios_e;
       // exit();
    pg_close($c);
}



function suma_nota($cod_grupo_empresa) {
    $con = new Conexion();
    $c = $con->getConection();

    $consulta_suma = pg_query($c, "select sum(nota) from evaluacion_final where grupo_empresa_codgrupo_empresa = $cod_grupo_empresa;");
    $f = pg_fetch_object($consulta_suma);
    $suma = $f->sum;
    return $suma;
        pg_close($c);
}
//select sum(nota) from evaluacion_final where grupo_empresa_codgrupo_empresa = 1;


function criterio_evaluado($id_criterio) {
    $con = new Conexion();
    $c = $con->getConection();

    $consulta_cantidad_conseguida = pg_query($c, "select count(*) from evaluacion_final where detalle_criterio_criterio_id_criterio = $id_criterio;");
    $f = pg_fetch_object($consulta_cantidad_conseguida);
    $cant = $f->count;
    if ($cant > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
    //select count(*) from evaluacion_final where detalle_criterio_criterio_id_criterio = 1
}

function mostrar_detalle_criterio($cod_criterio) {
    $con = new Conexion();
    $c = $con->getConection();
    $consulta = pg_query($c, 'select iddetalle_criterio, nombre_concepto, porcentaje from detalle_criterio where criterio_id_criterio = ' . $cod_criterio . ';');
    while ($f = pg_fetch_object($consulta)) {
        $nombre = $f->nombre_concepto;
        $idconcepto = $f->iddetalle_criterio;
        $porcentaje = $f->porcentaje;
        echo '<input type=radio name=conceptos value=' . $porcentaje . '>' . $nombre . '<br>';
    }
    pg_close($c);
}

function mostrar_lista_registro_criterios($cod_cons, $cod_proyecto) {
    $con = new Conexion();
    $c = $con->getConection();

    $consulta = pg_query($c, "select id_criterio, nombre, tipo, id_tipo, porcentaje_calificacion from criterio c, tipo_criterio tc where c.tipo_criterio_id_tipo = tc.id_tipo and registro_evaluacion_final_consultor_idconsultor=" . $cod_cons . "and c.registro_evaluacion_final_proyecto_codproyecto= '" . $cod_proyecto . "';");
    while ($f = pg_fetch_object($consulta)) {
        $id_crit = $f->id_criterio;
        $nombre = $f->nombre;
        $tipo = $f->tipo;
        $id_tipo = $f->id_tipo;
        $porcen_calif = $f->porcentaje_calificacion;
        echo "<tr>"
        . "<td>$nombre</td><td>$tipo</td><td>$porcen_calif</td>"
        . "</tr>";
    }
    exit();
    pg_close($c);
}

function registrar_evaluacion_final($cod_ge, $usr_ge, $id_cons, $usr_cons, $id_criterio, $id_tipo_criterio, $nombre_concepto, $observaciones) {
    $con = new Conexion();
    $c = $con->getConection();
    echo $nombre_concepto;
    $cons_datos_criterio = pg_query($c, "select porcentaje_calificacion, registro_evaluacion_final_proyecto_codproyecto, registro_evaluacion_final_consultor_idconsultor, registro_evaluacion_final_consultor_usuario_idusuario, registro_evaluacion_final_idregistro_evaluacion_final from criterio where id_criterio = $id_criterio;");
    $datos_criterio_conseguidos = pg_fetch_object($cons_datos_criterio);
    $cod_proyec = $datos_criterio_conseguidos->registro_evaluacion_final_proyecto_codproyecto;
    $id_registro_EF = $datos_criterio_conseguidos->registro_evaluacion_final_idregistro_evaluacion_final;

    $porcentaje_criterio = $datos_criterio_conseguidos->porcentaje_calificacion;

    $cons_datos_detalle = pg_query($c, "select iddetalle_criterio, porcentaje from detalle_criterio where criterio_id_criterio = $id_criterio and nombre_concepto='$nombre_concepto';");
    $datos_detalle_conseguidos = pg_fetch_object($cons_datos_detalle);
    $id_det_concepto_criterio = $datos_detalle_conseguidos->iddetalle_criterio;
    $porcentaje_concepto = $datos_detalle_conseguidos->porcentaje;

    $nota_alcanzada = $porcentaje_criterio * $porcentaje_concepto / 100;

    if (no_existe_registro_EF($cod_ge, $id_criterio)) {
        pg_query($c, "INSERT INTO evaluacion_final(
            grupo_empresa_usuario_idusuario, grupo_empresa_codgrupo_empresa, 
            detalle_criterio_criterio_id_criterio, detalle_criterio_criterio_tipo_criterio_id_tipo, 
            detalle_criterio_criterio_registro_evaluacion_final_proyecto_co, 
            detalle_criterio_criterio_registro_evaluacion_final_consultor_i, 
            detalle_criterio_criterio_registro_evaluacion_final_consultor_u, 
            detalle_criterio_criterio_registro_evaluacion_final_idregistro_, 
            detalle_criterio_iddetalle_criterio, nota, observaciones)           
    VALUES ($usr_ge, $cod_ge, 
            $id_criterio, $id_tipo_criterio, 
            '$cod_proyec', 
            $id_cons, 
            $usr_cons, 
            $id_registro_EF, 
            $id_det_concepto_criterio, $nota_alcanzada, '$observaciones');");
    } else {
        pg_query($c, "UPDATE evaluacion_final
                        SET nota=$nota_alcanzada, observaciones='$observaciones'
                      WHERE grupo_empresa_codgrupo_empresa = $cod_ge and detalle_criterio_criterio_id_criterio = $id_criterio;");
    }
    pg_close($c);
}

function registrar_evaluacion_final_escala_conceptual($cod_ge, $usr_ge, $id_cons, $usr_cons, $id_criterio, $porcentaje, $id_tipo_criterio, $observaciones) {
    $con = new Conexion();
    $c = $con->getConection();
    
    echo "id".$id_criterio;
    echo "porcentaje".$porcentaje;
    
    $cons_datos_criterio = pg_query($c, "select porcentaje_calificacion, registro_evaluacion_final_proyecto_codproyecto, registro_evaluacion_final_consultor_idconsultor, registro_evaluacion_final_consultor_usuario_idusuario, registro_evaluacion_final_idregistro_evaluacion_final from criterio where id_criterio = $id_criterio;");
    $datos_criterio_conseguidos = pg_fetch_object($cons_datos_criterio);
    $cod_proyec = $datos_criterio_conseguidos->registro_evaluacion_final_proyecto_codproyecto;
    $id_registro_EF = $datos_criterio_conseguidos->registro_evaluacion_final_idregistro_evaluacion_final;

    $porcentaje_criterio = $datos_criterio_conseguidos->porcentaje_calificacion;

    $cons_datos_detalle = pg_query($c, "select iddetalle_criterio, porcentaje from detalle_criterio where criterio_id_criterio = $id_criterio and porcentaje=$porcentaje and criterio_tipo_criterio_id_tipo = 3;");
    $datos_detalle_conseguidos = pg_fetch_object($cons_datos_detalle);
    $id_det_concepto_criterio = $datos_detalle_conseguidos->iddetalle_criterio;
    $porcentaje_concepto = $datos_detalle_conseguidos->porcentaje;

    $nota_alcanzada = $porcentaje_criterio * $porcentaje_concepto / 100;

    if (no_existe_registro_EF($cod_ge, $id_criterio)) {
        pg_query($c, "INSERT INTO evaluacion_final(
            grupo_empresa_usuario_idusuario, grupo_empresa_codgrupo_empresa, 
            detalle_criterio_criterio_id_criterio, detalle_criterio_criterio_tipo_criterio_id_tipo, 
            detalle_criterio_criterio_registro_evaluacion_final_proyecto_co, 
            detalle_criterio_criterio_registro_evaluacion_final_consultor_i, 
            detalle_criterio_criterio_registro_evaluacion_final_consultor_u, 
            detalle_criterio_criterio_registro_evaluacion_final_idregistro_, 
            detalle_criterio_iddetalle_criterio, nota, observaciones)           
    VALUES ($usr_ge, $cod_ge, 
            $id_criterio, $id_tipo_criterio, 
            '$cod_proyec', 
            $id_cons, 
            $usr_cons, 
            $id_registro_EF, 
            $id_det_concepto_criterio, $nota_alcanzada, '$observaciones');");
    } else {
        pg_query($c, "UPDATE evaluacion_final
                        SET nota=$nota_alcanzada, observaciones='$observaciones'
                      WHERE grupo_empresa_codgrupo_empresa = $cod_ge and detalle_criterio_criterio_id_criterio = $id_criterio;");
    }
    pg_close($c);
}

function registrar_evaluacion_final_escala_numeral($cod_ge, $usr_ge, $id_cons, $usr_cons, $id_criterio, $porcentaje, $id_tipo_criterio, $observaciones) {
    $con = new Conexion();
    $c = $con->getConection();
    
    echo "id".$id_criterio;
    echo "porcentaje".$porcentaje;
    
    $cons_datos_criterio = pg_query($c, "select porcentaje_calificacion, registro_evaluacion_final_proyecto_codproyecto, registro_evaluacion_final_consultor_idconsultor, registro_evaluacion_final_consultor_usuario_idusuario, registro_evaluacion_final_idregistro_evaluacion_final from criterio where id_criterio = $id_criterio;");
    $datos_criterio_conseguidos = pg_fetch_object($cons_datos_criterio);
    $cod_proyec = $datos_criterio_conseguidos->registro_evaluacion_final_proyecto_codproyecto;
    $id_registro_EF = $datos_criterio_conseguidos->registro_evaluacion_final_idregistro_evaluacion_final;

    $porcentaje_criterio = $datos_criterio_conseguidos->porcentaje_calificacion;

    $cons_datos_detalle = pg_query($c, "select iddetalle_criterio, porcentaje from detalle_criterio where criterio_id_criterio = $id_criterio and porcentaje=$porcentaje and criterio_tipo_criterio_id_tipo = 4;");
    $datos_detalle_conseguidos = pg_fetch_object($cons_datos_detalle);
    $id_det_concepto_criterio = $datos_detalle_conseguidos->iddetalle_criterio;
    $porcentaje_concepto = $datos_detalle_conseguidos->porcentaje;

    $nota_alcanzada = $porcentaje_criterio * $porcentaje_concepto / 100;

    if (no_existe_registro_EF($cod_ge, $id_criterio)) {
        pg_query($c, "INSERT INTO evaluacion_final(
            grupo_empresa_usuario_idusuario, grupo_empresa_codgrupo_empresa, 
            detalle_criterio_criterio_id_criterio, detalle_criterio_criterio_tipo_criterio_id_tipo, 
            detalle_criterio_criterio_registro_evaluacion_final_proyecto_co, 
            detalle_criterio_criterio_registro_evaluacion_final_consultor_i, 
            detalle_criterio_criterio_registro_evaluacion_final_consultor_u, 
            detalle_criterio_criterio_registro_evaluacion_final_idregistro_, 
            detalle_criterio_iddetalle_criterio, nota, observaciones)           
    VALUES ($usr_ge, $cod_ge, 
            $id_criterio, $id_tipo_criterio, 
            '$cod_proyec', 
            $id_cons, 
            $usr_cons, 
            $id_registro_EF, 
            $id_det_concepto_criterio, $nota_alcanzada, '$observaciones');");
    } else {
        pg_query($c, "UPDATE evaluacion_final
                        SET nota=$nota_alcanzada, observaciones='$observaciones'
                      WHERE grupo_empresa_codgrupo_empresa = $cod_ge and detalle_criterio_criterio_id_criterio = $id_criterio;");
    }
    pg_close($c);
}



function no_existe_registro_EF($cod_ge, $id_criterio) {
    $con = new Conexion();
    $c = $con->getConection();
    $consulta_cantidad_conseguida = pg_query($c, "select count(*) from evaluacion_final where grupo_empresa_codgrupo_empresa = $cod_ge and detalle_criterio_criterio_id_criterio = $id_criterio;");
    $f = pg_fetch_object($consulta_cantidad_conseguida);
    $cant = $f->count;
    if ($cant > 0) {
        return FALSE;
    } else {
        return TRUE;
    }
}

function no_existe_registro($cod_proyecto, $cod_consultor) {
    $con = new Conexion();
    $c = $con->getConection();
    $consulta_cantidad_conseguida = pg_query($c, "select count(*) from registro_evaluacion_final where proyecto_codproyecto ='$cod_proyecto' and consultor_idconsultor = $cod_consultor;");
    $f = pg_fetch_object($consulta_cantidad_conseguida);
    $cant = $f->count;
    if ($cant > 0) {
        return FALSE;
    } else {
        return TRUE;
    }
}

function registrar_evaluacion_final_numerico($cod_ge, $usr_ge, $id_cons, $usr_cons, $id_criterio, $id_tipo_criterio, $observaciones, $nota) {
    $con = new Conexion();
    $c = $con->getConection();

    $cons_datos_criterio = pg_query($c, "select porcentaje_calificacion, registro_evaluacion_final_proyecto_codproyecto, registro_evaluacion_final_idregistro_evaluacion_final from criterio where id_criterio = $id_criterio;");
    $datos_criterio_conseguidos = pg_fetch_object($cons_datos_criterio);
    $cod_proyec = $datos_criterio_conseguidos->registro_evaluacion_final_proyecto_codproyecto;
    $id_registro_EF = $datos_criterio_conseguidos->registro_evaluacion_final_idregistro_evaluacion_final;

    $porcentaje_criterio = $datos_criterio_conseguidos->porcentaje_calificacion;

    $cons_datos_detalle = pg_query($c, "select iddetalle_criterio from detalle_criterio where criterio_id_criterio = $id_criterio and nombre_concepto='nota_numerica';");
    $datos_detalle_conseguidos = pg_fetch_object($cons_datos_detalle);
    $id_det_concepto_criterio = $datos_detalle_conseguidos->iddetalle_criterio;

    $nota_alcanzada = $nota * ($porcentaje_criterio / 100);



    if (no_existe_registro_EF($cod_ge, $id_criterio)) {
        pg_query($c, "INSERT INTO evaluacion_final(
            grupo_empresa_usuario_idusuario, grupo_empresa_codgrupo_empresa, 
            detalle_criterio_criterio_id_criterio, detalle_criterio_criterio_tipo_criterio_id_tipo, 
            detalle_criterio_criterio_registro_evaluacion_final_proyecto_co, 
            detalle_criterio_criterio_registro_evaluacion_final_consultor_i, 
            detalle_criterio_criterio_registro_evaluacion_final_consultor_u, 
            detalle_criterio_criterio_registro_evaluacion_final_idregistro_, 
            detalle_criterio_iddetalle_criterio, nota, observaciones)
    VALUES ($usr_ge, $cod_ge, 
            $id_criterio, $id_tipo_criterio, 
            '$cod_proyec', 
            $id_cons, 
            $usr_cons, 
            $id_registro_EF, 
            $id_det_concepto_criterio, $nota_alcanzada, '$observaciones');");
    } else {
        pg_query($c, "UPDATE evaluacion_final
                        SET nota=$nota_alcanzada, observaciones='$observaciones'
                      WHERE grupo_empresa_codgrupo_empresa = $cod_ge and detalle_criterio_criterio_id_criterio = $id_criterio;");
    }
    pg_close($c);
}

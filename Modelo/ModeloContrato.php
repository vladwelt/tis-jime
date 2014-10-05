<?php

require '../Controlador/Conexion.php';

function conseguirNombreLargo($codEmpresa) {
    $con = new Conexion();
    $c=$con->getConection();
    $consulta = pg_query($c, 'SELECT nombrelargoge FROM grupo_empresa WHERE codgrupo_empresa='.$codEmpresa.';');
    while ($f = pg_fetch_object($consulta)){
        $nlargo = $f->nombrelargoge;
        return $nlargo;
    }
    exit();
    pg_close($c);
}

function conseguirNombreCorto($codEmpresa) {
    $con = new Conexion();
    $c=$con->getConection();
    $consulta = pg_query($c, 'SELECT nombrecortoge FROM grupo_empresa WHERE codgrupo_empresa='.$codEmpresa.';');
    while ($f = pg_fetch_object($consulta)){
        $ncorto = $f->nombrecortoge;
        return $ncorto;
    }
    exit();
    pg_close($c);
}

function conseguirRepresentanteLegal($codEmpresa) {
    $con = new Conexion();
    $c=$con->getConection();
    $consulta = pg_query($c, 'select nombresocio, apellidossocio from socio where grupo_empresa_codgrupo_empresa ='.$codEmpresa.' and tipo_socio_codtipo_socio = 1;');
    while ($f = pg_fetch_object($consulta)){
        $nrepresentante = $f->nombresocio;
        $aprepresentante = $f->apellidossocio;
        return "$nrepresentante"." "."$aprepresentante";
    }
    exit();
    pg_close($c);
}

function conseguirProyecto($cod_grupoempresa) {
    $con = new Conexion();
    $c=$con->getConection();
    $consulta = pg_query($c, 'select p.nombreproyecto from consultor_proyecto_grupo_empresa cpge, proyecto p where cpge.proyecto_codproyecto = p.codproyecto and grupo_empresa_codgrupo_empresa = '.$cod_grupoempresa.';');
    while ($f = pg_fetch_object($consulta)){
        $nproyecto = $f->nombreproyecto;
        return $nproyecto;
    }
    exit();
    pg_close($c);
}

function conseguirCodigoProyecto($cod_grupoempresa) {
    $con = new Conexion();
    $c=$con->getConection();
    $consulta = pg_query($c, 'select p.codproyecto from consultor_proyecto_grupo_empresa cpge, proyecto p where cpge.proyecto_codproyecto = p.codproyecto and grupo_empresa_codgrupo_empresa = '.$cod_grupoempresa.';');
    while ($f = pg_fetch_object($consulta)){
        $idproyecto = $f->codproyecto;
        return $idproyecto;
    }
    exit();
    pg_close($c);
}
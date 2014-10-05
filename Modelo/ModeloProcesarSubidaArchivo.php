<?php

require_once '../Controlador/Conexion.php';

chmod("../Archivos/", 0777);
function subirArchivoPublico($titulo, $tipo_Archivo, $nombre_Archivo, $nombre_Temporal_Archivo, $descripcion, $dependeDeActividad) {
    $res = 1;
    if ($tipo_Archivo == 'application/pdf') {
        $carpetaRaiz = "../Archivos/";
        $gestion = date('Y') ;
        $fecha=date('m-d');
        date_default_timezone_set('America/La_Paz');
        $hora= date('H-i-s') ;
        
        $carpetaDestino = $carpetaRaiz . "Documentos publicos/" .$gestion . "/".$fecha."/".$hora."/";

        if (file_exists($carpetaDestino)) {
            $nombreFinal = guardarArchivo($carpetaDestino, $nombre_Archivo, $nombre_Temporal_Archivo);
            $rutaFinal = $carpetaDestino . $nombreFinal;
            guardarRutaPublicos($nombreFinal, $descripcion, $rutaFinal, $titulo, $dependeDeActividad);
            $res = 2;
        } elseif (!mkdir($carpetaDestino, 0777, true)) {
            die('Fallo al crear las carpetas...');
        } else {
            $nombreFinal = guardarArchivo($carpetaDestino, $nombre_Archivo, $nombre_Temporal_Archivo);
            $rutaFinal = $carpetaDestino . $nombreFinal;
            guardarRutaPublicos($nombre_Archivo, $descripcion, $rutaFinal, $titulo, $dependeDeActividad);
            $res = 2;
        }
    }

    return $res;
}

function guardarArchivoActividad($archivo, $nombre_tmp,$idusuarioConsultor) {
    $carpetaRaiz = "../Archivos/";
    $gestion = date('Y') ;
        $fecha=date('m-d');
        date_default_timezone_set('America/La_Paz');
        $hora= date('H-i-s') ;
    
    $carpetaDestino = $carpetaRaiz . $idusuarioConsultor."/Archivos de Actividades/" . $gestion . "/".$fecha."/".$hora."/";
    $array_datos = array();

    if (file_exists($carpetaDestino)) {
        $array_datos[0] = guardarArchivo($carpetaDestino, $archivo, $nombre_tmp);
        $array_datos[1] = $carpetaDestino . $array_datos[0];
    } elseif (!mkdir($carpetaDestino, 0777, true)) {
        die('Fallo al crear las carpetas...');
    } else {
        $array_datos[0] = guardarArchivo($carpetaDestino, $archivo, $nombre_tmp);
        $array_datos[1] = $carpetaDestino . $array_datos[0];
    }
    return $array_datos;
}

function guardarArchivoGEActividad($nombreArchivo, $nombreTemporal,$codigoActividad,$titulo,$idusuarioConsultor,$idconsultor, $idusuarioEmpresa,$codGE,$tipo) {
    
    if($tipo== 'application/pdf')
    {
    $carpetaRaiz = "../Archivos/";
    $gestion = date('Y') ;
        $fecha=date('m-d');
        date_default_timezone_set('America/La_Paz');
        $hora= date('H-i-s') ;
    $carpetaDestino = $carpetaRaiz.$idusuarioConsultor."/Respuestas de Actividades/".$gestion."/". $idusuarioEmpresa . "/".$fecha."/".$hora."/";
    $array_datos = array();

    if (file_exists($carpetaDestino)) {
        $array_datos[0] = guardarArchivo($carpetaDestino, $nombreArchivo, $nombreTemporal);
        $array_datos[1] = $carpetaDestino . $array_datos[0];
        guardarRutaGrupoEmpresa($codGE, $idusuarioEmpresa, $array_datos[0], $array_datos[1],"", $titulo);
        $sql="SELECT MAX(idge_documento) FROM ge_documento";
        $conec = new Conexion();
        $con = $conec->getConection();
        $resultado = pg_query($con, $sql);
        $fila = pg_fetch_row($resultado);
        $idDoc=$fila[0];
        guardarRutaAcividad($idconsultor,$idusuarioConsultor,$codigoActividad,$idusuarioEmpresa,$codGE,$idDoc);
        $res=2;
    } elseif (!mkdir($carpetaDestino, 0777, true)) {
        die('Fallo al crear las carpetas...');
    } else {
        $array_datos[0] = guardarArchivo($carpetaDestino, $nombreArchivo, $nombreTemporal);
        $array_datos[1] = $carpetaDestino . $array_datos[0];
        guardarRutaGrupoEmpresa($codGE, $idusuarioEmpresa, $array_datos[0], $array_datos[1],"", $titulo);
        $sql="SELECT MAX(idge_documento) FROM ge_documento";
        $conec = new Conexion();
        $con = $conec->getConection();
        $resultado = pg_query($con,$sql);
        $fila = pg_fetch_row($resultado);
        $idDoc=$fila[0];
        guardarRutaAcividad($idconsultor,$idusuarioConsultor,$codigoActividad,$idusuarioEmpresa,$codGE,$idDoc);
        $res=2;
    }
    }
    else{
        $res=1;
    }
    return $res;
}


function guardarArchivo($ruta, $nombre, $tmp_Archivo) {
    $destino = $ruta . $nombre;

    if (file_exists($destino)) {
        return renombrar($ruta, $nombre, $tmp_Archivo);
    } else {
        copy($tmp_Archivo, $destino);
        move_uploaded_file($tmp_Archivo, $destino);
        return $nombre;
    }
}

function renombrar($rutaArchivo, $nom, $tmp_Archivo_r) {
    $desfragmentado = explode(".", $nom);
    $extension = "." . $desfragmentado[1];

    $n = 1;
    $nombreParcial = $desfragmentado[0] . $n . $extension;

    while (file_exists($rutaArchivo . $nombreParcial)) {
        $nombreParcial = $desfragmentado[0] . $n . $extension;
        $n++;
    }
    guardarArchivo($rutaArchivo, $nombreParcial, $tmp_Archivo_r);
    return $nombreParcial;
}

function guardarRutaConsultor($idConsultor, $nombre, $titulo, $descripcion, $ruta, $dependeDeActividad) {
    $conec = new Conexion();
    $con = $conec->getConection();

    $sql = "INSERT INTO cons_documento(
                    consultor_idconsultor, 
                    nombredocumento, titulo_consdocumento, 
                    descripcionconsultordocumento, pathdocumentoconsultor)
            VALUES ('$idConsultor','$nombre','$titulo','$descripcion','$ruta')";
    pg_query($con, $sql) or die("ERROR :(" . pg_last_error());
    pg_close();
}

function guardarRutaGrupoEmpresa($codGE, $idGEUsuario, $nombre, $ruta, $descripcion, $titulo) {
    $conec = new Conexion();
    $con = $conec->getConection();

    $sql = "INSERT INTO ge_documento(grupo_empresa_codgrupo_empresa, grupo_empresa_usuario_idusuario, 
                                   nombredocumento, pathdocumentoge,descripciongedocumento,titulo_gedocumento)
                                  VALUES ('$codGE','$idGEUsuario','$nombre','$ruta','$descripcion','$titulo')";
    pg_query($con, $sql) or die("ERROR :(" . pg_last_error());
    pg_close();
}
function guardarRutaPublicos($nombre, $descripcion, $ruta, $titulo) {
    $conec = new Conexion();
    $con = $conec->getConection();

    $sql = "INSERT INTO documentospublicos(titulodocumento, descdocpublico, nombredocupublico,rutadocpublico)
         VALUES ('$titulo','$descripcion','$nombre','$ruta')";
    pg_query($con, $sql) or die("ERROR :(" . pg_last_error());
    pg_close();
}

function guardarRutaAcividad($idconsultor,$usuarioConsultor,$codigoActividad,$usuarioGE,$codGE,$idDoc) {
    $conec = new Conexion();
    $con = $conec->getConection();
    
    $sql="INSERT INTO repuesta_actividad(cons_actividad_consultor_idconsultor, 
            cons_actividad_consultor_usuario_idusuario, cons_actividad_codcons_actividad, 
            ge_documento_grupo_empresa_usuario_idusuario, ge_documento_grupo_empresa_codgrupo_empresa, ge_documento_idge_documento)
    VALUES ($idconsultor,$usuarioConsultor,$codigoActividad,$usuarioGE,$codGE,$idDoc)";
    pg_query($con, $sql) or die("ERROR :(" . pg_last_error());
    pg_close();
}

?>
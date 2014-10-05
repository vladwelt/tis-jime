<?php

//generarDescarga('../Archivos/Documentos publicos/',"../Archivos/Documentos publicos/","prueba");

function generarDescarga($origen, $destino, $nombre) {
    $zip = new ZipArchive();
    $dir = $origen;
    $rutaFinal = $destino;

    $archivoZip = $nombre . ".zip";

    if ($zip->open($archivoZip, ZIPARCHIVE::CREATE) === true) {
        agregar_zip($dir, $zip);
        $zip->close();
        @rename($archivoZip, "$rutaFinal$archivoZip");
        // echo "$rutaFinal$archivoZip<br>";
        if (file_exists($rutaFinal . $archivoZip)) {
            //echo "Proceso Finalizado!! <br/><br/>
            $enlace = " Descargar todo: <a href='$rutaFinal$archivoZip'>$archivoZip</a>";
            //   header("Location: $rutaFinal$archivoZip");
        } else {
            
            echo "Error, no se pudo realizar el backup";
        }
    }
    return $enlace;
}

function agregar_zip($dir, $zip) {
    if (is_dir($dir)) {
        if ($da = opendir($dir)) {
            while (($archivo = readdir($da)) !== false) {
                if (is_dir($dir . $archivo) && $archivo != "." && $archivo != "..") {

                    agregar_zip($dir . $archivo . "/", $zip);
                } elseif (is_file($dir . $archivo) && $archivo != "." && $archivo != "..") {

                    $zip->addFile($dir . $archivo, $dir . $archivo);
                }
            }
            closedir($da);
        }
    }
}

?>

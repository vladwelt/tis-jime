<?php

          $zip = new ZipArchive();     
          $dir = '../Archivos/';
          $rutaFinal="../Descargas";
     
          $archivoZip = "backup.zip";  

          function agregar_zip($dir, $zip){
            if (is_dir($dir)) {
              if ($da = opendir($dir)) {          
                while (($archivo = readdir($da))!== false) {  
                  if (is_dir($dir . $archivo) && $archivo!="." && $archivo!=".."){
                    echo "<strong>Creando directorio: $dir$archivo</strong><br/>";                
                    agregar_zip($dir.$archivo . "/", $zip);  
                  }elseif(is_file($dir.$archivo) && $archivo!="." && $archivo!=".."){
                    echo "Agregando archivo: $dir$archivo <br/>";                                    
                    $zip->addFile($dir.$archivo, $dir.$archivo);                    
                  }            
                }
                closedir($da);
              }
            }      
          }      

     
          if($zip->open($archivoZip,ZIPARCHIVE::CREATE)===true) {  
            agregar_zip($dir, $zip);
            $zip->close();
            @rename($archivoZip, "$rutaFinal$archivoZip");
           // echo "$rutaFinal$archivoZip<br>";
            if (file_exists($rutaFinal.$archivoZip)){
              echo "Proceso Finalizado!! <br/><br/>
                   Descargar: <a href='$rutaFinal$archivoZip'>descarga</a>"; 
              header("Location: $rutaFinal$archivoZip");
            }else{
              echo "Error, no se pudo realizar el backup";
            }                    
          }
        ?>

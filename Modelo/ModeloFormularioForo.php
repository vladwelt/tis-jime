<?php

require('../Controlador/Conexion.php');
    //put your code here
    
function insertarForo($a,$b,$c,$d)
{
    $conec=new Conexion(); 
    $con=$conec->getConection();

    $autor=$a;
    $tema=$b;
    $mensaje=$c;
    $cantidadC = $d;
    
//Hacemos algunas validaciones
    if(empty($autor)) $autor = "Anónimo";
//Evitamos que el usuario ingrese HTML
    $mensaje = htmlentities($mensaje);

    
    echo $autor."titulo:".$tema."mensaje:".$mensaje;
    $sql = "INSERT INTO foro (autor, titulo, mensaje, cantidad_comentarios )";
    $sql.= "VALUES ('$autor','$tema','$mensaje','$cantidadC')";
     pg_query($con,$sql) or die ("ERROR ====> al grabar el sms :( " .pg_last_error());
     
 //crear su archivo.data
    $codForo = retornarCodForo($autor);
    $miarchivo=fopen('../Vista/Otros/Comentarios/'.$codForo.'_'.$tema.'.data','w');
    fclose($miarchivo);
}
  function retornarCodForo($autor){
  $au = $autor;  
  $conexion = new Conexion();
  $con = $conexion->getConection();
  $consulta = pg_query($con,"SELECT codforo FROM foro WHERE autor='$au';");
  $row = pg_fetch_object($consulta);
  $AUX = $row->codforo;
  echo $AUX;
  return $AUX;
}  

?>
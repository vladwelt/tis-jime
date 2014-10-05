<?php
require '../Controlador/Conexion.php';
function retornarEntregables($codHito){
     $conec=new Conexion(); 
     $con=$conec->getConection();  
     $c_h=$codHito;
     $arreglo_entregables = array();
     $sql="SELECT entregable FROM entregables e  WHERE e.hito_pagable_codhito_pagable='$c_h'";
     $result = pg_query($con,$sql);
     while ($row = pg_fetch_object($result)){
        $e = $row->entregable;
        
        $arreglo_entregables[] = $e; 
     }
     
     return $arreglo_entregables;

     
}
function retornarEstadoTablaRegistros(){
        $conec =  new Conexion();
        $con = $conec->getConection();
        $sql="SELECT * FROM registros";
        $result = pg_query($con,$sql);
        $estado = pg_num_rows($result);
        if($estado!=0){
            return "lleno";
        }  else {
            return "basio";
        }
    }
function insertarTablaRegistros($codHito){
     $conec=new Conexion(); 
     $con=$conec->getConection();
     $c_h=$codHito;
     $sql="SELECT entregable FROM entregables e  WHERE e.hito_pagable_codhito_pagable='$c_h'";
     $result = pg_query($con,$sql);
     while ($row = pg_fetch_object($result)){
        $e = $row->entregable;
        $c_e=  retornarCodEntregables($c_h, $e);
        insert($c_h, $c_e, $e);
        
        }
}
function insert($c_h,$c_e,$e){
     $conec=new Conexion(); 
     $con=$conec->getConection();
     $sql2 = "INSERT INTO registros (codhito,codentregable,entregable)";
     $sql2.= "VALUES ('$c_h','$c_e','$e')";
     pg_query($con,$sql2) or die ("ERROR :( " .pg_last_error());
     
}
function retornarRegistro($codHito){
     $conec=new Conexion(); 
     $con=$conec->getConection();  
     $c_h=$codHito;
     $arregloEntregables = array();
     $sql="SELECT entregable FROM registros r  WHERE r.codhito='$c_h'";
     $result = pg_query($con,$sql);
     while ($row = pg_fetch_object($result)){
        $e = $row->entregable;
        $arregloEntregables[] = $e;
     }
     
     return $arregloEntregables;

     
}
function retornarCodEntregables($codH, $entregable){
     $conec=new Conexion(); 
     $con=$conec->getConection();  
     $sql="SELECT codentregables ";
     $sql.="FROM entregables e ";
     $sql.="WHERE e.hito_pagable_codhito_pagable='$codH' AND e.entregable='$entregable'";
     $result = pg_query($con,$sql);
     $row = pg_fetch_object($result);
        $codE = $row->codentregables;
     pg_close($con);
     return $codE;
}
function eliminarEntregableTablaRegistros($codH,$entregable,$codE){
     $conec=new Conexion(); 
     $con=$conec->getConection();
     $c_h=$codH;
     $e=$entregable;
     $c_e=$codE;
     
     $sql="DELETE FROM registros r WHERE r.codhito='$c_h' AND r.codentregable='$c_e' AND r.entregable='$e'";
     pg_query($con,$sql);
    
     pg_close($con);
     
}
function registrarEvaluacionPlanDePagosGE($porcentaje, $alcance, $codH, $entregable, $nombreH, $sumaAlcance){
 
    $e=$entregable;
    $p=$porcentaje;
    $a=$alcance;
    $c_h=$codH;
    $n_h=$nombreH;
    $suma = $sumaAlcance;
    $leer = fopen("../Vista/Otros/Otros/EvaluacionHitosGE/".$c_h."_".$n_h.".data", "r"); 
    $aleer = fread($leer ,filesize("../Vista/Otros/EvaluacionHitosGE/".$c_h."_".$n_h.".data")); 

    $escribir =  fopen("../Vista/Otros/EvaluacionHitosGE/".$c_h."_".$n_h.".data","a"); 
    fwrite($escribir,"<tr>
                        <td>$e</td>
                        <td>$p</td>
                        <td>$a</td>
                      </tr>$aleer"); 
    fclose($escribir);
}


?>

<?php

require('../Controlador/Conexion.php');

function verificarSiexiste($login_formulario) {
    $conec = new Conexion();
    $con = $conec->getConection();
    
    $sql="SELECT login FROM Usuario WHERE login='$login_formulario'";
    $filas = pg_query($con, $sql);
    $res=NULL;
    try{
    $usuario = pg_fetch_object($filas);
    $res = $usuario->login;
    }
    catch (ErrorException $e){
    echo 'no se encontro ninguna coincidencia'; 
    }
    if($res!=NULL)
    {
    return TRUE;
    }
    else{
        return FALSE;
    }
}
$c="camaleon";
echo verificarSiexiste($c);
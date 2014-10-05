<?php

require('../Modelo/ModeloRegistroSocio.php');

$login=$_POST['nombre_usuario'];
$contrasena=$_POST['contraseña_usuario1'];
$nombre=$_POST['nombre_socio'];
$apellidos=$_POST['apellidos_socio'];
$correo=$_POST['correo_socio'];
$direccion=$_POST['direccion_socio'];
$profesion=$_POST['profesion_socio'];
$estado_civil=$_POST['combo_estado_civil'];
$tipo_socio=$_POST['combo_cargo'];;
$codGrupoempresa = $_GET['a'];// $a -> codigo grupo empresa
$idusuario =$_GET['u'];//$u -> codigo usuario grupo empresa

if(cantidadDeSocios($codGrupoempresa)<5){
   
RegistrarUsuario($login, $contrasena);
RegistrarSocio($login,$codGrupoempresa,$tipo_socio,$idusuario,$nombre,$apellidos,$estado_civil,$direccion,$profesion,$correo);
$m=1;
header("Location: ../Vista/iuRegistroSocio.php?a=$codGrupoempresa&u=$idusuario&m=$m");
}
else{
header("Location: ../Vista/iuRegistroDenegadoSocio.php?a=$codGrupoempresa&u=$idusuario");
}



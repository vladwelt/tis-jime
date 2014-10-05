<?php
require ('../Modelo/ModeloAccesoUsuarios.php');

$nombre_usuario = $_POST['usr'];
$contrasena_usuario = $_POST['pass'];

iniciarSesion($nombre_usuario,$contrasena_usuario);

?>

<?php
require '../Modelo/ModeloComentario.php';
$nombre=$_GET['nombre'];
$comentario=$_GET['comentario'];
$codForo=$_GET['codigo'];
$candComentarios=$_GET['cantidad'];
insertarComentarioForo($nombre, $comentario, $codForo, $candComentarios);

header("Location: ../Vista/iu.foro.php?ARCHIVO=$codForo&NOM=$nombre&COM=$comentario");
?>

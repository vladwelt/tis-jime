<?php
require ('../Modelo/ModeloFormularioForo.php');
$autor = $_POST["autor"];
$tema = $_POST["titulo"];
$mensaje = $_POST["mensaje"];
$candComentarios=0;
insertarForo($autor, $tema, $mensaje, $candComentarios);
header("Location: ../Vista/iu.foro.php?candtidad=$candComentarios");
?>
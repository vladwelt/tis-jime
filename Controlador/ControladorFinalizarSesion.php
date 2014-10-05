<?php
session_start();
$_SESSION['id_usuario'] = array();
session_destroy();
 header("Location: ../Vista/iuIngresar.php");
?>



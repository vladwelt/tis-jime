<?php
require '../Modelo/ModeloGrupoEmpresa.php';
echo $cod_proy = $_POST['cbox_proyectos'];
echo "<br />".$cod_cons = $_POST['cbox_docentes'];
echo "<br />".$cod_ge = $_GET['a'];
echo "<br />".$usr_ge = $_GET['u'];
if($cod_proy!="" && $cod_cons!=""){
    inscribir_GE($cod_ge, $usr_ge, $cod_cons, $cod_proy);
    header("Location: ../Vista/iuGrupoEmpresa.php?a=$cod_ge&u=$usr_ge"); 
     
}else{
    header("Location: ../Vista/iuRegistroGrupoEmpresaConsultor.php?a=$cod_ge&u=$usr_ge");
}
<?php  
    require_once '../Modelo/ModeloGrupoEmpresa.php';
    
    function mostrarListaEmp($a,$u){
        $listaEmpresas = mostrarListaEmpresas($a,$u);
        return $listaEmpresas;
    }
    function mostrarDatosEmp($codGE){
        $nombreRepLegal = mostrarDatosEmpresa($codGE);
        echo $nombreRepLegal;
    }
    function mostrarEmpresa(){
        $listaEmpresas = mostrarEmpresas();
        require_once '../Vista/ListaEmpresas.html';
    }
    
    function conseguir_usuario($cod_ge) {
        return devolver_usuario($cod_ge);
}

function conseguir_cod_cons($cod_ge) {
    return devolver_cod_cons($cod_ge);
}

function conseguir_usr_cons($cod_ge) {
    return devolver_usr_cons($cod_ge);
}

function mostrarRegistroAvanceGE($cod_ge,$usr_ge, $cod_avance,$cod_cons,$usr_cons) {
    mostrarRegistros($cod_ge,$usr_ge, $cod_avance,$cod_cons,$usr_cons);
}

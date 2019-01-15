<?php
function mostrarError($errores, $campo){
    $alerta = '';
    if (isset($errores[$campo]) && !empty($campo)){
        $alerta = "<div class='alerta alerta-error'>".$errores[$campo].'</div>';
    }
    return $alerta;
}

function borrarErrores(){
    $borrado = false;
    if(isset($_SESSION['errores'])){
    $_SESSION['errores'] = null;
    $borrado = session_unset($_SESSION['errores']);
    }    
    
    if(isset($_SESSION['completado'])){
       $_SESSION['completado'] = null;
       session_unset($_SESSION['completado']);
    }
    
    return $borrado;
}

function conseguirCategorias($conexion){
    $sql = "SELECT * FROM categorias ORDER BY id ASC;";
    $categorias = mysqli_query($conexion, $sql);
    
    $result = array(); // por defecto trae un arreglo vacío
    if($categorias && mysqli_num_rows($categorias) >= 1){
        $result = $categorias;
    }
    return $result;
}
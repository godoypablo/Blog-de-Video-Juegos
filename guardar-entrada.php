<?php

if(isset($_POST)){
    //Conexión a la base de datos
    require_once 'includes/conexion.php';

    //mysqli_real_escape_string: limpia si vienen datos peligrosos!!!                                   
    $titulo = isset($_POST['titulo'])? mysqli_real_escape_string($db, $_POST['titulo']):false;
    $descripcion = isset($_POST['descripcion'])? mysqli_real_escape_string($db, $_POST['descripcion']):false;
    $categoria = isset($_POST['categoria'])? (int)$_POST['categoria']:false; //(int)-> castea el dato a entero.
    $usuario = $_SESSION['usuario']['id'];
    
    
    // Validaciones
    $errores = array();
    
    //Validar los datos antes de guardar en la base de datos
    if (empty($titulo)){
        $errores['titulo'] = "El título no es válido";
    } 
    
    if (empty($descripcion)){
        $errores['descripcion'] = "La descripcion no es válida";
    }     
    
    if (empty($categoria) && !is_numeric($categoria)){
        $errores['$categoria'] = "La categoría no es válida";
    }      
    
    /*var_dump($errores);
      die();*/
    
    if(count($errores) == 0){
        $sql = "INSERT INTO entradas VALUES(NULL, $usuario, $categoria, '$titulo', '$descripcion', CURDATE());";
        $guardar = mysqli_query($db, $sql);
        header('Location: index.php');
        //Controlar errores en la consulta...
        //var_dump(mysqli_error());
        //die();
        
    }else{
        $_SESSION["errores_entrada"] = $errores;
        header("Location: crear-entradas.php"); 
    }
}




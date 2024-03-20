<?php
    session_start();
    require_once("conexion/conexion.php"); 
    $conexion = new Database();
    $con = $conexion->conectar();

    $insertSQL = $con -> prepare("DELETE FROM jugadores WHERE documento = '".$_GET['id']."'");      
    $insertSQL->execute();
    echo '<script>alert ("Registro eliminado exitosamente.");</script>';
    echo '<script>window.location="index.php"</script>';
?>
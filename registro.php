<?php
require 'conexion/conexion.php'; 
$db = new Database();
$con = $db->conectar();

// Recibe los datos del formulario
$usu = $_POST['doc'];
$nom = $_POST['nom'];
$pas = $_POST['pas'];
$pas_encriptada = password_hash($pas, PASSWORD_DEFAULT);
$email = $_POST['email'];
$tel = $_POST['telefono'];
$depor = $_POST['depor'];

// Verificar si hay campos vacíos
if (empty($usu) || empty($nom) || empty($pas) || empty($email) || empty($tel) || empty($depor)) {
    echo "Existen campos vacíos. Por favor, completa todos los campos.";
} else {
    // Consulta SQL para verificar si el documento ya existe en la base de datos
    $check_sql = "SELECT * FROM jugadores WHERE documento = '$usu'";
    $result = $con->query($check_sql);
    
    if ($result->num_rows > 0) {
        echo "El número de documento ya existe en la base de datos.";
    } else {
        $hashed_password = password_hash($pas, PASSWORD_DEFAULT);
        // Consulta SQL para insertar los datos en la tabla 'user'
        $sql = "INSERT INTO jugadores (documento, nombre, password, correo, telefono, id_deporte) 
                VALUES ('$usu', '$nom', '$pas_encriptada', '$email', '$tel', '$depor')";

        // Ejecuta la consulta
        if ($con->query($sql) === TRUE) {
            echo "Registro exitoso";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }
}

$con->close();
?>

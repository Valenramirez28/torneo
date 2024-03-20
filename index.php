<?php
    require_once("conexion/conexion.php"); 
    $conexion = new Database();
    $con = $conexion->conectar();
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text">Jugadores Registrados</h1>
    <br>
    <div class="text-center">
    <div class="row mt-3">
        <div class="col-md-6">
            <form action="../index.php">
                <input type="submit" value="Regresar" class="btn btn-secondary"/>
            </form>
        </div>
        <div class="col-md-6">
            <a href="crear_usu.php" class="btn btn-success"><i class="fas fa-user-plus"></i>Crear Jugador</a>
        </div>
    </div>
    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>Documento</th>
                <th>Nombre Completo</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Tipo de Deporte</th>
                <th>Deporte</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $consulta = "SELECT * FROM jugadores, tipo_deporte, deporte WHERE jugadores.id_deporte = deporte.id_deporte AND deporte.id_tip_deporte = tipo_deporte.id_tip_deporte";
            $resultado = $con->query($consulta);

            while ($fila = $resultado->fetch()) {
                echo '
                <tr>
                    <td>' . $fila["documento"] . '</td>
                    <td>' . $fila["nombre"] . '</td>
                    <td>' . $fila["telefono"] . '</td>
                    <td>' . $fila["correo"] . '</td>
                    <td>' . $fila["nom_depor"] . '</td>
                    <td>' . $fila["deporte"] . '</td>
                    <td>
                        <div class="text-center">
                            <a href="editar.php?id=' . $fila['documento'] . '" class="btn btn-primary btn-sm">Editar</a>
                            <a href="eliminar.php?id=' . $fila['documento'] . '" class="btn btn-danger btn-sm">Eliminar</a>
                        </div>
                    </td>
                </tr>';
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
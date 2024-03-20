<?php
    session_start();
    require_once("conexion/conexion.php"); 
    $conexion = new Database();
    $con = $conexion->conectar();

    $sql = $con -> prepare ("SELECT * FROM jugadores, tipo_deporte, deporte
    WHERE jugadores.id_deporte = deporte.id_deporte AND deporte.id_tip_deporte = tipo_deporte.id_tip_deporte AND jugadores.documento= '".$_GET['id']."'");
    $sql -> execute();
    $usua =$sql -> fetch();
?>

<?php

if(isset($_POST["update"]))
 {
    $documento= $_POST['documento'];
    $nombre= $_POST['nombre'];
    $telefono= $_POST['telefono'];
    $correo= $_POST['correo'];
    $id_deporte= $_POST['id_deporte'];
 
 
   if ( $documento==""|| $nombre==""|| $telefono=="" || $correo=="" || $id_deporte=="")
    {
       echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
       echo '<script>window.location="index.php"</script>';
    }
    else
    {
      $insertSQL = $con->prepare("UPDATE jugadores SET nombre = '$nombre', telefono = '$telefono', 
      correo = '$correo', id_deporte = '$id_deporte' WHERE documento = '".$_GET['id']."'");
      $insertSQL -> execute();
      echo '<script> alert("ACTUALIZACIÓN EXITOSA");</script>';
      echo '<script>window.location="index.php"</script>';
      
  } 
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar</title>
    <link rel="stylesheet" href="../../css/updateu.css">
</head>
<body>
    <div class="formulario">
        <h1>Editar Jugador</h1>
        <form method="POST" name="formreg" autocomplete="off">

            <div class="campos">
                <input type="text" name="documento" value="<?php echo $usua['documento']?>" readonly> 
                <input type="text" name="nombre" pattern="[a-zA-Z ]{3,30}" title="El nombre debe tener solo letras" value="<?php echo $usua['nombre']?>">
            </div>
            <div class="campos">
                <input type="text" name="telefono" pattern="[0-9 ]{10}" title="El telefono debe tener solo numeros" value="<?php echo $usua['telefono']?>">
                <input type="text" name="correo" pattern="[0-9a-zA-Z@-., ]{6,30}" title="El correo debe tener numeros y letras" value="<?php echo $usua['correo']?>">
            </div>
            
            <select name="id_deporte">
            <option value="<?php echo $usua['id_deporte']?>"><?php echo $usua['deporte']?></option>
            <?php
          
            $control = $con -> prepare ("SELECT * From deporte");
            $control -> execute();
            while ($fila = $control -> fetch(PDO::FETCH_ASSOC))
            {
            echo "<option value=" . $fila['id_deporte'] . ">" . $fila['deporte'] . "</option>";
            }
            ?>
            </select>

            <br><br>
            <input type="submit" name="update" value="Actualizar">
        </form>
    </div>
</body>
</html>
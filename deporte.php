<?php
$conexion = mysqli_connect("localhost", "root", "", "campeonato");

$tip_deport = $_POST['id_tip_deporte'];

$sql="SELECT deporte.id_deporte, deporte.deporte FROM tipo_deporte INNER JOIN deporte ON tipo_deporte.id_tip_deporte = deporte.id_tip_deporte
AND tipo_deporte.id_tip_deporte = '$tip_deport'";

$result = mysqli_query($conexion, $sql);
$cadena = "<label>deporte</label>";
while ($ver = mysqli_fetch_assoc($result)) {
    $cadena .= '<option value=' . $ver['id_deporte'] . '>' . $ver['deporte'] . '</option>';
}
echo $cadena . "</select>";

?>

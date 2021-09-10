<?php
include "conexion.php";

$v1 = $_REQUEST['id_proveedor'];
$v2 = $_REQUEST['nombre'];
$v3 = $_REQUEST['ruc'];

$update = (" UPDATE proveedor SET nombre='".$v2."', ruc='".$v3."' WHERE id_proveedor='".$v1."' ");
$result_update = mysqli_query($conn, $update);

echo "<script type='text/javascript'> window.location='gestionarProveedores.php'; </script>";

?>
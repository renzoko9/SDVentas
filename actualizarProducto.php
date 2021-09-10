<?php
include "conexion.php";

$v1 = $_REQUEST['id_producto'];
$v2 = $_REQUEST['nombre'];
$v3 = $_REQUEST['categoria'];
$v4 = $_REQUEST['marca'];
$v5 = $_REQUEST['precioVenta'];

$update = (" UPDATE producto SET nombre='".$v2."', categoria='".$v3."', marca='".$v4."', precioVenta='".$v5."' WHERE id_producto='".$v1."' ");
$result_update = mysqli_query($conn, $update);

echo "<script type='text/javascript'> window.location='verProductos.php'; </script>";

?>
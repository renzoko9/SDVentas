<?php
include "conexion.php";

$id = $_REQUEST['id_producto'];

$DeleteRegistro = (" DELETE FROM producto WHERE id_producto='" .$id. "' ");
$DeleteRegistro2 = (" DELETE FROM inventario WHERE id_producto='" .$id. "' ");

mysqli_query($conn, $DeleteRegistro);
mysqli_query($conn, $DeleteRegistro2);

echo "<script type='text/javascript'> window.location='verProductos.php'; </script>";

?>
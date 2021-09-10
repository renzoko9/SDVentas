<?php
include "conexion.php";

$id = $_REQUEST['id_proveedor'];

$DeleteRegistro = (" DELETE FROM proveedor WHERE id_proveedor='" .$id. "' ");

mysqli_query($conn, $DeleteRegistro);

echo "<script type='text/javascript'> window.location='gestionarProveedores.php'; </script>";

?>
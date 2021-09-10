<?php
include "conexion.php";

if(empty($_REQUEST['nombre']) || empty($_REQUEST['ruc'])){
    $alert='<div class="alert alert-danger" role="alert">Por favor, complete todos los campos</div>';
}else{
	$v1 = $_REQUEST['nombre'];
	$v2 = $_REQUEST['ruc'];

	$add = "INSERT INTO proveedor (ruc, nombre) VALUES ('$v2', '$v1')";
	$result_add = mysqli_query($conn, $add);
}

echo "<script type='text/javascript'> window.location='gestionarProveedores.php'; </script>";

?>
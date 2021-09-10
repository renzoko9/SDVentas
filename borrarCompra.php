<?php
include "conexion.php";

$id = $_REQUEST['id_compra'];

$sql = "SELECT * FROM detalle_compra WHERE id_compra='$id'";
$query = mysqli_query($conn, $sql);
if(mysqli_num_rows($query)>0){
    while($data = mysqli_fetch_array($query)){
        $id_prod = $data['id_producto']; 
        $cantidad = $data['cantidad'];
    	$sql2 = "SELECT * FROM inventario WHERE id_producto='$id_prod'";
    	$query2 = mysqli_query($conn, $sql2);
    	$dataInv = mysqli_fetch_array($query2);
    	$cantidadAct = $dataInv['cantidad'];
    	$update = "UPDATE inventario SET cantidad='".($cantidadAct - $cantidad)."' WHERE id_producto='$id_prod'";
  		$result_update = mysqli_query($conn, $update);
    }
}

$DeleteRegistro = (" DELETE FROM detalle_compra WHERE id_compra='" .$id. "' ");
$DeleteRegistro2 = (" DELETE FROM compra WHERE id_compra='" .$id. "' ");

mysqli_query($conn, $DeleteRegistro);
mysqli_query($conn, $DeleteRegistro2);

echo "<script type='text/javascript'> window.location='verCompras.php'; </script>";

?>
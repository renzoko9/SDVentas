<?php
    if(!empty($_POST)){
        session_start();
        include "conexion.php";
        $id_venta = $_POST['id_venta'];
        $query = mysqli_query($conn, "DELETE FROM venta WHERE id_venta='".$id_venta."'");
        $consulta = mysqli_query($conn, "DELETE FROM detalle_venta WHERE id_venta='".$id_venta."'");
        header('Location: boletas.php');
    }
?>
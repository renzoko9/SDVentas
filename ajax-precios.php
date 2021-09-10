<?php
    include "conexion.php";
    $salida = "";

    //$varAjax=$_POST['consulta'];
    
    if(isset($_POST['consulta'])){
        $resultado = mysqli_query($conn,"SELECT * FROM producto WHERE id_producto='".$_POST['consulta']."'");
        if(mysqli_num_rows($resultado)>0){
            $fila = mysqli_fetch_assoc($resultado);
            $salida=$fila['precioVenta'];
        }

    }
    // while($codigo = mysqli_fetch_assoc($consulta)){
    //     $array_data[]=$codigo;
    //     echo $codigo['marca'];
    // }
    echo $salida;
?>
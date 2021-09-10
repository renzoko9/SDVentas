<?php
$conn = mysqli_connect("localhost","root","","sdventa");
if (!$conn) {
    die("Error de conexion: ".mysqli_connect_error());
}
// include "conexion.php";
// $query = mysqli_query($conn,"SELECT * FROM producto WHERE id_producto=1");
// //$array_data = array();
// if(mysqli_num_rows($query)>0){
//     //echo "Más de uno";
//     while($data = mysqli_fetch_array($query)){
//         echo $data['id_producto'];
//         //$array_data[]=$codigo;
//     }
// }    
    //echo json_encode($array_data);
?>
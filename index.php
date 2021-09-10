<?php
    $alert='';
    session_start();
    if(!empty($_REQUEST['ingresar'])){
        if(empty($_REQUEST['usuario']) || empty($_REQUEST['clave'])){
            $alert = '<p style="color:red;">Complete los campos usuario y contraseña</p>';
            session_destroy();
        }else{
            include 'conexion.php';
            $usuario = mysqli_real_escape_string($conn,$_REQUEST['usuario']);
			$clave = mysqli_real_escape_string($conn,$_REQUEST['clave']); //md5($_REQUEST['clave']);   //encriptamos

            $query= mysqli_query($conn, "select * from vendedor where usuario = '$usuario' AND  contrasenia = '$clave' ");
            if(mysqli_num_rows($query)>0){
                $data = mysqli_fetch_array($query);
                //$_SESSION['active'] = true;
				$_SESSION['id_vendedor'] = $data['id_vendedor'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['apellido'] = $data['apellido'];
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['contrasenia'] = $data['contrasenia'];
                
                header('Location: consultarProductos.php');                     //VENDEDOR

            }else{
                if($usuario == "admin" && $clave == "admin"){
                    header('Location: reporteVentas.php');                      //ADMIN
                }else if($usuario == "almacenero" && $clave == "alma12345"){   
                    header('Location: verProductos.php');                       //ALMACENERO
                }else {           
                        $alert='El usuario o la clave son incorrectos';
                        session_destroy();
                }  
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" href="assets/images/logo2.png">
    <link rel="shortcut icon" href="assets/images/logo2.png">
    <link rel="stylesheet" href="assets/css/login.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Krub&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <img src="images/fondo_login.png" alt="venta" class="fondo_login">
    <form action="" method="post">
        <img src="images/logo2.png" alt="" class="logo_login">
        <p class="titulo_login">Sistema de Gestión de Ventas</p>
        <input class="input_usuario" type="text" name="usuario" placeholder="Usuario" autocomplete="off">
        <input class="input_clave" type="password"  name="clave" placeholder="Contraseña"autocomplete="off">
        <div><?php echo isset($alert)? $alert : ''; ?></div>
        <input class="btn_ingresar" type="submit" value="INGRESAR" name="ingresar">
        <a href="principal.php" class="registrese_login">Atrás</a>
    </form>     
</body>
</html>
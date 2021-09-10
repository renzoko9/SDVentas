<?php
    $alert='';
	session_start();
        if(!empty($_REQUEST)){//Si hay una petición al servidor
            if(empty($_REQUEST['nombre']) || empty($_REQUEST['apellido']) || empty($_REQUEST['usuario']) || empty($_REQUEST['contrasenia']) ){
                    $alert='<p style="color: red;">Complete todos los campos</p>';
                    //exit;
            }else if($_REQUEST['contrasenia']!=$_REQUEST['contraseniaR']){
                    $alert = 'Las contraseñas no coinciden';
                    //exit;
            }else{
                include 'conexion.php';
                //capturando datos
                $v1 = $_REQUEST['nombre'];
                $v2 = $_REQUEST['apellido'];
                $v3 = $_REQUEST['usuario'];
                $v4 = $_REQUEST['contrasenia'];

                $sql = "INSERT INTO vendedor (nombre, apellido, usuario, contrasenia) ";
                $sql .= "VALUES ('$v1', '$v2', '$v3', '$v4')";
                if (mysqli_query($conn, $sql)){
                    echo '<script> alert("Datos ingresados exitosamente"); </script>';
                }else{
                    echo '<script> alert("Error"); </script>';
                    //"Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                //header('Location: index');
            }
        }
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema de Gestión de Ventas</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/ajustes.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>
    <!-- Left Panel -->

    <?php include 'componentes/panelNavAdmin.php' ?>

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <?php include 'componentes/header.php' ?>
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Vendedores</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Vendedores</a></li>
                                    <li class="active">Añadir Vendedor</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">


                <div class="row centrar">
                    <!-- Formulario de agregar nuevo vendedor
                    
                    Sugerencia: usar boton siguiente para rellenar usuario y contraseña
                    
                    -->                    
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <strong>Agregar Vendedor</strong> Datos Personales
                            </div>
                            <div class="card-body card-block">
                                <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nombres</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="nombre" placeholder="Nombres" class="form-control"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Apellidos</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="apellido" placeholder="Apellidos" class="form-control"></div>
                                    </div>
                                    <hr>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="email-input" class=" form-control-label">Usuario</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="email-input" name="usuario" placeholder="Usuario" class="form-control"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="password-input" class=" form-control-label">Contraseña</label></div>
                                        <div class="col-12 col-md-9"><input type="password" id="password-input" name="contrasenia" placeholder="Contraseña" class="form-control"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="password-input" class=" form-control-label">Repite Contraseña</label></div>
                                        <div class="col-12 col-md-9"><input type="password" id="password-input" name="contraseniaR" placeholder="Contraseña" class="form-control"></div>
                                    </div>
                                    <div><?php echo isset($alert)? $alert : ''; ?></div> 
                                    <div class="row alinearBoton">
                                        <div class="form-actions form-group">
                                            <button type="submit" class="btn btn-success btn-sm">Agregar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- .animated -->
        </div><!-- .content -->

    <div class="clearfix"></div>

    <?php include "componentes/footer.php" ?>

</div><!-- /#right-panel -->

<!-- Right Panel -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="assets/js/main.js"></script>


</body>
</html>

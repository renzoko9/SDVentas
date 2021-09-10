<?php
    $alert='';
	session_start();
	// if(!empty($_SESSION['active'])){
	// 	//header('Location: index');
	// }else{   
        if(!empty($_REQUEST)){//Si hay una petición al servidor
            if(empty($_REQUEST['nombre']) || empty($_REQUEST['marca']) || empty($_REQUEST['categoria']) || empty($_REQUEST['precioVenta'])){
                    $alert='<div class="alert alert-danger" role="alert">Por favor, complete todos los campos</div>';
                    //$alert='<p style="color: red;">Complete todos los campos</p>';
                    //exit;
            }else{

                include "conexion.php";

                //capturando datos
                $v1 = $_REQUEST['nombre'];
                $v2 = $_REQUEST['marca'];
                $v3 = $_REQUEST['descripcion'];
                $v4 = $_REQUEST['categoria'];
                $v5 = $_REQUEST['precioVenta'];

                $ruta = "";
                if($_FILES["file1"]["error"] > 0){

                }else{
                    $nom_archivo = $_FILES['file1']['name'];
                    //$ruta = "imagenes/".$nom_archivo;
                    $ruta = "images/avatar/".$v1."".$nom_archivo;
                    $archivo = $_FILES['file1']['tmp_name'];
                    $subir = move_uploaded_file($archivo, $ruta);
                }

                $sql = "INSERT INTO producto (nombre, marca, descripcion, categoria, precioVenta, foto) ";
                $sql .= "VALUES ('$v1', '$v2', '$v3', '$v4', '$v5', '$ruta')";

                if (mysqli_query($conn, $sql)){
                    $query= mysqli_query($conn, "SELECT * FROM producto ORDER BY id_producto DESC LIMIT 1");
                    $id_producto = mysqli_fetch_array($query)['id_producto'];
                    $sql = "INSERT INTO inventario (id_producto, cantidad) VALUES ('$id_producto', '0')";

                    if (mysqli_query($conn, $sql)){
                        $alert='<div class="alert alert-success" role="alert">Los datos fueron registrados correctamente</div>';
                    }else{
                        $alert='<div class="alert alert-success" role="alert">Error en la base de datos</div>';
                    }
                }else{
                    $alert='<div class="alert alert-success" role="alert">Error en la base de datos</div>';
                    //"Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                //header('Location: index');
            }
        }
    //}
?>



<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Huellitas</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="images/logoPrincipal.svg">
    <link rel="shortcut icon" href="images/logoPrincipal.svg">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

    <style>
        #weatherWidget .currentDesc {
            color: #ffffff!important;
        }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
            height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart{
            height: 160px;
        }
    </style>
</head>
<body>
    <?php include "componentes/panelNavAlm.php" ?>
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <?php include "componentes/header.php" ?>
        <!-- Content -->
        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Añadir Producto</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <!--<li><a href="#">Gestionar Veterinarios</a></li>
                                    <li class="active">Añadir Veterinario</li>-->
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="card">
                            <div class="card-header">
                                <strong>Rellene los campos</strong>
                            </div>
                            <div class="card-body card-block">
                                <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="inombre" class=" form-control-label">Nombre</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="inombre" name="nombre" placeholder="Nombre" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="imarca" class=" form-control-label">Marca</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="imarca" name="marca" placeholder="Marca" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="idescripcion" class=" form-control-label">Descripción</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <textarea name="descripcion" id="idescripcion" rows="5" placeholder="Descripción" class="form-control" autocomplete="off"></textarea>
                                        </div>

                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="icategoria" class=" form-control-label">Categoría</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="icategoria" name="categoria" placeholder="Categoría" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="iprecio" class=" form-control-label">Precio unitario</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="iprecio" name="precioVenta" placeholder="Precio unitario" class="form-control" autocomplete="off" pattern="[0-9]{1,10}(\.[0-9]{1,2})?">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="ifoto" class=" form-control-label">Foto</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="file" name="file1" id="ifoto" style="font-size: 15px">
                                        </div>
                                    </div>
                                    
                                    <label><?php echo isset($alert)? $alert : ''; ?></label>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Añadir producto</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <?php include "componentes/footer.php" ?>
    </div>
    <!-- /#right-panel -->
    <?php include "componentes/librerias.php" ?>

</body>
</html>

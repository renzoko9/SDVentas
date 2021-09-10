<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ela Admin - HTML5 Admin Template</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="assets/images/logo2.png">
    <link rel="shortcut icon" href="assets/images/logo2.png">

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
    <?php include "componentes/panelNav.php" ?>
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <?php include "componentes/header.php" ?>
        <!-- Content -->
    <div class="content">
        <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="card">
                            <div class="card-header">
                                <strong>Consultar Productos</strong>
                            </div>
                            <div class="card-body card-block">
                                <form action="" method="post" class="form-horizontal">
                                    <div class="row form-group">
                                        <div class="col col-md-3  offset-md-2">
                                            <label for="text-input" class=" form-control-label">Buscar por</label>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <select name="campo" id="opcionesPerro" class="form-control">
                                                <option value = "nombre">Nombre</option>
                                                <option value = "id_producto">Código</option>
                                                <option value = "marca">Marca</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3 offset-md-2">
                                            <label for="text-input" class=" form-control-label">Búsqueda de</label>
                                        </div>
                                        <div class="col-12 col-md-5">
                                            <input type="text" id="campoA1" name="texto" placeholder="Buscar" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <!-- <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Nombre</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text"id="campoA1" name="dni_u" placeholder="Nombre" class="form-control" autocomplete="off">
                                        </div>
                                    </div> -->
                                    <div class="row form-group">
                                        <input type="hidden" name="accion" value="1">
                                        <!-- <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Añadir usuario</button> -->
                                        <div class="col col-md-2 offset-md-4 alinear-btn">
                                            <!--<i class="fa fa-search"></i>-->
                                            <Input type="Submit" class="btn btn-success" value="Consultar">
                                            <!--<Input type="Submit" class="btn btn-info" value="Actualizar">-->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="animated fadeIn">
                <div class="row">
                    <?php
                        if(!empty($_REQUEST) && !empty($_REQUEST['texto'])){
                            //conexion base de datos
                            include 'conexion.php';
                            //capturamos los datos
                            $v1 = $_REQUEST['campo'];
                            $v2 = $_REQUEST['texto'];
                            //realizamos la consulta de la tabla producto
                            $sql = "select * from producto where ".$v1." like '".$v2."'";
                            $result = mysqli_query($conn, $sql);
                            //cuantos resultados hay en la busqueda
                            if(mysqli_num_rows($result)>0){
                                $num_resultados = mysqli_num_rows($result);
                                //mostramos informacion de los productos a detalle
                                for ($i=0; $i <$num_resultados; $i++) {
                                    $row = mysqli_fetch_array($result);
                    ?>

                    <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mx-auto d-block">
                                            <img class=" mx-auto d-block" src="<?php echo $row['foto']; ?>" width="100px" height="150px" alt="Foto vet">
                                            <h5 class="text-sm-center mt-2 mb-1">
                                                <b><?php echo $row['nombre'] ?></b>
                                            </h5>
                                            <div class="location text-sm-center"><!--<i class="fa fa-map-marker"></i> California, United States-->
                                            <b>Código: </b><?php echo $row['id_producto'] ?><br>
                                            <b>Descripción: </b><?php echo $row['descripcion'] ?><br>
                                            <b>Categoría: </b><?php echo $row['categoria'] ?><br>
                                            <b>Marca: </b><?php echo $row['marca'] ?><br>
                                            <b>Precio unitario: </b><?php echo $row['precioVenta'] ?><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>

                    <?php
                                } //for
                            }else{ //if
                                echo '<p style="padding-left: 30rem;">No se encontró ningún producto con dicha información</p>';
                            }
                        }else{
                            //consulta total de los productos
                            include 'conexion.php';
                            //realizamos la consulta de la tabla producto
                            $sql = "select * from producto";
                            $result = mysqli_query($conn, $sql);
                            //cuantos resultados hay en la busqueda
                            if(mysqli_num_rows($result)>0){
                                $num_resultados = mysqli_num_rows($result);
                                //mostramos informacion de los productos a detalle
                                for ($i=0; $i <$num_resultados; $i++) {
                                    $row = mysqli_fetch_array($result); 
                    ?>

                    <div class="col-md-4">
                            <button type="submit" style="border: none; cursor: pointer;">
                                <input type="hidden" name="perro_id" value="12345">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mx-auto d-block">
                                            <img class=" mx-auto d-block" src="<?php echo $row['foto']; ?>" width="100px" height="150px" alt="Foto vet">
                                            <h5 class="text-sm-center mt-2 mb-1">
                                                <b><?php echo $row['nombre'] ?></b>
                                            </h5>
                                            <div class="location text-sm-center"><!--<i class="fa fa-map-marker"></i> California, United States-->
                                            <b>Código: </b><?php echo $row['id_producto'] ?><br>
                                            <b>Descripción: </b><?php echo $row['descripcion'] ?><br>
                                            <b>Categoría: </b><?php echo $row['categoria'] ?><br>
                                            <b>Marca: </b><?php echo $row['marca'] ?><br>
                                            <b>Precio unitario: </b><?php echo $row['precioVenta'] ?><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </button>
                    </div>

                    <?php  
                                } //for
                            }else{ //if
                                echo '<p style="padding-left: 30rem;">No se encontró ningún producto</p>';
                            }
                        } //else
                    ?>

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

<?php
    session_start();
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<html lang="en">
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
    <link rel="stylesheet" href="assets/css/style2.css">
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
                                <h1>Ver Compras</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <!--<li><a href="#">Gestionar Veterinarios</a></li>
                                    <li class="active">Editar Veterinarios</li>-->
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
                    <div class="col-lg-8 offset-md-2">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Compras registradas</strong>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <!--<th class="avatar">Foto</th>-->
                                            <th scope="col">Codigo</th>
                                            <th width="28%" scope="col">Fecha y Hora</th>
                                            <!--<th scope="col">Descripción</th>-->
                                            <th scope="col">RUC Proveedor</th>
                                            <th scope="col">Proveedor</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                            include "conexion.php";
                                            $query= mysqli_query($conn, "SELECT * FROM compra");
                                            if(mysqli_num_rows($query)>0){
                                                while($data = mysqli_fetch_array($query)){
                                                    $id_prov = $data['id_proveedor']; 

                                                    $query2 = mysqli_query($conn, "SELECT * FROM proveedor WHERE id_proveedor='$id_prov'");
                                                    $dataProv = mysqli_fetch_array($query2);
                                        ?>
                                        <tr>
                                            <!--<td class="avatar">
                                                <div class="round-img">
                                                    <a href="#"><img class="rounded-circle" src="<?php //echo $data['foto']; ?>" alt=""></a>
                                                </div>
                                            </td>-->
                                            <th scope="row"><?php echo $data['id_compra']; ?></th>
                                            <td><?php echo $data['fecha']." ".$data['hora']; ?></td>
                                            <td><?php echo $dataProv['ruc']; ?></td>                            
                                            <td><?php echo $dataProv['nombre']; ?></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#details<?php echo $data['id_compra']; ?>"><i class="fa fa-eye"></i></button>

                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $data['id_compra']; ?>"><i class="fa fa-trash-o"></i></button>
                                            </td>
                                        </tr>


            <!-- =======================MODAL DETALLES================================== -->
            <div class="modal fade" id="details<?php echo $data['id_compra']; ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mediumModalLabel">Detalles de Compra</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="">
                            <div class="modal-body">
                                <input type="hidden" name="id_compra" value="<?php echo $data['id_compra']; ?>">
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Código</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <label for="text-input" class=" form-control-label"><?php echo $data['id_compra']; ?></label>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Fecha</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <label for="text-input" class=" form-control-label"><?php echo $data['fecha']." ".$data['hora']; ?></label>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Proveedor</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <label for="text-input" class=" form-control-label"><?php echo $dataProv['nombre']; ?></label>
                                    </div>
                                </div>
                                <center><b>Productos</b></center><br>
                                <div class="row form-group">
                                    <div class="col-12 col-md-3">
                                        <label for="text-input" class=" form-control-label"><b>Codigo</b></label>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="text-input" class=" form-control-label"><b>Nombre</b></label>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="text-input" class=" form-control-label"><b>Cantidad</b></label>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="text-input" class=" form-control-label"><b>Precio</b></label>
                                    </div>
                                </div>
                                <?php 
                                $id_compra = $data['id_compra'];
                                $query3 = mysqli_query($conn, "SELECT * FROM detalle_compra WHERE id_compra='$id_compra'");
                                $prueba = "SELECT * FROM detalle_compra WHERE id_compra='$id_compra'";
                                    if(mysqli_num_rows($query3)>0){
                                        while($dataDetalle = mysqli_fetch_array($query3)){
                                            $id_prod = $dataDetalle['id_producto']; 
                                            $query4 = mysqli_query($conn, "SELECT * FROM producto WHERE id_producto='$id_prod'");
                                            $dataProd = mysqli_fetch_array($query4);
                                ?>
                                <div class="row form-group">
                                    <div class="col-12 col-md-3">
                                        <label for="text-input" class=" form-control-label"><?php echo $dataProd['id_producto']; ?></label>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="text-input" class=" form-control-label"><?php echo $dataProd['nombre']; ?></label>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="text-input" class=" form-control-label"><?php echo $dataDetalle['cantidad']; ?></label>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="text-input" class=" form-control-label"><?php echo $dataDetalle['precioCompra']; ?></label>
                                    </div>
                                </div>
                                <?php
                                        }
                                    }
                                ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- =======================FIN MODAL DETALLES================================== -->
            <!-- =======================MODAL BORRAR================================== -->
          <div class="modal fade" id="delete<?php echo $data['id_compra']; ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mediumModalLabel">¿Realmente desea borrar esta compra?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="borrarCompra.php">
                            <div class="modal-body">
                                <input type="hidden" name="id_compra" value="<?php echo $data['id_compra']; ?>">
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="text-input" class=" form-control-label">Código</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <label for="text-input" class=" form-control-label"><?php echo $data['id_compra']; ?></label>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="text-input" class=" form-control-label">Fecha y hora</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <label for="text-input" class=" form-control-label"><?php echo $data['fecha']." ".$data['hora']; ?></label>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="text-input" class=" form-control-label">RUC Proveedor</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <label for="text-input" class=" form-control-label"><?php echo $dataProv['ruc']; ?></label>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="text-input" class=" form-control-label">Proveedor</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <label for="text-input" class=" form-control-label"><?php echo $dataProv['nombre']; ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-danger"><i class="fa ti-trash"></i>&nbsp;&nbsp;Borrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- =======================FIN MODAL BORRAR================================== -->
                                    <?php
                                            }
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        <!-- /.content -->
        <div class="clearfix"></div>
        <br><br><br><br><br>
        <br><br>
        <?php include "componentes/footer.php"; ?>
    </div>
    <!-- /#right-panel -->
    <?php include "componentes/librerias.php"; ?>

</body>
</html>
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
                                <h1>Ver Productos</h1>
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
                <div class="row" >
                    <div class="col-lg-8 offset-md-2" >
                        <div class="card" style="; width: 750px;">
                            <div class="card-header">
                                <strong class="card-title">Productos registrados</strong>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" >
                                    <thead>
                                        <tr>
                                            <!--<th class="avatar">Foto</th>-->
                                            <th scope="col" width="50%">Codigo</th>
                                            <th scope="col">Foto</th>
                                            <th scope="col">Nombre</th>
                                            <!--<th scope="col">Descripción</th>-->
                                            <th scope="col">Categoría</th>
                                            <th scope="col" width="60%">Marca</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                            include "conexion.php";
                                            $query= mysqli_query($conn, "SELECT * FROM producto");
                                            if(mysqli_num_rows($query)>0){
                                                while($data = mysqli_fetch_array($query)){
                                                    $id_prod = $data['id_producto']; 
                                                    $query2= mysqli_query($conn, "SELECT * FROM inventario WHERE id_producto='$id_prod'");
                                                    $cantidad = mysqli_fetch_array($query2);
                                        ?>

                                        <tr>
                                            <th scope="row"><?php echo $data['id_producto']; ?></th>
                                            <td class="avatar">
                                                <div class="round-img">
                                                    <a href="#"><img class="rounded-circle" src="<?php echo $data['foto']; ?>" alt="" height="35px" width="35px"></a>
                                                </div>
                                            </td>
                                            <td><?php echo $data['nombre']; ?></td>
                                            <td><?php echo $data['categoria']; ?></td>                            
                                            <td><?php echo $data['marca']; ?></td>
                                            <td><?php echo $data['precioVenta']; ?></td>
                                            <td><?php echo $cantidad['cantidad']; ?></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?php echo $data['id_producto']; ?>"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $data['id_producto']; ?>"><i class="fa fa-trash-o"></i></button>
                                            </td>
                                        </tr>


            <!-- =======================MODAL EDITAR================================== -->
            <div class="modal fade" id="edit<?php echo $data['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mediumModalLabel">Editar Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="actualizarProducto.php">
                            <div class="modal-body">
                                <input type="hidden" name="id_producto" value="<?php echo $data['id_producto']; ?>">
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Código</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="id_producto" placeholder="Código" class="form-control" value="<?php echo $data['id_producto']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="inombre" class=" form-control-label">Nombre</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="inombre" name="nombre" placeholder="Nombre" class="form-control" value="<?php echo $data['nombre']; ?>">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="imarca" class=" form-control-label">Marca</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="imarca" name="marca" placeholder="Marca" class="form-control" value="<?php echo $data['marca']; ?>">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="icategoria" class=" form-control-label">Categoría</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="icategoria" name="categoria" placeholder="Categoría" class="form-control" value="<?php echo $data['categoria']; ?>">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="iventa" class=" form-control-label">Precio</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="iventa" name="precioVenta" placeholder="Precio Venta" class="form-control" value="<?php echo $data['precioVenta']; ?>" pattern="[0-9]{1,10}(\.[0-9]{1,2})?">
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- =======================FIN MODAL EDITAR================================== -->
            <!-- =======================MODAL BORRAR================================== -->
            <div class="modal fade" id="delete<?php echo $data['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mediumModalLabel">¿Realmente desea borrar este producto?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="borrarProducto.php">
                            <div class="modal-body">
                                <input type="hidden" name="id_producto" value="<?php echo $data['id_producto']; ?>">
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Código: </label>
                                    </div>
                                    <div class="col col-lg-9">
                                        <label for="text-input" class=" form-control-label"><?php echo $data['id_producto']; ?></label>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Nombre: </label>
                                    </div>
                                    <div class="col col-lg-9">
                                        <label for="text-input" class=" form-control-label"><?php echo $data['nombre']; ?></label>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Marca: </label>
                                    </div>
                                    <div class="col col-lg-9">
                                        <label for="text-input" class=" form-control-label"><?php echo $data['marca']; ?></label>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Precio: </label>
                                    </div>
                                    <div class="col col-lg-9">
                                        <label for="text-input" class=" form-control-label"><?php echo $data['precioVenta']; ?></label>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Cantidad: </label>
                                    </div>
                                    <div class="col col-lg-9">
                                        <label for="text-input" class=" form-control-label"><?php echo $cantidad['cantidad']; ?></label>
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
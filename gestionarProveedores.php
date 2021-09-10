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
                                <h1>Gestionar Proveedores</h1>
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
                                <strong class="card-title">Proveedores registrados</strong>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <!--<th class="avatar">Foto</th>-->
                                            <th scope="col">Codigo</th>
                                            <th scope="col">Nombre</th>
                                            <!--<th scope="col">Descripción</th>
                                            <th scope="col">Categoría</th>-->
                                            <th scope="col">RUC</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include "conexion.php";

                                            $query= mysqli_query($conn, "SELECT * FROM proveedor");
                                            if(mysqli_num_rows($query)>0){
                                                while($data = mysqli_fetch_array($query)){
                                            
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $data['id_proveedor']; ?></th>
                                            <td><?php echo $data['nombre']; ?></td>
                                            <td><?php echo $data['ruc']; ?></td>   
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?php echo $data['id_proveedor']; ?>"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $data['id_proveedor']; ?>"><i class="fa fa-trash-o"></i></button>
                                            </td>
                                        </tr>
            
            <!-- =======================MODAL EDITAR================================== -->
            <div class="modal fade" id="edit<?php echo $data['id_proveedor']; ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mediumModalLabel">Editar Proveedor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="actualizarProveedor.php">
                            <div class="modal-body">
                                <input type="hidden" name="id_proveedor" value="<?php echo $data['id_proveedor']; ?>">
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="icodigo" class=" form-control-label">Código</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="icodigo" name="id_proveedor" placeholder="Código" class="form-control" value="<?php echo $data['id_proveedor']; ?>" disabled>
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
                                        <label for="iruc" class=" form-control-label" >RUC</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="iruc" name="ruc" placeholder="RUC" class="form-control" value="<?php echo $data['ruc']; ?>" pattern="[0-9]{11}">
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
            <div class="modal fade" id="delete<?php echo $data['id_proveedor']; ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mediumModalLabel">¿Realmente desea borrar este proveedor?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="borrarProveedor.php">
                            <div class="modal-body">
                                <input type="hidden" name="id_proveedor" value="<?php echo $data['id_proveedor']; ?>">
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="inombre" class=" form-control-label">Código: </label>
                                    </div>
                                    <div class="col col-lg-9">
                                        <label for="text-input" class=" form-control-label"><?php echo $data['id_proveedor']; ?></label>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="inombre" class=" form-control-label">Nombre: </label>
                                    </div>
                                    <div class="col col-lg-9">
                                        <label for="text-input" class=" form-control-label"><?php echo $data['nombre']; ?></label>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="inombre" class=" form-control-label">RUC: </label>
                                    </div>
                                    <div class="col col-lg-9">
                                        <label for="text-input" class=" form-control-label"><?php echo $data['ruc']; ?></label>
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
                                <button class="btn btn-success" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i>&nbsp;&nbsp;Añadir proveedor</button>

            <!-- =======================MODAL AGREGAR================================== -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mediumModalLabel">Agregar Proveedor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="agregarProveedor.php">
                            <div class="modal-body">
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
                                        <label for="iruc" class=" form-control-label">RUC</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="iruc" name="ruc" placeholder="RUC" class="form-control"  autocomplete="off" pattern="[0-9]{11}">
                                    </div>
                                </div> 
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">&nbsp;&nbsp;Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- =======================FIN MODAL AGREGAR================================== -->
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
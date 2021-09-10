<?php
    session_start();
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
    <link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>
    

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <?php include "componentes/header.php" ?>
        <!-- Header-->

        <?php include "componentes/panelNavAdmin.php" ?>

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Reporte</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Reporte</a></li>
                                    <li class="active">Reporte de Utilidades</li>
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

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Reporte de Utilidades</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Ingreso</th>
                                            <th>Costo</th>
                                            <th>Utilidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                            //date_default_timezone_set('America/Lima');
                                            include 'conexion.php';

                                            $fechaIni = "02/09/2021";
                                            $fechaFinal = "09/09/2021";
                                            $utilidadTotal = 0;
                                            $queryFecha = mysqli_query($conn, "SELECT fecha FROM compra UNION SELECT fecha FROM venta");

                                            if(mysqli_num_rows($queryFecha)>0){
                                                while($dataFecha = mysqli_fetch_array($queryFecha)){
                                                $fechaIni = $dataFecha['fecha'];

                                                $totalVentas = 0;
                                                $totalCompras = 0;
                                                $utilidad = 0;
                                                $queryVenta = mysqli_query($conn, "SELECT * from venta where fecha='".$fechaIni."'");
                                                $queryCompra = mysqli_query($conn, "SELECT * from compra where fecha='".$fechaIni."'");
                                                if(mysqli_num_rows($queryVenta)>0){
                                                    while($data = mysqli_fetch_array($queryVenta)){
                                                        $totalVentas = $totalVentas + $data['efectivo'];
                                                    }
                                                }
                                                if(mysqli_num_rows($queryCompra)>0){
                                                    while($data = mysqli_fetch_array($queryCompra)){
                                                        $id_compra = $data['id_compra'];
                                                        $queryDetalleC = mysqli_query($conn, "SELECT * from detalle_compra where id_compra='$id_compra'");
                                                        if(mysqli_num_rows($queryDetalleC)>0){
                                                            while($dataDetalle = mysqli_fetch_array($queryDetalleC)){
                                                                $totalCompras = $totalCompras + $dataDetalle['precioCompra'];
                                                            }
                                                        }                                                       
                                                    }      
                                                }
                                                    //mostrar Ingresos
                                                    //mostrar Costos
                                                    //mostrar Utilidad
                                                    $utilidad = $totalVentas - $totalCompras;
                                                    $utilidadTotal += $utilidad;
                                                ?>
                                                <tr>
                                                    <td><?php echo $fechaIni; ?></td>
                                                    <td><?php echo $totalVentas; ?></td>
                                                    <td><?php echo $totalCompras; ?></td>
                                                    <td><?php echo "S/. ".$utilidad; ?></td>
                                                </tr>
                                                <?php
                                                }
                                            }  
                                                    
                                        ?>

                                    </tbody>
                                </table>
                                <div style="text-align: right; margin: 2rem 1rem; font-size: 17px; font-weight: bold;">
                                    <?php echo "Ingresos Totales: S/. ".$utilidadTotal; ?>
                                </div>
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


    <script src="assets/js/lib/data-table/datatables.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/jszip.min.js"></script>
    <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="assets/js/init/datatables-init.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
      } );
    </script>


</body>
</html>
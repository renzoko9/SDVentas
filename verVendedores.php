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
    <title>Sistema de Gestion de Ventas</title>
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

    <?php include "componentes/panelNavAdmin.php" ?>

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <?php include "componentes/header.php" ?>
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
                                    <li class="active">Ver Vendedores</li>
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
                    <?php
                        //consulta total de los productos
                        include 'conexion.php';
                        //realizamos la consulta de la tabla producto
                        $sql = "select * from vendedor";
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
                            <div class="card-header">
                                <i class="fa fa-user"></i><strong class="card-title pl-2"><?php echo "Código 00".$row['id_vendedor'] ?></strong>
                            </div>
                            <div class="card-body">
                                <div class="mx-auto d-block">
                                    <img class="rounded-circle mx-auto d-block" src="images/admin.jpg" alt="Card image cap">
                                </div>
                                <hr>
                                <div class="card-text text-sm-center">

                                    <h5 class="text-sm-center mt-2 mb-1"><strong>Nombres: </strong><?php echo $row['nombre'] ?></h5>
                                    <h5 class="text-sm-center mt-2 mb-1"><strong>Apellidos: </strong><?php echo $row['apellido'] ?></h5>
                                    <hr>
                                    <h5 class="text-sm-center mt-2 mb-1"><strong>Usuario: </strong><?php echo $row['usuario'] ?></h5>
                                    <h5 class="text-sm-center mt-2 mb-1"><strong>Contraseña: </strong><?php echo $row['contrasenia'] ?></h5>
                                    <hr>
                                    <?php
                                        $sql2 = "select * from venta where id_vendedor = ".$row['id_vendedor']."";
                                        $result2 = mysqli_query($conn, $sql2);
                                        $totalVentas = 0;
                                        if(mysqli_num_rows($result2)>0){
                                            $num_resultados2 = mysqli_num_rows($result2);
                                            //mostramos informacion de los productos a detalle
                                            for ($i=0; $i <$num_resultados2; $i++) {
                                                $row2 = mysqli_fetch_array($result2);
                                                $totalVentas = $totalVentas + $row2['efectivo'];
                                            }
                                        }
                                    ?>
                                    <h5 class="text-sm-center mt-2 mb-1"><strong><?php echo "Ventas: S/. ".$totalVentas; ?> </strong></h5>
                                    
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php
                            } //for
                        } //if
                    ?>

                </div><!-- .row -->
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

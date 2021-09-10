<?php
    session_start();
?>
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



    <!--
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
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
                    <div class="col-lg-8 offset-md-2">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Boletas Emitidas</strong>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Código</th>
                                            <th scope="col">Fecha y Hora</th>
                                            <th scope="col">DNI cliente</th>
                                            <th scope="col">Nombre cliente</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include 'conexion.php';
                                            $query = mysqli_query($conn, "select * from venta");
                                            if(mysqli_num_rows($query)>0){
                                                while($data = mysqli_fetch_array($query)){
                                                    $vendedor = mysqli_fetch_array(mysqli_query($conn, "select * from vendedor WHERE id_vendedor='".$data['id_vendedor']."'"));
                                                    $nombreVendedor = $vendedor['nombre'];
                                        ?>                                        
                                        <tr>
                                            <th scope="row"><?php echo "00".$data['id_venta']; ?></th>
                                            <td><?php echo "".$data['fecha']." ".$data['hora']; ?></td>
                                            <td><?php echo $data['dniCliente']; ?></td>
                                            <td><?php echo $data['nombreCliente']; ?></td>
                                            <td>
                                                <button data-toggle="modal" data-target="#boleta<?php echo $data['id_venta']; ?>" type="button" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></button>
                                                <button data-toggle="modal" data-target="#eliminar<?php echo $data['id_venta']; ?>" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                                            </td>
                                        </tr>
                                            <!-- Modal Boleta -->
                                            <div class="modal fade" id="boleta<?php echo $data['id_venta']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Boleta</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <iframe id="frame<?php echo $data['id_venta']; ?>" style="width: 100%; height: 500px; border: none;"></iframe>
                                                        <script>
                                                            function generarPDF(){
                                                                var codigo = "<?php echo "00".$data['id_venta']; ?>";
                                                                var nombre = "<?php echo $data['nombreCliente']; ?>";
                                                                var dni = <?php echo $data['dniCliente']; ?>;
                                                                var medioDePago = "Efectivo";
                                                                var cajero = "<?php echo $_SESSION['nombre']; ?>";
                                                                var pago = <?php echo $data['efectivo']; ?>;
                                                                // var numProductos = 5;
                                                                // Variables globales
                                                                var tamañoLetra = 15;   //Tamaño de letra
                                                                var inicioTodo = 10;    //Solo cambiar este valor para mover todo abajo
                                                                const doc = new jsPDF({
                                                                    format: [350, 400]
                                                                });
                                                                doc.setFontSize(tamañoLetra);
                                                                doc.setFont("courier", "normal");

                                                                doc.text("Cod. Boleta: "+codigo,5,inicioTodo);
                                                                doc.text("Cliente: "+nombre,5,inicioTodo+5);
                                                                doc.text("DNI: "+dni, 5, inicioTodo+10);
                                                                doc.text("Medio de Pago: "+medioDePago, 5, inicioTodo+15);
                                                                doc.text("Cajero: "+cajero,5, inicioTodo+20);
                                                                doc.text("Productos",45, inicioTodo+30);
                                                                doc.text("Cod",5, inicioTodo+35);
                                                                doc.text("Nombre",20, inicioTodo+35);
                                                                doc.text("Precio",57, inicioTodo+35);
                                                                doc.text("Cant",82, inicioTodo+35);
                                                                //doc.text("",85, 40);
                                                                // for (let i=0; i<numProductos; i++) {
                                                                //     doc.text("001",5,inicioTodo+40+i*5);
                                                                //     doc.text("Mermelada",20,inicioTodo+40+i*5);
                                                                //     doc.text("18.50",57,inicioTodo+40+i*5);
                                                                //     doc.text("2",82,inicioTodo+40+i*5);
                                                                //     doc.text("17.59",102,inicioTodo+40+i*5);
                                                                // }
                                                                var i = 0;
                                                                var total = 0;
                                                                
                                                                <?php
                                                                    $consulta = mysqli_query($conn, "select * from detalle_venta WHERE id_venta='".$data['id_venta']."'");
                                                                    if(mysqli_num_rows($consulta)>0){
                                                                        while($productos = mysqli_fetch_array($consulta)){
                                                                            $producto = mysqli_fetch_array(mysqli_query($conn, "select * from producto WHERE id_producto='".$productos['id_producto']."'"));
                                                                            
                                                                ?>
                                                                            doc.text("<?php echo $producto['id_producto']; ?>",5,inicioTodo+40+i*5);
                                                                            doc.text("<?php echo $producto['nombre']; ?>",20,inicioTodo+40+i*5);
                                                                            doc.text("<?php echo $producto['precioVenta']; ?>",57,inicioTodo+40+i*5);
                                                                            doc.text("<?php echo $productos['cantidad']; ?>",82,inicioTodo+40+i*5);
                                                                            doc.text("<?php echo $producto['precioVenta']*$productos['cantidad']; ?>",102,inicioTodo+40+i*5);
                                                                            total += <?php echo $producto['precioVenta']*$productos['cantidad']; ?>;
                                                                            i++;

                                                                <?php
                                                                        }
                                                                    }
                                                                ?>
                                                                doc.text("Subtotal: S/"+(total*0.82).toFixed(2),5, 5+inicioTodo+40+i*5);
                                                                doc.text("IGV: S/"+(total*0.18).toFixed(2),5, 10+inicioTodo+40+i*5);
                                                                doc.text("Total: S/"+(total).toFixed(2),5, 15+inicioTodo+40+i*5);
                                                                doc.text("Pago Realizado: S/"+(pago).toFixed(2),5, 20+inicioTodo+40+i*5);
                                                                doc.text("Vuelto: S/"+(pago-total).toFixed(2),5, 25+inicioTodo+40+i*5);
                                                                // doc.output('dataurlnewwindow', 'Boleta');
                                                                document.getElementById('frame<?php echo $data['id_venta']; ?>').setAttribute('src', doc.output('bloburl'));
                                                            }
                                                            generarPDF();
                                                        </script>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Fin Modal Boleta -->
                                            <!-- Modal Eliminar -->
                                            <div class="modal fade" id="eliminar<?php echo $data['id_venta']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="borrarBoleta.php" method="post">
                                                            <input type="hidden" name="id_venta" value="<?php echo $data['id_venta']; ?>">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">¿Realmente desea eliminar esta boleta?</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h6>Código: <?php echo "00".$data['id_venta']; ?></h6>
                                                                <br>
                                                                <h6>Fecha y Hora: <?php echo "".$data['fecha']." ".$data['hora']; ?></h6>
                                                                <br>
                                                                <h6>DNI cliente: <?php echo $data['dniCliente']; ?></h6>
                                                                <br>
                                                                <h6>Nombre Cliente: <?php echo $data['nombreCliente']; ?></h6>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-danger">Borrar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Fin Modal Eliminar -->
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
        <?php include "componentes/footer.php" ?>
    </div>
    <!-- /#right-panel -->
    <?php include "componentes/librerias.php" ?>

</body>
</html>

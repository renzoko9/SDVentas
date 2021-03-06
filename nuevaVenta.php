<?php

    if(!empty($_REQUEST)){
        session_start();
        date_default_timezone_set('America/Lima');
        include "conexion.php";
        $v1 = $_REQUEST['nombreCliente'];
        $v2 = $_REQUEST['dniCliente'];
        $v3 = date('d/m/Y');
        $v4 = date('h:i a', time());
        $v5 = $_SESSION['id_vendedor'];
        $v6 = "Efectivo";
        $v7 = $_REQUEST['efectivo'];
        $sql = "INSERT INTO venta (nombreCliente, dniCliente, fecha, hora, id_vendedor, medioDePago, efectivo) ";
        $sql .= "VALUES ('$v1', '$v2', '$v3', '$v4', '$v5', '$v6', '$v7')";
        mysqli_query($conn, $sql);
        $contador = $_REQUEST['contador'];
        //Obteneniendo el id que se acaba de insertar en la tabla:
        $id_venta = 0;
        $resultado = mysqli_query($conn,"SELECT * FROM venta");
        if(mysqli_num_rows($resultado)>0){
            while($data=mysqli_fetch_array($resultado)){
                if($data['id_venta']>$id_venta){
                    $id_venta=$data['id_venta'];
                }
            }
            //$fila = mysqli_fetch_assoc($resultado);
            //$salida=$fila['nombre'];
        }
        //$id_venta = "5";
        //Guardando los productos en la bd:
        for($i=1; $i<=$contador; $i++){
            $cod = 'cod'.$i;
            $v2 = $_REQUEST[$cod];
            $cant = 'cant'.$i;
            $v3  = $_REQUEST[$cant];
            if($v2 == "") break;
            $sql = "INSERT INTO detalle_venta (id_venta, id_producto, cantidad)";
            $sql .= "VALUES ('$id_venta', '$v2', '$v3')";
            mysqli_query($conn, $sql);
            $productoInv=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM inventario WHERE id_producto='".$_REQUEST[$cod]."'"));
            $cantidadNueva = $productoInv['cantidad'] - $_REQUEST[$cant];
            mysqli_query($conn, "UPDATE inventario SET cantidad='".$cantidadNueva."' WHERE id_producto='".$_REQUEST[$cod]."'");
        }
        
    }
    
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
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"> -->
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
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
                    <div class="col-md-8 offset-md-2">
                        <div class="card">
                            <div class="card-header">
                                <strong>Nueva Venta</strong>
                            </div>
                            <div class="card-body card-block">
                                <form action="" method="post" class="form-horizontal">
                                    <input type="hidden" name="contador" id="contador" value="3">
                                    <div class="row form-group">
                                        <div class="col col-md-3 offset-md-2">
                                            <label for="text-input" class=" form-control-label">Nombre</label>
                                        </div>
                                        <div class="col-12 col-md-5">
                                            <input type="text"id="campoA1" name="nombreCliente" placeholder="Nombre" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3 offset-md-2">
                                            <label for="text-input" class=" form-control-label">DNI</label>
                                        </div>
                                        <div class="col-12 col-md-5">
                                            <input type="text"id="campoA1" name="dniCliente" placeholder="DNI" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3  offset-md-2">
                                            <label for="text-input" class=" form-control-label">Medio de pago</label>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <select name="medioDePago" id="opcionesPerro" class="form-control" disabled>
                                                <option value = "efectivo" selected> Efectivo </option>
                                                <option value = "tarjeta"> Tarjeta </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-4 offset-md-5">
                                            <label for="text-input" class=" form-control-label">Productos</label>
                                        </div>
                                    </div>
                                    
                                    <div id="nuevo">
                                        <div>
                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <input type="text" id="cod1" name="cod1" placeholder="Cod." class="form-control" autocomplete="off">
                                                </div>
                                                <div class="col col-md-3">
                                                    <input type="text" id="nom1" name="nom1" placeholder="Nombre" class="form-control" autocomplete="off" disabled>
                                                </div>
                                                <div class="col col-md-2">
                                                    <input type="text" id="precio1" name="precio1" placeholder="Precio" class="form-control" autocomplete="off" disabled>
                                                </div>
                                                <div class="col col-md-2">
                                                    <input type="text" id="cant1" name="cant1" placeholder="Cant." class="form-control" autocomplete="off">
                                                </div>
                                                <div class="col col-md-2">
                                                    <input type="text" id="total1" name="total1" placeholder="" class="form-control" autocomplete="off" disabled>
                                                </div>
                                                <div class="col col-md-1">
                                                    <button type="button" class="btn btn-danger" onclick='borrarUno(this)'><i class="fa fa-trash-o"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <input type="text" id="cod2" name="cod2" placeholder="Cod." class="form-control" autocomplete="off">
                                                </div>
                                                <div class="col col-md-3">
                                                    <input type="text" id="nom2" name="nom2" placeholder="Nombre" class="form-control" autocomplete="off" disabled>
                                                </div>
                                                <div class="col col-md-2">
                                                    <input type="text" id="precio2" name="precio2" placeholder="Precio" class="form-control" autocomplete="off" disabled>
                                                </div>
                                                <div class="col col-md-2">
                                                    <input type="text" id="cant2" name="cant2" placeholder="Cant." class="form-control" autocomplete="off">
                                                </div>
                                                <div class="col col-md-2">
                                                    <input type="text" id="total2" name="total2" placeholder="" class="form-control" autocomplete="off" disabled>
                                                </div>
                                                <div class="col col-md-1">
                                                    <button type="button" class="btn btn-danger" onclick='borrarUno(this)'><i class="fa fa-trash-o"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <input type="text" id="cod3" name="cod3" placeholder="Cod." class="form-control" autocomplete="off">
                                                </div>
                                                <div class="col col-md-3">
                                                    <input type="text" id="nom3" name="nom3" placeholder="Nombre" class="form-control" autocomplete="off" disabled>
                                                </div>
                                                <div class="col col-md-2">
                                                    <input type="text" id="precio3" name="precio3" placeholder="Precio" class="form-control" autocomplete="off" disabled>
                                                </div>
                                                <div class="col col-md-2">
                                                    <input type="text" id="cant3" name="cant3" placeholder="Cant." class="form-control" autocomplete="off">
                                                </div>
                                                <div class="col col-md-2">
                                                    <input type="text" id="total3" name="total3" placeholder="" class="form-control" autocomplete="off" disabled>
                                                </div>
                                                <div class="col col-md-1">
                                                    <button type="button" class="btn btn-danger" onclick='borrarUno(this)'><i class="fa fa-trash-o"></i></button>
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="row form-group" id="a??adir">
                                        <div class="col col-md-4 offset-md-10">
                                            <button type="button" class="btn btn-success" id="a??adir" onclick="crear();"><i class="fa fa-plus"></i>&nbsp;&nbsp;A??adir</button>
                                        </div>
                                    </div>
                                    <script>
                                        var contador = 3;
                                        var numProductos = 3;
                                        var totalFinal = 0;
                                        function bucle(){
                                            for (var i = 1; i <= contador; i++) {
                                                (function (i) {
                                                    var cod = "cod" + i;
                                                    var input1 = document.getElementById(cod);
                                                    input1.addEventListener('input', nombrePrecio);
                                                    function nombrePrecio() {
                                                        var nom = "nom" + i;
                                                        var input2 = document.getElementById(nom);
                                                        //var cambio = "";
                                                        $.ajax({
                                                            url: "ajax-productos.php",
                                                            type: 'POST',
                                                            dataType: 'html',
                                                            data: {consulta: input1.value},
                                                        }).done(function(respuesta){
                                                            input2.value = respuesta;
                                                            // console.log("=========");
                                                            // console.log(respuesta);
                                                            // console.log("=========");
                                                        }).fail(function(){
                                                            console.log("error");
                                                        });
                                                        var precio = "precio" + i;
                                                        input3 = document.getElementById(precio);
                                                        //var cambio = "";
                                                        $.ajax({
                                                            url: "ajax-precios.php",
                                                            type: 'POST',
                                                            dataType: 'html',
                                                            data: {consulta: input1.value},
                                                        }).done(function(respuesta){
                                                            input3.value = respuesta;
                                                            // console.log("=========");
                                                            // console.log(respuesta);
                                                            // console.log("=========");
                                                        }).fail(function(){
                                                            console.log("error");
                                                        });
                                                        //buscarNombre(input1.value, i);
                                                        // var cant = "cant" + i;
                                                        // var input2 = document.getElementById(cant);
                                                        // input2.value = input1.value;
                                                    }
                                                }(i));
                                                
                                            }
                                        };
                                        window.setInterval(bucle,500);
                                        function bucle2(){
                                            for (var i = 1; i <= contador; i++) {
                                                (function (i) {
                                                    var cant = "cant" + i;
                                                    var input1 = document.getElementById(cant);

                                                    var precio = "precio" + i;
                                                    var input2 = document.getElementById(precio);
                                                    input1.addEventListener('input', multiplicar);
                                                    if(input2.value==""){
                                                        multiplicar();
                                                    }
                                                    //input2.addEventListener('input', multiplicar);
                                                    function multiplicar() { 
                                                        var total = "total"+i;
                                                        var input3 = document.getElementById(total);
                                                        if(input1.value=="" || input2.value==""){
                                                            input3.value = "";
                                                        }
                                                        if(input1.value!="" && input2.value!=""){
                                                            input3.value = parseInt(input1.value)*parseFloat(input2.value);
                                                        }
                                                            //var cambio = "";
                                                    }
                                                    
                                                }(i));                                                
                                            }
                                        }
                                        window.setInterval(bucle2,500);
                                        function bucle3(){
                                            totalFinal=0;
                                            for (var i = 1; i <= contador; i++) {
                                                (function (i) {
                                                    var total = "total"+i;
                                                    var input3 = document.getElementById(total);
                                                    if(input3.value!=""){
                                                        totalFinal += parseFloat(input3.value);
                                                        document.getElementById("totalFinal").value=totalFinal;
                                                        document.getElementById("igv").value=(totalFinal*0.18).toFixed(2);
                                                        document.getElementById("subtotal").value=(totalFinal*0.82).toFixed(2);
                                                    }
                                                }(i));                                                
                                            }
                                        }
                                        window.setInterval(bucle3,500);
                                        function bucle4(){
                                            var input = document.getElementById("pago");
                                            input.addEventListener('input', actualizarVuelto);
                                            function actualizarVuelto(){
                                                var total = document.getElementById("totalFinal").value;
                                                if(total!="" && input.value!=""){
                                                    document.getElementById("vuelto").value=(input.value-total).toFixed(2);
                                                }else{
                                                    document.getElementById("vuelto").value="";
                                                }
                                            }
                                        }
                                        window.setInterval(bucle4,500);

                                        function crear() {
                                            contador++;
                                            numProductos++;
                                            document.getElementById("contador").value=numProductos;
                                            var creardiv = document.createElement("div");
                                            creardiv.innerHTML = "<div class='row form-group'>      <div class='col col-md-2'><input type='text' id='cod" + contador + "' name='cod" + contador + "' placeholder='Cod.' class='form-control' autocomplete='off'></div>        <div class='col col-md-3'> <input type='text' id='nom" + contador + "' name='nom" + contador + "' placeholder='Nombre' class='form-control' autocomplete='off' disabled></div>        <div class='col col-md-2'> <input type='text' id='precio" + contador + "' name='precio" + contador + "' placeholder='Precio' class='form-control' autocomplete='off' disabled> </div>       <div class='col col-md-2'> <input type='text' id='cant" + contador + "' name='cant" + contador + "' placeholder='Cant.' class='form-control' autocomplete='off'></div>       <div class='col col-md-2'> <input type='text' id='total" + contador + "' name='total" + contador + "' placeholder='' class='form-control' autocomplete='off' disabled></div>      <div class='col col-md-1'> <button type='button' class='btn btn-danger' onclick='borrarUno(this)'><i class='fa fa-trash-o'></i></button></div>    </div>";
                                            document.getElementById("nuevo").appendChild(creardiv);
                                            console.log(numProductos);
                                        }

                                        function borrarUno(boton) {
                                            contador--;//MEJORAR ESTO LUEGO :v
                                            var borrardiv = boton.parentNode.parentNode.parentNode;
                                            document.getElementById("nuevo").removeChild(borrardiv);
                                            numProductos--;
                                            document.getElementById("contador").value=numProductos;
                                        }                           
                                    </script>
                                    
                                    <div class="row form-group">
                                        <div class="col col-md-2 offset-md-4">
                                            <label for="text-input" class=" form-control-label">Subtotal</label>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <input type="text"id="subtotal" name="dni_u" placeholder="Subtotal" class="form-control" autocomplete="off" disabled>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-2 offset-md-4">
                                            <label for="text-input" class=" form-control-label">IGV</label>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <input type="text"id="igv" name="dni_u" placeholder="IGV" class="form-control" autocomplete="off" disabled>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-2 offset-md-4">
                                            <label for="text-input" class=" form-control-label">Importe total</label>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <input type="text"id="totalFinal" name="dni_u" placeholder="Total" class="form-control" autocomplete="off" disabled>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-2 offset-md-4">
                                            <label for="text-input" class=" form-control-label">Total a pagar</label>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <input type="text"id="pago" name="efectivo" placeholder="Efectivo" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-2 offset-md-4">
                                            <label for="text-input" class=" form-control-label">Vuelto</label>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <input type="text"id="vuelto" name="dni_u" placeholder="Vuelto" class="form-control" autocomplete="off" disabled>
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
                                        <!-- <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;A??adir usuario</button> -->
                                        <div class="col col-md-2 offset-md-3">
                                            <button type="button" class="btn btn-primary"><i class="fa ti-eraser"></i>&nbsp;&nbsp;Limpiar todo</button>
                                        </div>                                         
                                        <div class="col-12 col-md-2 offset-md-1">
                                            <button type="submit" class="btn btn-success" id="guardarCambios"><i class="fa ti-check"></i>&nbsp;&nbsp;Efectuar Venta</button>
                                        </div> 
                                    </div>
                                    

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Registro Exitoso</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h6>El registro se ha realizado con ??xito.</h6>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fin Modal -->

                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        

        <script>
            function mostarModal(){
                $("#exampleModal").modal("show");
                //document.getElementById('exampleModal').style.display='active';
                //$("#exampleModal").trigger("click");
            }
            <?php
                if(!empty($_REQUEST)){
            ?>
                    mostarModal();
            <?php
                }
                //mostarModal();
            ?>
        </script>
             
     

        <!-- /.content -->
        <div class="clearfix"></div>
        <?php include "componentes/footer.php" ?>
        
        
    </div>
    <!-- /#right-panel -->
    <?php include "componentes/librerias.php" ?>

</body>
</html>

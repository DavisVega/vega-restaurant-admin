<?php 
    require_once('../php/control_session.php'); 
    require_once('../php/Data.php'); 

    $data = new Data();
    $detalle = $data->getAllPagos();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('partials/head.php'); ?>
    <title>Pago con Tarjeta  - Vega's Restaurant</title>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once('partials/sidebar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require_once('partials/navbar.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Pagos con tarjetas</h1>
                    
                    <?php 
                        // Validación al momento de crear registro
                        if( isset( $_GET["error"] ) && $_GET["error"] != NULL ){
                            if ( $_GET["error"] == 0 ) {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        Pago agregado exitosamente!
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>";
                            }
                        }

                        // Validación al momento de actualizar un registro
                        if( isset( $_GET["update"] ) && $_GET["update"] != NULL ){
                            if ( $_GET["update"] == 0 ) {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                        <strong>Oops!</strong> Pago no se pudo actualizar.
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>";
                            } else {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        Pago actualizado exitosamente!
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>";
                            }
                        }

                        // Validación al momento de eliminar un registro
                        if( isset( $_GET["delete"] ) && $_GET["delete"] != NULL ){
                            if ( $_GET["delete"] == 0 ) {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                        <strong>Oops!</strong> Pago no se pudo eliminar.
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>";
                            } else {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        Pago eliminado exitosamente!
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>";
                            }
                        }
                    ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <h6 class="m-0 font-weight-bold text-primary">Listado</h6>
                                </div>
                                <div class="col-sm-12 col-md-6 text-right">
                                    <button 
                                        class="btn btn-primary" 
                                        id="agregar"
                                    >
                                        Agregar
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Número de Factura</th>
                                            <th>Tipo de Tarjeta</th>
                                            <th>Fecha de Expiración</th>
                                            <th>Propietario</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Código</th>
                                            <th>Número de Factura</th>
                                            <th>Tipo de Tarjeta</th>
                                            <th>Fecha de Expiración</th>
                                            <th>Propietario</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php echo $detalle; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php require_once('partials/footer.php'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php require_once('partials/logoutModal.php'); ?>

    <!-- Large modal -->
    <div class="modal fade" id="modal-inv" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title user-form-title">Agregar</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="user-form" action="" method="POST">
                    <input type="hidden" id="id" name="id" value="0" />
                    <div class="modal-body modal-body-form">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="idFactura">Número de Factura</label>
                                <select id="idFactura" name="idFactura" class="form-control">
                                    <option value="0" selected>Número de Factura</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tipoTarjeta">Tipo de Tarjeta</label>
                                <select id="tipoTarjeta" name="tipoTarjeta" class="form-control">
                                    <option value="C" selected>Credito</option>
                                    <option value="D" selected>Debito</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="propietario">Nombre del Propietario</label>
                                <input type="text" class="form-control" id="propietario" name="propietario" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="nTarjeta">Número de Tarjeta</label>
                                <input type="text" class="form-control" id="nTarjeta" name="nTarjeta" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="mes">Mes de expiración</label>
                                <select id="mes" name="mes" class="form-control">
                                    <option value="1" selected>Enero</option>
                                    <option value="2">Febrero</option>
                                    <option value="3">Marzo</option>
                                    <option value="4">Abril</option>
                                    <option value="5">Mayo</option>
                                    <option value="6">Junio</option>
                                    <option value="7">Julio</option>
                                    <option value="8">Agosto</option>
                                    <option value="9">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="anio">Año de expiración</label>
                                <input type="number" class="form-control" id="anio" name="anio" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="cvc">CVC</label>
                                <input type="number" class="form-control" id="cvc" name="cvc" required>
                            </div>
                        </div>
                        
                        <p id="error"></p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary user-form-btn-action" value="create">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require_once('partials/javaScripts.php'); ?>

    <script type="text/javascript">
        $(document).ready(function() {
            getSelectFactura();
            
            clearFields();
            $( "#propietario" ).attr( "required", true );
            $( "#nTarjeta" ).attr( "required", true );
            $( "#mes" ).attr( "required", true );
            $( "#anio" ).attr( "required", true );
            $( "#cvc" ).attr( "required", true );
            $('.modal-body-form').show();

            function getSelectFactura(){
                $.ajax({
                    type: "POST",
                    url: '../php/actions/pagoTarjeta.php',
                    dataType: 'json',
                    data: { 
                        action: "getSelectFactura"
                    },
                    success: function( r ) {
                        var sucursales = $('#idFactura');

                        // Limpiamos el select
                        sucursales.find('option').remove();

                        $(r).each(function(i, v){ // indice, valor
                            sucursales.append( v );
                        });
                    }
                });                
            }

            // Limpiar todos los campos del modal
            function clearFields(){
                $("#id").val( 0 );

                $("#idFactura").val( 0 );
                $("#tipoTarjeta").val( "C" );
                $( "#propietario" ).val( "" );
                $( "#nTarjeta" ).val( "" );
                $( "#mes" ).val( "" );
                $( "#anio" ).val( (new Date()).getFullYear() );
                $( "#cvc" ).val( "" );
            }

            $('#agregar').on('click', function(){
                // set variables
                $('#user-form').prop('action', '../php/actions/pagoTarjeta.php?action=create');
                $('.user-form-title').text( "Agregar Pago" );
                $('.user-form-btn-action').val("create");
                $('.user-form-btn-action').text("Agregar");
                $('#modal-inv').modal('show');
            });
            
            $(document).on( 'click', '.edit', function() {
                var id = $(this).attr("id");

                $.ajax({
                        type: "GET",
                        url: '../php/actions/pagoTarjeta.php?',
                        dataType: 'json',
                        data: { 
                            action: "getFacturaById",
                            id: id
                        },
                        success: function( data ) {
                            $("#id").val( id );

                            var $fecha = new Date( data.fecha );

                            // Set form data
                            $("#idFactura").val( data.idFactura );
                            $("#tipoTarjeta").val( data.tipoTarjeta );
                            $("#propietario").val( data.propietario );
                            $("#nTarjeta").val( data.nTarjeta );
                            $("#mes").val( data.mes );
                            $("#anio").val( data.anio );
                            $("#cvc").val( data.cvc );
                            
                            // set modal variables
                            $('#user-form').prop('action', '../php/actions/pagoTarjeta.php?action=update');
                            $('.user-form-title').text( "Actualizar Pago" );
                            $('.user-form-btn-action').val("update");
                            $('.user-form-btn-action').text("Actualizar");
                            $('#modal-inv').modal('show');
                        }
                    });1
            } );

            $(document).on( 'click', '.delete', function() {
                var id = $(this).attr("id");
                
                // set modal variables
                $("#id").val( id );
                $( "#propietario" ).attr( "required", false );
                $( "#nTarjeta" ).attr( "required", false );
                $( "#mes" ).attr( "required", false );
                $( "#anio" ).attr( "required", false );
                $( "#cvc" ).attr( "required", false );

                $('#user-form').prop('action', '../php/actions/pagoTarjeta.php?action=delete');
                $('.modal-body-form').hide();

                $('.user-form-title').text( "Realmente desea eliminar el registro?" );
                $('.user-form-btn-action').val("delete");
                $('.user-form-btn-action').text("Eliminar");
                $('#modal-inv').modal('show');
            } );

            $(document).on( 'click', '.cancel', function() {
                setTimeout(function() {
                    $('.modal-body-form').show();
                }, 5000);
            });
        });
    </script>
</body>
</html>
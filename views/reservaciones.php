<?php 
    require_once('../php/control_session.php'); 
    require_once('../php/Data.php'); 

    $data = new Data();
    $detalle = $data->getAllReservaciones();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('partials/head.php'); ?>
    <title>Reservaciones - Vega's Restaurant</title>
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
                    <h1 class="h3 mb-2 text-gray-800">Resarvaciones</h1>
                    
                    <?php 
                        // Validación al momento de crear registro
                        if( isset( $_GET["error"] ) && $_GET["error"] != NULL ){
                            if ( $_GET["error"] == 0 ) {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        Reservación agregada exitosamente!
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
                                        <strong>Oops!</strong> Reservación no se pudo actualizar.
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>";
                            } else {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        Reservación actualizada exitosamente!
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
                                        <strong>Oops!</strong> Reservación no se pudo eliminar.
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>";
                            } else {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        Reservación eliminada exitosamente!
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
                                            <th>Sucursal</th>
                                            <th>Número de Mesa</th>
                                            <th>Usuario</th>
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Código</th>
                                            <th>Sucursal</th>
                                            <th>Número de Mesa</th>
                                            <th>Usuario</th>
                                            <th>Fecha</th>
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
                                <label for="idSucursal">Sucursal</label>
                                <select id="idSucursal" name="idSucursal" class="form-control">
                                    <option value="0" selected>Sucursal</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="idMesa">Número de Mesa</label>
                                <select id="idMesa" name="idMesa" class="form-control">
                                    <option value="0" selected>Número de Mesa</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="idUsuario">Usuarios</label>
                                <select id="idUsuario" name="idUsuario" class="form-control">
                                    <option value="0" selected>Usuarios</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Fecha">
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
            getSelectSucursal();
            getSelectMesa();
            getSelectUsuario();

            clearFields();
            $('.modal-body-form').show();

            // Función para obtener los registros de las sucursales y llenar el DropDown
            function getSelectSucursal(){
                $.ajax({
                    type: "POST",
                    url: '../php/actions/sucursales.php',
                    dataType: 'json',
                    data: { 
                        action: "getSelectSuc"
                    },
                    success: function( r ) {
                        var sucursales = $('#idSucursal');

                        // Limpiamos el select
                        sucursales.find('option').remove();

                        $(r).each(function(i, v){ // indice, valor
                            sucursales.append( v );
                        });
                    }
                });                
            }

            function getSelectMesa(){
                $.ajax({
                    type: "POST",
                    url: '../php/actions/reservaciones.php',
                    dataType: 'json',
                    data: { 
                        action: "getSelectMesa"
                    },
                    success: function( r ) {
                        var sucursales = $('#idMesa');

                        // Limpiamos el select
                        sucursales.find('option').remove();

                        $(r).each(function(i, v){ // indice, valor
                            sucursales.append( v );
                        });
                    }
                });                
            }

            function getSelectUsuario(){
                $.ajax({
                    type: "POST",
                    url: '../php/actions/reservaciones.php',
                    dataType: 'json',
                    data: { 
                        action: "getSelectUsuario"
                    },
                    success: function( r ) {
                        var sucursales = $('#idUsuario');

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

                $("#idSucursal").val( 0 );
                $("#idMesa").val( 0 );
                $("#idUsuario").val( 0 );
            }

            $('#agregar').on('click', function(){
                // set variables
                $('#user-form').prop('action', '../php/actions/reservaciones.php?action=create');
                $('.user-form-title').text( "Agregar Reservación" );
                $('.user-form-btn-action').val("create");
                $('.user-form-btn-action').text("Agregar");
                $('#modal-inv').modal('show');
            });
            
            $(document).on( 'click', '.edit', function() {
                var id = $(this).attr("id");

                $.ajax({
                        type: "GET",
                        url: '../php/actions/reservaciones.php?',
                        dataType: 'json',
                        data: { 
                            action: "getReservacionById",
                            id: id
                        },
                        success: function( data ) {
                            $("#id").val( id );

                            var $fecha = new Date( data.fecha );

                            // Set form data
                            $("#idSucursal").val( data.idSucursal );
                            $("#idMesa").val( data.idMesa );
                            $("#idUsuario").val( data.idUsuario );
                            $("#fecha").val( $fecha );
                            
                            // set modal variables
                            $('#user-form').prop('action', '../php/actions/reservaciones.php?action=update');
                            $('.user-form-title').text( "Actualizar Reservación" );
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
                $('#user-form').prop('action', '../php/actions/reservaciones.php?action=delete');
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
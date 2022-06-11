<?php 
    require_once('../php/control_session.php'); 
    require_once('../php/Data.php'); 

    $data = new Data();
    $detalle = $data->getAllPlatillos();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('partials/head.php'); ?>
    <title>Platillos - Vega's Restaurant</title>
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
                    <h1 class="h3 mb-2 text-gray-800">Platillos</h1>
                    
                    <?php 
                        // Validación al momento de crear registro
                        if( isset( $_GET["error"] ) && $_GET["error"] != NULL ){
                            if ( $_GET["error"] == 0 ) {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        Platillo agregado exitosamente!
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
                                        <strong>Oops!</strong> Platillo no se pudo actualizar.
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>";
                            } else {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        Platillo actualizado exitosamente!
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
                                        <strong>Oops!</strong> Platillo no se pudo eliminar.
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>";
                            } else {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        Platillo eliminado exitosamente!
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
                                            <th>Tipo de Platillo</th>
                                            <th>Nombre</th>
                                            <th>Precio</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Código</th>
                                            <th>Tipo de Platillo</th>
                                            <th>Nombre</th>
                                            <th>Precio</th>
                                            <th>Estado</th>
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
                            <div class="form-group col-md-8">
                                <label for="idTipoPlatillo">Tipo de Platillo</label>
                                <select id="idTipoPlatillo" name="idTipoPlatillo" class="form-control">
                                    <option selected>Tipo de Platillo</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="estado">Estado</label>
                                <select id="estado" name="estado" class="form-control">
                                    <option value="A" selected>Activo</option>
                                    <option value="I" selected>Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="precio">Precio</label>
                                <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio" required>
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
            getSelectTipoPlatillo();
            clearFields();
            $('.modal-body-form').show();
            $( "#descripcion" ).attr( "required", true );

            // Función para obtener los registros de las sucursales y llenar el DropDown
            function getSelectTipoPlatillo(){
                $.ajax({
                    type: "POST",
                    url: '../php/actions/platillos.php',
                    dataType: 'json',
                    data: { 
                        action: "getSelectTipoPlatillo"
                    },
                    success: function( r ) {
                        var sucursales = $('#idTipoPlatillo');

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
                $("#idTipoPlatillo").val( 0 );
                $("#nombre").val( "" );
                $("#precio").val( 0 );
                $("#estado").val( "A" );
                
                $( "#descripcion" ).attr( "required", true );
            }

            $('#agregar').on('click', function(){
                // set variables
                $('#user-form').prop('action', '../php/actions/platillos.php?action=create');
                $('.user-form-title').text( "Agregar Platillo" );
                $('.user-form-btn-action').val("create");
                $('.user-form-btn-action').text("Agregar");
                $('#modal-inv').modal('show');
            });
            
            $(document).on( 'click', '.edit', function() {
                var id = $(this).attr("id");

                $.ajax({
                        type: "GET",
                        url: '../php/actions/platillos.php?',
                        dataType: 'json',
                        data: { 
                            action: "getPlatilloById",
                            id: id
                        },
                        success: function( data ) {
                            $("#id").val( id );

                            // Set form data
                            $("#idTipoPlatillo").val( data.idTipoPlatillo );
                            $("#nombre").val( data.nombre );
                            $("#precio").val( data.precio );
                            $("#estado").val( data.estado );
                            
                            // set modal variables
                            $('#user-form').prop('action', '../php/actions/platillos.php?action=update');
                            $('.user-form-title').text( "Actualizar Platillo" );
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
                $( "#nombre" ).attr( "required", false );
                $( "#precio" ).attr( "required", false );

                $('#user-form').prop('action', '../php/actions/platillos.php?action=delete');
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
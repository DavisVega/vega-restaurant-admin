<?php 
    require_once('../php/control_session.php'); 
    require_once('../php/Data.php'); 

    $data = new Data();
    $detalle = $data->getAllUsuarios();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('partials/head.php'); ?>
    <title>Usuarios - Vega's Restaurant</title>
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
                    <h1 class="h3 mb-2 text-gray-800">Usuarios</h1>
                    
                    <?php 
                        // Validación al momento de crear registro
                        if( isset( $_GET["error"] ) && $_GET["error"] != NULL ){
                            if ( $_GET["error"] == 0 ) {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        Usuario agregado exitosamente!
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
                                        <strong>Oops!</strong> el usuario no se pudo actualizar.
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>";
                            } else {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        Usuario actualizado exitosamente!
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
                                        <strong>Oops!</strong> el usuario no se pudo eliminar.
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>";
                            } else {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        Usuario eliminado exitosamente!
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
                                            <th>Nombre</th>
                                            <th>Tipo Usuario</th>
                                            <th>Correo Electrónico</th>
                                            <th>Cargo</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Código</th>
                                            <th>Nombre</th>
                                            <th>Tipo Usuario</th>
                                            <th>Correo Electrónico</th>
                                            <th>Cargo</th>
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
                                <label for="sucursal">Sucursal</label>
                                <select id="idSucursal" name="idSucursal" class="form-control">
                                    <option selected>Sucursales</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tipoUsuario">Tipo de Usuario</label>
                                <select id="tipoUsuario" name="tipoUsuario" class="form-control">
                                    <option value="U" selected>Usuario</option>
                                    <option value="A">Administrador</option>
                                    <option value="E">Empleado</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nombres">* Nombres</label>
                            <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="apellidos">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="aCasada">Apellido Casada</label>
                                <input type="text" class="form-control" id="aCasada" name="aCasada" placeholder="Apellido Casada">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="genero">Genero</label>
                                <select id="genero" name="genero" class="form-control">
                                    <option value="M" selected>Masculino</option>
                                    <option value="F">Femenino</option>
                                    <option value="O">Otros</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="cargo">Cargo</label>
                                <select id="cargo" name="cargo" class="form-control">
                                    <option value="Gerente">Gerente</option>
                                    <option value="Usuario" selected>Usuario</option>
                                    <option value="Empleado">Empleado</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="cargo">&nbsp;</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="activo" name="activo" checked>
                                    <label class="form-check-label" for="activo">Activo</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <textarea class="form-control" id="direccion" name="direccion" rows="3"></textarea>
                        </div>
                        
                        <hr>
                        
                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="clave">Clave</label>
                                <input type="password" class="form-control" id="clave" name="clave" placeholder="Clave">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cclave">Confirmar Clave</label>
                                <input type="password" class="form-control" id="cclave" name="cclave" placeholder="Confirmar Clave">
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
            getSelectSuc();
            clearFields();
            $('.modal-body-form').show();
            $( "#nombres" ).attr( "required", true );

            // Función para obtener los registros de las sucursales y llenar el DropDown
            function getSelectSuc(){
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

            // Limpiar todos los campos del modal
            function clearFields(){
                $("#id").val( 0 );
                $("#idSucursal").val( "0" );
                $("#tipoUsuario").val( "U" );
                $("#email").val( "" ); 
                $("#genero").val( "M" ); 
                $("#cargo").val( "Usuario" );
                $("#direccion").val( "" );
                $("#nombres").val( "" );
                $("#apellidos").val( "" );
                $("#aCasada").val( "" );
                $("#email").val( "" );
                $("#clave").val( "" );
                $("#cClave").val( "" );
                $("#activo").val( 0 );

                $("#activo").attr( "checked", true );
                $( "#nombres" ).attr( "required", true );
            }

            $('#agregar').on('click', function(){
                // set variables
                $('#user-form').prop('action', '../php/actions/usuarios.php?action=create');
                $('.user-form-title').text( "Agregar Usuario" );
                $('.user-form-btn-action').val("create");
                $('.user-form-btn-action').text("Agregar");
                $('#modal-inv').modal('show');
            });
            
            $(document).on( 'click', '.edit', function() {
                var id = $(this).attr("id");

                $.ajax({
                        type: "GET",
                        url: '../php/actions/usuarios.php?',
                        dataType: 'json',
                        data: { 
                            action: "getUserById",
                            id: id
                        },
                        success: function( data ) {
                            $("#id").val( id );

                            if( data.activo ){
                                $("#activo").attr( "checked", true );
                            }
                            
                            // Disabled
                            $("#email").attr( "disabled", true );
                            $("#clave").attr( "disabled", true );
                            $("#cclave").attr( "disabled", true );

                            // Set form data
                            $("#idSucursal").val( data.id_sucursal );
                            $("#tipoUsuario").val( data.tipo_usuario );
                            $("#email").val( data.email ); 
                            $("#genero").val( data.sexo ); 
                            $("#cargo").val( data.cargo );
                            $("#direccion").val( data.direccion );
                            $("#nombres").val( data.nombres );
                            $("#apellidos").val( data.apellidos );
                            $("#aCasada").val( data.ape_casada );
                            $("#activo").val( data.activo );
                            
                            // set modal variables
                            $('#user-form').prop('action', '../php/actions/usuarios.php?action=update');
                            $('.user-form-title').text( "Actualizar Usuario" );
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
                $( "#nombres" ).attr( "required", false );
                $('#user-form').prop('action', '../php/actions/usuarios.php?action=delete');
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

            $( "#user-form" ).submit(function( event ) {
                if( $('.user-form-btn-action').val() == "create" ){
                    if ( $( "#clave" ).val() === $( "#cclave" ).val() ) {
                        return;
                    }else {
                        $('#error').empty().css('color', 'brown').text('* Las claves no coinciden');
                        event.preventDefault();
                    }
                }
            });
        });
    </script>
</body>
</html>
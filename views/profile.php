<?php require_once('../php/control_session.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('partials/head.php'); ?>
    <title>Perfil - Vega's Restaurant</title>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once('partials/sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require_once('partials/navbar.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Perfil</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Imprimir Perfil</a>
                    </div>

                    <!-- Content Row -->
                    <div class="container">
                        <?php 
                            if( isset( $_GET["error"] ) && $_GET["error"] != NULL ){
                                if ( $_GET["error"] == 1 ) {
                                    echo "<div class='alert alert-danger' role='alert'>
                                            Oops!, Ocurrio un problema, el perfil no se pudo actualizar.
                                        </div>";
                                } else {
                                    echo "<div class='alert alert-success' role='alert'>
                                            Perfil Actualizado Correctamente!
                                        </div>";
                                }
                            }
                        ?>

                        <form action="../php/actions/profile.php" method="POST">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="sucursal">Sucursal</label>
                                    <select id="idSucursal" name="idSucursal" value="<?php echo $_SESSION["idSucursal"];  ?>" class="form-control">
                                        <option selected>Sucursales</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tipoUsuario">Tipo de Usuario</label>
                                    <select id="tipoUsuario" name="tipoUsuario" value="<?php echo $_SESSION["tipoUsuario"];  ?>" class="form-control">
                                        <option value="U">Usuario</option>
                                        <option value="A">Administrador</option>
                                        <option value="E">Empleado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nombres">* Nombres</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres" value="<?php echo $_SESSION["nombres"]; ?>" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="apellidos">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" value="<?php echo $_SESSION["apellidos"]; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="aCasada">Apellido Casada</label>
                                    <input type="text" class="form-control" id="aCasada" name="aCasada" placeholder="Apellido Casada" value="<?php echo $_SESSION["apeCasada"]; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="genero">Genero</label>
                                    <select id="genero" name="genero" class="form-control" value="<?php echo $_SESSION["sexo"]; ?>">
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                        <option value="O">Otros</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cargo">Cargo</label>
                                    <select id="cargo" name="cargo" class="form-control" value="<?php echo $_SESSION["cargo"]; ?>">
                                        <option value="Gerente">Gerente</option>
                                        <option value="Usuario">Usuario</option>
                                        <option value="Empleado">Empleado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo $_SESSION["userEmail"]; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <textarea class="form-control" id="direccion" name="direccion" rows="3">
                                    <?php echo $_SESSION["direccion"]; ?>
                                </textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
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

    <?php require_once('partials/javaScripts.php'); ?>

    <script type="text/javascript">
        $( document ).ready( function() {
            getSelectSuc();

            function getSelectSuc(){
                $.ajax({
                    type: "POST",
                    url: '../php/actions/sucursales.php',
                    dataType: 'json',
                    data: { 
                        action: "getSelectSuc"
                    },
                    success: function( r ) {
                        console.log( r );
                        var sucursales = $('#idSucursal');

                        // Limpiamos el select
                        sucursales.find('option').remove();

                        $(r).each(function(i, v){ // indice, valor
                            sucursales.append( v );
                        });
                    }
                });                
            }
        });        
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('partials/head.php'); ?>
    
    <title>Register - Vega's Restaurant</title>
</head>

<body class="bg-gradient-primary">

    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Crear una Cuenta!</h1>
                            </div>
                            <form class="user" action="../php/register.php" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="firstName" name="firstName"
                                            placeholder="Nombres">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="lastName" name="lastName"
                                            placeholder="Apellidos">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email" name="email"
                                        placeholder="Correo Electrónico" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="password" name="password" placeholder="Clave" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="repeatPassword" placeholder="Confirmar Clave" required>
                                    </div>
                                </div>
                                <p id="error"></p>
                                <?php 
                                    if( isset( $_GET["exists"] ) && $_GET["exists"] == 1 && $_GET["exists"] != NULL ){
                                        echo "<p class='text-danger'>* Ya existe un usuario con ese Email</p>";
                                    }
                                ?>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Registrar Cuenta
                                </button>
                                <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Ingresa con Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Ingresa con Facebook
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Olvidaste tu clave?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="../login.php">Ya tienes una cuenta? Ingresar!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('partials/javaScripts.php'); ?>
    <script>
        $( "form" ).submit(function( event ) {
            if ( $( "#password" ).val() === $( "#repeatPassword" ).val() ) {
                return;
            }else {
                $('#error').empty().css('color', 'brown').text('* Las claves no coinciden');
            }
            event.preventDefault();
        });
    </script>
</body>
</html>
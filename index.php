<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('views/partials/head.php'); ?>
    <title>Login - Vega's Restaurant</title>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bienvenido!</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="email" aria-describedby="emailHelp"
                                                placeholder="Correo Electrónico">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" placeholder="Clave">
                                        </div>
                                        <p id="error"></p>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Recordarme</label>
                                            </div>
                                        </div>
                                        <button type="button" id="ingresar" class="btn btn-primary btn-user btn-block">
                                            Login
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
                                        <a class="small" href="views/register.php">Crear una cuenta!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php require_once('views/partials/javaScripts.php'); ?>

    <script>
        $('#ingresar').on('click', function(){
            var email = $('#email').val();
            var pass = $('#password').val();

            if( email != '' && pass != '' ){
                $.ajax({
                    type: "POST",
                    url: 'php/login.php',
                    dataType: 'json',
                    data: { 
                        email: email,
                        pass: pass
                    },
                    success: function( data ) {
                        if( data == 'ok' ){
                            window.location = "views/index.php";
                        }else{
                            $('#error').empty().css('color', 'brown').text('* Usuario o clave es incorrecta');
                        }
                    }
                });

            }else{
                $('#error').empty().css('color', 'brown').text('* Todos los campos son requeridos');
            }
        });
    </script>
</body>
</html>
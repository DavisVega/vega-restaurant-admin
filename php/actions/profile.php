<?php
    session_start();
	require_once('../connection.php');
	
	$db = new Conecction();
	$conn = $db->getConnection();

    $sucursal 	 = $_POST['idSucursal'] ?? '';
    $tipoUsuario = $_POST['tipoUsuario'] ?? '';
    $nombres 	 = $_POST['nombres'] ?? '';
    $apellidos 	 = $_POST['apellidos'] ?? '';
    $aCasada 	 = $_POST['aCasada'] ?? '';
    $genero 	 = $_POST['genero'] ?? '';
    $cargo 		 = $_POST['cargo'] ?? '';
    $direccion 	 = $_POST['direccion'] ?? '';

	$sql = "UPDATE usuarios 
        SET id_sucursal = '$sucursal', tipo_usuario = '$tipoUsuario', 
        sexo = '$genero', cargo = '$cargo', direccion = '$direccion', 
        nombres = '$nombres', apellidos = '$apellidos', ape_casada = '$aCasada'
        WHERE id = ".$_SESSION["userID"];

    $stmt = mysqli_query ($conn, $sql) or die ("Fallo en la consulta");

    if( $stmt ){
        // Actualizar las variables de session
        $_SESSION["username"]  	  = $nombres . ' ' . $apellidos;
        $_SESSION["idSucursal"]   = $sucursal; 
        $_SESSION["tipoUsuario"]  = $tipoUsuario;
        $_SESSION["sexo"]  		  = $genero;
        $_SESSION["cargo"]  	  = $cargo;
        $_SESSION["direccion"]    = $direccion;
        $_SESSION["nombres"]  	  = $nombres;
        $_SESSION["apellidos"]    = $apellidos;
        $_SESSION["apeCasada"]    = $aCasada;

        header('Location: http://localhost:8080/vega-restaurant-admin/views/profile.php?error=0');
        exit;
    }else{
        header('Location: http://localhost:8080/vega-restaurant-admin/views/profile.php?error=1');
        exit;
    }
?>
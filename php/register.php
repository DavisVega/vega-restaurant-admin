<?php
    require_once('connection.php');
	
	$db = new Conecction();
	$conn = $db->getConnection();

    $stmt0 = $conn->prepare( "SELECT id FROM usuarios WHERE email = ? LIMIT 1" );
	$stmt0->bind_param( "s", $_POST['email'] );
	$stmt0->execute();
	$result = $stmt0->get_result();

	if( $result->num_rows > 0 ) {
        header('Location: http://localhost:8080/vega-restaurant-admin/views/register.php?exists=1');
        exit;
    }

    try {
        $password = password_hash( $_POST['password'], PASSWORD_DEFAULT );

        $stmt = $conn->prepare("INSERT INTO usuarios VALUES ( null, 1, 'U', ?, ?, 'M', 'Empleado', 'Direccion', ?, ?, '', 1 )");
        $stmt->bind_param("ssss", $_POST['email'], $password, $_POST['firstName'], $_POST['lastName'], );
        $stmt->execute();
        $stmt->close();

        session_start();
        $_SESSION["userID"]    	  = $conn->insert_id; 
        $_SESSION["username"]  	  = $_POST['firstName'] . ' ' . $_POST['lastName']; 
        $_SESSION["idSucursal"]   = 1; 
        $_SESSION["tipoUsuario"]  = "U";
        $_SESSION["userEmail"] 	  = $_POST['email']; 
        $_SESSION["sexo"]  		  = "M";
        $_SESSION["cargo"]  	  = "Empleado";
        $_SESSION["direccion"]    = "direccion";
        $_SESSION["nombres"]  	  = $_POST['firstName'];
        $_SESSION["apellidos"]    = $_POST['lastName'];
        $_SESSION["apeCasada"]    = '';

        header('Location: http://localhost:8080/vega-restaurant-admin/views/index.php');

    } catch(Exception $e) {
        if( $conn->errno === 1062 ) echo 'Duplicate entry';
    }

?>
<?php
	require_once('connection.php');
	
	$db = new Conecction();
	$conn = $db->getConnection();

	$email = $_POST['email'];
	$pass = $_POST['pass'];

	$stmt = $conn->prepare( "SELECT * FROM usuarios WHERE email = ? LIMIT 1" );
	$stmt->bind_param( "s", $email );
	$stmt->execute();
	$result = $stmt->get_result();

	$return = 'error';
	if( $result->num_rows > 0 ) {
		
		while( $row = $result->fetch_assoc() ) {
			if ( password_verify( $pass, $row['clave'] ) ) {
				
				session_start();		
				$_SESSION["userID"]    	  = $row['id']; 
				$_SESSION["username"]  	  = $row['nombres'] . ' ' . $row['apellidos'];
				$_SESSION["idSucursal"]   = $row['id_sucursal']; 
				$_SESSION["tipoUsuario"]  = $row['tipo_usuario'];
				$_SESSION["userEmail"] 	  = $row['email']; 
				$_SESSION["sexo"]  		  = $row['sexo'];
				$_SESSION["cargo"]  	  = $row['cargo'];
				$_SESSION["direccion"]    = $row['direccion'];
				$_SESSION["nombres"]  	  = $row['nombres'];
				$_SESSION["apellidos"]    = $row['apellidos'];
				$_SESSION["apeCasada"]    = $row['ape_casada'];

				$return = 'ok';
			}
		}
	}

	echo json_encode( $return );
?>
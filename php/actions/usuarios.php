<?php
    require_once('../connection.php');
    $db = new Conecction();
    $conn = $db->getConnection();

    if( isset( $_POST["action"] ) && $_POST["action"] != NULL ){
        $action = $_POST["action"];
    } else {
        $action = $_GET["action"];
    }

    if( $action == "create" ){
        
        $idSucursal  = $_POST["idSucursal"];
        $tipoUsuario = $_POST["tipoUsuario"];
        $nombres     = $_POST["nombres"];
        $apellidos   = $_POST["apellidos"];
        $aCasada     = $_POST["aCasada"];
        $genero      = $_POST["genero"];
        $cargo       = $_POST["cargo"];
        $direccion   = $_POST["direccion"];
        $email       = $_POST["email"];
        
        $password = password_hash( $_POST['clave'], PASSWORD_DEFAULT );

        $stmt = $conn->prepare( "INSERT INTO usuarios VALUES ( null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1 )" );
        $stmt->bind_param( "ssssssssss", $idSucursal, $tipoUsuario, $email, $password, $genero, $cargo, $direccion, $nombres, $apellidos, $aCasada );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/usuarios.php?error=0');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/usuarios.php?error=1');
        }

    } else if( $action == "update" ){

        $id = $_POST["id"];
        $idSucursal  = $_POST["idSucursal"];
        $tipoUsuario = $_POST["tipoUsuario"];
        $nombres     = $_POST["nombres"];
        $apellidos   = $_POST["apellidos"];
        $aCasada     = $_POST["aCasada"];
        $genero      = $_POST["genero"];
        $cargo       = $_POST["cargo"];
        $direccion   = $_POST["direccion"];
        $activo      = $_POST["activo"];

        $stmt = $conn->prepare( "UPDATE usuarios SET id_sucursal = ?, tipo_usuario = ?, sexo = ?, cargo = ?, direccion = ?, nombres = ?, apellidos = ?, ape_casada = ?, activo = ? WHERE id = ?" );
        $stmt->bind_param( "ssssssssss", $idSucursal, $tipoUsuario, $genero, $cargo, $direccion, $nombres, $apellidos, $aCasada, $activo, $id );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/usuarios.php?update=1');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/usuarios.php?update=0');
        }

    } else if( $action == "getUserById" ){

		$stmt = $conn->prepare( "SELECT * FROM usuarios WHERE id = ?" );
        $stmt->bind_param( "s", $_GET["id"] );
        $stmt->execute();
        $result = $stmt->get_result();

        if( $result->num_rows > 0 ) {
            while( $row = $result->fetch_assoc() ) {

                $output["id_sucursal"]  = $row["id_sucursal"];
                $output["tipo_usuario"] = $row["tipo_usuario"];
                $output["email"]        = $row["email"];
                $output["sexo"]         = $row["sexo"];
                $output["cargo"]        = $row["cargo"];
                $output["direccion"]    = $row["direccion"];
                $output["nombres"]      = $row["nombres"];
                $output["apellidos"]    = $row["apellidos"];
                $output["ape_casada"]   = $row["ape_casada"];
                $output["activo"]       = $row["activo"];

            }
        }
        echo json_encode( $output );

    } else {
        $id = $_POST["id"];
		$stmt = $conn->prepare( "UPDATE usuarios SET activo = 0 WHERE id = ?" );
        $stmt->bind_param( "s", $id );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/usuarios.php?delete=1');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/usuarios.php?delete=0');
        }
    }

?>
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
        
        $descripcion = $_POST["descripcion"];

        $stmt = $conn->prepare( "INSERT INTO tipo_platillo VALUES ( null, ? )" );
        $stmt->bind_param( "s", $descripcion );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/tipoPlatillo.php?error=0');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/tipoPlatillo.php?error=1');
        }

    } else if( $action == "update" ){

        $id          = $_POST["id"];
        $descripcion = $_POST["descripcion"];

        $stmt = $conn->prepare( "UPDATE tipo_platillo SET descripcion = ? WHERE id = ?" );
        $stmt->bind_param( "ss", $descripcion, $id );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/tipoPlatillo.php?update=1');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/tipoPlatillo.php?update=0');
        }

    } else if( $action == "getTipoPlatilloById" ){

		$stmt = $conn->prepare( "SELECT * FROM tipo_platillo WHERE id = ?" );
        $stmt->bind_param( "s", $_GET["id"] );
        $stmt->execute();
        $result = $stmt->get_result();

        if( $result->num_rows > 0 ) {
            while( $row = $result->fetch_assoc() ) {
                $output["descripcion"] = $row["descripcion"];
            }
        }
        echo json_encode( $output );

    } else {
        $id = $_POST["id"];
		$stmt = $conn->prepare( "DELETE FROM tipo_platillo WHERE id = ?" );
        $stmt->bind_param( "s", $id );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/tipoPlatillo.php?delete=1');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/tipoPlatillo.php?delete=0');
        }
    }

?>
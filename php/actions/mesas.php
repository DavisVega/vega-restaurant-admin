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
        
        $nMesa = $_POST["nMesa"];

        $stmt = $conn->prepare( "INSERT INTO mesas VALUES ( null, ? )" );
        $stmt->bind_param( "i", $nMesa );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/mesas.php?error=0');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/mesas.php?error=1');
        }

    } else if( $action == "update" ){

        $id    = $_POST["id"];
        $nMesa = $_POST["nMesa"];

        $stmt = $conn->prepare( "UPDATE mesas SET num_mesa = ? WHERE id = ?" );
        $stmt->bind_param( "is", $nMesa, $id );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/mesas.php?update=1');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/mesas.php?update=0');
        }

    } else if( $action == "getMesaById" ){

		$stmt = $conn->prepare( "SELECT * FROM mesas WHERE id = ?" );
        $stmt->bind_param( "s", $_GET["id"] );
        $stmt->execute();
        $result = $stmt->get_result();

        if( $result->num_rows > 0 ) {
            while( $row = $result->fetch_assoc() ) {
                $output["nMesa"] = $row["num_mesa"];
            }
        }
        echo json_encode( $output );

    } else {
        $id = $_POST["id"];
		$stmt = $conn->prepare( "DELETE FROM mesas WHERE id = ?" );
        $stmt->bind_param( "s", $id );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/mesas.php?delete=1');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/mesas.php?delete=0');
        }
    }

?>
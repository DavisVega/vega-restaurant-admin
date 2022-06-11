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
        
        $idTipoPlatillo = $_POST["idTipoPlatillo"];
        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $estado = $_POST["estado"];

        $stmt = $conn->prepare( "INSERT INTO platillos VALUES ( null, ?, ?, ?, ? )" );
        $stmt->bind_param( "ssss", $idTipoPlatillo, $nombre, $precio, $estado );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/platillos.php?error=0');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/platillos.php?error=1');
        }

    } else if( $action == "update" ){

        $id          = $_POST["id"];
        $idTipoPlatillo = $_POST["idTipoPlatillo"];
        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $estado = $_POST["estado"];

        $stmt = $conn->prepare( "UPDATE platillos SET id_tipo_platillo = ?, nombre = ?, precio = ?, estado = ? WHERE id = ?" );
        $stmt->bind_param( "sssss", $idTipoPlatillo, $nombre, $precio, $estado, $id );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/platillos.php?update=1');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/platillos.php?update=0');
        }

    } else if( $action == "getPlatilloById" ){

		$stmt = $conn->prepare( "SELECT * FROM platillos WHERE id = ?" );
        $stmt->bind_param( "s", $_GET["id"] );
        $stmt->execute();
        $result = $stmt->get_result();

        if( $result->num_rows > 0 ) {
            while( $row = $result->fetch_assoc() ) {
                $output["idTipoPlatillo"] = $row["id_tipo_platillo"];
                $output["nombre"] = $row["nombre"];
                $output["precio"] = $row["precio"];
                $output["estado"] = $row["estado"];
            }
        }
        echo json_encode( $output );

    } else if ( $action == "getSelectTipoPlatillo" ) {

        $stmt = $conn->prepare( "SELECT * FROM tipo_platillo" );
        $stmt->execute();
        $result = $stmt->get_result();
        
        $ops = '';
        if( $result->num_rows > 0 ) {
            while( $row = $result->fetch_assoc() ) {
                $ops .= '<option value="'.$row['id'].'">' . 
                            $row['descripcion'] . 
                        '</option>';
            }
        }

        echo json_encode( $ops );

    } else {
        $id = $_POST["id"];
		$stmt = $conn->prepare( "DELETE FROM platillos WHERE id = ?" );
        $stmt->bind_param( "s", $id );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/platillos.php?delete=1');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/platillos.php?delete=0');
        }
    }

?>
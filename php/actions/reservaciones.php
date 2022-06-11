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
        
        $idSucursal = $_POST["idSucursal"];
        $idMesa     = $_POST["idMesa"];
        $idUsuario  = $_POST["idUsuario"];
        $fecha      = $_POST["fecha"];

        $stmt = $conn->prepare( "INSERT INTO reservaciones VALUES ( null, ?, ?, ?, ? )" );
        $stmt->bind_param( "ssss", $idSucursal, $idMesa, $idUsuario, $fecha );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/reservaciones.php?error=0');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/reservaciones.php?error=1');
        }

    } else if( $action == "update" ){

        $id         = $_POST["id"];
        $idSucursal = $_POST["idSucursal"];
        $idMesa     = $_POST["idMesa"];
        $idUsuario  = $_POST["idUsuario"];
        $fecha      = $_POST["fecha"];

        $stmt = $conn->prepare( "UPDATE reservaciones SET id_sucursal = ?, id_mesa = ?, id_usuario = ?, fecha = ? WHERE id = ?" );
        $stmt->bind_param( "sssss", $idSucursal, $idMesa, $idUsuario, $fecha, $id );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/reservaciones.php?update=1');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/reservaciones.php?update=0');
        }

    } else if( $action == "getReservacionById" ){

		$stmt = $conn->prepare( "SELECT * FROM reservaciones WHERE id = ?" );
        $stmt->bind_param( "s", $_GET["id"] );
        $stmt->execute();
        $result = $stmt->get_result();

        if( $result->num_rows > 0 ) {
            while( $row = $result->fetch_assoc() ) {
                $output["idSucursal"] = $row["id_sucursal"];
                $output["idMesa"] = $row["id_mesa"];
                $output["idUsuario"] = $row["id_usuario"];
                $output["fecha"] = $row["fecha"];
            }
        }
        echo json_encode( $output );

    } else if ( $action == "getSelectMesa" ) {

        $stmt = $conn->prepare( "SELECT * FROM mesas" );
        $stmt->execute();
        $result = $stmt->get_result();
        
        $ops = '';
        if( $result->num_rows > 0 ) {
            while( $row = $result->fetch_assoc() ) {
                $ops .= '<option value="'.$row['id'].'">' . 
                            $row['num_mesa'] . 
                        '</option>';
            }
        }
        echo json_encode( $ops );

    } else if ( $action == "getSelectUsuario" ) {

        $stmt = $conn->prepare( "SELECT id, concat( nombres, ' ', apellidos ) nombre FROM usuarios WHERE activo = 1" );
        $stmt->execute();
        $result = $stmt->get_result();
        
        $ops = '';
        if( $result->num_rows > 0 ) {
            while( $row = $result->fetch_assoc() ) {
                $ops .= '<option value="'.$row['id'].'">' . 
                            $row['nombre'] . 
                        '</option>';
            }
        }
        echo json_encode( $ops );

    } else {
        $id = $_POST["id"];
		$stmt = $conn->prepare( "DELETE FROM reservaciones WHERE id = ?" );
        $stmt->bind_param( "s", $id );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/reservaciones.php?delete=1');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/reservaciones.php?delete=0');
        }
    }

?>
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
        
        $idEmpleado = $_POST["idEmpleado"];
        $idCliente  = $_POST["idCliente"];
        $idMesa     = $_POST["idMesa"];
        $total      = $_POST["total"];
        $fecha      = $_POST["fecha"];
        $estado     = $_POST["estado"];

        $stmt = $conn->prepare( "INSERT INTO factura VALUES ( null, ?, ?, ?, ?, ?, ? )" );
        $stmt->bind_param( "ssssss", $idMesa, $idEmpleado, $idCliente, $total, $fecha, $estado );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/facturas.php?error=0');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/facturas.php?error=1');
        }

    } else if( $action == "update" ){

        $id         = $_POST["id"];
        $idEmpleado = $_POST["idEmpleado"];
        $idCliente  = $_POST["idCliente"];
        $idMesa     = $_POST["idMesa"];
        $total      = $_POST["total"];
        $fecha      = $_POST["fecha"];
        $estado     = $_POST["estado"];

        $stmt = $conn->prepare( "UPDATE factura SET id_mesa = ?, id_empleado = ?, id_cliente = ?, total = ?, fecha = ?, estado = ? WHERE id = ?" );
        $stmt->bind_param( "sssssss", $idMesa, $idEmpleado, $idCliente, $total, $fecha, $estado, $id );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/facturas.php?update=1');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/facturas.php?update=0');
        }

    } else if( $action == "getFacturaById" ){

		$stmt = $conn->prepare( "SELECT * FROM factura WHERE id = ?" );
        $stmt->bind_param( "s", $_GET["id"] );
        $stmt->execute();
        $result = $stmt->get_result();

        if( $result->num_rows > 0 ) {
            while( $row = $result->fetch_assoc() ) {
                $output["idMesa"] = $row["id_mesa"];
                $output["idEmpleado"] = $row["id_empleado"];
                $output["idCliente"] = $row["id_cliente"];
                $output["total"] = $row["total"];
                $output["fecha"] = $row["fecha"];
                $output["estado"] = $row["estado"];
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
		$stmt = $conn->prepare( "UPDATE factura SET estado = 'I' WHERE id = ?" );
        $stmt->bind_param( "s", $id );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/facturas.php?delete=1');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/facturas.php?delete=0');
        }
    }

?>
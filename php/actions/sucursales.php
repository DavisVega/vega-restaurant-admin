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
        
        $nombre    = $_POST["nombre"];
        $telefono  = $_POST["telefono"];
        $celular   = $_POST["celular"];
        $direccion = $_POST["direccion"];

        $stmt = $conn->prepare( "INSERT INTO sucursales VALUES ( null, ?, ?, ?, ? )" );
        $stmt->bind_param( "ssss", $nombre, $telefono, $celular, $direccion );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/sucursales.php?error=0');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/sucursales.php?error=1');
        }

    } else if( $action == "update" ){

        $id        = $_POST["id"];
        $nombre    = $_POST["nombre"];
        $telefono  = $_POST["telefono"];
        $celular   = $_POST["celular"];
        $direccion = $_POST["direccion"];

        $stmt = $conn->prepare( "UPDATE sucursales SET nombre = ?, telefono = ?, celular = ?, direccion = ? WHERE id = ?" );
        $stmt->bind_param( "sssss", $nombre, $telefono, $celular, $direccion, $id );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/sucursales.php?update=1');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/sucursales.php?update=0');
        }

    } else if( $action == "getSucursalById" ){

		$stmt = $conn->prepare( "SELECT * FROM sucursales WHERE id = ?" );
        $stmt->bind_param( "s", $_GET["id"] );
        $stmt->execute();
        $result = $stmt->get_result();

        if( $result->num_rows > 0 ) {
            while( $row = $result->fetch_assoc() ) {
                $output["nombre"]    = $row["nombre"];
                $output["telefono"]  = $row["telefono"];
                $output["celular"]   = $row["celular"];
                $output["direccion"] = $row["direccion"];
            }
        }
        echo json_encode( $output );

    } else if ( $action == "getSelectSuc" ) {

        $stmt = $conn->prepare( "SELECT * FROM sucursales" );
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
		$stmt = $conn->prepare( "DELETE FROM sucursales WHERE id = ?" );
        $stmt->bind_param( "s", $id );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/sucursales.php?delete=1');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/sucursales.php?delete=0');
        }
    }

?>
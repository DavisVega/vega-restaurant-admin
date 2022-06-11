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
        
        $idPlatillo = $_POST["idPlatillo"];
        $cantidad   = $_POST["cantidad"];

        $stmt = $conn->prepare( "INSERT INTO inventario_platos VALUES ( null, ?, ? )" );
        $stmt->bind_param( "ss", $idPlatillo, $cantidad );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/inventarioPlatillos.php?error=0');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/inventarioPlatillos.php?error=1');
        }

    } else if( $action == "update" ){

        $id          = $_POST["id"];
        $idPlatillo = $_POST["idPlatillo"];
        $cantidad   = $_POST["cantidad"];

        $stmt = $conn->prepare( "UPDATE inventario_platos SET id_platillo = ?, cantidad = ? WHERE id = ?" );
        $stmt->bind_param( "sss", $idPlatillo, $cantidad, $id );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/inventarioPlatillos.php?update=1');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/inventarioPlatillos.php?update=0');
        }

    } else if( $action == "getPlatilloById" ){

		$stmt = $conn->prepare( "SELECT * FROM inventario_platos WHERE id = ?" );
        $stmt->bind_param( "s", $_GET["id"] );
        $stmt->execute();
        $result = $stmt->get_result();

        if( $result->num_rows > 0 ) {
            while( $row = $result->fetch_assoc() ) {
                $output["idPlatillo"] = $row["id_platillo"];
                $output["cantidad"] = $row["cantidad"];
            }
        }
        echo json_encode( $output );

    } else if ( $action == "getSelectPlatillo" ) {

        $stmt = $conn->prepare( "SELECT * FROM platillos" );
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
		$stmt = $conn->prepare( "DELETE FROM inventario_platos WHERE id = ?" );
        $stmt->bind_param( "s", $id );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/inventarioPlatillos.php?delete=1');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/inventarioPlatillos.php?delete=0');
        }
    }

?>
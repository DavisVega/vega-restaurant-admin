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
        
        $idFactura    = $_POST["idFactura"];
        $tipoTarjeta  = $_POST["tipoTarjeta"];
        $propietario  = $_POST["propietario"];
        $nTarjeta     = $_POST["nTarjeta"];
        $mes          = $_POST["mes"];
        $anio         = $_POST["anio"];
        $cvc          = $_POST["cvc"];

        $stmt = $conn->prepare( "INSERT INTO pago_tarjeta VALUES ( null, ?, ?, ?, ?, ?, ?, ? )" );
        $stmt->bind_param( "sssssss", $idFactura, $tipoTarjeta, $nTarjeta, $mes, $anio, $propietario, $cvc );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/pagoTarjeta.php?error=0');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/pagoTarjeta.php?error=1');
        }

    } else if( $action == "update" ){

        $id           = $_POST["id"];
        $idFactura    = $_POST["idFactura"];
        $tipoTarjeta  = $_POST["tipoTarjeta"];
        $propietario  = $_POST["propietario"];
        $nTarjeta     = $_POST["nTarjeta"];
        $mes          = $_POST["mes"];
        $anio         = $_POST["anio"];
        $cvc          = $_POST["cvc"];

        $stmt = $conn->prepare( "UPDATE pago_tarjeta SET id_factura = ?, tipo_tarjeta = ?, num_tarjeta = ?, mes_exp = ?, year_exp = ?, nom_propietario = ?, cvc = ? WHERE id = ?" );
        $stmt->bind_param( "ssssssss", $idFactura, $tipoTarjeta, $nTarjeta, $mes, $anio, $propietario, $cvc, $id );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/pagoTarjeta.php?update=1');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/pagoTarjeta.php?update=0');
        }

    } else if( $action == "getFacturaById" ){

		$stmt = $conn->prepare( "SELECT * FROM pago_tarjeta WHERE id = ?" );
        $stmt->bind_param( "s", $_GET["id"] );
        $stmt->execute();
        $result = $stmt->get_result();

        if( $result->num_rows > 0 ) {
            while( $row = $result->fetch_assoc() ) {
                $output["idFactura"] = $row["id_factura"];
                $output["tipoTarjeta"] = $row["tipo_tarjeta"];
                $output["nTarjeta"] = $row["num_tarjeta"];
                $output["mes"] = $row["mes_exp"];
                $output["anio"] = $row["year_exp"];
                $output["propietario"] = $row["nom_propietario"];
                $output["cvc"] = $row["cvc"];
            }
        }
        echo json_encode( $output );

    } else if ( $action == "getSelectFactura" ) {

        $stmt = $conn->prepare( "SELECT * FROM factura" );
        $stmt->execute();
        $result = $stmt->get_result();
        
        $ops = '';
        if( $result->num_rows > 0 ) {
            while( $row = $result->fetch_assoc() ) {
                $ops .= '<option value="'.$row['id'].'">' . 
                            $row['id'] . 
                        '</option>';
            }
        }
        echo json_encode( $ops );

    } else {
        $id = $_POST["id"];
		$stmt = $conn->prepare( "DELETE FROM pago_tarjeta WHERE id = ?" );
        $stmt->bind_param( "s", $id );
        $stmt->execute();

        if( $stmt ){
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/pagoTarjeta.php?delete=1');      
        } else {
            $stmt->close();
            header('Location: http://localhost:8080/vega-restaurant-admin/views/pagoTarjeta.php?delete=0');
        }
    }

?>
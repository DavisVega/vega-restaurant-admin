<?php
class Data {
	public function getAllUsuarios (){
		require_once('connection.php');
		$db = new Conecction();
		$conn = $db->getConnection();

		$stmt = $conn->prepare( "SELECT * FROM usuarios WHERE activo = 1 ORDER BY 1" );
		$stmt->execute();
		$result = $stmt->get_result();
		
		$trs = '';
		if( $result->num_rows > 0 ) {
			while( $row = $result->fetch_assoc() ) {
                $nombre = $row['nombres'].' '.$row['apellidos'];

                if( $row['tipo_usuario'] == "U" ){
                    $tipo = "Usuario";
                } else if( $row['tipo_usuario'] == "E" ){
                    $tipo = "Empleado";
                } else {
                    $tipo = "Administrador";
                } 

				$trs .= '<tr>
							<td>'.$row['id'].'</td>
							<td>'.$nombre.'</td>
							<td>'.$tipo.'</td>
							<td>'.$row['email'].'</td>
							<td>'.$row['cargo'].'</td>
							<td style="text-align: center">
								<button class="btn btn-warning edit" id="'.$row['id'].'" >Editar</button>
								<button class="btn btn-danger delete"  id="'.$row['id'].'" >Eliminar</button>
							</td>
						 </tr>';
			}
		}
		mysqli_close( $conn );
		return $trs;
	}

	public function getAllSucursales (){
		require_once('connection.php');
		$db = new Conecction();
		$conn = $db->getConnection();

		$stmt = $conn->prepare( "SELECT * FROM sucursales ORDER BY 1" );
		$stmt->execute();
		$result = $stmt->get_result();
		
		$trs = '';
		if( $result->num_rows > 0 ) {
			while( $row = $result->fetch_assoc() ) {
				$trs .= '<tr>
							<td>'.$row['id'].'</td>
							<td>'.$row['nombre'].'</td>
							<td>'.$row['telefono'].'</td>
							<td>'.$row['celular'].'</td>
							<td>'.$row['direccion'].'</td>
							<td style="text-align: center">
								<button class="btn btn-warning edit" id="'.$row['id'].'" >Editar</button>
								<button class="btn btn-danger delete"  id="'.$row['id'].'" >Eliminar</button>
							</td>
						 </tr>';
			}
		}
		mysqli_close( $conn );
		return $trs;
	}

	public function getAllTipoPlatillos (){
		require_once('connection.php');
		$db = new Conecction();
		$conn = $db->getConnection();

		$stmt = $conn->prepare( "SELECT * FROM tipo_platillo ORDER BY 1" );
		$stmt->execute();
		$result = $stmt->get_result();
		
		$trs = '';
		if( $result->num_rows > 0 ) {
			while( $row = $result->fetch_assoc() ) {
				$trs .= '<tr>
							<td>'.$row['id'].'</td>
							<td>'.$row['descripcion'].'</td>
							<td style="text-align: center">
								<button class="btn btn-warning edit" id="'.$row['id'].'" >Editar</button>
								<button class="btn btn-danger delete"  id="'.$row['id'].'" >Eliminar</button>
							</td>
						 </tr>';
			}
		}
		mysqli_close( $conn );
		return $trs;
	}

	public function getAllMesas (){
		require_once('connection.php');
		$db = new Conecction();
		$conn = $db->getConnection();

		$stmt = $conn->prepare( "SELECT * FROM mesas ORDER BY 1" );
		$stmt->execute();
		$result = $stmt->get_result();
		
		$trs = '';
		if( $result->num_rows > 0 ) {
			while( $row = $result->fetch_assoc() ) {
				$trs .= '<tr>
							<td>'.$row['id'].'</td>
							<td>'.$row['num_mesa'].'</td>
							<td style="text-align: center">
								<button class="btn btn-warning edit" id="'.$row['id'].'" >Editar</button>
								<button class="btn btn-danger delete"  id="'.$row['id'].'" >Eliminar</button>
							</td>
						 </tr>';
			}
		}
		mysqli_close( $conn );
		return $trs;
	}

	public function getAllPlatillos (){
		require_once('connection.php');
		$db = new Conecction();
		$conn = $db->getConnection();

		$stmt = $conn->prepare( "select p.id, tp.descripcion tipoPlatillo, p.nombre , p.precio , p.estado 
								from platillos p 
								inner join tipo_platillo tp on p.id_tipo_platillo = tp.id 
								order by p.id;" 
							);
		$stmt->execute();
		$result = $stmt->get_result();
		
		$trs = '';
		if( $result->num_rows > 0 ) {
			while( $row = $result->fetch_assoc() ) {
				$activo = $row['estado'] == 'A'? 'Activo' : 'Inactivo';
				$trs .= '<tr>
							<td>'.$row['id'].'</td>
							<td>'.$row['tipoPlatillo'].'</td>
							<td>'.$row['nombre'].'</td>
							<td>'.$row['precio'].'</td>
							<td>'.$activo.'</td>
							<td style="text-align: center">
								<button class="btn btn-warning edit" id="'.$row['id'].'" >Editar</button>
								<button class="btn btn-danger delete"  id="'.$row['id'].'" >Eliminar</button>
							</td>
						 </tr>';
			}
		}
		mysqli_close( $conn );
		return $trs;
	}

	public function getAllInvPlatillos (){
		require_once('connection.php');
		$db = new Conecction();
		$conn = $db->getConnection();

		$stmt = $conn->prepare( "select ip.id, tp.descripcion tipoPlatillo, p.nombre platillo, p.precio, ip.cantidad 
							from inventario_platos ip 
							inner join platillos p on ip.id_platillo = p.id
							inner join tipo_platillo tp on p.id_tipo_platillo = tp.id 
							order by 1;" 
						);
		$stmt->execute();
		$result = $stmt->get_result();
		
		$trs = '';
		if( $result->num_rows > 0 ) {
			while( $row = $result->fetch_assoc() ) {
				$trs .= '<tr>
							<td>'.$row['id'].'</td>
							<td>'.$row['tipoPlatillo'].'</td>
							<td>'.$row['platillo'].'</td>
							<td>'.$row['precio'].'</td>
							<td>'.$row['cantidad'].'</td>
							<td style="text-align: center">
								<button class="btn btn-warning edit" id="'.$row['id'].'" >Editar</button>
								<button class="btn btn-danger delete"  id="'.$row['id'].'" >Eliminar</button>
							</td>
						 </tr>';
			}
		}
		mysqli_close( $conn );
		return $trs;
	}

	public function getAllReservaciones (){
		require_once('connection.php');
		$db = new Conecction();
		$conn = $db->getConnection();

		$stmt = $conn->prepare( "select r.id, s.nombre sucursal, m.num_mesa, concat( u.nombres, ' ', u.apellidos ) usuario, r.fecha 
							from reservaciones r 
							inner join sucursales s on r.id_sucursal = s.id 
							inner join mesas m on r.id_mesa = m.id
							inner join usuarios u on r.id_usuario = u.id
							order by 1;" 
						);
		$stmt->execute();
		$result = $stmt->get_result();
		
		$trs = '';
		if( $result->num_rows > 0 ) {
			while( $row = $result->fetch_assoc() ) {
				$trs .= '<tr>
							<td>'.$row['id'].'</td>
							<td>'.$row['sucursal'].'</td>
							<td>'.$row['num_mesa'].'</td>
							<td>'.$row['usuario'].'</td>
							<td>'.$row['fecha'].'</td>
							<td style="text-align: center">
								<button class="btn btn-warning edit" id="'.$row['id'].'" >Editar</button>
								<button class="btn btn-danger delete"  id="'.$row['id'].'" >Eliminar</button>
							</td>
						 </tr>';
			}
		}
		mysqli_close( $conn );
		return $trs;
	}

	public function getAllFacturas (){
		require_once('connection.php');
		$db = new Conecction();
		$conn = $db->getConnection();

		$stmt = $conn->prepare( "select f.id, m.num_mesa mesa, concat(emp.nombres, ' ', emp.apellidos ) empleado, 
						concat( cli.nombres, ' ', cli.apellidos ) cliente,
						f.total, f.fecha
						from factura f
						inner join mesas m on f.id_mesa = m.id 
						inner join usuarios cli on f.id_cliente = cli.id
						inner join usuarios emp on f.id_empleado = emp.id
						where estado = 'A'
						order by 1;" 
					);
		$stmt->execute();
		$result = $stmt->get_result();
		
		$trs = '';
		if( $result->num_rows > 0 ) {
			while( $row = $result->fetch_assoc() ) {
				$trs .= '<tr>
							<td>'.$row['id'].'</td>
							<td>'.$row['mesa'].'</td>
							<td>'.$row['empleado'].'</td>
							<td>'.$row['cliente'].'</td>
							<td>'.$row['total'].'</td>
							<td>'.$row['fecha'].'</td>
							<td style="text-align: center">
								<button class="btn btn-warning edit" id="'.$row['id'].'" >Editar</button>
								<button class="btn btn-danger delete"  id="'.$row['id'].'" >Eliminar</button>
							</td>
						 </tr>';
			}
		}
		mysqli_close( $conn );
		return $trs;
	}

	public function getAllPagos (){
		require_once('connection.php');
		$db = new Conecction();
		$conn = $db->getConnection();

		$stmt = $conn->prepare( "select pt.id, f.id nFactura, pt.tipo_tarjeta, concat( pt.mes_exp, '-', pt.year_exp) expiracion, pt.nom_propietario 
						from pago_tarjeta pt 
						inner join factura f on pt.id_factura = f.id
						order by 1;" 
					);
		$stmt->execute();
		$result = $stmt->get_result();
		
		$trs = '';
		if( $result->num_rows > 0 ) {
			while( $row = $result->fetch_assoc() ) {
				$tipo = $row['tipo_tarjeta'] == "C" ? "Credito" : "Debito"; 

				$trs .= '<tr>
							<td>'.$row['id'].'</td>
							<td>'.$row['nFactura'].'</td>
							<td>'.$tipo.'</td>
							<td>'.$row['expiracion'].'</td>
							<td>'.$row['nom_propietario'].'</td>
							<td style="text-align: center">
								<button class="btn btn-warning edit" id="'.$row['id'].'" >Editar</button>
								<button class="btn btn-danger delete"  id="'.$row['id'].'" >Eliminar</button>
							</td>
						 </tr>';
			}
		}
		mysqli_close( $conn );
		return $trs;
	}
}
?>
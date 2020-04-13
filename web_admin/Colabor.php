<?php
session_start();

class Colabor
{
	private $con;

	function __construct()
	{
		include_once("database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function addCliente(
	$nombres,
	$apellidos,
	$razonsocial,
	$numerodocumento,
	$direccion,
	$telefono,
	$email,
	$clave){
		$q = $this->con->query("SELECT * FROM colaboradores WHERE email = '$email' LIMIT 1");
		if ($q->num_rows > 0) {
			return ['status'=> 303, 'message'=> 'colaboradores ya existente'];
		}else{
			$clave = md5($clave);
			$q = $this->con->query("INSERT INTO colaboradores (nombre, apellidos, Razonsocil, dni, direccion, telefono, email, clave, fecharegistro) VALUES
			('$nombres','$apellidos', '$razonsocial',
			'$numerodocumento', '$direccion', '$telefono', '$email', '$clave',  NOW() )");
			if ($q) {
				return ['status'=> 202, 'message'=> ' Se registro colaboradores'];
			}else{
				return ['status'=> 303, 'message'=> 'No se ha podido guardar el colaboradores'];
			}
		}
	}

	public function getClientes(){
		$q = $this->con->query("SELECT * FROM colaboradores");
		$ar = [];
		if ($q->num_rows > 0) {
			while ($row = $q->fetch_assoc()) {
				$ar[] = $row;
			}
		}
		return ['status'=> 202, 'message'=> $ar];
	}


	public function paginarCliente($per_page,$page,$query){

		$query = mysqli_real_escape_string($this->con, trim($_REQUEST['query']));

		$tables="colaboradores";
		$campos="*";
		$sWhere=" colaboradores.nombre LIKE '%".$query."%'";
		$sWhere.=" order by colaboradores.idcolaborador";
		include 'pagination.php';
		$adjacents  = 4;
	    $offset = ($page - 1) * $per_page;
		$count_query   = $this->con->query("SELECT count(*) AS numrows FROM $tables where $sWhere ");

		if ($row = mysqli_fetch_array($count_query))
		{
			$numrows = $row['numrows'];
		}
		else {
			echo mysqli_error($this->con);
		}

		$total_pages = ceil($numrows/$per_page);
		$query = $this->con->query("SELECT $campos FROM  $tables where $sWhere LIMIT $offset,$per_page");

		if ($numrows>0){

        ?>

          <div class="tbl-wrapper">
            <div class="table-responsive">
                <table class="order-table table table-hover table-bordered">
                    <thead>
                        <tr>
														<th>#</th>
                            <th>Nombre y Apellidos</th>
														<th>N° Documento </th>
                            <th>Razon Social </th>
														<th class='text-center'>Dirección </th>
                            <th class='text-center'>Telefono </th>
                            <th class='text-center'>Acción </th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php

                            $finales=0;
                            while($row = mysqli_fetch_array($query)){
                                $id = $row['idcolaborador'];
                                $nombres = $row['nombre'];
                                $apellidos = $row['apellidos'];
								$numerodocumento = $row['dni'];
								$razonsocial = $row['Razonsocil'];
								$direccion = $row['direccion'];
                                $telefono = $row['telefono'];

                                $finales++;
                            ?>
                            <tr>
							    <td ><?php echo $id;?></td>
                                <td ><?php echo $nombres .' '. $apellidos;?></td>
								<td ><?php echo $numerodocumento; ?></td>
                                <td ><?php echo $razonsocial; ?></td>
							    <td ><?php echo $direccion; ?></td>
                                <td class='text-center' ><?php echo $telefono;?></td>
                                <td class='text-center'>
																		<a href="#" class="btn btn-sm btn-info edit-category" data-id="<?php echo $id; ?>"><span style="display: none;"><?php echo json_encode($row); ?></span><i class="fas fa-pencil-alt"></i></a>
                                		<a href="#" class="btn btn-sm btn-danger delete-customer" data-cid="<?php echo $id; ?>"><i class="fas fa-trash-alt"></i></a>
																		<!--<a cid="'+value.idcliente+'" class="btn btn-sm btn-danger delete-category"><i class="fas fa-trash-alt"></i></a>-->
                                </td>
                            </tr>
                            <?php }?>
                            <tr>
                                <td colspan='7'>
                                    <?php
                                        $inicios=$offset+1;
                                        $finales+=$inicios -1;
                                        echo "Mostrando $inicios al $finales de $numrows registros";
                                        echo paginate( $page, $total_pages, $adjacents);
                                    ?>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
		}


    }




   

	public function deleteCustomer($cid = null){
		if ($cid != null) {
			// Verifico que no tenga ventas.
			$qv = $this->con->query("SELECT * FROM pedido WHERE idcolaborador = '$cid'");
			if($qv){
				return ['status'=> 202, 'message'=> 'No se ha podido eliminar el colaboradores porque este tiene pedidos en su haber'];
			}

			$qv = $this->con->query("SELECT * FROM venta WHERE idcolaborador = '$cid'  LIMIT 1 ");
			if($qv->num_rows > 0){
				return ['status'=> 202, 'message'=> 'No se ha podido eliminar la categoria porque esta tiene productos en su haber'];
			}

			$q = $this->con->query("DELETE FROM colaboradores WHERE idcolaborador = '$cid'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Colaborador eliminada exitosamente'];
			}else{
				return ['status'=> 202, 'message'=> 'No se ha podido eliminar el colaborador'];
			}

		}else{
			return ['status'=> 303, 'message'=> 'ID de categoria inválido'];
		}
    }
    


	public function updateCliente($post = null){
		extract($post);
		if (!empty($idcliente)
		&& !empty($_nombres)
		&& !empty($_apellidos)
		&& !empty($_email)
		&& !empty($_clave)
		&& !empty($_numerodocumento)
		&& !empty($_razonsocial)
		&& !empty($_direccion)
		&& !empty($_telefono)
		) {
			$_clave = md5($_clave);
			$q = $this->con->query("UPDATE colaboradores SET nombre = '$_nombres', apellidos= '$_apellidos', email ='$_email' , clave ='$_clave' , dni ='$_numerodocumento' , Razonsocil ='$_razonsocial'  , direccion ='$_direccion' , telefono ='$_telefono' , fechamodifico =  NOW()  WHERE idcolaborador = '$idcliente'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'colaboradores modificado correctamente'];
			}else{
				return ['status'=> 202, 'message'=> 'No se podido modificar el colaboradores' ];
			}
		}else{
			return ['status'=> 303, 'message'=>'ID de categoria inválido'];
		}
	}
}


if (isset($_POST['add_cliente'])) {
	if (isset($_SESSION['admin_id'])) {
		$nombres = $_POST['nombre'];
		$apellidos = $_POST['apellidos'];
		$razonsocial= $_POST['Razonsocil'];
		$numerodocumento= $_POST['dni'];
		$direccion = $_POST['direccion'];
		$telefono = $_POST['telefono'];
		$email = $_POST['email'];
		$clave = $_POST['clave'];
		if (!empty($nombres)) {
			$p = new Colabor();
			echo json_encode($p->addCliente($nombres, $apellidos, $razonsocial, $numerodocumento, $direccion,$telefono, $email,$clave ));
		}else{
			echo json_encode(['status'=> 303, 'message'=> 'Campos vacios']);
		}
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Error de sesión']);
	}
}

if (isset($_POST['action'])) {
	if($_POST['action'] = 'ajax'){
		if (isset($_SESSION['admin_id'])) {
		$per_page = $_POST['per_page'];
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$query = trim(strip_tags($_REQUEST['query'], ENT_QUOTES));

		if (!empty($per_page)) {
				$p = new Colabor();
				echo json_encode($p->paginarCliente($per_page,$page,$query));
			}else{
				echo json_encode(['status'=> 303, 'message'=> 'Campos vacios']);
			}
		}else{
			echo json_encode(['status'=> 303, 'message'=> 'Error de sesión']);
		}
	}
}

if (isset($_POST['GET_CLIENTE'])) {
	$p = new Colabor();
	echo json_encode($p->getClientes());
	exit();
}

if (isset($_POST['DELETE_CLIENTE'])) {
	if (!empty($_POST['cid'])) {
		$p = new Colabor();
		echo json_encode($p->deleteCustomer($_POST['cid']));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'ID del colaborador inválido']);
		exit();
	}
}

if (isset($_POST['edit_category'])) {

	if (!empty($_POST['idcliente'])) {
		$p = new Colabor();
		echo json_encode($p->updateCliente($_POST));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'ID del colaborador inválido']);
		exit();
	}
}

?>

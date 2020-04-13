<?php
session_start();

class REPREDIRECTIVA
{

	private $con;

	function __construct()
	{
		include_once("database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function getProveedor(){

		$categories = [];
		$q = $this->con->query("SELECT * FROM representantes");
		if ($q->num_rows > 0) {
			while($row = $q->fetch_assoc()){
				$categories[] = $row;
			}
			//return ['status'=> 202, 'message'=> $ar];
			$_DATA['categories'] = $categories;
		}

		return ['status'=> 202, 'message'=> $_DATA];
	}


	public function paginarProveedor($per_page,$page,$query){

		$query = mysqli_real_escape_string($this->con, $_REQUEST['query']);

		$tables="representantes";
		$campos="*";
		$sWhere=" representantes.nombre LIKE '%".$query."%'";
		$sWhere.=" order by representantes.idrepresentante";
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
                            <th>N°</th>
                            <th>RUC </th>
														<th>Nombre </th>
														<th>Dirección </th>
														<th>Razon Social </th>
														<th>Telefono </th>
                            <th class='text-right'>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                            $finales=0;
                            while($row = mysqli_fetch_array($query)){
																$id = $row['idrepresentante'];
																$nombre = $row['nombre'];
																$ruc = $row['ruc'];
																$direccion = $row['direccion'];
																$razonsocial = $row['razonsocial'];
																$telefono = $row['telefono'];
                                $finales++;
                            ?>
                            <tr >
                                <td ><?php echo $id;?></td>
																<td ><?php echo $ruc;?></td>
																<td ><?php echo $nombre;?></td>
																<td ><?php echo $direccion;?></td>
																<td ><?php echo $razonsocial;?></td>
																<td ><?php echo $telefono;?></td>
                                <td class='text-center'>
<a href="#" class="btn btn-sm btn-info edit-supplier" data-id="<?php echo $id; ?>"><span style="display: none;"><?php echo json_encode($row); ?></span><i class="fas fa-pencil-alt"></i></a>
<a href="#" class="btn btn-sm btn-danger delete-supplier" data-id="<?php echo $id; ?>"><i class="fas fa-trash-alt"></i></a>
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


	public function addCategory($ruc,$nombre,$direccion,$razonsocial,$telefono){
		$q = $this->con->query("SELECT * FROM representantes WHERE ruc = '$ruc' LIMIT 1");
		if ($q->num_rows > 0) {
			return ['status'=> 303, 'message'=> 'representantes ya existe'];
		}else{
			$q = $this->con->query("INSERT INTO representantes (ruc, nombre, direccion, razonsocial,telefono, fecharegistro, estado) VALUES ('$ruc','$nombre', '$direccion','$razonsocial','$telefono', NOW(), 'A')");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Nueva directiva agregado exitosamente'];
			}else{
				return ['status'=> 303, 'message'=> 'No se ha podido agregar el representantes'];
			}
		}
	}

	public function getCategories(){
		$q = $this->con->query("SELECT * FROM representantes");
		$ar = [];
		if ($q->num_rows > 0) {
			while ($row = $q->fetch_assoc()) {
				$ar[] = $row;
			}
		}
		return ['status'=> 202, 'message'=> $ar];
	}



	public function deleteSupplier($pid = null){
		if ($pid != null) {
			// Verifico que no tenga ventas.
			$qv = $this->con->query("SELECT * FROM solicitud WHERE 	idrepresentante = '$pid' LIMIT 1");
			if($qv ->num_rows > 0){
				return ['status'=> 202, 'message'=> 'No se ha podido eliminar el representantes porque este tiene pedidos en su haber'];
			}
			$qv = $this->con->query("SELECT * FROM proyecto WHERE 	idrepresentante = '$pid' LIMIT 1");
			if($qv ->num_rows > 0){
				return ['status'=> 202, 'message'=> 'No se ha podido eliminar el representantes porque este tiene producto en su haber'];
			}

			$q = $this->con->query("DELETE FROM representantes WHERE 	idrepresentante = '$pid'") or die($this->con->error);
			if ($q) {
				return ['status'=> 202, 'message'=> 'representantes eliminado exitosamente'];
			}else{
				return ['status'=> 202, 'message'=> 'No se ha podido eliminar la representantes'];
			}
		}else{
			return ['status'=> 303, 'message' => 'ID de representantes inválido'];
		}

	}



	public function updateCategory($post = null){

		extract($post);
		if (!empty($idrepresentante)
		&& !empty($_ruc)
		&& !empty($_nombre)
		&& !empty($_razonsocial)
		&& !empty($_telefono)
		) {
			$q = $this->con->query("UPDATE representantes SET ruc = '$_ruc', nombre= '$_nombre', direccion ='$_direccion' , razonsocial ='$_razonsocial' , telefono ='$_telefono', fechamodifico = NOW()  WHERE idrepresentante = '$idrepresentante'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Representantes actualizada'];
			}else{
				return ['status'=> 202, 'message'=> 'No se ha podido actualizar la Representantes' ];
			}

		}else{
			return ['status'=> 303, 'message'=>'ID de categoria inválido'];
		}

	}
}


if (isset($_POST['add_repredirectiva'])) {
	if (isset($_SESSION['admin_id'])) {
		$ruc = $_POST['ruc'];
		$nombre = $_POST['nombre'];
		$direccion= $_POST['direccion'];
		$razonsocial = $_POST['razonsocial'];
		$telefono = $_POST['telefono'];
		if (!empty($ruc)) {
			$p = new REPREDIRECTIVA();
			echo json_encode($p->addCategory($ruc,$nombre,$direccion, $razonsocial,$telefono));
		}else{
			echo json_encode(['status'=> 303, 'message'=> 'Campos vacios']);
		}
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Error de puta']);
	}
}

if (isset($_POST['GET_PROVEEDOR'])) {
	$p = new REPREDIRECTIVA();
	echo json_encode($p->getCategories());
	exit();

}




if (isset($_POST['DELETE_SUPPLIER'])) {
	if (!empty($_POST['pid'])) {
		$p = new REPREDIRECTIVA();
		echo json_encode($p->deleteSupplier($_POST['pid']));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'ID de Representante inválido']);
		exit();
	}
}

if (isset($_POST['edit_category'])) {

	if (!empty($_POST['idrepresentante'])) {
		$p = new REPREDIRECTIVA();
		echo json_encode($p->updateCategory($_POST));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Detalles inválidos']);
		exit();
	}
}


if (isset($_POST['action'])) {
	if($_POST['action'] = 'ajax'){
		if (isset($_SESSION['admin_id'])) {
		$per_page = $_POST['per_page'];
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$query = trim(strip_tags($_REQUEST['query'], ENT_QUOTES));

		if (!empty($per_page)) {
				$p = new REPREDIRECTIVA();
				echo json_encode($p->paginarProveedor($per_page,$page,$query));
			}else{
				echo json_encode(['status'=> 303, 'message'=> 'Empty fields']);
			}
		}else{
			echo json_encode(['status'=> 303, 'message'=> 'maldita session']);
		}

	}
}



?>

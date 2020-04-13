<?php
session_start();

class comisionbuscar
{

	private $con;

	function __construct()
	{
		include_once("database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function getProducts(){

		$categories = [];
		$q = $this->con->query("SELECT * FROM categoria");
		if ($q->num_rows > 0) {
			while($row = $q->fetch_assoc()){
				$categories[] = $row;
			}
			//return ['status'=> 202, 'message'=> $ar];
			$_DATA['categories'] = $categories;
		}


		return ['status'=> 202, 'message'=> $_DATA];
	}


// llamamos al archivo pagination 
	public function paginarCategoria($per_page,$page,$query){
		$query = mysqli_real_escape_string($this->con, $_REQUEST['query']);
		$tables="comision";
		$campos="*";
		$sWhere=" comision.descripcion LIKE '%".$query."%'";
		$sWhere.=" order by comision.idcomision";
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
							<th>Descripción</th>
                            <th class='text-right'>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                            $finales=0;
                            while($row = mysqli_fetch_array($query)){
                                $id = $row['idcomision'];
                                $descripcion = $row['descripcion'];
                                $finales++;
                            ?>
                            <tr >
							<td ><?php echo $id;?></td>
                                <td ><?php echo $descripcion;?></td>
                                <td class='text-center'>
								<a href="#" class="btn btn-sm btn-info edit-category" data-id="<?php echo $id; ?>"><span style="display: none;">
								<?php echo json_encode($row); ?></span><i class="fas fa-pencil-alt"></i></a>
								<a href="#" class="btn btn-sm btn-danger delete-category" data-id="<?php echo $id; ?>"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            <?php }?>
                            <tr>
                                <td colspan='3'>
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





	public function addCategory($descripcion){
		$q = $this->con->query("SELECT * FROM comision WHERE descripcion = '$descripcion' LIMIT 1");
		if ($q->num_rows > 0) {
			return ['status'=> 303, 'message'=> 'ya existe el registro'];
		}else{
			$q = $this->con->query("INSERT INTO comision (descripcion, estado, fecharegistro) VALUES ('$descripcion',1, NOW())");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Se registro correctamente'];
			}else{
				return ['status'=> 303, 'message'=> 'No se pudo registrar'];
			}
		}
	}

	public function getCategories(){
		$q = $this->con->query("SELECT * FROM comision");
		$ar = [];
		if ($q->num_rows > 0) {
			while ($row = $q->fetch_assoc()) {
				$ar[] = $row;
			}
		}
		return ['status'=> 202, 'message'=> $ar];
	}



	public function deleteCategory($cid = null){
		if ($cid != null) {

			$qv = $this->con->query("SELECT * FROM proyecto WHERE idcomision = '$cid'  LIMIT 1 ");
			if($qv->num_rows > 0){
				return ['status'=> 202, 'message'=> 'No se ha podido eliminar la comision porque esta tiene proyecto en su haber'];
			}

			$q = $this->con->query("DELETE FROM comision WHERE idcomision = '$cid'")  or die($this->con->error);
			if ($q) {
				return ['status'=> 202, 'message'=> 'comision eliminada'];
			}else{
				return ['status'=> 202, 'message'=> 'No se ha podido eliminar la comision'];
			}

		}else{
			return ['status'=> 303, 'message'=>'ID de comision inválido'];
		}

	}



	public function updateCategory($post = null){
		extract($post);
		if (!empty($cat_id) && !empty($e_cat_title)) {
			$q = $this->con->query("UPDATE comision SET descripcion = '$e_cat_title' WHERE idcomision = '$cat_id'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'comision actualizada exitosamente'];
			}else{
				return ['status'=> 202, 'message'=> 'No se ha podido actualizar la comision'];
			}

		}else{
			return ['status'=> 303, 'message' => 'ID de comision inválido'];
		}

	}










}






if (isset($_POST['add_comsion'])) {
	
		$descripcion = $_POST['descripcion'];
		if (!empty($descripcion)) {
			$p = new comisionbuscar();
			echo json_encode($p->addCategory($descripcion));
		}else{
			echo json_encode(['status'=> 303, 'message'=> 'Campos vacios']);
		}
	
}

if (isset($_POST['GET_CATEGORIES'])) {
	$p = new comisionbuscar();
	echo json_encode($p->getCategories());
	exit();

}




if (isset($_POST['DELETE_CATEGORY'])) {
	if (!empty($_POST['cid'])) {
		$p = new comisionbuscar();
		echo json_encode($p->deleteCategory($_POST['cid']));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'ID de comision inválido']);
		exit();
	}
}

if (isset($_POST['edit_category'])) {
	if (!empty($_POST['cat_id'])) {
		$p = new comisionbuscar();
		echo json_encode($p->updateCategory($_POST));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'NO registrado ']);
		exit();
	}
}



if (isset($_POST['action'])) {
	if($_POST['action'] = 'ajax'){
		
		$per_page = $_POST['per_page'];
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$query = trim(strip_tags($_REQUEST['query'], ENT_QUOTES));

		if (!empty($per_page)) {
				$p = new comisionbuscar();
				echo json_encode($p->paginarCategoria($per_page,$page,$query));
			}else{
				echo json_encode(['status'=> 303, 'message'=> 'Empty fields']);
			}
	}
}

?>

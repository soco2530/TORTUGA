<?php
session_start();

class listarproyecto
{
	private $con;

	function __construct()
	{
		include_once("database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function getAllProducts(){
		$q = $this->con->query("SELECT * FROM proyecto");

		$products = [];
		if ($q->num_rows > 0) {
			while($row = $q->fetch_assoc()){
				$products[] = $row;
			}
			//return ['status'=> 202, 'message'=> $ar];
			$_DATA['products'] = $products;
		}

		$categorias = [];
		$q = $this->con->query("SELECT * FROM comision");
		if ($q->num_rows > 0) {
			while($row = $q->fetch_assoc()){
				$categorias[] = $row;
			}
			//return ['status'=> 202, 'message'=> $ar];
			$_DATA['categorias'] = $categorias;
		}

		$proveedores = [];
		$q = $this->con->query("SELECT * FROM representantes");
		if ($q->num_rows > 0) {
			while($row = $q->fetch_assoc()){
				$proveedores[] = $row;
			}
			//return ['status'=> 202, 'message'=> $ar];
			$_DATA['proveedores'] = $proveedores;
		}


		return ['status'=> 202, 'message'=> $_DATA];
	}

	public function getProducts(){
		$q = $this->con->query("SELECT * FROM proyecto LIMIT 1 ");

		$products = [];
		if ($q->num_rows > 0) {
			while($row = $q->fetch_assoc()){
				$products[] = $row;
			}
			//return ['status'=> 202, 'message'=> $ar];
			$_DATA['products'] = $products;
		}

		$categorias = [];
		$q = $this->con->query("SELECT * FROM comision");
		if ($q->num_rows > 0) {
			while($row = $q->fetch_assoc()){
				$categorias[] = $row;
			}
			//return ['status'=> 202, 'message'=> $ar];
			$_DATA['categorias'] = $categorias;
		}

		$proveedores = [];
		$q = $this->con->query("SELECT * FROM representantes");
		if ($q->num_rows > 0) {
			while($row = $q->fetch_assoc()){
				$proveedores[] = $row;
			}
			//return ['status'=> 202, 'message'=> $ar];
			$_DATA['proveedores'] = $proveedores;
		}


		return ['status'=> 202, 'message'=> $_DATA];
	}

	public function paginarProducto($per_page,$page,$query){

		$query = mysqli_real_escape_string($this->con, $_REQUEST['query']);

		$tables="proyecto p join comision c on c.idcomision=p.idcomision join representantes pr on pr.idrepresentante =p.idrepresentante";
		$campos="p.idproyecto, p.descripcion, p.stock, p.precio,  p.imagen,  p.fecharegistro,  p.fechamodifco,  p.usuario,  p.estado,  p.idcomision,  c.descripcion
		as comision,  pr.idrepresentante,  pr.razonsocial as representantes,  p.oferta,  p.descuento";
		$sWhere=" p.descripcion LIKE '%".$query."%'";
		$sWhere.=" order by p.idproyecto";
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
          <input type="hidden" name="last_type" id="last_type" value="<?php echo $type ?>"/>
          <div class="tbl-wrapper">
            <div class="table-responsive">
                <table class="order-table table table-hover table-bordered">
                    <thead>
                        <tr>
														<th>#</th>
                            <th>Descripción</th>
														<th>Imagen </th>
														<th>Precio </th>
														<th>Stock </th>
														<th>Categoria </th>
														<th>Proveedor </th>
                            <th class='text-center'>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                            $finales=0;
                            while($row = mysqli_fetch_array($query)){
                                $id = $row['idproyecto'];
                                $descripcion = $row['descripcion'];
																$imagen = $row['imagen'];
                                $precio = $row['precio'];
                                $stock = $row['stock'];
																$categoria = $row['comision'];
																$proveedor = $row['representantes'];
                                $finales++;
                            ?>
                            <tr >
                                <td><?php echo $id;?></td>
                                <td><?php echo $descripcion;?></td>
																<td><img class="img_colectivo" src="../product_images/<?php echo $imagen;?>"></td>
                                <td class='text-center'><?php echo $precio;?></td>
																<td class='text-center'><?php echo $stock;?></td>
																<td><?php echo $categoria;?></td>
																<td><?php echo $proveedor;?></td>
                                <td class="text-center">
																		<a href="#" class="btn btn-sm btn-info edit-product" data-id="<?php echo $id; ?>"><span style="display: none;"><?php echo json_encode($row); ?></span><i class="fas fa-pencil-alt"></i></a>
                                		<a href="#" class="btn btn-sm btn-danger delete-product" data-id="<?php echo $id; ?>"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            <?php }?>
                            <tr>
                                <td colspan='8'>
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


	public function addProduct($descripcion,
								$idcategoria,
								$idproveedor,
								$precio,
								$stock,
								$file){


		$fileName = $file['name'];
		$fileNameAr= explode(".", $fileName);
		$extension = end($fileNameAr);
		$ext = strtolower($extension);

		if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {

			//print_r($file['size']);

			if ($file['size'] > (1024 * 2)) {

				$uniqueImageName = time()."_".$file['name'];
				if (move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/product_images/".$uniqueImageName)) {

					$q = $this->con->query("INSERT INTO producto (descripcion, stock, precio, imagen, idcategoria, idproveedor) VALUES ('$descripcion', '$stock', '$precio', '$uniqueImageName', '$idcategoria', '$idproveedor')");

					if ($q) {
						return ['status'=> 202, 'message'=> 'Producto agregado exitosamente..!'];
					}else{
						return ['status'=> 303, 'message'=> 'No se ha podido agregar el producto'];
					}

				}else{
					return ['status'=> 303, 'message'=> 'No se ha podido subir la imagen'];
				}

			}else{
				return ['status'=> 303, 'message'=> 'Imagen demasiado grande, tamaño maximo 2MB'];
			}

		}else{
			return ['status'=> 303, 'message'=> 'Formato inválido de imagen [Formatos validos: jpg, jpeg, png]'];
		}

	}


	public function editProductWithImage($pid,
										$_descripcion,
										$_idcategoria,
										$_idproveedor,
										$_precio,
										$_stock,
										$file){


		$fileName = $file['name'];
		$fileNameAr= explode(".", $fileName);
		$extension = end($fileNameAr);
		$ext = strtolower($extension);

		if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {

			//print_r($file['size']);

			if ($file['size'] > (1024 * 2)) {

				$uniqueImageName = time()."_".$file['name'];
				if (move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/product_images/".$uniqueImageName)) {

					$q = $this->con->query("UPDATE `producto` SET
										`descripcion` = '$_descripcion',
										`idcategoria` = '$_idcategoria',
										`idproveedor` = '$_idproveedor',
										`precio` = '$_precio',
										`stock` = '$_stock',
										`imagen` = '$uniqueImageName'
										WHERE idproducto = '$pid'");

					if ($q) {
						return ['status'=> 202, 'message'=> 'Producto Modificado exitosamente..!'];
					}else{
						return ['status'=> 303, 'message'=> 'No se ha podido agregar el producto'];
					}

				}else{
					return ['status'=> 303, 'message'=> 'No se ha podido subir la imagen'];
				}

			}else{
				return ['status'=> 303, 'message'=> 'Imagen demasiado grande, tamaño maximo 2MB'];
			}

		}else{
			return ['status'=> 303, 'message'=> 'Formato inválido de imagen [Formatos validos: jpg, jpeg, png]'];
		}

	}

	public function editProductWithoutImage($pid,
										$_descripcion,
										$_idcategoria,
										$_idproveedor,
										$_precio,
										$_stock){

		if ($pid != null) {
			$q = $this->con->query("UPDATE `producto` SET
										`descripcion` = '$_descripcion',
										`idcategoria` = '$_idcategoria',
										`idproveedor` = '$_idproveedor',
										`precio` = '$_precio',
										`stock` = '$_stock'

										WHERE idproducto = '$pid'");

			if ($q) {
				return ['status'=> 202, 'message'=> 'Producto actualizado exitosamente'];
			}else{
				return ['status'=> 303, 'message'=> 'No se ha podido actualizar el producto'];
			}

		}else{
			return ['status'=> 303, 'message'=> 'ID del producto inválido'];
		}

	}


	public function getProveedores(){
		$q = $this->con->query("SELECT * FROM proveedor");
		$ar = [];
		if ($q->num_rows > 0) {
			while ($row = $q->fetch_assoc()) {
				$ar[] = $row;
			}
		}
		return ['status'=> 202, 'message'=> $ar];
	}

	public function addCategory($name){
		$q = $this->con->query("SELECT * FROM categories WHERE cat_title = '$name' LIMIT 1");
		if ($q->num_rows > 0) {
			return ['status'=> 303, 'message'=> 'Categoria ya existente'];
		}else{
			$q = $this->con->query("INSERT INTO categories (cat_title) VALUES ('$name')");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Nueva categoria agregada exitosamente'];
			}else{
				return ['status'=> 303, 'message'=> 'No se ha podido agregar la categoria'];
			}
		}
	}

	public function getCategorias(){
		$q = $this->con->query("SELECT * FROM categoria");
		$ar = [];
		if ($q->num_rows > 0) {
			while ($row = $q->fetch_assoc()) {
				$ar[] = $row;
			}
		}
		return ['status'=> 202, 'message'=> $ar];
	}

	public function deleteProduct($pid = null){
		if ($pid != null) {
			$qv = $this->con->query("SELECT * FROM detalle_pedido WHERE idproducto = '$pid'  LIMIT 1 ");
			if($qv->num_rows > 0){
				return ['status'=> 202, 'message'=> 'No se ha podido eliminar el producto porque esta tiene detalles de pedido en su haber'];
			}

			$qv = $this->con->query("SELECT * FROM detalle_venta WHERE idproducto = '$pid'  LIMIT 1 ");
			if($qv->num_rows > 0){
				return ['status'=> 202, 'message'=> 'No se ha podido eliminar el producto porque esta tiene detalle de venta en su haber'];
			}

			$q = $this->con->query("DELETE FROM producto WHERE idproducto = '$pid'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Producto eliminado exitosamente'];
			}else{
				return ['status'=> 202, 'message'=> 'No se ha podido eliminar el producto'];
			}

		}else{
			return ['status'=> 303, 'message'=>'ID del producto inválido'];
		}

	}

	public function deleteCategory($cid = null){
		if ($cid != null) {
			$q = $this->con->query("DELETE FROM categories WHERE cat_id = '$cid'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Categoria eliminada exitosamente'];
			}else{
				return ['status'=> 202, 'message'=> 'No se ha podido eliminar la categoria'];
			}

		}else{
			return ['status'=> 303, 'message' => 'ID de la categoria inválida'];
		}

	}



	public function updateCategory($post = null){
		extract($post);
		if (!empty($cat_id) && !empty($e_cat_title)) {
			$q = $this->con->query("UPDATE categories SET cat_title = '$e_cat_title' WHERE cat_id = '$cat_id'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Categoria actualizada exitosamente'];
			}else{
				return ['status'=> 202, 'message'=> 'No se ha podido actualizar la categoria exitosamente'];
			}

		}else{
			return ['status'=> 303, 'message' => 'ID de la categoria inválida'];
		}

	}

	public function addBrand($name){
		$q = $this->con->query("SELECT * FROM brands WHERE brand_title = '$name' LIMIT 1");
		if ($q->num_rows > 0) {
			return ['status'=> 303, 'message'=> 'La marca ya existe'];
		}else{
			$q = $this->con->query("INSERT INTO brands (brand_title) VALUES ('$name')");
			if ($q) {


				//"addBrand"
				// Cambiando los mensajes a español ---------------------------------------------------




				return ['status'=> 202, 'message'=> 'Nueva marca agregada exitosamente'];
			}else{
				return ['status'=> 303, 'message'=> 'No se ha podido agregar la marca'];
			}
		}
	}

	public function deleteBrand($bid = null){
		if ($bid != null) {
			$q = $this->con->query("DELETE FROM brands WHERE brand_id = '$bid'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Marca eliminada exitosamente'];
			}else{
				return ['status'=> 202, 'message'=> 'No se ha podido eliminar la marca'];
			}

		}else{
			return ['status'=> 303, 'message'=>'ID de marca inválido'];
		}

	}



	public function updateBrand($post = null){
		extract($post);
		if (!empty($brand_id) && !empty($e_brand_title)) {
			$q = $this->con->query("UPDATE brands SET brand_title = '$e_brand_title' WHERE brand_id = '$brand_id'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Marca modificada exitosamente'];
			}else{
				return ['status'=> 202, 'message'=> 'No se ha podido modificar la marca'];
			}

		}else{
			return ['status'=> 303, 'message' => 'ID de marca inválido'];
		}

	}



}


if (isset($_POST['GET_PRODUCT'])) {
		$p = new listarproyecto();
		echo json_encode($p->getProducts());
		exit();
}


if (isset($_POST['add_product'])) {

	extract($_POST);
	if (!empty($descripcion)
	&& !empty($idcategoria)
	&& !empty($idproveedor)
	&& !empty($precio)
	&& !empty($stock)
	&& !empty($_FILES['imagen']['name'])) {


		$p = new Products();
		$result = $p->addProduct(
								$descripcion,
								$idcategoria,
								$idproveedor,
								$precio,
								$stock,
								$_FILES['imagen']);

		header("Content-type: application/json");
		echo json_encode($result);
		http_response_code($result['status']);
		exit();


	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Campos vacios']);
		exit();
	}




}


if (isset($_POST['edit_product'])) {

	extract($_POST);
	if (!empty($pid)
	&& !empty($_descripcion)
	&& !empty($_idcategoria)
	&& !empty($_idproveedor)
	&& !empty($_precio)
	&& !empty($_stock)) {

		$p = new listarproyecto();

		if (isset($_FILES['_imagen']['name'])
			&& !empty($_FILES['_imagen']['name'])) {
			$result = $p->editProductWithImage($pid,
								$_descripcion,
								$_idcategoria,
								$_idproveedor,
								$_precio,
								$_stock,
								$_FILES['_imagen']);
		}else{
			$result = $p->editProductWithoutImage($pid,
								$_descripcion,
								$_idcategoria,
								$_idproveedor,
								$_precio,
								$_stock);
		}

		echo json_encode($result);
		exit();


	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Campos vacios']);
		exit();
	}




}

if (isset($_POST['GET_PROVEEDOR'])) {
	$p = new listarproyecto();
	echo json_encode($p->getProveedores());
	exit();

}

if (isset($_POST['add_category'])) {
	if (isset($_SESSION['admin_id'])) {
		$cat_title = $_POST['cat_title'];
		if (!empty($cat_title)) {
			$p = new listarproyecto();
			echo json_encode($p->addCategory($cat_title));
		}else{
			echo json_encode(['status'=> 303, 'message'=> 'Campos vacios']);
		}
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Error de sesión']);
	}
}

if (isset($_POST['GET_CATEGORIAS'])) {
	$p = new listarproyecto();
	echo json_encode($p->getCategorias());
	exit();

}

if (isset($_POST['DELETE_PRODUCT'])) {
	$p = new listarproyecto();
	if (isset($_SESSION['admin_id'])) {
		if(!empty($_POST['pid'])){
			$pid = $_POST['pid'];
			echo json_encode($p->deleteProduct($pid));
			exit();
		}else{
			echo json_encode(['status'=> 303, 'message'=> 'ID de producto inválido']);
			exit();
		}
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Sesión inválida']);
	}


}


if (isset($_POST['DELETE_CATEGORY'])) {
	if (!empty($_POST['cid'])) {
		$p = new listarproyecto();
		echo json_encode($p->deleteCategory($_POST['cid']));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Detalles inválidos']);
		exit();
	}
}

if (isset($_POST['edit_category'])) {
	if (!empty($_POST['cat_id'])) {
		$p = new listarproyecto();
		echo json_encode($p->updateCategory($_POST));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Detalles inválidos']);
		exit();
	}
}

if (isset($_POST['add_brand'])) {
	if (isset($_SESSION['admin_id'])) {
		$brand_title = $_POST['brand_title'];
		if (!empty($brand_title)) {
			$p = new listarproyecto();
			echo json_encode($p->addBrand($brand_title));
		}else{
			echo json_encode(['status'=> 303, 'message'=> 'Campos vacios']);
		}
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Error de sesión']);
	}
}

if (isset($_POST['DELETE_BRAND'])) {
	if (!empty($_POST['bid'])) {
		$p = new listarproyecto();
		echo json_encode($p->deleteBrand($_POST['bid']));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Detalles inválidos']);
		exit();
	}
}

if (isset($_POST['edit_brand'])) {
	if (!empty($_POST['brand_id'])) {
		$p = new listarproyecto();
		echo json_encode($p->updateBrand($_POST));
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
				$p = new listarproyecto();
				echo json_encode($p->paginarProducto($per_page,$page,$query));
			}else{
				echo json_encode(['status'=> 303, 'message'=> 'Campos vacios']);
			}
		}else{
			echo json_encode(['status'=> 303, 'message'=> 'Error de sesión']);
		}

	}
}

?>

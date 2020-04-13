<?php session_start(); ?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>

<style media="screen">
  .img_producto{
    width: 70px;
    height: auto;
  }
</style>

<div class="container-fluid">
  <div class="row">

    <?php include "./templates/sidebar.php"; ?>
      <div id="message"></div>

      <div class="row">
      	<div class="col-10">
      		<h2>Listado Proyectos</h2>
      	</div>
      	<div class="col-2">
      		<a href="#" data-toggle="modal" data-target="#add_product_modal" class="btn btn-primary btn-sm">Nuevo Proyectos</a>
      	</div>
      </div>

      <div class="table-responsive">
        <div class='col-sm-4 pull-left'>
          <div id="custom-search-input">
              <div class="input-group col-md-12">
                  <input type="text" class="form-control" placeholder="Buscar"  id="q" />
                  <span class="input-group-btn">
                      <button class="btn btn-info" type="button" onclick="load(1);">
                          <span class="fas fa-search-plus"></span>
                      </button>
                  </span>
              </div>
          </div>
        </div>

        <div class='clearfix'></div>
        <hr>
        <div id="loader"></div><!-- Carga de datos ajax aqui -->
        <div id="resultados"></div><!-- Carga de datos ajax aqui -->
        <div class='outer_div'></div><!-- Carga de datos ajax aqui -->
      </div>
    <br>

    </main>
  </div>
</div>



<!-- Add Product Modal start -->
<div class="modal fade" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Proyecto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add-product-form" enctype="multipart/form-data">
        	<div class="row">
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Descripcion</label>
		        		<input type="text" name="descripcion" class="form-control" placeholder="Descripcion">
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Comision</label>
		        		<select class="form-control category_list" name="idcategoria">
		        			<option value="">Seleccione Comision</option>
		        		</select>
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Proveedor </label>
		        		<select class="form-control proveedor_list" name="idproveedor">
		        			<option value="">Seleccione Representante</option>
		        		</select>
		        	</div>
        		</div>

            <div class="col-12">
              <div class="form-group">
                <label>Precio</label>
                <input type="number" name="precio" class="form-control" placeholder="Precio">
              </div>
            </div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Stock</label>
		        		<input type="number" name="stock" class="form-control" placeholder="Stock">
		        	</div>
        		</div>

        		<div class="col-12">
        			<div class="form-group">
		        		<label>Imagen Producto <small>(format: jpg, jpeg, png)</small></label>
		        		<input type="file" name="imagen" class="form-control">
		        	</div>
        		</div>
        		<input type="hidden" name="add_product" value="1">
        		<div class="col-12">
        			<button type="button" class="btn btn-primary add-product">Registrar Proyectos</button>
        		</div>
        	</div>

        </form>
      </div>
    </div>
  </div>
</div>
<!-- Add Product Modal end -->

<!-- Edit Product Modal start -->
<div class="modal fade" id="edit_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Proyectos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-product-form" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Descripcion</label>
                <input type="text" name="_descripcion" class="form-control" placeholder="Descripcion">
              </div>
            </div>


            <div class="col-12">
        			<div class="form-group">
		        		<label>Comision</label>
		        		<select class="form-control category_list" name="_idcategoria">
		        			<option value="">Seleccione Comision</option>
		        		</select>
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Representante </label>
		        		<select class="form-control proveedor_list" name="_idproveedor">
		        			<option value="">Seleccione Representante</option>
		        		</select>
		        	</div>
        		</div>

            <div class="col-12">
              <div class="form-group">
                <label>Precio</label>
                <input type="number" name="_precio" class="form-control" placeholder="Precio">
              </div>
            </div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Stock</label>
		        		<input type="number" name="_stock" class="form-control" placeholder="Stock">
		        	</div>
        		</div>

            <div class="col-12">
              <div class="form-group">
                <label>Imgagen Producto <small>(format: jpg, jpeg, png)</small></label>
                <input type="file" name="_imagen" class="form-control">
                <img src="../product_images/1.0x0.jpg" class="img-fluid" width="50">
              </div>
            </div>
            <input type="hidden" name="pid">
            <input type="hidden" name="edit_product" value="1">
            <div class="col-12">
              <button type="button" class="btn btn-primary submit-edit-product">Modificar</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<!-- Edit Product Modal end -->

<?php include_once("./templates/footer.php"); ?>



<script type="text/javascript" src="proyecto.js"></script>

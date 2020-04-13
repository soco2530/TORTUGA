<?php session_start(); ?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">


    <?php include "./templates/sidebar.php"; ?>
      <div id="message">
      </div>

      <div class="row">
      	<div class="col-10">
      		<h2>Comisiones </h2>
      	</div>
      	<div class="col-2">
      		<a href="#" data-toggle="modal" data-target="#add_category_modal" class="btn btn-primary btn-sm">Nueva Comision</a>
      	</div>
      </div>
      <p class="message"></p>

      <div class="table-responsive">
        <div class='col-sm-4 pull-left'>
          <div id="custom-search-input">
              <div class="input-group col-md-12">
                  <input type="text" class="form-control" placeholder="Buscar" id="q" />
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

























<!-- Modal -->
<div class="modal fade" id="add_category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva Comisión</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add-category-form" enctype="multipart/form-data">
        	<div class="row">
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Descripcion</label>
		        		<input type="text" name="descripcion"  id="descripcion" class="form-control" placeholder="Ingrese Descripcion">
		        	</div>
        		</div>
        		<input type="hidden" name="add_comsion" value="1">
        		<div class="col-12">
        			<button type="button" class="btn btn-primary add-category">Guardar</button>
        		</div>
        	</div>

        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->

<!--Edit category Modal -->
<div class="modal fade" id="edit_category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Actualizar Comisión</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-category-form" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12">
              <input type="hidden" name="cat_id">
              <div class="form-group">
                <label>Descripcion</label>
                <input type="text" name="e_cat_title" class="form-control" placeholder="Ingrese Descripcion">
              </div>
            </div>
            <input type="hidden" name="edit_category" value="1">
            <div class="col-12">
              <button type="button" class="btn btn-primary edit-category-btn">Actualizar</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->

<?php include_once("./templates/footer.php"); ?>



<script src="comision.js"></script>
<?php session_start(); ?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">

    <?php include "./templates/sidebar.php"; ?>
      <div id="message"></div>

      <div class="row">
      	<div class="col-10">
      		<h2>Mantenimiento de colaboradores</h2>
      	</div>
	      <div class="col-2">
      		<a href="#" data-toggle="modal" data-target="#add_category_modal" class="btn btn-primary btn-sm">Nuevo Miembro</a>
      	</div>
      </div>
      <p class="message"></p>

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



<!-- Modal -->
<div class="modal fade" id="add_category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Miembro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add-cliente-form" >
        	<div class="row">

            <div class="col-12">
        			<div class="form-group">
		        		<label>Nombres</label>
		        		<input type="text" name="nombres" class="form-control" placeholder="Ingrese Nombres">
		        	</div>
        		</div>

            <div class="col-12">
        			<div class="form-group">
		        		<label>Apellidos</label>
		        		<input type="text" name="apellidos" class="form-control" placeholder="Ingrese Apellidos">
		        	</div>
        		</div>

            <div class="col-12">
        			<div class="form-group">
		        		<label>Email</label>
		        		<input type="text" name="email" class="form-control" placeholder="Ingrese email">
		        	</div>
        		</div>
            <div class="col-12">
        			<div class="form-group">
		        		<label>Clave</label>
		        		<input type="password" name="clave" class="form-control" placeholder="Ingrese Clave">
		        	</div>
        		</div>


            <div class="col-12">
        			<div class="form-group">
		        		<label>Nª Documento</label>
		        		<input type="text" name="numerodocumento" class="form-control" placeholder="Ingrese Nª Documento">
		        	</div>
        		</div>

            <div class="col-12">
        			<div class="form-group">
		        		<label>Razon social</label>
		        		<input type="text" name="razonsocial" class="form-control" placeholder="Ingrese Razonsocial">
		        	</div>
        		</div>
            <div class="col-12">
        			<div class="form-group">
		        		<label>Direccion</label>
		        		<input type="text" name="direccion" class="form-control" placeholder="Ingrese Direccion">
		        	</div>
        		</div>

            <div class="col-12">
        			<div class="form-group">
		        		<label>Telefono</label>
		        		<input type="text" name="telefono" class="form-control" placeholder="Ingrese Telefono">
		        	</div>
        		</div>

        		<input type="hidden" name="add_cliente" value="1">
        		<div class="col-12">
        			<button type="button" class="btn btn-primary add-cliente">Guardar</button>
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
        <h5 class="modal-title" id="exampleModalLabel"> Actualizar Miembro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-category-form">
          <div class="row">
            <div class="col-12">


            <div class="col-12">
            <input type="hidden" name="idcliente">
        			<div class="form-group">
		        		<label>Nombre</label>
		        		<input type="text" name="_nombres" class="form-control" placeholder="Ingrese Nombre">
		        	</div>
        		</div>


            <div class="col-12">
        			<div class="form-group">
		        		<label>Apellidos</label>
		        		<input type="text" name="_apellidos" class="form-control" placeholder="Ingrese Apellidos">
		        	</div>
        		</div>

            <div class="col-12">
        			<div class="form-group">
		        		<label>Email</label>
		        		<input type="text" name="_email" class="form-control" placeholder="Ingrese Email">
		        	</div>
        		</div>
            <div class="col-12">
        			<div class="form-group">
		        		<label>Clave</label>
		        		<input type="password" name="_clave" class="form-control" placeholder="Ingrese Clave">
		        	</div>
        		</div>


            <div class="col-12">
        			<div class="form-group">
		        		<label>Nª Documento</label>
		        		<input type="text" name="_numerodocumento" class="form-control" placeholder="Ingrese Nª Documento">
		        	</div>
        		</div>

            <div class="col-12">
        			<div class="form-group">
		        		<label>Razon social</label>
		        		<input type="text" name="_razonsocial" class="form-control" placeholder="Ingrese Razonsocial">
		        	</div>
        		</div>
            <div class="col-12">
        			<div class="form-group">
		        		<label>Direccion</label>
		        		<input type="text" name="_direccion" class="form-control" placeholder="Ingrese Direccion">
		        	</div>
        		</div>

            <div class="col-12">
        			<div class="form-group">
		        		<label>Telefono</label>
		        		<input type="text" name="_telefono" class="form-control" placeholder="Ingrese Telefono">
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
<script type="text/javascript" src="colaborar.js"></script>

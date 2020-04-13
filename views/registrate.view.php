<!DOCTYPE html>
<html lang="en">
<head>

<!--<meta charset="UTF-8"> -->
<meta http-equiv="Content-Type" content="text/html;charset= Windows-1252">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registro de Volunatarios</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/nosotros.css">
	<link href="web_admin/css/estilos.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/fotos2.css">
	<link rel="stylesheet" type="text/css" href="css/est.css">
	<link rel="stylesheet" type="text/css" href="css/dona.css">
	<script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
		<style></style>
</head>
<body>


<div class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
					<span class="sr-only">navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
			</div>
		<div class="collapse navbar-collapse" id="collapse">
			<ul class="nav navbar-nav">
            <li><a href="nosotros.php"><span class="glyphicon glyphicon-modal-window"></span> Quiénes somos</a></li>
			  <li><a href="proyectos.php"><span class="glyphicon glyphicon-modal-window"></span> CLT-CT-Proyectos</a></li>
				
			  <li><a href="index.html"><span class="glyphicon glyphicon-modal-window" ></span> Ayúdanos</a></li>
				
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Testimonios</a></li>
				<li><a href="video.html"><span class="glyphicon glyphicon-modal-window"></span> Galería</a></li>
				<li><a href="contacto.php"><span class="glyphicon glyphicon-modal-window"></span> Contáctanos</a></li>
	
            </ul>

            <!--
			<form class="navbar-form navbar-left">
		        <div class="form-group">
		          <input type="text" class="form-control" placeholder="Search" id="search">
		        </div>
		        <button type="submit" class="btn btn-primary" id="search_btn"><span class="glyphicon glyphicon-search"></span></button>
		     </form>
			 -->
			<ul class="nav navbar-nav navbar-right">
			
			</ul>
		</div>
	</div>
</div>
</div>
<p><br/></p>
	<p><br/></p>
	<p><br/></p>
<div class="container-fluid">
<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="signup_msg">
				<!--Alert from signup form-->
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
		<div class="panel panel-primary">
		<div class="panel-heading">Registrate Voluntario</div>
		<div class="panel-body">

	

		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="formulario" name="login" >
			<div class="row">
			  <div class="col-md-6">
			     <label for="nombres">Apellidos</label>
				  <input type="text" name="usuario" class="form-control" placeholder="Apellidos completos">
			   </div>
			    <div class="col-md-6">
			     <label for="apellidos">Nombre</label>
			     <input type="text" name="nombre" class="form-control" placeholder="Primer Nombre">
			   </div>
			</div>

			<div class="row">
			    <div class="col-md-6">
			     <label for="nombres">Telefono</label>
				 <input type="text" name="telefono" class="form-control" placeholder="Telefono">
			   </div>
			   <div class="col-md-6">
			     <label for="apellidos">Contraseña</label>
			     <input type="password" name="password" class="form-control" placeholder="Contraseña">
			   </div>
			
			</div>
			
			<div class="row">
			  <div class="col-md-6">
			     <label for="nombres">Confirmar Contraseña</label>
				 <input type="password" name="password2" class="form-control" placeholder="Confirmar Contraseña"><br><br>
			   </div>
			   
		
			</div>
			<p><br/></p>
			

			<div class="row">
			    <div class="col-md-8">
								
				<input style="width:50%;" value="Registrar"    onclick="login.submit()" class="btn btn-success btn-lg">
			   </div>
				
			</div>

		
			</form>

			<div class="panel-footer"></div>
	   </div>
   </div>
   <div class="col-md-2"></div>
</div>
</div>


<!--Mensaje de error -->
			<?php if(!empty($errores)): ?>
				<div>
					<ul>
						<?php echo $errores; ?>
					</ul>
				</div>
			<?php endif; ?>
		</form>
		<div class="panel panel-primary">
		      <div class="row">
		           <div class="col-md-6">
		           <ul> <label for="nombres">¿Ya tienes cuenta? </label></ul>
			     
			<ul><a href="loginusu.php"><button type="submit" class="btn btn-primary text-center">Iniciar Cuenta</button></a></ul>
        
		
		</div>
		</div>
	</div>
</body>
</html>
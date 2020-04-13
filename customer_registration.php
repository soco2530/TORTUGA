
<!DOCTYPE html>
<html>
	<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
		
		<title>Registro de Volunatarios</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="main.js"></script>
		
	</head>
<body>
<div class="wait overlay">
	<div class="loader"></div>
</div>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
			
			</div>
			<ul class="nav navbar-nav">
			<li><a href="nosotros.php"><span class="glyphicon glyphicon-modal-window"></span> Quiénes somos</a></li>
			  <li><a href="proyectos.php"><span class="glyphicon glyphicon-modal-window"></span> CLT-CT-Proyectos</a></li>
				
			  <li><a href="index.html"><span class="glyphicon glyphicon-modal-window" ></span> Ayúdanos</a></li>
				
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Testimonios</a></li>
				<li><a href="video.html"><span class="glyphicon glyphicon-modal-window"></span> Galería</a></li>
				<li><a href="contacto.php"><span class="glyphicon glyphicon-modal-window"></span> Contáctanos</a></li>
	
			
			</ul>
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
					<div class="panel-heading">Registro de Cliente</div>
					<div class="panel-body">

					<form id="signup_form" onsubmit="return false">
						<div class="row">
							<div class="col-md-6">
								<label for="nombres">Nombres</label>
								<input type="text" id="nombres" name="nombres" class="form-control">
							</div>
							<div class="col-md-6">
								<label for="apellidos">Apellidos</label>
								<input type="text" id="apellidos" name="apellidos"class="form-control">
							</div>
						</div>


						<div class="row">
							<div class="col-md-6">
								<label for="email">Email</label>
								<input type="text" id="email" name="email"class="form-control">
							</div>
							<div class="col-md-6">
								<label for="clave">Clave</label>
								<input type="password" id="clave" name="clave"class="form-control">
							</div>
						</div>
						<div class="row">

						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="repassword">Confirmar Clave</label>
								<input type="password" id="repassword" name="repassword"class="form-control">
							</div>
							<div class="col-md-6">
								<label for="telefono">Telefono</label>
								<input type="text" id="telefono" name="telefono"class="form-control">
							</div>
						</div>
						<div class="row">

						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="direccion">Direccion</label>
								<input type="text" id="direccion" name="direccion"class="form-control">
							</div>
							<div class="col-md-6">
								<label for="direccion">Documento</label>
								<input type="text" id="documento" name="documento"class="form-control">
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<label for="direccion">Razón social</label>
								<input type="text" id="razon_social" name="razon_social"class="form-control">
							</div>
						</div>

						<p><br/></p>
						<div class="row">
							<div class="col-md-8">
								
								<input style="width:50%;" value="Registrar" type="submit" name="signup_button"class="btn btn-success btn-lg">
							</div>
						</div>

					  </div>
					</form>

					<div class="panel-footer"></div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
	<script>
 	$("#signup_form").on("submit",function(event){
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url : "register.php",
			method : "POST",
			data : $("#signup_form").serialize(),
			success : function(data){
				$(".overlay").hide();
				if (data == "register_success") {
					window.location.href = "formam.php";
				}else{
					$("#signup_msg").html(data);
				}

			}
		})
	})
</script>
</body>
</html>
	

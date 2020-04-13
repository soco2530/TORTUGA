<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login usuario|Colectivo</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/main.js"></script>
	<link rel="stylesheet" type="text/css" href="web_admin/css/nosotros.css">
	<link href="web_admin/css/estilos.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/fotos2.css">
	<link rel="stylesheet" type="text/css" href="css/est.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="stylesheet" type="text/css" href="css/fondoimg.css">

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
           
                <li><a href="proyectos.php"><span class="glyphicon glyphicon-modal-window"></span> CLT-CT-Proyectos</a></li>
                  
                <li><a href="index.html"><span class="glyphicon glyphicon-modal-window" ></span> Ayúdanos</a></li>
                  
                 
              
	
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
<div id="fondo">
  <div id="nosotros">

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
          <img src="img/LOGOSINFONDO.png" alt="Trulli" width="90" height="80">
			  BIENVENIDO VOLUNTARIO<small></small></h1>
          </div>
          <p>Para mayor información click INICIAR SESIÓN</p>
        
        </div>
      </div>
    </header>
</div>
</div>
<div class="fondo-titulo" >
<div class="container">
<ul class="nav navbar-nav navbar-center">
			<a href="#" class="navbar-brand"></a>
				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Iniciar Sesión</a>
					<ul class="dropdown-menu">
						<div style="width:300px;">
							<div class="panel panel-primary">
								<div class="panel-heading"> INICIAR CUENTA </div>
								<div class="panel-heading">
            
									<form action="PRUEBALOGIN.php" method="post">
										<label for="ape">Primer Nombre</label>
										<input type="text" class="form-control" name="login"/>
										<label for="email">Contraseña</label>
										<input type="password" class="form-control" name="password"/>
                    <p><br/></p>
   
										<a href="registrate.php" style="color:white; list-style:none;">Registrarse</a><input type="submit" class="btn btn-success"  value="Iniciar Sesión"style="float:right;">
									</form>
								</div>
								<div class="panel-footer" id="e_msg"></div>
							</div>
						</div>
					</ul>
				</li>
			</ul>

</div>
</div>


    
</body>
</html>

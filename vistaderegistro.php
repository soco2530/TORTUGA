<!DOCTYPE html>
<html lang="en">
<head>

<!--<meta charset="UTF-8">-->
<meta http-equiv="Content-Type" content="text/html;charset= Windows-1252">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>colectivo CP.La Tortuga </title>
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
  <?php 
  $conexion=mysqli_connect('localhost', 'root','','tasks-app');

  /*function mostrarr($str){
    $Codificacion= mb_detect_encoding($str, "UTF-8, ISO-8859-1");
    $str = iconv( $Codificacion, 'UTF-8', $str);
    echo $str;
  }*/
  ?>
<?php 
    session_start();
    if(!isset($_SESSION["usuario"])){
        header("location:login.php");

    }else{

    }

    ?>
    
   

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
	
			
                  <li><a href="vistaderegistro.php"><span class="glyphicon glyphicon-user"></span> Registro Volunatarios </a></li>
                  <li><a href="CIERRE.php" ><span class="glyphicon glyphicon-user"></span>Cerrar Sesión</a>
      
	
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
			<a href="#" class="navbar-brand"></a>
			
       
				</li>
			</ul>
		</div>
	</div>
</div>
<div id="fondo">
    <div id="nosotros">

<header id="header">
        <div class="container">
          <div class="row">
            <div class="col-md-10">
              <h1><img src="img/LOGOSINFONDO.png" alt="Trulli" width="90" height="80">ERES PARTE DE NUESTRO EQUIPO</h1>
            </div>
            
            <ul class="nav navbar-nav">
              <!--  buscador  -->
            
              </ul>
       <br><br>                  
    <?php

echo "Bienvenido/a  " .$_SESSION["usuario"]."<br><br>";

?>
<p>Esto es información para administradores registrados </P> 

          </div>
        </div>
      </header>

    <div class="fondo-titulo"></div>

 
   

        <div class="container p-6">
            <div class="row">
               <div class="panel panel-primary">
               <div class="panel-heading">Lista de los Registrados</div>
               <div class="panel-body">
                <div class="col-md-2">
         
                </div>
                <div class="col-md-7">
                <div class="card my-4" id="task-result">
                    <div>
                        <div class ="card-body ">
                            <ul id="container">
                            
                            </ul>

                        </div>
                       
                    </div> 
                    
                </div>
            
                <table class="table table-bordered table-sm"  cellspacing="10" cellpadding="10" border="3"> 
                    <thead>
                        <tr rowspan="2" colspan="2" align="center" bgcolor="#D7BDE2">
                            <td align="center">N°</td>
                            <td>Apellidos</td>
                            <td>Nombre</td>
                            <td>Cellular</td>
                        </tr>

                        <?php 
                        $sql="SELECT * FROM colaboradores";
                        $result=mysqli_query($conexion,$sql);

                        while($mostrar=mysqli_fetch_array($result)){
                      
                        

                        ?>
                        <tr>
                            <td><?php echo/* mostrarr(*/$mostrar['idcolaborador']?></td>
                            <td><?php echo /*mostrarr(*/$mostrar['usuario'] ?></td>
                            <td><?php echo/* mostrarr(*/$mostrar['nombre'] ?></td>
                            <td><?php echo /*mostrarr(*/$mostrar['telefono'] ?></td>
                        </tr>
                        <?php

                        }
                        ?>
                    </thead>
                    
                </table>
                      </div>
                      </div>
            </div>
            </div>
</div>
                <div id="footer">
                    <div id="copyrights">
                       <p><a href="index.html">Volver</a></p>
                            &copy; 2020  <a href="#">Colectivo Civico la Tortuga </a> 
                       </div> 
    









              


























































  
   

    










    
 <script
                src="https://code.jquery.com/jquery-3.4.1.js"
                integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
                crossorigin="anonymous"></script>
                <script src="js/registrobuscar.js"></script>
            
   
   
    
</body>

</html>
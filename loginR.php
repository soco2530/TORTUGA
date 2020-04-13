<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>colectivo CP.La Tortuga| LOGIN </title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/main.js"></script>
	<link rel="stylesheet" type="text/css" href="css/nosotros.css">
	<link href="web_admin/css/estilos.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/fotos2.css">
	<link rel="stylesheet" type="text/css" href="css/est.css">
	<link rel="stylesheet" type="text/css" href="web_admin/loginR.css">
	<link rel="stylesheet" type="text/css" href="web_admin/fondoimg.css">
	
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
            <li><a href="nosotros.php"><span class="glyphicon glyphicon-modal-window"></span> Quienes somos</a></li>
                <li><a href="proyectos.php"><span class="glyphicon glyphicon-modal-window"></span> CLT-CT-Proyectos</a></li>
                  
                <li><a href="index.html"><span class="glyphicon glyphicon-modal-window" ></span> Ayudanos</a></li>
                  
                  <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Testimonios</a></li>
                  <li><a href="video.html"><span class="glyphicon glyphicon-modal-window"></span> Galeria </a></li>
                  <li><a href="contacto.php"><span class="glyphicon glyphicon-modal-window"></span> Contacto</a></li>
                  <li><a href="cierrec.php" ><span class="glyphicon glyphicon-user"></span>Cerrar Sesión</a>
	
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
			  BIENVENIDO ADMINISTRADOR <small></small></h1>
          </div>
        
        </div>
      </div>
    </header>
</div>
</div>

    <div class="fondo-titulo">
<div class="container">

</div>
</div>

<?php 
if (isset($_POST["enviar"])){
    
  try{
$base=new PDO("mysql:host=localhost; dbname=tasks-app", "root","");
$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql="SELECT * FROM USUARIOS_PASS WHERE USUARIOS= :login AND PASSWORD= :password";

$resultado=$base->prepare($sql);

$login=htmlentities(addslashes($_POST["login"]));
$password=htmlentities(addslashes($_POST["password"]));

$resultado->bindValue(":login", $login);
$resultado->bindValue(":password", $password);
$resultado->execute();
$numero_registro=$resultado->rowCount();

if($numero_registro!=0){
 // echo"<h2>Adelante!!</h2>";
 session_start();
 $_SESSION["usuario"]=$_POST["login"];
 //header("location:respuestacomentario.php");

} else{
 //header ("location:loginR.php");
 echo "Error. Usuario o contraseña incorrectos";
}

  }catch(Exception $e){

    die("Error ". $e->getMessage());
  }

}
  ?>

<?php 

if(!isset($_SESSION["usuario"])){

    include("formulario.php");
}else{
    echo "Usuario: ".$_SESSION["usuario"];

}
?>

<br><br>
<h2>CONTENIDO DE LA WEB</h2>
<table width="800" border="0">
<tr>
<td><img src="img/ceviche de marisos.jpg" width="300" height="166"></td>
<td><img src="img/arros con pato.jpg" width="300" height="166"></td>
</tr>
<tr>
<td><img src="img/cabrillon frito 2.jpg" width="300" height="166"></td>
<td><img src="img/cabrillon frito.jpg" width="300" height="166"></td>
</table>




<div class="container">

</div>


</div>
	</div>
<div id="footer">
 <div id="copyrights">
    <p><a href="index.html">Volver</a></p>
         &copy; 2020  <a href="#">Colectivo Civico la Tortuga </a> 
    </div> 
</div>

  
    
</body>
</html>
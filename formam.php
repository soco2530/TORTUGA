<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Colectivo CP.La Tortuga </title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="main.js"></script>
	<link rel="stylesheet" type="text/css" href="css/nosotros.css">
	<link rel="stylesheet" type="text/css" href="css/contacto.css">

	<link href="web_admin/css/estilos.css" rel="stylesheet">
	<script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
		<style></style>
  </head>
  <body>
  <?php 
    session_start();
    if(!isset($_SESSION["usuario"])){
        header("location: loginusu.php");

    }else{

    }

    ?>
     
  
    

    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
         
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
          <li><a href="nosotros.php"><span class="glyphicon glyphicon-modal-window"></span> Quiénes somos</a></li>
			  <li><a href="proyectos.php"><span class="glyphicon glyphicon-modal-window"></span> CLT-CT-Proyectos</a></li>
				
			  <li><a href="index.html"><span class="glyphicon glyphicon-modal-window" ></span> Ayúdanos</a></li>
				
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Testimonios</a></li>
				<li><a href="video.html"><span class="glyphicon glyphicon-modal-window"></span> Galería</a></li>
				<li><a href="contacto.php"><span class="glyphicon glyphicon-modal-window"></span> Contáctanos</a></li>
	
			
              <li><a href="cierrausu.php" ><span class="glyphicon glyphicon-user"></span>Cerrar Sesión</a>
      
          </ul>
          <ul class="nav navbar-nav navbar-right">
          
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
       
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Lo formamos <small> </small></h1>
            <p>Esto es información para usuarios registrados </P> 
          </div>
          <div class="col-md-2">
            <div class="dropdown create">
                <h3><img src="img/LOGOSINFONDO.png" alt="Trulli" width="90" height="80"><h3>
                <div class="dropdown create">
          
          </div>
        
      

        </div>
        <?php

echo "Bienvenido/a  " .$_SESSION["usuario"]."<br><br>";

?>

      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="#"></a>Somos un grupo de hombres y mujeres de la caleta la tortuga. Nos hemos juntado con el 
            fin progresar comunitariamente  desde este rincon del mundo. Nuestro progreso lo visualizamos conviviendo 
            con nuestro ambiente sin destruirlo o contaminarlo y sobretodo mirando un beneficio comunitario que aproveche 
            nuestros recursos en forma sostenida y renovable.</li>
          <li class="active"></li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="index.html" class="list-group-item active color-principal">
                <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Proyectos en proceso
              </a>
              <a href="paginas.html" class="list-group-item"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Ambiente <span class="badge"></span></a>
              <a href="entradas.html" class="list-group-item"><span class="glyphicon glyphicon-certificate" aria-hidden="true"></span> Energía<span class="badge"></span></a>
              <a href="usuarios.html" class="list-group-item"><span class="glyphicon glyphicon-tree-deciduous" aria-hidden="true"></span>Vivero y arbolización<span class="badge"></span></a>
            </div>

            <div class="well">
              <h4>Proceso de Ambientación</h4>
              <div class="progress">
                  <div class="barra-progreso" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
                      40%
              </div>
            </div>

            <h4>Proceso de Energia</h4>
            <div class="progress">
                <div class="barra-progreso" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
                    75%
            </div>
          </div>
          <h4>Proceso de Arbolización y vivero</h4>
          <div class="progress">
              <div class="barra-progreso" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 55%;">
                  55%
          </div>
        </div>

            </div>
          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Ocupación dentro del colectivo</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                      <div class="col-md-12">
                          <input class="form-control" type="text" placeholder="Filtrar comisiones...">
                      </div>
                </div>
                <br>
                <table class="table table-striped table-hover">
                      <tr>
                        <th>Comisión</th>
                        <th>Integrantes</th>
                        <th>Proyectos</th>
                        <th>Actividades</th>
                        <th></th>
                      </tr>

                      <tr>
                        <td>Ambiente</td>
                        <td>Morelia Eche Querevalú, Rosita Alvares Querevalú</span></td>
                        <td>Biodiversidad, Paisajes</td>
                        <td>Inventarios de animales, Identificación de paisajes</td>
                      </tr>
                      <tr>

                        <td>Energia</td>
                        <td>Paula Eche Querevalu, Socorro Querevalú Vite</td>
                        <td>Estaciones Metereologicas,IEC</td>
                        <td>Monitoreo, Programa de radio, Proyecto Viento/Solar</td>
                      </tr>
                      <tr>
                        <td>Desperdicios</td>
                        <td>Diana Antón pazos, Leydi Paz Juarez </td>
                        <td>Reciclaje y compost,Remediación</td>
                        <td>Uso productive de basura, Remediar zonas contaminadas</td>
                      </tr>

                      <tr>
                        <td>vivero y Arbolización</td>
                        <td>Socorro Querevalu Vite </td>
                        <td>Vivero, Arbolización, Huertas Comunitarias</td>
                        <td>vivero comunitario, Arbolización, Mingas</td>
                      </tr>
                      <tr>
                        <td>Turismo Comunitario</td>
                        <td>Omarely Querevalú Panta</td>
                        <td>Albergue Comunitario, Rutas</td>
                        <td>Banos Comunitarios,Hospedaje, Restaurante</td>
                      </tr>
                      <tr>
                        <tr>
                            <td>Taller</td>
                            <td>Victor Querevalú Vite, Omarely Querevalú Panta </td>
                            <td>Taller, Inventario</td>
                            <td>Mecanica y electricidad, Herramientas, Instrumentos</td>
                          </tr>
                          <tr>
                            <td>Coordinador Comunitario</td>
                            <td>Lic.Cesar Augusto Ruiz Nunura</td>
                            <td>proyectos permanente</td>
                            <td> General</td>
                          </tr>
                          

                    </table>
              </div>
              </div>

          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
      <p><a href="nosotros.php">Volver</a></p>
      <p>Colectivo Civico la Tortuga , &copy; 2020</p>
    </footer>

    <!-- Modals -->

    <!-- Agregar página -->
    <div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar Página</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Título de Página</label>
          <input type="text" class="form-control" placeholder="Título de la página">
        </div>
        <div class="form-group">
          <label>Mensaje de Página</label>
          <textarea name="editor1" class="form-control" placeholder="Información de la página"></textarea>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox"> Publicado
          </label>
        </div>
        <div class="form-group">
          <label>Palabras Clave</label>
          <input type="text" class="form-control" placeholder="Agregar algunas palabras...">
        </div>
        <div class="form-group">
          <label>Meta Descripción</label>
          <input type="text" class="form-control" placeholder="Agregar una metadescripción...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
      </div>
    </form>
    </div>
  </div>
</div>

  <script>
     CKEDITOR.replace( 'editor1' );
 </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

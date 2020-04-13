
<?php session_start();

if (isset($_SESSION['usuario'])) {
	header('Location: indexlog.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);

    $telefono = $_POST['telefono'];
    $nombre = $_POST['nombre'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];

	$errores = '';

	if (empty($usuario) or empty($password) or empty($password2) or empty($telefono) or empty($nombre)) {
		$errores .= '<li>Por favor rellena todos los datos</li>';
	} else {
		try {
			$conexion = new PDO('mysql:host=localhost;dbname=tasks-app', 'root', '');
		} catch (PDOExeption $e) {
			echo "Error: " . $e->getMessage();
		}
		$statement = $conexion->prepare('SELECT * FROM colaboradores WHERE usuario = :usuario LIMIT 1');
		$statement->execute(array(':usuario' => $usuario));
		$resultado = $statement->fetch();

		
		if ($resultado != false) {
			$errores .= '<ul>El nombre de usuario ya existe</ul>';
		}
		//HASS DE LA CONTRASEñA (encriptar)
		$password = htmlentities( $password);
		$password2 = htmlentities( $password2);

		if ($password != $password2) {
			$errores .= '<ul>Las contraseñas no son iguales</ul>';
		}
	}
	if ($errores == '') {
		$statement = $conexion->prepare('INSERT INTO colaboradores (idcolaborador, usuario, clave, telefono, nombre) VALUES (null, :usuario, :clave, :telefono, :nombre)');
		$statement->execute(array(':usuario' => $usuario, ':clave' => $password, ':telefono'=> $telefono, ':nombre'=> $nombre ));

		header('Location: formam.php');
	}
}
require 'views/registrate.view.php';
?>

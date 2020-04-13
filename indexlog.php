<?php session_start();

if (isset($_SESSION['usuario'])) {
	header('Location: formam.php');
} else {
	header('Location: registrate.php');
}
?>
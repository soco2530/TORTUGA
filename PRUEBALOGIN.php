<?php 
  try{
$base=new PDO("mysql:host=localhost; dbname=tasks-app", "root","");
$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql="SELECT * FROM colaboradores WHERE nombre= :login AND 	clave= :password";

$resultado=$base->prepare($sql);

$login=htmlentities(addslashes($_POST["login"]));
//$password = hash('sha512', ($_POST["password"]));
$password=htmlentities(addslashes($_POST["password"]));


$resultado->bindValue(":login", $login);
$resultado->bindValue(":password", $password);
//$password = hash('sha512', $password);
$resultado->execute();
$numero_registro=$resultado->rowCount();

if($numero_registro!=0){
 // echo"<h2>Adelante!!</h2>";
 session_start();
 $_SESSION["usuario"]=$_POST["login"];
 header("location:formam.php");

} else{
  header ("location:loginusu.php");
}

  }catch(Exception $e){

    die("Error ". $e->getMessage());
  }
  ?>
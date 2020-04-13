<?php

session_start();

unset($_SESSION["uid"]);

unset($_SESSION["name"]);

header("location:indexP.php");


include "admin/database.php";
$db = new Database();
$con = $db->connect();
mysqli_query($con, "DELETE FROM cart") or die($con->error);;

?>
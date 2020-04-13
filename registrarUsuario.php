<?php
$r_val = file_get_contents("php://input");
$r_data = json_decode($r_val, true);
$dni=$r_data["dni"];
$nombre=$r_data["nombre"];
$apellidos=$r_data["apellidos"];
$telefono=$r_data["telefono"];
$email=$r_data["email"];
$clave=$r_data["clave"];
require_once 'conexion.php';
$sql1 = "SELECT * FROM colaboradores WHERE email = '$email' LIMIT 1" ;
$check_query = mysqli_query($con,$sql1);
$count_email = mysqli_num_rows($check_query);
if($count_email > 0){
    $result["success"] =  "2";
    $result["message"] = "Ya existe usuario";
    echo json_encode($result);
    exit();
}else{
    $clave = password_hash($clave, PASSWORD_DEFAULT);
    $sql = "INSERT INTO colaboradores (dni, nombre,apellidos,telefono,email,clave,fecharegistro) VALUES ('$dni', '$nombre', '$apellidos',
    '$telefono','$email','$clave', NOW())";
    if ( mysqli_query($con, $sql) ) {
        $result["success"] =  "1";
        $result["message"] = "Se registro correctamente el usuario";
        echo json_encode($result);
        mysqli_close($con);
    } else {
        $result["success"] = "0";
        $result["message"] = "Error en la creacion de usuario";
        echo json_encode($result);
        mysqli_close($con);
    }
}
?>
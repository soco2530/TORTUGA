<?php
include('database.php');

if(isset($_POST['name'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $query = "INSERT into task(name, description) VALUES ('$name', '$description')";
    $resultg = mysqli_query($connection, $query);
    if(!$resultg){
        die('Query failed.');

    }
    echo'task added Successfully';

}
?>
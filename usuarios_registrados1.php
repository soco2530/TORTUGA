
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colectivo|la Tortuga</title>

</head>
<body>

    <?php 
    session_start();
    if(!isset($_SESSION["usuario"])){
        header("location:loginp.php");

    }else{

    }

    ?>
    <h1>bienvedidos </h1>
    <?php

    echo "Hola " .$_SESSION["usuario"]."<br><br>";

    ?>
    <p>ESTO ES INFORMACION PARA USUARIOS REGISTRADOS </P>
    
</body>
</html>
<html>

<head>
    <title>B4.-Detalles de administradores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">

    <?php
    require "conecta.php";

    $id = $_GET["id"];
    $sql = "SELECT * FROM productos WHERE id = '$id'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);
    
    ?>

</head>

<body>
<?php
    require("sesion.php");
    if($estado)
       {   
?><!--Inicio de If para validar sesion activa-->

    <div class="nav-bg">
        <nav class="navegacion-principal contenedor">
            <a href="../Front/Bienvenido.php">Inicio</a>
            <a href="B1.-Listadmins.php">Administradores</a>
            <a href="Lista_productos.php">Productos</a>
           <!-- <a href="B3.-Alta.php">Alta de administradores</a>
            <a href="B5.-Editar.php?id=<?= $_SESSION['id'] ?>">Edición de administrador</a> 
            <a href="B4.-Detalles.php?id=<?=$_SESSION['id']?>">Detalles de administrador</a> Se manda el parametro del id para que muestre la información usuario que inicio sesión-->
        </nav>
    </div>
    <a href="../Front/Lista_productos.php"><input class="boton regre" type="button" value="Regresar"></a>
    <div class="tarjeta">
        <div class="card-body">
            <img height="200" src="../img/<?= $row['archivo_n'] ?>">
            <h1 class="card-title">Nombre: <?= $row['nombre'] ?> Código:<?= $row['codigo'] ?></h1>
            <p class="card-text">Descripción: <?= $row['descripcion'] ?></p>
            <p class="card-text">Costo: $<?= $row['costo'] ?></p>
            <p class="card-text">Stock: <?= $row['stock'] ?></p>
            <a href="../Front/Lista_productos.php" class="boton">Lista de Productos</a>
        </div>
    </div>
    <?php
            }//if sesion
            else{
            $estado = true;
                header ("location:Bienvenido.php");
            }
    ?><!--Fin del if para validar que no se ha iniciado sesion-->
</body>

</html>
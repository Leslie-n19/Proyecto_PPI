<html>

<head>
    <title>B4.-Detalles de administradores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">

    <?php
    require "../Back/conecta.php";

    $id = $_GET["id"];
    $sql = "SELECT * FROM administradores WHERE id = '$id'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);
    $rol = $row['rol'];
    $estatus = $row['estatus'];
    ?>

</head>

<body>

    <div class="nav-bg">
        <nav class="navegacion-principal contenedor">
            <a href="Bienvenido.php">Inicio</a>
            <a href="B1.-Listadmins.php">Lista de administradores</a>
            <a href="B3.-Alta.php">Alta de administradores</a>
            <a href="B5.-Editar.php">Edición de administradores</a> 
            <a href="B4.-Detalles.php">Detalles de administradores</a> 
        </nav>
    </div>

    <div class="tarjeta">
        <div class="card-body">
            <img height="200" src="../img/<?= $row['archivo_n'] ?>">
            <h1 class="card-title">Nombre: <?= $row['nombre'] ?> <?= $row['apellidos'] ?></h1>
            <p class="card-text">Correo: <?= $row['correo'] ?></p>
            <p class="card-text">Rol: <?php
                                        if ($rol == 1) {
                                            echo 'Administrador';
                                        } else {
                                            echo 'Ejecutivo';
                                        }
                                        ?></p>
            <p class="card-text">Estatus: <?php
                                            if ($estatus == 1) {
                                                echo 'Activo';
                                            } else {
                                                echo 'Inactivo';
                                            }
                                            ?></p>
            <a href="B1.-Listadmins.php" class="boton">Lista de administradores</a>
            <a href="B1.-Listadmins.php"><input class="boton regre" type="button" value="Regresar" />
        </div>
    </div>
</body>

</html>
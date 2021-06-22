<html>
<head>
    <title>Bienvenida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body>

<?php
    session_start();
?>

    <div class="nav-bg">
        <nav class="navegacion-principal contenedor">
            <a href="Bienvenido.php">Inicio</a>
            <a href="B1.-Listadmins.php">Lista de administradores</a>
            <a href="B3.-Alta.php">Alta de administradores</a>
            <a href="B5.-Editar.php?id=<?= $_SESSION['id'] ?>">Edición de administrador</a> 
            <a href="B4.-Detalles.php?id=<?=$_SESSION['id']?>">Detalles de administrador</a> <!--Se manda el parametro del id para que muestre la información usuario que inicio sesión-->
        </nav>
    </div>
    
        <div class="card-body bienvenida">
            <h1>Hola y bienvenid@</h1>
            <?php
                $estado = false;

                if(isset($_SESSION['nombre']))
                {
                    $estado = true;
                    echo "<h2>", $_SESSION['nombre'], "</h2>";
                }
                else{
                $estado = false;
                    header ("location:../index.php");
                }
                ?>
            <div class="menu">
            <a href="B1.-Listadmins.php"><input class="botonwel" type="button" value="Lista de administradores" />
            <br>
            <br>
            <a href="B3.-Alta.php"><input class="botonwel" type="button" value="Crear administradores" />
            <br><br><br><br>
            <a class="cerrar" href="../Back/cerrarSesion.php">Cerrar sesión</a>
            </div>
            
        </div>
</body>
</html>
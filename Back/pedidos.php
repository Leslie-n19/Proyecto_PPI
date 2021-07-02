<html >
<head>
    <title>Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body>
<?php
    require("../funciones/sesion.php");
    if($estado)
       {   
?><!--Inicio de If para validar sesion activa-->
 <div class="nav-bg">
        <nav class="navegacion-principal contenedor">
            <a href="Bienvenido.php">Inicio</a>
            <a href="Listadmins.php">Administradores</a>
            <a href="Lista_productos.php">Productos</a>
            <a href="banners.php">Banners</a>
            <a href="pedidos.php">Pedidos</a>
            <a href="../funciones/cerrarSesion.php">Cerrar Sesion</a>
           <!-- <a href="B3.-Alta.php">Alta de administradores</a>
            <a href="B5.-Editar.php?id=<?= $_SESSION['id'] ?>">Edición de administrador</a> 
            <a href="B4.-Detalles.php?id=<?=$_SESSION['id']?>">Detalles de administrador</a> Se manda el parametro del id para que muestre la información usuario que inicio sesión-->
        </nav>
    </div>

    <?php
    require "../funciones/conecta.php";
    /*$conexion=conexion();*/
    $sql = "SELECT * FROM pedidos WHERE estatus=1";
    $res = mysqli_query($con, $sql);
    $num = mysqli_num_rows($res);
    ?>
    <div class="tabla">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="titulo">Listado de Pedidos</h5>
            </div>
        </div>

        <table class="table">
            <thead class="encabezado">
                <tr id="gila1">
                    <!-- Mi fila, le asigno un id, (el valor [attr]) -->
                    <td>
                        ID
                    </td>
                    <td class="celda">
                        Fecha
                    </td>
                    <td class="celda">
                        Usuario
                    </td>
                    <td class="celda">Detalles</td>
                </tr>
            </thead>
        </table>
    </div>
    <?php
    for ($i = $num; $objeto = $res->fetch_object(); $i++) {
    ?>
        <div class="tabla">
            <table class="table" class="List">
                <!-- Parent (PAPA)-->
                <tbody>
                    <tr id="<?= $objeto->id ?>">
                        <!-- Mi fila, le asigno un id, (el valor [attr]) -->
                        <td class="celdaid">
                            <?= $objeto->id ?>
                        </td>
                        <!--<td>
                            <img height="50" src="../img/<?= $objeto->archivo_n ?>">
                        </td>-->
                        <td>
                            <?= $objeto->fecha ?>
                        </td>
                        <td>
                            <?= $objeto->usuario ?>
                        </td>
                        <td><a href="Detalles_Pedidos.php?id=<?= $objeto->id ?>"><input class="boton" type="button" value="detalles" /><br></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php
    }
    ?>

            <?php
                }//if sesion
                else{
                $estado = true;
                    header ("location:Bienvenido.php");
                }
            ?><!--Fin del if para validar que no se ha iniciado sesion-->
   
</body>
</html>
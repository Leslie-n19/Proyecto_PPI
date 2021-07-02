<html>

<head>
    <title>B4.-Detalles de administradores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">

    <?php
    require "../funciones/conecta.php";

    $id = $_GET["id"];
    
    ?>

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

        </nav>
    </div>
    <a href="pedidos.php"><input class="boton regre" type="button" value="Regresar"></a>
    <div class="tarjeta">
        <div class="card-body">

            <?php
            $sql = "SELECT * FROM detalle_venta WHERE id_pedido = '$id'";
            $res = mysqli_query($con, $sql);
            $num = mysqli_num_rows($res);
            $suma = 0;
            $cantidad_productos = 0;
                for ($i = $num; $objeto = $res->fetch_object(); $i++) {
            ?>


                    <td class="celdaid">
                            ID: <?= $objeto->id ?>
                            <br>
                            ID_PRODUCTO: <?= $objeto->id_producto ?>
                            <br>
                            CANTIDAD: <?= $objeto->cantidad ?>
                            <br>
                            PRECIO: <?= $objeto->precio ?>
                            <?php
                             $cantidad_productos += $objeto->cantidad; 
                             $suma += $objeto->precio;
                            ?>
                            <br>
                            <br><br>
            <?php
                }
                echo "-------------------------------";
                echo "Cantidad de productos:", $cantidad_productos;
                echo "\n";
                echo "SubTotal:", $suma;
                echo "\n";
                ?>
                <br>
                <br>
                <?php
                echo "+ 16% de iva: ", $suma += $suma * .16;
                ?>
                <br>
                <br>
            <a href="pedidos.php" class="boton">Lista de pedidos</a>
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
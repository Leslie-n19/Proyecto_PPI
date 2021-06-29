<html>
<head>
    <title>Banners</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <script>
            function recibe() {
                var nam = document.forma1.nombre.value;
                var file = document.forma1.archivo.value;


                if (nam == "" || file == "") {
                    alert("Datos Incompletos")
                    return false;
                } else
                    return true;

            }

            $(document).ready(function () {
                $("#boton").on('click', function () {
                    if (recibe()) {
                        var form = $('#forma1')[0];
                        var data = new FormData(form);

                        $.ajax({
                            url: '../funciones/crear_banner.php',
                            type: 'POST',
                            dataType: 'text',
                            data: data,
                            enctype: 'multipart/form-data',
                            processData: false,
                            contentType: false,
                            cache: false,
                            success: function (res) {
                                if (res == 0) {
                                    alert('Banner agregado');
                                } else {
                                    location.href = "../Front/Bienvenido.php";
                                }
                            }
                        });
                    } ///Termina if confirm ()

                });
            });
        </script>
</head>
<body>
<?php
    require("../Back/sesion.php");
    if($estado)
       {   
?>
    <div class="nav-bg">
        <nav class="navegacion-principal contenedor">
            <a href="../Front/Bienvenido.php">Inicio</a>
            <a href="B1.-Listadmins.php">Administradores</a>
            <a href="Lista_productos.php">Productos</a>
            <a href="banners.php">Banners</a>
            <a href="#">Pedidos</a>
            <a href="cerrarSesion.php">Cerrar Sesion</a>
           <!-- <a href="B3.-Alta.php">Alta de administradores</a>
            <a href="B5.-Editar.php?id=<?= $_SESSION['id'] ?>">Edición de administrador</a> 
            <a href="B4.-Detalles.php?id=<?=$_SESSION['id']?>">Detalles de administrador</a> Se manda el parametro del id para que muestre la información usuario que inicio sesión-->
        </nav>
    </div>
<a href="../Front/Lista_productos.php"><input class="boton regre" type="button" value="Regresar"> </a>
    <div class="forma">
        <form id="forma1" name="forma1" class="row g-3" action="../Funciones/crear_banner.php" enctype="multipart/form-data">
        <div class="row g-3">
                <legend>Alta de banners</legend>
                <div class="col">
                    <label for="inputEmail4" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre del libro">
                </div>
        </div>
                <input type="file" id="archivo" name="archivo">
                <br><br>
            </label>
            <br>
            <div class="col-12">
                <input id="boton" class="boton" type="button" value="Registrar">
            </div>
        </form>
    </div>
        <?php
                }//if sesion
                else{
                $estado = false;
                    header ("location:../index.php");
                }
                ?>
</body>
</html>
<html>

<head>
    <title>B1.-Lista administradores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


    <script>
        $(document).ready(function() { //mi ARCHIVO (pagina) esta correcto
            $('.boton1').click(function() { // de hacer click en un componente con clase boton (."nombre")
                var fila = $(this).parent().parent().attr("id");
                // variable fila = lo que hay en pagina -> TABLA -> FILA 
                if (confirm('Borrar registro Num: ' + fila + '?')) {
                    $(this).parent().parent().fadeOut(); /// es la animacion para hacer desaparecer algo

                    $.ajax({
                        url: '../Back/B2.-Eliminar.php', /// a donde lo vas a mandar
                        type: 'post', /// voy a enviar algo
                        dataType: 'text', /// voy a mandar texto lineal 
                        data: 'id=' + fila, // atributo que vas a mandar +su valor 
                        success: function(res) { /// funcion para recibir una respuesta del back hemos enviado id=2
                            if (res == 0) {
                                alert('Error para eliminar');
                            } else {
                                alert('Registro eliminado');
                            }
                        },
                        error: function() {
                            alert('No se puede conectar al servidor');
                        }
                    }); ///Termina ajax ()
                } ///Termina if confirm ()
            });
        });
    </script>
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

    <?php
    require "../Back/conecta.php";
    /*$conexion=conexion();*/
    $sql = "SELECT * FROM administradores WHERE eliminado=0";
    $res = mysqli_query($con, $sql);
    $num = mysqli_num_rows($res);
    ?>
    <div class="tabla">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="titulo">Listado de Administradores</h5>
                <a href="B3.-Alta.php" target="black" class=".registro">Crear nuevo registro</a>
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
                        Nombre
                    </td>
                    <td class="celda">
                        Rol
                    </td>
                    <td class="celda">Eliminar</td>
                    <td class="celda">Detalles</td>
                    <td class="celda">Editar</td>
                </tr>
            </thead>
        </table>
    </div>
    <?php
    for ($i = $num; $objeto = $res->fetch_object(); $i++) {
        $roll = ($objeto->rol == 1) ? 'Administrador' : 'Ejecutivo';
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
                            <?= $objeto->nombre ?>
                        </td>
                        <td>
                            <?= $roll ?>
                        </td>
                        <td><input class="boton1 delete" id="eliminar" type="button" value="eliminar" /><br></td>
                        <td><a href="B4.-Detalles.php?id=<?= $objeto->id ?>"><input class="boton" type="button" value="detalles" /><br></td>
                        <td><a href="B5.-Editar.php?id=<?= $objeto->id ?>"><input class="boton" type="button" value="editar" /><br></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php
    }
    ?>
</body>

</html>
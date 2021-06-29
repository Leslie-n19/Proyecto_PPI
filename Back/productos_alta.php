<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        function recibe() { ///Función para verificar que todos los campos esten llenos o vacíos
            var name = document.forma1.nombre.value;
            var codigo = document.forma1.codigo.value;
            var descripcion = document.forma1.descripcion.value;
            var costo = document.forma1.costo.value;
            var stock = document.forma1.stock.value;
            var archivo = document.forma1.archivo.value;
            if (name == "" || codigo == "" || descripcion == "" || costo == "" || stock == "0" || archivo == "") {
                return false;
            } else
                return true;
        }

        function existe(r) {
            if (r == 2) {
                //alert("Este usuario ya existe, prueba con otro :)");
                $("h5").show("slow"); //Si es incorrecta mostrara un elemento <p>
                var codigo = document.forma1.codigo.value;
                $('h5').text(codigo + ' ya existe')
                $("h5").hide(5000); //despues lo escondera

                //$( "h5" ).show( "slow" ); //Si es incorrecta mostrara un elemento <p>
                //$( "h5" ).fadeToggle( 5000 );   //despues lo escondera
            } else {
                return false;
            }
        }
        $(document).ready(function() {
            $("#boton").on('click', function() {
                if (recibe()) {
                    var form = $('#forma1')[0];
                    var data = new FormData(form);
                    $.ajax({
                        url: 'alta_productos.php',
                        type: 'POST',
                        dataType: 'text',
                        data: data,
                        enctype: 'multipart/form-data',
                        processData: false,
                        contentType: false,
                        cache: false,
                        success: function(res) {
                            if (res == 0) {
                                alert('No registro');
                            }
                            if (res == 1) {
                                location.href = "../Front/Lista_productos.php";
                            }
                            if (res == 2) {
                                existe(res);
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
?><!--Inici de If para validar sesion activa-->

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
    <a href="../Front/Lista_productos.php"><input class="boton regre" type="button" value="Regresar"> </a>
    <div class="forma">
        <form id="forma1" name="forma1" class="row g-3" action="../Back/alta.php" enctype="multipart/form-data">
            <div class="row g-3">
                <legend>Alta de productos</legend>
                <div class="col">
                    <label for="inputEmail4" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre del libro">
                </div>
                <div class="col">
                    <label for="inputEmail4" class="form-label">Código</label>
                    <input type="text" name="codigo" class="form-control" placeholder="Codigo del libro">
                    <div>
                        <h5 style="display: none" id='heading'> </h5>
                    </div>
                </div>
            </div>
            <div class="col-md-11">
                <label for="inputEmail4" class="form-label">Descripcion</label>
                <p><textarea name="descripcion" placeholder="Reseña" class="form-control" id="descripcion"></textarea></p>
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Costo</label>
                <label>$</label><input type="text" name="costo" class="form-control" id="costo">
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Stock</label>
                <input type="text" name="stock" class="form-control" id="stock" >
            </div>
            <div class="col-md-4">
                <input type="file" id="archivo" name="archivo" required>
            </div>
            <br><br>
            <div class="col-12">
                <input id="boton" class="boton" type="button" value="Registrar">
                
            </div>
        </form>
        <div>
            <p style="display: none">Faltan datos por llenar</p> <!--DIV oculto que se muestra cuando faltan campos por llenar-->
        </div>
    </div>
    
    <script>
        $("#boton").click(function() { /// Cuando se haga click en el elemento con id buton se iniciara una funcion
            if (!recibe()) { //Dentro de la funcion validara si la funcion recibe es incorrecta
                $("p").show("slow"); //Si es incorrecta mostrara un elemento <p>
                $("p").hide(5000); //despues lo escondera
            }
        });
    </script>

            <?php
                }//if sesion
                else{
                $estado = true;
                    header ("location:Bienvenido.php");
                }
            ?><!--Fin del if para validar que no se ha iniciado sesion-->

</body>

</html>
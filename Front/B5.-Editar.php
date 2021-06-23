<html>

<head>
    <title>B3.-Edición de administradores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        function recibe() {
            var name = document.forma1.nombre.value;
            var apellidos = document.forma1.apellido.value;
            var contra = document.forma1.contraseña.value;
            var mail = document.forma1.correo.value;
            var rol = document.forma1.rol.value;
            
            

            if (name == "") {
                return false;
            } else
                return true;
        }

        function existe(r) {
            if (r == 2) {
                //alert("Este usuario ya existe, prueba con otro :)");
                $("h5").show("slow"); //Si es incorrecta mostrara un elemento <p>
                var name = document.forma1.correo.value;
                $('h5').text(name + ' ya existe')
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
                        url: '../Back/editar.php',
                        type: 'POST',
                        dataType: 'text',
                        data: data,
                        enctype: 'multipart/form-data',
                        processData: false,
                        contentType: false,
                        cache: false,
                        success: function(res) {
                            if (res == 0) {
                                alert('No se edito');
                            }
                            if (res == 1) {
                                alert("Edicion completada");
                                location.href = "B1.-Listadmins.php";
                            }
                            if (res == 2) {
                                existe(res);
                                alert('Ya existe');
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
            <a href="Bienvenido.php">Inicio</a>
            <a href="B1.-Listadmins.php">Lista de administradores</a>
            <a href="B3.-Alta.php">Alta de administradores</a>
            <a href="B5.-Editar.php?id=<?= $_SESSION['id'] ?>">Edición de administrador</a> 
            <a href="B4.-Detalles.php?id=<?=$_SESSION['id']?>">Detalles de administrador</a> <!--Se manda el parametro del id para que muestre la información usuario que inicio sesión-->
        </nav>
    </div>
    <a href="B1.-Listadmins.php"><input class="boton regre" type="button" value="Regresar"></a>

    <?php
        require "../Back/conecta.php";

        $id = $_GET["id"]; ///Se toma el ID, que viene del boton(ya sea en la lista de administradores o en el menú )
        $sql = "SELECT * FROM administradores WHERE id = '$id'";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($res);
        $rol = $row['rol'];
    ?>

    <div class="forma edicion">
    
                    <form id="forma1" name="forma1" class="row g-3" enctype="multipart/form-data">
                    <div class="row g-3">
                        <legend>Edición de administradores</legend>
                        <div class="col">
                            <input type="text" name="id" style="display:none" value="<?= $row['id']; ?>">
                            <label for="inputEmail4" class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="<?= $row['nombre']; ?>">
                        </div>
                        <div class="col">
                            <label for="inputEmail4" class="form-label">Apellidos</label>
                            <input type="text" name="apellido" class="form-control" value="<?= $row['apellidos']; ?>">
                        </div>
                    </div>
                    <div class="col-md-11">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="text" name="correo" value="<?= $row['correo']; ?>" class="form-control" id="correo">
                        <div>
                            <h5 style="display: none" id='heading'> </h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Password</label>
                        <input type="password" name="contraseña" class="form-control" id="inputPassword4" value=<?=$row['pass'];?> >
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Selecciona rol</label>
                        <select name="rol" id="rol" id="inputState" class="form-select">
                            <option value="0"> <?php
                                                if ($rol == 1) {
                                                    echo 'Administrador';
                                                } else {
                                                    echo 'Ejecutivo';
                                                }
                                                ?></p>
                            </option>
                            <option value="1">Administrador</option>
                            <option value="2">Ejecutivo</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <img height="200" src="../img/<?= $row['archivo_n'] ?>">
                        Editar imagen:<input type="file" id="archivo" name="archivo" required>
                    </div>
                    <br><br>
                    <div class="col-12">
                        <input id="boton" class="boton" type="button" value="Editar">
                    </div>
                </form>
                <div>
                    <p style="display: none">Faltan datos por llenar</p>
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
                $estado = false;
                    header ("location:../index.php");
                }
                ?>
       
</body>

</html>
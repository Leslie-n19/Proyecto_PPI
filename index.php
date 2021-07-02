<html>
        <head>
            <style type="text/css"> </style>
            <title>Index</title>
            <script src="js/jquery-3.3.1.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    
            <link rel="stylesheet" href="css/styles.css">
            
            
       <script>
        function recibe() {
            var mail = document.forma1.correo.value;
            var contra = document.forma1.pass.value;
            if (mail == "" || contra == "")
                {
                    //alert("Datos Incompletos")
                    return false;
                }

            else
                return true;
        }

        $(document).ready(function() {
            $("#boton").on('click', function() {
                if (recibe()) {
                    var form = $('#forma1')[0];
                    var data = new FormData(form);

                    $.ajax({
                        url: 'funciones/login.php',
                        type: 'POST',
                        dataType: 'text',
                        data: data,
                        enctype: 'multipart/form-data',
                        processData: false,
                        contentType: false,
                        cache: false,
                        success: function(res) {
                            if (res == 0) 
                            {
                                //alert('No existe el registro');
                                $("h5").show("slow"); //Si es incorrecta mostrara un elemento <p>
                                var name = document.forma1.correo.value;
                                $('h5').text(name + ' no existe')
                                $("h5").hide(5000); //despues lo escondera
                            } 
                            else 
                            { 
                                location.href="Back/Bienvenido.php";   
                            }
                        }
                            });
                        }
                    });
                });

            </script>
            
        </head>
        <body>
        <?php
            require("./funciones/sesion.php");
            if($estado==false)
            {   
        ?>
            <form id="forma1" name="forma1" method="POST" class="form-login">
            <!--<h2>Iniciar Sesión</h2-->
            <h1><a class="inicio">Iniciar</a> <a class="sesion">sesión</a></h1>
            <!--p>Dirección de Correo:<br-->
            <a class="titulo">Correo</a>
            <input type="text" name="correo" class="controls" placeholder="Ingresa correo">
            <a class="titulo">Contraseña</a>
            <input type="password" name="pass"  class="controls" placeholder="Ingresa contraseña">
            <input onclick="recibe()" id="boton" class="boton" type="button" value="Enviar">

            <div>
                <p style="display: none">Faltan datos por llenar</p>
            </div>

            <div>
                <h5 style="display: none" id='heading'> </h5>
            </div>
            </form>
            
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
                    header ("location:./Back/Bienvenido.php");
                }
            ?>
        </body>
</html>

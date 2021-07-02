<html>

<head>
    <title>Bienvenido</title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


    <script>
        $(document).ready(function() {
            $('.boton').click(function() {
                var fila = $(this).parent().parent().attr("id");
                var name = $(this).attr("id");
                var value = $(this).parent().attr("id");
                if (confirm('Borrar registro Num: ' + fila + '?')) {
                    $.ajax({
                        url: 'nuevo_pedido.php',
                        type: 'post',
                        dataType: 'text',
                        data: {
                            id: fila,
                            name: name,
                            valor: value
                        },
                        success: function(res) {
                            if (res == 0) {
                                alert('Error para agregar al carrito');
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

    <style>
        .padre {
            text-align: center;
        }

        .price {
            text-align: center;
            color: blue;
        }

        .hijo {

            display: inline-block;
            text-align: center;
            padding-left: 200;
        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: rgb(0, 0, 255);
            color: white;
            text-align: center;
        }

    </style>


</head>

<body>

<?php
    require("../funciones/sesion.php");
    if($estado)
       {   
?>

        <h1>index</h1>
    <br>
    <ul class="menu">
        <li> <a href="index.php">Home</a></li>
        <li> <a href="productos.php">Productos</a></li>
        <li> <a href="contacto.php">Contacto</a></li>
        <li> <a href="carrito.php">Carrito</a></li>
    </ul>
    <br>
    <br>
    <br>

    <?php
            $a=rand(1,10);
            require "../funciones/conecta.php";
            $sql = "SELECT *
                    FROM  productos";

            $res = mysqli_query($con, $sql);
            $num = mysqli_num_rows($res);
    
            echo "<h2>", $_SESSION['nombre'], "</h2>";
            for ($i = $num; $objeto = $res->fetch_object() ;)
            {
            ?>
    <table class="List">
        <tr id="<?= $objeto->id?> ">
            <td><img width="100" src="../img/<?= $objeto->file ?>"> </td>
            <td>
                <?= $objeto->nombre ?>
            </td>
            <td>
                $ <?= $objeto->costo ?>

            </td>

            <td id="<?= $objeto->costo ?>"><input id=" <?= $objeto->nombre ?>" class="boton" type="button" value="Comprar" /><br></td>
        </tr>
    </table>
    <?php 
            }
        ?>


        <br><br><br><br><br><br><br>
    <div class="footer">
        <p>Derechos reservados | términos y condiciones | @betohurtado48</p>
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
<?php
    require "conecta.php";

    $id = $_POST["id"]; // 2
    /// varible id = $_POST alguien envio ["esto"]
    /// $id = 2

    $sql = "UPDATE administradores Set eliminado = 1 Where id = $id";
    $res = mysqli_query($con,$sql);
    // si la conexion a la bd y el comando son correcto
    /// arrojara un resultado positivo

    /// $respuesta = 1 o true 
    if ($res) // si esta variable es correcta
        echo 1;
    else /// si tiene un false, (si existio una falla) 
        echo 0;
?>
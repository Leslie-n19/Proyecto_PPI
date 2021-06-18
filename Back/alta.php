<?php
require "conecta.php";
///Recibe Variables

$file_name = $_FILES['archivo']['name'];	//Nombre real del archivo
$file_tmp  = $_FILES['archivo']['tmp_name'];//Nombre temporal del archivo
$cadena    = explode(".", $file_name);		//Separa el nombre para obtener la extension
$ext       = $cadena[1];					//Extension
$dir       = "../img/";					//carpeta donde se guardan los archivos
$file_enc  = md5_file($file_tmp);			//Nombre del archivo encriptado
$name      = $_POST['nombre'];
$secName   = $_POST['apellido'];
$mail   = $_POST['correo'];
$pass   = $_POST['contraseña'];
$rol   = $_POST['rol'];

$contra = md5($pass);   
$fileName1  = "$file_enc.$ext";	
///------------------------ Declaracion de variables ---------------------------

/// Como es la declaracion de la variable
/// se pueden poner otras variables
function Repetido($correo,$conexion){
    $sql="SELECT * FROM administradores WHERE correo ='$correo' ";
    $resultado = mysqli_query($conexion,$sql);
    if(mysqli_num_rows($resultado) > 0){
        return 1;
		
    }else {
        return 0;
    }
}

if(Repetido($mail,$con)==1){
    echo 2;
}else {
    ///---- Inserción a base de datos--------
    $sql = "INSERT INTO administradores VALUES (0,'$name','$secName','$mail','$contra','$rol','$fileName1','$file_name','0','0')";
    ///--------- Resultado de la funcion de inserción
    $res = mysqli_query($con, $sql);

    /// --------- Si el nobre del archivo creado es diferente a nada 
    if ($file_name != '') {
        $fileName1  = "$file_enc.$ext";	// se copia el nombre con la extension
        @copy($file_tmp, $dir.$fileName1);	
        /// se copia la imagen dentro de la carpeta con el nombre creado
    }
    if ($res)
        echo 1;
    else 
        echo 0;

}
?>
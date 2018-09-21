<?php
function abrir_conexion() {
    // Credenciales de la base de datos 
    $servername = "localhost";//Servidor de la base de datos
    $username = "root";//Nombre de usuario
    $password = "01049595";//Contraseña
    //Nombre de la base de datos
    $dbname = "paypal";
    try {
        global $con;
        // Abrir la conexion usando PDO.
        $con = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Estable el modeo de errores usadndo  excepciones PDO
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die($e->getMessage());//Imprime el mensaje de error en pantalla
    }
}
function cerrar_conexion() {
    global $con;
    $con = null;
}
?>
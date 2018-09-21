<?php
function abrir_conexion() {
    // Credenciales de la base de datos 
    $servername = "192.168.0.30";//Servidor de la base de datos
    $username = "floreria";//Nombre de usuario
    $password = "1234";//Contraseña
    //Nombre de la base de datos
    $dbname = "floreria";
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
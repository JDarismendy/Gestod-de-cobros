<?php
/* Conectar a una base de datos de MySQL invocando al controlador */
$dsn = 'mysql:dbname=webloans-sfw;host=127.0.0.1';
$usuario = 'root';
$contraseña = '';
try {
    $con = new PDO($dsn, $usuario, $contraseña);
   echo " <br> " ;
} catch (PDOException $e) {
    echo 'Falló la conexión: ' . $e->getMessage();
};

?>
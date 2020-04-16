<?php

if (!isset($_SESSION['rol'])) {
  header('location: ..\index.php');
}
else{
  if ($_SESSION['rol'] != 1 && ) {
    header('location: ..\index.php');
  }
}

include('..\conexion\db.php');
include('..\login\mcript.php');

if (isset($_POST['btnGuardar'])) {

$rol = $_POST['rol'];
$nombre = $_POST['nombre'];
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
$cedula = $_POST['cedula'];
$telefono = $_POST['telefono'];
//$pass = aes_encrypt('daniel','AES');
$clave_cifrada = $cifrar($clave);
echo $rol,"<br>", $nombre,"<br>", $usuario,"<br>", $clave,"<br>", $cedula,"<br>",$telefono, "<br>",$clave_cifrada, "<br>";

//$insertar = $con->prepare("INSERT INTO Usuario(id, usuario, clave) VALUES ('','$usuario','$clave_cifrada')");
  $consulta = $con->prepare("INSERT INTO usuario(VALUES (NULL,1,'DANIEL','Darismendy',$clave_cifrada','123456789','3013408765',CURRENT_DATE)");


              if($consulta->execute()){    ?>

                <script>   alert("¡Listo, Usuario Registrado!"); 
                <?php //echo "window.location = '../vistas/clientes.php' ";?></script>
                <?php 
                 }else{
                     ?>
                <script>   alert("¡Algo esta mal!"); </script>
                     <?php
              } 

    }


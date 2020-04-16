<?php 
session_start();
if (!isset($_SESSION['rol'])) {
  header('location: ..\index.php');
}
else{
  if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2 ) {
    header('location: ..\index.php');
  }
}
include("..\conexion\db.php");
 include('..\estilo\menu.html'); 
include('..\estilo\estilo.html');
 ?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
  </head> 
  <body>
  <p></p>
  <div id="prest">
  <div class="left">
  <form method="POST" action="mostrar_prestamos.php">
    <div align="center">
    <input style="width:120" name="mostrar_prestamos" type="image" src="..\imagen\lista.jpg">
    <h2 class="item">Mostrar listado de prestamos</h2>
    <br>
    <br><br>
    </div>
  </form>
  <form method="POST" action="agregar_cuota.php">
    <div  align="center">
    <input style="width: 120" name="agg_cuota" type="image" src="..\imagen\cuota.png">
    <h2 class="item">Agregar cuota nueva</h2>
    <br>
    <br><br>
    </div>
  </form>
  </div>
  <div class="right">
  <form method="POST" action="ingresar_prestamo.php">
    <div  align="center">
    <input style="width: 120" name="agg_prestamos" type="image" src="..\imagen\nuevo.png">
    <h2 class="item">Agregar un nuevo prestamo</h2>
    <br>
    </div>
  </form>
  <br>
  <form method="POST" action="..\accion\cartera.php">
   
    <div  align="center">
    <input style="width: 140px" name="agg_prestamos" type="image" src="..\imagen\crt.png">
    <h2 class="item">Estado de cartera</h2>
    <br>
    <br>
    </div>
  </form>
  </div>
  </div>
  </body>

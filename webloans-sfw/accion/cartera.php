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

include('..\estilo\menu.html');
include('..\estilo\estilo.html'); ?>

<div id="barra">
<h2 class="titulo">AQUI SE VAN A MOSTRAR LOS DATOS DE LA CARTERA</h2>
</div>
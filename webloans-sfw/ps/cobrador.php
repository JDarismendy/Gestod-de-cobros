<?php 
session_start();
if (!isset($_SESSION['rol'])) {
	header('location: ..\index.php');
}
else{
	if ($_SESSION['rol'] != 2) {
		header('location: ..\index.php');
	}
}
include("..\conexion\db.php"); 
include('..\estilo\menu.html');
include('..\estilo\estilo.html');

 ?>
<style>    
 body{
}
.bienvenido{
color: red;
text-align: center;
font-weight: bold;
font-size: 50pt;
}
</style>

<BODY>
	<div class='bienvenido'>"BIENVENIDO , ERES COBRADOR"</div>
</BODY>
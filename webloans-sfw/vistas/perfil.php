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

if ($_SESSION['rol']==1) {
  $rl = "ADMINISTRADOR";
	# code...
}else{
	$rl = "COBRADOR";
}  
 ?>


<div id="general">

<div id="barra" >
  <h2 class="titulo">PERFIL DE USUARIO</h2>
</div>
<div id="datos">
  <div class="left" id="logo">
    <input width="200" height="200" name="icon_user" type="image" src="..\imagen\icon_user.png">
  </div>
  <div class="right" id="informacion">
    <label class="item" ><?php echo $_SESSION['nom'] ?> </label><br>
    <label class="item"><?php echo "C.C: ",$_SESSION['ced'] ?>  </label><br>
     <label class="item"><?php echo "Rol: ",$rl ?>  </label><br>
    <label class="item"><?php echo "Cel: ",$_SESSION['tel'] ?>  </label><br>
    <label class="item"><?php echo "Fec: ",$_SESSION['fec'] ?>  </label><br>
    
  </div>
  <br>
</div>

<div id="barra">
  <h2 class="titulo">CARGO:<?php echo " ", "$rl"; ?> </h2>
</div>

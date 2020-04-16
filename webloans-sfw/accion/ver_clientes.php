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

include('..\conexion\db.php');

include('..\estilo\menu.html');

include('..\estilo\estilo.html');



if (isset($_GET['nc'])) {
  $n_id = $_GET['nc'];

$consultaclientes = $con->query("SELECT cl.id_clientes, cl.c_nombre, cl.cedula, cl.direccion, cl.telefono, cl.fecha, us.nombre from clientes cl INNER JOIN usuario us ON cl.id_usuario=us.id_usuario"); 
  while  ($fila=$consultaclientes->fetch(PDO::FETCH_ASSOC)){ 
  if ($n_id == $fila['id_clientes']) {
    $nombre = $fila['c_nombre'];
    $user = $fila['nombre'];
    $cedula = $fila['cedula'];
    $dir = $fila['direccion'];
    $tel = $fila['telefono'];
    $fecha = $fila['fecha'];
   } 
  }

}
   $consultacuotas = $con->query("SELECT cl.id_clientes,pres.id_cliente, pres.id_prestamo,cu.id_prestamos,cu.cuota FROM cuotas cu INNER JOIN prestamos pres ON pres.id_prestamo=cu.id_prestamos INNER JOIN clientes cl ON pres.id_cliente=cl.id_clientes");
   $abono=0;

    $fil=$consultacuotas->fetch(PDO::FETCH_ASSOC);      
      if ($n_id == $fil['id_clientes'] ) {
        if ($n_id == $fil['id_cliente']) {
              
          $abono = $abono+$fil['cuota'];


} 
}


?>


<div id="general">
<div id="barra" >
  <h2 class="titulo">DATOS DEL CLIENTE</h2></div>
<div id="datos">
	<div class="left" id="logo">
		<input width="200" height="200" name="icon_user" type="image" src="..\imagen\icon_user.png">
    <label class="item"><?php echo "$nombre"; ?></label>  
  </div>
	<div class="right" id="informacion">
  
  <table class="left">
    <tr >
    <td width="25px">Cedula:</td>
    <td width="25px"><label class="item"> <?php echo ("$cedula"); ?></label></td> 
    </tr>
    <tr>
     <td width="25px"><label>Direccion:</label></td>
    <td width="25px"><label class="item"> <?php echo ("$dir"); ?></label></td>
    </tr>
    <tr>
     <td width="25px"><label>Telefono:</label></td>
    <td width="25px"><label class="item"> <?php echo ("$tel"); ?></label></td>
    </tr>
    <tr>
     <td width="25px"><label>Fecha:</label></td>
    <td width="25px"><label class="item"> <?php echo ("$fecha"); ?></label></td>
    </tr>
  </table>
  </div>
  </div>
	</div>
	<br>
</div>



<div id="barra">
	<h2 class="titulo">PRESTAMO</h2>
</div>
<table>
<?php
 $conpres = $con->query("SELECT cl.id_clientes,pres.id_cliente,pres.id_prestamo FROM prestamos pres INNER JOIN clientes cl on cl.id_clientes=pres.id_cliente WHERE id_clientes=$n_id");
 while  ($fila=$conpres->fetch(PDO::FETCH_ASSOC)){ 
  $x=$fila['id_prestamo'];
if ($fila['id_clientes']==$fila['id_cliente']) {?>
<div>
    <tr>
      <td><button class="button"><a href="..\accion\ver_prestamos.php?nc=<?php echo $fila['id_prestamo'];?>"><?php echo "Prestamo Actual";?></a></button></td>
    </tr>
</div>
<?php 
}
}?>

<?php if (!isset($x)) {?>
<div>
    <tr>
      <td><button class="button"><a href="..\vistas\ingresar_prestamo.php"><?php echo "Asignar Prestamo";?></a></button></td>
    <?php }?>
</div>
</table>


<div id="barra">
  <h2 class="titulo">HISTORICO DE PRESTAMOS</h2>
</div>

<div id="auto">
   <table>
                            <thead>
                                <tr align="center">
                                    <th>N°</th>
                                    <th>Monto</th>
                                    <th>Saldo</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Abono</th>
                                    <th>Deuda</th>
                                    <th>Estado</th>
                                 </tr>
                               </thead>
    <?php
    if (isset($_GET['nc'])) {
  $n_id = $_GET['nc'];

$consultahistorico = $con->query("SELECT * from historico"); 

$n=0;
  while  ($fila=$consultahistorico->fetch(PDO::FETCH_ASSOC)){ 
  if ($n_id == $fila['hid_cliente']) {
    $n=$n+1;
   

?>


    <tr align="center">

                                    <td><?php echo "$n"; ?></td>
                                    <td><?php echo $fila['hmonto']; ?></td>
                                    <td><?php echo $fila['hsaldo']; ?></td>
                                    <td><?php echo $fila['hfecha_inicio']; ?></td>
                                    <td><?php echo $fila['hfecha_inicio']; ?></td>
                                    <td><?php echo $fila['habono']; ?></td>
                                    <td ><?php echo $fila['hdeuda']; ?></td>
                                     <?php
                                    if (($fila['hsaldo'] - $fila['habono']) >= 1 ){?>
                                    <td ><?php echo "Vencido"; ?></td>
                                    <?php
                                    }else{?>
                                      <td ><?php echo "Cancelado"; ?></td>
                                    <?php
                                    }
                                    ?>
    </tr>
  <?php                              
   } 
}
  }
?>
                                 
                                  <tr align="center">
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                 </tr>
</table>
</div>
</div>

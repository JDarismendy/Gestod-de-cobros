<?php

if (!isset($_SESSION['rol'])) {
  header('location: ..\index.php');
}
else{
  if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2 ) {
    header('location: ..\index.php');
  }
}


include('..\conexion\db.php');
include('..\estilo\estilo.html');


if (isset($_POST['guardar'])){
	$id_prestamo = $_POST['id_prestamo'];
	$id_cliente = $_POST['id_cliente'];
	$monto = $_POST['monto'];
	$saldo = $_POST['saldo'];
	$abono = $_POST['abono'];
	$deuda = $_POST['saldo'] - $_POST['abono'];;
	$fecha_inicio = $_POST['fecha_inicio'];
	$fecha_fin = $_POST['fecha_fin'];

	if (($saldo - $abono) >= 1) {
	$estado = "Vencido";
	}
	if(($saldo - $abono) <= 0){
		$esatado = "Cancelado";
	}


$consulta = $con->prepare("INSERT INTO historico(id_historico, hid_cliente, hmonto, hsaldo, hdeuda,habono, hfecha_inicio, hfecha_fin, hestado) VALUES ('','$id_cliente','$monto','$saldo','$deuda','$abono','$fecha_inicio','$fecha_fin','$estado')");
if ($consulta->execute()) {
	$consultaeliminar = $con->query("DELETE FROM `prestamos` WHERE id_prestamo = $id_prestamo");
 
  if($consultaeliminar->execute()){
 ?>

 <script>   alert("¡Listo, Prestamo Liquidado!"); 
                <?php echo "window.location = '../vistas/mostrar_prestamos.php' ";?></script>
                <?php 
                 }else{
                     ?>
                <script>   alert("¡Algo salio mal, intentalo de nuevo!"); 
                <?php echo "window.location = '../vistas/mostrar_prestamos.php' ";?></script>
                     <?php
              }
}else{?>
	 <script>   alert("¡Algo salio mal, intentalo de nuevo, en la primera consulta!"); 
                <?php echo "window.location = '../vistas/mostrar_prestamos.php' ";?></script>
                     <?php
              }

}
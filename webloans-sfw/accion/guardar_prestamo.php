<?php

if (!isset($_SESSION['rol'])) {
  header('location: ..\index.php');
}
else{
  if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2 ) {
    header('location: ..\index.php');
  }
}
              $nombre=$_POST['cliente'];
              $monto=$_POST['monto'];
              $deuda=$_POST['deuda'];
              $fechainicio=$_POST['fechainicio'];
              $fechafin=$_POST['fechafin'];
              $formapago=$_POST['formapago'];
              $plazo=$_POST['plazo'];
                           
              $consulta=$con->prepare("INSERT INTO prestamos(id_prestamo, id_cliente, monto, deuda, fecha_inicio, fecha_fin, forma_pago, plazo) VALUES (NULL,'$nombre','$monto','$deuda','$fechainicio','$fechafin','$formapago','$plazo')");


              if($consulta->execute()){
                     ?>

              	<script>   alert("¡Prestamo guardado correctamente!"); </script>

                     <?php
              }else{
                     ?>
              	<script> alert("¡PRESTAMO NO GUARDADO... EL CLIENTE YA TIENE UN PRESTAMO!"); </script>
                     <?php
              }
 
?>


<?php

if (!isset($_SESSION['rol'])) {
  header('location: ..\..\index.php');
}
else{
  if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2 ) {
    header('location: ..\..\index.php');
  }
}

             $nombre=$_POST['cliente'];
              $fecha=$_POST['fecha'];
              $cuota=$_POST['cuota'];

                      
              $consulta=$con->prepare("INSERT INTO cuotas(id_cuota, id_prestamos, cuota, fecha) VALUES (NULL,'$nombre','$cuota','$fecha')");
              
              if($consulta->execute()){
                     ?>

              	 <script>   alert("¡Listo, Cuota Registrada!"); 
                <?php echo "window.location = '../vistas/prestamos.php' ";?></script>
                <?php 
                 }else{
                     ?>
                <script>   alert("¡Algo esta mal, la cuota no se registro!"); 
                <?php echo "window.location = '../vistas/prestamos.php' ";?></script>
                     <?php
              }
?>

<?php 
if (!isset($_SESSION['rol'])) {
  header('location: ..\index.php');
}
else{
  if ($_SESSION['rol'] != 1 ) {
    header('location: ..\index.php');
  }
}

include('..\conexion\db.php');
$n_id = $_GET['nc'];
$consultaeliminar = $con->query("DELETE FROM `prestamos` WHERE id_prestamo = $n_id");
 
  if($consultaeliminar->execute()){
                     ?>

             

<script>   alert("¡Listo,Prestamo Eliminado!"); 
                <?php echo "window.location = '../vistas/mostrar_prestamos.php' ";?></script>
                <?php 
                 }else{
                     ?>
                <script>   alert("¡Algo esta mal!"); </script>
                     <?php
              }
?>
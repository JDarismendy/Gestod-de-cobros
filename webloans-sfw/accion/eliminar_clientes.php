
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
$consultaeliminar = $con->query("DELETE FROM `clientes` WHERE id_clientes = $n_id");
 
  if($consultaeliminar->execute()){
                     ?>
<script>   alert("¡Listo, Cliente eliminado!"); 
                <?php echo "window.location = '../vistas/clientes.php' ";?></script>
                <?php 
                 }else{
                     ?>
                <script>   alert("¡Algo esta mal!"); </script>
                     <?php
              }
?>
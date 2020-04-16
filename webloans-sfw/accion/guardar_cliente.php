<?php

if (!isset($_SESSION['rol'])) {
  header('location: ..\index.php');
}
else{
  if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2 ) {
    header('location: ..\index.php');
  }
}
  
              $nombre=$_POST['nombre'];
              $cedula=$_POST['cedula'];
              $direccion=$_POST['direccion'];
              $telefono=$_POST['telefono'];
              $usuario=$_POST['usuario'];
              
              
             
              $consulta = $con->prepare("INSERT INTO clientes(id_clientes, id_usuario, c_nombre, cedula, direccion, telefono, fecha) VALUES (NULL,'$usuario','$nombre','$cedula','$direccion','$telefono', CURRENT_DATE)");


              if($consulta->execute()){
                $cuo0=$con->prepare("INSERT INTO cuotas(id_cuota, id_prestamos, cuota, fecha) VALUES (NULL,'$nombre','0','0')");
              if($cuo0->execute()){}
                     ?>

 <script>   alert("¡Listo, Cliente Registrado!"); 
                <?php echo "window.location = '../vistas/clientes.php' ";?></script>
                <?php 
                 }else{
                     ?>
                <script>   alert("¡Algo esta mal!"); </script>
                     <?php
              }
?>

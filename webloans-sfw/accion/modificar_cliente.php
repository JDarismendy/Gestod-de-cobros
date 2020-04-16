<?php
if (!isset($_SESSION['rol'])) {
  header('location: ..\index.php');
}
else{
  if ($_SESSION['rol'] != 1 && $_SESSION['rol'] != 2 ) {
    header('location: ..\index.php');
  }
}

 if(isset($_POST['nombre'])){

            $c_nombre = $_POST['edit_nombre'];
            $cedula = $_POST['cedula'];
            $dir = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $user = $_POST['usuario'];

            $consultaeditar=$con->query("UPDATE `clientes` SET `id_usuario` = '".$user."', `c_nombre` = '".$c_nombre."', `cedula` = '".$cedula."', `direccion` = '".$dir."', `telefono` = '".$telefono."' WHERE `clientes`.`id_clientes` = '".$n_id."';");
            if($consultaeditar->execute()){
                   ?> 

                <script>   alert("¡Listo, Cliente actualizado!"); 
                <?php echo "window.location = '../vistas/clientes.php' ";?></script>
                <?php 
                 }else{
                     ?>
                <script> alert("¡fallido!"); </script>
                     <?php
              }


            
    }else{                        
       }
  ?>

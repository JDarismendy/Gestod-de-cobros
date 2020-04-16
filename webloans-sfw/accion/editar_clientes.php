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

$n_id = $_GET['nc'];


if (isset($_GET['nc'])) {
  $n_id = $_GET['nc'];

$consultaclientes = $con->query("SELECT us.nombre,cl.id_clientes, cl.c_nombre, cl.cedula, cl.direccion,cl.telefono, cl.fecha FROM clientes cl INNER JOIN usuario us ON cl.id_usuario=us.id_usuario");
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
?>
<?php

 if(isset($_POST['nombre'])){

            $c_nombre = $_POST['nombre'];
            $cedula = $_POST['cedula'];
            $dir = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $user = $_POST['usuario'];

            $consultaeditar=$con->query("UPDATE `clientes` SET `id_usuario` = '".$user."', `c_nombre` = '".$c_nombre."', `cedula` = '".$cedula."', `direccion` = '".$dir."', `telefono` = '".$telefono."' WHERE `clientes`.`id_clientes` = '".$n_id."';");
            if($consultaeditar->execute()){

              $mensaje = "Ese Usuario o Email ya esta en uso";
                   ?> 

                <script>   alert("¡Listo, Cliente actualizado!"); 
                <?php echo "window.location = 'http://localhost:8080/webloans-sfw/vistas/clientes.php' ";?></script>
                <?php 
    
                 }else{
                     ?>
                <script> alert("¡fallido!"); </script>
                     <?php
              }


            
    }else{                        
       }
  ?>

<!DOCTYPE html>
<html lang="en">
 <div class="titulo" id="barra">
  <body>
    <h2 align="center" >ACTUALIZAR INFORMACION DE CLIENTE</h2>
</body>
</div>
 <!-- Inicio Contenido PHP-->
    <div id="tabla" align="center">
        <form action="#" method="POST">
            <div class="row">
              <div class="form-group col-sm-3 col-xs-12">
                 <label class="puntos">Nombre</label>
                   <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre de cliente" value="<?php echo "$nombre";?>" required>
                  <input type="hidden"  id="valor" >
               </div>
                  <div class="form-group col-sm-3 col-xs-12">
                   <label class="puntos">N. Cedula</label>
                   <input type="number" name="cedula" id="cedula" class="form-control" value=<?php echo "$cedula";?>></input>
                   <input type="hidden"  id="valor" >
              </div>
                           <div class="form-group col-sm-3 col-xs-12">
                            <label class="puntos">Direccion</label>
                            <input name="direccion" id="direccion" class="form-control" value=<?php echo "$dir";?>>
                            <input type="hidden"  id="valor" >
                           </div>
                          <div class="form-group col-sm-3 col-xs-12">
                            <label class="puntos">N. Celular</label>
                            <input type="number" name="telefono" id="telefono" class="form-control" value=<?php echo "$tel";?>>
                            <input type="hidden"  id="valor" >
                          </div>
                       </div>
                       <div class="row">
                        <div class="form-group col-sm-6 col-xs-12">
                           <label class="puntos">Usuario</label>
                            <select name="usuario" id="usuario" class="form-control selectpicker" data-live-search="true" required>
                              
                              <?php  
                              if ($_SESSION['rol']=1) {
                                # code...
                              $res = $con->query("SELECT * from usuario");  
                              ?>
                              <option value="" >Seleccionar Usuario</option>
                              <?php
                               foreach ($res as $row) {?>
                               <option value="<?php echo($row[0]); ?>" ><?php echo $row[2]; ?></option>
                              <?php 
                            } 
                             } else{ ?>
                              <option value='<?php echo( $_SESSION['id']); ?>' ><?php echo $_SESSION['nom']; ?></option>
                             <?php }  ?>

                            </select> 
                            
                        </div> 
                      </div>
                        <div class="form-group col-xs-12">
                        <br>           
                          <p class="center-content">
                            <button class="btn btn-primary" type="submit"  id="btnGuardar"><i class="fa fa-save"></i> Actualizar</button>
                            <button  class="btn btn-danger back" onclick='history.back()'  type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </p> 
                          </div>

                       </form>
                </div>
    <div id="barra"></div>
         
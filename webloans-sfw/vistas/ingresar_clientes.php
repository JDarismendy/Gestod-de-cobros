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
 ?>

<!DOCTYPE html>
<html lang="en">
 
  <body>
    <h2 align="center" >INGRESAR LA INFORMACION DEL NUEVO CLIENTE</h2>
</body>

 <!-- Inicio Contenido PHP-->
    <div id="tabla" align="center">
        <form action="clientes.php" method="POST">
            <div class="row">
              <div class="form-group col-sm-3 col-xs-12">
                 <label class="puntos">Nombre</label>
                   <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre de cliente" required>
                  <input type="hidden"  id="valor" >
               </div>
                  <div class="form-group col-sm-3 col-xs-12">
                   <label class="puntos">N. Cedula</label>
                   <input type="number" name="cedula" id="cedula" class="form-control" placeholder="N. Cedula de cliente" required>
                   <input type="hidden"  id="valor" >
              </div>
                           <div class="form-group col-sm-3 col-xs-12">
                            <label class="puntos">Direccion</label>
                            <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Residencia" required>
                            <input type="hidden"  id="valor" >
                           </div>
                          <div class="form-group col-sm-3 col-xs-12">
                            <label class="puntos">N. Celular</label>
                            <input type="number" name="telefono" id="telefono" class="form-control" placeholder="N. Celular" required>
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
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                            <button class="btn btn-danger back" onclick="history.back()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </p> 
                          </div>

                       </form>
                       <a href="..\index.php">Inicio</a> 
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Contenido PHP-->



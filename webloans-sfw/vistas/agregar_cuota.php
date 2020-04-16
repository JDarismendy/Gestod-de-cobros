
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

if(isset($_POST['cliente'])){
  include('..\accion\guardar_cuota.php'); 
  }else{                
    }   

 ?>


<!DOCTYPE html>
<html lang="en">

 <body>
    <h3 align="center">INGRESAR LA INFORMACION DE LA CUOTA</h3>
</body>

<div align="center" id="tabla">

                    <form action="#" method="POST">
                 
                      <div class="row">
                           <div class="form-group col-md-6 col-sm-9 col-xs-12">
                            <label>Cliente</label>
                            <select name="cliente" id="cliente" class="form-control selectpicker" data-live-search="true" required>
                              <?php
                              $res=$con->query("SELECT cl.c_nombre, pres.id_prestamo FROM clientes cl INNER JOIN prestamos pres ON cl.id_clientes=pres.id_cliente");
                            ?>
                              <option value="" >Seleccionar nombre de cliente</option>
                              <?php
                              while  ($fila=$res->fetch(PDO::FETCH_ASSOC)){ 
                                
                              ?>
                              <option value="<?php echo($fila['id_prestamo']);?>"><?php echo($fila['c_nombre']);?></option>
                              <?php 
                              }
                           ?>
                            </select>                           
                           </div>
                           <div class="form-group col-sm-3 col-xs-12">
                            <label>Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                            </input>
                           </div>
                           
                          <div class="form-group col-sm-3 col-xs-12">
                            <label>Cuota</label>
                            <input type="number" name="cuota" id="cuota" class="form-control" placeholder="Abono" required>
                            <input type="hidden"  id="valor" >
                          </div>
                       </div>                                        
                        <div class="form-group col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                            <button class="btn btn-danger back" onclick="history.back()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                        </div>
                    </form>
              </div>
   

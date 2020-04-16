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
  <body>
    <h3 align="center">AGREGAR DATOS DEL PRESTAMO</h3>
</body>

    <!-- Inicio Contenido PHP-->
    <div  align="center" class="row">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                   <div class="main-box-body clearfix" id="formularioregistros">
                    <form action="mostrar_prestamos.php" name="formulario" id="formulario" method="POST">

                        <div class="row">
                           <div class="form-group col-md-6 col-sm-9 col-xs-12">
                            <label>Cliente</label>
                            <select name="cliente" id="cliente" class="form-control selectpicker" data-live-search="true" required>
                              
                              <?php  
                              $res = $con->query("SELECT * FROM clientes");  
                              ?>
                              <option value="" >Seleccionar nombre de cliente</option>
                              <?php
                               foreach ($res as $row) {
                                ?>
                               <option value="<?php echo($row['id_clientes']); ?>"><?php echo $row['c_nombre']; ?></option>
                              <?php 
                            }
                             ?>

                            </select>                           
                           </div>
                        <div class="form-group col-sm-6 col-xs-12">
                           <label>Usuario</label>
                            <select name="usuario" id="usuario" class="form-control selectpicker" data-live-search="true" required>
                              <option value='<?php echo($_SESSION['id']); ?>' ><?php echo $_SESSION['nom']; ?></option>
                            </select> 
                            
                        </div>                          
                        </div>
                        <div class="row">
                        <div class="form-group col-sm-3 col-xs-12">
                            <label>Monto</label>
                            <input type="number" name="monto" id="monto" class="form-control" placeholder="Monto" required>
                            <input type="hidden" id="interes" name="interes" value="20">
                        </div>
                         <div class="form-group col-sm-3 col-xs-12">
                            <label>Deuda</label>
                            <input type="number" name="deuda" id="deuda" class="form-control" placeholder="Saldo" required ></input>
                        </div>
                        </div>
                        <div class="row">
                             <div class="form-group col-sm-3 col-xs-12">
                              <label>Fecha de inicio:</label>
                            <input type="date" class="form-control" name="fechainicio" id="fechainicio" required value="<?php echo date("Y-m-d");?>">
                        </div>
                         <div class="form-group col-sm-3 col-xs-12">
                            <label>Fecha Cancelacion</label>
                            <input type="date" class="form-control" name="fechafin" id="fechafin" required >
                          </div>
                         </div>
                        <div class="row">
                             <div class="form-group col-sm-3 col-xs-12">
                            <label>Forma Pago</label>
                            <select class="form-control select-picker" name="formapago" id="formapago" required>
                              <option value="Diario">Diario</option>
                              <option value="Semanal">Semanal</option>
                              <option value="Quincenal">Quincenal</option>
                              <option value="Mensual">Mensual</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-3 col-xs-12">
                           <label>Plazo</label>
                            <input type="number" name="plazo" id="plazo" class="form-control" placeholder="Plazo del prestamo en dias" required >
                        </div>
                        </div>
                         
                        <div class="form-group col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                            <button class="btn btn-danger back" onclick="history.back()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Contenido PHP-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script type="text/javascript">
  
         $(function() {

            $("#monto").change(function() {
                var mont = $(this).val();
                var interes = mont * (20/100);
                var total = parseFloat(interes) + parseFloat(mont);
                //le envia el valor por teclado a saldo
                $("#deuda").val(total);
           });
        });

         $(function(){
          $("#fechainicio").change(function(){
            var finicio = $(this).val();
           });   

          $("#fechainicio").change(function(){
            var plazodias = $(this).val();
           });

          var fin = parseFloat(finicio) + parseFloat(plazodias);

          $("fechafin").val(fin);

         });
</script>


<?php 
ob_end_flush();
?>

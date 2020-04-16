<?php
include('..\conexion\db.php');
include('..\estilo\menu.html');
include('..\estilo\estilo.html');
?>


<div id="tabla">
	
	<div>
	<h4 class="item">REPORTE DE MOVIMIENTOS</h4>	
	</div>
	<div id="datos">
		<div align="right" >
		<form>

			 
		<table>
			<tr>
				<td><label>Total Cobro:</label></td>
				<td><input  type="number" name="cobro" id="cobro" placeholder="Total cobrado" readonly="readonly" ></td>
				<td ><label>Prestamos:</label></td>
				<td><input  type="number" name="prestado" id="prestado" placeholder="Pretamos del dia" ></td>
				<td ><label>Fecha:</label></td>
				<td><input type="datetime" name="fecha"  value="<?php echo date("Y-m-d");?>"></td>
				
			</tr>
			<tr>
				<td ><label>Base:</label></td>
				<td ><input type="number" name="base" id="base" placeholder="Base del dia" ></td>
				<td ><label>Gastos:</label></td>
				<td><input type="number" name="gastos" id="gastos" placeholder="Gastos del dia" ></td>
				<td ><label>Ingreso a Caja:</label></td>
				<td><input type="number" name="ingreso" id="ingreso" placeholder="Total a entregar" readonly="readonly"></td>
			</tr>
			<tr>
			<td><button type="button" class="btn btn-success">Enviar</button></div></td>
			</tr>
		</table>
		</form>
		</div>
	</div>

<div class="row" id="general">	
	<table>
		<div>
		<thead>
			<tr>
			<th>N°</th>
			<th>USUARIO</th>
			<th>FECHA</th>
			<th>GASTOS</th>
			<th>PRESTAMOS</th>
			<th>BASE</th>
			<th>COBRO</th>
			<th>INGRESO</th>
			<th>CARTERA</th>
			</tr>
		</thead>

<?php
$reportes = $con->query("SELECT us.nombre,re.cobro,re.gasto,re.prestado,re.cartera,re.base,re.fecha FROM reportes re INNER JOIN usuario us ON us.id_usuario=re.id_usuario");
$c = 0;
 while  ($fila=$reportes->fetch(PDO::FETCH_ASSOC)){ 
		$c = $c + 1;
		$ingreso = (($fila['cobro']+$fila['base'])-($fila['gasto']+$fila['prestado']));
?>

		  <tr>
		  	<td><?php echo $c; ?></td>
			<td><?php echo $fila['nombre']; ?></td>
			<td><?php echo $fila['fecha']; ?></td>
			<td><?php echo $fila['gasto']; ?></td>
			<td><?php echo $fila['prestado']; ?></td>
			<td><?php echo $fila['base']; ?></td>
			<td><?php echo $fila['cobro']; ?></td>
			<td><?php echo $ingreso; ?></td>
			<td><?php echo $c; ?></td>
		   </tr>
    <?php
}
?>
		    <tr>
			<td>--</td>
			<td>--</td>
			<td>--</td>
			<td>--</td>
			<td>--</td>
			<td>--</td>
			<td>--</td>
			<td>-</td>
			<td>--</td>
		   </tr>
		</div>


	</table>


</div>
</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script type="text/javascript">
  
         $(function() {

            $("#cobro").change(function() {
                  var cobrado = $(this).val();              
           
               $("#base").change(function() {
                  var base = $(this).val();  
                             
                  $("#prestado").change(function() {
                   var prestado = $(this).val();              
           
                   $("#gastos").change(function() {
                   	var gastado = $(this).val();
                 
                     var total = (parseFloat(cobrado) + parseFloat(base))-(parseFloat(prestado) + parseFloat(gastado));
                     $("#ingreso").val(total);  
           });
                   });
        });
             });

                     
            });
</script>


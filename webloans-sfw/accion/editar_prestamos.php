
<?php 

session_start();
if (!isset($_SESSION['rol'])) {
  header('location: ..\index.php');
}
else{
  if ($_SESSION['rol'] != 1 ) {
    header('location: ..\index.php');
  }
}

include('..\conexion\db.php');
include('..\estilo\menu.html');
include('..\estilo\estilo.html'); 

$n_id = $_GET['nc'];

if (isset($_GET['nc'])) {
  $n_id = $_GET['nc'];

$consultaeditar = $con->query("SELECT cl.c_nombre,pres.monto,pres.id_prestamo,pres.id_cliente,pres.deuda,pres.forma_pago,pres.fecha_inicio,pres.fecha_fin FROM prestamos pres INNER JOIN clientes cl ON cl.id_clientes=pres.id_cliente WHERE id_prestamo=$n_id");
  while  ($fila=$consultaeditar->fetch(PDO::FETCH_ASSOC)){ 
  if ($n_id == $fila['id_prestamo']) {
    $nombre = $fila['c_nombre'];
    $monto = $fila['monto'];
    $deuda = $fila['deuda'];
    $forma_pago = $fila['forma_pago'];
    $fecha_inicio = $fila['fecha_inicio'];
    $fecha_fin = $fila['fecha_fin'];

   } else{
 
   }
  }
}
?>
<?php

 if(isset($_POST['btnGuardar'])){
    $nombre = $_POST['c_nombre'];
    $monto = $_POST['monto'];
    $deuda = $_POST['saldo'];
    $forma_pago = $_POST['forma_pago'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

            $consultaeditar=$con->query("UPDATE prestamos pres INNER JOIN clientes cl ON cl.id_clientes=pres.id_cliente SET cl.c_nombre = '".$nombre."', pres.monto = '".$monto."', pres.deuda='".$deuda."', pres.forma_pago = '".$forma_pago."', pres.fecha_inicio = '".$fecha_inicio."', pres.fecha_fin = '".$fecha_fin."';");
            if($consultaeditar->execute()){
                   ?> 

                <script>   alert("¡Listo, Prestamo actualizado!"); 
                <?php echo "window.location = '..\vistas\mostrar_prestamos.php' ";?></script>
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
    <h2 align="center" >ACTUALIZAR INFORMACION DEL PRESTAMO</h2>
</body>
</div>

<div id="datos">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
  <div >
    <table>
      <tr>
      	<td>
          <label class="puntos">Nombre Del Cliente</label>
          <input type="text" name="c_nombre" id="c_nombre" class="form-control" placeholder="Nombre de usuario" value="<?php echo "$nombre "; ?>">
        </td> 
        
        <td>
          <label class="puntos">Monto</label>
          <input type="number" name="monto" id="monto" class="form-control" required placeholder="Monto del prestamo" value=<?php echo "$monto "; ?> >
        </td>
      </tr>
      <tr>
        <td>
          <label class="puntos">Saldo</label>
          <input type="number" name="saldo" id="saldo" class="form-control" placeholder="Saldo a pagar" value=<?php echo "$deuda "; ?> required>
        </td>
        <td>
          <label class="puntos">Forma de pago</label>
          <input type="text" name="forma_pago" id="forma_pago" class="form-control" placeholder="forma de pago" required value=<?php echo "$forma_pago "; ?> >
        </td>
      </tr>
      <tr>
        <td>
          <label class="puntos">Fecha de inicio</label>
          <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"  placeholder="Fecha de inicio del prestamo" required value=<?php echo "$fecha_inicio "; ?>>
        </td>
        <td>
          <label class="puntos">Fecha de cancelacion</label>
          <input type="date" name="fecha_fin" id="fecha_fin" class="form-control"  placeholder="Fecha maxima" required value=<?php echo "$fecha_fin "; ?>>
        </td>
      </tr>
      <tr>
      	<div class="form-group col-xs-12">
                       <td align="right">
                            <button class="btn btn-primary" type="submit" name="btnGuardar" id="btnGuardar"><i class="fa fa-save"></i>Actualizar</button></td>
                        <td><button class="btn btn-danger back" onclick="history.back()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button></td>
                       </div>
      </tr>
    </table>
  </div>
</form>
</div>

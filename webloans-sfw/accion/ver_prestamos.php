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

if (isset($_GET['nc'])) {
  $n_id = $_GET['nc'];
?>

<div id="barra">
  <h2 class="titulo">PRESTAMO</h2>
</div>

<?php
   $consultacuotas = $con->query("SELECT * FROM cuotas WHERE id_prestamos=$n_id" );
   $abono=0;
while  ($fila=$consultacuotas->fetch(PDO::FETCH_ASSOC)){  
          $abono =$abono + $fila['cuota'];   
}

$coninfor = $con->query("SELECT cl.id_clientes, cl.c_nombre, pres.fecha_inicio, pres.fecha_fin, pres.monto, pres.deuda FROM clientes cl INNER JOIN prestamos pres ON cl.id_clientes=pres.id_cliente WHERE id_prestamo=$n_id");
 while  ($fila=$coninfor->fetch(PDO::FETCH_ASSOC)){ 
?>

<div>
  <form action="liquidar.php" method="POST">
<input type="hidden" value="<?php echo $n_id; ?>" name="id_prestamo" readonly="readonly"></input>
<input type="hidden" value="<?php echo $abono; ?>" name="abono" readonly="readonly"></input>
<input type="hidden" value="<?php echo $fila['id_clientes']; ?>" name="id_cliente" readonly="readonly"></input>
<table  class="table">
  <div>
  <tr align="left">
    <th width="25px">Nombre:</th>
    <td><input type="text" value="<?php echo $fila['c_nombre']; ?>" name="c_nombre" readonly="readonly"></input></td>
    <th width="25px">Monto:</th>
    <td><input type="text" value="<?php echo $fila['monto']; ?>" name="monto" readonly="readonly"></input></td>
    
  </tr>
  <tr>
    <th width="25px">F. Inicio:</th>
    <td><input type="text" value="<?php echo $fila['fecha_inicio']; ?>"name="fecha_inicio" readonly="readonly"></input></td>
    <th width="25px">Saldo:</th>
    <td><input type="text" value="<?php echo $fila['deuda']; ?>" name="saldo" readonly="readonly"></input></td>
  </tr>

  <tr>
    
    <th width="25px">F. Fin:</th>
    <td><input type="text" value="<?php echo $fila['fecha_fin']; ?>" name="fecha_fin" readonly="readonly"></input></td>
    <th width="25px">Deuda:</th>
    <?php 
    $deuda=$fila['deuda'] - $abono;
    ?>
    <td><input type="text" value="<?php echo $deuda; ?>" name="deuda" readonly="readonly"></input></td>  
  </tr>
  </div>
 <div class="right">
 <button class="button" type="submit" name="guardar" id="guardar"><i class="btn btn-danger"></i>Liquidar</button>
</div>
  <?php
}
?>
</table>
</form>
</div>
<div id="barra">
	<h2 class="titulo">MOVIMIENTOS</h2>
</div>

<div id="auto">
	 <table>
                            <thead>
                                <tr align="center">
                                    <th>N°</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                    <th>Forma de pago</th>
                                    <th>Monto</th>
                                    <th>Saldo</th>
                                    <th>Cuota</th>
                                    <th>Abono</th>
                                    <th>Deuda</th>
                                    <th colspan="3" >Estado</th>
                                </tr>
                              </thead>

                  <?php
                    $consulta=$con->query("SELECT cl.c_nombre, pres.monto, pres.deuda, pres.forma_pago,cu.id_prestamos,cu.fecha, cu.cuota FROM clientes cl INNER JOIN prestamos pres ON cl.id_clientes=pres.id_cliente INNER JOIN cuotas cu ON pres.id_prestamo=cu.id_prestamos WHERE id_prestamo = $n_id");
                    $c=0;
                    $abono=0;
                    while  ($fila=$consulta->fetch(PDO::FETCH_ASSOC)){ 
                  ?>
                                  <tr align="center">
                                    <td><?php echo $c=$c+1; ?></td>
                                    <td><?php echo $fila['c_nombre']; ?></td>
                                    <td><?php echo $fila['fecha']; ?></td>
                                    <td><?php echo $fila['forma_pago']; ?></td>
                                    <td><?php echo $fila['monto']; ?></td>
                                    <td><?php echo $fila['deuda']; ?></td>
                                    <td><?php echo $fila['cuota']; ?></td>
                                    <?php
                                    if ($n_id==$fila['id_prestamos']) {
                                      $abono = $abono+$fila['cuota'];?>
                                    <td><?php echo $abono; ?></td>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if ($n_id==$fila['id_prestamos']) {
                                      $deuda = $fila['deuda']- $abono;
                                      if($deuda<=0){?>
                                          <td><?php echo "Cancelado"; ?></td>
                                      <?php
                                      } else{?> <td><?php echo $deuda; ?></td>  
                                    <?php
                                      }
                                    }
                                    ?>  
                                    <?php
                                    if ($n_id==$fila['id_prestamos']) {
                                      if ($deuda <= 0){ ?>
                                        <td><?php echo "Cancelado"; ?></td>
                                      <?php
                                    }
                                     if ($deuda > 0){ ?>
                                        <td><?php echo "Activo"; ?></td>
                                      <?php
                                    }
                                  }
                                  ?>
                                 </tr>
                      <?php 
                    }
                      ?>
                                   <tr align="center">
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                 </tr>
</table>
</div>
<div id="barra">
  <h2 ></h2>
</div>

<?php
}
?>
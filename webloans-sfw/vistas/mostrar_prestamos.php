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
  include('..\accion\guardar_prestamo.php'); 
  }else{
                        
    }    ?>

 <!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
 </head>
   <!-- Inicio Contenido PHP-->
    <div id="tabla">
                <header >
                    <h2 class="box-title">Prestamos <button class="btn btn-success" id="btnagregar"><a href="ingresar_prestamo.php" class="fa fa-plus-circle"> Nuevo</a></button></h2>
                </header>
                        <table >
                            <thead>
                                <tr align="center">
                                    <th>N°</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                    <th>Forma de pago</th>
                                    <th>Prestamo</th>
                                    <th>Saldo</th>
                                    <th>Usuario</th>
                                    <th colspan="3" >Opcion</th>
                                </tr>
                              </thead>
            <?php 
             $contador=1;
            $res = $con->query("SELECT cl.id_clientes,cl.c_nombre,pres.id_cliente,pres.id_prestamo, pres.monto, pres.deuda, pres.fecha_inicio,pres.forma_pago,us.nombre FROM usuario us INNER JOIN clientes cl ON cl.id_usuario=us.id_usuario INNER JOIN prestamos pres ON pres.id_cliente=cl.id_clientes");  
            while  ($fila=$res->fetch(PDO::FETCH_ASSOC)){ 
           $abono=0;
            ?> 

                                
                                <td align="center"><?php echo "$contador"; $contador=$contador+1; ?> </td>
                                <td align="left"><?php echo $fila['c_nombre']; ?> </td>
                                <td align="center"><?php echo $fila['fecha_inicio']; ?> </td>
                                <td align="center"><?php echo  $fila['forma_pago']; ?> </td>
                                <td align="center"><?php echo "$",$fila['monto']; ?> </td>
                                <td align="center"><?php echo "$", $fila['deuda']; ?> </td>
                                <td align="center"><?php echo $fila['nombre']; ?> </td>
                                <td align="center" >
                                  <button class="btn" style="width:15px"  ><a href="..\accion\ver_prestamos.php?nc=<?php echo $fila['id_prestamo'];?>" class="fas fa-low-vision"></a></button>
                                <td align="center">
                                 <button class="btn" style="width:15px" ><a href="..\accion\editar_prestamos.php?nc=<?php echo $fila['id_prestamo'];?>" class="far fa-edit"></a> </button>
                                  </td>
                                  <?php if ($_SESSION['rol']==1) {?>
                                    <td align="center">
                                     <button class="btn" style="width:15px" ><a href="..\accion\eliminar_prestamo.php?nc=<?php echo $fila['id_prestamo'];?>" class="far fa-trash-alt"></a> </button>
                                      </td>
                                  <?php 

                                }
                                ?>
                                  
                          </tr>
            <?php 
           
            }
         ?>
          </table>
      </div>

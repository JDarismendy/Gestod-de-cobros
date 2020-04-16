
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
<head>

<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
 </head>
   <!-- Inicio Contenido PHP-->
   <div id="tabla">
                <header class="main-box-header clearfix">
                    <h2 class="box-title">Clientes <button class="btn btn-success" id="btnagregar"><a href="ingresar_clientes.php" class="fa fa-plus-circle"> Nuevo</a></button></h2>
                </header>
              
                        <table>
                            <thead>
                                <tr align="center">
                                    <th style="width: 50">N°</th>
                                    <th>Nombre</th>
                                    <th>Cedula</th>
                                    <th>Direccion</th>
                                    <th>Celular</th>
                                    <th>Fecha</th>
                                    <th>Cobrador</th>
                                    <th colspan="3" >Accion</th>
                                </tr>
                              </thead>
                          <?php

                          if(isset($_POST['nombre'])){
                           include('..\accion\guardar_cliente.php'); 
                          }else{
                           
                          }
                          ?>

                                      <?php
                                       $contador=1;
                                      $res = $con->query("SELECT * from clientes");  
                                      foreach ($res as $row){ 
                                      ?> 
                                              <tr> 
                                              <td align="center"><?php echo "$contador"; $contador=$contador+1; ?> </td>
                                              <td><?php echo '>', $row[2]; ?> </td>
                                              <td align="center"><?php echo $row[3]; ?> </td>
                                              <td align="center"><?php echo $row[4]; ?> </td>
                                              <td align="center"><?php echo $row[5]; ?> </td>
                                              <td align="center"><?php echo $row[6]; ?> </td>
                                               <?php 
                                              if ($_SESSION['rol']==1){   // si es rol admin haga esto
                                              $c="Administrador"; ?>
                                              <td align="center"><?php echo "$c"; ?> </td>
                                              <?php
                                            }else{
                                              $c=$row[1]; ?>
                                              <td align="center"><?php echo "C. ","$c"; ?> </td>
                                              <?php
                                            }
                                               ?>
                                              
                                              <td >
                                                
                                                <button name="vercliente" value="<?php echo $row[0]; ?>" style="width: 15" class="btn"><a href='..\accion\ver_clientes.php?nc=<?php echo "$row[0]"; ?>' class="fas fa-low-vision"></a></button>
                                              </td>
                                              <td align="center">
                                               <button name="editarcliente" value="" style="width: 15" class="btn"><a href='..\accion\editar_clientes.php?nc=<?php echo "$row[0]"; ?>'class="far fa-edit"></a> </button>
                                                </td>
                                              <?php
                                              if ($_SESSION['rol']==1) {?>
                                              <td align="center">  
                                                <button name="borrarcliente" style="width: 15" class="btn"><a href='..\accion\eliminar_clientes.php?nc=<?php echo "$row[0]"; ?>' class="far fa-trash-alt"></a> </button>
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

                            
                            <tbody>
                            </tbody>
                            </table>
         
        <script type="text/javascript">
           
         </script>
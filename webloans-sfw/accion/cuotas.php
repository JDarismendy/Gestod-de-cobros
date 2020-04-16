
<div id="auto">

      <table >
                            <thead>
                                <tr align="center">
                                    <th>N°</th>
                                    <th>Fecha</th>
                                    <th>Abono</th>
                                    <th>Deuda</th>
                                    <th>Cuota</th>
                                </tr>
                              </thead>
           <?php
                    $consulta=$con->query("SELECT cu.id_cuota,cu.id_prestamos, cu.cuota, cu.fecha, pres.id_prestamo,pres.deuda FROM cuotas cu  INNER JOIN prestamos pres ON  pres.id_prestamo=cu.id_prestamos WHERE id_prestamo = $n_id");
                    $c=0;
                    $abono=0;
                    while  ($fila=$consulta->fetch(PDO::FETCH_ASSOC)){ 
                 
                  ?>
                                  <tr align="center">
                                    <td><?php echo $c=$c+1; ?></td>
                                    <td><?php echo $fila['fecha']; ?></td>
                                    <?php
                                    if ($n_id==$fila['id_prestamos']) {
                                      $abono = $abono+$fila['cuota'];?>
                                    <td><?php echo $abono; ?></td>
                                    <?php
                                    }
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
                                    <td><?php echo $fila['cuota']; ?></td>    
                          </tr>
            <?php 
           
            }
         ?>                     <tr align="center">
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    
                                 </tr>

          </table>
</div>
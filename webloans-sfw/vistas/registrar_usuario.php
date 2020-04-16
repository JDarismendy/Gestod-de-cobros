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

include("..\conexion\db.php"); 
include('..\estilo\menu.html');
include('..\estilo\estilo.html');
include('..\login\mcript.php');

if (isset($_POST['btnGuardar'])){
  $nombre=$_POST['nombre'];
  $id_rol=$_POST['rol'];
  $usuario=$_POST['usuario'];
  $clave=$cifrar($_POST['clave']);
  $cedula=$_POST['cedula'];
  $telefono=$_POST['telefono'];

$insertar = $con->prepare("INSERT INTO usuario(id_usuario, id_rol, nombre, usuario, clave, cedula, telefono, fecha) VALUES ('','$id_rol','$nombre','$usuario','$clave','$cedula','$telefono', CURRENT_DATE)");
            if($insertar->execute()){
                     ?>

              	 <script>   alert("¡Usuario registrado con exito!"); 
                <?php echo "window.location = '../ps/admin.php' ";?></script>
                <?php 
                 }else{
                     ?>
                <script>   alert("¡Algo esta mal, Usuario no registrado!"); 
                <?php echo "window.location = '../ps/admin.php' ";?></script>
                     <?php
              }
}?>

<div id="datos">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
  <div >
    <table>
      <tr>
        <td>
          <label class="puntos">Nombre de Usuario</label>
          <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre de usuario" required>
        </td>
        <td>
          <label class="puntos">N. Cedula</label>
          <input type="number" name="cedula" id="cedula" class="form-control" placeholder="Numero de Cedula" required>
        </td>
      </tr>
      <tr>
        <td>
          <label class="puntos">Usuario</label>
          <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Nombre de usuario" required>
        </td>
        <td>
          <label class="puntos">Contraseña</label>
          <input type="text" name="clave" id="clave" class="form-control" placeholder="Usuario(se usara para inicar sesion)" required>
        </td>
      </tr>
      <tr>
        <td>
          <label class="puntos">Telefono</label>
          <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Numero de telefono" required>
        </td>
        <td>
          <label class="puntos">Tipo de Usuario</label>
          <select name="rol" id="rol" class="form-control" placeholder="Tipo de usuario">
            <option ></option>
            <option value=1 >Administrador</option>
            <option value=2 >Cobrador</option>
          </select>
        </td> 
      </tr>
      <tr>
        <div class="center"> 
        <td align="right"><button class="btn btn-primary" type="submit" name="btnGuardar" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button></td>
              <td><button  class="btn btn-danger back" onclick="history.back()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button></td>
              </div>
      </tr>
    </table>
  </div>
</form>
</div>

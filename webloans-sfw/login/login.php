<?php

// Include config file
include('conexion\db.php');
include('mcript.php');

// Initialize the session
session_start(); 
if(isset($_SESSION['rol'])){
    switch($_SESSION['rol']){
        case 1:
            header('location: ps\admin.php');
            break;
        case 2:
            header('location: ps\cobrador.php');
            break;
        default;
    }
}

if(isset($_POST['username']) && $_POST['password']){
    $usuario = $_POST['username'];
    $clave = $cifrar($_POST['password']);

    $consulta = $con->prepare("SELECT * FROM usuario WHERE usuario = :username AND clave = :password");

    $consulta->execute(['username'=> $usuario, 'password' => $clave]);

    $row = $consulta->fetch(PDO::FETCH_NUM);
    if($row == true){
       
       //variables de sesion
       $id = $row[0];
       $nom = $row[3];
       $user = $row[4];
       $ced = $row[5];
       $tel = $row[6];
       $fec = $row[7];

       $_SESSION['id'] = $id;
       $_SESSION['nom'] = $nom;
       $_SESSION['user'] = $user;
       $_SESSION['ced'] = $ced;
       $_SESSION['tel'] = $tel;
       $_SESSION['fec'] = $fec;
        //validar rol
        $rol = $row[1];
        $_SESSION['rol'] = $rol;
          switch($_SESSION['rol']){
        case 1:
            header('location: ps\admin.php');
            break;
        case 2:
            header('location: ps\cobrador.php');
            break;
        default:
        break;
    }
    
    }
    else{
        echo "Nombre o contraseña incorrecta";
    
    }

}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WebLoans-Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{background-color: #FFF8DC; font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
        .login{ 
            border: 1px solid #000000;
            border-radius: 5px;
            padding: 17px;
            position: absolute; 
            top: 50%; 
            left: 50%; 
            transform: translate(-50%, -50%);
         }
    </style>
</head>

<body>
    <div class="login" class="wrapper">
        <h2 align="center">WEBLOANS</h2>
        <p>Por favor, complete sus credenciales para iniciar sesión.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Usuario</label>
                <input type="text" name="username" class="form-control" required="">
                
            </div>    
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" required="">
               
            </div>
            <div align="center" class="form-group">
                <input  type="submit" class="btn btn-primary" value="Ingresar">
            </div>
            
        </form>
    </div>    
</body>
</html>
<?php
$alert = '';
session_start();
if(!empty($_SESSION['active'])){
    header('location: sistema/');
}else{


// TODO ESTO ES LA VALIDACIÓN DEL USUARIO Y LA CONTRASEÑA
if(!empty($_POST)) 
{
    if(empty($_POST['usuario']) or empty($_POST['clave']))// si los campos estan vacios, entonces se le dara valor a alert
    {
        $alert = 'Ingrese su usuario y su clave';
    }else
    {// si no estan vacios entonces se consultará si los datos ingresados son válidos
        require_once "conexion.php";
        $user = mysqli_real_escape_string($conection, $_POST['usuario']); //la funcion es para seguridad y evitar caracteres raros que puedan ser ingresados
        $pass = md5(mysqli_real_escape_string($conection,$_POST['clave']));
        // A continuacion hacemos la consulta si los datos existen en la base de datos
        $query = mysqli_query($conection, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.idrol,r.rol 
                                            FROM usuario u
                                            INNER JOIN rol r
                                            ON u.rol = r.idrol
                                             WHERE u.usuario='$user' AND u.clave = '$pass'"); //esto nos devuelve una tabla
        mysqli_close($conection);
        $result = mysqli_num_rows($query); //esto nos da el numero de columnas que tiene la tabla
        // Si  los datos son válidos, la tabla tendrá al menos 1 columna, si no, entonces no nos dará ninguna tabla, por lo que el numero de columas será de 0

        if($result > 0)
        {// en caso de que si existan los datos ingresados, se da inicio a la sesion y se registra la informacion del usuario
            $data = mysqli_fetch_array($query);
            
            $_SESSION['active'] = true;
            $_SESSION['idUser'] = $data['idusuario'];
            $_SESSION['nombre'] = $data['nombre'];
            $_SESSION['email'] = $data['correo'];
            $_SESSION['user'] = $data['usuario'];
            $_SESSION['rol'] = $data['idrol'];
            $_SESSION['rol_name'] = $data['rol'];


            header('location: sistema/');
        }else{
            $alert="el usuario o la clave son incorrectos";
            session_destroy();
            
        }
    }
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | FUVADIS</title>
    <link rel="stylesheet" type = "text/css" href="css/style.css">

</head>
<body>
    <section id="container">
        <form action="" method="post">
            <h3>Iniciar Sesión</h3>
            <img src="img/login.jpg" alt="Login">

            <input type="text" name="usuario" placeholder="Usuario">
            <input type="password" name="clave" placeholder = "Contraseña">
            <div class="alert"> <?php echo isset($alert)? $alert : '';?> </div>
            <input type="submit" value = "INGRESAR">

        
        </form>
    </section>
</body>
</html>
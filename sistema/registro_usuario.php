<?php 
session_start();
if($_SESSION['rol'] != 1){
    header("location: ../");
}
include "../conexion.php";
    if(!empty($_POST)){
        $alert='';
        if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['rol'])){
            $alert = '<p class="msg_error">Todos los campos son obligatorios<p/>';
        }else{
            

            $nombre = $_POST['nombre'];
            $email = $_POST['correo'];
            $user = $_POST['usuario'];
            $clave = md5($_POST['clave']);
            $rol = $_POST['rol'];
            
             
            $query = mysqli_query($conection, "SELECT * FROM usuario WHERE '$user' OR correo = '$email' AND estatus = 1 ");
            mysqli_close($conection);
            $result = mysqli_fetch_array($query);
            if($result > 0){
                $alert = '<p class="msg_error">El correo o el usuario ya existen<p/>';
            }else{
                include "../conexion.php";
                $query_insert = mysqli_query($conection, "INSERT INTO usuario(nombre,correo,usuario,clave,rol) VALUES('$nombre','$email','$user', '$clave','$rol')");
                mysqli_close($conection);
                if($query_insert){
                    $alert = '<p class="msg_save">Usuario creado correctamente<p/>';
                }else{
                    $alert = '<p class="msg_error">Error al crear el usuario<p/>';
                }
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro Sesiones de Usuario</title>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section id="container">
		
        <div class="form_register">
        
            <h1> <i class="fas fa-users"></i> Registro Usuario</h1>
            <hr>
            <div class="alert"> <?php echo isset($alert) ? $alert : ''; ?> </div>

            <form action="" method="post">
            
                <label for="nombre">Nombre</label>
                <input type="text"name="nombre" id="nombre" placeholder="Nombre Completo">
                <label for="correo">Correo electrónico</label>
                <input type="email" name="correo" placeholder="Correo electrónico">
                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" id="usuario" placeholder="Usuario">
                <label for="clave">Clave</label>
                <input type="password" name="clave" placeholder="Clave de acceso">
                <label for="rol">Tipo Usuario </label>
                
                <?php 
                include "../conexion.php";
                $query_rol = mysqli_query($conection,"SELECT * FROM rol");
                mysqli_close($conection);
                $result_rol = mysqli_num_rows($query_rol); //cuantas filas me esta devolviendo este query
                         
            

                ?>

                <select name="rol" id="rol">
                    <?php 
                    
                    if($result_rol > 0){
                        while($rol = mysqli_fetch_array($query_rol)){
                            ?> <option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"] ?></option>
                            <?php
                             
                        }
    
                    }
    
                    
                    ?>
                    
                    
                </select> 
                 
               <button type="submit" class="btn_save"> <i class="fas fa-save"></i> Crear Usuario</button>      
            
            </form>
        </div>
		
	</section>


	<?php include "includes/footer.php"; ?>
</body>
</html>
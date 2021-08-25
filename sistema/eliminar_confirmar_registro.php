<?php
session_start();

include "../conexion.php";
if(!empty($_POST)){
   
    $id_persona = $_POST['id_persona'];
    if(empty($_POST['id_persona'])){
        header("location: lista_beneficiarios.php");
        mysqli_close($conection);
    }
    $id_persona = $_POST['id_persona'];
    //$query_delete = mysqli_query($conection, "DELETE FROM usuario WHERE idusuario = $idusuario");
    $query_delete = mysqli_query($conection, "UPDATE registro_beneficiarios SET estatus = 0 WHERE id_persona = $id_persona");
    mysqli_close($conection);
    if($query_delete){
        header("location: lista_beneficiarios.php");
    }else{
        echo "Error al eliminar";
    }
}

if(empty($_REQUEST['id'])){
    header("location: lista_beneficiarios.php");
    mysqli_close($conection);
}else{
    
    $id_persona = $_REQUEST['id'];
    include "../conexion.php";
    $query = mysqli_query($conection,"SELECT * FROM registro_beneficiarios WHERE id_persona = $id_persona");
    mysqli_close($conection);
    $result = mysqli_num_rows($query);
    if($result>0){
        while($data = mysqli_fetch_array($query)){
            $primer_nombre = $data['primer_nombre'];
            $num_documento = $data['num_documento'];
            $primer_apellido = $data['primer_apellido'];
            $nivel_vulnerabilidad = $data['nivel_vulnerabilidad'];
            $vulnerabilidad = $data['vulnerabilidad'];

            
        }
    }else{
        header("location: lista_beneficiarios.php");
   
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Eliminar Registro</title>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section id="container">
		<div class="data_delete">
        <i class="fas fa-user-times fa-7x" style="color:#e66262"></i>
        <br>
        <br>
            <h2>¿Está seguro de eliminar el siguiente registro?</h2>
            <p>Nombre de la persona: <span><?php echo $primer_nombre . " ". $primer_apellido; ?></span></p>
            <p>Numero de documento: <span><?php echo $num_documento; ?></span></p>
            <p>Nivel de Vulnerabilidad: <span><?php echo $nivel_vulnerabilidad. " - ". $vulnerabilidad; ?></span></p>

            <form method ="post" action="">
                <input type="hidden" name="id_persona" value="<?php echo $id_persona; ?>">
                <a href="lista_beneficiarios.php" class="btn_cancel"> <i class="fas fa-ban"></i> Cancelar</a>
                <button type="submit" class="btn_ok"> <i class="far fa-trash-alt"></i> Eliminar</button>


            </form>
        </div>

		
	</section>


	<?php include "includes/footer.php"; ?>
</body>
</html>
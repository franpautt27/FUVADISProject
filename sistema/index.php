<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Sistema FUVADIS</title>
</head>

<body>
<?php 


	include "includes/header.php"; 
	include "../conexion.php";
	$sql_user = mysqli_query($conection, "SELECT COUNT(*) as total_users FROM usuario WHERE estatus = 1");
	$result_user = mysqli_fetch_array($sql_user);
	$total_users = $result_user['total_users'];


	$sql_register = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM registro_beneficiarios WHERE estatus = 1 AND atencion1 =1 ");
	$result_register = mysqli_fetch_array($sql_register);
	$total_registro = $result_register['total_registro'];

	$sql_route = mysqli_query($conection, "SELECT COUNT(*) as total_route FROM registro_beneficiarios WHERE estatus = 1 AND atencion1 !=1 ");
	$result_route = mysqli_fetch_array($sql_route);
	$total_route = $result_route['total_route'];
	mysqli_close($conection);

	
	
	?>
	<section id="container">
		<div class="divContainer">
			<div>
				<h1 class="titlePanelControl">Panel de control</h1>
			</div>
			<div class="dashboard">
				<a href="lista_beneficiarios.php" class="disabled">
				<i class="fas fa-user"></i>
				<p>
				<strong>Total de Usuarios</strong><br>
				<span><?php  echo $total_users; ?></span>

				</p>
				</a>
				<a href="lista_beneficiarios.php" class="disabled">
				<i class="fas fa-list-ul"></i>
				<p>
					<strong>Registros pendientes</strong><br>
					<span><?php  echo $total_registro; ?></span>

				</p>
				</a>
				<a href="lista_beneficiarios.php" class="disabled">
				<i class="fas fa-route"></i>
				<p>
					<strong>Rutas asignadas</strong><br>
					<span><?php  echo $total_route; ?></span>

				</p>
				</a>
				<a href="lista_beneficiarios.php" class="disabled">
				<i class="far fa-building"></i>
				<p>
					<strong>Sede</strong><br>
					<span>Barranquilla</span>

				</p>
				</a>
				<a href="lista_beneficiarios.php" class="disabled">
				<i class="fas fa-map-marker-alt"></i>
				<p>
					<strong>Puntos Focales</strong><br>
					<span>5</span>

				</p>
				</a>
			</div>
		</div>
		<div class="divInfoSistema">
			<div>
				<h1 class="titlePanelControl">Configuración</h1>
				<div class="containerPerfil">
					<div class="containerDataUser">
					<div class="logoUser">
						<img src="img/logoUser.png" >

					</div>
					<div class="divDataUser">
						<h4>Información personal</h4>
			
						<div>
							<label>Nombre:</label> <span> <?= $_SESSION['nombre']; ?> </span>
						</div>
						<div>
							<label>Correo:</label> <span><?= $_SESSION['email']; ?></span>
						</div>

						<h4>Datos usuario</h4>
						<div>
							<label>Rol:</label> <span><?= $_SESSION['rol_name']; ?></span>
						</div>
						<div>
							<label>Usuario:</label> <span><?= $_SESSION['user']; ?></span>
						</div>

						<h4>Cambiar contraseña</h4>
						<form action="" method="post" name="frmChangePass" id="frmChangePass">
							<div>
								<input type="password" name="txtPassUser" id="txtPassUser" placeholder="Contraseña actual" required>
							</div>
							<div>
								<input type="password" class="newPass" name="txtNewPassUser" id="txtNewPassUser" placeholder="Contraseña nueva" required>
							</div>
							<div>
								<input type="password" class="newPass" name="txtPassConfirm" id="txtPassConfirm" placeholder="Confirmar contraseña" required>
							</div>
							<div class="alertChangePass">
							
							</div>
							<div>
								<button type="submit" class="btn_save btnChangePass"> <i class="fas fa-key"></i> Cambiar Contraseña</button>
							</div>
							
						</form>



					</div>

					</div>
					<div class="containerDataEmpresa">
					<div class="logoUser">
						<img src="img/login22.png" >

					</div>
				
						<br>
						<h4>Misión</h4>
						<br>
						<p>La Fundación de Atención Inclusiva, Social y Humana, FUVADIS, es una organización de la sociedad civil sin ánimo de lucro, con carácter social que promueve los derechos humanos de la población en contexto de vulnerabilidad. La organización contribuye a la atención integral de la población que vive con VIH, LGBTI, personas que ejercen el trabajo sexual por supervivencia, migrantes venezolanos y colombianos retornados; junto con aliados estratégicos que permiten llegar a la población con necesidades específicas de protección.</p>
						<br>
						<br>
						<h4>Visión</h4>
						<br>
						<p>FUVADIS quiere ser reconocida en la costa caribe colombiana como una fundación de atención integral a población migrante venezolana y colombianos retornados, población LGBTI, personas que viven con VIH y trabajadores sexuales por supervivencia, sin cerrar la posibilidad de brindar atención a otra población, mejorando el acceso a derechos fundamentales y la calidad de vida de cada uno con un acompañamiento integral, fortaleciendo la estructura organizacional con profesionales en cada área las diferentes rutas de atención, con un acompañamiento de documentación y definición de procesos establecidos.</p>
					
					</div>
				</div>
			</div>
		</div>


	</section>


	<?php include "includes/footer.php"; ?>
</body>
</html>
<nav>
			<ul>
				<li><a href="index.php"> <i class="fas fa-home"></i> Inicio</a></li>
				<li class="principal">
				<?php if($_SESSION['rol'] == 1){

				?>

					<a href="#" > <i class="fas fa-users"></i> Usuarios</a>
					<ul>
						<li><a href="registro_usuario.php"> <i class="fas fa-user-plus"></i> Nuevo Usuario</a></li>
						<li><a href="lista_usuarios.php"> <i class="fas fa-user-tag"></i> Lista de Usuarios</a></li>
					</ul>
				</li>
				<?php } ?>
				<li class="principal">
					<a href="#"> <i class="fas fa-list-ul"></i> Registros</a>
					<ul>
						<li><a href="registro_beneficiario.php"> <i class="fas fa-plus-square"></i> Nuevo Registro</a></li>
						<li><a href="lista_beneficiarios.php"> <i class="fas fa-list-ul"></i> Lista de Registros</a></li>
					</ul>
				</li>
				<li class="principal">
					<a href="#"> <i class="fas fa-route"></i> Rutas de atención</a>
					<ul>
						<li><a href="lista_rutas.php"> <i class="fas fa-route"></i> Lista de Rutas asignadas</a></li>
					</ul>
				</li>
				<li class="principal">
					<a href="graficos.php"><i class="fas fa-chart-bar"></i> Dashboard</a>
				
			
				</li>
				<li class="principal">
					<a href="#"> <i class="fas fa-graduation-cap"></i> Aprendizaje</a>
					<ul>
						<li><a href="manual.php"> <i class="fas fa-book"></i> Manual de uso</a></li>
					</ul>
				</li>
			</ul>
		</nav>
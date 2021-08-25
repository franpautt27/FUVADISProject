<?php 
session_start();

include "../conexion.php";
    if(!empty($_POST)){
        $alert='';
        if(empty($_POST['atencion1']) || empty($_POST['atencion2']) || empty($_POST['atencion3']) || empty($_POST['remision']) || empty($_POST['observaciones']) ){
            $alert = '<p class="msg_error">Todos los campos son obligatorios<p/>';
        }else{
            
            $id_persona = $_POST['id'];

            $atencion1 = $_POST['atencion1'];
            $atencion2 = $_POST['atencion2'];
            $atencion3 = $_POST['atencion3'];
            $remision = $_POST['remision'];
            $observaciones = $_POST['observaciones'];
            
             

            
           
            $result = 0;
            if($result > 0){
                $alert = '<p class="msg_error">El correo o el usuario ya existen<p/>';
            }else{
              
                $sql_update = mysqli_query($conection, "UPDATE registro_beneficiarios SET atencion1 = '$atencion1', 
                                                            atencion2 = '$atencion2', atencion3 = '$atencion3', remision = '$remision',
                                                             observaciones = '$observaciones' WHERE id_persona = $id_persona");   
               

              
                if($sql_update){
                    $alert = '<p class="msg_save">Ruta asignada correctamente<p/>';
                }else{
                    $alert = '<p class="msg_error">Error al asignar la ruta de atención<p/>';
                }
            }
        }
    }
// mostrar datos
if(empty($_REQUEST['id'])){
    header('location: lista_beneficiarios.php');
    mysqli_close($conection);
}
$idregistro = $_REQUEST['id'];
include "../conexion.php";
$sql = mysqli_query($conection, "SELECT * FROM registro_beneficiarios  WHERE id_persona = $idregistro");
mysqli_close($conection);
$result_sql = mysqli_num_rows($sql);

if($result_sql == 0){
    header('location: lista_beneficiarios.php');

}else{

    while($data = mysqli_fetch_array($sql)){
        $id_persona = $data['id_persona'];
            $primer_nombre = $data['primer_nombre'];
            $segundo_nombre = $data['segundo_nombre'];
            $primer_apellido = $data['primer_apellido'];
            $segundo_apellido = $data['segundo_apellido'];
            $motivo1 = $data['motivo1'];
            $motivo2 = $data['motivo2'];
            $motivo3 = $data['motivo3'];
            $nacionalidad = $data['nacionalidad'];
            $variable_nacionalidad = $data['variable_nacionalidad'];
            $estatus_migratorio = $data['estatus_migratorio'];
            $variable_migratorio = $data['variable_migratorio'];
            $tipo_documento = $data['tipo_documento'];
            $num_documento = $data['num_documento'];
            $fecha_nacimiento = $data['fecha_nacimiento'];
            $genero = $data['genero'];
            $email = $data['email'];
            $forma_empleo = $data['forma_empleo'];
            $variable_empleo = $data['variable_empleo'];
            $rango_ingresos = $data['rango_ingresos'];
            $variable_ingresos = $data['variable_ingresos'];
            $num_comidas_dias = $data['num_comidas_dia'];
            $variable_comida = $data['variable_comida'];
            $lgbti = $data['lgbti'];
            $grupo = $data['grupo'];
            $variable_lgbti = $data['variable_lgbti'];
            $trabajo_sexual = $data['trabajo_sexual'];
            $variable_sexual = $data['variable_sexual'];
            $condicion_salud = $data['condicion_salud'];
            $variable_medica = $data['variable_medica'];
            $departamento = $data['departamento'];
            $municipio = $data['municipio'];
            $direccion = $data['direccion'];
            $barrio = $data['barrio'];
            $situacion_vivienda = $data['situacion_vivienda'];
            $variable_vivienda = $data['variable_vivienda'];
            $telefono = $data['telefono'];
            $telefono2 = $data['telefono2'];
            $n_family = $data['num_integrantes'];
            $variable_nucleo = $data['variable_nucleo'];
            $n_ninos = $data['num_ninos'];
            $variable_ninos = $data['variable_ninos'];
            $n_mayores = $data['num_adultos'];
            $variable_adultos = $data['variable_adultos'];
            $n_discapacitados = $data['num_discapacidad'];
            $variable_discapacidad = $data['variable_discapacidad'];
            $descripcion = $data['descripcion'];
            $n_gestantes = $data['num_gestantes'];
            $variable_gestantes = $data['variable_gestantes'];
            $edad = $data['edad'];
            $rango_edad = $data['rango_edad'];
            $nivel_vulnerabilidad = $data['nivel_vulnerabilidad'];
            $fecha_registro = $data['fecha_registro'];
            $necesidad1 = $data['necesidad1'];
            $necesidad2 = $data['necesidad2'];
            $necesidad3 = $data['necesidad3'];
            $necesidad4 = $data['necesidad4'];
            $vulnerabilidad = $data['vulnerabilidad'];

            

       
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Visualización Registros de vulnerabilidad</title>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section id="container">
		
        <div class="form_register2">
        
            <h1>Visualización Registros de Vulnerabilidad</h1>
            <hr>
            <div class="alert"> <?php echo isset($alert) ? $alert : ''; ?> </div>

            <form action="" method="post" class="formulario">
                <input type="hidden" name="id" value="<?php echo $id_persona;?>">
            <table id="space">            
            <tr>
                            <td>
                                                                
                    <label for ="primer_nombre">Primer nombre:</label> <br>
                <input type="text" name="primer_nombre" placeholder="Primer Nombre" value="<?php echo $primer_nombre;?>"  disabled> <br>
                <label for ="segundo_nombre">Segundo nombre: </label><br>
                <input type="text" name="segundo_nombre" placeholder="Segundo Nombre"  value="<?php echo $segundo_nombre;?>" disabled> <br>
                <label for ="primer_apellido">Primer apellido:</label> <br>
                <input type="text" name="primer_apellido" placeholder="Primer Apellido" value="<?php echo $primer_apellido;?>" disabled> <br>
                <label for ="segundo_apellido">Segundo apellido:</label> <br>
                <input type="text" name="segundo_apellido" placeholder="Segundo Apellido" value="<?php echo $segundo_apellido;?>" disabled> <br>
                <label for ="nacionalidad">Nacionalidad: 
                <input type="text" name="nacionalidad" value="<?php echo $nacionalidad;?>" disabled>
                <br>
                <label for ="variable_nacionalidad">Vulnerabilidad Nacionalidad:</label> <br>
                <input type="text" name="variable_nacionalidad" value="<?php echo $variable_nacionalidad*100 . "%";?>" disabled><br>
               
                <label for ="motivo1">Motivo de la consulta 1:</label> <br>
                <input type="text" name="motivo1" value="<?php echo $motivo1;?>" disabled><br>
                <label for ="motivo2">Motivo de la consulta 2:</label> <br>
                <input type="text" name="motivo2" value="<?php echo $motivo2;?>" disabled><br>
                <label for ="motivo3">Motivo de la consulta 3:</label> <br>
                <input type="text" name="motivo3" value="<?php echo $motivo3;?>" disabled><br>
                
               
                    
                               
                <label for ="estatus_migratorio">Estatus migratorio:</label>
                <input type="text" name="estatus_migratorio" value="<?php echo $estatus_migratorio;?>" disabled><br>
                <label for ="variable_migratorio">Vulnerabilidad Estatus Migratorio:</label> <br>
                <input type="text" name="variable_migratorio" value="<?php echo $variable_migratorio*100 . "%";?>" disabled><br>

                <label for ="tipo_documento">Tipo de documento:</label>
                <input type="text" name ="tipo_documento" value="<?php echo $tipo_documento;?>" disabled>
                 <br>
                <label for ="num_documento">Número de documento:</label>
                <input type="number" name= "num_documento" placeholder="Número de documento" value="<?php echo $num_documento;?>" disabled> <br>
                <label for ="fecha_nacimiento">Fecha de nacimiento:</label>
                <input type="date" name="fecha_nacimiento" value="<?php echo $fecha_nacimiento;?>" disabled> <br>
                <label for ="edad">Edad:</label> <br>
                <input type="text" name="edad" value="<?php echo $edad;?>" disabled><br>
                <label for ="rango_edad">Rango de Edad:</label> <br>
                <input type="text" name="rango_edad" value="<?php echo $rango_edad;?>" disabled><br>
                <label for ="genero">Género: </label>
                <input type="text" name="genero" value="<?php echo $genero;?>" disabled>
               <br>
                <label for ="email">Correo electrónico:
                <input type="email" name="email" id="email"   placeholder="Correo electrónico" value="<?php echo $email;?>" disabled> <br>
                <label for ="forma_empleo">Forma de empleo: </label>
                <input type="text" name="forma_empleo" value="<?php echo $forma_empleo;?>" disabled>
                <br>
                <label for ="variable_empleo">Vulnerablidad en el empleo:</label> <br>
                <input type="text" name="variable_empleo" value="<?php echo $variable_empleo*100 . "%";?>" disabled><br>

                <label for ="rango_ingresos">Rango de sus ingresos: </label>
                <input type="text" name="rango_ingresos" value="<?php echo $rango_ingresos;?>" disabled><br>
                <label for ="variable_ingresos">Vulnerabilidad Nivel de ingresos:</label> <br>             
                <input type="text" name="variable_ingresos" value="<?php echo $variable_ingresos*100 . "%";?>" disabled><br>

                <label for ="num_comidas_dias">Número de comidas que consume al día:</label>
                <input type="text" name="num_comidas_dias" value="<?php echo $num_comidas_dias;?>" disabled><br>
                <label for ="variable_comida">Vulnerabilidad Número de comidas al día:</label> <br>
                <input type="text" name="variable_comida" value="<?php echo $variable_comida*100 . "%";?>" disabled><br>
   
                
      
                   <label for ="lgbti">¿Pertenece usted a la población LGBTI?</label>
                   <div class="radio">
                       <?php if($lgbti=="Sí"){
                           ?>
                <input type="radio" name="lgbti" value="Sí"   id="si" checked disabled> 
                <label for="si">Sí</label> 
                <input type="radio" name="lgbti" value="No"   id="no" disabled> 
                <label for="no">No</label>
                <?php }else{?>
                    <input type="radio" name="lgbti" value="Sí"   id="si" disabled> 
                <label for="si">Sí</label> 
                <input type="radio" name="lgbti" value="No"   id="no" checked disabled> 
                <label for="no">No</label> <?php }?>
                </div>  <br>
                <label for ="variable_lgbti">Vulnerabilidad Poblacion LGBTI:</label> <br>
                <input type="text" name="variable_lgbti" value="<?php echo $variable_lgbti*100 . "%";?>" disabled><br>
                <label for ="grupo">Grupo poblacional o Condición de Vulnerabilidad: </label>
                <input type="text" name="grupo" value="<?php echo $grupo;?>" disabled>
                <br>
                </td>
                   <td>
                <label for ="trabajo_sexual">¿Ha ejercido usted el trabajo sexual como método de supervivencia?</label>
                <div class="radio">
                    <?php if($trabajo_sexual=="Sí"){ ?>
                <input type="radio" name="trabajo_sexual" value="Sí"   id="si2" checked disabled>
                <label for="si2">Sí</label> 
                <input type="radio" name="trabajo_sexual" value="No"   id="no2" disabled>
                <label for="no2">No</label>
                <?php }else{?>
                    <input type="radio" name="trabajo_sexual" value="Sí"   id="si2" disabled>
                <label for="si2">Sí</label> 
                <input type="radio" name="trabajo_sexual" value="No"   id="no2" checked disabled>
                <label for="no2">No</label> <?php }?>
                </div> <br>
               
                <label for ="variable_sexual">Vulnerabilidad Trabajo sexual:</label> <br>
                <input type="text" name="variable_sexual" value="<?php echo $variable_sexual*100 . "%";?>" disabled><br>

                <label for ="condicion_salud">¿Cuenta usted con alguna condición médica crítica de salud?</label>
                <input type="text" name="condicion_salud" value="<?php echo $condicion_salud;?>" disabled>
               <br>
               <label for ="variable_medica">Vulnerabilidad Condición de salud:</label> <br>
                <input type="text" name="variable_medica" value="<?php echo $variable_medica*100 . "%";?>" disabled><br>


               
                
                                                
                       
                <label for ="departamento">Departamento donde vive: </label>
                <input type="text" name="departamento" value="<?php echo $departamento;?>" disabled>
                <br>
                <label for ="municipio">Municipio donde vive:</label>
                <input type="text" name="municipio"  value="<?php echo $municipio;?>" disabled>
                 <br>
                <label for ="direccion">Dirección donde vive:</label>        
                <input type="text" name="direccion"   placeholder="Dirección" value="<?php echo $direccion;?>" disabled> <br>
                <label for ="barrio">Barrio o localidad a la que pertenece:</label>        
                <input type="text" name="barrio"   placeholder="Barrio o Localidad" value="<?php echo $barrio;?>" disabled> <br>
                <label for ="situacion_vivienda">Situación en la que habita:</label>
                <input type="text" name="situacion_vivienda" value="<?php echo $situacion_vivienda;?>" disabled><br>

                
               
                <label for ="telefono">Teléfono celular o fijo de contacto:</label>
                <input type="tel" id="telefono" name="telefono"   placeholder="Teléfono" value="<?php echo $telefono;?>" disabled> <br>
                <label for ="telefono2">Teléfono celular o fijo alterno:</label>
                <input type="tel" id="telefono2" name="telefono2" placeholder="Teléfono" value="<?php echo $telefono2;?>" disabled> <br>
                <label for ="n_family">Número de integrantes de su familia incluído usted:</label>
                <input type="range" name="num_family" class="slider" min="0" max="20" value="<?php echo $n_family;?>" oninput="n_family.value=this.value" disabled/>
                <input type="number" name="n_family" min="0" max="20" value="<?php echo $n_family;?>" oninput="num_family.value=this.value" disabled/> <br>
                <label for ="variable_nucleo">Vulnerabilidad Nucleo Familiar:</label> <br>
                <input type="text" name="variable_nucleo" value="<?php echo $variable_nucleo*100 . "%";?>" disabled><br>

                <label for ="n_ninos">Número de niños dentro del núcleo familiar:</label>
                <input type="range" name="num_ninos" class="slider" min="0" max="20" value="<?php echo $n_ninos;?>" oninput="n_ninos.value=this.value" disabled />
                <input type="number" name="n_ninos" min="0" max="20" value="<?php echo $n_ninos;?>" oninput="num_ninos.value=this.value" disabled/> <br>
                <label for ="variable_ninos">Vulnerabilidad Niños en el nucleo familiar:</label> <br>
                <input type="text" name="variable_ninos" value="<?php echo $variable_ninos*100 . "%";?>" disabled><br>

                <label for ="n_mayores">Número de adultos mayores dentro del núcleo familiar:</label>
                <input type="range" name="num_mayores" class="slider" min="0" max="20" value="<?php echo $n_mayores;?>" oninput="n_mayores.value=this.value" disabled/>
                <input type="number" name="n_mayores" min="0" max="20"value="<?php echo $n_mayores;?>" oninput="num_mayores.value=this.value" disabled/> <br>
                <label for ="variable_adultos">Vulnerabilidad Número de adultos mayores:</label> <br>
                <input type="text" name="variable_adultos" value="<?php echo $variable_adultos*100 . "%";?>" disabled><br>

                <label for ="n_gestantes">Número de mujeres gestantes o lactantes dentro del núcleo familiar:</label>
                <input type="range" name="num_gestantes" class="slider" min="0" max="20"value="<?php echo $n_gestantes;?>" oninput="n_gestantes.value=this.value" disabled/>
                <input type="number" name="n_gestantes" min="0" max="20" value="<?php echo $n_gestantes;?>" oninput="num_gestantes.value=this.value" disabled/> <br>
                <label for ="variable_gestantes">Vulnerabilidad Mujeres Gestantes:</label> <br>
                <input type="text" name="variable_gestantes" value="<?php echo $variable_gestantes*100 . "%";?>" disabled><br>

                
                <label for ="n_discapacitados">Número de personas con discapacidad dentro del núcleo familiar:</label>
                <input type="range" name="num_discapacitados" class="slider" min="0" max="20" value="<?php echo $n_discapacitados;?>" oninput="n_discapacitados.value=this.value" disabled />
                <input type="number" name="n_discapacitados" min="0" max="20"value="<?php echo $n_discapacitados;?>" oninput="num_discapacitados.value=this.value" disabled/> <br>
                <label for ="variable_discapacidad">Vulnerabilidad Discapacidad:</label> <br>
                <input type="text" name="variable_discapacidad" value="<?php echo $variable_discapacidad*100 . "%";?>" disabled><br>
                <label for ="necesidad1">¿Cuál es la primera necesidad que más se asocia con su situación?</label>
                <input type="text" id="necesidad1" name="necesidad1"  value="<?php echo $necesidad1;?>" disabled> <br>
                <label for ="necesidad2">¿Cuál es la segunda necesidad que más se asocia con su situación? (opcional)</label>
                <input type="text" id="necesidad2" name="necesidad2"  value="<?php echo $necesidad2;?>" disabled> <br>        
                <label for ="necesidad3">¿Cuál es la tercera necesidad que más se asocia con su situación? (opcional)</label>
                <input type="text" id="necesidad3" name="necesidad3"  value="<?php echo $necesidad3;?>" disabled> <br> 
                <label for ="necesidad4">¿Cuál es la cuarta necesidad que más se asocia con su situación? (opcional)</label>
                <input type="text" id="necesidad4" name="necesidad4"  value="<?php echo $necesidad4;?>" disabled> <br>           
                       
                </td>
                   <tr>
                   </table> 
                   <label for ="descripcion">Descripción del motivo por el cual consulta a FUVADIS:</label> <br>       
                <textarea class ="textarea1" disabled name="descripcion" id="descripcion" cols="100" rows="10"   placeholder="Descripción..."><?php echo $descripcion;?></textarea> <br>
                <br>
                <div class="hdos">Nivel de vulnerabilidad: <?php echo $nivel_vulnerabilidad." - ".$vulnerabilidad?></div><br>
                <br>
                <br>
                <h2 align="center" style="color:#3c93b0";>Ruta de atención</h2>
                <table id="space">            
            <tr>
                            <td>
                <label for ="atencion1">Principal atencion requerida: </label>           
                <select name="atencion1" required  >
                <option disabled selected value> -- seleccione una opcion -- </option>
                    <option value="Cuidado Infantil">Cuidado Infantil</option>
                    <option value="Manejo de casos (VSBG, proteccion infancia)">Manejo de casos (VSBG, proteccion infancia)</option>
                    <option value="Asesoria Legal">Asesoria Legal</option>
                    <option value="Seguridad Fisica (alojamiento seguro)">Seguridad Fisica (alojamiento seguro)</option>
                    <option value="Educacion">Educacion</option>
                    <option value="Salud">Salud</option>
                    <option value="Seguridad alimentaria">Seguridad alimentaria</option>
                    <option value="Alojamiento">Alojamiento</option>
                    <option value="Articulos de primeros auxilios">Articulos de primeros auxilios</option>
                    <option value="Asistencia en efectivo">Asistencia en efectivo</option>
                    <option value="Medios de vidaMedios de Vida">Medios de vidaMedios de Vida</option>
                    <option value="Medios de Vida">Medios de Vida</option>
                    <option value="Otro (continuidad en el tratamiento)">Otro (continuidad en el tratamiento)</option>
                    <option value="Busqueda o reunificación familiar">Busqueda o reunificación familiar</option>

                </select> <br>                
                <label for ="atencion2">Segunda atencion requerida: </label>           
                <select name="atencion2" required  >
                <option disabled selected value> -- seleccione una opcion -- </option>
                    <option value="Cuidado Infantil">Cuidado Infantil</option>
                    <option value="Manejo de casos (VSBG, proteccion infancia)">Manejo de casos (VSBG, proteccion infancia)</option>
                    <option value="Asesoria Legal">Asesoria Legal</option>
                    <option value="Seguridad Fisica (alojamiento seguro)">Seguridad Fisica (alojamiento seguro)</option>
                    <option value="Educacion">Educacion</option>
                    <option value="Salud">Salud</option>
                    <option value="Seguridad alimentaria">Seguridad alimentaria</option>
                    <option value="Alojamiento">Alojamiento</option>
                    <option value="Articulos de primeros auxilios">Articulos de primeros auxilios</option>
                    <option value="Asistencia en efectivo">Asistencia en efectivo</option>
                    <option value="Medios de vidaMedios de Vida">Medios de vidaMedios de Vida</option>
                    <option value="Medios de Vida">Medios de Vida</option>
                    <option value="Otro (continuidad en el tratamiento)">Otro (continuidad en el tratamiento)</option>
                    <option value="Busqueda o reunificación familiar">Busqueda o reunificación familiar</option>

                </select> <br>                

                </td>
                   <td>
                   <label for ="atencion3">Tercera atencion requerida: </label>           
                <select name="atencion3" required  >
                <option disabled selected value> -- seleccione una opcion -- </option>
                    <option value="Cuidado Infantil">Cuidado Infantil</option>
                    <option value="Manejo de casos (VSBG, proteccion infancia)">Manejo de casos (VSBG, proteccion infancia)</option>
                    <option value="Asesoria Legal">Asesoria Legal</option>
                    <option value="Seguridad Fisica (alojamiento seguro)">Seguridad Fisica (alojamiento seguro)</option>
                    <option value="Educacion">Educacion</option>
                    <option value="Salud">Salud</option>
                    <option value="Seguridad alimentaria">Seguridad alimentaria</option>
                    <option value="Alojamiento">Alojamiento</option>
                    <option value="Articulos de primeros auxilios">Articulos de primeros auxilios</option>
                    <option value="Asistencia en efectivo">Asistencia en efectivo</option>
                    <option value="Medios de vidaMedios de Vida">Medios de vidaMedios de Vida</option>
                    <option value="Medios de Vida">Medios de Vida</option>
                    <option value="Otro (continuidad en el tratamiento)">Otro (continuidad en el tratamiento)</option>
                    <option value="Busqueda o reunificación familiar">Busqueda o reunificación familiar</option>

                </select> <br>                
                <label for ="remision">Remision a:</label>
                <input type="text" name="remision" required >


                   </td>
                   <tr>
                   </table> 
                   <label for ="observaciones">Observaciones:</label> <br>       
                <textarea class ="textarea1"  name="observaciones" id="observaciones" cols="100" rows="10" placeholder="Observaciones..." required></textarea> <br>
                     
               
                <button type="submit" class="btn_save2"> <i class="fas fa-plus-square"></i> Asignar ruta</button>  
            </form>
        </div>
		
	</section>


	<?php include "includes/footer.php"; ?>
</body>
</html>
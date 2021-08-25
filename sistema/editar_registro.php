<?php 
session_start();

include "../conexion.php";
    if(!empty($_POST)){
        $alert='';
        if(empty($_POST['primer_nombre']) || empty($_POST['segundo_nombre']) || empty($_POST['primer_apellido']) || empty($_POST['segundo_apellido']) || empty($_POST['nacionalidad']) || empty($_POST['motivo1']) ||  empty($_POST['estatus_migratorio']) || empty($_POST['tipo_documento']) || empty($_POST['num_documento']) || empty($_POST['genero']) || empty($_POST['email']) || empty($_POST['forma_empleo']) || empty($_POST['fecha_nacimiento']) || empty($_POST['rango_ingresos']) || empty($_POST['num_comidas_dias']) || empty($_POST['lgbti']) || empty($_POST['trabajo_sexual']) || empty($_POST['condicion_salud']) || empty($_POST['departamento']) || empty($_POST['municipio']) || empty($_POST['direccion']) || empty($_POST['barrio']) || empty($_POST['situacion_vivienda']) || empty($_POST['telefono']) || empty($_POST['n_family'])    || empty($_POST['descripcion'])  || empty($_POST['necesidad1']) ){
            $alert = '<p class="msg_error">Todos los campos son obligatorios<p/>';
        }else{
            
            $id_persona = $_POST['id'];
            $primer_nombre = $_POST['primer_nombre'];
            $segundo_nombre = $_POST['segundo_nombre'];
            $primer_apellido = $_POST['primer_apellido'];
            $segundo_apellido = $_POST['segundo_apellido'];
            $motivo1 = $_POST['motivo1'];
            if(isset($_POST['motivo2'])){
                $motivo2 = $_POST['motivo2'];
            }else{
                $motivo2="";
            }
            if(isset($_POST['motivo3'])){
                $motivo3 = $_POST['motivo3'];
            }else{
                $motivo3="";
            }
         
            $nacionalidad = $_POST['nacionalidad'];
            $estatus_migratorio = $_POST['estatus_migratorio'];
            $tipo_documento = $_POST['tipo_documento'];
            $num_documento = $_POST['num_documento'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $genero = $_POST['genero'];
            $email = $_POST['email'];
            $forma_empleo = $_POST['forma_empleo'];
            $rango_ingresos = $_POST['rango_ingresos'];
            $num_comidas_dias = $_POST['num_comidas_dias'];
            $lgbti = $_POST['lgbti'];
            $grupo = $_POST['grupo'];
            $trabajo_sexual = $_POST['trabajo_sexual'];
            $condicion_salud = $_POST['condicion_salud'];
            $departamento = $_POST['departamento'];
            $municipio = $_POST['municipio'];
            $direccion = $_POST['direccion'];
            $barrio = $_POST['barrio'];
            $situacion_vivienda = $_POST['situacion_vivienda'];
            $telefono = $_POST['telefono'];
            if(isset($_POST['telefono2'])){
                $telefono2 = $_POST['telefono2'];
            }else{
                $telefono2="";
            }
            $descripcion = $_POST['descripcion'];
            $necesidad1 = $_POST['necesidad1'];
            if(isset($_POST['n_ninos'])){
                $n_ninos = $_POST['n_ninos'];
            }else{
                $n_ninos=0;
            }
            if(isset($_POST['n_mayores'])){
                $n_mayores = $_POST['n_mayores'];
            }else{
                $n_mayores=0;
            }
            if(isset($_POST['n_discapacitados'])){
                $n_discapacitados = $_POST['n_discapacitados'];
            }else{
                $n_discapacitados=0;
            }
            if(isset($_POST['n_gestantes'])){
                $n_gestantes = $_POST['n_gestantes'];
            }else{
                $n_gestantes=0;
            }

            function obtener_edad_segun_fecha($fecha_nac)
            {
                $nacimiento = new DateTime($fecha_nac);
                $ahora = new DateTime(date("d-m-Y"));
                $diferencia = $ahora->diff($nacimiento);
                return $diferencia->format("%y");
            }
            $edad = obtener_edad_segun_fecha($fecha_nacimiento);

            if($edad <= 11){
                $rango_edad = "Menor a 11 años";
            }elseif($edad <= 17){
                $rango_edad = "De 12 a 17 años";
            }elseif($edad<= 30){
                $rango_edad = "De 18 a 30 años";
            }elseif($edad <= 59){
                $rango_edad = "De 31 a 59 años";

            }else{
                $rango_edad = "Mayor a 60 años";
            }

            if(isset($_POST['n_family'])){
                $n_family = $_POST['n_family'];
            }else{
                $n_family=0;
            }
            if(isset($_POST['necesidad2'])){
                $necesidad2 = $_POST['necesidad2'];
            }else{
                $necesidad2="";
            }
            if(isset($_POST['necesidad3'])){
                $necesidad3 = $_POST['necesidad3'];
            }else{
                $necesidad3="";
            }
            if(isset($_POST['necesidad4'])){
                $necesidad4 = $_POST['necesidad4'];
            }else{
                $necesidad4="";
            }
           
            if($nacionalidad=="Venezolana"){
                $variable_nacionalidad=1.0;
    
            }else{
                $variable_nacionalidad=0.25;
            }
    
            if($estatus_migratorio=="Irregular"){
                $variable_migratorio = 1.0;
            }else{
                $variable_migratorio = 0.25;
            }
    
            if($lgbti=="Sí"){
                $variable_lgbti = 1.0;
            }else{
                $variable_lgbti=0;
            }
    
            if($forma_empleo=="Formal"){
                $variable_empleo = 0.5; 
            }else{
                $variable_empleo = 1.0;
            }
    
            if($rango_ingresos=="Menor a 500,000 al mes"){
                $variable_ingresos = 1.0;
            }elseif($rango_ingresos=="Entre 500,000 y 800,000 al mes"){
                $variable_ingresos = 0.75;
    
            }else{
                $variable_ingresos = 0.5;
            }
    
            if($num_comidas_dias=="Una"){
                $variable_comida = 1.0;
            }elseif($num_comidas_dias == "Dos"){
                $variable_comida=0.75;
            }elseif($num_comidas_dias == "Tres"){
                $variable_comida = 0.5;
            }else{
                $variable_comida=0.25;
            }
    
            if($trabajo_sexual=="Sí"){
                $variable_sexual = 1.0;
            }else{
                $variable_sexual=0;
            }
    
            if($condicion_salud=="VIH"){
                $variable_medica = 1.0;
            }else{
                $variable_medica=0;
            }
    
            if($situacion_vivienda=="Situación de calle" or $situacion_vivienda=="Alojamiento humanitario"){
                $variable_vivienda = 1.0;
            }elseif($situacion_vivienda=="En arrimo"){
                $variable_vivienda=0.5;
            }elseif($situacion_vivienda =="Arrendado"){
                $variable_vivienda=0.25;
            }else{
                $variable_vivienda=0;
            }
    
            if($n_family==1){
                $variable_nucleo = 1;
            }else{
                $variable_nucleo = 0;
            }
            if($n_ninos>=1){
                $variable_ninos = 1;
            }else{
                $variable_ninos=0;
            }
            if($n_mayores>=1){
                $variable_adultos=1;
            }else{
                $variable_adultos=0;
            }
            if($n_gestantes>=1){
                $variable_gestantes=1;
            }else{
                $variable_gestantes=0;
            }
            if($n_discapacitados>=1){
                $variable_discapacidad = 1;   
            }else{
                $variable_discapacidad=0;
            }
    
            $suma_variables = $variable_adultos+$variable_comida+$variable_discapacidad+$variable_empleo+$variable_gestantes+$variable_ingresos+$variable_lgbti+$variable_medica+$variable_migratorio+$variable_nacionalidad+$variable_ninos+$variable_nucleo+$variable_sexual+$variable_vivienda;
            $porcentaje = $suma_variables/14;
    
            if($porcentaje<0.29){
                $nivel_vulnerabilidad = 1;
            }elseif($porcentaje<=0.45){
                $nivel_vulnerabilidad=2;
            }elseif($porcentaje<=0.59){
                $nivel_vulnerabilidad=3;
            }elseif($porcentaje<=0.81){
                $nivel_vulnerabilidad=4;
            }elseif($porcentaje==0.82){
                $nivel_vulnerabilidad = 5;
            }else{
                $nivel_vulnerabilidad=6;
            }

            if($nivel_vulnerabilidad==1){
                $vulnerabilidad = "NULA VULNERABILIDAD";
            }elseif ($nivel_vulnerabilidad==2) {
                $vulnerabilidad = "BAJA VULNERABILIDAD";

            }elseif ($nivel_vulnerabilidad==3) {
                $vulnerabilidad = "POCA VULNERABILIDAD";

            }elseif ($nivel_vulnerabilidad==4) {
                $vulnerabilidad = "MEDIA VULNERABILIDAD";
            }elseif ($nivel_vulnerabilidad ==5) {
                $vulnerabilidad="ALTA VULNERABILIDAD";
            }else {
                $vulnerabilidad="EXTREMA VULNERABILIDAD";
            }

            
            
            
            
            $result=0;    
            $query = mysqli_query($conection, "SELECT * FROM registro_beneficiarios WHERE num_documento = '$num_documento' AND tipo_documento = '$tipo_documento' AND id_persona != '$id_persona' ");
         
            $result = mysqli_fetch_array($query);
            $result = count((array) $result);
            if($result > 0){
                $alert = '<p class="msg_error">El número del documento ya existe<p/>';
            }else{
               
                    $sql_update = mysqli_query($conection, "UPDATE registro_beneficiarios SET primer_nombre ='$primer_nombre',
                    segundo_nombre = '$segundo_nombre',
                   primer_apellido = '$primer_apellido',
                   segundo_apellido = '$segundo_apellido',
                   motivo1 = '$motivo1',
                   motivo2 = '$motivo2',
                   motivo3 = '$motivo3',
                   nacionalidad = '$nacionalidad',
                   variable_nacionalidad = '$variable_nacionalidad',
                   estatus_migratorio = '$estatus_migratorio',
                   variable_migratorio = '$variable_migratorio',
                   tipo_documento = '$tipo_documento',
                   num_documento = '$num_documento',
                   fecha_nacimiento = '$fecha_nacimiento',
                   genero = '$genero',
                   email = '$email',
                   forma_empleo = '$forma_empleo',
                   variable_empleo='$variable_empleo',
                   rango_ingresos = '$rango_ingresos',
                   variable_ingresos = '$variable_ingresos',
                   num_comidas_dia = '$num_comidas_dias',
                   variable_comida = '$variable_comida',
                   lgbti ='$lgbti',
                   grupo = '$grupo',
                   variable_lgbti = '$variable_lgbti',
                   trabajo_sexual='$trabajo_sexual',
                   variable_sexual='$variable_sexual',
                   condicion_salud='$condicion_salud',
                   variable_medica = '$variable_medica',
                   departamento = '$departamento',
                   municipio = '$municipio',
                   direccion = '$direccion',
                   barrio = '$barrio',
                   situacion_vivienda = '$situacion_vivienda',
                   variable_vivienda = '$variable_vivienda',
                   telefono = '$telefono',
                   telefono2 = '$telefono2',
                   num_integrantes='$n_family',
                   variable_nucleo = '$variable_nucleo',
                   num_ninos = '$n_ninos',
                   variable_ninos = '$variable_ninos',
                   num_adultos='$n_mayores',
                   variable_adultos = '$variable_adultos',
                   num_gestantes='$n_gestantes',
                   variable_gestantes='$variable_gestantes',
                   num_discapacidad='$n_discapacitados',
                   variable_discapacidad='$variable_discapacidad',
                   nivel_vulnerabilidad='$nivel_vulnerabilidad',
                   descripcion='$descripcion', 
                   necesidad1='$necesidad1',
                   necesidad2='$necesidad2',
                   necesidad3='$necesidad3',
                   necesidad4='$necesidad4', edad='$edad', vulnerabilidad='$vulnerabilidad', rango_edad='$rango_edad'  
                                                                 WHERE id_persona = $id_persona");   

                
                if($sql_update==true){
                    $alert = '<p class="msg_save">Registro actualizado correctamente<p/>';
                }else{
                    $alert = '<p class="msg_error">Error al actualizar el registro<p/>';
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
            $estatus_migratorio = $data['estatus_migratorio'];
            $tipo_documento = $data['tipo_documento'];
            $num_documento = $data['num_documento'];
            $fecha_nacimiento = $data['fecha_nacimiento'];
            $genero = $data['genero'];
            $email = $data['email'];
            $forma_empleo = $data['forma_empleo'];
            $rango_ingresos = $data['rango_ingresos'];
            $num_comidas_dias = $data['num_comidas_dia'];
            $lgbti = $data['lgbti'];
            $trabajo_sexual = $data['trabajo_sexual'];
            $condicion_salud = $data['condicion_salud'];
            $departamento = $data['departamento'];
            $municipio = $data['municipio'];
            $direccion = $data['direccion'];
            $barrio = $data['barrio'];
            $situacion_vivienda = $data['situacion_vivienda'];
            $telefono = $data['telefono'];
            $telefono2 = $data['telefono2'];
            $n_family = $data['num_integrantes'];
            $n_ninos = $data['num_ninos'];
            $n_mayores = $data['num_adultos'];
            $n_discapacitados = $data['num_discapacidad'];
            $descripcion = $data['descripcion'];
            $n_gestantes = $data['num_gestantes'];
            $necesidad1 = $data['necesidad1'];
            $necesidad2 = $data['necesidad2'];
            $necesidad3 = $data['necesidad3'];
            $necesidad4 = $data['necesidad4'];
            
       
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizacion Registros de vulnerabilidad</title>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section id="container">
		
        <div class="form_register2">
        
            <h1>Actualizar Registros de Vulnerabilidad</h1>
            <hr>
            <div class="alert"> <?php echo isset($alert) ? $alert : ''; ?> </div>

            <form action="" method="post" class="formulario">
                <input type="hidden" name="id" value="<?php echo $id_persona;?>">
            <table id="space">            
            <tr>
                            <td>
                                                                
                    <label for ="primer_nombre">Primer nombre:</label> <br>
                <input type="text" name="primer_nombre" placeholder="Primer Nombre" value="<?php echo $primer_nombre;?>" > <br>
                <label for ="segundo_nombre">Segundo nombre: </label><br>
                <input type="text" name="segundo_nombre" placeholder="Segundo Nombre"  value="<?php echo $segundo_nombre;?>"> <br>
                <label for ="primer_apellido">Primer apellido:</label> <br>
                <input type="text" name="primer_apellido" placeholder="Primer Apellido" value="<?php echo $primer_apellido;?>" > <br>
                <label for ="segundo_apellido">Segundo apellido:</label> <br>
                <input type="text" name="segundo_apellido" placeholder="Segundo Apellido" value="<?php echo $segundo_apellido;?>" > <br>
                <label for ="nacionalidad">Nacionalidad: 
                <select name="nacionalidad" >
                <?php if($nacionalidad=="Colombiana"){?>
                    <option value="Colombiana" selected>Colombiana</option>
                    <option value="Venezolana">Venezolana</option>
                    <option value="Otra">Otra</option>
                    <?php }elseif($nacionalidad=="Venezolana"){?>
                        <option value="Colombiana">Colombiana</option>
                    <option value="Venezolana" selected>Venezolana</option>
                    <option value="Otra">Otra</option>
                    <?php }else{?>
                        <option value="Colombiana">Colombiana</option>
                    <option value="Venezolana">Venezolana</option>
                    <option value="Otra" selected>Otra</option><?php }?>

                </select> <br>
                <label for ="motivo1">Motivo de la consulta 1:</label>
                <select name="motivo1" >
                <?php if($motivo1 == "Orientación Migratoria"){ ?>
                    <option value="Orientación Migratoria" selected>Orientación Migratoria</option>
                    <option value="Acceso a salud">Acceso a salud</option>
                    <option value="Acceso a nacionalidad/registraduria">Acceso a nacionalidad/registraduria</option>
                    <option value="SISBEN">SISBEN</option>
                    <option value="Medios de vida/Empleabilidad">Medios de vida/Empleabilidad</option>
                    <option value="Protección fisica/albergue">Protección fisica/albergue</option>
                    <option value="Alimentacion">Alimentación</option>
                    <?php }elseif($motivo1 == "Acceso a salud"){ ?>
                    <option value="Orientación Migratoria" >Orientación Migratoria</option>
                    <option value="Acceso a salud" selected>Acceso a salud</option>
                    <option value="Acceso a nacionalidad/registraduria">Acceso a nacionalidad/registraduria</option>
                    <option value="SISBEN">SISBEN</option>
                    <option value="Medios de vida/Empleabilidad">Medios de vida/Empleabilidad</option>
                    <option value="Protección fisica/albergue">Protección fisica/albergue</option>
                    <option value="Alimentacion">Alimentación</option>
                    <?php }elseif($motivo1== "Acceso a nacionalidad/registraduria"){?>
                    <option value="Orientación Migratoria" >Orientación Migratoria</option>
                    <option value="Acceso a salud">Acceso a salud</option>
                    <option value="Acceso a nacionalidad/registraduria" selected>Acceso a nacionalidad/registraduria</option>
                    <option value="SISBEN">SISBEN</option>
                    <option value="Medios de vida/Empleabilidad">Medios de vida/Empleabilidad</option>
                    <option value="Protección fisica/albergue">Protección fisica/albergue</option>
                    <option value="Alimentacion">Alimentación</option>
                    <?php }elseif($motivo1=="SISBEN"){?>
                        <option value="Orientación Migratoria" >Orientación Migratoria</option>
                    <option value="Acceso a salud">Acceso a salud</option>
                    <option value="Acceso a nacionalidad/registraduria">Acceso a nacionalidad/registraduria</option>
                    <option value="SISBEN" selected>SISBEN</option>
                    <option value="Medios de vida/Empleabilidad">Medios de vida/Empleabilidad</option>
                    <option value="Protección fisica/albergue">Protección fisica/albergue</option>
                    <option value="Alimentacion">Alimentación</option>
                    <?php }elseif($motivo1=="Medios de vida/Empleabilidad"){?>
                        <option value="Orientación Migratoria" >Orientación Migratoria</option>
                    <option value="Acceso a salud">Acceso a salud</option>
                    <option value="Acceso a nacionalidad/registraduria">Acceso a nacionalidad/registraduria</option>
                    <option value="SISBEN">SISBEN</option>
                    <option value="Medios de vida/Empleabilidad" selected>Medios de vida/Empleabilidad</option>
                    <option value="Protección fisica/albergue">Protección fisica/albergue</option>
                    <option value="Alimentacion">Alimentación</option>
                    <?php }elseif($motivo1=="Protección fisica/albergue"){?>
                        <option value="Orientación Migratoria" >Orientación Migratoria</option>
                    <option value="Acceso a salud">Acceso a salud</option>
                    <option value="Acceso a nacionalidad/registraduria">Acceso a nacionalidad/registraduria</option>
                    <option value="SISBEN">SISBEN</option>
                    <option value="Medios de vida/Empleabilidad">Medios de vida/Empleabilidad</option>
                    <option value="Protección fisica/albergue" selected>Protección fisica/albergue</option>
                    <option value="Alimentacion">Alimentación</option>
                    <?php }else{?>
                        <option value="Orientación Migratoria" >Orientación Migratoria</option>
                    <option value="Acceso a salud">Acceso a salud</option>
                    <option value="Acceso a nacionalidad/registraduria">Acceso a nacionalidad/registraduria</option>
                    <option value="SISBEN">SISBEN</option>
                    <option value="Medios de vida/Empleabilidad">Medios de vida/Empleabilidad</option>
                    <option value="Protección fisica/albergue">Protección fisica/albergue</option>
                    <option value="Alimentacion" selected>Alimentación</option><?php }?>

                    
                </select> <br>
                </select> <br>
                <label for ="motivo2">Motivo de la consulta 2:</label> 
                <select name="motivo2" >
                <?php if($motivo2 == "Orientación Migratoria"){ ?>
                    <option value="Orientación Migratoria" selected>Orientación Migratoria</option>
                    <option value="Acceso a salud">Acceso a salud</option>
                    <option value="Acceso a nacionalidad/registraduria">Acceso a nacionalidad/registraduria</option>
                    <option value="SISBEN">SISBEN</option>
                    <option value="Medios de vida/Empleabilidad">Medios de vida/Empleabilidad</option>
                    <option value="Protección fisica/albergue">Protección fisica/albergue</option>
                    <option value="Alimentacion">Alimentación</option>
                    <?php }elseif($motivo2 == "Acceso a salud"){ ?>
                    <option value="Orientación Migratoria" >Orientación Migratoria</option>
                    <option value="Acceso a salud" selected>Acceso a salud</option>
                    <option value="Acceso a nacionalidad/registraduria">Acceso a nacionalidad/registraduria</option>
                    <option value="SISBEN">SISBEN</option>
                    <option value="Medios de vida/Empleabilidad">Medios de vida/Empleabilidad</option>
                    <option value="Protección fisica/albergue">Protección fisica/albergue</option>
                    <option value="Alimentacion">Alimentación</option>
                    <?php }elseif($motivo2== "Acceso a nacionalidad/registraduria"){?>
                    <option value="Orientación Migratoria" >Orientación Migratoria</option>
                    <option value="Acceso a salud">Acceso a salud</option>
                    <option value="Acceso a nacionalidad/registraduria" selected>Acceso a nacionalidad/registraduria</option>
                    <option value="SISBEN">SISBEN</option>
                    <option value="Medios de vida/Empleabilidad">Medios de vida/Empleabilidad</option>
                    <option value="Protección fisica/albergue">Protección fisica/albergue</option>
                    <option value="Alimentacion">Alimentación</option>
                    <?php }elseif($motivo2=="SISBEN"){?>
                        <option value="Orientación Migratoria" >Orientación Migratoria</option>
                    <option value="Acceso a salud">Acceso a salud</option>
                    <option value="Acceso a nacionalidad/registraduria">Acceso a nacionalidad/registraduria</option>
                    <option value="SISBEN" selected>SISBEN</option>
                    <option value="Medios de vida/Empleabilidad">Medios de vida/Empleabilidad</option>
                    <option value="Protección fisica/albergue">Protección fisica/albergue</option>
                    <option value="Alimentacion">Alimentación</option>
                    <?php }elseif($motivo2=="Medios de vida/Empleabilidad"){?>
                        <option value="Orientación Migratoria" >Orientación Migratoria</option>
                    <option value="Acceso a salud">Acceso a salud</option>
                    <option value="Acceso a nacionalidad/registraduria">Acceso a nacionalidad/registraduria</option>
                    <option value="SISBEN">SISBEN</option>
                    <option value="Medios de vida/Empleabilidad" selected>Medios de vida/Empleabilidad</option>
                    <option value="Protección fisica/albergue">Protección fisica/albergue</option>
                    <option value="Alimentacion">Alimentación</option>
                    <?php }elseif($motivo2=="Protección fisica/albergue"){?>
                        <option value="Orientación Migratoria" >Orientación Migratoria</option>
                    <option value="Acceso a salud">Acceso a salud</option>
                    <option value="Acceso a nacionalidad/registraduria">Acceso a nacionalidad/registraduria</option>
                    <option value="SISBEN">SISBEN</option>
                    <option value="Medios de vida/Empleabilidad">Medios de vida/Empleabilidad</option>
                    <option value="Protección fisica/albergue" selected>Protección fisica/albergue</option>
                    <option value="Alimentacion">Alimentación</option>
                    <?php }else{?>
                        <option value="Orientación Migratoria" >Orientación Migratoria</option>
                    <option value="Acceso a salud">Acceso a salud</option>
                    <option value="Acceso a nacionalidad/registraduria">Acceso a nacionalidad/registraduria</option>
                    <option value="SISBEN">SISBEN</option>
                    <option value="Medios de vida/Empleabilidad">Medios de vida/Empleabilidad</option>
                    <option value="Protección fisica/albergue">Protección fisica/albergue</option>
                    <option value="Alimentacion" selected>Alimentación</option><?php }?>
                </select> <br>
                </select> <br>
                <label for ="motivo3">Motivo de la consulta 3:</label>
                <select name="motivo3">

               <?php if($motivo3 == "Orientación Migratoria"){ ?>
                    <option value="Orientación Migratoria" selected>Orientación Migratoria</option>
                    <option value="Acceso a salud">Acceso a salud</option>
                    <option value="Acceso a nacionalidad/registraduria">Acceso a nacionalidad/registraduria</option>
                    <option value="SISBEN">SISBEN</option>
                    <option value="Medios de vida/Empleabilidad">Medios de vida/Empleabilidad</option>
                    <option value="Protección fisica/albergue">Protección fisica/albergue</option>
                    <option value="Alimentacion">Alimentación</option>
                    <?php }elseif($motivo3 == "Acceso a salud"){ ?>
                    <option value="Orientación Migratoria" >Orientación Migratoria</option>
                    <option value="Acceso a salud" selected>Acceso a salud</option>
                    <option value="Acceso a nacionalidad/registraduria">Acceso a nacionalidad/registraduria</option>
                    <option value="SISBEN">SISBEN</option>
                    <option value="Medios de vida/Empleabilidad">Medios de vida/Empleabilidad</option>
                    <option value="Protección fisica/albergue">Protección fisica/albergue</option>
                    <option value="Alimentacion">Alimentación</option>
                    <?php }elseif($motivo3== "Acceso a nacionalidad/registraduria"){?>
                    <option value="Orientación Migratoria" >Orientación Migratoria</option>
                    <option value="Acceso a salud">Acceso a salud</option>
                    <option value="Acceso a nacionalidad/registraduria" selected>Acceso a nacionalidad/registraduria</option>
                    <option value="SISBEN">SISBEN</option>
                    <option value="Medios de vida/Empleabilidad">Medios de vida/Empleabilidad</option>
                    <option value="Protección fisica/albergue">Protección fisica/albergue</option>
                    <option value="Alimentacion">Alimentación</option>
                    <?php }elseif($motivo3=="SISBEN"){?>
                        <option value="Orientación Migratoria" >Orientación Migratoria</option>
                    <option value="Acceso a salud">Acceso a salud</option>
                    <option value="Acceso a nacionalidad/registraduria">Acceso a nacionalidad/registraduria</option>
                    <option value="SISBEN" selected>SISBEN</option>
                    <option value="Medios de vida/Empleabilidad">Medios de vida/Empleabilidad</option>
                    <option value="Protección fisica/albergue">Protección fisica/albergue</option>
                    <option value="Alimentacion">Alimentación</option>
                    <?php }elseif($motivo3=="Medios de vida/Empleabilidad"){?>
                        <option value="Orientación Migratoria" >Orientación Migratoria</option>
                    <option value="Acceso a salud">Acceso a salud</option>
                    <option value="Acceso a nacionalidad/registraduria">Acceso a nacionalidad/registraduria</option>
                    <option value="SISBEN">SISBEN</option>
                    <option value="Medios de vida/Empleabilidad" selected>Medios de vida/Empleabilidad</option>
                    <option value="Protección fisica/albergue">Protección fisica/albergue</option>
                    <option value="Alimentacion">Alimentación</option>
                    <?php }elseif($motivo3=="Protección fisica/albergue"){?>
                        <option value="Orientación Migratoria" >Orientación Migratoria</option>
                    <option value="Acceso a salud">Acceso a salud</option>
                    <option value="Acceso a nacionalidad/registraduria">Acceso a nacionalidad/registraduria</option>
                    <option value="SISBEN">SISBEN</option>
                    <option value="Medios de vida/Empleabilidad">Medios de vida/Empleabilidad</option>
                    <option value="Protección fisica/albergue" selected>Protección fisica/albergue</option>
                    <option value="Alimentacion">Alimentación</option>
                    <?php }else{?>
                        <option value="Orientación Migratoria" >Orientación Migratoria</option>
                    <option value="Acceso a salud">Acceso a salud</option>
                    <option value="Acceso a nacionalidad/registraduria">Acceso a nacionalidad/registraduria</option>
                    <option value="SISBEN">SISBEN</option>
                    <option value="Medios de vida/Empleabilidad">Medios de vida/Empleabilidad</option>
                    <option value="Protección fisica/albergue">Protección fisica/albergue</option>
                    <option value="Alimentacion" selected>Alimentación</option><?php }?>
                </select> <br>
                
                <label for ="estatus_migratorio">Estatus migratorio:</label>

                <select name="estatus_migratorio" >
                    <?php if($estatus_migratorio=="Regular"){?>
                    <option value="Regular" selected>Regular</option>
                    <option value="Irregular">Irregular</option>
                    <option value="Otra">Otra</option>
                    <?php }elseif($estatus_migratorio=="Irregular"){?>
                    <option value="Regular" >Regular</option>
                    <option value="Irregular" selected>Irregular</option>
                    <option value="Otra">Otra</option>
                    <?php }else{?>
                    <option value="Regular" selected>Regular</option>
                    <option value="Irregular">Irregular</option>
                    <option value="Otra">Otra</option><?php }?>
                </select> <br>
                <label for ="tipo_documento">Tipo de documento:</label>
                <input type="text" name ="tipo_documento" value="<?php echo $tipo_documento;?>">
                 <br>
                <label for ="num_documento">Número de documento:</label>
                <input type="number" name= "num_documento" placeholder="Número de documento" value="<?php echo $num_documento;?>"> <br>
                <label for ="fecha_nacimiento">Fecha de nacimiento:</label>
                <input type="date" name="fecha_nacimiento" value="<?php echo $fecha_nacimiento;?>"> <br>
                <label for ="genero">Género: </label>
                <input type="text" name="genero" value="<?php echo $genero;?>">
               <br>
                <label for ="email">Correo electrónico:
                <input type="email" name="email" id="email"   placeholder="Correo electrónico" value="<?php echo $email;?>"> <br>
                <label for ="forma_empleo">Forma de empleo: </label>
                <input type="text" name="forma_empleo" value="<?php echo $forma_empleo;?>">
                <br>
                <label for ="rango_ingresos">Rango de sus ingresos: </label>
                <select name="rango_ingresos"  value="<?php echo $rango_ingresos;?>">
                <?php if($rango_ingresos== "Menor a 500,000 al mes"){ ?>
                    <option value="Menor a 500,000 al mes" selected>Menor a 500,000 al mes</option>
                    <option value="Entre a 500,000 y 800,000 al mes">Entre 500,000 y 800,000 al mes</option>
                    <option value="Mayor a 800,000 al mes">Mayor a 800,000 al mes</option>
                    <?php }elseif($rango_ingresos=="Entre a 500,000 y 800,000 al mes"){?>
                        <option value="Menor a 500,000 al mes">Menor a 500,000 al mes</option>
                    <option value="Entre a 500,000 y 800,000 al mes" selected>Entre 500,000 y 800,000 al mes</option>
                    <option value="Mayor a 800,000 al mes">Mayor a 800,000 al mes</option>
                    <?php }else{?>
                        <option value="Menor a 500,000 al mes">Menor a 500,000 al mes</option>
                    <option value="Entre a 500,000 y 800,000 al mes">Entre 500,000 y 800,000 al mes</option>
                    <option value="Mayor a 800,000 al mes" selected>Mayor a 800,000 al mes</option><?php }?>
                </select> <br>
                <label for ="num_comidas_dias">Número de comidas que consume al día:</label>
                <select name="num_comidas_dias" value="<?php echo $num_comidas_dias;?>" >
                <?php if($num_comidas_dias=="Una"){ ?>
                    <option value="Una" selected>Una</option>
                    <option value="Dos">Dos</option>
                    <option value="Tres">Tres</option>
                    <option value="Cuatro o más">Cuatro o más</option>
                    <?php }elseif($num_comidas_dias=="Dos"){?>
                        <option value="Una">Una</option>
                    <option value="Dos" selected>Dos</option>
                    <option value="Tres">Tres</option>
                    <option value="Cuatro o más">Cuatro o más</option>
                    <?php }elseif($num_comidas_dias=="Tres"){?>
                        <option value="Una">Una</option>
                    <option value="Dos">Dos</option>
                    <option value="Tres" selected>Tres</option>
                    <option value="Cuatro o más">Cuatro o más</option>
                    <?php }else{?>
                        <option value="Una">Una</option>
                    <option value="Dos">Dos</option>
                    <option value="Tres">Tres</option>
                    <option value="Cuatro o más" selected>Cuatro o más</option><?php }?>
                </select> <br>
                
                   <label for ="lgbti">¿Pertenece usted a la población LGBTI?</label>
                   <div class="radio">
                       <?php if($lgbti=="Sí"){
                           ?>
                <input type="radio" name="lgbti" value="Sí"   id="si" checked> 
                <label for="si">Sí</label> 
                <input type="radio" name="lgbti" value="No"   id="no"> 
                <label for="no">No</label>
                <?php }else{?>
                    <input type="radio" name="lgbti" value="Sí"   id="si"> 
                <label for="si">Sí</label> 
                <input type="radio" name="lgbti" value="No"   id="no" checked> 
                <label for="no">No</label> <?php }?>
                </div>  <br>
                
                <label for ="grupo">Grupo poblacional o Condición de Vulnerabilidad:</label><br> 
                 <select name="grupo"  required>
                     <?php if($grupo == "Padre Cabeza de familia"){ ?>
                
                    <option value="Padre Cabeza de familia" selected>Padre Cabeza de familia</option>
                    <option value="Colombiano retornado">Colombiano retornado</option>
                    <option value="Madre Cabeza de familia">Madre Cabeza de familia</option>
                    <option value="Población de acogida">Población de acogida</option>
                    <option value="Adulto mayor">Adulto mayor</option>
                     <?php }elseif($grupo == "Colombiano retornado"){ ?>
                
                    <option value="Padre Cabeza de familia">Padre Cabeza de familia</option>
                    <option value="Colombiano retornado" selected>Colombiano retornado</option>
                    <option value="Madre Cabeza de familia">Madre Cabeza de familia</option>
                    <option value="Población de acogida">Población de acogida</option>
                    <option value="Adulto mayor">Adulto mayor</option>
                     <?php }elseif($grupo == "Madre Cabeza de familia"){ ?>
                
                    <option value="Padre Cabeza de familia">Padre Cabeza de familia</option>
                    <option value="Colombiano retornado">Colombiano retornado</option>
                    <option value="Madre Cabeza de familia" selected>Madre Cabeza de familia</option>
                    <option value="Población de acogida">Población de acogida</option>
                    <option value="Adulto mayor">Adulto mayor</option>
                     <?php }elseif($grupo == "Población de acogida"){ ?>
                
                    <option value="Padre Cabeza de familia" selected>Padre Cabeza de familia</option>
                    <option value="Colombiano retornado">Colombiano retornado</option>
                    <option value="Madre Cabeza de familia">Madre Cabeza de familia</option>
                    <option value="Población de acogida" selected>Población de acogida</option>
                    <option value="Adulto mayor">Adulto mayor</option>
                     <?php }else{ ?>
                
                    <option value="Padre Cabeza de familia" selected>Padre Cabeza de familia</option>
                    <option value="Colombiano retornado">Colombiano retornado</option>
                    <option value="Madre Cabeza de familia">Madre Cabeza de familia</option>
                    <option value="Población de acogida">Población de acogida</option>
                    <option value="Adulto mayor" selected>Adulto mayor</option><?php } ?>
                </select> <br>
                
                <label for ="trabajo_sexual">¿Ha ejercido usted el trabajo sexual como método de supervivencia?</label>
                <div class="radio">
                    <?php if($trabajo_sexual=="Sí"){ ?>
                <input type="radio" name="trabajo_sexual" value="Sí"   id="si2" checked>
                <label for="si2">Sí</label> 
                <input type="radio" name="trabajo_sexual" value="No"   id="no2">
                <label for="no2">No</label>
                <?php }else{?>
                    <input type="radio" name="trabajo_sexual" value="Sí"   id="si2">
                <label for="si2">Sí</label> 
                <input type="radio" name="trabajo_sexual" value="No"   id="no2" checked>
                <label for="no2">No</label> <?php }?>
                </div> <br>
                </td>
                   <td>
                <label for ="condicion_salud">¿Cuenta usted con alguna condición médica crítica de salud?</label>
                <input type="text" name="condicion_salud" value="<?php echo $condicion_salud;?>">
               <br>
               
                
                                                
                       
                <label for ="departamento">Departamento donde vive: </label>
                <input type="text" name="departamento" value="<?php echo $departamento;?>">
                <br>
                <label for ="municipio">Municipio donde vive:</label>
                <input type="text" name="municipio"  value="<?php echo $municipio;?>">
                 <br>
                <label for ="direccion">Dirección donde vive:</label>        
                <input type="text" name="direccion"   placeholder="Dirección" value="<?php echo $direccion;?>"> <br>
                <label for ="barrio">Barrio o localidad a la que pertenece:</label>        
                <input type="text" name="barrio"   placeholder="Barrio o Localidad" value="<?php echo $barrio;?>"> <br>
                <label for ="situacion_vivienda">Situación en la que habita:</label>
                
                <select name="situacion_vivienda" value="<?php echo $situacion_vivienda;?>"  >
                    <?php if($situacion_vivienda=="Casa propia"){ ?>
                    <option value="Casa propia" selected>Casa propia</option>
                    <option value="Arrendado">Arrendado</option>
                    <option value="En arrimo">En arrimo</option>
                    <option value="Alojamiento humanitario">Alojamiento humanitario</option>
                    <option value="Situación de calle">Situación de calle</option>
                        <?php }elseif($situacion_vivienda=="Arrendado"){ ?>
                            <option value="Casa propia" selected>Casa propia</option>
                    <option value="Arrendado" selected>Arrendado</option>
                    <option value="En arrimo">En arrimo</option>
                    <option value="Alojamiento humanitario">Alojamiento humanitario</option>
                    <option value="Situación de calle">Situación de calle</option>
                    <?php }elseif($situacion_vivienda=="En arrimo"){ ?>
                        <option value="Casa propia" >Casa propia</option>
                    <option value="Arrendado">Arrendado</option>
                    <option value="En arrimo" selected>En arrimo</option>
                    <option value="Alojamiento humanitario">Alojamiento humanitario</option>
                    <option value="Situación de calle">Situación de calle</option>
                    <?php }elseif($situacion_vivienda=="Alojamiento humanitario"){ ?>
                        <option value="Casa propia" >Casa propia</option>
                    <option value="Arrendado">Arrendado</option>
                    <option value="En arrimo">En arrimo</option>
                    <option value="Alojamiento humanitario" selected>Alojamiento humanitario</option>
                    <option value="Situación de calle">Situación de calle</option>
                    <?php }else{?>
                        <option value="Casa propia" >Casa propia</option>
                    <option value="Arrendado">Arrendado</option>
                    <option value="En arrimo">En arrimo</option>
                    <option value="Alojamiento humanitario">Alojamiento humanitario</option>
                    <option value="Situación de calle" selected>Situación de calle</option><?php }?>
                
                
                
                
                </select> <br>
                <label for ="telefono">Teléfono celular o fijo de contacto:</label>
                <input type="tel" id="telefono" name="telefono"   placeholder="Teléfono" value="<?php echo $telefono;?>"> <br>
                <label for ="telefono2">Teléfono celular o fijo alterno:</label>
                <input type="tel" id="telefono2" name="telefono2" placeholder="Teléfono" value="<?php echo $telefono2;?>"> <br>
                <label for ="n_family">Número de integrantes de su familia incluído usted:</label>
                <input type="range" name="num_family" class="slider" min="0" max="20" value="<?php echo $n_family;?>" oninput="n_family.value=this.value" />
                <input type="number" name="n_family" min="0" max="20" value="<?php echo $n_family;?>" oninput="num_family.value=this.value" /> <br>
                <label for ="n_ninos">Número de niños dentro del núcleo familiar:</label>
                <input type="range" name="num_ninos" class="slider" min="0" max="20" value="<?php echo $n_ninos;?>" oninput="n_ninos.value=this.value" />
                <input type="number" name="n_ninos" min="0" max="20" value="<?php echo $n_ninos;?>" oninput="num_ninos.value=this.value" /> <br>
                <label for ="n_mayores">Número de adultos mayores dentro del núcleo familiar:</label>
                <input type="range" name="num_mayores" class="slider" min="0" max="20" value="<?php echo $n_mayores;?>" oninput="n_mayores.value=this.value" />
                <input type="number" name="n_mayores" min="0" max="20"value="<?php echo $n_mayores;?>" oninput="num_mayores.value=this.value" /> <br>
                <label for ="n_gestantes">Número de mujeres gestantes o lactantes dentro del núcleo familiar:</label>
                <input type="range" name="num_gestantes" class="slider" min="0" max="20"value="<?php echo $n_gestantes;?>" oninput="n_gestantes.value=this.value" />
                <input type="number" name="n_gestantes" min="0" max="20" value="<?php echo $n_gestantes;?>" oninput="num_gestantes.value=this.value" /> <br>
                
                <label for ="n_discapacitados">Número de personas con discapacidad dentro del núcleo familiar:</label>
                <input type="range" name="num_discapacitados" class="slider" min="0" max="20" value="<?php echo $n_discapacitados;?>" oninput="n_discapacitados.value=this.value" />
                <input type="number" name="n_discapacitados" min="0" max="20"value="<?php echo $n_discapacitados;?>" oninput="num_discapacitados.value=this.value" /> <br>
                <label for ="necesidad1">¿Cuál es la primera necesidad que más se asocia con su situación?</label>
                <input type="text" id="necesidad1" name="necesidad1"  value="<?php echo $necesidad1;?>"> <br>    
                <label for ="necesidad2">¿Cuál es la segunda necesidad que más se asocia con su situación? (opcional)</label>
                <input type="text" id="necesidad2" name="necesidad2"  value="<?php echo $necesidad2;?>"> <br>  
                <label for ="necesidad3">¿Cuál es la tercera necesidad que más se asocia con su situación? (opcional)</label>
                <input type="text" id="necesidad3" name="necesidad3"  value="<?php echo $necesidad3;?>"> <br>       
                <label for ="necesidad4">¿Cuál es la cuarta necesidad que más se asocia con su situación? (opcional)</label>
                <input type="text" id="necesidad4" name="necesidad4"  value="<?php echo $necesidad4;?>"> <br>    
                </td>
                   <tr>
                   </table> 
                   <label for ="descripcion">Descripción del motivo por el cual consulta a FUVADIS:</label> <br>       
                <textarea class ="textarea1" name="descripcion" id="descripcion" cols="100" rows="10"   placeholder="Descripción..."><?php echo $descripcion;?></textarea> <br>
                
               
                <input type="submit" value="Actualizar" class="btn_save2">   
            </form>
        </div>
		
	</section>


	<?php include "includes/footer.php"; ?>
</body>
</html>
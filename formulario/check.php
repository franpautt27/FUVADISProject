<link href="styles/style3.css" rel="stylesheet" type="text/css">

<?php 

if(empty($_POST['primer_nombre'])){
        header("location: index.php");
    }else{

    
    $host = 'remotemysql.com';
    $user = 'uqWABkc0vc';
    $pass = 'WXSkZXVx1f';
    $db = 'uqWABkc0vc';
    $conectar = @mysqli_connect($host,$user,$pass,$db);
// verificamos la conexion
        if(!$conectar){
            echo "No se pudo conectar con el servidor";
        }else{
            $base = mysqli_select_db($conectar, $db);
            if(!$base){
                echo "No se encontró la base de datos";
            }
        }

        // recuperar las variables
        $primer_nombre = $_POST['primer_nombre'];
        $segundo_nombre = $_POST['segundo_nombre'];
        $primer_apellido = $_POST['primer_apellido'];
        $segundo_apellido = $_POST['segundo_apellido'];
        $motivo1 = $_POST['motivo1'];
        if(isset($_POST['motivo2'])){
            $motivo2 = $_POST['motivo2'];
        }else{
            $motivo2=0;
        }
        if(isset($_POST['motivo3'])){
            $motivo3 = $_POST['motivo3'];
        }else{
            $motivo3=0;
        }
     
        $nacionalidad = $_POST['nacionalidad'];
        $estatus_migratorio = $_POST['estatus_migratorio'];
        $tipo_documento = $_POST['tipo_documento'];
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
            $telefono2=0;
        }
        if(isset($_POST['num_documento'])){
            $num_documento = $_POST['num_documento'];
        }else{
            $num_documento=0;
        }
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
        if(isset($_POST['n_family'])){
            $n_family = $_POST['n_family'];
        }else{
            $n_family=0;
        }
        if(isset($_POST['n_gestantes'])){
            $n_gestantes = $_POST['n_gestantes'];
        }else{
            $n_gestantes=0;
        }
        $descripcion = $_POST['descripcion'];
        $necesidad1 = $_POST['necesidad1'];
        if(isset($_POST['necesidad2'])){
            $necesidad2 = $_POST['necesidad2'];
        }else{
            $necesidad2=0;
        }
        if(isset($_POST['necesidad3'])){
            $necesidad3 = $_POST['necesidad3'];
        }else{
            $necesidad3=0;
        }
        if(isset($_POST['necesidad4'])){
            $necesidad4 = $_POST['necesidad4'];
        }else{
            $necesidad4=0;
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
        


        // hacemos la sentencia de sql
       $sql = "INSERT INTO registro_beneficiarios(primer_nombre,
       segundo_nombre,
      primer_apellido,
      segundo_apellido,
      motivo1,
      motivo2,
      motivo3,
      nacionalidad,
      variable_nacionalidad,
      estatus_migratorio,
      variable_migratorio,
      tipo_documento,
      num_documento,
      fecha_nacimiento,
      genero,
      email,
      forma_empleo,
      variable_empleo,
      rango_ingresos,
      variable_ingresos,
      num_comidas_dia,
      variable_comida,
      lgbti,
      variable_lgbti,
      grupo,
      trabajo_sexual,
      variable_sexual,
      condicion_salud,
      variable_medica,
      departamento,
      municipio,
      direccion,
      barrio,
      situacion_vivienda,
      variable_vivienda,
      telefono,
      telefono2,
      num_integrantes,
      variable_nucleo,
      num_ninos,
      variable_ninos,
      num_adultos,
      variable_adultos,
      num_gestantes,
      variable_gestantes,
      num_discapacidad,
      variable_discapacidad,
      nivel_vulnerabilidad,
      descripcion, 
      necesidad1,
      necesidad2,
      necesidad3,
      necesidad4, edad, vulnerabilidad, rango_edad) VALUES('$primer_nombre',
       '$segundo_nombre',
       '$primer_apellido',
       '$segundo_apellido', 
      '$motivo1',
      '$motivo2',
      '$motivo3',
       '$nacionalidad',
       '$variable_nacionalidad',
       '$estatus_migratorio',
       '$variable_migratorio',
       '$tipo_documento',
       '$num_documento',
       '$fecha_nacimiento',
      '$genero',
      '$email',
       '$forma_empleo',
       '$variable_empleo',
        '$rango_ingresos',
        '$variable_ingresos',
        '$num_comidas_dias',
        '$variable_comida',
        '$lgbti',
        '$variable_lgbti',
        '$grupo',
        '$trabajo_sexual',
        '$variable_sexual',
        '$condicion_salud',
        '$variable_medica',
      '$departamento',
      '$municipio',
      '$direccion',
      '$barrio ',
      '$situacion_vivienda',
      '$variable_vivienda',
      '$telefono',
      '$telefono2',
      '$n_family',
      '$variable_nucleo',
      '$n_ninos',
      '$variable_ninos',
      '$n_mayores',
      '$variable_adultos',
      '$n_gestantes',
      '$variable_gestantes',
      '$n_discapacitados',
      '$variable_discapacidad',
      '$nivel_vulnerabilidad',
      '$descripcion',
       '$necesidad1',
       '$necesidad2',
       '$necesidad3',
       '$necesidad4','$edad', '$vulnerabilidad','$rango_edad')";
        
        //ejecutamos la sentencia SQL
        $ejecutar = mysqli_query($conectar,$sql);
        mysqli_close($conectar);
        if(!$ejecutar){
            echo "hubo un error";
        }else{
            echo "<h2>Gracias por llenar el formulario, nos contactaremos con usted lo más pronto posible.</h2> <br><a href='index.php'>Volver</a>";
        } 
    }




?>
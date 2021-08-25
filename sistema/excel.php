<?php 
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename= archivo.xls");
?>

<table>
    <tr>
        <th>Fecha de registro</th>
        <th>ID</th>
        <th>Primer Nombre</th>
        <th>Segundo Nombre</th>
        <th>Primer Apellido</th>
        <th>Segundo Apellido</th>
        <th>Primer Motivo</th>
        <th>Segundo Motivo</th>
        <th>Tercer Motivo</th>
        <th>Nacionalidad</th>
        <th>Edad</th>
        <th>Rango de Edad</th>
        <th>Estatus Migratorio</th>
        <th>Tipo de Documento</th>
        <th>Número de documento</th>
        <th>Fecha de nacimiento</th>
        <th>Genero</th>
        <th>Email</th>
        <th>Forma de empleo</th>
        <th>Rango de ingresos</th>
        <th>Numero de comidas al dia</th>
        <th>LGBTI</th>
        <th>Trabajo sexual</th>
        <th>Condicion de salud</th>
        <th>Departamento</th>
        <th>Municipio</th>
        <th>Direccion</th>
        <th>barrio</th>
        <th>situacion de vivienda</th>
        <th>Telefono</th>
        <th>Segundo telefono</th>
        <th>Numero de integrantes grupo familiar</th>
        <th>Numero de ninos grupo familiar</th>
        <th>Numero de discapacitados grupo familiar</th>
        <th>Descripcion</th>
        <th>Nivel de vulnerabilidad</th>
    <tr/>
    
<?php 
include("../conexion.php");

$ejecutar = mysqli_query($conection, "SELECT fecha_registro, id_persona, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, motivo1, motivo2, motivo3, nacionalidad, edad, rango_edad, estatus_migratorio, tipo_documento, num_documento, fecha_nacimiento, genero, email, forma_empleo, rango_ingresos, num_comidas_dia, lgbti, trabajo_sexual, condicion_salud, departamento, municipio, direccion, barrio, situacion_vivienda, telefono, telefono2, num_integrantes, num_ninos, num_discapacidad, descripcion, vulnerabilidad FROM registro_beneficiarios WHERE estatus=1");
while($fila = mysqli_fetch_array($ejecutar)){
    
    
    ?>
    <tr>
        <td><?php echo $fila[0] ?></td>
        <td><?php echo $fila[1] ?></td>
        <td><?php echo $fila[2] ?></td>
        <td><?php echo $fila[3] ?></td>
        <td><?php echo $fila[4] ?></td>
        <td><?php echo $fila[5] ?></td>
        <td><?php echo $fila[6] ?></td>
        <td><?php echo $fila[7] ?></td>
        <td><?php echo $fila[8] ?></td>
        <td><?php echo $fila[9] ?></td>
        <td><?php echo $fila[10] ?></td>
        <td><?php echo $fila[11] ?></td>
        <td><?php echo $fila[12] ?></td>
        <td><?php echo $fila[13] ?></td>
        <td><?php echo $fila[14] ?></td>
        <td><?php echo $fila[15] ?></td>
        <td><?php echo $fila[16] ?></td>
        <td><?php echo $fila[17] ?></td>
        <td><?php echo $fila[18] ?></td>
        <td><?php echo $fila[19] ?></td>
        <td><?php echo $fila[20] ?></td>
        <td><?php echo $fila[21] ?></td>
        <td><?php echo $fila[22] ?></td>
        <td><?php echo $fila[23] ?></td>
        <td><?php echo $fila[24] ?></td>
        <td><?php echo $fila[25] ?></td>
        <td><?php echo $fila[26] ?></td>
        <td><?php echo $fila[27] ?></td>
        <td><?php echo $fila[28] ?></td>
        <td><?php echo $fila[29] ?></td>
        <td><?php echo $fila[30] ?></td>
        <td><?php echo $fila[31] ?></td>
        <td><?php echo $fila[32] ?></td>
        <td><?php echo $fila[33] ?></td>
        <td><?php echo $fila[34] ?></td>
        <td><?php echo $fila[35] ?></td>
        
    <tr/>
<?php
}
?>
<table/>




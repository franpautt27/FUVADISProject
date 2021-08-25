<?php 
    session_start();
 
    include "../conexion.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Rutas de atención</title>
</head>
<body>
<?php include "includes/header.php"; ?>
	<section id="container">
		
        <h1> <i class="fas fa-route"></i> Rutas de atención</h1>
        <a href="lista_beneficiarios.php" class="btn_new"> <i class="fas fa-eye"></i> Ver Registros</a>

        <form action="buscar_ruta.php" method = "get" class="form_search">
        <input type="text" name="busqueda" id="busqueda" placeholder = "Buscar">
        <button type="submit" class="btn_search"><i class="fas fa-search"></i></button>
        
        </form>
        <table>
        
            <tr>
                <th>Fecha creación</th>
                <th>Nombre</th>
                <th>Atencion requerida</th>

                <th>Nivel de Vulnerabilidad</th>
                <th>Remision</th>

                <th>Acciones</th>
            </tr>

            <?php 
            // paginador
            $sql_register = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM registro_beneficiarios WHERE estatus = 1 AND atencion1 != '1' ");
            $result_register = mysqli_fetch_array($sql_register);
            $total_registro = $result_register['total_registro'];

            $por_pagina =10; //aqui se muestran 5 registros por pagina

            if(empty($_GET['pagina'])){
                $pagina=1;
            }else{
                $pagina=$_GET['pagina'];
            }
            $desde = ($pagina-1) * $por_pagina;
            $total_paginas= ceil($total_registro/$por_pagina);
                $query = mysqli_query($conection, "SELECT id_persona, primer_nombre, primer_apellido, atencion1, nivel_vulnerabilidad, vulnerabilidad, remision, DATE_SUB(fecha_registro, INTERVAL 5 HOUR) AS fecha_creacion FROM registro_beneficiarios WHERE estatus = '1' AND atencion1 !='1' ORDER BY id_persona DESC LIMIT $desde,$por_pagina");
                mysqli_close($conection);
                $result = mysqli_num_rows($query);
                if($result>0){
                    while($data = mysqli_fetch_array($query)){
                        
                        ?>
                        <tr>
                            <td><?php echo $data["fecha_creacion"]; ?></td>
                            <td><?php echo $data["primer_nombre"] . " " . $data["primer_apellido"]; ?></td>
                            <td><?php echo $data["atencion1"]; ?></td>
                            <td><?php echo $data["nivel_vulnerabilidad"]." - ".$data["vulnerabilidad"]; ?></td>
                            <td><?php echo $data["remision"]; ?></td>

                            <td>
                                <a class="link_edit" href="editar_ruta.php?id=<?php echo $data["id_persona"]; ?>"> <i class="far fa-edit"></i> Editar</a> |
                                
                                    <a class="link_delete" href="eliminar_confirmar_ruta.php?id=<?php echo $data["id_persona"]; ?>"> <i class="far fa-trash-alt"></i> Eliminar</a> |
                                    <a class="link_ver" href="ver_ruta.php?id=<?php echo $data["id_persona"]; ?>"> <i class="fas fa-eye"></i> Ver</a>

                                 
                                                               
                                
                                
                            </td>
                        </tr>
                   <?php }
                }
            ?>
        </table>
        <div class="paginador">
                <ul>
                   <?php 
                        if($pagina != 1){
                            
                        
                    ?>
                    <li><a href="?pagina=<?php echo 1;?>"><i class="fas fa-step-backward"></i></a></li>
                    <li><a href="?pagina=<?php echo $pagina-1;?>"><i class="fas fa-backward"></i></a></li>
                    <?php 
                    }
                    for($i=1; $i <= $total_paginas; $i++){
                        if($i == $pagina){
                            echo ' <li class="pageSelected">'.$i.'</li>'; 
                        }else{
                        echo ' <li><a href="?pagina='.$i.'">'.$i.'</a></li>';
                    }
                } 
                if($pagina!=$total_paginas){

                
                    ?>
                    
                                      
                    
                    <li><a href="?pagina=<?php echo $pagina+1;?>"><i class="fas fa-forward"></i></a></li>
                    <li><a href="?pagina=<?php echo $total_paginas;?>"><i class="fas fa-step-forward"></i></a></li>
                <?php } ?>
                </ul>
        
        </div>

		
	</section>


	<?php include "includes/footer.php"; ?>
</body>
</html>
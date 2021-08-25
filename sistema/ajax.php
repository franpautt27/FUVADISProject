<?php 
include "../conexion.php";
session_start();

if(!empty($_POST)){


    if($_POST['action']=='changePassword'){
        if(!empty($_POST['passActual']) && !empty($_POST['passNuevo'])){
            $password = md5($_POST['passActual']);
            $newPass = md5($_POST['passNuevo']);
            $idUser = $_SESSION['idUser'];

            $code = '';
            $msg = '';
            $arrData = array();

            $query_user = mysqli_query($conection, "SELECT * FROM usuario 
                                                    WHERE clave = '$password' AND idusuario = $idUser");
            $result = mysqli_num_rows($query_user);
            if($result>0){
                $query_update = mysqli_query($conection, "UPDATE usuario SET clave = '$newPass' WHERE idusuario = $idUser ");
                mysqli_close($conection);

                if($query_update){
                    $code = '00';
                    $msg = "Su contraseña se ha actualizado con éxito";
                }else{
                    $code = '2';
                    $msg = "No es posible cambiar su contraseña";
                }
            }else{
                $code = '1';
                $msg = "La contraseña actual es incorrecta";
            }
            $arrData = array('cod' => $code, 'msg' => $msg);
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);

        }else{
            echo "error";
        }
        exit;
    }

}
exit;


?>
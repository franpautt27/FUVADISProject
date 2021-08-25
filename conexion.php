<?php 

$host = 'remotemysql.com';
$user_con = 'uqWABkc0vc';
$password_con = 'WXSkZXVx1f';
$db = 'uqWABkc0vc';

$conection = @mysqli_connect($host,$user_con, $password_con, $db);

//mysqli_close($conection);

if(!$conection){
    echo "Error en la conexion";

}

?>
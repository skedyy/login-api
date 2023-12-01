<?php
class API {
    function login(){
        $postemail = $_POST['email'];
    $postpass = $_POST['password'];
        $id=null;
        $user=null;
        $password=null;
        $email=null;
        $registerdate=null;
        $conexion=mysqli_connect("DB_HOST","DB_USER","DB_PASSWORD","DB_NAME");
        $users= array();
        $consulta= mysqli_prepare($conexion, "SELECT id,user,password,email,registerdate FROM users WHERE email='$postemail' AND password='$postpass'");
        mysqli_stmt_execute($consulta);
        mysqli_stmt_bind_result($consulta, $id, $user, $password, $email, $registerdate);

        while($outputdata = mysqli_stmt_fetch($consulta)){
            $users = array(
                'id' => $id,
                'user' => $user,
                'password' => $password,
                'email' => $email,
                'registerdate' => $registerdate
            );
        }
        return json_encode($users);
    }
}
$API = new API;
header('Content-Type: application/json');
echo $API->login();
?>
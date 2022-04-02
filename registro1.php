<?php
include('config.php');
session_start();
$username = $_POST['usuario'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_hash = password_hash($password, PASSWORD_BCRYPT);

$query = $conn->prepare("SELECT * FROM  usuario WHERE email=:email");
$query-> bindParam("email",$email, PDO::PARAM_STR);
$query-> execute();
if ($query->rowCount()>0) {
    echo "El correo electronico o Email ya esta en uso.";
    
}
if ($query ->rowCount()==0) {
    $query = $conn->prepare("INSERT INTO  usuario(username, password,email) VALUES(:usuario, :password_hast, :email)");
    $query -> bindParam("usuario",$username, PDO::PARAM_STR);
    $query -> bindParam("password_hast",$password_hast, PDO::PARAM_STR);
    $query -> bindParam("email",$email, PDO::PARAM_STR);
    $resultado= $query->execute();
    if ($resultado) {
        echo"Registro exitoso";
    }else{
    echo"Fallo al momento de guardar";
    }
}
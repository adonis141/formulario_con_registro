<?php
include('config.php');
session_start();
$username = $_POST['usuario'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_hash = password_hash($password, PASSWORD_BCRYPT);

$query = $conn->prepare("SELECT * FROM usuarios WHERE email =:email");
$query->bindParam("email", $email, PDO::PARAM_STR);
$query->execute();
if ($query->rowCount() > 0) {
    echo "El Correo esta registrado";
}
if ($query->rowCount() == 0) {
    $query = $conn->prepare("INSERT INTO usuarios(username,password,email) VALUES (:username,:password_hash,:email)");
    $query->bindParam("username", $username, PDO::PARAM_STR);
    $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
    $query->bindParam("email", $email, PDO::PARAM_STR);
    $result = $query->execute();
    if ($result) {
        echo " Registro exitoso";
    } else {
        echo "Registro fallido";
    }
}

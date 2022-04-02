<?php
include('config.php');
session_start();

$username = $_POST['usuario'];
$password = $_POST['password'];

$query = $conn->prepare("SELECT * FROM clientes WHERE username = :username");
$query->bindParam("username", $username, PDO::PARAM_STR);
$query->execute();

$result = $query->fetch(PDO::FETCH_ASSOC);
if (!$result) {
    echo '¡La combinación de nombre de usuario y contraseña es incorrecta!';
} else {
    if (password_verify($password, $result['PASSWORD'])) {
        echo '¡Felicitaciones, estás registrado!';
    } else {
        echo '¡La combinación de nombre de usuario y contraseña es incorrecta!';
    }
}

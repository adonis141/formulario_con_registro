<?php
include('config.php');
session_start();
$name = $_POST['nombre'];
$dir = $_POST['direccion'];
$telf = $_POST['telefono'];
$dui = $_POST['dui'];

$query = $conn->prepare("SELECT * FROM clientes WHERE Nombres =:nombre");
$query->bindParam("nombre", $name, PDO::PARAM_STR);
$query->execute();
if ($query->rowCount() > 0) {
    echo "El nombre ya esta registrado";
}
if ($query->rowCount() == 0) {
    $query = $conn->prepare("INSERT INTO clientes(Nombres,Direccion,Telefono, DUI) VALUES (:nombre,:direccion,:telefono,:dui)");
    $query->bindParam("nombre", $name, PDO::PARAM_STR);
    $query->bindParam("direccion", $dir, PDO::PARAM_STR);
    $query->bindParam("telefono", $telf);
    $query->bindParam("dui", $dui, PDO::PARAM_STR);
    $result = $query->execute();
    if ($result) {
        echo " Registro exitoso";
    } else {
        echo "Registro fallido";
    }
}

<?php

include('database.php');
include('user.php');

$errors = [];

$email = isset($_POST['email']) ? $_POST['email'] : '';
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$renovacion = isset($_POST['renovacion']) ? 'si' : 'no';
$proyecto = isset($_POST['proyecto']) ? $_POST['proyecto'] : '';
$experiencia = isset($_POST['experiencia']) ? $_POST['experiencia'] : '';
$status = isset($_POST['status']) ? $_POST['status'] : '';
$fechaIN = isset($_POST['fechain']) ? $_POST['fechain'] : '';
$fechaOUT = isset($_POST['fechaout']) ? $_POST['fechaout'] : '';
$ubicacion = isset($_POST['ubicacion']) ? $_POST['ubicacion'] : '';
$permisos = isset($_POST['permisos']) ? $_POST['permisos'] : '';
$coordinador = isset($_POST['coordinador']) ? $_POST['coordinador'] : '';
$observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : 'No hay observaciones pendientes';
$conocimientos = isset($_POST['conocimientos']) ? $_POST['conocimientos'] : '';

if (empty($nombre)) {$errors[] = "El nombre es obligatorio.";}
if (empty($proyecto)) {$proyecto = null;}
if (empty($renovacion)) {$renovacion = null;}
if (empty($email)) {$errors[] = "El correo electrónico es obligatorio.";}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {$errors[] = "El email es inválido";}
if ($fechaIN >= $fechaOUT) {$errors[] = "Fechas introducidas no válidas";}
//if (!($experiencia == "Si" || $experiencia == "No")) {$errors[] = "Experiencia no válida";}
if (empty($status)) {$errors[] = "El campo status es obligatorio";}



if(empty($errors)){
    
    echo "asdsadqasdas1111111";
    $usuario = new Usuario();
    $usuario->nombre = $nombre;
    $usuario->mail = $email;
    $usuario->renovacion = $renovacion;
    $usuario->proyecto = $proyecto;
    $usuario->experiencia = $experiencia;
    $usuario->status = $status;
    $usuario->fechaIN = $fechaIN;
    $usuario->fechaOUT = $fechaOUT;
    $usuario->ubicacion = $ubicacion;
    $usuario->permisos = $permisos;
    $usuario->coordinador = $coordinador;
    $usuario->observaciones = $observaciones;
    $usuario->conocimientos = $conocimientos;

    $stmt = $connection->prepare(
        "INSERT INTO users (mail, renovacion, nombre, status, experiencia, proyecto, fechaIN, fechaOUT, conocimientos, ubicacion, permisos, coordinador, observaciones) 
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param(
        "sssssssssssss", 
        $usuario->mail, 
        $usuario->renovacion, 
        $usuario->nombre, 
        $usuario->status, 
        $usuario->experiencia, 
        $usuario->proyecto, 
        $usuario->fechaIN, 
        $usuario->fechaOUT, 
        $usuario->conocimientos, 
        $usuario->ubicacion, 
        $usuario->permisos, 
        $usuario->coordinador, 
        $usuario->observaciones,
        
    );

    if ($stmt->execute()) {
        echo "registro insertado correctamente";
    } else {
        echo "Error al insertar el registro: " . $connection->error;
    }
    $stmt->close();

}else{
    echo "----------ERRRROROROROROROO--------";
    foreach($errors as $error){
        echo $error ;
    }
}

?>
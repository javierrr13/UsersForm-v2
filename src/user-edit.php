<?php
include('database.php');

$id = isset($_POST['id']) ? $_POST['id'] : '';
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$mail = isset($_POST['email']) ? $_POST['email'] : '';
$renovacion = isset($_POST['renovacion']) ? $_POST['renovacion'] : 'no';
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

echo $id;

if ($id) {

    $stmt = $connection->prepare(
        "UPDATE users SET 
            mail=?, renovacion=?, nombre=?, status=?, experiencia=?, proyecto=?, fechaIN=?, fechaOUT=?, conocimientos=?, ubicacion=?, permisos=?, coordinador=?, observaciones=? 
        WHERE id=?"
    );
    $stmt->bind_param(
        "sssssssssssssi",
        $mail,
        $renovacion,
        $nombre,
        $status,
        $experiencia,
        $proyecto,
        $fechaIN,
        $fechaOUT,
        $conocimientos,
        $ubicacion,
        $permisos,
        $coordinador,
        $observaciones,
        $id
    );

    if ($stmt->execute()) {
        echo "Registro actualizado correctamente";
    } else {
        echo "Error al actualizar el registro: " . $connection->error;
    }

    $stmt->close();
} else {
    echo "ID de usuario no proporcionado";
}

?>

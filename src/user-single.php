<?php
include 'database.php';

if (isset($_POST['id'])) {
    
    $id = mysqli_real_escape_string($connection, $_POST['id']);
    
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    
    // Vincular el parámetro de la consulta
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (!$result) {
        die("Query failed: " . mysqli_error($connection)); 
    }
    
    $json = array();
    

    while ($row = mysqli_fetch_assoc($result)) {
        $json[] = array(
            'nombre' => $row['nombre'],
            'mail' => $row['mail'],
            'fechain' => $row['fechain'],
            'fechaout' => $row['fechaout'],
            'id' => $row['id'],
            'renovacion' => $row['renovacion'],
            'proyecto' => $row['proyecto'],
            'experiencia' => $row['experiencia'],
            'status' => $row['status'],
            'ubicacion' => $row['ubicacion'],
            'permisos' => $row['permisos'],
            'observaciones' => $row['observaciones'],
            'coordinador' => $row['coordinador'],
            'conocimientos' => $row['conocimientos'],
        );
    }

    // Asegúrate de que $json no esté vacío antes de intentar codificarlo
    if (!empty($json)) {
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    } else {
        echo json_encode(array("error" => "No data found"));
    }
}
?>

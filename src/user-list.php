<?php

  include('database.php');

  $query = "SELECT * from users";
  $result = mysqli_query($connection, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  }

  $json = array();
  while($row = mysqli_fetch_array($result)) {
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
  $jsonstring = json_encode($json);
  echo $jsonstring;
?>
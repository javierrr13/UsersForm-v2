<?php

include ('database.php');
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $query = "DELETE FROM users WHERE id = $id";
    $result = mysqli_real_query($connection, $query);

    if(!$result){
        die("Query failed");
    }   
    echo "task deleted sccesfully";
}

?>
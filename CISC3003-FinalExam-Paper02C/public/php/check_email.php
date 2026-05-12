<?php
require 'connect.php';

if(isset($_POST['email'])){
    $email = $_POST['email'];
    $sql = "SELECT id FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->store_result();
    
    if($stmt->num_rows > 0){
        echo "Email already registered";
    }else{
        echo "Email available";
    }
    $stmt->close();
}
?>
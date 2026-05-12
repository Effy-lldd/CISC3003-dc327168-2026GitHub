<?php
require 'connect.php';

if(isset($_GET['token'])){
    $token = $_GET['token'];
    $sql = "SELECT id FROM users WHERE activate_token=? AND is_activated=0";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$token);
    $stmt->execute();
    $res = $stmt->get_result();
    
    if($res->num_rows == 1){
        $upd = "UPDATE users SET is_activated=1, activate_token=NULL WHERE activate_token=?";
        $stmt2 = $conn->prepare($upd);
        $stmt2->bind_param("s",$token);
        $stmt2->execute();
        echo "<h3>Email activated successfully! You can login now.</h3>";
        echo "<a href='login.php'>Go to Login</a>";
    }else{
        echo "Invalid or expired activation link";
    }
}
?>
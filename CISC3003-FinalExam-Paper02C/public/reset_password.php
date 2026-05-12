<?php
require 'php/connect.php';
$token = $_GET['token'] ?? '';
$err = "";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $newPwd = password_hash(trim($_POST['newpwd']),PASSWORD_DEFAULT);
    $stmt = $conn->prepare("SELECT id FROM users WHERE reset_token=? AND reset_expire>NOW()");
    $stmt->bind_param("s",$token);
    $stmt->execute();
    if($stmt->get_result()->num_rows>0){
        $upd = $conn->prepare("UPDATE users SET password=?,reset_token=NULL,reset_expire=NULL WHERE reset_token=?");
        $upd->bind_param("ss",$newPwd,$token);
        $upd->execute();
        echo "Password reset success! <a href='login.php'>Login now</a>";
        exit;
    }else{
        $err = "Invalid or expired token";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Set New Password</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Set New Password</h2>
        <?php if($err): ?><div class="tip"><?php echo $err; ?></div><?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="newpwd" required>
            </div>
            <button type="submit">Reset Password</button>
        </form>
    </div>

    <footer>
        CISC3003 Web Programming: ZHU YI FI + DC327168 + 2026
    </footer>
</body>
</html>
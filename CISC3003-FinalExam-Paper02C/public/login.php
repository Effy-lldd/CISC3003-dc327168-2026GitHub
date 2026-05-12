<?php
require 'php/connect.php';
$err = "";

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    $stmt = $conn->prepare("SELECT id,fullname,password,is_activated FROM users WHERE email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $res = $stmt->get_result();
    
    if($res->num_rows === 1){
        $row = $res->fetch_assoc();
        // C08 未激活禁止登录
        if($row['is_activated'] != 1){
            $err = "Please activate your email first before login";
        }elseif(password_verify($password,$row['password'])){
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['fullname'];
            header("Location: dashboard.php");
            exit();
        }else{
            $err = "Incorrect password";
        }
    }else{
        $err = "Email not found";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/script.js"></script>
</head>
<body>
    <div class="container">
        <h2>User Login</h2>
        <?php if($err): ?><div class="tip"><?php echo $err; ?></div><?php endif; ?>

        <form method="POST" onsubmit="return validateLoginForm()">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="login_email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" id="login_pwd">
            </div>
            <button type="submit">Login</button>
        </form>
        <div class="link">
            <p><a href="register.php">Create New Account</a></p>
            <p><a href="forgot_password.php">Forgot Password?</a></p>
        </div>
    </div>

    <footer>
        CISC3003 Web Programming: ZHU YI FI + DC327168 + 2026
    </footer>
</body>
</html>
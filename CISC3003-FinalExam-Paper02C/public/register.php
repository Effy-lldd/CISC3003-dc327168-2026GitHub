<?php
require 'php/connect.php';
$err = "";
$success = "";

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // 服务端验证 C02
    if(empty($fullname) || empty($email) || empty($password)){
        $err = "All fields are required";
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $err = "Invalid email format";
    }elseif(strlen($password) < 6){
        $err = "Password at least 6 characters";
    }else{
        // 生成激活令牌
        $token = md5(uniqid(rand(),true));
        $hashedPwd = password_hash($password,PASSWORD_DEFAULT);
        
        // 插入数据库 C03 预处理防注入
        $stmt = $conn->prepare("INSERT INTO users(fullname,email,password,activate_token) VALUES(?,?,?,?)");
        $stmt->bind_param("ssss",$fullname,$email,$hashedPwd,$token);
        
        if($stmt->execute()){
            $success = "Register success!
Activation Link:
http://localhost:8081/CISC3003-FinalExam-Paper02C/public/php/activate.php?token=".$token;
        }else{
            $err = "Email already exists";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/script.js"></script>
</head>
<body>
    <div class="container">
        <h2>Create New Account</h2>
        <?php if($err): ?><div class="tip"><?php echo $err; ?></div><?php endif; ?>
        <?php if($success): ?><div class="tip success" style="white-space: pre-line;"><?php echo $success; ?></div><?php endif; ?>

        <form method="POST" onsubmit="return validateRegisterForm()">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="fullname" id="fullname">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="email" onkeyup="checkEmailExist()">
                <div id="email_tip" class="tip"></div>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="form-group">
                <label>Re-Password</label>
                <input type="password" id="repassword">
            </div>
            <button type="submit">Register</button>
        </form>
        <div class="link">
            <a href="login.php">Already have account? Login</a>
        </div>
    </div>

    <footer>
        CISC3003 Web Programming: ZHU YI FI + DC327168 + 2026
    </footer>
</body>
</html>
<?php
require 'connect.php';
if($_SERVER['REQUEST_METHOD']!='POST') {
    header("Location: ../forgot_password.php");
    exit();
}

$email = trim($_POST['email']);
$token = md5(uniqid(rand(),true));
$expire = date('Y-m-d H:i:s',strtotime('+1 hour'));

// 验证邮箱是否存在
$stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
$stmt->bind_param("s",$email);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 0){
    echo "Email not found in database!";
    exit;
}

// 更新重置令牌到数据库
$upd = $conn->prepare("UPDATE users SET reset_token=?,reset_expire=? WHERE email=?");
$upd->bind_param("sss",$token,$expire,$email);
$upd->execute();

// ======================
// 原生PHP发邮件（无PHPMailer）
// ======================
$reset_link = "http://localhost:8081/CISC3003-FinalExam-Paper02C/public/reset_password.php?token=".$token;
$email_subject = "Password Reset Request - CISC3003";
$email_body = "<p>Click the link below to reset your password (valid for 1 hour):</p>
<a href='$reset_link'>$reset_link</a>";

// 调用connect.php中的原生发邮件函数
if(sendEmail($email, $email_subject, $email_body)){
    echo "Reset link sent to your email successfully! Valid for 1 hour.";
} else {
    echo "Failed to send email, but token generated. <br>Reset Link (Demo): $reset_link";
}

$stmt->close();
$upd->close();
$conn->close();
?>
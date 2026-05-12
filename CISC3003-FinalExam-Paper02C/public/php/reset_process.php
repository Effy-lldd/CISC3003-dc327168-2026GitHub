<?php
// 纯后端处理：重置密码提交
// 无HTML界面，仅逻辑，和前端reset_password.php不重复
require 'connect.php';

// 仅允许POST请求
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../reset_password.php");
    exit();
}

// 获取令牌和新密码
$token = $_POST['token'] ?? '';
$new_password = trim($_POST['newpwd'] ?? '');

// 服务端验证密码
if (strlen($new_password) < 6) {
    die("Password must be at least 6 characters! <a href='../reset_password.php?token=$token'>Go back</a>");
}

// 验证令牌是否有效（未过期）
$stmt = $conn->prepare("SELECT id FROM users WHERE reset_token = ? AND reset_expire > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Invalid or expired reset token! <a href='../forgot_password.php'>Request new link</a>");
}

// 密码加密 + 清空重置令牌
$hashed_pwd = password_hash($new_password, PASSWORD_DEFAULT);
$update = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expire = NULL WHERE reset_token = ?");
$update->bind_param("ss", $hashed_pwd, $token);
$update->execute();

// 重置成功
echo "Password reset successfully! <a href='../login.php'>Login now</a>";

$stmt->close();
$update->close();
$conn->close();
?>
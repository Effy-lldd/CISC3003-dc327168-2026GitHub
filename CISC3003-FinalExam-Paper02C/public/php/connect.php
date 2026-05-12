<?php
session_start();
// 数据库配置 适配你的3307端口
$host = 'localhost';
$dbname = 'cisc3003_c';
$db_user = 'root';
$db_pwd = '';
$db_port = 3307;

$conn = new mysqli($host, $db_user, $db_pwd, $dbname, $db_port);
if($conn->connect_error){
    die("DB Connection Failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

// ========== 原生SMTP配置（不用PHPMailer、不用vendor）==========
// 改成你自己的QQ邮箱 + 授权码
define('SMTP_HOST', 'smtp.qq.com');
define('SMTP_PORT', 465);
define('SMTP_USER', '2365915539@qq.com');
define('SMTP_PASS', 'fersbdwkqboudhgf'); // 不是登录密码
define('SMTP_FROM', 'CISC3003 NoReply');

// 原生纯PHP发邮件函数
function sendEmail($to, $subject, $body){
    $socket = stream_socket_client(
        'ssl://' . SMTP_HOST . ':' . SMTP_PORT,
        $errno,
        $errstr,
        30,
        STREAM_CLIENT_CONNECT
        );
    if(!$socket) return false;
    
    fwrite($socket, "HELO localhost\r\n");
    fwrite($socket, "AUTH LOGIN\r\n");
    fwrite($socket, base64_encode(SMTP_USER) . "\r\n");
    fwrite($socket, base64_encode(SMTP_PASS) . "\r\n");
    fwrite($socket, "MAIL FROM:<".SMTP_USER.">\r\n");
    fwrite($socket, "RCPT TO:<".$to.">\r\n");
    fwrite($socket, "DATA\r\n");
    $msg  = "From: ".SMTP_FROM." <".SMTP_USER.">\r\n";
    $msg .= "To: <".$to.">\r\n";
    $msg .= "Subject: =?UTF-8?B?".base64_encode($subject)."?=\r\n";
    $msg .= "Content-Type: text/html; charset=UTF-8\r\n\r\n";
    $msg .= $body . "\r\n.\r\n";
    fwrite($socket, $msg);
    fwrite($socket, "QUIT\r\n");
    fclose($socket);
    return true;
}
?>
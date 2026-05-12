<?php
// Database Config
$host = 'localhost';
$dbname = 'cisc3003_scenario_b';
$user = 'root';
$pass = '';
$port = 3307;

// Database Connection
$conn = new mysqli($host, $user, $pass, $dbname, $port);
if ($conn->connect_error) {
    die("Database Connection Failed");
}
$conn->set_charset("utf8mb4");

// ======================
// PHPMailer
// ======================

require_once __DIR__ . '/../vendor/PHPMailer.php';
require_once __DIR__ . '/../vendor/SMTP.php';
require_once __DIR__ . '/../vendor/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

// Server Settings
$mail->isSMTP();
$mail->Host       = 'smtp.qq.com';
$mail->SMTPAuth   = true;
$mail->Username   = '2365915539@qq.com';
$mail->Password   = 'fersbdwkqboudhgf';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Port       = 465;
$mail->CharSet    = 'UTF-8';

// Sender Info
$mail->setFrom($mail->Username, 'CISC3003 Contact System');
$mail->isHTML(true);
?>
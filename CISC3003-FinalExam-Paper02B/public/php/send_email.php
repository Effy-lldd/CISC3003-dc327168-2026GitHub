<?php
session_start();
require_once 'config.php';

// Only allow POST method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php?status=error");
    exit;
}

// Get Form Data
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$subject = trim($_POST['subject']);
$message = trim($_POST['message']);

// Save to Database
$stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?,?,?,?)");
$stmt->bind_param("ssss", $name, $email, $subject, $message);
$stmt->execute();

// B.03 Send Email with PHPMailer
$mail->From = $mail->Username;
$mail->addAddress($mail->Username);
$mail->Subject = $subject;
$mail->Body = "
<h3>New Contact Message</h3>
<p>Name: $name</p>
<p>Email: $email</p>
<p>Message: $message</p>
";

// B.04 Debug Email Sending
$sendResult = $mail->send();

// B.05 Post/Redirect/Get (PRG) Pattern
if ($sendResult) {
    header("Location: ../index.php?status=success");
} else {
    // Debug Info
    error_log("PHPMailer Error: " . $mail->ErrorInfo());
    header("Location: ../index.php?status=error");
}

$stmt->close();
$conn->close();
exit;
?>
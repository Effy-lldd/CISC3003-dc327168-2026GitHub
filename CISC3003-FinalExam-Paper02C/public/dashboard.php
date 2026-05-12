<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
require 'php/connect.php';
$uid = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT fullname,email,created_at FROM users WHERE id=?");
$stmt->bind_param("i",$uid);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <div class="container">
        <h2>User Dashboard</h2>
        <div class="info-box">
            <p>Welcome: <?php echo $_SESSION['user_name']; ?></p>
            <p>Registered Email: <?php echo $user['email']; ?></p>
            <p>Registration Date: <?php echo $user['created_at']; ?></p>
        </div>
        <a href="logout.php"><button class="logout-btn">Logout</button></a>
    </div>

    <footer>
        CISC3003 Web Programming: ZHU YI FI + DC327168 + 2026
    </footer>
</body>
</html>
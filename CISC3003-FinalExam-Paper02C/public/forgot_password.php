<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        <form action="php/forgot_process.php" method="POST">
            <div class="form-group">
                <label>Enter Your Registered Email</label>
                <input type="email" name="email" required>
            </div>
            <button type="submit">Send Reset Link</button>
        </form>
        <div class="link"><a href="login.php">Back to Login</a></div>
    </div>

    <footer>
        CISC3003 Web Programming: ZHU YI FI + DC327168 + 2026
    </footer>
</body>
</html>
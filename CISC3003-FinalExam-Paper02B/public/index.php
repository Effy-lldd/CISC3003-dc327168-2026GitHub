<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scenario B - Contact Form</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/script.js"></script>
</head>
<body>
    <div class="container">
        <h2>Contact Us</h2>

        <!-- PRG Status Message -->
        <?php if (isset($_GET['status'])): ?>
            <?php if ($_GET['status'] === 'success'): ?>
                <div class="message success">Message sent successfully!</div>
            <?php else: ?>
                <div class="message error">Failed to send message. Please try again.</div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- B.01 HTML Contact Form -->
        <form method="POST" action="php/send_email.php" onsubmit="return validateForm()">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Subject</label>
                <input type="text" id="subject" name="subject" required>
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea id="message" name="message" rows="6" required></textarea>
            </div>
            <button type="submit">Send Message</button>
        </form>
    </div>

    <!-- Exam Required Footer -->
    <footer>
        CISC3003 Web Programming: Your Name + Your Student ID + 2026
    </footer>
</body>
</html>
<?php
session_start();
include 'php/connect.php';

$message = '';
$msg_type = '';

// A.05 Process Form Data | A.06 Filter Validation | A.07 Prevent SQL Injection | A.08 Prepared Statement | A.10 INSERT
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // A.06 Validate Data with PHP Filter Functions
    $full_name = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $feedback = filter_input(INPUT_POST, 'feedback', FILTER_SANITIZE_STRING);
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
    $course = filter_input(INPUT_POST, 'course', FILTER_SANITIZE_STRING);
    
    $interests = isset($_POST['interests']) ? implode(', ', $_POST['interests']) : '';

    // Validation Check
    if (!$full_name || !$email || !$feedback || !$gender || !$course || empty($interests)) {
        $message = "All fields are required. Please fill in all information.";
        $msg_type = "error";
    } else {
        // A.08 Prepared Statement (A.07 Anti SQL Injection)
        $stmt = $conn->prepare("INSERT INTO user_submissions (full_name, email, feedback, gender, interests, course) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $full_name, $email, $feedback, $gender, $interests, $course);

        // A.10 SQL INSERT INTO Statement
        if ($stmt->execute()) {
            $message = "Data submitted successfully! Record saved to database.";
            $msg_type = "success";
        } else {
            $message = "Submission failed. Please try again.";
            $msg_type = "error";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scenario A - User Submission Form</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2>User Feedback Submission</h2>

        <!-- A.01 HTML Form Best Practices -->
        <?php if ($message): ?>
            <div class="message <?= $msg_type ?>"><?= $message ?></div>
        <?php endif; ?>

        <form id="submissionForm" method="POST" action="">
            <!-- A.02 Simple Text Input Controls -->
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" required>
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" required>
            </div>

            <!-- A.03 Multi-line Textarea -->
            <div class="form-group">
                <label>Feedback / Comments</label>
                <textarea name="feedback" rows="6" required></textarea>
            </div>

            <!-- A.04 Radio Buttons -->
            <div class="form-group">
                <label>Gender</label>
                <div class="radio-group">
                    <input type="radio" name="gender" value="Male" required> Male
                    <input type="radio" name="gender" value="Female"> Female
                    <input type="radio" name="gender" value="Other"> Other
                </div>
            </div>

            <!-- A.04 Checkboxes -->
            <div class="form-group">
                <label>Interests</label>
                <div class="checkbox-group">
                    <input type="checkbox" name="interests[]" value="Web Development"> Web Development
                    <input type="checkbox" name="interests[]" value="Database"> Database
                    <input type="checkbox" name="interests[]" value="Programming"> Programming
                </div>
            </div>

            <!-- A.04 Select List -->
            <div class="form-group">
                <label>Course Enrolled</label>
                <select name="course" required>
                    <option value="">Select Course</option>
                    <option value="CISC3003">CISC3003 Web Programming</option>
                    <option value="CISC2008">CISC2008 Database</option>
                    <option value="CISC1001">CISC1001 Basic IT</option>
                </select>
            </div>

            <button type="submit">Submit Form</button>
        </form>
    </div>

    <!-- Exam Required Footer -->
    <footer>
        CISC3003 Web Programming: ZHU YI FEI + DC327168 + 2026
    </footer>

    <script src="js/script.js"></script>
</body>
</html>

<?php $conn->close(); ?>
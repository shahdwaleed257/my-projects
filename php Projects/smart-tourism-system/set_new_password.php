<?php
session_start();
$error = "";

if (!isset($_SESSION['email'])) {
    header("Location: reset_password.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $email = $_SESSION['email'];

    // تحقق من أن كلمة المرور وكلمة المرور المؤكدة متطابقتين
    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // تشفير كلمة المرور
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // تحديث كلمة المرور في قاعدة البيانات
        $conn = new mysqli("localhost", "root", "", "tourist_system");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // تحديث كلمة المرور في قاعدة البيانات
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashedPassword, $email);
        if ($stmt->execute()) {
            // توجيه المستخدم إلى صفحة تسجيل الدخول بعد التحديث
            session_destroy(); // إنهاء الجلسة الحالية
            header("Location: login.php");
            exit;
        } else {
            $error = "Error updating password. Please try again.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Set New Password</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('opp5.jpg'); /* تأكد من إضافة مسار الصورة هنا */
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .password-reset-box {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            width: 350px;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
        }

        .password-reset-box h2 {
            margin-bottom: 20px;
            color: #333;
        }

        input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
        }

        .error {
            color: red;
            margin-top: 15px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="password-reset-box">
        <h2>Set New Password</h2>
        <form method="POST">
            <input type="password" name="password" placeholder="Enter new password" required><br>
            <input type="password" name="confirm_password" placeholder="Confirm new password" required><br>
            <input type="submit" value="Submit">
        </form>
        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
    </div>
</body>
</html>

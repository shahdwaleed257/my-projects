<?php
session_start();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $conn = new mysqli("localhost", "root", "", "tourist_system");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // التحقق من وجود البريد الإلكتروني في قاعدة البيانات
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // إذا كان البريد الإلكتروني موجودًا، التوجيه لصفحة تغيير كلمة المرور
        $_SESSION['email'] = $email;
        header("Location: set_new_password.php");
        exit;
    } else {
        // إذا لم يكن البريد موجودًا
        $error = "This email is not registered. <a href='register.php'>Create an account</a>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('opp4.jpg'); /* قم بتغيير 'your-image.jpg' إلى مسار الصورة التي تريدها */
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .reset-box {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            width: 350px;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
        }

        .reset-box h2 {
            margin-bottom: 20px;
            color: #333;
        }

        input[type="email"] {
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

        .new-user {
            margin-top: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="reset-box">
        <h2>Reset Password</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Enter your email" required><br>
            <input type="submit" value="Confirm">
        </form>
        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
        <div class="new-user">
            New user? <a href='register.php'>Create an account</a>
        </div>
    </div>
</body>
</html>

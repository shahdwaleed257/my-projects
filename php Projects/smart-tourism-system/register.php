<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["full_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Connect to database
    $conn = new mysqli("localhost", "root", "", "tourist_system");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if email already exists
    $checkStmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        // Email exists - redirect to reset password page
        echo "<script>
                alert('الإيميل ده متسجل قبل كده! هتتنقل دلوقتي لصفحة تحديث الباسورد');
                window.location.href='reset_password.php?email=" . urlencode($email) . "';
              </script>";
        exit;
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashedPassword);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $checkStmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('toure.jpg'); /* Use your background image name */
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .register-box {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            width: 350px;
            text-align: center;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="register-box">
        <h2>Welcome to Egyptian Tourism</h2>
        <form method="POST" action="">
            <input type="text" name="full_name" placeholder="Full Name" required><br>
            <input type="email" name="email" placeholder="Email Address" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" value="Register">
        </form>
        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
    </div>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "tourist_system");
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// جلب بيانات المستخدم
$user_id = $_SESSION["user_id"];
$stmt = $conn->prepare("SELECT full_name, email FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($full_name, $email);
$stmt->fetch();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_name = $_POST["full_name"];
    $new_email = $_POST["email"];

    // تحديث البيانات
    $update_stmt = $conn->prepare("UPDATE users SET full_name = ?, email = ? WHERE user_id = ?");
    $update_stmt->bind_param("ssi", $new_name, $new_email, $user_id);
    if ($update_stmt->execute()) {
        echo "<p style='color:green;'>تم تحديث البيانات بنجاح!</p>";
        $_SESSION["full_name"] = $new_name;
    } else {
        echo "<p style='color:red;'>حدث خطأ أثناء تحديث البيانات.</p>";
    }
    $update_stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إدارة الحساب</title>
    <style>
        body { font-family: Arial; background-color: #f0f0f0; padding: 50px; text-align: center; }
        form { background: white; padding: 20px; border-radius: 10px; display: inline-block; }
        input[type="text"], input[type="email"] { width: 90%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; }
        input[type="submit"] { background: #4CAF50; color: white; padding: 10px 20px; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h2>إدارة الحساب</h2>
    <form method="POST" action="">
        <input type="text" name="full_name" value="<?php echo $full_name; ?>" placeholder="الاسم بالكامل" required><br>
        <input type="email" name="email" value="<?php echo $email; ?>" placeholder="البريد الإلكتروني" required><br>
        <input type="submit" value="تحديث">
    </form>
</body>
</html>

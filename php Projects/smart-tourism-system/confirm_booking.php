<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $destination_id = $_POST["destination_id"];
    $user_id = $_SESSION["user_id"];

    // الاتصال بقاعدة البيانات
    $conn = new mysqli("localhost", "root", "", "tourist_system");
    if ($conn->connect_error) {
        die("فشل الاتصال: " . $conn->connect_error);
    }

    // إضافة الحجز إلى قاعدة البيانات
    $stmt = $conn->prepare("INSERT INTO bookings (user_id, destination_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $destination_id);
    if ($stmt->execute()) {
        echo "<p style='color:green;'>تم الحجز بنجاح!</p>";
    } else {
        echo "<p style='color:red;'>حدث خطأ أثناء الحجز.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تأكيد الحجز</title>
</head>
<body>
    <h2>تم تأكيد حجزك!</h2>
    <p>شكراً لاختيارك خدمتنا!</p>
    <a href="index.php">العودة إلى الصفحة الرئيسية</a>
</body>
</html>

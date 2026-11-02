<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "tourist_system");
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

$query = "SELECT * FROM destinations"; 
$result = $conn->query($query);
$conn->close();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>حجز</title>
    <style>
        body { font-family: Arial; background-color: #f0f0f0; padding: 50px; text-align: center; }
        form { background: white; padding: 20px; border-radius: 10px; display: inline-block; }
    </style>
</head>
<body>
    <h2>حجز رحلة أو مكان سياحي</h2>
    <form method="POST" action="confirm_booking.php">
        <select name="destination_id" required>
            <option value="">اختر وجهة سياحية</option>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <option value="<?php echo $row['destination_id']; ?>"><?php echo $row['destination_name']; ?></option>
            <?php } ?>
        </select><br>
        <input type="submit" value="تأكيد الحجز">
    </form>
</body>
</html>

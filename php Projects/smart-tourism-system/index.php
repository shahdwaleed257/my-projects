<?php
session_start();

// منع الوصول بدون تسجيل دخول
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// ممكن تجيبي اسم المستخدم من قاعدة البيانات أو من الجلسة لو محفوظ
$userName = $_SESSION['user_name'] ?? 'Tourist';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome - Intelligent Tourist System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('pyrmids.jpg'); /* غيري المسار حسب مكان الصورة */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            color: white;
        }
        .overlay {
            background-color: rgba(0, 0, 0, 0.6); /* طبقة شفافة فوق الصورة */
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        header {
            font-size: 28px;
            margin-bottom: 20px;
        }
        a {
            display: inline-block;
            margin: 10px;
            padding: 12px 24px;
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            text-decoration: none;
            border: 2px solid white;
            border-radius: 10px;
            font-weight: bold;
        }
        a:hover {
            background-color: rgba(255, 255, 255, 0.4);
        }
    </style>
</head>
<body>

<div class="overlay">
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($userName); ?> 👋</h1>
        <p>Explore Egypt with our Intelligent Tourist System</p>
    </header>

    <div>
        <a href="map.php">🗺 View Map</a>
        <a href="search.php">🔍 Search Places</a>
        <a href="recommendations.php">🤖 Smart Recommendations</a>
        <a href="itinerary.php">📝 My Trip Plan</a>
        <a href="logout.php">🚪 Logout</a>
    </div>
</div>

</body>
</html>

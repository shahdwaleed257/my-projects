<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];

  // هنا بنفترض إرسال إيميل وهمي – في الواقع هتحتاج SMTP
  echo "A password reset link has been sent to: " . htmlspecialchars($email);
}
?>


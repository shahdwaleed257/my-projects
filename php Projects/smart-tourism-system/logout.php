<?php
// log out logic
session_start();
session_destroy();
header("Location: index.php"); // Redirect to homepage
exit();
?>

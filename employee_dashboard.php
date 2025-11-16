<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "employee") {
    header("Location: login.php");
    exit();
}
$username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html>
<head>
<title>Employee Dashboard</title>
<link rel="stylesheet" href="employee_dash.css">
</head>
<body>

<div class="container">

<div class="header">
    <h2>Employee Dashboard</h2>
    <a class="logout" href="logout.php">Logout</a>
</div>

<p>Hello, <b><?php echo $username; ?></b> 👋</p>

<div class="menu">
    <a href="okok.php">📌 My Tasks</a>
    <a href="my_profile.php">👤 My Profile</a>
</div>

</div>

</body>
</html>

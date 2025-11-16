<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "manager") {
    header("Location: login.php");
    exit();
}
$username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html>
<head>
<title>Manager Dashboard</title>
<link rel="stylesheet" href="manag.css">
</head>
<body>

<div class="container">

<div class="header">
    <h2>Manager Dashboard</h2>
    <a class="logout" href="logout.php">Logout</a>
</div>

<p>Welcome, <b><?php echo $username; ?></b> 👋</p>

<div class="menu">
    <!-- <a href="add_employee.php">➕ Add Employee</a> -->
    <a href="view_employees.php">📋 View Employees</a>
    <a href="assign_task.php">📝 Assign Tasks</a>
    <a href="view_tasks.php">📌 View All Tasks</a>
</div>

</div>

</body>
</html>

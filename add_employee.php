<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "employee") {
    header("Location: login.php");
    exit();
}

require "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname = $_POST["firstname"];
    $lname = $_POST["lastname"];
    $age = $_POST["age"];
    $dept = $_POST["department"];
    $address = $_POST["address"];

    $stmt = $conn->prepare("INSERT INTO employees(firstname, lastname, age, department, address) VALUES(?,?,?,?,?)");
    $stmt->bind_param("ssiss", $fname, $lname, $age, $dept, $address);

    if ($stmt->execute()) {
        $msg = "Employee added successfully!";
    } else {
        $msg = "Error adding employee!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>fill All Detail As Employee</title>
<link rel="stylesheet" href="add_employee.css">
</head>
<body>

<div class="container">

<h2>Fill all Details Related To Employee</h2>
  <a href="manager_dashboard.php" style="padding:8px; background:gray; color:white; text-decoration:none;">⬅ Back to Dashboard</a>
    &nbsp;&nbsp;&nbsp;&nbsp;<a href="employee_dashboard.php" style="padding:8px; background:gray; color:white; text-decoration:none;">⬅ After Fill Click Here</a>
<hr>

<?php if(isset($msg)) echo "<p style='color:green;'>$msg</p>"; ?>

<form method="POST">

<label>First Name:</label>
<input type="text" name="firstname" required>

<label>Last Name:</label>
<input type="text" name="lastname" required>

<label>Age:</label>
<input type="number" name="age" required>

<label>Department:</label>
<input type="text" name="department" required>

<label>Address:</label>
<input type="text" name="address" required>

<button type="submit">Save Employee</button>

</form>

</div>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "manager") {
    header("Location: login.php");
    exit();
}

require "db.php";
// <link rel="stylesheet" href="styles.css">;
?>

<!DOCTYPE html>
<html>
<head>
<title>View Employees</title>
<link rel="stylesheet" href="okok.css">

</head>
<body>

<div class="container">

<h2>All Employees</h2>
 <a href="manager_dashboard.php" style="padding:8px; background:gray; color:white; text-decoration:none;">⬅ Back to Dashboard</a>
<hr>

<table>
<tr>
    <th>ID</th>
    <th>FirstName</th>
    <th>LastName</th>
    <th>Age</th>
    <th>Department</th>
    <th>Address</th>
    <th>Actions</th>
</tr>

<?php
$sql = "SELECT * FROM employees";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "
        <tr>
            <td>{$row['id']}</td>
            <td>{$row['firstname']}</td>
            <td>{$row['lastname']}</td>
            <td>{$row['age']}</td>
            <td>{$row['department']}</td>
            <td>{$row['address']}</td>
            <td>
                <a href='edit_employee.php?id={$row['id']}'>Edit</a> |
                <a href='delete_employee.php?id={$row['id']}' onclick='return confirm(\"Delete this employee?\");'>Delete</a>
            </td>
        </tr>
        ";
    }
} else {
    echo "<tr><td colspan='7'>No employees found</td></tr>";
}
?>

</table>

</div>
</body>
</html>

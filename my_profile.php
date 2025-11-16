
<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// Fetch user info
$userQuery = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($userQuery);

// Fetch tasks assigned to employee
$taskQuery = mysqli_query($conn, "SELECT * FROM tasks WHERE employee_id='$user_id'");
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
</head>
<body>
<center>
<h2>My Profile</h2>

<p><strong>Username:</strong> <?= $user["username"]; ?></p>
<p><strong>Email:</strong> <?= $user["email"]; ?></p>
<p><strong>Role:</strong> <?= $user["role"]; ?></p>

<p>
    <a href="edit_profile.php" style="padding:8px; background:blue; color:white; text-decoration:none;">Edit Profile</a>
    <a href="change_password.php" style="padding:8px; background:green; color:white; text-decoration:none;">Change Password</a>
    <a href="employee_dashboard.php" style="padding:8px; background:gray; color:white; text-decoration:none;">Back to Dashboard</a>
</p>
<table border="1" cellpadding="7" cellspacing="0">
       <tr>
        <th>Task Title</th>
        <th>Description</th>
        <th>Deadline</th>
    </tr>

   
    <?php
    $sql = "SELECT 
            t.task_title, 
            t.task_description, 
            t.deadline
        FROM tasks t
        JOIN employees e ON t.employee_id = e.id";

$result = $conn->query($sql);
?>
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['task_title']}</td>
                <td>{$row['task_description']}</td>
                <td>{$row['deadline']}</td>
                
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No tasks found</td></tr>";
}
?>
</table>
</center>
</body>
</html>




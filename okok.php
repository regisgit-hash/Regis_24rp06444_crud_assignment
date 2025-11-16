
<?php
include 'db.php';

$sql = "SELECT 
            t.id, 
            t.employee_id, 
            e.firstname, 
            e.lastname, 
            t.task_title, 
            t.task_description, 
            t.deadline
        FROM tasks t
        JOIN employees e ON t.employee_id = e.id";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Tasks</title>
    <link rel="stylesheet" href="okok.css">
</head>
<body>
      <a href="employee_dashboard.php" style="padding:8px; background:gray; color:white; text-decoration:none;">Back to Dashboard</a>
<h2>All Tasks</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Employee</th>
        <th>Task Title</th>
        <th>Description</th>
        <th>Deadline</th>
       <!--  <th>Action</th> -->
    </tr>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['firstname']} {$row['lastname']}</td>
                <td>{$row['task_title']}</td>
                <td>{$row['task_description']}</td>
                <td>{$row['deadline']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No tasks found</td></tr>";
}
?>
</table>
</body>
</html>

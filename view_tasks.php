
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
    <link rel="stylesheet" href="okok.css">
     <a href="manager_dashboard.php" style="padding:8px; background:gray; color:white; text-decoration:none;">⬅ Back to Dashboard</a>
    <title>View Tasks</title>
</head>
<body>
<h2>All Tasks</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Employee</th>
        <th>Task Title</th>
        <th>Description</th>
        <th>Deadline</th>
        <th>Action</th>
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
                <td>
                    <a href='update_task.php?id={$row['id']}'>Edit</a> |
                    <a href='delete_task.php?id={$row['id']}'>Delete</a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No tasks found</td></tr>";
}
?>
</table>
</body>
</html>

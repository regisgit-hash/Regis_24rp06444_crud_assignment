<?php
// Database connection
$connect = mysqli_connect("localhost", "root", "", "employee_management");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if ID is provided
if (!isset($_GET['id'])) {
    die("No ID provided in URL.");
}

$id = intval($_GET['id']); // convert to number

// Delete query
$sql = "DELETE FROM tasks WHERE id = $id";

if (mysqli_query($connect, $sql)) {
    echo "Task deleted successfully!";
} else {
    echo "Error deleting task: " . mysqli_error($connect);
}

mysqli_close($connect);

// Redirect back to list page (optional)
header("Location: view_tasks.php");
?>

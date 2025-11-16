
<?php
include 'db.php';

// If ID is missing
if (!isset($_GET['id'])) {
    die("Task ID not provided.");
}

$id = $_GET['id'];

// Fetch employees for dropdown
$employees = $conn->query("SELECT id, firstname, lastname FROM employees");

// Fetch task details
$stmt = $conn->prepare("SELECT * FROM tasks WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$task = $stmt->get_result()->fetch_assoc();

if (!$task) {
    die("Task not found!");
}

// Update task when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $employee_id = $_POST["employee_id"];
    $task_title = $_POST["task_title"];
    $task_description = $_POST["task_description"];
    $deadline = $_POST["deadline"];

    $update = $conn->prepare("
        UPDATE tasks 
        SET employee_id=?, task_title=?, task_description=?, deadline=?
        WHERE id=?"
    );
    $update->bind_param("isssi", $employee_id, $task_title, $task_description, $deadline, $id);

    if ($update->execute()) {
        $msg = "Task updated successfully!";
    } else {
        $msg = "Error updating task!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Task</title>
</head>
<body>

<h2>Update Task</h2>

<?php if(isset($msg)) echo "<p><strong>$msg</strong></p>"; ?>

<form method="POST">

    <label>Employee</label><br>
    <select name="employee_id" required>
        <?php while ($emp = $employees->fetch_assoc()) { ?>
            <option value="<?= $emp['id'] ?>" 
                <?= ($emp['id'] == $task['employee_id']) ? 'selected' : '' ?>>
                <?= $emp['firstname'] . " " . $emp['lastname'] ?>
            </option>
        <?php } ?>
    </select>
    <br><br>

    <label>Task Title</label><br>
    <input type="text" name="task_title" value="<?= $task['task_title'] ?>" required>
    <br><br>

    <label>Description</label><br>
    <textarea name="task_description" required><?= $task['task_description'] ?></textarea>
    <br><br>

    <label>Deadline</label><br>
    <input type="date" name="deadline" value="<?= $task['deadline'] ?>" required>
    <br><br>

    <button type="submit">Update Task</button>
</form>

<br>
<a href="view_tasks.php">⬅ Back to Task List</a>

</body>
</html>

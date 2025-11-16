
<?php
include 'db.php';

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST["employee_id"];
    $task_title = $_POST["task_title"];
    $task_description = $_POST["task_description"];
    $deadline = $_POST["deadline"];

    $stmt = $conn->prepare("INSERT INTO tasks (employee_id, task_title, task_description, deadline) 
                            VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $employee_id, $task_title, $task_description, $deadline);

    if ($stmt->execute()) {
        $msg = "Task assigned successfully!";
    } else {
        $msg = "Error assigning task!";
    }
}

$employees = $conn->query("SELECT id, firstname, lastname FROM employees");
?>
<!DOCTYPE html>
<html>
<head>
    <center>
    <title>Assign Task</title>
    <link rel="stylesheet" href="assign_task.css">
</head>
<body>
<h2>Assign Task to Employee</h2>

<!-- Back to Dashboard Button -->
<a href="manager_dashboard.php" 
   style="display:inline-block; padding:8px 14px; background:#007bff; color:white; 
          text-decoration:none; border-radius:5px; margin-bottom:15px;">
    ← Back to Dashboard
</a>

<?php if ($msg): ?>
    <div style="
        padding: 12px;
        background-color: <?= ($msg == 'Task assigned successfully!') ? '#d4edda' : '#f8d7da' ?>;
        color: <?= ($msg == 'Task assigned successfully!') ? '#155724' : '#721c24' ?>;
        border: 1px solid <?= ($msg == 'Task assigned successfully!') ? '#c3e6cb' : '#f5c6cb' ?>;
        width: 350px;
        border-radius: 6px;
        margin-bottom: 15px;
    ">
        <?= $msg ?>
    </div>
<?php endif; ?>

<form method="POST">
    <label>Select Employee</label>
    <select name="employee_id" required>
        <option value="">-- Select Employee --</option>
        <?php while ($emp = $employees->fetch_assoc()) { ?>
            <option value="<?= $emp['id'] ?>">
                <?= $emp['firstname'] . ' ' . $emp['lastname'] ?>
            </option>
        <?php } ?>
    </select>
    <br><br>

    <label>Task Title</label><br>
    <input type="text" name="task_title" required>
    <br><br>

    <label>Description</label><br>
    <textarea name="task_description" required></textarea>
    <br><br>

    <label>Deadline</label><br>
    <input type="date" name="deadline" required>
    <br><br>

    <button type="submit">Assign Task</button>
</form>
</center>
</body>
</html>

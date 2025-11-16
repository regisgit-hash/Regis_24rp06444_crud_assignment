<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "manager") {
    header("Location: login.php");
    exit();
}

require "db.php";

$id = $_GET["id"];

$sql = "SELECT * FROM employees WHERE id=$id";
$res = $conn->query($sql);
$data = $res->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname = $_POST["firstname"];
    $lname = $_POST["lastname"];
    $age = $_POST["age"];
    $dept = $_POST["department"];
    $address = $_POST["address"];

    $stmt = $conn->prepare("UPDATE employees SET firstname=?, lastname=?, age=?, department=?, address=? WHERE id=?");
    $stmt->bind_param("ssissi", $fname, $lname, $age, $dept, $address, $id);

    if ($stmt->execute()) {
        $msg = "Employee updated successfully!";
    } else {
        $msg = "Update failed!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Employee</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
<h2>Edit Employee</h2>
<a href="view_employees.php">⬅ Back</a>
<hr>

<?php if(isset($msg)) echo "<p style='color:green;'>$msg</p>"; ?>

<form method="POST">

<label>First Name</label>
<input type="text" name="firstname" value="<?php echo $data['firstname']; ?>" required>

<label>Last Name</label>
<input type="text" name="lastname" value="<?php echo $data['lastname']; ?>" required>

<label>Age</label>
<input type="number" name="age" value="<?php echo $data['age']; ?>" required>

<label>Department</label>
<input type="text" name="department" value="<?php echo $data['department']; ?>" required>

<label>Address</label>
<input type="text" name="address" value="<?php echo $data['address']; ?>" required>

<button type="submit">Update</button>

</form>

</div>
</body>
</html>

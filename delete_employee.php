<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "manager") {
    header("Location: login.php");
    exit();
}

require "db.php";

$id = $_GET["id"];

$sql = "DELETE FROM employees WHERE id=$id";

if ($conn->query($sql)) {
    header("Location: view_employees.php");
} else {
    echo "Error deleting!";
}
?>

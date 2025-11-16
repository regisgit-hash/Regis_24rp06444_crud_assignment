<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

if (isset($_POST["change"])) {
    $old = $_POST["old_password"];
    $new = password_hash($_POST["new_password"], PASSWORD_BCRYPT);

    // check old password
    $q = mysqli_query($conn, "SELECT password FROM users WHERE id='$user_id'");
    $row = mysqli_fetch_assoc($q);

    if (password_verify($old, $row["password"])) {
        mysqli_query($conn, "UPDATE users SET password='$new' WHERE id='$user_id'");
        $msg = "Password changed successfully!";
    } else {
        $msg = "Old password is incorrect!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
</head>
<body>

<h2>Change Password</h2>

<?php if (isset($msg)) echo "<p style='color:blue;'>$msg</p>"; ?>

<form method="POST">
    <label>Old Password</label><br>
    <input type="password" name="old_password" required><br><br>

    <label>New Password</label><br>
    <input type="password" name="new_password" required><br><br>

    <button type="submit" name="change">Change Password</button>
</form>

<p><a href="my_profile.php">Back</a></p>

</body>
</html>

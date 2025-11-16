<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$query = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($query);

if (isset($_POST["save"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];

    mysqli_query($conn, "UPDATE users SET username='$username', email='$email' WHERE id='$user_id'");
    $msg = "Profile updated successfully!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
</head>
<body>

<h2>Edit Profile</h2>

<?php if (isset($msg)) echo "<p style='color:green;'>$msg</p>"; ?>

<form method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" value="<?= $user['username'] ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= $user['email'] ?>" required><br><br>

    <button type="submit" name="save">Save Changes</button>
</form>

<p><a href="my_profile.php">Back</a></p>

</body>
</html>

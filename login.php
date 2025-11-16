
<?php
session_start();
require "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $uname, $hashed, $role);
        $stmt->fetch();

        if (password_verify($password, $hashed)) {

            $_SESSION["user_id"] = $id;
            $_SESSION["username"] = $uname;
            $_SESSION["role"] = $role;

            if ($role == "manager") {
                header("Location: manager_dashboard.php");
            } else {
                header("Location:add_employee.php");
            }
            exit();

        } else {
            $error = "Incorrect Password!";
        }

    } else {
        $error = "Username not found!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="login_css.css">
</head>
<body>

<div class="container">

<h2>Login</h2>

<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST">
    <label>Username</label>
    <input type="text" name="username" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <button type="submit">Login</button>
</form>

<p style="margin-top: 10px;">
    Don't have an account?  
    <a href="signup.php">Create one here</a>
</p>

</div>
</body>
</html>

<?php
include "db.php";

$message = "";

if (isset($_POST["signup"])) {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = $_POST["role"];

    // Prepare insert
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $password, $role);

    if ($stmt->execute()) {
        $message = "Account created successfully! Please login.";
    } else {
        $message = "Error creating account!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <link rel="stylesheet" href="sinup.css">
</head>
<body>

<div class="form-container">
    <h2>Create Account</h2>

    <?php if($message) echo "<p style='color:green; font-weight:bold;'>$message</p>"; ?>

    <form method="POST" action="signup.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>

        <select name="role" required>
            <option value="manager">Manager</option>
            <option value="employee">Employee</option>
        </select>

        <button type="submit" name="signup">Sign Up</button>
    </form>

    <p style="margin-top: 15px;">
        Already have an account? 
        <a href="login.php" style="color: blue; font-weight:bold;">
            Click here to login
        </a>
    </p>
</div>

</body>
</html>

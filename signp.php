<?php
// Database connection
$servername = "localhost";
$username = "root"; // Change with your DB username
$password = ""; // Change with your DB password
$dbname = "an_cakes";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php"); // Redirect to login page after signup
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - A&N Cakes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="navbar">
        <div class="logo">
            <img src="images/logo.jpg" alt="A&N Cakes Logo" />
        </div>
        <a href="home.php">Home</a>
        <a href="customize-cake.php">Order Online</a>
        <a href="login.php">Category</a>
        <a href="login.php">Login</a>
    </div>

    <div class="form-container">
        <h2>Signup</h2>
        <form method="POST" action="signp.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <button type="submit">Signup</button><br><br>
            <center >Already have an account? <a href="login.php">Log in</a></center>
        </form>
    </div>

    <footer>
        <a href="#">Facebook</a>
        <a href="#">WhatsApp</a>
        <a href="#">Instagram</a>
        <a href="#">Contact Us</a>
    </footer>
</body>
</html>

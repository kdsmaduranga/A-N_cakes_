<?php
// Database connection
include('config.php');

// Fetch customized cakes
$sql = "SELECT * FROM customized_cakes ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Customized Cakes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Navigation Bar -->
    <div class="navbar">
        <a href="#">Home</a>
        <a href="#">Order Online</a>
        <a href="#">Category</a>
        <a href="#">Login</a>
    </div>

    <!-- Display Customized Cakes -->
    <div class="customized-cakes-container">
        <h2>Our Customized Cakes</h2>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="custom-cake-card">';
                echo '<img src="uploads/' . $row['image'] . '" alt="Custom Cake" class="custom-cake-image">';
                echo '<p><strong>Comment:</strong> ' . htmlspecialchars($row['comment']) . '</p>';
                echo '</div>';
            }
        } else {
            echo "<p>No custom cakes available at the moment.</p>";
        }
        ?>
    </div>

    <!-- Footer Section -->
    <footer>
        <a href="#">Facebook</a>
        <a href="#">WhatsApp</a>
        <a href="#">Instagram</a>
        <a href="#">Contact Us</a>
    </footer>

</body>
</html>

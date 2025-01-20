<?php
// Database connection
include('config.php');

// Display errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize form data
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $imageName = $_FILES['cake_image']['name'];
    $imageTmpName = $_FILES['cake_image']['tmp_name'];
    $imageSize = $_FILES['cake_image']['size'];
    $imageError = $_FILES['cake_image']['error'];

    // Validate file upload
    if ($imageError === 0) {
        $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];

        // Check if the file type is allowed
        if (in_array($imageExt, $allowedExts)) {
            if ($imageSize < 5000000) { // 5MB size limit
                // Generate unique file name
                $newImageName = uniqid('', true) . "." . $imageExt;
                $imageDestination = __DIR__ . "/uploads/" . $newImageName;

                // Check if the uploads/ directory exists
                if (!is_dir(__DIR__ . "/uploads")) {
                    mkdir(__DIR__ . "/uploads", 0777, true);
                }

                // Move the uploaded file
                if (move_uploaded_file($imageTmpName, $imageDestination)) {
                    // Insert into database
                    $sql = "INSERT INTO customized_cakes (image, comment) VALUES ('$newImageName', '$comment')";
                    if (mysqli_query($conn, $sql)) {
                        // Success message and redirection
                        echo "<script>
                                alert('Your order has been received!');
                                window.location.href = 'category.php';
                              </script>";
                        exit;
                    } else {
                        echo "Database error: " . mysqli_error($conn);
                    }
                } else {
                    echo "Failed to move the uploaded file. Check folder permissions.";
                }
            } else {
                echo "File is too large. Max size is 5MB.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
        }
    } else {
        echo "Error uploading the file. Error code: $imageError.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customize Your Cake - A&N Cakes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">
            <img src="images/logo.jpg" alt="A&N Cakes Logo">
        </div>
        <a href="home.php">Home</a>
        <a href="customize-cake.php">Order Online</a>
        <a href="login.php">Category</a>
        <a href="login.php">Login</a>
    </div>

    <!-- Cake Customization Form -->
    <div class="customize-cake-container">
        <h2>Customize Your Cake</h2>
        <form action="customize-cake.php" method="POST" enctype="multipart/form-data">
            <label for="cake_image">Upload Your Custom Cake Image:</label>
            <input type="file" name="cake_image" id="cake_image" required>
            <br>

            <label for="comment">Your Comments or Special Requests:</label>
            <textarea name="comment" id="comment" rows="4" cols="50" placeholder="Enter any special customization requests..." required></textarea>
            <br>

            <button type="submit" name="submit">Submit Customization</button>
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <a href="#">Facebook</a>
        <a href="#">WhatsApp</a>
        <a href="#">Instagram</a>
        <a href="#">Contact Us</a>
    </footer>
</body>
</html>

<?php
session_start();

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$cakes = [
    ['name' => 'Wedding Cake 1', 'image' => 'images/1.jpg', 'price' => '2500' ],
    ['name' => 'Wedding Cake 2', 'image' => 'images/2.jpg', 'price' => '3000'],
    ['name' => 'Birthday Cake 1', 'image' => 'images/3.jpg', 'price' => '2000'],
    ['name' => 'Christmas Cake 1', 'image' => 'images/4.jpg', 'price' => '1800'],
    ['name' => 'Party Cake 1', 'image' => 'images/5.jpg', 'price' => '2200'],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cakes Category - A&N Cakes</title>
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

<!-- Cakes Category Section -->
<div class="category-container">
    <h2>Our Cakes</h2>
    <form id="cake-order-form">
        <div class="cakes-grid">
            <?php
            // Loop through each cake and display its image and price
            foreach ($cakes as $index => $cake) {
                echo '<div class="cake-card">';
                echo '<input type="checkbox" name="cake[]" value="' . $index . '" class="cake-checkbox" data-price="' . $cake['price'] . '">';
                echo '<img src="' . $cake['image'] . '" alt="' . $cake['name'] . '" class="cake-image">';
                echo '<h3>' . $cake['name'] . '</h3>';
                echo '<p class="cake-price">Rs ' . $cake['price'] . '</p>';
                echo '</div>';
            }
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
        </div>

        <div class="total-price">
            <p>Total Price: Rs <span id="total-price">0.00</span></p>
        </div>

        <button type="button" id="whatsapp-button">Order via WhatsApp</button>
    </form>
</div>

<!-- Location and Ordering Info -->
<div class="info-section">
    <h2>Order Online or Visit Us</h2>
    <p>Our cakes are available for online orders and pick-up. Visit our shop at:</p>
    <p><strong>Address:</strong> 123 Cake Street, Sweet City, 45678</p>
    <p><strong>Phone:</strong> +94 77 123 4567</p>
    <p>For navigation, <a href="https://maps.google.com/?q=123+Cake+Street">click here</a> to open Google Maps.</p>
</div>

<!-- Footer Section -->
<footer>
    <a href="#">Facebook</a>
    <a href="#">WhatsApp</a>
    <a href="#">Instagram</a>
    <a href="#">Contact Us</a>
</footer>

<script>
    // Calculate total price
    document.querySelectorAll('.cake-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateTotalPrice);
    });

    function updateTotalPrice() {
        let totalPrice = 0;
        document.querySelectorAll('.cake-checkbox:checked').forEach(checkbox => {
            totalPrice += parseFloat(checkbox.dataset.price);
        });
        document.getElementById('total-price').textContent = totalPrice.toFixed(2);
    }

    // WhatsApp Button
    document.getElementById('whatsapp-button').addEventListener('click', () => {
        const selectedCakes = Array.from(document.querySelectorAll('.cake-checkbox:checked')).map(checkbox => checkbox.value);
        if (selectedCakes.length > 0) {
            const message = `Hello, I would like to order these cakes: ${selectedCakes.join(', ')}`;
            window.open(`https://wa.me/94771234567?text=${encodeURIComponent(message)}`, '_blank');
        } else {
            alert('Please select at least one cake.');
        }
    });
</script>
</body>
</html>

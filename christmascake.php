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

<style>
    /* Snowflake styles */
.snowflake {
    position: fixed;
    top: -50px;
    z-index: 1000;
    font-size: 24px;
    color: white;
    opacity: 0.8;
    pointer-events: none;
    animation: fall linear infinite;
}

/* Keyframes for snowflake animation */
@keyframes fall {
    0% {
        transform: translateY(0) rotate(0deg);
    }
    100% {
        transform: translateY(100vh) rotate(360deg);
    }
}

</style>

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

<script>
    // Snowflake generation script
function createSnowflake() {
    const snowflake = document.createElement('div');
    snowflake.classList.add('snowflake');
    snowflake.textContent = '❄';

    // Random horizontal position
    snowflake.style.left = Math.random() * window.innerWidth + 'px';
    
    // Random animation duration and delay
    snowflake.style.animationDuration = Math.random() * 3 + 2 + 's'; // Between 2-5 seconds
    snowflake.style.animationDelay = Math.random() * 2 + 's'; // Up to 2 seconds

    document.body.appendChild(snowflake);

    // Remove snowflake after animation ends
    snowflake.addEventListener('animationend', () => {
        snowflake.remove();
    });
}

// Generate snowflakes at intervals
setInterval(createSnowflake, 200);

</script>
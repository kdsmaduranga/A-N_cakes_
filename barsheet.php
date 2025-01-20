<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cakes Category - A&N Cakes</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

<!-- Most Sold Items Section -->
<div class="most-sold-items">
    <h2>Most Sold Items</h2>
    <canvas id="salesChart"></canvas>
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

    // Bar Chart for Most Sold Items
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesData = {
        labels: ['Wedding Cake 1', 'Wedding Cake 2', 'Birthday Cake 1', 'Christmas Cake 1', 'Party Cake 1'],
        datasets: [{
            label: 'Most Sold Items (Units)',
            data: [120, 95, 80, 60, 45], // Example data
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
            borderWidth: 1
        }]
    };

    new Chart(ctx, {
        type: 'bar',
        data: salesData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
</html>

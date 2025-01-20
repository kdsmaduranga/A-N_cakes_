<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Group Members</title>
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

    <div class="container">
        <?php
        // Member data (name, image, email)
        $members = [
            ["name" => "Samitha", "image" => "samitha.jpg", "email" => "samitha@example.com"],
            ["name" => "Dilan", "image" => "dilan.jpg", "email" => "dilan@example.com"],
            ["name" => "Hiranya", "image" => "hiranya.jpg", "email" => "hiranya@example.com"],
            ["name" => "Prasantha", "image" => "prasantha.jpg", "email" => "prasantha@example.com"],
            ["name" => "Sayuni", "image" => "sayuni.jpg", "email" => "sayuni@example.com"],
            ["name" => "Esandi", "image" => "esandi.jpg", "email" => "esandi@example.com"],
            ["name" => "Shashrika", "image" => "shashrika.jpg", "email" => "shashrika@example.com"]
        ];

        // Loop through each member and display their info
        foreach ($members as $member) {
            echo "<div class='member'>";
            echo "<img src='images/{$member['image']}' alt='{$member['name']}'>";
            echo "<h3>{$member['name']}</h3>";
            echo "<p><a href='mailto:{$member['email']}'>{$member['email']}</a></p>";
            echo "</div>";
        }
        ?>
    </div>
    <footer>
        <a href="#">Facebook</a>
        <a href="#">WhatsApp</a>
        <a href="#">Instagram</a>
        <a href="#">Contact Us</a>
    </footer>

</body>
</html>
<script>
    window.onload = function() {
        const members = document.querySelectorAll('.member');
        members.forEach((member, index) => {
            setTimeout(() => {
                member.style.opacity = 1;
                member.style.transition = 'opacity 1s';
            }, index * 300);
        });
    };
</script>


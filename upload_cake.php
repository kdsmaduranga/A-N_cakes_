<?php
// Include database configuration
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle cake image upload
    if (isset($_FILES['cake_image']) && $_FILES['cake_image']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["cake_image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is a valid image
        $check = getimagesize($_FILES["cake_image"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
        } else {
            // Move uploaded file
            if (move_uploaded_file($_FILES["cake_image"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["cake_image"]["name"]) . " has been uploaded.<br>";
            } else {
                echo "Sorry, there was an error uploading your file.<br>";
            }
        }
    }

    // Handle comment submission
    if (isset($_POST['comment'])) {
        $comment = $_POST['comment'];

        // Insert comment into the database
        $sql = "INSERT INTO comments (comment_text) VALUES (:comment_text)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':comment_text', $comment, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "Comment added successfully!";
        } else {
            echo "Error adding comment.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form action="upload_cake.php" method="POST" enctype="multipart/form-data">
    <label for="cake_image">Upload Cake Image:</label>
    <input type="file" name="cake_image" id="cake_image" required><br><br>
    <button type="submit">Upload Cake</button>
</form>

<form action="upload_cake.php" method="POST">
    <label for="comment">Leave a Comment:</label>
    <textarea name="comment" id="comment" required></textarea><br><br>
    <button type="submit">Submit Comment</button>
</form>
<div class="chart">
    <div class="bar bar-1">
        <span>4.5</span>
        <div class="tooltip">Rating: 4.5</div>
    </div>
    <div class="bar bar-2">
        <span>3.0</span>
        <div class="tooltip">Rating: 3.0</div>
    </div>
    <div class="bar bar-3">
        <span>4.8</span>
        <div class="tooltip">Rating: 4.8</div>
    </div>
    <div class="bar bar-4">
        <span>3.5</span>
        <div class="tooltip">Rating: 3.5</div>
    </div>
    <div class="bar bar-5">
        <span>5.0</span>
        <div class="tooltip">Rating: 5.0</div>
    </div>
</div>

    
</body>
</html>
<!-- Cake Upload and Comment Section Form -->


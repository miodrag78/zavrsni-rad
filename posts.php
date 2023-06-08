<?php

$servername = "localhost";
$username = "comi";
$password = "comi123_ABC";
$dbname = "blog";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Postavljanje karakter seta konekcije na utf8mb4
    $conn->set_charset("utf8mb4");

    $sql = "SELECT * FROM posts ORDER BY Created_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $postId = $row['Id'];
            $postTitle = $row['Title'];
            $postBody = $row['Body'];
            $postAuthor = $row['Author'];
            $postCreatedAt = $row['Created_at'];

            echo "<div class='blog-post'>";
            echo "<h2><a href='single-post.php?post_id=$postId'>$postTitle</a></h2>";
            echo "<p class='blog-post-meta'>Posted by $postAuthor on $postCreatedAt</p>";
            //echo "<p>$postBody</p>";
            echo "</div>";
        }
    } else {
        echo "No posts found.";
    }

    $conn->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>

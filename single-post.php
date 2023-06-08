
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

            if (isset($_GET['post_id'])) {
                $postId = $_GET['post_id'];

                $sql = "SELECT * FROM posts WHERE Id = $postId";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $postTitle = $row['Title'];
                    $postBody = $row['Body'];
                    $postAuthor = $row['Author'];
                    $postCreatedAt = $row['Created_at'];

                    echo "<div class='blog-post'>";
                    echo "<h2>$postTitle</h2>";
                    echo "<p class='blog-post-meta'>Posted by $postAuthor on $postCreatedAt</p>";
                    echo "<p>$postBody</p>";
                    echo "</div>";

                    $sqlComments = "SELECT * FROM comments WHERE Post_id = $postId";
                    $resultComments = $conn->query($sqlComments);

                    if ($resultComments->num_rows > 0) {
                        echo "<h3>Comments</h3>";
                        echo "<ul>";
                        while ($rowComment = $resultComments->fetch_assoc()) {
                            $commentAuthor = $rowComment['Author'];
                            $commentText = $rowComment['Text'];

                            echo "<li><strong>$commentAuthor:</strong> $commentText</li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<p>No comments found.</p>";
                    }
                } else {
                    echo "<p>Invalid post ID.</p>";
                }
            } else {
                echo "<p>Post ID not provided.</p>";
            }

            $conn->close();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
    </div><!-- /.blog-main -->

    
</div><!-- /.row -->


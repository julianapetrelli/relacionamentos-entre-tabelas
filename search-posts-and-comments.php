<?php 

$conn = require __DIR__.'/utils/connection.php';

$one_to_one = 'SELECT * FROM posts LEFT JOIN comments ON posts.id = comments.post_id WHERE posts.id = 8';

$result = $conn->query($one_to_one);

$posts = $result->fetch_all(MYSQLI_ASSOC);

var_dump($posts);
exit;
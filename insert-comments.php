<?php

$conn = require __DIR__.'/utils/connection.php';

$conn->query('TRUNCATE comments');

$sql = file_get_contents(__DIR__.'/insert-comments.sql');

$conn->begin_transaction();
$conn->query($sql);
$conn->commit();

$result = $conn->query('SELECT * FROM comments');

$comments = $result->fetch_All(MYSQLI_ASSOC);

foreach ($comments as $post) {
    echo $post['email']. PHP_EOL;
    echo $post['comment']. PHP_EOL;
    echo $post['post_id']. PHP_EOL;
    echo PHP_EOL;
} 
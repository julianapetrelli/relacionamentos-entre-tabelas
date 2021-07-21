<?php

$conn = require __DIR__.'/utils/connection.php';

$conn->query('DROP TABLE posts');

$sql = '
    CREATE TABLE IF NOT EXISTS posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(50) NOT NULL,
        body TEXT NOT NULL,
        FULLTEXT KEY title (title,body)
    ) 
';

$result = $conn->query($sql);

if (!$result) {
    die('SQL ERROR');
}

var_dump($result);
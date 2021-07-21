<?php

$conn = require __DIR__.'/utils/connection.php';

$conn->query('DROP TABLE comments');

$sql = '
    CREATE TABLE comments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(100) NOT NULL,
        comment VARCHAR(100) NOT NULL,
        post_id INT NOT NULL,
        FOREIGN KEY (post_id) REFERENCES posts(id)
    )
';

$debug = True;

if ($debug) {
	mysqli_report(MYSQLI_REPORT_ERROR);
}

$result = $conn->query($sql);



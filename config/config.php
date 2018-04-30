<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '12345');
define('DB_NAME', 'myblog');

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

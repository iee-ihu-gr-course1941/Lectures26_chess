<?php

require_once __DIR__ . '/../private/db_upass.php';

$mysqli = new mysqli(
    $DB_HOST,
    $DB_USER,
    $DB_PASS,
    $DB_NAME,
    null,
    $DB_SOCKET
);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" .
        $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

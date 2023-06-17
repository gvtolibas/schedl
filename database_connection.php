<?php
$host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'schedl';

$connection = new mysqli($host, $db_user, $db_pass, $db_name);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>

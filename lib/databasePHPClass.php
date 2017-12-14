<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "vetbase";

$db = new mysqli($host, $user, $password, $database);
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: " . $db->connect_error;
}

$db->set_charset("utf8");
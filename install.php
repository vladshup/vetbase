<?php
//include_once (dirname(__FILE__) . '/lib/loaderPHPClass.php');

$dbname = "vetbase";
$host = "localhost";
$user = "root";
$password = "";


// Create connection
$db = new mysqli($host, $user, $password);
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 

// Create database
$query = sprintf("CREATE DATABASE IF NOT EXISTS $dbname DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci");
if ($db->query($query) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $db->error;
}

$db->close();

$db = new mysqli($host, $user, $password, $dbname);
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: " . $db->connect_error;
}
$db->set_charset("utf8");

//Create "owners"
$query = sprintf("CREATE TABLE IF NOT EXISTS owners (
id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
fio VARCHAR(128) NOT NULL,
FULLTEXT fio (fio),
phone VARCHAR(16) NOT NULL,
address VARCHAR(128) NOT NULL,
data INT(11) NOT NULL,
lastcall INT(11) NOT NULL DEFAULT 0
)");

if ($db->query($query) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating database: " . $db->error;
}



//Create "pets"
$query = sprintf("CREATE TABLE IF NOT EXISTS pets (
id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
ownerid INT(11) NOT NULL,
petname VARCHAR(64) NOT NULL,
kind VARCHAR(24) NOT NULL,
sex VARCHAR(1) NOT NULL,
birthday INT(11) NOT NULL,
sterilized INT(1) NOT NULL DEFAULT 0,
rabies INT(11) NOT NULL DEFAULT 0,
infection INT(11) NOT NULL DEFAULT 0,
lastcall INT(11) NOT NULL DEFAULT 0,
lastchange INT(11) NOT NULL DEFAULT 0
)");

if ($db->query($query) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating database: " . $db->error;
}



$db->close();
//header("Location: http://localhost/");
?>
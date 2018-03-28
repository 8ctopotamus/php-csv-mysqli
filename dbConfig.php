<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

//DB details
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'truck_data';

//Create connection and select DB
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Unable to connect database: " . $conn->connect_error);
}


// Set up tables
$table = "TRUCKS";
$query = "SELECT id FROM " . $table;
$result = mysqli_query($conn, $query);

if (empty($result)) {
  echo "<p>" . $table . " table does not exist so one is being created as we speak.</p>";
    $query = mysqli_query($conn, "CREATE TABLE IF NOT EXISTS $table (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
   `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
   `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
   `created` datetime NOT NULL,
   `modified` datetime NOT NULL,
   `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
   PRIMARY KEY (`id`)
  )");

} else {
  // echo "<p>" . $table . " table already exists</p>";
}

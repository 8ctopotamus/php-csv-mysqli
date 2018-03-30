<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

//DB details
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'wpfmt_vehicle_data';

//Create connection and select DB
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Unable to connect database: " . $conn->connect_error);
}

// set up tables
include('trucks.php');

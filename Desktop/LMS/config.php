<?php
// creation des variables pour la lisibilite
$servername = "localhost";
$username = "root";
$password = "";
$dbname= "cours_section";

// Create connection
// etablir la connexion avec mysqli
$conn = new mysqli($servername, $username, $password,$dbname);
// $conn->select_db($dbname);

// Check connection
if ($conn->connect_error) {
    // echo 'inside the function';
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>
<?php

$conn = new mysqli("localhost", "root", "", "parfum");

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>
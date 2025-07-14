<?php
$conn = mysqli_connect("172.60.0.15", "ETU004222", "KG3a4d84", "db_s2_ETU004222");

if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}
?>

<?php
$host = "localhost";
$dbname = "dbe1latawpjfvx";
$username = "ueyhm8rqreljw";
$password = "gutn2hie5vxa";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

<?php
// Laboratório didático local - use somente em localhost/ambiente controlado.
$host = "localhost";
$user = "root";
$pass = "";
$db   = "aula_sql_injection";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>

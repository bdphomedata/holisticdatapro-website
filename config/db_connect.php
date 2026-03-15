<?php
// config/db_connect.php

$serverName = "bdphdwebsite.database.windows.net";
$database   = "BDPHD";
$username   = "WebSubscriber";
$password   = "HDLinkMaster2026";

try {
    // 1. Connection String for Azure SQL using PDO
    $conn = new PDO(
        "sqlsrv:server=$serverName;Database=$database;Encrypt=true;TrustServerCertificate=true", 
        $username, 
        $password
    );
    
    // 2. Set the PDO error mode to exception to help with troubleshooting
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // 3. Log the error and stop execution if the connection fails
    error_log("Database Connection Error: " . $e->getMessage());
    die("A technical error occurred. Please try again later.");
}
?>

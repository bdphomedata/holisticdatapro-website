<?php
// 1. Connection Details (Get these from your Azure Connection String)
$serverName = "your-server.database.windows.net"; 
$connectionOptions = array(
    "Database" => "BDPD", // Based on your screenshot
    "Uid" => "your_admin_username",
    "PWD" => "your_password"
);

// 2. Connect to Azure SQL
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// 3. Capture data from your Subscribe form
$name = $_POST['name'];
$email = $_POST['email'];
$plan = $_POST['plan'];

// 4. Insert into the Database
$sql = "INSERT INTO Users (Username, Email, IsSubscribed, HasLoggedInBefore) 
        VALUES (?, ?, ?, 0)";
$params = array($name, $email, $plan);

$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt) {
    // Redirect to a "Success" or Welcome page
    header("Location: welcome.html");
} else {
    echo "Error saving data.";
    die(print_r(sqlsrv_errors(), true));
}
?>

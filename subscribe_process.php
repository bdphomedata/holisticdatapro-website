<?php

$serverName = "bdphdwebsite.database.windows.net";

$connectionOptions = array(
    "Database" => "BDPHD",
    "Uid" => "WebSubscriber", 
    "PWD" => "HDLinkMaster2026", 
    "Encrypt" => true,
    "TrustServerCertificate" => true,
    "CharacterSet" => "UTF-8"
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// 1. Capture Form Data - Updated to match your HTML 'name' attributes exactly
$first_name   = $_POST['first_name']; 
$surname      = $_POST['surname'];
$email        = $_POST['email'];
$gender       = $_POST['gender'];
$ethnic_group = $_POST['ethnic_group'];
$country      = $_POST['country'];

// 2. Generate and Hash Temporary Password
$tempPassword = bin2hex(random_bytes(4)); // Creates 8 random characters
$hashedPassword = password_hash($tempPassword, PASSWORD_DEFAULT);

// 3. Insert into Azure SQL
// Make sure you ran: ALTER TABLE Subscribers ADD Password NVARCHAR(255);
$tsql = "INSERT INTO Subscribers (FirstName, Surname, Email, Gender, EthnicGroup, Country, Password) VALUES (?, ?, ?, ?, ?, ?, ?)";

$params = array($first_name, $surname, $email, $gender, $ethnic_group, $country, $hashedPassword);

$stmt = sqlsrv_query($conn, $tsql, $params);

if ($stmt === false) {
    $errors = sqlsrv_errors();
    if ($errors[0]['code'] == 2627) {
        echo "Error: This email is already subscribed!";
    } else {
        die(print_r($errors, true));
    }
} else {
    // 4. Send the Email
    $to = $email;
    $subject = "Welcome to the Network - Your Access Credentials";
    $headers = "From: no-reply@holisticdatapro.com\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $message = "Hello " . $first_name . ",\n\n";
    $message .= "Your registration is successful. Please use the temporary password below for your first login attempt:\n\n";
    $message .= "Password: " . $tempPassword . "\n\n";
    $message .= "Regards,\nHolistic Data Pro Team";

    mail($to, $subject, $message, $headers);

    // 5. Redirect to your GitHub success page
    header("Location: https://holisticdatapro.com/success.html");
    exit();
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

?>

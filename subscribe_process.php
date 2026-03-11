<?php
// 1. LOAD THE SMTP ENGINE
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// 2. DATABASE CONNECTION
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

// 3. CAPTURE FORM DATA
$first_name   = $_POST['first_name']; 
$surname      = $_POST['surname'];
$email        = $_POST['email'];
$gender       = $_POST['gender'];
$ethnic_group = $_POST['ethnic_group'];
$country      = $_POST['country'];

// 4. GENERATE PASSWORD
$tempPassword = bin2hex(random_bytes(4)); 
$hashedPassword = password_hash($tempPassword, PASSWORD_DEFAULT);

// 5. INSERT INTO AZURE SQL
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
    // 6. SEND EMAIL VIA GMAIL SMTP (Replaces the broken mail() function)
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'bartus777microsoft@gmail.com'; 
        $mail->Password   = 'rxrcttzobecmrrtp'; // Your 16-char code with no spaces
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('bartus777microsoft@gmail.com', 'Holistic Data Pro');
        $mail->addAddress($email, $first_name); 

        $mail->isHTML(true);
        $mail->Subject = 'Welcome to the Network - Your Access Credentials';
        $mail->Body    = "
            <div style='font-family: Arial, sans-serif; padding: 20px;'>
                <h2>Hello $first_name,</h2>
                <p>Your registration is successful. Use the password below for your first login:</p>
                <p style='font-size: 1.2em; background: #f4f4f4; padding: 10px; display: inline-block;'>
                    <strong>$tempPassword</strong>
                </p>
                <p>Regards,<br>Holistic Data Pro Team</p>
            </div>";

        $mail->send();

    } catch (Exception $e) {
        // Log error silently and proceed to redirect
    }

    // 7. REDIRECT TO SUCCESS PAGE
    header("Location: https://holisticdatapro.com/success.html");
    exit();
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>

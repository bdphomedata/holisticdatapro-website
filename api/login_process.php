<?php
session_start();

// 1. DATABASE CONNECTION
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
    die(formatErrors(sqlsrv_errors()));
}

// 2. CHECK IF FORM WAS SUBMITTED
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = filter_var($_POST['user_email'], FILTER_SANITIZE_EMAIL);
    $user_input_password = $_POST['user_password'];

    // 3. THE SQL QUERY
    // We only search by Email. We fetch the Password (the hash) to check it in PHP.
    $tsql = "SELECT SubscriberID, FirstName, Password FROM Subscribers WHERE Email = ?";
    $params = array($email);

    $getResults = sqlsrv_query($conn, $tsql, $params);

    if ($getResults === false) {
        die(formatErrors(sqlsrv_errors()));
    }

    // 4. VALIDATION LOGIC
    if ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
        
        $hashedPasswordFromDB = $row['Password'];

        // Use password_verify to check if the typed password matches the scrambled hash
        if (password_verify($user_input_password, $hashedPasswordFromDB)) {
            // SUCCESS: Credentials match!
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $row['SubscriberID']; // Match the column in your schema
            $_SESSION['user_name'] = $row['FirstName'];   // Match the capital letters in your schema

            header("Location: ../dashboard.php");
            exit();
        } else {
            // PASSWORD WRONG
            header("Location: ../login.html?error=1");
            exit();
        }
    } else {
        // EMAIL NOT FOUND
        header("Location: ../login.html?error=1");
        exit();
    }
}

function formatErrors($errors) {
    $output = "Connection Error Details: <br/>";
    foreach ($errors as $error) {
        $output .= "Message: ".$error['message']."<br/>";
    }
    return $output;
}
?>

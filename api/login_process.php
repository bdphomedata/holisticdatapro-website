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
    $tsql = "SELECT SubscriberID, FirstName, Password FROM Subscribers WHERE Email = ?";
    $params = array($email);

    $getResults = sqlsrv_query($conn, $tsql, $params);

    if ($getResults === false) {
        die(formatErrors(sqlsrv_errors()));
    }

    // 4. VALIDATION LOGIC
    if ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
        
        $hashedPasswordFromDB = $row['Password'];

        if (password_verify($user_input_password, $hashedPasswordFromDB)) {
            // SUCCESS: Set variables needed by dashboard.php
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $row['SubscriberID']; 
            $_SESSION['user_name'] = $row['FirstName'];
            $_SESSION['user_email'] = $email; // CRITICAL FIX

            header("Location: ../dashboard.php");
            exit();
        } else {
            header("Location: ../login.php?error=1");
            exit();
        }
    } else {
        header("Location: ../login.php?error=1");
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

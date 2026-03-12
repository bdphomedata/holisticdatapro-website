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

// Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(formatErrors(sqlsrv_errors()));
}

// 2. CHECK IF FORM WAS SUBMITTED
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Catching the 'user_email' and 'user_password' from the login.html form
    $email = filter_var($_POST['user_email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['user_password'];

    // 3. THE SQL QUERY
    // This checks your BDPHD database for a match in the Users table
    $tsql = "SELECT SubscriberID, FirstName FROM Subscribers WHERE Email = ? AND Password = ?";
    $params = array($email, $password);

    $getResults = sqlsrv_query($conn, $tsql, $params);

    if ($getResults === false) {
        die(formatErrors(sqlsrv_errors()));
    }

    // 4. VALIDATION LOGIC
    if ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
        // SUCCESS: Credentials match!
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $row['UserID'];
        $_SESSION['user_name'] = $row['first_name'];

        // Redirect up to your dashboard
        header("Location: ../dashboard.php");
        exit();
    } else {
        // FAILURE: Send back to login with the error flag we built into the HTML
        header("Location: ../login.html?error=1");
        exit();
    }
}

// Error formatting for easier troubleshooting
function formatErrors($errors) {
    $output = "Connection Error Details: <br/>";
    foreach ($errors as $error) {
        $output .= "Message: ".$error['message']."<br/>";
    }
    return $output;
}
?>

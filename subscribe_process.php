<?php

$serverName = "bdphdwebsite.database.windows.net";

$connectionOptions = array(
"Database" => "BDPHD",
"Uid" => "BDPHD",
"PWD" => "HDLinkMaster001!"
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
die(print_r(sqlsrv_errors(), true));
}

$first_name   = $_POST['first_name'];
$surname      = $_POST['surname'];
$email        = $_POST['email'];
$gender       = $_POST['gender'];
$ethnic_group = $_POST['ethnic_group'];
$country      = $_POST['country'];

$tsql = "INSERT INTO Subscribers (FirstName, Surname, Email, Gender, EthnicGroup, Country) VALUES (?, ?, ?, ?, ?, ?)";

$params = array($first_name, $surname, $email, $gender, $ethnic_group, $country);

$stmt = sqlsrv_query($conn, $tsql, $params);

if ($stmt === false) {
$errors = sqlsrv_errors();
if ($errors[0]['code'] == 2627) {
echo "Error: This email is already subscribed!";
} else {
die(print_r($errors, true));
}
} else {
echo "Success! Welcome to the Network.";
}

sqlsrv_free_stmt($stmt);

sqlsrv_close($conn);

?>

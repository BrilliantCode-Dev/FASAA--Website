<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "drugform";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first-name"];
    $last_name = $_POST["last-name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    $err = "";
    $email_err = "";
    $success="";

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format";
    }

    
    if (empty($first_name) || empty($last_name) || empty($email) || empty($message)) {
        $err = "Please fill in all fields";
    } elseif ($email_err) {
        $err = $email_err;
    } else {
        
        $sql = "INSERT INTO contacts (first_name, last_name, email, message) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("ssss", $first_name, $last_name, $email, $message);
        $stmt->execute();

       
        $success = "Message sent successfully!";
    }
    }


$conn->close();
?>
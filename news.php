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
    $email = $_POST["email"];
    $err = "";
    $email_err = "";
    $success="";

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format";
    }

    
    if ( empty($email) ) {
        $err = "Please fill in all fields";
    } elseif ($email_err) {
        $err = $email_err;
    } else {
        
        $sql = "INSERT INTO news ( email) VALUES (?)";
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("s",  $email, );
        $stmt->execute();

       
        $success = "Message sent successfully!";
    }
    }


$conn->close();
?>
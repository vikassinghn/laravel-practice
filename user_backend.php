<?php
require_once 'db_connect.php';
session_start();
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phoneno'];
$address = $_POST['address'];
$error = false;
$_SESSION['name_error'] = $_SESSION['email_error'] = $_SESSION['phone_error'] = $_SESSION['address_error'] = ' ';
// Check if email is empty
if (empty($name)) {
    $_SESSION['name_error'] = "Name is required!";
    $error = true;
} elseif (empty($email)) {
    // echo "Email is required!";
    $_SESSION['email_error'] = "Email is required!";
    $error = true;
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['email_error'] = "Invalid Email!";
    $error = true;
} else {
    $sql = "select * from user_reg where email = '$email'";
    $result = $conn->query($sql);
    $exist_email = $result->num_rows;
    if ($exist_email > 0) {
        $_SESSION['email_error'] = "Email already exist!";
        $error = true;
    } else {

        $sql = "INSERT INTO user_reg (name, email, phone, address) VALUES ('$name', '$email','$phone','$address')";
    }
}
if (empty($phone)) {
    $_SESSION['phone_error'] = "Phone No is required!";
    $error = true;
}
if (empty($address)) {
    $_SESSION['address_error'] = "Address is required!";
    $error = true;
}

if ($error) {
    header("Location: user_frontend.php");
    exit;
}

if ($conn->query($sql) === TRUE) {
    echo "✅ New record created!";
} else {
    echo "❌ Error: " . $conn->error;
}

$conn->close();

header("Location: list.php");

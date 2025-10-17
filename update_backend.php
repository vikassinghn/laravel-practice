<?php
session_start();
require_once 'db_connect.php';
$id = $_POST['user_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phoneno'];
$address = $_POST['address'];
$error = false;
$_SESSION['name_error'] = $_SESSION['email_error'] = $_SESSION['phone_error'] = $_SESSION['address_error'] = '';
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
    $sql = "select * from user_reg where email = '$email' AND id !='$id'";
    $result = $conn->query($sql);
    $exist_email = $result->num_rows;
    if ($exist_email > 0) {
        $_SESSION['email_error'] = "Email already exist!";
        $error = true;
    } else {

        $sql = "UPDATE user_reg SET name = '$name',email ='$email',phone = '$phone',address = '$address' WHERE id ='$id'";
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
// unset($_SESSION['id']);
if ($error) {
    header("Location: update_frontend.php?id=$id");
    exit;
}

if ($conn->query($sql) === TRUE) {
    echo "✅ New record created!";
} else {
    echo "❌ Error: " . $conn->error;
}

$conn->close();

header("Location: list.php");

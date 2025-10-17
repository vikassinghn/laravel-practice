<?php
require_once 'db_connect.php';
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM user_reg WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: list.php?msg=User+deleted+successfully");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

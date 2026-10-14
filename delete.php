<?php

include 'config.php';
include 'auth.php';
require_admin();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = mysqli_prepare($conn, "DELETE FROM students WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

}
header("Location: index.php?msg=deleted");
exit;
?>
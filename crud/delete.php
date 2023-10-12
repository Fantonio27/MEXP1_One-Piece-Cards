<?php

    include './db.php';
    $paramid = $_POST['id'];

    $sql = "DELETE FROM characters WHERE id=$paramid";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record deleted successfully')</script>";
        header("Location: ../dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>
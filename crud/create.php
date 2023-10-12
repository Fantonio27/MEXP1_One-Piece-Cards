<?php
include './db.php';

if (isset($_POST['submit'])) {


    $image = $_FILES['image']['tmp_name'];
    $imgContent = addslashes(file_get_contents($image));
    $name = $_POST["name"];
    $type = $_POST["type"];
    $short = $_POST["short"];
    $desc = $_POST["description"];

    $sql = "INSERT INTO `characters`(`name`, `type`, `short`, `description`,`image`) 
    VALUES ('$name','$type','$short','$desc', '$imgContent')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record inserted successfully')</script>";
        header("Location: ../dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
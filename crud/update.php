<?php
// Replace these variables with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "onepiecedb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $PRKEY = $_POST["update"];
    $Nimage = $_FILES['Newimage']['tmp_name'];
    $NewimgContent = addslashes(file_get_contents($Nimage));
    $newName = $_POST["newName"];
    $newType = $_POST["newType"];
    $newShort = $_POST["newShort"];
    $newDesc = $_POST["newDesc"];

    // SQL query to update data
    $sql = "UPDATE `characters` SET `ID`='$NewimgContent',`Name`='$newName',`Type`='$newType',`Short`='$newShort',`Desc`='$newDesc' WHERE PRKEY=$PRKEY";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
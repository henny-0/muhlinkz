<?php
// Create connection
$conn = new mysqli($servername, $uname, $pwd, $dbname);
// Check connection
if ($conn->connect_error) {
    echo ("<h3 style='color:red;text-align:center;'>Error Connecting to Server</h3>");
}

session_start();

$sql =  $conn->prepare("INSERT INTO linktbl (title, dsc, link, username) VALUES (?,?,?,?)");
$sql->bind_param("ssss",$linkTitle, $dsc, $url, $username);
$linkTitle = $_POST["title"];
$dsc = $_POST["dsc"];
$url = $_POST["url"];
$username = $_SESSION["username"];

// Creating Record and checking to ensure record is created else connection error is displayed
if ($sql->execute() === true) {
    echo "<h5 id = 'notif'>New Link Added Successfully!</h5>";
} 
else {
    echo "<h5 id = 'notif'>Error:" . $sql->errno . "<br>" . $sql->error . "</h5>";
}
$sql->close();
$conn->close();

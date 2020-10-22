<<<<<<< Updated upstream
<?php
include "serve.php";
// Create connection
$conn = new mysqli($servername, $uname, $pwd, $dbname);

// Check connection
if ($conn->connect_error) {
    die ("<h3 id = 'notif'>Error Connecting to Server</h3>");
} else {
    if (session_id()==null){
        session_start();
    }
    // Select data from table
    $sql = "SELECT * FROM linktbl WHERE username='". $_SESSION['username'] ."' AND (lower(title) like '%" . $search . "%' or lower(link) like '%" . $search . "%' or lower(link) like '%" . $search . "%') order by date desc";
    $result = $conn->query($sql);
    $resnum = $result->num_rows;
    if ($resnum != 0)
    {
        if ($resnum > 1){
            echo "<h5 id = 'notif'>" . $resnum . " Results Found!</h5>";
        }
        else if ($resnum == 1){
            echo "<h5 id = 'notif'>" . $resnum . " Result Found!</h5>"; 
        }
    }
    include "tbl.php";
    
}
$conn->close();

?>
=======
<?php
include "serve.php";
// Create connection
$conn = new mysqli($servername, $uname, $pwd, $dbname);

// Check connection
if ($conn->connect_error) {
    die ("<h3 id = 'notif'>Error Connecting to Server</h3>");
} else {
    if (session_id()==null){
        session_start();
    }
    // Select data from table
    $sql = "SELECT * FROM linktbl WHERE username='". $_SESSION['username'] ."' AND (lower(title) like '%" . $search . "%' or lower(link) like '%" . $search . "%' or lower(link) like '%" . $search . "%') order by date desc";
    $result = $conn->query($sql);
    $resnum = $result->num_rows;
    if ($resnum != 0)
    {
        if ($resnum > 1){
            echo "<h5 id = 'notif'>" . $resnum . " Results Found!</h5>";
        }
        else if ($resnum == 1){
            echo "<h5 id = 'notif'>" . $resnum . " Result Found!</h5>"; 
        }
    }
    include "tbl.php";
    
}
$conn->close();

?>
>>>>>>> Stashed changes

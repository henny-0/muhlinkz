<?php 
static $TITLE = "View All Links";
include './resources/serve.php';
ob_start();
?>

<h2>View All Links</h2>
<?php
 // Create connection
$conn = new mysqli($servername, $uname, $pwd, $dbname);

// Check connection
if ($conn->connect_error) {
  echo ("<h3 style='color:red;text-align:center;'>Error Connecting to Server</h3>");
} else {

  if (session_id()==null){
      session_start();
  }
  
  // Select data from table
  $sql = "SELECT * FROM linktbl WHERE username = '" . $_SESSION['username'] . "' order by date desc";
  $result = $conn->query($sql);
  include "./resources/tbl.php";
}
$conn->close();
?>

<?php
$CONTENT = ob_get_clean();
include "./resources/template.html";
?> 
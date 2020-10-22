<?php

include './resources/serve.php';
// Create connection
$conn = new mysqli($servername, $uname, $pwd, $dbname);
$display = "";
$id = $_POST['id'];
$linkTitle = "";
$dsc = "";
$url = ""; 

// Check connection
if ($conn->connect_error) {
    echo ("<h3 style='color:red;text-align:center;'>Error Connecting to Server</h3>");
}

if(isset($_POST["delete"])){
    $sql = "DELETE from linktbl where id =" . $id;   
    
    if ($conn->query($sql) === true) {
        $display = "<h5 id = 'notif'>Link Deleted... <br/><br/> Redirecting, Please Wait...</h5>".
        "<script>
    
        function redirect(){
            location.href='./';
        }
    
        setTimeout(redirect, 3000);
        </script>";    
    } 
    else {
        $display = "<h3 id = 'notif'>Error: " . mysqli_error($conn) . "</h3>";
    }    

    
}
else{    
    if (isset($_POST["edit"])){
        $sql =  $conn->prepare("UPDATE linktbl SET title=?, dsc=?, link=? WHERE id =" . $_POST['id']);
        $sql->bind_param("sss",$linkTitle, $dsc, $url);
        $linkTitle = $_POST["title"];
        $dsc = $_POST["dsc"];
        $url = $_POST["url"];
        // Creating Record and checking to ensure record is created else connection error is displayed
        if ($sql->execute() === true) {
            $display = "<h3 id = 'notif'>Link modified successfully</h3>";
        } 
        else {
            $display = "<h3 id = 'notif'>Error:" . $sql->errno . "<br>" . $sql->error . "</h3>";
        }
        $sql->close();
    }
    if (isset ($_POST['id'])){
        if (session_id()==null){
            session_start();
        }
        $id = $_POST['id'];
        $sql = "SELECT * from linktbl where username='". $_SESSION['username'] ."' AND id =" . $id . " LIMIT 1;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1){
            while($row = mysqli_fetch_assoc($result)){
                $id = $row["id"];
                $linkTitle = $row["title"];
                $dsc = $row["dsc"];
                $url = $row["link"];
            }  
        } else{
            header('location: index');
        }
    }
}
?>
<?php 
  static $TITLE = "Edit";
  ob_start();
  ?>
  
  <h2>Edit Link</h2>
  <?php echo $display;?>
  <form action="edit" method="POST" id="edit">
    <!-- Modiify Link -->
    <input type = "text" name = "id" id = "id" style="position:absolute; left: -100000px;" value = <?php echo $id;?>> 
    <label for= "title">Title:</label> <br />
    <input type="text" name="title" id ="title" maxlength="20" minlength="5" placeholder="Enter Title Here" value = "<?php echo $linkTitle; ?>" required><br />
    <label for= "dsc">Description:</label> <br />
    <script> getElementById('dsc').value = </script>
    <textarea name="dsc" id ="dsc" maxlength="255" minlength="0" placeholder="Enter A Short Description Here"><?php echo $dsc; ?></textarea><br />
    <label for= "url">Link/URL:</label> <br />
    <input type="url" name="url" id="url" maxlength="50" placeholder="https://www.site.com" autocomplete="off" value = "<?php echo $url; ?>" pattern="https?://.+" required>
    <br/>
    <p style='font-size:12px'>Note: Any modification/change is final once submitted. You will not receive another prompt.</p>
    <button type="submit" class = "but" name="edit" value="modify">Modify</button>
    <button type="reset" name="reset" class = "but" value="Reset">Clear</button>
    <br/><br/><br/><br/>
    <!-- Delete link -->
    <p>Do you want to delete this link completely? <i style="font-size:14px;">(No going back after this)</i></p>
    <button type="submit" class = "but" name="delete" value="Delete">Delete</button>
    
</form>
  
  <?php
  $conn->close();
  $CONTENT = ob_get_clean();
  include './resources/template.html';
?>
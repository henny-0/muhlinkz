<<<<<<< Updated upstream
<?php 
    session_start();

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login');
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: login");
    }

  static $TITLE = "Profile";
  $errors = array(); 
  include ('./resources/serve.php');
  $conn = mysqli_connect($servername, $uname, $pwd, $dbname);
  $display = "";
  $username = $_SESSION["username"];

    

  //password reset time
  if(isset($_POST['passchange'])){
    $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
    //checking this password thing is really not my jam
    if (empty($password_1)){ 
        array_push($errors, "Password is required"); 
    } else if ($password_1 != $password_2) { //I mean, no sense in checking this one if the first one is empty
    array_push($errors, "Passwords do not match");
    }
    

    if (count($errors)== 0){
      	$password = md5($password_1);//encrypt the password before saving in the database, like a boss
        //putting things into motion
        $sql =  $conn->prepare("UPDATE users SET password=? WHERE  username= '" . $username . "'");
        //bind and grind
        $sql->bind_param("s", $password);

        // Update check
        if ($sql->execute() === true) {
            $display = "<h3 id = 'notif'>Password Changed!</h3>";
        } 
        else {
            $display = "<h3 id = 'notif'>Error: " . $sql->errno . "<br>" . $sql->error . "</h3>";
        }
        $sql->close();
    }
}else if(isset($_POST['queschange'])){
    $ques = mysqli_real_escape_string($conn, $_POST['ques']);
    $ans = mysqli_real_escape_string($conn, $_POST['ans']);
    //checking this password thing is really not my jam
    if (empty($ques)) { 
        array_push($errors, "Security Question is required"); 
    }
    if (empty($ans)) { 
        array_push($errors, "Answer to Security Question is required"); 
    }

    if (count($errors)== 0){
        //putting things into motion
        $sql =  $conn->prepare("UPDATE users SET question=?, answer=?  WHERE  username= '" . $username . "'");
        //bind and grind
        $sql->bind_param("ss", $ques, $ans);

        // Update check
        if ($sql->execute() === true) {
            $display = "<h3 id = 'notif'>Security Question/Answer Changed!</h3>";
        } 
        else {
            $display = "<h3 id = 'notif'>Error: " . $sql->errno . "<br>" . $sql->error . "</h3>";
        }
        $sql->close();
    }
}else if(isset($_POST["colchange"]) || isset($_POST["defaultcol"])){
    $sql =  $conn->prepare("UPDATE theme SET backcol=?, frontcol=? WHERE username ='" . $username. "'");
    $sql->bind_param("ss", $backcol, $frontcol);
    $backcol = $_POST["col1"];
    $frontcol = $_POST["col2"];
    // Check check
    if ($sql->execute() === true) {
        if(isset($_POST["colchange"])){
            $display = "<h3 id = 'notif'>Theme Colors Changed</h3>";
        }else if(isset($_POST["defaultcol"])){
            $display = "<h3 id = 'notif'>Theme Colors Restored to Default</h3>";
        }
    } 
    else {
        $display = "<h3 id = 'notif'>Error:" . $sql->errno . "<br>" . $sql->error . "</h3>";
    }
    $sql->close();
}

    $sql = "SELECT * from theme where username = '" . $username. "' LIMIT 1;";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1){
        while($row = mysqli_fetch_assoc($result)){
            $backcol = $row["backcol"];
            $frontcol = $row["frontcol"];
        }   
    }


?>

<?php ob_start(); ?>
<h2>Profile</h2>
<?php include('./resources/errors.php'); echo $display; ?>
<!-- Theming -->
<form method="post" action="profile" id="color">
    <div class="input-group">
        <label>Change Theme Colors</label><br><br/>
        <label style="font-size: 14px;margin-right: 14px;" for="col1">Primary Color</label> &nbsp;&nbsp;
        <input type="color" name="col1" id="col1" value="<?php echo $backcol ?>"><br/><br/>
        <label style="font-size: 14px;" for="col2">Secondary Color</label>&nbsp;&nbsp;
        <input type="color" name="col2" id="col2" value="<?php echo $frontcol ?>">
    </div>
</form>
<form method="post" action="profile" id="default" style="position: absolute; left: -100000;">
    <div class="input-group">
        <input type="text" value="#ff00aa" name="col1" id="col1" ><br/><br/>
        <input type="text" value="#c22bfd" name="col2" id="col2" >
    </div>
</form>
<div>
<p style='font-size:12px'>Note: Themes may not work on Internet Explorer and other depreciated browsers. If you use colors with bad contrasting to the text colors, this site may become unusable. To change to theme colors back to the default site colors, click the 'Default' button below.</p>

    <button type="submit" form="color" class = "but" name="colchange" value="Change">Change</button>
    <button type="submit" form="default" class = "but" name="defaultcol" value="Default">Default</button>
</div>
<br/><br/>
<!-- Security question -->
<form method="post" action="profile">
    <div class="input-group">
        
        <label for="ans"> Change Security Question</label><br><br/>
        <select name="ques" id="ques">
        <option disabled selected>Choose A Question</option>
        <option value="mom">Mother's maiden name</option>
        <option value="pet">First Pet's Name</option>
        <option value="car">First Car's Model</option>
        </select>
        <input type="text" name="ans" autocomplete="off" id="ans" maxlength="20" required>
        <br/>
        <button type="submit" class = "but" name="queschange" value="Change">Change</button>
        <button type="reset" name="reset" class = "but" value="Reset">Clear</button>
    </div><br/>
</form>
<!-- Password Change -->
<form action="profile" method = "post">
    <div class="input-group"> 
        <label for="pass1">New Password</label><br>
        <input type="password" name="password_1" id="pass1" placeholder="6 characters or more" onkeypress="valPass()" minlength="6" required>
    </div>
    <div class="input-group">
        <label for="pass2">Confirm password</label><br>
        <input type="password" name="password_2" id="pass2" placeholder="Match this with the one before" onchange="valPass()" minlength="6" required>
        <br/>
        <input type="checkbox" onclick="visibility()" id="visible"> <label style="font-size:14px" for="visible">Show Password</label>
        <br/><br/>
        <button type="submit" class = "but" name="passchange" value="Change">Change</button>
        <button type="reset" name="reset" class = "but" value="Reset">Clear</button>
    </div>
</form>
  
<?php
  $CONTENT = ob_get_clean();
  include './resources/template.html';
=======
<?php 
    session_start();

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login');
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: login");
    }

  static $TITLE = "Profile";
  $errors = array(); 
  include ('./resources/serve.php');
  $conn = mysqli_connect($servername, $uname, $pwd, $dbname);
  $display = "";
  $username = $_SESSION["username"];

    

  //password reset time
  if(isset($_POST['passchange'])){
    $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
    //checking this password thing is really not my jam
    if (empty($password_1)){ 
        array_push($errors, "Password is required"); 
    } else if ($password_1 != $password_2) { //I mean, no sense in checking this one if the first one is empty
    array_push($errors, "Passwords do not match");
    }
    

    if (count($errors)== 0){
      	$password = md5($password_1);//encrypt the password before saving in the database, like a boss
        //putting things into motion
        $sql =  $conn->prepare("UPDATE users SET password=? WHERE  username= '" . $username . "'");
        //bind and grind
        $sql->bind_param("s", $password);

        // Update check
        if ($sql->execute() === true) {
            $display = "<h3 id = 'notif'>Password Changed!</h3>";
        } 
        else {
            $display = "<h3 id = 'notif'>Error: " . $sql->errno . "<br>" . $sql->error . "</h3>";
        }
        $sql->close();
    }
}else if(isset($_POST['queschange'])){
    $ques = mysqli_real_escape_string($conn, $_POST['ques']);
    $ans = mysqli_real_escape_string($conn, $_POST['ans']);
    //checking this password thing is really not my jam
    if (empty($ques)) { 
        array_push($errors, "Security Question is required"); 
    }
    if (empty($ans)) { 
        array_push($errors, "Answer to Security Question is required"); 
    }

    if (count($errors)== 0){
        //putting things into motion
        $sql =  $conn->prepare("UPDATE users SET question=?, answer=?  WHERE  username= '" . $username . "'");
        //bind and grind
        $sql->bind_param("ss", $ques, $ans);

        // Update check
        if ($sql->execute() === true) {
            $display = "<h3 id = 'notif'>Security Question/Answer Changed!</h3>";
        } 
        else {
            $display = "<h3 id = 'notif'>Error: " . $sql->errno . "<br>" . $sql->error . "</h3>";
        }
        $sql->close();
    }
}else if(isset($_POST["colchange"]) || isset($_POST["defaultcol"])){
    $sql =  $conn->prepare("UPDATE theme SET backcol=?, frontcol=? WHERE username ='" . $username. "'");
    $sql->bind_param("ss", $backcol, $frontcol);
    $backcol = $_POST["col1"];
    $frontcol = $_POST["col2"];
    // Check check
    if ($sql->execute() === true) {
        if(isset($_POST["colchange"])){
            $display = "<h3 id = 'notif'>Theme Colors Changed</h3>";
        }else if(isset($_POST["defaultcol"])){
            $display = "<h3 id = 'notif'>Theme Colors Restored to Default</h3>";
        }
    } 
    else {
        $display = "<h3 id = 'notif'>Error:" . $sql->errno . "<br>" . $sql->error . "</h3>";
    }
    $sql->close();
}

    $sql = "SELECT * from theme where username = '" . $username. "' LIMIT 1;";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1){
        while($row = mysqli_fetch_assoc($result)){
            $backcol = $row["backcol"];
            $frontcol = $row["frontcol"];
        }   
    }


?>

<?php ob_start(); ?>
<h2>Profile</h2>
<?php include('./resources/errors.php'); echo $display; ?>
<!-- Theming -->
<form method="post" action="profile" id="color">
    <div class="input-group">
        <label>Change Theme Colors</label><br><br/>
        <label style="font-size: 14px;margin-right: 14px;" for="col1">Primary Color</label> &nbsp;&nbsp;
        <input type="color" name="col1" id="col1" value="<?php echo $backcol ?>"><br/><br/>
        <label style="font-size: 14px;" for="col2">Secondary Color</label>&nbsp;&nbsp;
        <input type="color" name="col2" id="col2" value="<?php echo $frontcol ?>">
    </div>
</form>
<form method="post" action="profile" id="default" style="position: absolute; left: -100000;">
    <div class="input-group">
        <input type="text" value="#ff00aa" name="col1" id="col1" ><br/><br/>
        <input type="text" value="#c22bfd" name="col2" id="col2" >
    </div>
</form>
<div>
<p style='font-size:12px'>Note: Themes may not work on Internet Explorer and other depreciated browsers. If you use colors with bad contrasting to the text colors, this site may become unusable. To change to theme colors back to the default site colors, click the 'Default' button below.</p>

    <button type="submit" form="color" class = "but" name="colchange" value="Change">Change</button>
    <button type="submit" form="default" class = "but" name="defaultcol" value="Default">Default</button>
</div>
<br/><br/>
<!-- Security question -->
<form method="post" action="profile">
    <div class="input-group">
        
        <label for="ans"> Change Security Question</label><br><br/>
        <select name="ques" id="ques">
        <option disabled selected>Choose A Question</option>
        <option value="mom">Mother's maiden name</option>
        <option value="pet">First Pet's Name</option>
        <option value="car">First Car's Model</option>
        </select>
        <input type="text" name="ans" autocomplete="off" id="ans" maxlength="20" required>
        <br/>
        <button type="submit" class = "but" name="queschange" value="Change">Change</button>
        <button type="reset" name="reset" class = "but" value="Reset">Clear</button>
    </div><br/>
</form>
<!-- Password Change -->
<form action="profile" method = "post">
    <div class="input-group"> 
        <label for="pass1">New Password</label><br>
        <input type="password" name="password_1" id="pass1" placeholder="6 characters or more" onkeypress="valPass()" minlength="6" required>
    </div>
    <div class="input-group">
        <label for="pass2">Confirm password</label><br>
        <input type="password" name="password_2" id="pass2" placeholder="Match this with the one before" onchange="valPass()" minlength="6" required>
        <br/>
        <input type="checkbox" onclick="visibility()" id="visible"> <label style="font-size:14px" for="visible">Show Password</label>
        <br/><br/>
        <button type="submit" class = "but" name="passchange" value="Change">Change</button>
        <button type="reset" name="reset" class = "but" value="Reset">Clear</button>
    </div>
</form>
  
<?php
  $CONTENT = ob_get_clean();
  include './resources/template.html';
>>>>>>> Stashed changes
?>
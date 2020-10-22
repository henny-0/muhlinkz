<?php 
  static $TITLE = "Forgot Password";
  include('./resources/server.php');
  ob_start();
  ?>
<?php include('./resources/errors.php'); ?>
  <h2>Reset Password</h2>
  <form action="reset" method = "post">
    <div class="input-group">
  		<label>Username</label><br>
  		<input type="text" name="username" autocomplete="off" required>
      </div>
      <div class="input-group">
      <label for="ans">Security Question</label><br/>
        <select name="ques" id="ques">
        <option disabled selected>Choose A Question</option>
        <option value="mom">Mother's maiden name</option>
        <option value="pet">First Pet's Name</option>
        <option value="car">First Car's Model</option>
        </select>
        <input type="text" name="ans" id="ans" autocomplete="off" maxlength="20" required>
      </div>
      <div class="input-group"> 
        <label for="pass1">New Password</label><br>
        <input type="password" name="password_1" id="pass1" placeholder="6 characters or more" onkeypress="valPass()" minlength="6" required>
    </div>
    <div class="input-group">
        <label for="pass2">Confirm password</label><br>
        <input type="password" name="password_2" id="pass2" placeholder="Match this with the one before" onchange="valPass()" minlength="6" required>
        <br/>
    </div>
    <button type="submit" class = "but" name="passchange" value="Change">Change</button>
    <button type="reset" name="reset" class = "but" value="Reset">Clear</button><br/><br/>
    <br/>
    <label style="font-size:14px" for="login">Did you magically remember your password just now?</label>&nbsp;<a class='but' id="login" style="padding-left:10px;padding-right:10px;" href="login">Log In</a>
</form>
  
  <?php
  $CONTENT = ob_get_clean();
  include './resources/template-reg.html';
?>
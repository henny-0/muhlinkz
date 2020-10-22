<<<<<<< Updated upstream
<?php static $TITLE = "Sign up";
require_once './resources/securimage/securimage.php';
include('./resources/server.php');
ob_start();?>

<h2>Register</h2>
<form method="post" action="signup">
  <?php include('./resources/errors.php'); ?>
  <div class="input-group">
    <label for="username">Username</label><br>
    <input type="text" name="username" id="username" autocomplete="off" placeholder="No space or special characters" maxlength="10" minlength="4" value="<?php echo $username; ?>" required>
  </div>
  <div class="input-group">
    
    <label for="ans">Security Question</label><br>
    <p style='font-size:12px'>Note: Security questions are used for password recovery.</p>
    <select name="ques" id="ques">
      <option disabled selected>Choose A Question</option>
      <option value="mom">Mother's maiden name</option>
      <option value="pet">First Pet's Name</option>
      <option value="car">First Car's Model</option>
    </select>
    <input type="text" name="ans" autocomplete="off" id="ans" maxlength="20" required>
  </div>
  <div class="input-group"> 
    <label for="pass1">Password</label><br>
    <input type="password" name="password_1" id="pass1" placeholder="6 characters or more" onkeypress="valPass()" minlength="6" required>
  </div>
  <div class="input-group">
    <label for="pass2">Confirm Password</label><br>
    <input type="password" name="password_2" id="pass2" placeholder="Match this with the one before" onchange="valPass()" minlength="6" required>
  </div>
  <input type="checkbox" onclick="visibility()" id="visible"> <label style="font-size:14px" for="visible">Make passwords visible</label>
  <br/><br/>
  <div>
      <?php echo Securimage::getCaptchaHtml() ?>
  </div><br/>
  <div>
  <p style='font-size:11px'>Disclaimer: Email addresses and phone numbers are not required. 
  <br/>Users are responsible for safeguarding their account information to prevent loss of access to the account. 
  <br/>There are no other ways to access to an account other than using the assigned password or security question/answer combination alongside the username.
  <br/>We take no responsibility for how this site is used, how your data may be used or anything really.
  <br/>By creating an account, you agree to our terms.</p>
  </div>
    
  <div class="input-group">
    <button type="submit" class="but" id="reg_user" onclick="valPass" name="reg_user">Register</button>
    <button type="reset" name="reset" class = "but" value="Reset">Clear</button><br/><br/>
  </div>
  <br/>
    <label style="font-size:12px" for="login">Already have an account?</label>&nbsp;<a class='but' id="login" style="padding-left:10px;padding-right:10px;" href="login">Log In</a>
</form>

<?php

$CONTENT = ob_get_clean();
include './resources/template-reg.html';
=======
<?php static $TITLE = "Sign up";
require_once './resources/securimage/securimage.php';
include('./resources/server.php');
ob_start();?>

<h2>Register</h2>
<form method="post" action="signup">
  <?php include('./resources/errors.php'); ?>
  <div class="input-group">
    <label for="username">Username</label><br>
    <input type="text" name="username" id="username" autocomplete="off" placeholder="No space or special characters" maxlength="10" minlength="4" value="<?php echo $username; ?>" required>
  </div>
  <div class="input-group">
    
    <label for="ans">Security Question</label><br>
    <p style='font-size:12px'>Note: Security questions are used for password recovery.</p>
    <select name="ques" id="ques">
      <option disabled selected>Choose A Question</option>
      <option value="mom">Mother's maiden name</option>
      <option value="pet">First Pet's Name</option>
      <option value="car">First Car's Model</option>
    </select>
    <input type="text" name="ans" autocomplete="off" id="ans" maxlength="20" required>
  </div>
  <div class="input-group"> 
    <label for="pass1">Password</label><br>
    <input type="password" name="password_1" id="pass1" placeholder="6 characters or more" onkeypress="valPass()" minlength="6" required>
  </div>
  <div class="input-group">
    <label for="pass2">Confirm Password</label><br>
    <input type="password" name="password_2" id="pass2" placeholder="Match this with the one before" onchange="valPass()" minlength="6" required>
  </div>
  <input type="checkbox" onclick="visibility()" id="visible"> <label style="font-size:14px" for="visible">Make passwords visible</label>
  <br/><br/>
  <div>
      <?php echo Securimage::getCaptchaHtml() ?>
  </div><br/>
  <div>
  <p style='font-size:11px'>Disclaimer: Email addresses and phone numbers are not required. 
  <br/>Users are responsible for safeguarding their account information to prevent loss of access to the account. 
  <br/>There are no other ways to access to an account other than using the assigned password or security question/answer combination alongside the username.
  <br/>We take no responsibility for how this site is used, how your data may be used or anything really.
  <br/>By creating an account, you agree to our terms.</p>
  </div>
    
  <div class="input-group">
    <button type="submit" class="but" id="reg_user" onclick="valPass" name="reg_user">Register</button>
    <button type="reset" name="reset" class = "but" value="Reset">Clear</button><br/><br/>
  </div>
  <br/>
    <label style="font-size:12px" for="login">Already have an account?</label>&nbsp;<a class='but' id="login" style="padding-left:10px;padding-right:10px;" href="login">Log In</a>
</form>

<?php

$CONTENT = ob_get_clean();
include './resources/template-reg.html';
>>>>>>> Stashed changes
?>
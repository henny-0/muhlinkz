<?php 
  static $TITLE = "Log In";
  include('./resources/server.php');
  ob_start();
  ?>
  <h2>Log In</h2>
  <form method="post" action="login" class="login">
  	<div class="input-group">
  		<label>Username</label><br>
  		<input type="text" name="username" value="<?php if (isset($_COOKIE['username'])){
			 echo $_COOKIE['username'];
			  }?>" required>
  	</div>
  	<div class="input-group">
  		<label>Password</label><br>
  		<input type="password" name="password" id="pass1" required>
	  </div>
	  <input type="checkbox" onclick="visibility()" id="visible">&nbsp;<label style="font-size:14px" for="visible">Show Password</label><br/>
	  <input type="checkbox" id="remember" name="remember" <?php if (isset($_COOKIE['username'])){
			 echo 'checked';
			  }?>>&nbsp;<label style="font-size:14px" for="remember">Remember&nbsp;User</label>
	<br/><br/>
  	<div class="input-group">
  		<button type="submit" class="but" name="login_user">Login</button>
	  
  		<a href="reset" class="but" style="padding-top:7px;padding-bottom:6px;padding-left:7px; padding-right:7px;font-size:10px;" name="login_user">Forgot Password?</a>
  	</div><br/>
  	<label style="font-size:12px" for="signup">Don't have an account yet?</label>&nbsp;<a id="signup" class="but" href="signup" style="padding-left:10px;padding-right:10px;">Sign up</a><br/><br/>
	<label style="font-size:12px" for="about">Learn more here.</label>&nbsp;<a id ="about" class="but" href="about" style="padding-left:10px;padding-right:10px;">About</a>
	</form>
  
  <?php
  include('./resources/errors.php');
  $CONTENT = ob_get_clean();
  include './resources/template-reg.html';
?>
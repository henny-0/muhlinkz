<?php 
  static $TITLE = "About";
  include('./resources/server.php');
  ob_start();
  ?>
  <h2>About</h2>
  <p><b>Muh Linkz</b> is a small project made by a group of friends after recognizing the need for a simple database where users can save URLs (or links) for future use, accessible from a web browser.</p>
  <p>Our goal is to provide such a solution in the least invasive way possible (without need for any personally indentifiable information). 
  <br/>Finally, you can save all those links that you can't bookmark in your browser (whatever the reason for that may be), so you can use them whenever and wherever.<p>
  
  <?php
  if(!isset($_SESSION["username"])){
    echo '<a id="gohome" class="but" onclick="goBack()" style="padding-left:10px;padding-right:10px;">Back</a>';  
  }
  $CONTENT = ob_get_clean();
  if(isset($_SESSION["username"])){
    include './resources/template.html';  
  } else if(!isset($_SESSION["username"])){
    include './resources/template-reg.html';
  }
  
?>
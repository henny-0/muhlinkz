<?php 
  static $TITLE = "Home";
  ob_start();
  ?>
  
  <h2>Home</h2>
  <p>Find an important link? Save the link. Ready to use it? Just search for it.</p>
  <h3>Additional Resources</h3>
  <p><a class = "but unify" href = "https://archive.org" target="_blank">Archive.org</a>
  <a class = "but unify" style="width:80px;" href = "https://duckduckgo.com" target="_blank">DuckDuckGo</a>
  <a class = "but unify" href = "https://yandex.com" target="_blank">Yandex</a>
  <a class = "but unify" href = "https://www.torproject.org/" target="_blank">Tor Project</a></p>
        
  <p><label style="font-size:14px" for="about">Learn more about this website here <a id ="about" class="but" style="padding-left:4px;padding-right:4px" href="about">About</a>.</p>
  
  
  <?php
  $CONTENT = ob_get_clean();
  include './resources/template.html';
?>
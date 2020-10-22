<?php 
$TITLE = "Add New Links";
include ("./resources/serve.php");
ob_start();
?>

<?php
if(isset($_POST['submit'])) 
{ 
    include ("./resources/adder.php"); 
}
?>
<form action="add" method="POST" id="add">
    <h2>Add a New Link</h2>
    <label for= "title">Title:</label> <br />
    <input type="text" name="title" id ="title" maxlength="30" minlength="5" placeholder="Enter Title Here"  required><br />
    <label for= "dsc">Description:</label> <br />
    <textarea name="dsc" id ="dsc" maxlength="255" minlength="0" placeholder="Enter A Short Description Here"></textarea><br />
    <label for= "url">Link/URL:</label> <br />
    <input type="url" name="url" id="url" maxlength="50" autocomplete="off" value="https://" placeholder="https://www.site.com" pattern="https?://.+" required>
    <p style='font-size:12px'>Note: URLs (links) must be written with 'http://' or 'https://' at the beginning to function properly. For assistance, 'https://' has already been inserted here.</p>
    <br/>
    <button type="submit" class = "but" name="submit" value="Add">Add</button>
    <button type="reset" name="reset" class = "but" value="Reset">Clear</button>
</form>
<?php
$CONTENT = ob_get_clean();
include "./resources/template.html"
?> 
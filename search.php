<<<<<<< Updated upstream
<?php 
$TITLE = "Search Links";
ob_start();
?>

<form action="search" method="GET" id="search">
    <h2>Search</h2>
    <p><label for="srch">Just type and hit 'Search'</label></p>
    <input type="text" name="search" id="srch" placeholder="Url/Title fragment" required>
    <input type="submit" name="submit" style="" value="search">
</form>
<?php
if(isset($_GET['submit'])) 
{ 
    $search = strtolower($_GET["search"]);
    echo '<script>document.getElementById("srch").value = "'. $_GET["search"] . '"</script>';
    include "./resources/results.php";
}
?>
<?php
$CONTENT = ob_get_clean();
include "./resources/template.html"
=======
<?php 
$TITLE = "Search Links";
ob_start();
?>

<form action="search" method="GET" id="search">
    <h2>Search</h2>
    <p><label for="srch">Just type and hit 'Search'</label></p>
    <input type="text" name="search" id="srch" placeholder="Url/Title fragment" required>
    <input type="submit" name="submit" style="" value="search">
</form>
<?php
if(isset($_GET['submit'])) 
{ 
    $search = strtolower($_GET["search"]);
    echo '<script>document.getElementById("srch").value = "'. $_GET["search"] . '"</script>';
    include "./resources/results.php";
}
?>
<?php
$CONTENT = ob_get_clean();
include "./resources/template.html"
>>>>>>> Stashed changes
?> 
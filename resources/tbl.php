<?php // To place data into html table 
if (session_id()==null){
  session_start();
}
if ($result->num_rows != 0) {
  $linkTitle = '';
  $dsc = '';
  $link = '';
  $date = '';
  $num = 0;
  $order = '';

  if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
  } else {
    $pageno = 1;
  }

  if (isset($_SESSION['sort'])){
    $sortby = $_SESSION['sort'];
  } else {
    $sortby = 'date';
  }

  if (isset($_SESSION['order'])){
    $order = $_SESSION['order'];
  } else{
    $order = 'descend';
  }
  
  if (isset($_SESSION['limit'])){
    $no_of_records_per_page = $_SESSION["limit"];
  } else{
    $no_of_records_per_page = 10;
  }
  
  // output data of each row into an array to be used later
  while ($rowfetch = $result->fetch_assoc()) {
    $row[] = $rowfetch;
  }

  $total_rows = count($row);
  $total_pages = ceil($total_rows / $no_of_records_per_page);
  
  if ($pageno < 1){
    $pageno = 1;
  }
  if ($pageno > $total_pages){
    $pageno = $total_pages;
  }

  $offset = ($pageno - 1) * $no_of_records_per_page;
  
  echo "<div>";
  
  function paginate(){
    global $total_rows;
    global $no_of_records_per_page;
    global $pageno;
    global $total_pages;
    
    if ($total_rows > $no_of_records_per_page){
      if (!isset ($_GET["submit"])){
        $get = '?pageno='; 
      }
      else if (isset ($_GET["submit"])){
        $get = '?search=' . $_GET["search"] . '&submit=search&pageno=';
      }
      
      $first = $get . '1';
      $prev = $get . ($pageno - 2);
      $firstclass = "";
      $prevclass = "";
      $next = $get . ($pageno + 2);
      $last = $get . $total_pages;
      $lastclass = "";
      $nextclass= "";
      $left = "";
      $leftnum = "";
      $leftclass = "";
      $right = "";
      $rightnum = "";
      $rightclass = "";
      $middle = "";
      $midnum = "";
      $midclass = "";

      if ($pageno == 1){
        $left = $first;
        $leftnum = $pageno;
        $leftclass = "active";
        $middle = $get . ($pageno + 1);
        $midnum = $pageno + 1;
        $midclass = "";
        $right = $get . ($pageno + 2);
        $rightnum = $pageno + 2;
        $rightclass = "";
        $firstclass = "disabled";
        $prevclass = "disabled";
        $nextclass = "disabled";
      }
      else if ($pageno > 1 && $pageno < $total_pages){
        $left = $get . ($pageno - 1);
        $leftnum = $pageno  - 1;
        $leftclass = "";
        $middle = $get . $pageno;
        $midnum = $pageno;
        $midclass = "active";
        $right= $get . ($pageno + 1);
        $rightnum = $pageno + 1;
        $rightclass = "";
      }
      else if ($pageno == $total_pages){
        $left = $get . ($pageno - 2);
        $leftnum = $pageno  - 2;
        $leftclass = "";
        $middle = $get . ($pageno - 1);
        $midnum = $pageno  - 1;
        $midclass ="";
        $right = $get . $pageno;
        $rightnum = $pageno;
        $rightclass = "active";
        $lastclass = "disabled";
        $nextclass = "disabled";
        $prevclass = "disabled";
      }
      
      if ($total_pages <= 2){
        if ($pageno == 1){
          $rightclass = "disabled";
        } else if ($pageno == 2){
          $leftclass = "disabled";
        }
        $lastclass = "disabled";
        $nextclass = "disabled";
        $firstclass = "disabled";
        $prevclass = "disabled";
      }
      
      if ($total_pages < ($pageno + 2)){
        $nextclass = "disabled";
      } else if (($pageno - 2) < 1 ){
        $prevclass = "disabled";
      }

      echo "<div class='paginationContainer'>";
      echo "<ul class= 'pagination'>" .
      //first
        "<li class =". $firstclass ."><a href=\"" . $first ."\">&laquo;&laquo;</a></li>"; 
      //previous
      echo "<li class= " . $prevclass . ">" . "<a href='". $prev .
      "'><sup style='font-size:10px'>-2</sup>&laquo;</a>" . "</li>";
      echo "<li class=" . $leftclass . "><a href=" . $left . ">" . $leftnum . "</a></li>" .
        "<li class=" . $midclass . "><a href=" . $middle . ">" . $midnum . "</a></li>" .
        "<li class=" . $rightclass . "><a href=" . $right . ">" . $rightnum . "</a></li>";
      //next
      echo "<li class=" . $nextclass ."><a href='" . $next;
      echo "'> &raquo;<sup style='font-size:10px'>+2</sup></a></li>" .
      //last
      "<li class=" . $lastclass . "><a href='". $last;
      echo "'>&raquo;&raquo;</a></li>";
      echo "</ul>";
      echo "</div>";
    }
  }
  
  $ten ='';
  $twenty = '';
  $fifty = '';
  $hun = '';

  if ($no_of_records_per_page == 10){
    $ten = 'selected';
  } else if ($no_of_records_per_page == 20){
    $twenty = 'selected';
  } else if ($no_of_records_per_page == 50){
    $fifty = 'selected';
  } else if ($no_of_records_per_page == 100){
    $hun = 'selected';
  }
   else {
    $no_of_records_per_page = 10;
    $ten = 'selected';
  }
  
  $firstSort = '';
  $secondSort = '';
  $sortSelTitle = '';
  $sortSelfDate = '';
  $asc = '';
  $des = '';

  if ($sortby == 'title'){
    $firstSort = 'title';
    $secondSort = 'date';
    $sortSelTitle = 'selected';
  } else if($sortby == 'date'){
    $firstSort = 'date';
    $secondSort = 'title';
    $sortSelfDate = 'selected';
  } else{
    $firstSort = 'date';
    $secondSort = 'title';
    $sortSelfDate = 'selected';
  }

  if ($order == 'ascend'){
    $asc = 'checked';
  } else if ($order == 'descend'){
    $des = 'checked';
  } else {
    $des = 'checked';
  }

  echo "<form id = 'limitForm' method= 'get' target='_blank' action = './' style='position:static;font-size: 14px;'>" .
  "<div><label for = 'limitSelect' style='font-size: 12px;'>Results per page</label>&nbsp;&nbsp;".
  "<select id = 'limitSelect' name = 'limit' onchange='setTimeout( function() {location.reload();}, 50);this.form.submit(); ' style='width:50px; height:40px; padding:0; font-size: 12px;'>" .
  "<option value = '10'" . $ten . ">10</option>".
  "<option value = '20'" . $twenty . ">20</option>".
  "<option value = '50'" . $fifty . ">50</option>".
  "<option value = '100'" . $hun . ">100</option>".
  "</select>&nbsp;&nbsp;".
  "<br class ='vanishbr'/>".
  "<label for = 'sort' style='font-size: 12px;'>Sort by</label>&nbsp;&nbsp;".
  "<select id = 'sort' name = 'sort' onchange='setTimeout( function() {location.reload();}, 50);this.form.submit(); ' style='width:90px; height:40px; padding:0;font-size: 12px;'>" .
  "<option value = 'title'" . $sortSelTitle . ">Title</option>".
  "<option value = 'date'" . $sortSelfDate . ">Date Added</option>".
  "</select>".
  "<br/>".
  "<label for = 'ascend' style='font-size: 12px;'>Ascending</label>&nbsp;&nbsp;".
  "<input type= 'radio' name ='order' value = 'ascend' value = 'ascend' onchange='setTimeout( function() {location.reload();}, 50);this.form.submit(); ' ".$asc.">&nbsp;&nbsp;".
  "<label for = 'descend' style='font-size: 12px;'>Descending</label>&nbsp;&nbsp;".
  "<input type= 'radio' name ='order' id='descend' value = 'descend'onchange='setTimeout( function() {location.reload();}, 50);this.form.submit(); '".$des."></div>".
  "</form>";

  paginate();

  usort($row, function ($a, $b){
    global $firstSort;
    global $secondSort;
    $retval = $a[$firstSort] <=> $b[$firstSort];
    if ($retval == 0){
      $retval = $a[$secondSort] <=> $b[$secondSort];
    }
    return $retval;
  });

  if ($order == 'ascend'){
    usort($row, function ($a, $b){
      global $firstSort;
      global $secondSort;
      $retval = $a[$firstSort] <=> $b[$firstSort];
      if ($retval == 0){
        $retval = $a[$secondSort] <=> $b[$secondSort];
      }
      return $retval;
    });
  } else if ($order == 'descend'){
    usort($row, function ($a, $b){
      global $firstSort;
      global $secondSort;
      $retval = $b[$firstSort] <=> $a[$firstSort];
      if ($retval == 0){
        $retval = $b[$secondSort] <=> $a[$secondSort];
      }
      return $retval;
    });
  } else {
    usort($row, function ($a, $b){
      global $firstSort;
      global $secondSort;
      $retval = $a[$firstSort] <=> $b[$firstSort];
      if ($retval == 0){
        $retval = $a[$secondSort] <=> $b[$secondSort];
      }
      return $retval;
    });
  }
  
  for ($i = 0; $i < $no_of_records_per_page; $i++) {
   
    if (($i+$offset)>=count($row)) {
      error_reporting(0);
      break;
    }

    $id = $row[$i + $offset]["id"];
    $linkTitle = $row[$i + $offset]["title"];
    $dsc = $row[$i + $offset]["dsc"];
    $link = $row[$i + $offset]["link"];
    $date = $row[$i + $offset]["date"];
    $num++;

    

    if ($dsc == '' || $linkTitle == null) {
      $dsc = "No Description Found";
    }
    echo ("<script>" .
      "function clearDisplay(){" .
      "var display = document.getElementsByClassName(\"displayCopy\"); " .
      "for(var i = 0; i < display.length; i++){" .
      "display[i].innerHTML= '';}" .
      "}" .
      "function clearDisplay" . $num . "(){" .
      "var display = document.getElementById(\"displayCopy" . $num . "\"); " .
      "display.innerHTML= '';" .
      "}" .
      "function copier" . $num . "() {" .
      "clearDisplay();" .
      "var copyText = document.getElementById(\"link" . $num . "\"); " .
      "var display = document.getElementById(\"displayCopy" . $num . "\"); " .
      "copyText.select(); " .
      "document.execCommand('copy');" .
      "display.innerHTML= (\"Link Copied: \" + copyText.value); " .
      "setTimeout(clearDisplay" . $num . ",5000);" .
      "}" .
      "</script>" .
      "<div class='results'><div><h3 class='title'>" .
      $linkTitle . "</h3><p class = 'descColumn'>" . $dsc .
      "</p></div><div class = 'linkColumn'><a class = 'but unify'  href= ". $link . " target = '_blank'>Go</a>" .
      "<input type='text' name='link' style='position: absolute; left: -100000px;' id='link" . $num . "' value='" . $link . "'>" .
      "<a href='javascript:();' onClick='document.getElementById(\"form" . $num . "\").submit();' class='but unify'>Edit</a>" .
      "<a href='javascript:();' onclick='copier" . $num . "();' class='but unify'>Copy</a>" .
      "<p id='displayCopy" . $num . "' class='displayCopy'></p>" .
      "<form action='edit' method='post' id='form" . $num . "'>" .
      "<input type='text' style='position: absolute; left: -100000px;' name='id' id='id' value='" . $id . "'>" .
      "</form>" .
      "</div><p class = 'dateColumn'> Added: " .
      $date . "</p></div>");

    $linkTitle = '';
    $dsc = '';
    $link = '';
    $date = '';
  } 

  paginate();
  echo "</div>";
  
  
}

else if ($TITLE == "Search Links") {
  echo "<h3 id = 'notif'>0 links found for this search term!</h3> <h3 id = 'notif'>Why don't you add one?</h3> <a href='add' class='but'>Add links</a>";
}else if ($TITLE == "View All Links"){
  echo "<h3 id = 'notif'>No links added as yet</h3> <h3 id = 'notif'>Why don't you add some?</h3> <a href='add' class='but'>Add links</a>";
} else{
  echo "<p>thatssoweirdwhyareyouhereareyouLIKEacriminal</p>";
}
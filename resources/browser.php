<<<<<<< Updated upstream
<?php
function getBrowser() { 
  $u_agent = $_SERVER['HTTP_USER_AGENT'];
  $bname = 'Unknown';
  $platform = 'Unknown';
  $version= "";

  //First get the platform?
  if (preg_match('/linux/i', $u_agent)) {
    $platform = 'linux';
  }elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
    $platform = 'mac';
  }elseif (preg_match('/windows|win32/i', $u_agent)) {
    $platform = 'windows';
  }

  // Next get the name of the useragent yes seperately and for good reason
  if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
    $bname = 'Internet Explorer';
    $ub = "MSIE";
  }elseif(preg_match('/Firefox/i',$u_agent)){
    $bname = 'Mozilla Firefox';
    $ub = "Firefox";
  }elseif(preg_match('/OPR/i',$u_agent)){
    $bname = 'Opera';
    $ub = "Opera";
  }elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
    $bname = 'Google Chrome';
    $ub = "Chrome";
  }elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
    $bname = 'Apple Safari';
    $ub = "Safari";
  }elseif(preg_match('/Netscape/i',$u_agent)){
    $bname = 'Netscape';
    $ub = "Netscape";
  }elseif(preg_match('/Edge/i',$u_agent)){
    $bname = 'Edge';
    $ub = "Edge";
  }elseif(preg_match('/Trident/i',$u_agent)){
    $bname = 'Internet Explorer';
    $ub = "MSIE";
  } else{
    $bname="none";
    $ub="none";
  }

  // finally get the correct version number
  $known = array('Version', $ub, 'other');
  $pattern = '#(?<browser>' . join('|', $known) .
')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
  if (!preg_match_all($pattern, $u_agent, $matches)) {
    // we have no matching number just continue
  }
  // see how many we have
  $i = count($matches['browser']);
  if ($i != 1) {
    error_reporting(0);
    //we will have two since we are not using 'other' argument yet
    //see if version is before or after the name
    if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
        $version= $matches['version'][0];
    }else {
        $version= $matches['version'][1];
    }
  }else {
    $version= $matches['version'][0];
  }

  // check if we have a number
  if ($version==null || $version=="") {$version="?";}

  return array(
    'userAgent' => $u_agent,
    'name'      => $bname,
    'version'   => $version,
    'platform'  => $platform,
    'pattern'    => $pattern
  );
} 

// now try it
$ua=getBrowser();
/*$yourbrowser= "Your browser: " . $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] . " reports: <br >" . $ua['userAgent'];
print_r($yourbrowser);*/
if (($ua['name'] == 'Google Chrome') && ($ua['version'] >= 49.0) || ($ua['name'] == 'Mozilla Firefox') && ($ua['version'] >= 31.0)
|| ($ua['name'] == 'Apple Safari') && ($ua['version'] >= 9.1) || ($ua['name'] == 'Edge') && ($ua['version'] >= 15.0)
|| ($ua['name'] == 'Opera') && ($ua['version'] >= 36.0)){
    null;
}else {
  echo '<link rel="stylesheet" type="text/css" href="./style-ie.css">';
  echo '<style>';
  echo '/* Compatibility CSS for IE */

  body {
      background-color: ' . $bcolor . ';
  }
  
  p.head {
      color: ' . $fcolor . ';
  }
  
  div.nav, .nav {
      background-color: ' . $fcolor . ';
  }
  
  .results {
      border-color: ' . $fcolor . ';
  }
  
  .footer {
      background-color: ' . $fcolor . ';
  }

  
  .botm {
      background-color: ' . $bcolor . ';
      border: #fff solid thin;
      color: #fff;
  }
  
  .pageLink {
      background-color: ' . $bcolor . ';
      color: #fff;
  }
  
  @keyframes link {
      0% {
          background-color: ' . $bcolor . ';
          color: #fff;
          border-color: #fff;
      }
      25% {
          background-color: ' . $bcolor . ';
          color: #000;
          border-color: #000;
      }
      50% {
          background-color: ' . $fcolor . ';
          color: #fff;
          border-color: #fff;
      }
      75% {
          background-color: ' . $fcolor . ';
          color: #000;
          border-color: #000;
      }
      100% {
          background-color: ' . $bcolor . ';
          color: #fff;
          border-color: #fff;
      }
  }
  
 div.content, div.cont {
      border-color: ' . $fcolor . ';
  }

  input[type=submit], input[type=reset] {
      background-color: ' . $bcolor . ';
  }
  .but {
      background-color: ' . $bcolor . ';
  }
  .but:hover, input[type=submit]:hover, input[type=submit]:focus, input[type=reset]:focus, input[type=reset]:hover, .but:focus {
      background-color: ' . $fcolor . ';
  }
  
  #notif, #table-notif {
      color: ' . $fcolor . ';
  }
    .pageLink:hover, .botm:hover, .currentPage:hover, .pageLink:focus, .botm:focus, .currentPage:focus {
      background-color: ' . $fcolor . ';

  }
  .pageLink:focus, .botm:focus, .currentPage:focus, input[type=submit]:focus, input[type=reset]:focus, .but:focus {
      outline-color: ' . $bcolor . ';
  }
  input[type=text]:focus, input[type=url]:focus, input[type=password]:focus {
      outline-color: ' . $bcolor . ';
  }
  .pagination {
      border-color: ' . $fcolor . ';
  }

  .pagination li.active{
      background-color: ' . $bcolor . ';  
  }
  .pagination li:hover:not(.active) a
  {
      color: ' . $bcolor . ';
  }';
  echo '</style>';
}
=======
<?php
function getBrowser() { 
  $u_agent = $_SERVER['HTTP_USER_AGENT'];
  $bname = 'Unknown';
  $platform = 'Unknown';
  $version= "";

  //First get the platform?
  if (preg_match('/linux/i', $u_agent)) {
    $platform = 'linux';
  }elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
    $platform = 'mac';
  }elseif (preg_match('/windows|win32/i', $u_agent)) {
    $platform = 'windows';
  }

  // Next get the name of the useragent yes seperately and for good reason
  if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
    $bname = 'Internet Explorer';
    $ub = "MSIE";
  }elseif(preg_match('/Firefox/i',$u_agent)){
    $bname = 'Mozilla Firefox';
    $ub = "Firefox";
  }elseif(preg_match('/OPR/i',$u_agent)){
    $bname = 'Opera';
    $ub = "Opera";
  }elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
    $bname = 'Google Chrome';
    $ub = "Chrome";
  }elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
    $bname = 'Apple Safari';
    $ub = "Safari";
  }elseif(preg_match('/Netscape/i',$u_agent)){
    $bname = 'Netscape';
    $ub = "Netscape";
  }elseif(preg_match('/Edge/i',$u_agent)){
    $bname = 'Edge';
    $ub = "Edge";
  }elseif(preg_match('/Trident/i',$u_agent)){
    $bname = 'Internet Explorer';
    $ub = "MSIE";
  } else{
    $bname="none";
    $ub="none";
  }

  // finally get the correct version number
  $known = array('Version', $ub, 'other');
  $pattern = '#(?<browser>' . join('|', $known) .
')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
  if (!preg_match_all($pattern, $u_agent, $matches)) {
    // we have no matching number just continue
  }
  // see how many we have
  $i = count($matches['browser']);
  if ($i != 1) {
    error_reporting(0);
    //we will have two since we are not using 'other' argument yet
    //see if version is before or after the name
    if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
        $version= $matches['version'][0];
    }else {
        $version= $matches['version'][1];
    }
  }else {
    $version= $matches['version'][0];
  }

  // check if we have a number
  if ($version==null || $version=="") {$version="?";}

  return array(
    'userAgent' => $u_agent,
    'name'      => $bname,
    'version'   => $version,
    'platform'  => $platform,
    'pattern'    => $pattern
  );
} 

// now try it
$ua=getBrowser();
/*$yourbrowser= "Your browser: " . $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] . " reports: <br >" . $ua['userAgent'];
print_r($yourbrowser);*/
if (($ua['name'] == 'Google Chrome') && ($ua['version'] >= 49.0) || ($ua['name'] == 'Mozilla Firefox') && ($ua['version'] >= 31.0)
|| ($ua['name'] == 'Apple Safari') && ($ua['version'] >= 9.1) || ($ua['name'] == 'Edge') && ($ua['version'] >= 15.0)
|| ($ua['name'] == 'Opera') && ($ua['version'] >= 36.0)){
    null;
}else {
  echo '<link rel="stylesheet" type="text/css" href="./style-ie.css">';
  echo '<style>';
  echo '/* Compatibility CSS for IE */

  body {
      background-color: ' . $bcolor . ';
  }
  
  p.head {
      color: ' . $fcolor . ';
  }
  
  div.nav, .nav {
      background-color: ' . $fcolor . ';
  }
  
  .results {
      border-color: ' . $fcolor . ';
  }
  
  .footer {
      background-color: ' . $fcolor . ';
  }

  
  .botm {
      background-color: ' . $bcolor . ';
      border: #fff solid thin;
      color: #fff;
  }
  
  .pageLink {
      background-color: ' . $bcolor . ';
      color: #fff;
  }
  
  @keyframes link {
      0% {
          background-color: ' . $bcolor . ';
          color: #fff;
          border-color: #fff;
      }
      25% {
          background-color: ' . $bcolor . ';
          color: #000;
          border-color: #000;
      }
      50% {
          background-color: ' . $fcolor . ';
          color: #fff;
          border-color: #fff;
      }
      75% {
          background-color: ' . $fcolor . ';
          color: #000;
          border-color: #000;
      }
      100% {
          background-color: ' . $bcolor . ';
          color: #fff;
          border-color: #fff;
      }
  }
  
 div.content, div.cont {
      border-color: ' . $fcolor . ';
  }

  input[type=submit], input[type=reset] {
      background-color: ' . $bcolor . ';
  }
  .but {
      background-color: ' . $bcolor . ';
  }
  .but:hover, input[type=submit]:hover, input[type=submit]:focus, input[type=reset]:focus, input[type=reset]:hover, .but:focus {
      background-color: ' . $fcolor . ';
  }
  
  #notif, #table-notif {
      color: ' . $fcolor . ';
  }
    .pageLink:hover, .botm:hover, .currentPage:hover, .pageLink:focus, .botm:focus, .currentPage:focus {
      background-color: ' . $fcolor . ';

  }
  .pageLink:focus, .botm:focus, .currentPage:focus, input[type=submit]:focus, input[type=reset]:focus, .but:focus {
      outline-color: ' . $bcolor . ';
  }
  input[type=text]:focus, input[type=url]:focus, input[type=password]:focus {
      outline-color: ' . $bcolor . ';
  }
  .pagination {
      border-color: ' . $fcolor . ';
  }

  .pagination li.active{
      background-color: ' . $bcolor . ';  
  }
  .pagination li:hover:not(.active) a
  {
      color: ' . $bcolor . ';
  }';
  echo '</style>';
}
>>>>>>> Stashed changes
?>
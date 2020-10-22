<?php
if (session_id()==null){
  session_start();
}

// Initializing variables
$username = "";
$ans = "";
$ques;
$errors = array(); 

// Database variables

include ("serve.php");


// connect to the database
$conn = mysqli_connect($servername, $uname, $pwd);

mysqli_select_db($conn,$dbname);

// Forgot Password
if (isset($_POST['passchange'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $ques = mysqli_real_escape_string($conn, $_POST['ques']);
  $ans = mysqli_real_escape_string($conn, $_POST['ans']);
  $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($ques)) { array_push($errors, "Security Question is required"); }
  if (empty($ans)) { array_push($errors, "Answer to Security Question is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "Passwords do not match");
  }
  
    // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      if (($user['question'] != $ques) || ($user['answer'] != $ans)){
        array_push($errors, "Incorrect Security Question/Answer Combination");
      }
    }
  } else if (!$user){
    array_push($errors, "Username does not exist");
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $username = strtolower($username);
    $sql =  $conn->prepare("UPDATE users SET password=? WHERE username ='" . $username . "' AND question ='". $ques ."' AND answer ='". $ans ."'");
    $sql->bind_param("s", $password);
    
    $password = md5($password_1);//encrypt the password before saving in the database, like a boss

      // Creating Record and checking to ensure record is created else connection error is displayed
      if ($sql->execute() === true) {
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index');      } 
      else {
        array_push($errors, "Something went awry");      
      }
      $sql->close();
  }
}

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $ques = mysqli_real_escape_string($conn, $_POST['ques']);
  $ans = mysqli_real_escape_string($conn, $_POST['ans']);
  $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  //captcha
  $image = new Securimage();
    if ($image->check($_POST['captcha_code']) == true) {
      $does_nothing = null;
    } else {
      array_push($errors, "Captcha is incorrect");
    }
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($ques)) { array_push($errors, "Security Question is required"); }
  if (empty($ans)) { array_push($errors, "Answer to Security Question is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "Passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $username = strtolower($username);
  	$password = md5($password_1);//encrypt the password before saving in the database, like a boss
  	$query = "INSERT INTO users (username, question, answer, password) 
  			  VALUES('$username', '$ques', '$ans', '$password')";
    mysqli_query($conn, $query);
    $query = "INSERT INTO theme (username, backcol, frontcol) 
          VALUES('$username', '#ff00aa', '#c22bfd')";
    mysqli_query($conn, $query);
    mysqli_select_db($conn,$dbname2);
    
    $_SESSION['username'] = $username;
    header("location: index");
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        if (!empty($_POST["remember"])){
          setcookie("username", "$username");
        } else if (empty($_POST["remember"])){
          setcookie("username");
        }
        $username = strtolower($username);
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = $conn->query($query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location: index');
        }else {
            array_push($errors, "Incorrect username/password");
        }
    }
  }
  
  ?>
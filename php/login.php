<?php
  include("php/connection.php");
  $loginAlert = '';
  $countErrors = 0;
  if($_GET['logout']==1){
    session_destroy();
    $loginAlert = '<div class="alert alert-danger" role="alert" id="loginAlert">You have been logged out.</div>';
    session_start();
  };
  
  if($_POST['submit']=="Login"){
    // $email = mysqli_real_escape_string($link, $_POST['loginEmail']);
    // $password = mysqli_real_escape_string($link, $_POST['loginPassword']);
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    if(!userExists($email)){
      $loginAlert = '<div class="alert alert-danger" role="alert" id="loginAlert">user unknown</div>';
    } else {
      $loginAlert = '<div class="alert alert-danger" role="alert" id="loginAlert">user exists</div>';
      if(passwordIsWrong($email, $password)){
        $loginAlert = '<div class="alert alert-danger" role="alert" id="loginAlert">wrong password</div>';
      } else {
        $query = "SELECT * FROM users WHERE email = '".$email."'";
        $queryResult = mysqli_query($link, $query);
        $row = mysqli_fetch_array($queryResult);
        $_SESSION['id']= $row['userid'];
        header("Location:diary.php");
      };
    }
  }
  
  if($_POST['submit']=="Register"){
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $password2 = mysqli_real_escape_string($link, $_POST['password2']);
  	if(!registrationIsValid($name,$email,$password,$password2)){
  		$registerAlert = '<div class="alert alert-danger" role="alert"><strong>Oops!</strong> There are '.$countErrors.' errors in the form:'.$error.'</div>';
  	} else {
      if(userExists($email)){
        $registerAlert = '<div class="alert alert-danger" role="alert"><strong>Aha!</strong> A user with this email address already exists!</div>';
      } else {
    	  // store the new user in database including salt (which returns a string that indicates success or failure)
    	  $registrationResult = createUser();
    	  // display the result from the createUser function to the user. 
    	  $registerAlert = '<div class="alert alert-success" role="alert">'.$registrationResult.'</div>';
    	  // create a session for the registered user (so that it's logged in)
    	  $_SESSION['id']=mysqli_insert_id($link);
    	  header("Location:diary.php");
  	  };
    };
  };
  
  function createUser(){
    //nothing yet
    global $link, $name, $email, $password;
    $hashedPW = hash('sha512', $password);
    $saltedPW = password_hash($password, PASSWORD_DEFAULT); 
    $query = "INSERT INTO users (name, email, password, passwordplain, passwordhash) VALUES ('".$name."', '".$email."', '".$saltedPW."', '".$password."', '".$hashedPW."')";
    if(!mysqli_query($link, $query)){
      return("Error: " . $query . "<br>" . mysqli_error($link));
    } else {
      return("Succesfully registered. You can now login");
    };
  }
  
  function passwordIsWrong($loginEM, $loginPW){
    global $link, $debug;
    $query = "SELECT password FROM users WHERE email = '".$loginEM."'";
    $result = mysqli_fetch_assoc(mysqli_query($link, $query));
    $retrievedPassword = $result['password'];
    if(password_verify($loginPW, $retrievedPassword)){
      return false;
    } else {
      return true;
    }
  } // end of function passwordIsWrong()
  
  function userExists($email){
    //this function checks if a user exist by looking up the email address in the database user table
    global $link, $email;
  	$query = "SELECT email FROM users WHERE email = '".$email."'";
  	
  	$getEmail = mysqli_fetch_assoc(mysqli_query($link, $query));
    $dbEmail = $getEmail['email'];
  	if($dbEmail) {
  	  return true;
  	} else {
  	  return false;
  	};  
  } //end of function userExists

  function registrationIsValid($name, $email, $password, $password2){
    //this function validates the user input for the registration form
    global $error, $countErrors;
    $error = "";
    $countErrors = 0;
    if(!$name){
  		$error = "</br>Please enter your name. ";
  		$countErrors++;
  	};
  	if(!$email){
  		$error.= "</br>Please enter your email. ";
  		$countErrors++;
  	} else {
    	if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    		$error.= "</br>Please enter a valid email address.";
    		$countErrors++;
    	};
  	};
  	if(!$password){
  		$error.= "</br>Please enter a password. ";
  		$countErrors++;
  	} else {
  	  if(strlen($password)<8){
  	    $error.= "</br>Please make sure your password has at least 8 characters.";
  	    $countErrors++;
  	  };
  	};
  	if(!$_POST['password2']){
  		$error.= "</br>Please repeat your password. ";
  		$countErrors++;
  	} else {
  	  if(!($password==$password2)){
  	    $error.="</br>Passwords don\'t match...";
  	    $countErrors++;
  	  };
  	};
  	if($countErrors > 0){
  	  return false;
  	} else {
  	  return true;
  	};
  } // end of function registrationIsValid
?>
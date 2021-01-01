<?php
  session_start();
  include("php/login.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Secret Diary</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="style.css"rel="stylesheet" type="text/css" />
    <link href="style.css"rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>
  
  <body>
  	<div class="navbar navbar-default navbar-fixed-top">
  		<div class="container-fluid">
  			<div class="navbar-header">
  				<a href="" class="navbar-brand">My Secret Diary</a>
  				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
  					<span class="sr-only">Toggle navigation</span>
  					<span class="icon-bar"></span>
  					<span class="icon-bar"></span>
  					<span class="icon-bar"></span>
  				</button>
  			</div>
  			<div class="collapse navbar-collapse pull-right">
  				<form class="navbar-form navbar-left" role="form" method="post">
            <div class="form-group">
      					<label class="sr-only" for="loginEmail">Email</label>
      					<input type="email" name="loginEmail" class="form-control inputField" placeholder="email..." value="<?php echo $_POST['email']?>" />
      				</div>
      				<div class="form-group">
      					<label class="sr-only" for="password">Password</label>
      					<input type="password" name="loginPassword" class="form-control inputField" placeholder="password..." value="<?php echo $_POST['password']?>" />
      				</div>    				
        			<input type="submit" class="btn btn-info" name="submit" value="Login" />
          </form>
  			</div> 
  		</div> 
  	</div> 
    <div class="container-fluid">
      <div class="row">
        </br></br>
        <div class="col-md-8 col-md-offset-2">
          <form role="form" method="post">
            <div class="form-group">
                <label class="sr-only" for="user">User</label>
                <input type="text" name="user" class="form-control inputField" placeholder="type name..." />
              </div>    				
              <input type="submit" class="btn btn-info" name="search" value="Search users" />
          </form>
        </div> 
      </div>  

     
    	<div class="row">
    	  </br></br>
      	<div class="col-md-8 col-md-offset-2">
      	  <?php

            $searchUser = $_POST['user']
      	    $sql = "SELECT * FROM users WHERE name = '$searchUser'";
            $result = $link->query($sql);
            
            if ($result->num_rows > 0) {
                echo '<div class="table-responsive"><table class="table table-hover table-striped"><tr><th>ID</th><th>Name</th><th>Email</th></tr>';
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<tr><td>'.$row["userid"].'</td><td><a class="btn btn-default table-button" href="" role="button">'.$row["name"].'</a></td><td>'.$row["email"].'</td></tr>';
                }
                echo "</table></div>";
            } else {
                echo "0 results";
            }
      	  ?>
      	</div> 
      </div>
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <a class="btn btn-info table-button" href="index.php" role="button">Home</a>
        </div>
      </div>
    </div> <!-- EO mainContainer -->
  	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="scripts.js"></script>
  </body>
</html>
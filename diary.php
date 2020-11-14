<?php
  session_start();
  include("php/login.php");
  
  $query="SELECT * FROM users WHERE userid='".$_SESSION['id']."'";
  $queryResult = mysqli_query($link, $query);
  $row = mysqli_fetch_array($queryResult);
  $diary=$row['diary'];
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

  <!-- NAVBAR -->
  	<div class="navbar navbar-default navbar-fixed-top">
  		<div class="container-fluid">
  			<div class="navbar-header pull-left">
  				<a href="" class="navbar-brand">My Secret Diary</a>
  			</div>
  			<div class="navbar-nav pull-right">
  			  <form class="navbar-form navbar-left">
  			    <a class="btn btn-danger" href="index.php?logout=1" role="button">Log Out</a>
  			  </form>
  			</div> 
  		</div> 
  	</div> 
  
  	<div class="container-fluid mainContainer">
    	<div class="row">
      	<div class="col-md-8 col-md-offset-2">
      	  <?php echo $loginAlert;	?>
      	</div>  
      </div>
      
    	<div class="row">
      	<div class="col-md-8 col-md-offset-2">
      	  <textarea class="form-control"><?php echo $diary ?></textarea>
      	</div>  
      </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="scripts.js"></script>
  </body>
</html>
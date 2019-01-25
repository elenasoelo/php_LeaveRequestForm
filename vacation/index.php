<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2>Home Page</h2>
	
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
	<div align="right"><a href="index.php?logout='1'" style="color: red;">logout</a></div>
	   	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
		<script type="text/javascript">
function add(){
        var cartval = confirm("Do you want to see the list of applications;");
        if( cartval == true ){
			window.open("vacationList.php");
			return true;
		}
		else{
			window.open("index.php");
			return false;
			}
	}
</script>
		<p>If you want to see the details of your leave request, push the button.</p>
		<input type="button" value="List of applications" onclick="add()" class="btn"/></div>

    <?php endif ?>
</div>
		
</body>
</html>
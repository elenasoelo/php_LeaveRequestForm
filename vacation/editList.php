<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html: charset=iso-8859-1"/>
	<title>Leave Request</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

  <div class="header">
  	<h2>Leave Request</h2>
  </div>
   <form action="editList.php" method="post">

<div align="right"><a href="index.php?logout='1'" style="color: red;">logout</a></div>
 
        
  <b>Fill out the following gaps if you want to continue the leave request.</b> 
<?php
$start="";
$end="";
$reason="";
?>    
        		
      <div class="input-group">
  	  <label>Date from</label>  
	  <input type="date" name="start" id="start" value="<?php echo $start; ?>"></div>
	  <div class="input-group">
  	  <label>Date to</label>  
		<input type="date" name="end" id="end" value="<?php echo $end; ?>" > </div>
	  <div class="input-group">
  	  <label>Reason</label>  
		<input  type="text" name="reason" id="reason" value="<?php echo $reason; ?>" ></div>
					<script type="text/javascript">
function back(){
        var cartval = confirm("Are you sure you want to go back;");
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
           <div class="input-group">
            <button type="submit" name="submit" class="btn">Submit</button>
            <button type="reset" name="reset" class="btn">Reset</button>
		<button type="reset"  onclick="back()" class="btn">Back to the list</button></div>
			 
<?php

if (isset($_POST['submit'])){
	/** Create a new database object */
	session_start();
	include("server.php");
if (isset($_SESSION['username'])) {		

	$result1=mysqli_query($db,"SELECT * FROM registration WHERE username='".$_SESSION['username']."'");
	
	
	while($test1 = mysqli_fetch_array($result1)){
		$username = $test1['username'];
			$email = $test1['email'];
		$id = $test1['id'];		
		
$submission_date = date("Y-m-d");
$start_date = mysqli_real_escape_string($db, $_POST['start']);
$end_date = mysqli_real_escape_string($db, $_POST['end']);
$reason = mysqli_real_escape_string($db, $_POST['reason']);
$table = "dates";

/*unset($_SESSION['start']);
unset($_SESSION['end']);
unset($_SESSION['reason']);*/

 $request =  "INSERT INTO $table (id, submission_date, start, end, reason) VALUES ('$id', '$submission_date', '$start_date', '$end_date', '$reason')";
  $leave = mysqli_query($db, $request);
$last_id = mysqli_insert_id($db);

		}
		$result=mysqli_query($db, "SELECT * FROM dates WHERE id=$id ORDER BY leave_id DESC");
		
		while($test=mysqli_fetch_array($result)){
			$leave_id = $test['leave_id'];
			//Format days to in a form like 'd-m-Y' instead of 'Y-m-d'
		$submission_date=$test['submission_date'];
		$myDateTime = DateTime::createFromFormat('Y-m-d', $submission_date);
		$formattedsubmission_date = $myDateTime->format('d-m-Y');
		
		$start_date=$test['start'];
		$myDateTime1 = DateTime::createFromFormat('Y-m-d', $start_date);
		$formattedstart_date = $myDateTime1->format('d-m-Y');
		
		$end_date=$test['end'];
		$myDateTime2 = DateTime::createFromFormat('Y-m-d', $end_date);
		$formattedend_date = $myDateTime2->format('d-m-Y');
		}
	
	$to="elsougela@yahoo.com";
	$message1 = "Dear supervisor, employee $username requested for some time off, starting on
$formattedstart_date and ending on $formattedend_date, stating the reason: $reason. Click on one the below link to approve or reject the application:
http://localhost/vacation2/approve1.php Approved or Rejected";
			
	mail($to,"Leave Notification mail from the employee $username",$message1,"FROM: $email");
		

header('location: vacationList.php');
}
		}

?>       
	  </form>
			</div>
			</form>

 </body>
</html>

<?php
require("server.php");
	$leave_id=$_REQUEST['leave_id'];
$result=mysqli_query($db, "SELECT * FROM dates WHERE leave_id='$leave_id'");
$test=mysqli_fetch_array($result);
if(!$result)
{
	die("Error: Data not found!");
}
$id = $test['id'];		
		$submission_date = $test['submission_date'];
		$start_date=$test['start'];
		$end_date=$test['end'];
		$reason=$test['reason'];
		$status=$test['status'];
		
if (isset($_POST['save'])){
$submission_date = $test['submission_date'];
$myDateTime = DateTime::createFromFormat('Y-m-d', $submission_date);
		$formattedsubmission_date = $myDateTime->format('d-m-Y');
		$start_date=$test['start'];
		$end_date=$test['end'];
		$reason=$test['reason'];
			$id = $_POST['id'];					

		$status=$_POST['status'];
		//$table = "dates";
	$request = mysqli_query($db, "UPDATE dates SET id='$id', submission_date='$submission_date', start='$start_date', end='$end_date', reason='$reason', status='$status' WHERE leave_id='$leave_id'");

//$last_id = mysqli_insert_id($db);
echo "Leave is $status";
if($request==1){
	$result1=mysqli_query($db,"SELECT * FROM registration WHERE id='$id'");
	
		while($test1 = mysqli_fetch_array($result1)){
		$username = $test1['username'];
			$email = $test1['email'];
		}	
	}
		$message2 = "Dear employee, your supervisor has $status your application submitted on $formattedsubmission_date. ";
			
	mail($email,"Leave Notification mail from the employee $username",$message2,"FROM: admin@mail.com");
	

header('location: approve1.php');
}
?>
   <!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html: charset=iso-8859-1"/>
	<title>Leave Approval Form</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

  <div class="header">
  	<h2>Leave Approval Form</h2>
  </div>
   <form method="post">
       <table style="border-collapse:collapse: background-color:#fff;" border="1" align="center">
	<thead>
		<tr>
	<td><label>Employee's id</label></td>
	<td><input type="text" name="id" id="id" value="<?php echo $id ?>"/>
	</td>
	</tr>
	<tr>
	<tr>
	<td><label>Leave id</label></td>
	<td><input type="text" name="leave_id" id="leave_id" value="<?php echo $leave_id ?>"/>
	</td>
	</tr>
	<tr>
	<td><label>Submission date</label></td>
	<td>
	<?php
		$myDateTime = DateTime::createFromFormat('Y-m-d', $submission_date);
		$formattedsubmission_date = $myDateTime->format('d-m-Y');
	echo $formattedsubmission_date;
	?>
	</td>
	</tr>
	<tr>
	<td><label>Date from</label></td>
	<td>
		<?php
		$myDateTime1 = DateTime::createFromFormat('Y-m-d', $start_date);
		$formattedstart_date = $myDateTime1->format('d-m-Y');
	echo $formattedstart_date;
	?>
	</td>
	</tr>
	<tr>
	<td><label>Date to</label></td>
	<td>
	<?php
		$myDateTime2 = DateTime::createFromFormat('Y-m-d', $end_date);
		$formattedend_date = $myDateTime2->format('d-m-Y');
	echo $formattedend_date;
	?>
	</td>
	</tr>
	<tr>
	<td><label>Reason</label></td>
	<td><input type="text" name="reason" id="reason" value="<?php echo $reason ?>"/>
	</td>
	</tr>
	<tr>
	<td><label>Status</label></td>
	<td><input type="text" name="status" id="status" />
	</td>
	</tr>
	</thead>
	<tbody> 
 <button type="approve" name="save" class="btn">Save changes</button>

			</div>
			</form>

 </body>
</html>
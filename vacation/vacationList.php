<!DOCTYPE html>
<html>
<head>
	<title>Vacation list</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2>List of all the leave request you have done so far.</h2>
	
</div>
<div class="content">
<div align="right"><a href="index.php?logout='1'" style="color: red;">logout</a></div>
    <table style="border-collapse:collapse: background-color:#fff;" border="1" align="center">
	<thead>
	<tr>
	<th>Leave id</th>
	<th>Submission date</th>
	<th>Date from</th>
	<th>Date to</th>
	<th>Reason</th>
	<th>Status</th>
	</tr>
	</thead>
	<tbody>
	<?php
	include("server.php");
	
if (isset($_SESSION['username'])) {		

	$result1=mysqli_query($db,"SELECT * FROM registration WHERE username='".$_SESSION['username']."'");
	
	
	while($test1 = mysqli_fetch_array($result1)){
		$username = $test1['username'];
			$email = $test1['email'];
		$id = $test1['id'];
		
		
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
		
		echo "<tr>";		
		//echo "<td>" .$username."</td>";
		echo "<td>" .$test['leave_id']."</td>";
		echo "<td>" .$formattedsubmission_date."</td>";
		echo "<td>" .$formattedstart_date."</td>";
		echo "<td>" .$formattedend_date."</td>";
		echo "<td>" .$test['reason']."</td>";
		
		if($test['status']!=""){
		echo "<td>" .$test['status']."</a>";
		}
		
		else{
			echo"<td> Pending/Approved/Rejected";
		}
		echo "</tr>";
	}
	}
}
	mysqli_close($db);
	?>
	
        <form name="addNewDate" action="editList.php">
            <input type="submit" class="btn" value="Leave request"/>
        </form>
       </tbody>
	</table>
    </body>
</html>
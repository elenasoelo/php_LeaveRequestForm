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
   <table style="border-collapse:collapse: background-color:#fff;" border="1" align="center">
	<thead>
	<tr>
	<th>Leave id</th>
	<th>Username</th>
	<th>Email</th>
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
	
$result=mysqli_query($db, "SELECT * FROM dates ORDER BY leave_id DESC");
	
	while($test = mysqli_fetch_array($result)){
		$id = $test['id'];
		$leave_id = $test['leave_id'];
		
		$result1=mysqli_query($db,"SELECT * FROM registration WHERE id=$id ");
		
		while($test1=mysqli_fetch_array($result1)){
			$username = $test1['username'];
			$email = $test1['email'];
			
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
		echo "<td>" .$test['leave_id']."</td>";
		echo "<td>" .$username."</td>";
		echo "<td>" .$email."</td>";
		echo "<td>" .$formattedsubmission_date."</td>";
		echo "<td>" .$formattedstart_date."</td>";
		echo "<td>" .$formattedend_date."</td>";
		echo "<td>" .$test['reason']."</td>";
		
		if($test['status']!=""){
		echo "<td>" .$test['status']."</a>";
		}
		
		else{
			echo"<td> <a href ='approve.php?leave_id=$leave_id'>Approve/Rejected</a>";

		}
		echo "</tr>";
	}
	}
	mysqli_close($db);
	?>
	
        <form name="addNewDate" action="approve1.php">
            <input type="submit" class="btn" value="Leave request"/>
        </form>
        
	</tbody>
	</table>
        
    </body>
</html>
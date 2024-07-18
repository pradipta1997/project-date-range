<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	</head>

<body>
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		
		<h3 class="text-primary">PHP - Filter Range Of Date With MySQLi</h3>
		<hr style="border-top:1px dotted #000;"/>
		
		<form class="form-inline" method="POST" action="">
			<label>Date:</label>
			<input type="date" class="form-control" placeholder="Start"  name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" />
			<label>To</label>
			<input type="date" class="form-control" placeholder="End"  name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>"/>
			<button class="btn btn-primary" name="search"><span class="glyphicon glyphicon-search"></span></button> <a href="index.php" type="button" class="btn btn-success"><span class = "glyphicon glyphicon-refresh"><span></a>
		</form>
		<br /><br />

		<div class="table-responsive">	
			<table class="table table-bordered">
				<thead class="alert-info">
					<tr>
						<th>Firstname</th>
						<th>Lastname</th>
						<th>Project</th>
						<th>Date Submit</th>
					</tr>
				</thead>


				<!-- MAIN FUNCTION HERE...... -->
				<tbody>
				
					<?php
						require 'conn.php';

						// DATA RESULT & FILTER SEARCH 
						if(ISSET($_POST['search'])){
							$date1 = date("Y-m-d", strtotime($_POST['date1']));
							$date2 = date("Y-m-d", strtotime($_POST['date2']));
							$query=mysqli_query($conn, "SELECT * FROM `member` WHERE date(`date_submit`) BETWEEN '$date1' AND '$date2'") or die(mysqli_error());
							$row=mysqli_num_rows($query);
							if($row>0){
								while($fetch=mysqli_fetch_array($query)){
					?>
									<tr>
										<td><?php echo $fetch['firstname']?></td>
										<td><?php echo $fetch['lastname']?></td>
										<td><?php echo $fetch['project']?></td>
										<td><?php echo $fetch['date_submit']?></td>
									</tr>

					<?php
								}
							} 
							else {
								echo'
								<tr>
									<td colspan = "4"><center>Record Not Found</center></td>
								</tr>';
							}
						}
						else {

						// LIST DATA DISPLAY -->
						$query=mysqli_query($conn, "SELECT * FROM `member`") or die(mysqli_error());
						while($fetch=mysqli_fetch_array($query)){
					?>
							
							<tr>
								<td><?php echo $fetch['firstname']?></td>
								<td><?php echo $fetch['lastname']?></td>
								<td><?php echo $fetch['project']?></td>
								<td><?php echo $fetch['date_submit']?></td>
							</tr>

					<?php
						}

						}
					?>
				</tbody>
			</table>
		</div>	

	</div>
</body>
</html>
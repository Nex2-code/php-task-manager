<?php 
	include('config/constants.php');
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Task Manager</title>
	<link rel="stylesheet" href="<?php echo SITEURL; ?>CSS/style.css">
</head>
<body>
	<div class="wrapper">
	<h1>Task Manager</h1>
		<p>
		<?php 

			 if(isset($_SESSION['task_add']))
			 {
			 	//display session message   
			 	echo $_SESSION['task_add'];
			 	//remove the message after once 
			 	unset($_SESSION['task_add']);
			 }
			 if(isset($_SESSION['task_delete']))
			 {
			 	echo $_SESSION['task_delete'];
			 	unset($_SESSION['task_delete']);
			 }
			  if(isset($_SESSION['task_fail']))
			 {
			 	echo $_SESSION['task_fail'];
			 	unset($_SESSION['task_fail']);
			 }
			 if(isset($_SESSION['task_update']))
			 {
			 	echo $_SESSION['task_update'];
			 	unset($_SESSION['task_update']);
			 }

		 ?>
	</p>
	
	<!-- Menu Starts Here -->
	
	<div class="menu">
	<a href="<?php echo SITEURL; ?>">Home</a>
	<?php 
	$conn2=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD);
	$db_select2=mysqli_select_db($conn2,DB_NAME);
	$sql2="SELECT * FROM tbl_list";
	$result2=mysqli_query($conn2,$sql2);
	if($result2==true)
	{
		while($row=mysqli_fetch_assoc($result2))
		{
			$list_id=$row['list_id'];
			$list_name=$row['list_name'];
			?>

			<a href="<?php echo SITEURL; ?>list_task.php?list_id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>

			<?php
		}
	}



	 ?>
	<a href="<?php echo SITEURL; ?>manage_list.php">Manage List</a>

	</div>
	
	<!-- Menu Ends Here -->
	
	<!-- Task Starts Here -->
	
		<div class="all-tasks">
			<a class="btn-primary" href="<?php SITEURL ?>add_task.php">Add Task</a>
	<table class="tbl-full">
		<tr>
			<th>S.No</th>
			<th>Task Name</th>
			<th>Priority</th>
			<th>Deadline</th>
			<th>Actions</th>
		</tr>
	
		<?php 
			$conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD);
			$db_select=mysqli_select_db($conn,DB_NAME);
			$sql="SELECT * FROM tbl_task";
			$result=mysqli_query($conn,$sql);
			$sn=1;
			if($result==true)
			{
				$count_row=mysqli_num_rows($result);
				
				if($count_row>0)
				{
					while($row=mysqli_fetch_assoc($result))
					{
						$task_id=$row['task_id'];
						$task_name=$row['task_name'];
						$priority=$row['priority'];
						$deadline=$row['deadline'];
						?>
						<tr>
							<td><?php echo $sn++; ?></td>
							<td><?php echo $task_name; ?></td>
							<td><?php echo $priority; ?></td>
							<td><?php echo $deadline; ?></td>
							<td>
								<a href="<?php echo SITEURL; ?>update_task.php?task_id=<?php echo $task_id; ?>">Update</a>
								<a href="<?php echo SITEURL; ?>delete_task.php?task_id=<?php echo $task_id; ?>">Delete</a>
							</td>
						</tr>
						<?php
					}

				}
				else
				{
					?>
					<tr>
						<td colspan="5">No task added</td>
					</tr>
					<?php
				}
			}

		 ?>
	</table>

		<!-- Task Ends Here -->
</div>
</div>
</body>
</html>
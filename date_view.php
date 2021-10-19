<?php include 'inc/header.php'?>
<?php include 'lib/Student.php'?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h2>
			<a class="btn btn-success" href="add.php">Add Student</a>
			<a class="btn btn-info pull-right" href="index.php">Take Attendence</a>
		</h2>
	</div>
	<div class="panel-body">
		<form action="" method="post">
			<style>
				 .well{background-color: #e1e1e1;}
				 .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {color: #34952c;}
				.table td{border-right: 2px solid #d5dfd5; text-align: center;}
				.table th{border-right: 2px solid #d5dfd5; text-align: center;} 
			</style>
			<table class="table table-striped">
				<tr>
					<th width:"30%">Serial</th>
					<th width: "50%">Attendence Date</th>
					<th width: "20%">Action</th>
					 
				</tr>
				<?php
					$stu=new Student();
					$getDate=$stu->getDateList();
	 				$i=0;
					if($getDate){
						while($result=$getDate->fetch_assoc()){
							$i++;
				?>
				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo $result['atten_time'];?></td>
					<td>
						 <a class="btn btn-primary"href="attenView.php?dt=<?php echo $result['atten_time'];?>">View</a>
					</td>
					  
				</tr>
				<?php } } ?> 
			</table>
		</form>
	</div>
</div>
<?php include 'inc/footer.php'?>
			 
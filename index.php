<?php include 'inc/header.php'?>
<?php include 'lib/Student.php'?>
<script type="text/javascript">
	$(document).ready(function(){
		$("form").submit(function(){
			var roll=true;
			$(':radio').each(function(){
				name=$(this).attr('name');
				if(roll && !$(':radio[name="'+ name +'"]:checked').length){
					//alert(name+ " Roll Missing!");
					$('.alert').show();
					roll= false;
				}
			});
			return roll;
		});
	});
</script>
<?php
	error_reporting(0);
	$stu=new Student();
	$cur_date=date('y-m-d');
	if($_SERVER['REQUEST_METHOD']=="POST"){
 		$attend= $_POST['attend'];
 		$atttendence=$stu->insertAtten($cur_date, $attend);
 	}
?> 
<?php 
 	if(isset($atttendence)){
 		echo $atttendence;
 	}
 ?>
 <div class='alert alert-danger' style='display: none;'><strong>Error!</strong> Roll Missing</div>
<div class="panel panel-default">
<div class="panel-heading">
	<h2>
		<a class="btn btn-success" href="add.php">Add Student</a>
		<a class="btn btn-info pull-right" href="date_view.php">View All</a>
	</h2>
</div>
<div class="panel-body">
	<div class="well text-center" style="font-size: 20px;">
		<strong>Today: </strong><?php echo $cur_date?>
	</div>
	<form action="" method="post">
		<style>
		    .well{background-color: #e1e1e1;}
		     
		   .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {color: #34952c;}
		   .table td{border-right: 2px solid #d5dfd5; text-align: center;}
		   .table th{border-right: 2px solid #d5dfd5; text-align: center;} 
		   .scs{color: green;}
		   .rd{color: red;}
		</style>
		<table class="table table-striped">
			<tr>
				<th width:"10%">Serial</th>
				<th width: "40%">Student Name</th>
				<th width: "40%">Student ID</th>
				<th width: "10%">Attendence</th>
			</tr>
			<?php
				$getStudent=$stu->getStudents();
 				$i=0;
				if($getStudent){
					while($result=$getStudent->fetch_assoc()){
						$i++;
			?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $result['studentName'];?></td>
				<td><?php echo $result['studentid'];?></td>
				<td>
					<input type="radio" name="attend[<?php echo $result['studentid'];?>]" value="present"><span class="scs"> PRE</span>
					<input type="radio" name="attend[<?php echo $result['studentid'];?>]" value="absent">
					<span class="rd"> ABS</span>
				</td>
				  
			</tr>
			<?php } } ?> 
			<tr>
				<td colspan="4" style="border-right: 0px";>
			        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
				</td>
			</tr>
		</table>
	</form>
</div>
</div>
<?php include 'inc/footer.php'?>

 
			 
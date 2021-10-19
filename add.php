 <?php include 'inc/header.php'?>
 <?php include 'lib/Student.php'?>
 <?php  
 	$stu=new Student();
 	if($_SERVER['REQUEST_METHOD']=="POST"){
 		$name= $_POST['name'];
 		$roll= $_POST['roll'];
 		$addStudent=$stu->addStudent($name,$roll);
 	}
 ?>
 <?php 
 	if(isset($addStudent)){
 		echo $addStudent;
 	}
 ?>
<div class="panel panel-default"></div>
<div class="pannel-heding">
	<h2>
		<a class="btn btn-success" href="add.php">Add Student</a>
		<?php 
			if(isset($addStudent)){
				echo "Student Added Successfully";
			}
		?>
		<a class="btn btn-info pull-right" href="index.php">Back</a>
	</h2>
</div>

<div class="panel-body">
	<form action="" method="post">

		 <div class="form-group">
		 	<level for="name">Student Name</level>
		 	<input type="text" class="form-control" name="name" id="name"?>
		 </div>

		 <div class="form-group">
		 	<level for="name">Student Roll</level>
		 	<input type="text" class="form-control" name="roll" id="roll"?>
		 </div>

		  <div class="form-group">
		 	<input type="submit" class="btn btn-primary" name="submit" id="submit" value="Add Student"?>
		 </div>

	</form>
</div>
<?php include 'inc/footer.php'?>
			 
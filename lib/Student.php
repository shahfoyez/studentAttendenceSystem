<?php
  $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/Database.php');
?>
<?php
	class Student{
		private $db;
		public function __construct(){
			$this->db=new Database();
		}
		public function getStudents(){
			$query="SELECT * from tbl_student";
			$getStd=$this->db->select($query);
			return $getStd;
		}
		public function addStudent($name,$roll){
			$name=mysqli_real_escape_string($this->db->link, $name);
			$roll=mysqli_real_escape_string($this->db->link, $roll);
			if(empty($name) || empty($roll)){
				$msg="<div class='alert alert-danger'><strong>Error!</strong> Fields Must Not Be Empty!</div>";
				return $msg;
			}
			$add_query="INSERT into tbl_student(studentName, studentid) values('$name','$roll')";
			$student_insert=$this->db->insert($add_query);

			$atten_query="INSERT into tbl_atten(roll) values('$roll')";
			$atten_insert=$this->db->insert($atten_query);
			
			if($student_insert){
				$msg="<div class='alert alert-success'><strong>Success!</strong> Data Incerted Successfully</div>";
				return $msg;
			}else{
				$msg="<div class='alert alert-danger'><strong>Error!</strong> Can Not Add Student!</div>";
				return $msg;
			}
		}
		public function getRow(){

		}
		public function insertAtten($cur_date, $attend){
			/*$query="SELECT DISTINCT atten_time from tbl_atten";
			$getDate=$this->db->select($query);
			while($result=$getDate->fetch_assoc()){
				$db_date= $result['atten_time'];
				if($cur_date==$db_date){
					$msg="<div class='alert alert-danger'><strong>Success!</strong> Attendence Already Taken today</div>";
					return $msg;
				}
			}
			*/
			$query="SELECT atten_time from tbl_atten where atten_time='$cur_date'";
			$getDate=$this->db->select($query);
			if($getDate){
				$msg="<div class='alert alert-danger'><strong>Error!</strong> Attendence Already Taken Today</div>";
				return $msg;
			}	
			foreach($attend as $atn_key=> $atn_value){
				if($atn_value=='present'){
					$stu_query="INSERT into tbl_atten(roll,attend, atten_time) values('$atn_key','present','$cur_date')";
					$data_insert=$this->db->insert($stu_query);
				}elseif($atn_value=='absent'){
					$stu_query="INSERT into tbl_atten(roll,attend, atten_time) values('$atn_key','absent','$cur_date')";
					$data_insert=$this->db->insert($stu_query);
				}
			}
			if($data_insert){
				$msg="<div class='alert alert-success'><strong>Success!</strong> Attendence Taken Successfully</div>";
				return $msg;
			}else{
				$msg="<div class='alert alert-danger'><strong>Error!</strong> Attendence not Inserted </div>";
				return $msg;
			}
		}
		public function getDateList(){
			$query="SELECT DISTINCT atten_time from tbl_atten";
			$getStd=$this->db->select($query);
			return $getStd;
		}
		public function getAttenByDate($dt){
			$query="SELECT tbl_student.studentName, tbl_atten.* 
					from tbl_student
					INNER JOIN tbl_atten
					ON tbl_student.studentid = tbl_atten.roll
					WHERE atten_time='$dt'";
			$getData=$this->db->select($query);
			return $getData;
		}
		public function updateAtten($dt, $attend){
			foreach($attend as $atn_key=> $atn_value){
				if($atn_value=='present'){
					$query="UPDATE tbl_atten
							set attend= 'present'
							WHERE roll='".$atn_key."' AND atten_time='".$dt."'";
					$data_update=$this->db->update($query);
				}elseif($atn_value=='absent'){
					$query="UPDATE tbl_atten
							set attend= 'absent'
							WHERE roll='".$atn_key."' AND atten_time='".$dt."'";
					$data_update=$this->db->update($query);
				}
			}
			if($data_update){
				$msg="<div class='alert alert-success'><strong>Success!</strong> Attendence Updated Successfully</div>";
				return $msg;
			}else{
				$msg="<div class='alert alert-danger'><strong>Error!</strong> Attendence not Updated!</div>";
				return $msg;
			}
		}
	}
?>
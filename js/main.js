$(document).ready(function(){
	//username availability
	var i;
	$('#chk[1812020124]').blur(function(){
		var atten=$(this).val();
		if(atten=='present'){
			 $('#chkstatus[1812020124]').text('✓');
		}else{
			$('#chkstatus[1812020124]').text('X');
		}
	});
	$('#chk1').blur(function(){
		var atten=$(this).val();
		if(atten=='absent'){
			 $('#chkstatus').text("X");
		}
	});
	//autocomplete textbox
	$('#skill').keyup(function(){
		var skill= $(this).val();
		if(skill !=''){
			$.ajax({
				url: "check/checkskill.php",
				method: "POST",
				data:{skill:skill},
				dataType:"text",
				success: function(data){
					$('#skillstatus').fadeIn();
					$('#skillstatus').html(data);
				}
			});
		};
	});
	$(document).on('click', 'li', function(){
		$('#skill').val($(this).text());
		$('#skillstatus').fadeOut();
	});
	 //show password button
	$("#showpassword").on('click', function(){
		 var pass= $("#password");
		 var fieldtype= pass.attr('type');
		 if(fieldtype=='password'){
		 	pass.attr('type', 'text');
		 	$(this).text("Hide Password");
		 }else{
		 	pass.attr('type', 'password');
		 	$(this).text("Show Password");
		 }
	});
	//Auto Refresh Div Content
	$("#autosubmit").click(function(){
		var content= $("#body").val();
		if($.trim(content)!=""){
			$.ajax({
				url: "check/checkrefresh.php",
				method: "POST",
				data:{body:content},
				dataType:"text",
				success: function(data){
					$("#body").val("");
				}
			});
			return false;
		}
	});
	setInterval(function(){
		$("#autostatus").load("check/getrefresh.php").fadeIn("slow");
	}, 1000);
	//live search data
	$("#livesearch").keyup(function(){
		var live= $(this).val();
		if(live !=''){
			$.ajax({
				url: "check/datasearch.php",
				method: "POST",
				data:{search:live},
				dataType:"text",
				success: function(data){
					$('#searchstatus').html(data);
				}
			});
		}else{
			$('#searchstatus').html("");
		}
	});
	//Auto Data Save
	function autoSave(){
		var content  = $("#content").val();
		var contentid= $("#contentid").val();
		if(content !=''){
			$.ajax({
				url: "check/checkautosave.php",
				method: "POST",
				data:{content:content,contentid:contentid},
				dataType:"text",
				success: function(data){
					 if(data!=""){
					 	$('#contentid').val(data);
					 }
					 $('#savestatus').text("Content save as Draft...");
					 setInterval(function(){
					 	 $('#savestatus').text("");
					 }, 4000);
				}
			});
		}
	}
	setInterval(function(){
		autoSave();
	},6000);
	 

}); 

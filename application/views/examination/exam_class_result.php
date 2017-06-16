<div class="main-panel">
 <div class="content">
            <div class="container-fluid">
			<?php if($this->session->flashdata('msg')): ?>
         <div class="alert alert-success">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
       ×</button> <?php echo $this->session->flashdata('msg'); ?>
         </div>
       <?php endif; ?>
	    <style>
		 .grade{color: #1a0edd;padding: 10px;}
		 .grade1{color: #0d871f;padding: 10px;}
		 .grade2{color: #c117e3;padding: 10px;}
		 .space{ padding:05px;}
		 
		 </style>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">View Exam Marks<button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button> </h4>
                                <p class="category"></p>
                            </div>
                            <div class="content table-responsive table-full-width">
							<!--<?php //echo base_url(); ?>examinationresult/marks_details-->
					<form method="post" action="<?php echo base_url(); ?>examination/marks_status_update" class="form-horizontal" enctype="multipart/form-data" id="markform">

            <?php  
                   $cls_id=$this->input->get('var1');
				   $exam_id=$this->input->get('var2');
				   //echo $exam_id;echo $cls_id;
		$student_array_generate = function($stu,&$student_arr) use ($subject_name,$subject_id)
		{
			foreach ($stu as $v) {
				$cnt= count($subject_name);
				for($i=0;$i<$cnt;$i++)
				{
					if($subject_id[$i] == $v->subject_id)
					{
						$student_arr[$v->name][$subject_id[$i]] = $v;
					}else{
						if(!isset($student_arr[$v->name][$subject_id[$i]]))
							$student_arr[$v->name][$subject_id[$i]] = array();
					}
				}
			}
		}

?>
                                <input type="hidden" name="exams_id" value="<?php echo $exam_id; ?>"/> 
								<input type="hidden" name="cls_id" value="<?php echo $cls_id; ?>"/> 
								
                                <table class="table table-hover table-striped">
								<?php //foreach($cls as $rows){?>
								<!--<input type="text" name="msta_id" value="<?php echo $rows->exam_status_id; ?>"/> 
								<input type="text" name="exam_id" value="<?php echo $rows->exam_id; ?>"/> 
								<input type="text" name="class_id" value="<?php echo $rows->classmaster_id; ?>"/> -->
								<?php //}?>
                                    <thead>
									<!-- <th>Sno</th>-->
                                     <th>Name</th>
								<?php
  								      if($status=="Success")
									  {
                                       $cnt= count($subject_name);
                                     for($i=0;$i<$cnt;$i++)
									 { ?>
										<th> <?php echo $subject_name[$i]; ?> <?php //echo $subject_id[$i]; ?></th>
									<?php  }
									}else{  ?>
									 <th style="color:red;">Subject Not Found</th>
									 <?php  }?>
									  <th style="color:red;">Total</th>
                                    </thead>
									
                                    <tbody>
									 <?php
			 if(!empty($stu))
			 {
				$student_arr = array();
				$student_array_generate($stu,$student_arr);
				
				$i = 1;
				foreach ($student_arr as $k => $s1)
				{
					echo '<tr>';
					//echo '<td>' . $i . '</td>';
					echo '<td>' . $k . '</td>';
					$k = 1;
					foreach ($s1 as $k1 => $s)
					{
						if(empty($s) === false && $k == 1){
							echo '<input type="hidden" id="sid" name="sutid[]" value="'.$s->enroll_id.'" />';
							echo '<input type="hidden" id="cid" name="clsmastid" value="'.$s->class_id.'" />';
							$k++;
						}
						if($status=="Success")
					   {    echo '<input type="hidden" required  name="subid" value="'.$k1.'" class="form-control"/>';
							
			              echo '<td>';
							if(!empty($s))
							{
							 echo '<span class="grade">'; echo $s->internal_mark;   echo '<span class="space">';echo $s->internal_grade;echo'</span>';echo'</span>'; 
							 echo '<span class="grade1">'; echo $s->external_mark;   echo '<span class="space">';echo $s->external_grade;echo'</span>';echo'</span>';
							 echo'<span class="combat">';
							 echo '<span class="grade2">'; echo $s->total_marks;   echo '<span class="space">';echo $s->total_grade;echo'</span>';echo'</span>';
							 echo'</span>';
							}else{
								'<form method="post" class="form-horizontal" enctype="multipart/form-data" id="markform">';
								echo '<input required style="width:50%;" type="text" readonly name="totalmarks" class="form-control"/>';
								'</form>';
								echo '<input type="hidden" required id="subid" name="subjectid[]" value="'.$k1.'" class="form-control"/>';
							}
							echo '</td>';
						}
					}
				echo '<td class="total-combat">
								  </td>';
						
					 echo '</tr>';
					$i++;
				}
				  if(!empty($smark)){ echo "";}else{ ?>
				  <tr>
					 <td>
						
						   <button type="submit" class="btn btn-info btn-fill center">Approve</button>
						
					 </td>
				  </tr>
				  <?php }
					 }else{ echo "<p style=color:red;text-align:center;>No Exam Mark Added</p>"; }
						?>
                                    </tbody>
                                </table>
								</form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
	</div>

<script type="text/javascript">

$('#exammenu').addClass('collapse in');
$('#exam').addClass('active');
$('#exam3').addClass('active');

$('tr').each(function () {
          var sum = 0;
        $(this).find('.combat').each(function () {
            var combat = $(this).text();
            if (combat !='NA'&& combat.length!==0) {
                sum += parseInt(combat);
            }
        });
        $(this).find('.total-combat').html(sum);
      });
   
$('#markform').validate({ // initialize the plugin
        rules: {
            marks1:{required:true },
			marks:{required:true }
        },
        messages: {
              marks1: "Please Enter The Marks",
			  marks: "Please Enter The Marks"
            }
    });



	   function insertfun()
	   {//onkeyup="insertfun(this.value)"
		   var m=document.getElementById("mark").value;
		   var s=document.getElementById("sid").value;
		   var c=document.getElementById("cid").value;
		   var sub=document.getElementById("subid").value;
		   var t=document.getElementById("tid").value;
		   var ex=document.getElementById("eid").value;

		   //alert(m);alert(s);alert(ex);//exit;

		  $.ajax({
				type:'post',
				url:'<?php echo base_url(); ?>/examinationresult/ajaxmarkinsert',
				data:'examid=' + ex + '&suid=' + sub + '&stuid=' + s + '&clsid=' + c + '&teid=' + t + '&mark=' + m,

				success:function(test)
				{   alert(test);exit;
					if(test=="Email Id already Exit")
					{
					/* alert(test); */
						$("#msg").html(test);
						$("#save").hide();
					}
					else{
						/* alert(test); */
						$("#msg").html(test);
						$("#save").show();
					}

				}
		  });
	}
</script>

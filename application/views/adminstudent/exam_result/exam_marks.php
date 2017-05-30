<body>
<div class="main-panel">
 <div class="content">
            <div class="container-fluid">
			<?php if($this->session->flashdata('msg')): ?>
         <div class="alert alert-success">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
       ×</button> <?php echo $this->session->flashdata('msg'); ?>
         </div>  
       <?php endif; ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Exam Marks <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button> </h4>
                                <p class="category"></p>
                            </div>
                            <div class="content table-responsive table-full-width">
					<form method="post" action="<?php echo base_url(); ?>examinationresult/marks_details" class="form-horizontal" enctype="multipart/form-data" id="markform">
                                <table class="table table-hover table-striped">
                                    <thead>
									 <th>Sno</th>
                                     <th>Subject Name</th>
									 <th>Marks</th>
                                    </thead>
                                    <tbody>
									<?php
                                        $i=1;
										if(!empty($result)){
                                        foreach ($result as $rows) {
                                     ?>
										<tr>
										 <td><?php echo $i; ?></td>
										 <td><?php $subid=$rows->subject_id;
                                         $sql = "SELECT * FROM edu_subject WHERE subject_id='$subid' ";
                                         $result=$this->db->query($sql);
                                         $row=$result->result();
										 $sec=$row[0]->subject_name;
                                             echo $sec;
                    						  ?> </td>
											  
										 <td> 
										 <div class="col-md-5">
										 <div class="form-group">
								 <input type="text" name="marks" disabled id="smark" class="form-control" value="<?php echo $rows->marks; ?>" /> 
								 </div></div>
										 </td>
										</tr>
										 <?php $i++;  } 
										}else{ echo "<p style=text-align:center;color:red;>No exam added for any class </p>";}	
										?><td></td>
										<?php if(!empty($result)){ ?>
										 <td>TOTAL </td>
										 <td>
										  <div class="col-md-5">
										 <div class="form-group">
										 <input type="text" class="form-control" disabled name="totals"/>
										  </div></div></td>
										<?php }else{ echo"";}?>
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
	</body>
	<script type="text/javascript">
$(window).load(function($) {
    loadmarks();
});
	
function loadmarks()
{
		var tot=0;
		$("input[name=marks]").each (function() {
			tot=tot + parseInt($(this).val());
		})
	$("input[name=totals]").val(tot);
	
}

/* $(document).ready(function(e) {
	$("#smark").change(function (){
		var tot=0;
		$("input[name=marks]").each (function() {
			tot=tot + parseInt($(this).val());
		})
	$("input[name=totals]").val(tot);
	});
  }); */
</script>

<script type="text/javascript">
	   function insertfun()
	   {
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
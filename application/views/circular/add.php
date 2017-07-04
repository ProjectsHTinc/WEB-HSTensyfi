<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <?php if($this->session->flashdata('msg')): ?>
               <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                  ×</button> <?php echo $this->session->flashdata('msg'); ?>
               </div>
               <?php endif; ?>
               <div class="card">
                  <div class="header">
                     <legend> Circular Details</legend>
                  </div>
                  <div class="content">
                     <form method="post" action="<?php echo base_url(); ?>circular/create" class="form-horizontal" enctype="multipart/form-data" onsubmit="return validates()" name="form" id="myformsection">
						 <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label"></label>
                              <div class="col-sm-6">
							   <button type="button" id="all" onclick="myFunction3()" class="btn btn-info btn-fill ">All</button>
							   <button type="button" id="teacher" onclick="myFunction()" class="btn btn-info btn-fill ">Teachers</button>
							   <button type="button" id="classes" onclick="myFunction1()" class="btn btn-info btn-fill ">Parents</button>
							   <button type="button" id="parents" onclick="myFunction2()" class="btn btn-info btn-fill ">Students</button>
                              </div>
                           </div>
                        </fieldset>
 
						 <fieldset>
						
                           <div class="form-group">
                              <label class="col-sm-2 control-label"> </label>
                              <div class="col-sm-4">
							   <p id="erid" style="color:red;"> </p>
                          <div id="myDIV">
						  
                                 <select multiple name="tusers[]" class="selectpicker form-control" data-title="Select Teachers" id="multiple-teacher" data-menu-style="dropdown-blue">
                                          <?php foreach ($teacher as $rows) { ?>
                                          <option value="<?php echo $rows->user_id;  ?>"><?php echo $rows->name; ?></option>
                                          <?php  }?>
                                   </select>
                              </div>

							   <div id="myDIV1" style="display:none">
							  <select  multiple name="pusers[]" id="multiple-parents" data-title="Select Parents" class="selectpicker" data-menu-style="dropdown-blue">
                                          <?php foreach ($getall_class as $rows) {  ?>
                                          <option value="<?php echo $rows->class_sec_id; ?>"><?php echo $rows->class_name; ?>   - <?php echo $rows->sec_name; ?></option>
                                          <?php      } ?>
                                 </select>
							 </div>
								 
								  <div id="myDIV2" style="display:none">
							  <select multiple name="stusers[]" id="multiple-students" data-title="Select Students" class="selectpicker"  data-menu-style="dropdown-blue">
							
                                          <?php foreach ($getall_class as $rows) {  ?>
                                          <option value="<?php echo $rows->class_sec_id; ?>"><?php echo $rows->class_name; ?>  - <?php echo $rows->sec_name; ?></option>
                                          <?php      } ?>
                                 </select>
								 </div>
                              </div>
                           </div>
                        </fieldset>
						
						 <div id="allid" style="display:none">
						<fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">ALL</label>
                              <div class="col-sm-4">
                                 <select  name="users" class="selectpicker" data-title="Select" id="multiple-admin" data-menu-style="dropdown-blue">
								  
                                          <?php foreach ($role as $row) { ?>
                                          <option value="<?php echo $row->role_id;?>"><?php echo $row->user_type_name; ?></option>
                                          <?php  }?>
                                   </select> 
                              </div>
							  </div>
					  </fieldset>
						</div>

                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Title</label>
                              <div class="col-sm-4">
                                 <input type="text" name="title" id="title" class="form-control"  placeholder="Enter Title" >
                              </div>
                              <label class="col-sm-2 control-label">Date</label>
                              <div class="col-sm-4">
                                 <input type="text" name="date" id="date" class="form-control datepicker" placeholder="Enter Date" >
                              </div>
                           </div>
                        </fieldset>
						
						 <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Circular Type</label>
                              <div class="col-sm-4">
                                <select name="citrcular_type" data-title="Select Circular Type" class="selectpicker form-control">
									  <option value="Immediate">Immediate</option>
									  <option value="Normal">Normal</option>
								</select>
                              </div>
                              <label class="col-sm-2 control-label">Status</label>
							  <div class="col-sm-4">
							   <select name="status"  class="selectpicker form-control">
									  <option value="Active">Active</option>
									  <option value="Deactive">De-Active</option>
								</select>
							  </div>
                           </div>
                        </fieldset>
						
                        
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Notes</label>
                              <div class="col-sm-4">
                                 <textarea name="notes" id="notes" class="form-control"  rows="4" cols="80"></textarea>
                              </div>
                              <label class="col-sm-2 control-label">&nbsp;</label>
                              <div class="col-sm-4">
                                 <button type="submit" id="save" onclick="getcube()" class="btn btn-info btn-fill center">Save</button>
                              </div>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function () {
     $('#communcicationmenu').addClass('collapse in');
     $('#communication').addClass('active');
     $('#communication1').addClass('active');
	  $('#myformsection').validate({ // initialize the plugin
       rules: {
         teacher:{required:true },
   		 class_name:{required:true },
   		 title:{required:true },
   		 date:{required:true },
   		 notes:{required:true },
		 citrcular_type:{required:true },
		 status:{required:true }
        },
        messages: {
		  teacher:"Select Teachers",
		  class_name:"Select Classes",
		  title:"Enter Title",
		  date:"Enter Date",
		  notes:"Enter The Details",
		  citrcular_type:"Select Circular Type",
		  status:"Select Status"
               }
    }); 
	
   });
  
  
</script>
<script>
function validates()
{
		var tea = document.getElementById("multiple-teacher").value;
		var par = document.getElementById("multiple-parents").value;
		var cls = document.getElementById("multiple-students").value;
		var admin = document.getElementById("multiple-admin").value;
	if(tea=="" && par=="" && cls=="" && admin=="")
     {
		 $("#erid").html("Please Select Admin Or Teachers Or Parents Or Students  ");
		 //alert( "Please Select Teachers Or Class" );
		 document.form.teacher.focus() ;
		 return false;
     }
	
} 

</script>


<script>
   function myFunction() 
   {
       var x = document.getElementById('myDIV');

       if (x.style.display === 'none')
   	   {
           x.style.display = 'block';
       } else {
           x.style.display = 'none';
       }
       $("#myDIV1").hide();
	   $("#myDIV2").hide();
	   $("#allid").hide();
   }

   function myFunction1() {
       var x = document.getElementById('myDIV1');
       if (x.style.display === 'none') {
           x.style.display = 'block';
       } else {
           x.style.display = 'none';
       }
       $("#myDIV").hide();
	   $("#myDIV2").hide();
	   $("#allid").hide();
   }
   
   function myFunction2() {
       var x = document.getElementById('myDIV2');
       if (x.style.display === 'none') {
           x.style.display = 'block';
       } else {
           x.style.display = 'none';
       }
       $("#myDIV").hide();
	   $("#myDIV1").hide();
	   $("#allid").hide();
   }
   
   function myFunction3() {
       var x = document.getElementById('allid');
       if (x.style.display === 'none') {
           x.style.display = 'block';
       } else {
           x.style.display = 'none';
       }
       $("#myDIV").hide();
	   $("#myDIV1").hide();
	   $("#myDIV2").hide();
   }
   
 function getstulist(cid) {
  //alert(cid);//exit;
$.ajax({
	url:'<?php echo base_url(); ?>circular/get_stu_list',
	type:'post',
	data:{classid:cid},
	dataType:"JSON",
    cache: false,
	success: function(data) {
		 var test=data.status;
		// alert(test);
	   if(test=="success"){
			   var res=data.res;
			   var len=res.length;
               //alert(len);
			   var stu=data.res;
			   // alert(stu);			   
			   var i;
			   var stuname='';
			   stuname +='<option value="">select Student Name</option>';
			   for (i=0;i<len;i++) {
				    stuname +='<option value="'+stu[i].admission_id+'">'+stu[i].name+'</option>';
					$("#sname").show();
					$('#msg1').hide();
				    $("#ajaxres").html(stuname);
			  }
				 
		   } else {
			    $('#msg1').html('<span style="color:red;text-align:center;">Student Not Found</p>');
				$("#ajaxres").html('');
				//alert("Error");
		   }
	}
});
}

 function getstulist1(cid) {
  //alert(cid);//exit;
$.ajax({
	url:'<?php echo base_url(); ?>circular/get_stu_list',
	type:'post',
	data:{classid:cid},
	dataType:"JSON",
    cache: false,
	success: function(data) {
		 var test=data.status;
		// alert(test);
	   if(test=="success"){
			   var res=data.res;
			   var len=res.length;
               //alert(len);
			   var stu=data.res;
			   // alert(stu);			   
			   var i;
			   var stuname='';
			   stuname +='<option value="">select Student Name</option>';
			   for (i=0;i<len;i++) {
				    stuname +='<option value="'+stu[i].admission_id+'">'+stu[i].name+'</option>';
					$("#stname").show();
					$('#msg').hide();
				    $("#ajaxres5").html(stuname);
			  }
				 
		   } else {
			    $('#msg').html('<span style="color:red;text-align:center;">Student Not Found</p>');
				$("#ajaxres5").html('');
				//alert("Error");
		   }
	}
});
}


function getparentlist(pid) {
  //alert(pid);//exit;
$.ajax({
	url:'<?php echo base_url(); ?>circular/get_parent_list',
	type:'post',
	data:{studentid:pid},
	dataType:"JSON",
    cache: false,
	success: function(data) {
		 var test=data.status;
		// alert(test);
	   if(test=="success"){
			   var res=data.res1;
			   var len=res.length;
               //alert(len);
			   var parent=data.res1;
			   // alert(stu);			   
			   var i;
			   var parentname='';
			   parentname +='<option value="">select Parent Name</option>';
			   for (i=0;i<len;i++) {
				    parentname +='<option value="'+parent[i].parent_id+'">'+parent[i].father_name+ parent[i].guardn_name+ '</option>';
					$("#pname").show();
					$('#msg2').hide();
				    $("#ajaxres1").html(parentname);
			  }
		   } else {
			    $('#msg2').html('<span style="color:red;text-align:center;">Parents Not Found</p>');
				$("#ajaxres1").html('');
				alert("Error");
		   }
	}
});
}
			
</script>
<script type="text/javascript">
   $().ready(function(){

     $('.datepicker').datetimepicker({
       format: 'DD-MM-YYYY',
       icons: {
           time: "fa fa-clock-o",
           date: "fa fa-calendar",
           up: "fa fa-chevron-up",
           down: "fa fa-chevron-down",
           previous: 'fa fa-chevron-left',
           next: 'fa fa-chevron-right',
           today: 'fa fa-screenshot',
           clear: 'fa fa-trash',
           close: 'fa fa-remove'
       }
    });
   });
</script>

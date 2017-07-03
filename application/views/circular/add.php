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
                     <form method="post" action="<?php echo base_url(); ?>communication/create" class="form-horizontal" enctype="multipart/form-data" onsubmit="return validates()" name="form" id="myformsection">
						 <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label"></label>
                              <div class="col-sm-6">
							   <button type="button" id="teacher" onclick="myFunction()" class="btn btn-info btn-fill ">Teachers</button>
							   <button type="button" id="classes" onclick="myFunction1()" class="btn btn-info btn-fill ">Parents</button>
							   <button type="button" id="parents" onclick="myFunction2()" class="btn btn-info btn-fill ">Students</button>
							   <button type="button" id="all" onclick="myFunction3()" class="btn btn-info btn-fill ">All</button>
							    <!-- <a rel="tooltip" href="" data-toggle="modal" data-target="#addmodel"  class="btn btn-info btn-fill">All</a> -->
                              </div>
                           </div>
                        </fieldset>

						 <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label"></label>
                              <div class="col-sm-4">
                          <div id="myDIV">
                                 <select multiple name="userid[]" class="selectpicker form-control"  id="multiple-teacher" data-menu-style="dropdown-blue">
                                          <?php foreach ($teacher as $rows) { ?>
                                          <option value="<?php echo $rows->user_id;  ?>"><?php echo $rows->name; ?></option>
                                          <?php  }?>
                                   </select>
                              </div>
							  <p id="erid" style="color:red;"> </p>
							   <div id="myDIV1" style="display:none">
							  <select  name="class_name[]" id="multiple-class" class="selectpicker" onchange="getstulist(this.value)"  data-menu-style="dropdown-blue">
							      <option>Select Class Name</option>
                                          <?php foreach ($getall_class as $rows) {  ?>
                                          <option value="<?php echo $rows->class_sec_id; ?>"><?php echo $rows->class_name; ?>   - <?php echo $rows->sec_name; ?></option>
                                          <?php      } ?>
                                 </select>
								 <div id="msg1"></div>
								 <div id="sname" style="display:none;padding-top:10px;">
								  <select  name="stu_name"   class="form-control" id="ajaxres" onchange="getparentlist(this.value)">
								  <option></option>
							   </select>
							   </div>
							   <div id="msg2"></div>
							   <div id="pname" style="display:none;padding-top:10px;">
							    <select  name="parent_name"  class="form-control" id="ajaxres1">
							   </select>
							   </div>
								 </div>
								 
								  <div id="myDIV2" style="display:none">
							  <select  name="class_name[]" id="multiple-class" class="selectpicker" onchange="getstulist1(this.value)"  data-menu-style="dropdown-blue">
							   <option>Select Class Name</option>
                                          <?php foreach ($getall_class as $rows) {  ?>
                                          <option value="<?php echo $rows->class_sec_id; ?>"><?php echo $rows->class_name; ?>  - <?php echo $rows->sec_name; ?></option>
                                          <?php      } ?>
                                 </select>
								<div id="msg"></div>
								 <div id="stname" style="display:none;padding-top:20px;">
								  <select  name="stu_name"   class="form-control" id="ajaxres5" onchange="getparentlist(this.value)">
							   </select>
							   </div>
								 </div>
                              </div>
                           </div>
                        </fieldset>
						 <div id="allid" style="display:none">
						<fieldset>
                           <div class="form-group">
						   <label class="col-sm-2 control-label">Students</label>
                              <div class="col-sm-4">
                                 <select  name="class_name[]" multiple id="multiple-class" class="selectpicker" onchange="getstulist(this.value)"  data-menu-style="dropdown-blue">
								  <?php foreach ($getall_class as $rows) {  ?>
								  <option value="<?php echo $rows->class_sec_id; ?>"><?php echo $rows->class_name; ?>   - <?php echo $rows->sec_name; ?></option>
								  <?php      } ?>
                                 </select>
                              </div>
							  
                              <label class="col-sm-2 control-label">Teachers</label>
                              <div class="col-sm-4">
                                 <select multiple name="teacher[]" class="selectpicker form-control"  id="multiple-teacher" data-menu-style="dropdown-blue">
                                          <?php foreach ($teacher as $rows) { ?>
                                          <option value="<?php echo $rows->teacher_id;  ?>"><?php echo $rows->name; ?></option>
                                          <?php  }?>
                                   </select> 
                              </div>
							  </div>
							   </fieldset>
							  <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Parents</label>
                              <div class="col-sm-4">
                                 <select  name="class_name[]" multiple id="multiple-class" class="selectpicker" onchange="getstulist(this.value)"  data-menu-style="dropdown-blue">
							     
                                          <?php foreach ($getall_class as $rows) {  ?>
                                          <option value="<?php echo $rows->class_sec_id; ?>"><?php echo $rows->class_name; ?>   - <?php echo $rows->sec_name; ?></option>
                                          <?php      } ?>
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
                        <br/>
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
		 
		 
		 <div class="modal fade" id="addmodel" role="dialog" >
            <div class="modal-dialog">
               <!-- Modal content-->
               <div class="modal-content">
                  <div class="modal-header" style="padding:10px;">
                     <button type="button" class="close" style="margin:25px;" data-dismiss="modal">&times;</button>
                     <h4 class="title">Circular</h4>
                  </div>
                  <div class="modal-body">
                     <p id="msg" style="text-align:center;"></p>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="card">
                              <div class="content">
                              <form method="post" action="<?php echo base_url(); ?>circular/create" class="form-horizontal" enctype="multipart/form-data" id="classsection">
                                    <fieldset>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Teachers</label>
                                          <div class="col-sm-6">
                                    <select multiple name="teacher[]" class="selectpicker form-control"  id="multiple-teacher" data-menu-style="dropdown-blue" >
								 
                                          <?php foreach ($teacher as $rows) { ?>
                                          <option value="<?php echo $rows->user_id;  ?>"><?php echo $rows->name; ?></option>
                                          <?php  }?>
                                   </select>                                          </div>
                                       </div>
                                    </fieldset>
                                    <fieldset>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Parents</label>
                                          <div class="col-sm-6">
                                           <select  name="class_name[]" multiple id="multiple-class" class="selectpicker" onchange="getstulist(this.value)"  data-menu-style="dropdown-blue">
							      <option>Select Class Name</option>
                                          <?php foreach ($getall_class as $rows) {  ?>
                                          <option value="<?php echo $rows->class_sec_id; ?>"><?php echo $rows->class_name; ?>   - <?php echo $rows->sec_name; ?></option>
                                          <?php      } ?>
                                 </select>
                                          </div>
                                       </div>
                                    </fieldset>
                                    <fieldset>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Students</label>
                                          <div class="col-sm-6">
                                               <select  name="class_name[]" multiple id="multiple-class" class="selectpicker" onchange="getstulist(this.value)"  data-menu-style="dropdown-blue">
							      <option>Select Class Name</option>
                                          <?php foreach ($getall_class as $rows) {  ?>
                                          <option value="<?php echo $rows->class_sec_id; ?>"><?php echo $rows->class_name; ?>   - <?php echo $rows->sec_name; ?></option>
                                          <?php      } ?>
                                 </select>
                                          </div>
                                       </div>
                                    </fieldset>

                                    <fieldset>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">&nbsp;</label>
                                          <div class="col-sm-10">
                                             <button type="submit" class="btn btn-info btn-fill center">Save </button>
                                          </div>
                                       </div>
                                    </fieldset>
                                 </form>
                              </div>
                           </div>
                           <!--  end card  -->
                        </div>
                        <!-- end col-md-12 -->
                     </div>
                     <!-- end row -->
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
        },
        messages: {
		  teacher:"Select Teachers",
		  class_name:"Select Classes",
		  title:"Enter Title",
		  date:"Enter Date",
		  notes:"Enter The Details",
               }
    }); 
	
   });
  
  
</script>
<script>
function validates()
{
		var tea = document.getElementById("multiple-teacher").value;
		var cls = document.getElementById("multiple-class").value;
	if(tea=="" && cls=="")
     {
		 $("#erid").html("Please Select Teachers Or Class");
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

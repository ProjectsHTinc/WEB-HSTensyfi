
<div class="main-panel">
<div class="content">
<div class="col-md-12">

 
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Parents Details</h4>
                               
                            </div>
                            <div class="content">

                                <ul role="tablist" class="nav nav-tabs">
                                    <li role="presentation" class="active">
                                        <a href="#agency" data-toggle="tab">New</a>
                                    </li>
                                    <li>
                                        <a href="#company" data-toggle="tab">Existing</a>
                                    </li>
									<!-- <li>
                                        <a href="#company1" data-toggle="tab">Existing</a>
                                    </li> -->
                                   
                                </ul>

                                <div class="tab-content">
                                    <div id="agency" class="tab-pane active">
									
									 <?php if($this->session->flashdata('msg')): ?>
                              <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button> <?php echo $this->session->flashdata('msg'); ?>
                     </div>
                     <?php endif; ?>
					 
                                          <div class="content">
		
                              <form method="post" action="<?php echo base_url(); ?>parents/create" class="form-horizontal" enctype="multipart/form-data" id="parentform">

								 <fieldset>
                                        <div class="form-group">
										<label class="col-sm-2 control-label">Select</label>
										<div class="col-sm-4">
								            <select class="form-control" id="choose" >
												<option>Choose</option>
												<option value="parents">Parents</option>
												<option value="guardian">Guardian</option>
											</select>
											</div>
											</div>
								</fieldset>

                        <div id="stuparents" style="display:none">

                                <fieldset>
                                        <div class="form-group">
										
                      <input type="hidden" name="admission_no" class="form-control" placeholder="" value="<?php echo $result; ?>">

                                            <label class="col-sm-2 control-label">Father Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="father_name" class="form-control" id="fname" placeholder="Father Name" value="">
                                            </div>

                                            <label class="col-sm-2 control-label">Mother Name</label>
                                           <div class="col-sm-4">
                                                <input type="text" name="mother_name" class="form-control" placeholder="Mother Name" value="">
                                            </div>
				                     </div>

                                        <div class="form-group">
                                             <label class="col-sm-2 control-label">Mother Pic</label>
                                            <div class="col-sm-4">
                                                <input type="file" name="mother_pic" id="mpic" class="form-control" onchange="loadFile1(event)" accept="image/*" >
                                            </div>

                                          <label class="col-sm-2 control-label">Father Pic</label>
                                            <div class="col-sm-4">
                                                <input type="file" name="father_pic" id="fpic" class="form-control" onchange="loadFile(event)" accept="image/*" >
                                            </div>

                                        </div>
                                    </fieldset>
        </div>
						 <div id="stuguardian" style="display: none">
								   <fieldset>
                                        <div class="form-group">
                                             <label class="col-sm-2 control-label">Guardian Name</label>
                                            <div class="col-sm-4">
											<input type="text" name="guardn_name" class="form-control" placeholder="Guardian Name" value="">
                                            </div>

                                          <label class="col-sm-2 control-label">Guardian Pic</label>
                                            <div class="col-sm-4">
                                                <input type="file" name="guardn_pic" id="gpic" class="form-control" onchange="loadFile2(event)" accept="image/*" >
                                            </div>

                                        </div>
                                    </fieldset>
                           </div>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Occupation</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="occupation" placeholder="Occupation" class="form-control" value="">
                                            </div>
                                            <label class="col-sm-2 control-label">Income</label>
                                            <div class="col-sm-4">
                                              <input type="text" placeholder="Income" name="income" class="form-control">

                                            </div>
                                        </div>
                                    </fieldset>



								<fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Address</label>
                                            <div class="col-sm-4">
                                                <textarea name="address" MaxLength="150" placeholder="MaxCharacters 150" class="form-control" rows="4" cols="80"></textarea>
                                            </div>
                                            <label class="col-sm-2 control-label">Primary Email</label>
                                            <div class="col-sm-4">
	            <input type="text" name="email" id="txtuser"  class="form-control" placeholder="Email Address" onkeyup="checkemailfun(this.value)" />
				<p id="msg" style="color:red;"> </p> </div>


                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Secondary Email</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="email1" class="form-control " id="email" placeholder="Email Address" />
                                            </div>
                                            <label class="col-sm-2 control-label">Home Phone</label>
                                            <div class="col-sm-4">
                                                <input type="text" placeholder="Home Phone" name="home_phone" class="form-control">
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Office Phone</label>

                                            <div class="col-sm-4">
                                                <input type="text" placeholder="Office Phone" name="office_phone" class="form-control">
                                            </div>

                                            <label class="col-sm-2 control-label">Primary Mobile</label>

                                            <div class="col-sm-4">
                                                <input type="text" placeholder="Mobile Number" name="mobile" class="form-control">
                                            </div>

                                        </div>
                                    </fieldset>

									 <fieldset>
                                        <div class="form-group">
                                           <label class="col-sm-2 control-label">Secondary Mobile</label>

                                            <div class="col-sm-4">
                                                <input type="text" placeholder="Mobile Number" name="mobile1" class="form-control">
                                            </div>
											
											<label class="col-sm-2 control-label">Status</label>
                                            <div class="col-sm-4">
                                              <select name="status" class="selectpicker form-control" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                  <option value="Active">Active</option>
                                                  <option value="Deactive">DeActive</option>
                                              </select>
                                     
                                            </div>
											
											  </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
											<label class="col-sm-2 control-label">&nbsp;</label>

                                            <div class="col-sm-4">
                                                   <button type="submit" id="save" class="btn btn-info btn-fill center">Save </button>
                                            </div>

                                            </div>
                                    </fieldset>

									<fieldset>
                                        <div class="form-group">

											 <label class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-sm-4">
                                              <img  id="output1" class="img-circle" style="width:200px;">
                                            </div>

											<label class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-sm-4">
                                              <img  id="output" class="img-circle" style="width:200px;">
                                            </div>

                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-sm-4">
                                              <img  id="output2" class="img-circle" style="width:200px;">
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>

                            </div>
                                    </div>
									
									
									<!-- Existing-->
<div id="company" class="tab-pane">
   <div class="container-fluid">
           <div class="row">
               <div class="col-md-8">
					<div class="content">
					
						<form method="post" action="<?php echo base_url(); ?>parents/search" class="form-horizontal" enctype="multipart/form-data" id="parentform">  
						
					  <fieldset>
					<div class="form-group">
						<label class="col-sm-2 control-label">Mobile</label>
						<div class="col-sm-4">
	                     <input type="hidden" name="admission_no" class="form-control" placeholder=""  value="<?php echo $result; ?>">
							<input type="text" required name="cell" placeholder="Enter Your Mobile Number" class="form-control" onkeyup="checkcellfun(this.value)" value="">
							<p id="msg1"> </p>
						</div>

						<label class="col-sm-2 control-label">&nbsp;</label>

						<div class="col-sm-4">
							   <button type="submit" id="save1" class="btn btn-info btn-fill center">Search </button>
						</div>
					</div>
					</fieldset>
				</form>
				</div>
									
									
                      
               </div>
           </div>
       </div>
	  <!-- </div>
	   <div id="company1" class="tab-pane"> 
	   <?php //if($this->session->flashdata('msg')): ?>
         <div class="alert alert-success">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
       ×</button> <?php //echo $this->session->flashdata('msg'); ?>
</div>

<?php// endif; ?>-->
 <?php /* foreach ($res1 as $rows) {
						 $a=$rows->father_name ;
						 $b=$rows->mother_name ;
                     } */
					 ?>
					 
<script type="text/javascript">
   /*  $(function () {
        $("#choose").change(function () {
            if ($(this).val() == "parents") {
                $("#stuparents").show();
				$("#stuguardian").hide();
				$("#msg").hide();
				$("#msg1").hide();
				
            } else {
                $("#stuguardian").show();
				 $("#stuparents").hide();
				 $("#msg").hide();
				$("#msg1").hide();
				
            }
        });
    }); */
</script>
      <!-- <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="content">
 <form method="post" action="<?php echo base_url(); ?>parents/update_parents" class="form-horizontal" enctype="multipart/form-data" id="admissionform" name="formadmission">
                                   <fieldset>
                                        <div class="form-group">
										<label class="col-sm-2 control-label">Select</label>
										<div class="col-sm-4">
								            <select class="form-control" id="choose" >
												<?php if($a!='' && $b!='')
									              {
									             ?>
												<option value="parents">Parents</option>
												<option value="guardian">Guardain</option>
												<?php
												  }else
												  {
												?>
												<option value="guardian">Guardain</option>
												<option value="parents">Parents</option>
												<?php
												  }
												  ?>
											</select> 
											</div>
											<label class="col-sm-2 control-label">Add Admission No</label>
											 <div class="col-sm-4">
								<input type="text" name="admission_no" class="form-control" placeholder="" value="<?php echo $rows->admission_id ; ?>">	
								</div>
											</div>

<input type="hidden" name="parent_id" class="form-control" placeholder="" value="<?php echo $rows->parent_id ; ?>">
								</fieldset>
						<div id="stuparents" style="display:none">	
					
								<fieldset>
                                        <div class="form-group">
											
                                            <label class="col-sm-2 control-label">Father Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="father_name" class="form-control" id="fname" placeholder="Father Name" value="<?php echo $rows->father_name ;?>">
                                            </div>
											
                                            <label class="col-sm-2 control-label">Mother Name</label>
                                           <div class="col-sm-4">
                                                <input type="text" name="mother_name" class="form-control" placeholder="Mother Name"
 												value="<?php echo $rows->mother_name; ?>">
                                            </div>
				                     </div>
                                   
                                        <div class="form-group">
                                             <label class="col-sm-2 control-label">Mother Pic</label>
                                            <div class="col-sm-4">
                                                <input type="file" name="mother_pic" id="mpic" class="form-control" onchange="loadFile1(event)" accept="image/*" >
												<img src="<?php echo base_url(); ?>assets/admission/parents/<?php echo $rows->mother_pic; ?>" class="img-circle" style="width:110px;">
												 <img  id="output1" class="img-circle" style="width:110px;">
												 <input type="hidden" placeholder="" name="old_mother_pic" class="form-control" value="<?php echo $rows->mother_pic; ?>">
                                            </div>
											
                                          <label class="col-sm-2 control-label">Father Pic</label>
                                            <div class="col-sm-4">
                                                <input type="file" name="father_pic" id="fpic" class="form-control" onchange="loadFile(event)" accept="image/*" >
												<img src="<?php echo base_url(); ?>assets/admission/parents/<?php echo $rows->father_pic; ?>" class="img-circle" style="width:110px;">
												 <img  id="output" class="img-circle" style="width:110px;">
												<input type="hidden" placeholder="" name="old_father_pic" class="form-control" value="<?php echo $rows->father_pic; ?>">
                                            </div>
											
                                        </div>
                                    </fieldset>
						</div>			
     
						<div id="stuguardian" style="display: none">
								   <fieldset>
                                        <div class="form-group">
                                             <label class="col-sm-2 control-label">Guardian Name</label>
                                            <div class="col-sm-4">
											<input type="text" name="guardn_name" class="form-control" placeholder="Guardian Name" value="<?php echo $rows->guardn_name ;?>">
                                            </div>
                                            
                                          <label class="col-sm-2 control-label">Guardian Pic</label>
                                            <div class="col-sm-4">
                                                <input type="file" name="guardn_pic" id="gpic" class="form-control" onchange="loadFile2(event)" accept="image/*" >
												<img src="<?php echo base_url(); ?>assets/admission/parents/<?php echo $rows->guardn_pic; ?>" class="img-circle" style="width:110px;">
												<input type="hidden" placeholder="" name="old_guardian_pic" class="form-control" value="<?php echo $rows->guardn_pic; ?>">
												
                                              <img  id="output2" class="img-circle" style="width:110px;">
                                            
                                            </div>
                                      </div>
                                    </fieldset>
						</div>
								
								
									<?PHP if($a!='' && $b!='')
									{
									?><div id="msg">
									<fieldset>
                                        <div class="form-group">
											
                                            <label class="col-sm-2 control-label">Father Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="father_name" class="form-control" id="fname" placeholder="Father Name" value="<?php echo $rows->father_name ;?>">
                                            </div>
											
                                            <label class="col-sm-2 control-label">Mother Name</label>
                                           <div class="col-sm-4">
                                                <input type="text" name="mother_name" class="form-control" placeholder="Mother Name"
 												value="<?php echo $rows->mother_name; ?>">
                                            </div>
				                     </div>
                                   
                                        <div class="form-group">
                                             <label class="col-sm-2 control-label">Mother Pic</label>
                                            <div class="col-sm-4">
                                                <input type="file" name="mother_pic" id="mpic" class="form-control" onchange="loadFile1(event)" accept="image/*" >
												<img src="<?php echo base_url(); ?>assets/admission/parents/<?php echo $rows->mother_pic; ?>" class="img-circle" style="width:110px;">
												 <img  id="output1" class="img-circle" style="width:110px;">
												 <input type="hidden" placeholder="" name="old_mother_pic" class="form-control" value="<?php echo $rows->mother_pic; ?>">
                                            </div>
											
                                          <label class="col-sm-2 control-label">Father Pic</label>
                                            <div class="col-sm-4">
                                                <input type="file" name="father_pic" id="fpic" class="form-control" onchange="loadFile(event)" accept="image/*" >
												<img src="<?php echo base_url(); ?>assets/admission/parents/<?php echo $rows->father_pic; ?>" class="img-circle" style="width:110px;">
												 <img  id="output" class="img-circle" style="width:110px;">
												<input type="hidden" placeholder="" name="old_father_pic" class="form-control" value="<?php echo $rows->father_pic; ?>">
                                            </div>
											
                                        </div>
                                    </fieldset>
									</div>
									<?php 
									}
									else{
										?>
                                     <div id="msg1">
										 <fieldset>
                                        <div class="form-group">
                                             <label class="col-sm-2 control-label">Guardian Name</label>
                                            <div class="col-sm-4">
											<input type="text" name="guardn_name" class="form-control" placeholder="Guardian Name" value="<?php echo $rows->guardn_name ;?>">
                                            </div>
                                            
                                          <label class="col-sm-2 control-label">Guardian Pic</label>
                                            <div class="col-sm-4">
                                                <input type="file" name="guardn_pic" id="gpic" class="form-control" onchange="loadFile2(event)" accept="image/*" >
												<img src="<?php echo base_url(); ?>assets/admission/parents/<?php echo $rows->guardn_pic; ?>" class="img-circle" style="width:110px;">
												<input type="hidden" placeholder="" name="old_guardian_pic" class="form-control" value="<?php echo $rows->guardn_pic; ?>">
												
                                              <img  id="output2" class="img-circle" style="width:110px;">
                                            </div>
                                           </div>
										   </fieldset>
										   </div>
					
									<?php
									}
									?>
									
								
									
                                   <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Occupation</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="occupation" placeholder="Occupation" class="form-control" value="<?php echo $rows-> occupation; ?>">
                                            </div>
                                            <label class="col-sm-2 control-label">Income</label>
                                            <div class="col-sm-4">
                                              <input type="text" placeholder="Income" value="<?php echo $rows->income; ?>" name="income" class="form-control">

                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Address</label>
                                            <div class="col-sm-4">
                                                <textarea name="address" class="form-control" rows="4" cols="80"><?php echo $rows->address; ?></textarea>
                                            </div>
                                            <label class="col-sm-2 control-label">Primary Email</label>
                                            <div class="col-sm-4">
											 <input type="text" name="email" value="<?php echo $rows->email; ?>" class="form-control " id="email" placeholder="Email Address" />
										
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Secondary Email</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="email1" class="form-control "value="<?php echo $rows->email1; ?>" id="email" placeholder="Email Address" />
                                            </div>
                                            <label class="col-sm-2 control-label">Home Phone</label>
                                            <div class="col-sm-4">
                                                <input type="text" placeholder="Home Phone" value="<?php echo $rows->home_phone; ?>" name="home_phone" class="form-control">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Office Phone</label>
                                            <div class="col-sm-4">
                                                <input type="text" placeholder="Office Phone" value="<?php echo $rows->office_phone; ?>" name="office_phone" class="form-control">
                                            </div>
                                            <label class="col-sm-2 control-label">Primary Mobile</label>
                                            <div class="col-sm-4">
                                                <input type="text" placeholder="Mobile Number" value="<?php echo $rows->mobile; ?>" name="mobile" class="form-control">
                                            </div>
                                        </div>
                                    </fieldset>
									
									<fieldset>
                                        <div class="form-group">
                                            
                                            <label class="col-sm-2 control-label">Secondary Mobile</label>
                                            <div class="col-sm-4">
                                                <input type="text" placeholder="Mobile Number" value="<?php echo $rows->mobile; ?>" name="mobile1" class="form-control">
                                            </div>
											
                                        </div>
                                    </fieldset>
                                   
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-sm-10">
                                                   <button type="submit" class="btn btn-info btn-fill center">save</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                 
                            </div><!-- end content--
                        </div><!--  end card  --
                    </div> <!-- end col-md-12 --
                </div> <!-- end row --

            </div>

	   </div> -->
	   
</div>	   
				</div>
			   
		   </div>

		</div>
	</div>

</div>
</div>

<script type="text/javascript">
//  var loadFile = function(event)
//  {
//  var output = document.getElementById('output');
//  output.src = URL.createObjectURL(event.target.files[0]);
// };
//
// var loadFile1 = function(event)
//  {
//  var output1 = document.getElementById('output1');
//  output1.src = URL.createObjectURL(event.target.files[0]);
// };
//
// var loadFile2 = function(event)
//  {
//  var output2 = document.getElementById('output2');
//  output2.src = URL.createObjectURL(event.target.files[0]);
// };

 $(document).ready(function ()
 {
     $('#parentform').validate({ // initialize the plugin
     rules: {
         admission_no:{required:true, number: true },
         father_name:{required:true },
         mother_name:{required:true },
         guardn_name:{required:true },
         //email:{required:true,email:true},
         occupation:{required:true },
         income:{required:true },
         address:{required:true},
         email:{required:true,email1:true},
         home_phone:{required:true },
         office_phone:{required:true },
         mobile:{required:true },
         mobile1:{required:true },
        // father_pic:{required:true },
         //mother_pic:{required:true },
 	      // guardn_pic:{required:true }
  },
     messages: {
           admission_no: "Enter Admission No",
           father_name: "Enter Father Name",
           mother_name: "Enter Mother Name",
           guardn_name: "Enter Guardian Name",
           occupation: "Enter Occupation",
           income: "Enter Income",
           address: "Enter Address",
 	   email: "Enter Primary Email Address",
             remote: "Email already in use!",
           email1: "Enter Secondary Email Address",
 	     remote: "Email already in use!",
           home_phone: "Enter the Home Phone",
           office_phone:"Enter the Office Phone",
           community_class:"Enter the Community Class",
           mobile:"Enter The Primary Mobile Number",
           mobile1:"Enter The Secondary Mobile Number",
           //father_pic:"Enter the Father Picture",
 	   //mother_pic:"Enter the Mother Picture",
 	  // guardn_pic:"Enter the Guardian Picture"
         }
 });
});
</script>
<script type="text/javascript">
   function checkemailfun(val)
   {
      $.ajax({
			type:'post',
			url:'<?php echo base_url(); ?>/parents/checker',
			data:'email='+val,
			success:function(test)
			{
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


 function checkcellfun(val)
   {
      $.ajax({
			type:'post',
			url:'<?php echo base_url(); ?>/parents/cellchecker',
			data:'cell='+val,
			success:function(test)
			{
				if(test=="Mobile Number Available")
				{
				/* alert(test); */
			        $("#msg1").html('<span style="color:green;">Mobile Number Available</span>');
			        $("#save1").show();
					
				}
				else{
					/* alert(test); */
					$("#msg1").html('<span style="color:red;">Mobile Number Not Available</span>');
			        $("#save1").hide();
					
				}

			}
	  });
}

</script>
<script type="text/javascript">
    $(function () {
        $("#choose").change(function () {
            if ($(this).val() == "parents") {
                $("#stuparents").show();
				$("#stuguardian").hide();

            } else {
                $("#stuguardian").show();
				 $("#stuparents").hide();
            }
        });
    });
</script>


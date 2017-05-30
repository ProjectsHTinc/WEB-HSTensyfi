
<div class="main-panel">
<div class="content">
<div class="col-md-12">

                        <div class="card">
                            <div class="header">
                                <legend>Update Teacher</legend>
                            </div>
                            <?php if($this->session->flashdata('msg')): ?>
                              <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button> <?php echo $this->session->flashdata('msg'); ?>
                     </div>

                     <?php endif; ?>
                     <?php foreach ($res as $rows) { } ?>
                            <div class="content">
                                <form method="post" action="<?php echo base_url(); ?>teacher/save" class="form-horizontal" enctype="multipart/form-data" id="admissionform" name="teacherform">

                                  <fieldset>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">Name</label>
                                          <div class="col-sm-4">
                                              <input type="text" name="name" class="form-control" value="<?php echo $rows->name; ?>">

                                          </div>
                                          <label class="col-sm-2 control-label">Email</label>
                                          <div class="col-sm-4">
                                              <input type="text" name="email" readonly="" class="form-control " id="email" placeholder="Email Address" onblur="checkMailStatus()"  value="<?php echo $rows->email; ?>"/>
                                          </div>

                                      </div>
                                  </fieldset>
                                    <fieldset>
                                        <div class="form-group">

                                              <label class="col-sm-2 control-label">Gender</label>
                                                  <div class="col-sm-4">
                                            <select name="sex" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                              <option value="Male">Male</option>
                                              <option value="Female">Female</option>
                                            </select>

                                            <script language="JavaScript">document.teacherform.sex.value="<?php echo $rows->sex; ?>";</script>
                                          </div>

                                          <label class="col-sm-2 control-label">Mobile</label>
                                          <div class="col-sm-4">
                                              <input type="text" placeholder="Mobile Number" name="mobile" class="form-control" value="<?php echo $rows->phone; ?>">
                                          </div>


                                        </div>
                                    </fieldset>


                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Date of birth</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="dob" id="dob" class="form-control datepicker" placeholder="Date of Birth " value="<?php echo $rows->dob; ?>"/>
                                            </div>
                                            <label class="col-sm-2 control-label">Nationality</label>
                                            <div class="col-sm-4">
                                                <input type="text" placeholder="Nationality" name="nationality" class="form-control"  value="<?php echo $rows->nationality; ?>">
                                            </div>

                                        </div>
                                    </fieldset>

                                    <fieldset>
                                      <div class="form-group">
                                        <label class="col-sm-2 control-label">Age</label>
                                        <div class="col-sm-4">
                                          <input type="text" placeholder="Age" name="age" id="age" class="form-control"  value="<?php echo $rows->age; ?>">
                                        </div>
                                        <label class="col-sm-2 control-label">Religion</label>
                                        <div class="col-sm-4">
                                            <input type="text" placeholder="Religion" name="religion" class="form-control"  value="<?php echo $rows->religion; ?>">
                                        </div>
                                      </div>
                                    </fieldset>


                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Community Class</label>
                                            <div class="col-sm-4">
                                                <input type="text" placeholder="Community Class" name="community_class" class="form-control"  value="<?php echo $rows->community_class; ?>">
                                            </div>
                                            <label class="col-sm-2 control-label">Community</label>
                                            <div class="col-sm-4">
                                                <input type="text" placeholder="Community" name="community" class="form-control" value="<?php echo $rows->community; ?>">
                                                <input type="hidden" placeholder=" " name="old_pic" class="form-control" value="<?php echo $rows->profile_pic; ?>">
                                                  <input type="hidden" placeholder="Community" name="teacher_id" class="form-control" value="<?php echo $rows->teacher_id; ?>">
                                            </div>

                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Address</label>
                                            <div class="col-sm-4">
                                                <textarea name="address" class="form-control" rows="4" cols="80"><?php echo $rows->address; ?></textarea>
                                            </div>


                                        </div>
                                    </fieldset>
                                    <fieldset>
                                      <div class="form-group">
                                        <label class="col-sm-2 control-label">Class Teacher</label>
                                            <div class="col-sm-4">
                                              <select   name="class_teacher"  class="selectpicker" data-style="btn-info btn-fill btn-block"  data-menu-style="dropdown-blue">
                                                <?php foreach ($getall_class as $rows2) {  ?>
                                                <option value="<?php echo $rows2->class_sec_id; ?>"><?php echo $rows2->class_name; ?>&nbsp; - &nbsp;<?php echo $rows2->sec_name; ?></option>
                                          <?php      } ?>
                                              </select>
                                                  <script language="JavaScript">document.teacherform.class_teacher.value="<?php echo $rows->class_sec_id; ?>";</script>

                                            </div>
                                        <label class="col-sm-2 control-label">Class </label>
                                        <div class="col-sm-4">
                                         <select multiple  name="class_name[]" id="multiple-class" class="selectpicker" data-style="btn-info btn-fill btn-block" onchange="select_class('classname')" data-menu-style="dropdown-blue">

                                        <?php
                                         $sPlatform=$rows->class_name;
                                        $sQuery = "SELECT c.class_name,s.sec_name,cm.class_sec_id,cm.class FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id ORDER BY c.class_name";
                                         $objRs=$this->db->query($sQuery);
                                      //print_r($objRs);
                                      $row=$objRs->result();
                                      foreach ($row as $rows1) {
                                      $s= $rows1->class_sec_id;
                                      $sec=$rows1->class;
                                      $clas=$rows1->class_name;
                                        $sec_name=$rows1->sec_name;
                                      $arryPlatform = explode(",", $sPlatform);
                                     $sPlatform_id  = trim($s);
                                     $sPlatform_name  = trim($sec);
                                     if (in_array($sPlatform_id, $arryPlatform )) {
                              //echo "<input type=\"checkbox\" name=\"chkPlatform[]\" value=\"$sPlatform_id\" checked />$sPlatform_name&nbsp;&nbsp;";
                              // echo "<option  value=\"$sPlatform_id\" selected  />$sPlatform_name&nbsp;&nbsp; </option>";
                              ?>

                          <?php
                                       echo "<option  value=\"$sPlatform_id\" selected  />$clas-$sec_name &nbsp;&nbsp; </option>";
                                   ?>

                                <?php }
                                  else {
                                echo "<option value=\"$sPlatform_id\" />$clas-$sec_name &nbsp;&nbsp;</option>";
                                 }

                                      }
                                        ?>

                                  </select>
                                </div>
                                      </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Curreent  Pic</label>
                                            <div class="col-sm-4">
                                              <img src="<?php echo base_url(); ?>assets/teacher/profile/<?php echo $rows->profile_pic; ?>" class="img-circle" style="width:150px;">
                                            </div>

                                        </div>
                                    </fieldset>


                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Teacher  Pic</label>
                                            <div class="col-sm-4">
                                                <input type="file" name="teacher_pic" class="form-control" onchange="loadFile(event)" accept="image/*" >
                                            </div>
                                            <label class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-sm-4">
                                              <img  id="output" class="img-circle" style="width:200px;">
                                            </div>
                                        </div>
                                    </fieldset>


                                    <fieldset>
                                      <div class="form-group">
                                        <label class="col-sm-2 control-label">Status</label>
                                            <div class="col-sm-4">

                                      <select name="status" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                        <option value="A">Active</option>
                                        <option value="DA">De-Active</option>
                                      </select>

                                      <script language="JavaScript">document.teacherform.status.value="<?php echo $rows->status; ?>";</script>
                                    </div>
                                      </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-sm-10">
                                                   <button type="submit" class="btn btn-info btn-fill center">Save Profile</button>
                                            </div>

                                        </div>
                                    </fieldset>
                                </form>

                            </div>
                        </div>  <!-- end card -->

                    </div>
</div>
</div>
<script type="text/javascript">
var loadFile = function(event) {
 var output = document.getElementById('output');
 output.src = URL.createObjectURL(event.target.files[0]);
};


$(document).ready(function () {
jQuery('#timetablemenu').addClass('collapse in');
 $('#admissionform').validate({ // initialize the plugin
     rules: {

         name:{required:true }, address:{required:true },
         email:{required:true,email:true
         },
         sex:{required:true },
         dob:{required:true },
         age:{required:true,number:true,maxlength:2 },
         nationality:{required:true },
         religion:{required:true },
         community_class:{required:true },
         community:{required:true },

         mobile:{required:true }

     },
     messages: {

           address: "Enter Address",
           admission_date: "Select Admission Date",
           name: "Enter Name",
            email: "Enter Email Address",
             remote: "Email already in use!",
           sex: "Select Gender",
           dob: "Select Date of Birth",
           age: "Enter AGE",
           nationality: "Nationality",
           religion: "Enter the Religion",
           community:"Enter the Community",
           community_class:"Enter the Community Class",
           mother_tongue:"Enter The Mother tongue",
           mobile:"Enter the mobile Number"

         }
 });
});

</script>
<script type="text/javascript">
function checkMailStatus(){
    //alert("came");
var email=$("#email").val();// value in field email
alert(email);
$.ajax({
        type:'post',
        url:'check_email',// put your real file name
        data:{email: email},
        success:function(msg){
        alert(msg); // your message will come here.
        }
 });
}



</script>

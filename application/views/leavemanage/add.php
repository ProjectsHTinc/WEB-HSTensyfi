
<div class="main-panel">
<div class="content">
<div class="col-md-12">

                        <div class="card">
                            <div class="header">
                                <legend>Create Leave  <span><a href="<?php echo base_url(); ?>leavemanage/view" class="pull-right btn btn-wd" style="margin-top:-10px;">View Leaves</a></span></legend>

                            </div>
                            <?php if($this->session->flashdata('msg')): ?>
                              <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button> <?php echo $this->session->flashdata('msg'); ?>
                            </div>

                     <?php endif; ?>
                            <div class="content">
                                <form method="post" class="form-horizontal" enctype="multipart/form-data" id="eventform">
                                  <p style="margin-left:200px;" id="errormsg"></p>
                                  <fieldset>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">Leave Type</label>
                                          <div class="col-sm-4">
                                            <select name="leave_type" id="leave_type" class="selectpicker form-control" data-title="Leave type" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                              <option value="Regular Holiday">Regular Holiday</option>
                                              <option value="Special Holiday">Special Holiday</option>

                                            </select>

                                          </div>

                                      </div>
                                  </fieldset>

                                  <fieldset id="leave_years">
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">Years</label>
                                          <div class="col-sm-4">
                                            <select name="years" id="leave_years1" class="selectpicker form-control" data-title="Years" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                <option value="2017">2017</option>
                                                <option value="2018">2018</option>
                                              <option value="2019">2019</option>
                                              <option value="2020">2020</option>

                                            </select>
                                            <p id="erroryears"></p>
                                          </div>
                                      </div>
                                  </fieldset>
                                  <fieldset id="days">
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">Days</label>
                                          <div class="col-sm-4">
                                            <select name="days" id="leave_days" class="selectpicker form-control" data-title="Days" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                <option value="Sunday">Sunday</option>
                                                <option value="Monday">Monday</option>
                                              <option value="Tuesday">Tuesday</option>
                                              <option value="Wednesday">Wednesday</option>
                                              <option value="Thursday">Thursday</option>
                                              <option value="Friday">Friday</option>
                                              <option value="Saturday">Saturday</option>
                                            </select>
                                            <p id="errordays"></p>
                                          </div>
                                      </div>
                                  </fieldset>
                                  <fieldset id="weeks">
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">Weeks</label>
                                          <div class="col-sm-4">
                                            <select name="weeks" id="leave_weeks" class="selectpicker form-control" data-title="Weeks" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                            </select>
                                              <p id="errorweeks"></p>
                                          </div>
                                      </div>
                                  </fieldset>
                                    <fieldset  id="leaves_date">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Leave Date</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="leave_date" id="leave_date" class="form-control datepicker" placeholder="Leave Date"/>
                                                  <p id="errordates"></p>
                                            </div>


                                        </div>
                                    </fieldset>
                                    <fieldset id="leaves_name">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Leave Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="leave_name" id="leave_name" class="form-control">
                                                  <p id="errorname"></p>
                                            </div>


                                        </div>
                                    </fieldset>
                                    <!-- <fieldset id="leaves_details">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Leave Details</label>
                                            <div class="col-sm-4">
                                                <textarea type="text" name="leave_details" class="form-control"></textarea>

                                            </div>

                                        </div>
                                    </fieldset> -->

                                    <fieldset id="leave_status">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Leave Status</label>
                                            <div class="col-sm-4">
                                              <select name="leave_status" id="leave_status1" class="selectpicker form-control" data-title="Status" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                <option value="A">Active</option>
                                                <option value="DA">De-Active</option>

                                              </select>
                                                <p id="errorstatus"></p>

                                            </div>

                                        </div>
                                    </fieldset>
                                    <fieldset>

                                 <div id="div_name"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-sm-10">
                                               <!-- <input type="button" id="more" value="Add more" /> -->
                                                   <input type="button" id="leave_submit" name="leave_submit" class="btn btn-info btn-fill center" value="Save" onclick="functionleave()">
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
$('#eventmenu').addClass('collapse in');
$('#event').addClass('active');
$('#leave1').addClass('active');
$(document).ready(function () {
  $('#leaves_name').hide();
  $('#leaves_date').hide();
  $('#weeks').hide();
$('#leave_years').hide();
  $('#leave_status').hide();
  $('#days').hide();
  $('#leaves_details').hide();

  $('#leave_type').change(function () {
      if ($('#leave_type').val() == 'Special Holiday') {
        $('#weeks').hide();
        $('#days').hide();
        $('#leave_years').hide();
        $('#leaves_name').show();
        $('#leaves_details').show();
        $('#leaves_date').show();
        $('#leave_status').show();
      }else if ($('#leave_type').val() == 'Regular Holiday'){
        //alert("rh");
       $('#leaves_details').hide();
       $('#leaves_name').hide();
       $('#leaves_date').hide();
       $('#weeks').show();
       $('#days').show();
       $('#leave_years').show();
         $('#leave_status').show();
      }
      else {


      }
  });
});
function functionleave(){
 var leave_type=$('#leave_type').val();
 if(leave_type==''){
   $('#errormsg').html('<p style="color:red;">Enter the Leave Type</p>');
   //alert("type please");
 }
 if(leave_type=='Regular Holiday'){
     $('#errormsg').html(' ');
   var weeks= $('#leave_weeks').val();
   //alert(weeks);
   var days= $('#leave_days').val();
   var leave_name= $('#leave_name').val();
   var leave_date= $('#leave_date').val();
   var leave_years= $('#leave_years1').val();
   var status= $('#leave_status1').val();
    if(weeks==''){
      $('#errorweeks').html('<p style="color:red;">Select the Weeks</p>');
    }
    if(days==''){
      $('#errordays').html('<p style="color:red;">Select the Days</p>');
    }
     if(leave_years==''){
      $('#erroryears').html('<p style="color:red;">Select the Years</p>');
    }
    if(status==''){
      $('#errorstatus').html('<p style="color:red;">Select the status</p>');
    }
    if(leave_name==''){
      $('#errorname').html('<p style="color:red;">Enter the Name</p>');
    }
    if(leave_date==''){
        $('#errordates').html('<p style="color:red;">Enter the Date</p>');
    }
     //alert(weeks);
    if(weeks=='' && days=='' && leave_years=='' && status==''){

     $('#errormsg').html('<p style="color:red;">Please Enter All the fields</p>');

    }else{
      //alert("submit");
      $.ajax({
               type: "POST",
               url: "<?php echo base_url(); ?>leavemanage/add",
               data: $("#eventform").serialize(),
               success: function(data){
                 //alert(data);
                 if(data=="success"){
                   swal({
                      title: "Success!",
                      text: "Redirecting in 2 seconds.",
                      type: "success",
                      timer: 2000,
                      showConfirmButton: false
                      }, function(){
                        window.location.href = "<?php echo base_url(); ?>leavemanage/view";
                      });
                 }
                 else if(data=="regular already"){
                    sweetAlert("Oops...", "Regular Leave  Already Added to this year and Week", "error");
                 }else{
                    sweetAlert("Oops...", "Something went wrong!", "error");
                 }
               }
           });
    }

 }
 if(leave_type=='Special Holiday'){
   var leave_name= $('#leave_name').val();
   var leave_date= $('#leave_date').val();
   var status= $('#leave_status1').val();
   if(status==''){
     $('#errorstatus').html('<p style="color:red;">Select the status</p>');
   }
   if(leave_name==''){
     $('#errorname').html('<p style="color:red;">Enter the Name</p>');
   }
   if(leave_date==''){
       $('#errordates').html('<p style="color:red;">Enter the Date</p>');
   }
   if(leave_name=='' && leave_date=='' && status==''){
     alert('ERRor');
   }else{
     $.ajax({
              type: "POST",
              url: "<?php echo base_url(); ?>leavemanage/add",
              data: $("#eventform").serialize(),
              success: function(data){
                 if(data=="success"){
                   swal({
                      title: "Success!",
                      text: "Redirecting in 2 seconds.",
                      type: "success",
                      timer: 2000,
                      showConfirmButton: false
                      }, function(){
                        window.location.href = "<?php echo base_url(); ?>leavemanage/view";
                      });
                 }
                 else if(data=="special already"){
                    sweetAlert("Oops...", data, "error");
                 }else{
                    sweetAlert("Oops...", "Something went wrong!", "error");
                 }
              }
          });
   }

 }


}


</script>

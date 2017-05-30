
<div class="main-panel">
<div class="content">
<div class="col-md-12">

                        <div class="card">
                            <div class="header">
                                <legend>Edit Special Leave  </legend>

                            </div>
                            <?php if($this->session->flashdata('msg')): ?>
                              <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button> <?php echo $this->session->flashdata('msg'); ?>
                            </div>

                     <?php endif; ?>
                     <?php foreach ($res as $rows) { } //print_r($res); ?>
                            <div class="content">
                                <form method="post" action="<?php echo base_url(); ?>leavemanage/special_update" class="form-horizontal" enctype="multipart/form-data" id="eventform" name="specialleaveform">
                                  <fieldset  id="leaves_date">
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">Leave Type</label>
                                          <div class="col-sm-4">
                                              <input type="text" name="leave_date" class="form-control " value="<?php echo $rows->leave_type; ?>" readonly=""/>
                                              <input type="hidden" name="leave_id" class="form-control " value="<?php echo $rows->leave_id; ?>" readonly=""/>
                                                <input type="hidden" name="leave_mas_id" class="form-control " value="<?php echo $rows->leave_mas_id; ?>" readonly=""/>

                                          </div>

                                      </div>
                                  </fieldset>
                                    <fieldset  id="leaves_date">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Leave Date</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="leave_date" class="form-control datepicker" placeholder="Leave Date" value="<?php echo $rows->leave_date; ?>"/>

                                            </div>

                                        </div>
                                    </fieldset>
                                    <fieldset id="leaves_name">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Leave Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="leave_name" class="form-control" value="<?php echo $rows->leaves_name; ?>">

                                            </div>

                                        </div>
                                    </fieldset>


                                    <fieldset id="leave_status1">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Leave Status</label>
                                            <div class="col-sm-4">
                                              <select name="leave_status" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                <option value="A">Active</option>
                                                <option value="DA">De-Active</option>

                                              </select>
                                   <script language="JavaScript">document.specialleaveform.leave_status.value="<?php echo $rows->status; ?>";</script>

                                            </div>

                                        </div>
                                    </fieldset>
                                    <fieldset>

                                 <div id="div_name"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-sm-10">
                                               <!-- <input type="button" id="more" value="Add more" /> -->
                                                   <button type="submit" class="btn btn-info btn-fill center">Save </button>
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
 $('#eventform').validate({ // initialize the plugin
     rules: {
         event_date:{required:true },
         event_details:{required:true },
         event_name:{required:true },
         event_status:{required:true }
     },
     messages: {
           event_details: "Enter Event Details",
           event_date: "Select Event Date",
           event_name: "Enter Event Name",
           event_status: "Select Status"
         }
 });
});

</script>


<div class="main-panel">
<div class="content">
<div class="col-md-12">

                        <div class="card">
                            <div class="header">
                                <legend>Edit Term Fees Status</legend>
                            </div>
                            <?php if($this->session->flashdata('msg')): ?>
                              <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button> <?php echo $this->session->flashdata('msg'); ?>
                     </div>

                     <?php endif;
                            foreach($edit as $rows ){	} ?>

                            <div class="content">
                                <form method="post" action="<?php echo base_url(); ?>feesstructure/update_term_fees_status" class="form-horizontal" enctype="multipart/form-data" id="feesform" name="feesform">

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Academic Year</label>
                                            <div class="col-sm-4">
                                              <input type="hidden" name="id"  value="<?php  echo $rows->id; ?>">
                                                <input type="hidden" name="year_id"  value="<?php  echo $rows->year_id; ?>">
                                                <input type="text" name="year_name"  class="form-control" value="<?php echo date('Y', strtotime($rows->from_month));  echo "-"; echo date('Y', strtotime( $rows->to_month));  ?>" readonly="">
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Terms</label>
                                          <div class="col-sm-4">
										                       <input type="text" readonly name="terms"  value="<?php echo $rows->term_name;?>" class="form-control"/>
                                          </div>

                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Class</label>
                                            <div class="col-sm-4">
                                               <select name="class_name" disabled class="selectpicker" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                <option value="<?php  echo $rows->class_master_id; ?>"><?php  echo $rows->class_name; ?> - <?php  echo $rows->sec_name; ?></option>
                                              </select>
										                            <input type="hidden" name="id" value="<?php  echo $rows->id; ?>">
                                            </div>

                                        </div>
                                    </fieldset>
									
									                  <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Student Name</label>
                      							         <div class="col-sm-4">
                      				                    <input type="text" name="stu_name" readonly  value="<?php echo $rows->name;?>" class="form-control" />
                      											  </div>
                                        </div>
                                    </fieldset>
									
									
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Fees Amount</label>
                      							       <div class="col-sm-4">
                      				                 <input type="text" name="fees_amount" readonly  value="<?php echo $rows->fees_amt;?>" class="form-control" placeholder="Enter Fees Amount"/>
                      											  </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Quota Name</label>
                                            <div class="col-sm-4">
												                         <select name="quota_name"  class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                    <?php foreach ($quota as $row1) {  ?>
                                                    <option value="<?php echo $row1->id; ?>"><?php echo $row1->quota_name; ?></option>
                                                   <?php } ?>
                                                  </select>
											                             <script language="JavaScript">document.feesform.quota_name.value="<?php echo $rows->quota_id; ?>";</script>
                                            </div>
                                        </div>
                                    </fieldset>
                                   <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Status</label>
                                            <div class="col-sm-4">
                                              <select name="paid_status" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                  <option value="Paid">Paid</option>
                                                    <option value="Unpaid">Unpaid</option>
                                              </select>
											                                <script language="JavaScript">document.feesform.paid_status.value="<?php echo $rows->paid_by; ?>";</script>
                                            
                                            </div>
                                        </div>
                                    </fieldset>
                                    
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-sm-10">
                                               <button type="submit" id="save1" class="btn btn-info btn-fill center">Update </button>
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
$(document).ready(function () {

 $('#feesform').validate({ // initialize the plugin
     rules: {
         year_id:{required:true},
		     year_name:{required:true},
         terms:{required:true},
         class_name:{required:true },
         quota_name:{required:true },
         fees_amount:{required:true },
         due_date_from:{required:true },
         due_date_to:{required:true },
		     notes:{required:true },
         status:{required:true }

     },
     messages: {
           year_id:"Academic Year not enable",
		       year_name:"Academic Year not enable",
           terms: "Select Terms",
           class_name: "Select Class",
           quota_name: "Enter Quota Name",
           fees_amount: "Enter The Fees Amount",
           due_date_from: "Select due date ",
           due_date_to: "Select due date ",
		       notes: "Enter notes",
           status: "Select Status"

         }
 });
});

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





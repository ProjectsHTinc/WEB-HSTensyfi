<div class="main-panel">
   <div class="content">
      <div class="col-md-12">
         <div class="card">
            <div class="header">
               <legend>Update Test Details <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button></legend>
            </div>
            <?php if($this->session->flashdata('msg')): ?>
            <div class="alert alert-success">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
               ×</button> <?php echo $this->session->flashdata('msg'); ?>
            </div>
            <?php endif; ?>
            <?php foreach ($result as $rows) {  }?>
            <div class="content">
               <form method="post" action="<?php echo base_url(); ?>homework/update_test" class="form-horizontal" enctype="multipart/form-data" id="testform" name="testform">
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Class & Section</label>
                        <div class="col-sm-4">
                           <select multiple disabled  name="class_name[]" id="multiple-class" class="selectpicker" data-style="btn-block" onchange="select_class('classname')" data-menu-style="dropdown-blue">
                           <?php
                              $sPlatform=$rows->class_id;
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
                              ?>
                           <?php
                              echo "<option  value=\"$sPlatform_id\" selected  />$clas-$sec_name &nbsp;&nbsp; </option>";
                              ?>
                           <?php }
                                  }
                                    ?>
                           </select>

                        </div>
                        <label class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-4">
                           <input type="text"  readonly name="subject_name"  class="form-control"  value="<?php echo $rows->subject_name; ?>">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Homework Type</label>
                        <div class="col-sm-4">
						<select name="hw_type" class="selectpicker form-control" data-style="btn-default btn-block" >
                                                <option value="HT">Class Test</option>
                                                <option value="HW">Home Work</option>
                        </select>
                          <script language="JavaScript">document.testform.hw_type.value="<?php echo $rows->hw_type; ?>";</script>
                        </div>
                        <label class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-4">
                           <input type="text"  name="title"  class="form-control"  value="<?php echo $rows->title; ?>">
						     <input type="hidden"  name="id"  class="form-control"  value="<?php echo $rows->hw_id; ?>">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>    
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Test Date</label>
                        <div class="col-sm-4">
                           <input type="text"  name="test_date" class="form-control datepicker"  value="<?php $date=date_create($rows->test_date);
						echo date_format($date,"d-m-Y");?>">
                        </div>
                     <?php if($rows->hw_type=="HW"){ ?>
                          <label class="col-sm-2 control-label">Submission Date</label>
						  <div class="col-sm-4">
							 <input type="text" name="sub_date" value="<?php $date=date_create($rows->due_date);
						echo date_format($date,"d-m-Y");?>" class="form-control datepicker" >
						  </div>
					 <?php }else {echo "";} ?>
					  
						
                        </div>

                   
                  </fieldset>

				   <fieldset>
                     <div class="form-group">
					 <label class="col-sm-2 control-label">Test Details</label>
                        <div class="col-sm-4">
                           <textarea name="test_details" value="" class="form-control" rows="3" cols="03"><?php echo $rows->hw_details; ?></textarea>
                        </div>
						
						 <label class="col-sm-2 control-label">Status</label>
						<div class="col-sm-4">
						<select name="status" class="selectpicker form-control" data-style="btn-default btn-block" >
                                                <option value="A">Active</option>
                                                <option value="DA">Deactive</option>
                        </select>
                          <script language="JavaScript">document.testform.status.value="<?php echo $rows->status; ?>";</script>
					 </div>
				</fieldset>

                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-10">
                           <button type="submit" class="btn btn-info btn-fill center">Update</button>
                        </div>
                     </div>
                  </fieldset>
               </form>
            </div>
         </div>
         <!-- end card -->
      </div>
   </div>
</div>
<script type="text/javascript">

$('#homeworkmenu').addClass('collapse in');
$('#home').addClass('active');
$('#home1').addClass('active');

   $(document).ready(function(){

    $('#testform').validate({ // initialize the plugin
        rules: {

            title:{required:true },
			test_date:{required:true },
            hw_type:{required:true }
        },
        messages: {

              title: "Enter The Title",
              test_date: "Select Test Date",
              hw_type: "Select Test Type"
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

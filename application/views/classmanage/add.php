<div class="main-panel">
<div class="content">
       <div class="container-fluid">
         <div class="col-md-8">

                        <div class="card">
                            <div class="header">Class Management</div>
                            <div class="content">
                              <br>

                                <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>classmanage/assign" enctype="multipart/form-data" id="myformclassmange">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Class</label>
                                        <div class="col-md-8">
                                          <select name="class_name" class="selectpicker" data-title="Select Class" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                  <?php foreach ($class as $clas) {  ?>
                                              <option value="<?php  echo $clas->class_id; ?>"><?php  echo $clas->class_name; ?></option>
                                              <?php } ?>

                                          </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Section</label>
                                        <div class="col-md-8">
                                          <select name="section_name" class="selectpicker" data-title="Select Section " data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                  <?php foreach ($sec as $section) {  ?>
                                              <option value="<?php  echo $section->sec_id; ?>"><?php  echo $section->sec_name; ?></option>
                                              <?php } ?>

                                          </select>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                      <label class="col-sm-4 control-label">Subject To Class </label>
                                          <div class="col-sm-8">
                                            <select multiple data-title="Select More Than one class" name="subject[]" id="multiple-class" class="selectpicker" data-style="btn-block" onchange="select_class('classname')" data-menu-style="dropdown-blue">
                                              <?php foreach ($subres as $rows) {  ?>
                                              <option value="<?php echo $rows->subject_id; ?>"><?php echo $rows->subject_name; ?></option>
                                        <?php      } ?>
                                            </select>
                                          </div>
                                    </div> -->
									<div class="form-group">
									<label class="col-sm-2 control-label">Status</label>
                                          <div class="col-sm-8">
										   <select name="status"  class="selectpicker form-control">
												  <option value="Active">Active</option>
												  <option value="Deactive">De-Active</option>
											</select>
                                          </div>
										</div>


                                    <div class="form-group">
                                        <label class="col-md-3"></label>
                                        <div class="col-md-9">
                                            <button type="submit" class="btn btn-fill btn-info">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> <!-- end card -->

                    </div>
                    <div class="col-md-6">
                    </div>

                    <div class="row">

              <div class="col-md-12">
                <?php if($this->session->flashdata('msg')): ?>

                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button><b> <?php echo $this->session->flashdata('msg'); ?></b>
              </div>
            <?php endif; ?>
                  <div class="card">

                      <div class="toolbar">
                          <div class="header">List of Class & Section </div>
                      </div>

                      <table id="bootstrap-table" class="table">
                          <thead>

                            <th data-field="id" class="text-left">S.No</th>
                            <th data-field="name" class="text-left" data-sortable="true">Class</th>
                            <th data-field="Section" class="text-left" data-sortable="true">Section</th>
							               <th data-field="status" class="text-left" data-sortable="true">status</th>
                            <th data-field="actions" class="td-actions text-left" data-events="operateEvents">Actions</th>
                          </thead>
                          <tbody>
                            <?php $i=1; foreach ($getall_class as $rowsclass) { $sta=$rowsclass->status; ?>
                              <tr>
                                 <td><?php echo $i;  ?></td>
                                <td><?php echo $rowsclass->class_name;  ?></td>
                                <td><?php echo $rowsclass->sec_name;  ?></td>
                                 <td>
                    									<?php
                    									if($sta=='Active'){?>
                    									<button class="btn btn-success btn-fill btn-wd">Active</button>
                    									<?php  }else{?>
                    									<button class="btn btn-danger btn-fill btn-wd">De Active</button>
                    									<?php } ?>
                    								</td>
                                <td>
                                  <a rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon table-action edit" href="<?php echo base_url(); ?>classmanage/editcs/<?php  echo $rowsclass->class_sec_id; ?>">
                                     <i class="fa fa-edit"></i></a>
                                     <a rel="tooltip" href="#myModal" data-id="<?php echo $rowsclass->class_sec_id; ?>" title="Add Subjects" class="open-AddBookDialog btn btn-simple btn-warning btn-icon edit" style="color:#eb34ff;" data-toggle="modal" data-target="#myModal"   >
                                     <i class="fa fa-plus">  </i></a>
                                     <a rel="tooltip" href="<?php echo base_url(); ?>classmanage/view_subjects/<?php echo $rowsclass->class_sec_id; ?>"  title="View Subjects" class="open-AddBookDialog btn btn-simple btn-warning btn-icon edit">
                                     <i class="fa fa-th">  </i></a>

                                </td>

                              </tr>

                              <?php $i++;  }  ?>

                          </tbody>
                      </table>

                      <div id="myModal" class="modal fade" role="dialog">
                         <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                               <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Add Subject To Class</h4>
                               </div>
                               <div class="modal-body">
                                  <form action="" method="post" class="form-horizontal" id="subject_handling_form">
                                     <fieldset>
                                        <div class="form-group">
                                           <label class="col-sm-4 control-label">Select Subject</label>
                                           <div class="col-sm-6">
                                              <select  name="subject_id" id="subject_id"   data-title="Select Subject" class="selectpicker" data-style=" btn-block" data-menu-style="dropdown-blue" onchange="getListClass()">
                                                 <?php foreach ($resubject as $rows) {  ?>
                                                 <option value="<?php echo $rows->subject_id; ?>"><?php echo $rows->subject_name; ?></option>
                                                 <?php      } ?>
                                              </select>
                                              <input type="hidden" name="class_master_id" id="class_master_id" class="form-control" value="">
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <label class="col-sm-4 control-label">Select Type</label>
                                           <div class="col-sm-6">
                                              <select   name="exam_flag" id="exam_flag" class="form-control">
                                                <option value="0">Add to Exam</option>
                                                <option value="1">Extra Subjects</option>
                                              </select>
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <label class="col-sm-4 control-label">Select Status</label>
                                           <div class="col-sm-6">
                                              <select   name="status" id="status" class="form-control">
                                                 <option value="Active">Active</option>
                                                 <option value="Deactive">Deactive</option>
                                              </select>
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <label class="col-sm-4 control-label">&nbsp;</label>
                                           <div class="col-sm-6">
                                              <button type="submit" id="save" class="btn btn-info btn-fill center">Save </button>
                                           </div>
                                        </div>
                                     </fieldset>
                                  </form>
                               </div>
                               <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                               </div>
                            </div>
                         </div>
                      </div>
                  </div><!--  end card  -->
              </div> <!-- end col-md-12 -->
          </div> <!-- end row -->






       </div>


   </div>


</div>

<script type="text/javascript">
$('#subject_handling_form').validate({ // initialize the plugin
  rules: {
      subject_id:{required:true },
      exam_flag:{required:true },
      status:{required:true},

  },
  messages: {
        subject_id: "Select Subject",
        exam_flag:"Select Class",
        status:"Select Status"

      },
    submitHandler: function(form) {
      //alert("hi");
      swal({
                    title: "Are you sure?",
                    text: "You Want confirm  this form",
                    type: "success",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes, I am sure!',
                    cancelButtonText: "No, cancel it!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
     $.ajax({
         url: "<?php echo base_url(); ?>classmanage/subject_to_class",
          type:'POST',
         data: $('#subject_handling_form').serialize(),
         success: function(response) {
           //alert(response);
             if(response=="success"){
              //  swal("Success!", "Thanks for Your Note!", "success");
                $('#subject_handling_form')[0].reset();
                swal({
         title: "Wow!",
         text: "Message!",
         type: "success"
     }, function() {
           $('#myModal').modal('hide');
     });
             }else{
               sweetAlert("Oops...",response, "error");
             }
         }
     });
   }else{
       swal("Cancelled", "Process Cancel :)", "error");
   }
 });
}
});

 var $table = $('#bootstrap-table');
       $().ready(function(){
           $table.bootstrapTable({
               toolbar: ".toolbar",
               clickToSelect: true,
               showRefresh: true,
               search: true,
               showToggle: true,
               showColumns: true,
               pagination: true,
               searchAlign: 'left',
               pageSize: 8,
               clickToSelect: false,
               pageList: [8,10,25,50,100],

               formatShowingRows: function(pageFrom, pageTo, totalRows){
                   //do nothing here, we don't want to show the text "showing x of y from..."
               },
               formatRecordsPerPage: function(pageNumber){
                   return pageNumber + " rows visible";
               },
               icons: {
                   refresh: 'fa fa-refresh',
                   toggle: 'fa fa-th-list',
                   columns: 'fa fa-columns',
                   detailOpen: 'fa fa-plus-circle',
                   detailClose: 'fa fa-minus-circle'
               }
           });

           //activate the tooltips after the data table is initialized
           $('[rel="tooltip"]').tooltip();

           $(window).resize(function () {
               $table.bootstrapTable('resetView');
           });


       });

       $(document).on("click", ".open-AddBookDialog", function () {
            var eventId = $(this).data('id');
            $(".modal-body #class_master_id").val( eventId );
       });

$(document).ready(function () {
  $('#mastersmenu').addClass('collapse in');
  $('#master').addClass('active');
  $('#masters5').addClass('active');

 $('#myformclassmange').validate({ // initialize the plugin
     rules: {

          class_name:{required:true },

         section_name:{required:true },
     },
     messages: {
           class_name: "Select Class Name",
           section_name:"Select Section Name"


         }
 });
});




</script>

<div class="main-panel">
<div class="content">
       <div class="container-fluid">
         <div class="col-md-6">

                        <div class="card">
                            <div class="header">Class Management</div>
                            <div class="content">
                              <br>

                                <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>classmanage/assign" enctype="multipart/form-data" id="myformclassmange">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Class</label>
                                        <div class="col-md-8">
                                          <select name="class_name" class="selectpicker" data-title="Select Class" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                  <?php foreach ($class as $clas) {  ?>
                                              <option value="<?php  echo $clas->class_id; ?>"><?php  echo $clas->class_name; ?></option>
                                              <?php } ?>

                                          </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Section</label>
                                        <div class="col-md-8">
                                          <select name="section_name" class="selectpicker" data-title="Select Section " data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                  <?php foreach ($sec as $section) {  ?>
                                              <option value="<?php  echo $section->sec_id; ?>"><?php  echo $section->sec_name; ?></option>
                                              <?php } ?>

                                          </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-4 control-label">Subject To Class </label>
                                          <div class="col-sm-8">
                                            <select multiple data-title="Select More Than one class" name="subject[]" id="multiple-class" class="selectpicker" data-style="btn-block" onchange="select_class('classname')" data-menu-style="dropdown-blue">
                                              <?php foreach ($subres as $rows) {  ?>
                                              <option value="<?php echo $rows->subject_id; ?>"><?php echo $rows->subject_name; ?></option>
                                        <?php      } ?>
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
                          <!--        Here you can write extra buttons/actions for the toolbar              -->
                      </div>

                      <table id="bootstrap-table" class="table">
                          <thead>

                            <th data-field="id" class="text-left">ID</th>
                            <th data-field="name" class="text-left" data-sortable="true">Class</th>
                            <th data-field="Section" class="text-left" data-sortable="true">Section</th>

                            <th data-field="actions" class="td-actions text-left" data-events="operateEvents">Actions</th>
                          </thead>
                          <tbody>
                            <?php $i=1; foreach ($getall_class as $rowsclass) { ?>
                              <tr>

                                  <td><?php echo $i;  ?></td>

                                <td><?php echo $rowsclass->class_name;  ?></td>
                                <td><?php echo $rowsclass->sec_name;  ?></td>

                                <td>
                                  <a rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon table-action edit" href="<?php echo base_url(); ?>classmanage/editcs/<?php  echo $rowsclass->class_sec_id; ?>">
                                     <i class="fa fa-edit"></i></a>
                                  <!-- <a rel="tooltip" title="Remove" class="btn btn-simple btn-danger btn-icon table-action remove" href="<?php echo base_url(); ?>classmanage/deletecs/<?php  echo $rowsclass->class_sec_id; ?>">
                                    <i class="fa fa-remove"></i></a> -->

                                </td>

                              </tr>

                              <?php $i++;  }  ?>

                          </tbody>
                      </table>
                  </div><!--  end card  -->
              </div> <!-- end col-md-12 -->
          </div> <!-- end row -->






       </div>


   </div>


</div>

<script type="text/javascript">
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


$(document).ready(function () {
  $('#mastersmenu').addClass('collapse in');
  $('#master').addClass('active');
  $('#masters5').addClass('active');

 $('#myformclassmange').validate({ // initialize the plugin
     rules: {

          class_name:{required:true },
          "subject[]":{required:true },
         section_name:{required:true },
     },
     messages: {
           class_name: "Select Class Name",
           section_name:"Select Section Name",
           "subject[]":"Select Subjects To Class"

         }
 });
});




</script>

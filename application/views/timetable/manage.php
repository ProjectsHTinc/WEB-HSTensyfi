<style>td{text-align: center;}</style>
<div class="main-panel">
<div class="content">
<div class="col-md-12">

                        <div class="card">

                            <?php if($this->session->flashdata('msg')): ?>
                              <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button> <?php echo $this->session->flashdata('msg'); ?>
                     </div>

                     <?php endif; ?>

</div>
</div>
<div class="content">
  <div class="col-md-12">
    <div class="card">
      <div class="header">
          <legend>Class View -Time Table <a href="<?php echo base_url(); ?>timetable/home" class="btn btn-primary btn-fill btn-wd pull-right" style="margin-top:-10px;">Create Timetable</a>
             <a href="<?php echo base_url(); ?>timetable/reviewview" class="btn  btn-fill btn-wd pull-right" style="margin-top:-10px;">Go To Review</a>

          </legend>

      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
          <?php foreach ($getall_class1 as $rows) {  ?>
          <a href="<?php echo base_url(); ?>timetable/view/<?php echo $rows->timid; ?>" class="btn btn-wd btn-warning"><?php echo $rows->class_name; ?>-<?php echo $rows->sec_name; ?></a>
    <?php      } ?>
        </div>
          </div>
      </div>
    </div>
  </div>
</div>

<div class="content">
  <div class="col-md-12">
    <div class="card">
      <div class="header">
          <legend>Class View -Time Table</legend>
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <table id="bootstrap-table" class="table">
                <thead>

                    <th data-field="id" class="text-center">S.No</th>
                  <th data-field="name" class="text-center" data-sortable="true">Class</th>
                    <th data-field="name" class="text-center" data-sortable="true">Year</th>
                  <th data-field="actions" class="td-actions text-center" data-events="operateEvents">Actions</th>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($getall_class1 as $rowsclass) { ?>
                    <tr>

                        <td><?php echo $i;  ?></td>

                      <td><?php echo $rowsclass->class_name;  ?> &nbsp;-<?php echo $rowsclass->sec_name;  ?></td>
                        <td><?php echo date('Y', strtotime($rowsclass->from_month));   ?> &nbsp;-<?php echo date('Y', strtotime($rowsclass->to_month));  ?></td>
                        <!-- <td></td> -->

                      <td>
                        <!-- <a rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon table-action edit" href="<?php echo base_url(); ?>timetable/edit/<?php  echo $rowsclass->class_sec_id;  ?>"  > -->
                          <a  onclick="confrim(<?php  echo $rowsclass->class_sec_id; ?>)"> <i class="fa fa-remove"></i></a>
                         <!-- </a> -->
                        <a rel="tooltip" title="Remove" class="btn btn-simple btn-danger btn-icon table-action remove" href="<?php echo base_url(); ?>timetable/edit/<?php  echo $rowsclass->class_sec_id; ?>">
                          <i class="fa fa-remove"></i></a>

                      </td>

                    </tr>

                    <?php $i++;  }  ?>

                </tbody>
            </table>
        </div>
          </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

jQuery('#timetablemenu').addClass('collapse in');
$('#time').addClass('active');
$('#time2').addClass('active');

function confrim(val){
  swal({
              title: "Are you sure?",
              text: "You Want to Delete the this Timetable",
              type: "warning",
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
                         type: "POST",
                         url: "<?php echo base_url(); ?>timetable/delete",
                         data : {  val : val },
                         success: function(data){
                          // alert(data)
                         if(data=='success'){
                           swal({title: "Good job", text: "Deleted Successfully!", type: "success"},
                              function(){
                                  location.reload();
                              }
                           );
                         }else{
                           sweetAlert("Oops...", "Something went wrong!", "error");
                         }
                         }
                     });

              } else {
                  swal("Cancelled", "Process Cancel :)", "error");
              }
          });

}
</script>

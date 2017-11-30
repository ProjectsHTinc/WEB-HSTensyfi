<style>
.col-md-2{
width: 13%;
}
</style>
<div class="main-panel">
<div class="content">
<div class="container-fluid">
<?php if(empty($exam_view)){  }else{ ?>
<div class="row">
<div class="col-md-8">
<div class="card">
<div class="header">
<h4 class="title"> Rank System</h4>
</div>
<div class="content">
<div class="row">
<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>rank/get_all_rank" enctype="multipart/form-data" id="rankform" name="rankform">
<div class="form-group">
      <label class="col-lg-2 control-label">Select Exam</label>
      <div class="col-md-4">
         <select name="exam_id[]"  class="selectpicker" multiple="multiple" data-title="Select Exam" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
         <?php  foreach($exam_view as $rows)
            {
            $exam_id=$rows->exam_id;
            $exname=$rows->exam_name; ?>
            <option value="<?php  echo $exam_id; ?>"><?php  echo $exname; ?></option>
            <?php } ?>
         </select>
      </div>
</div>

<div class="form-group">
      <label class="col-lg-2 control-label">Select Class</label>
      <div class="col-md-4">
         <select name="class_id[]"  class="selectpicker" data-title="Select Class " data-style="btn-default btn-block" data-menu-style="dropdown-blue">
         <?php foreach($cls_view as $rows)
            {
             $cls_id=$rows->class_id;
             $clsname=$rows->class_name;
            ?>
         <option value="<?php  echo $cls_id; ?>"><?php  echo $clsname; ?></option>
         <?php } ?>
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

<div class="col-md-4">
<!--a href="<?php echo base_url();?>rank/class_name_list/<?php echo $exam_id; ?>" class="btn btn-wd"><?php echo $exname; ?></a-->
</div>
<?php  }  ?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {

         $('#rankform').validate({ // initialize the plugin
              rules: {
                'class_id[]': {required: true},
                'exam_id[]': {required: true}
              },
              messages: {
                'class_id[]': "Please Select Class",
                'exam_id[]': "Please Select Exame"
              }
          });
      });
</script>
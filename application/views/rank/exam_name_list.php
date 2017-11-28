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
            <div class="col-md-12">
               <div class="card">
                  <div class="header">
                     <h4 class="title"> Exam Name </h4>
                  </div>
                  <div class="content">
                     <div class="row">
                        <?php 
                            foreach($exam_view as $rows)
                              {
                           	 $exam_id=$rows->exam_id;
                           	 $exname=$rows->exam_name;
                           	?>
                        <div class="col-md-2">
                           <a href="<?php echo base_url();?>rank/class_name_list/<?php echo $exam_id; ?>" class="btn btn-wd"><?php echo $exname; ?></a>
                        </div>
                        <?php  } } ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

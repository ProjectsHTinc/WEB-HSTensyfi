<div class="main-panel">
<div class="content">
       <div class="container-fluid">
         <div class="col-md-12">

                        <div class="card">
                            <div class="header">View the Attendece By Class wise</div>
                            <div class="content">
                                <div class="row">
                              <?php

                                if(empty($class_id)){   ?>
                                <div class="col-md-2">  <p>No Records Found</p></div>
                                  <?php  }  else{   ?>
                                  <?php   $cnt= count($class_id);
                                   for($i=0;$i<$cnt;$i++){
                                   ?>
                               <div class="col-md-2">
                                     <a href="<?php echo  base_url(); ?>teacherattendence/month/<?php echo $class_id[$i]; ?>" class="btn btn-wd"><?php echo $class_name[$i]."-".$sec_name[$i]; ?></a></div>


                              <?php  } }  ?>
                              </div>
                            </div>
                        </div> <!-- end card -->

          </div>
       </div>
   </div>
</div>

<script type="text/javascript">




</script>

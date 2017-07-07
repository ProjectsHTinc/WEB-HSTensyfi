<style>th{width:150px;} .txt{background-color: greenyellow;
    color: red;
    font-weight: 700;}</style>
<div class="main-panel">
<div class="content">
<div class="col-md-12">


                            <?php if($this->session->flashdata('msg')): ?>
                              <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button> <?php echo $this->session->flashdata('msg'); ?>
                     </div>
                     <?php endif; ?>

</div>


<div class="content">
  <div class="col-md-12">
    <div class="card">
      <div class="header">
          <legend>Time Table<button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button> <a href="<?php echo base_url(); ?>teachertimetable/reviewview" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go To Review</a></legend>

      </div>

      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
  <!-- <form method="post" action="<?php echo base_url(); ?>timetable/create_timetable" class="form-horizontal" enctype="multipart/form-data" id="timetableform"> -->

                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                      <tr><th>Days</th>
                                    	<th>I</th>
                                    	<th>II</th>
                                    	<th>III</th>
                                    	<th>IV</th>
                                      <th>V</th>
                                      <th>VI</th>
                                      <th>VII</th>
                                      <th>VIII</th>
                                    </tr>
                                  </thead>
                                    <?php

                                  $prd= count($restime)/6; //echo  $restime[5]->subject_name; ?>
                                    <?php
$period = 8;
$arr2=array('Mon','Tue','Wednes','Thurs','Friday','Saturday');
$arr1=array('1','2','3','4','5','6');
?>


              <?php
              $k=0;

              foreach($arr1 as $day){
              
                for($i=1;$i <= 6; $i++){
                  ?>
                      <tr>
                          <th><?php echo $day; ?></th>
                          <?php
                          for($i=1;$i <= $period; $i++){
                              ?>
                  <td>
                    <?php
                            // echo  $restime[$k]->period;
                            if($day=="2"){
                              echo  $restime[$k]->class_name;
                            }

                     ?>

                  </td>
                      <?php
                  $k++;
                          }
                        }

                  }
                          ?>
                          </tr>
                                </table>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<script>
$('#timetablemenu').addClass('collapse in');
$('#timetable').addClass('active');
$('#timetable2').addClass('active');
$('#timetablereviewform').validate({ // initialize the plugin
    rules: {
        subject_id:{required:true },
        comments:{required:true },
    },
    messages: {
          comments: "Please Enter Comments",
          subject_id:"Select Subject"
        },
      submitHandler: function(form) {
        //alert("hi");
        swal({
                      title: "Are you sure?",
                      text: "You Want Confrim this form",
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
           url: "<?php echo base_url(); ?>teachertimetable/review",
            type:'POST',
           data: $('#timetablereviewform').serialize(),
           success: function(response) {
               if(response=="success"){
                //  swal("Success!", "Thanks for Your Note!", "success");
                  $('#timetablereviewform')[0].reset();
                  swal({
           title: "Wow!",
           text: "Message!",
           type: "success"
       }, function() {
           window.location = "<?php echo base_url(); ?>teachertimetable/reviewview";
       });
               }else{
                 sweetAlert("Oops...", "Something went wrong!", "error");
               }
           }
       });
     }else{
         swal("Cancelled", "Process Cancel :)", "error");
     }
   });
}
});


</script>

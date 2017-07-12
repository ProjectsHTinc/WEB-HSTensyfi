<style>th{width:150px;} .txt{background-color: greenyellow;
   color: red;
   font-weight: 700;}
</style>
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
                    <div class="col-md-2">
                    <center>Monday</center>
                    <table id="" class="table">
                       <thead>
                          <th data-field="Monday" class="text-center" data-sortable="true">Class Name</th>
                          <th data-field="Monday" class="text-center" data-sortable="true">Period</th>
                          <th data-field="Monday" class="text-center" data-sortable="true">Subject</th>
                       </thead>
                          <tbody>
                     <?php
                     foreach($restime as $rows){
                       $day=$rows->day;
                       //echo $day;
                       if($day=="1"){ ?>
                      <tr>
                        <td>  <?php echo $rows->class_name.'-'.$rows->sec_name;  ?></td>
                        <td>  <?php echo $rows->period;  ?></td>
                          <td>  <?php echo $rows->subject_name;  ?></td>
                      </tr>
                      <?php   }else{
                      }

                    }
                     ?>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-2">
                  <center>Tuesday</center>
                <table id="" class="table">
                   <thead>
                      <th data-field="Monday" class="text-center" data-sortable="true">Class Name</th>
                      <th data-field="Monday" class="text-center" data-sortable="true">Period</th>
                      <th data-field="Monday" class="text-center" data-sortable="true">Subject</th>
                   </thead>
                      <tbody>
                 <?php
                 foreach($restime as $rows){
                   $day=$rows->day;
                   //echo $day;
                   if($day=="2"){ ?>
                  <tr>
                    <td>  <?php echo $rows->class_name.'-'.$rows->sec_name;  ?></td>
                    <td>  <?php echo $rows->period;  ?></td>
                      <td>  <?php echo $rows->subject_name;  ?></td>
                  </tr>
                  <?php   }else{
                  }

                }
                 ?>
                </tbody>
              </table>
            </div>
            <div class="col-md-2">
              <center>Wednesday</center>
            <table id="" class="table">
               <thead>
                  <th data-field="Monday" class="text-center" data-sortable="true">Class Name</th>
                  <th data-field="Monday" class="text-center" data-sortable="true">Period</th>
                  <th data-field="Monday" class="text-center" data-sortable="true">Subject</th>
               </thead>
                  <tbody>
             <?php
             foreach($restime as $rows){
               $day=$rows->day;
               //echo $day;
               if($day=="3"){ ?>
              <tr>
                <td>  <?php echo $rows->class_name.'-'.$rows->sec_name;  ?></td>
                <td>  <?php echo $rows->period;  ?></td>
                  <td>  <?php echo $rows->subject_name;  ?></td>
              </tr>
              <?php   }else{
              }

            }
             ?>
            </tbody>
          </table>
        </div>

        <div class="col-md-2">
          <center>Thursday</center>
        <table id="" class="table">
           <thead>
              <th data-field="Monday" class="text-center" data-sortable="true">Class Name</th>
              <th data-field="Monday" class="text-center" data-sortable="true">Period</th>
              <th data-field="Monday" class="text-center" data-sortable="true">Subject</th>
           </thead>
              <tbody>
         <?php
         foreach($restime as $rows){
           $day=$rows->day;
           //echo $day;
           if($day=="4"){ ?>
          <tr>
            <td>  <?php echo $rows->class_name.'-'.$rows->sec_name;  ?></td>
            <td>  <?php echo $rows->period;  ?></td>
              <td>  <?php echo $rows->subject_name;  ?></td>
          </tr>
          <?php   }else{
          }

        }
         ?>
        </tbody>
      </table>
    </div>
    <div class="col-md-2">
      <center>Friday</center>
    <table id="" class="table">
       <thead>
          <th data-field="Monday" class="text-center" data-sortable="true">Class Name</th>
          <th data-field="Monday" class="text-center" data-sortable="true">Period</th>
          <th data-field="Monday" class="text-center" data-sortable="true">Subject</th>
       </thead>
          <tbody>
     <?php
     foreach($restime as $rows){
       $day=$rows->day;
       //echo $day;
       if($day=="5"){ ?>
      <tr>
        <td>  <?php echo $rows->class_name.'-'.$rows->sec_name;  ?></td>
        <td>  <?php echo $rows->period;  ?></td>
          <td>  <?php echo $rows->subject_name;  ?></td>
      </tr>
      <?php   }else{
      }

    }
     ?>
    </tbody>
  </table>
</div>
<div class="col-md-2">
  <center>Saturday</center>
<table id="" class="table">
   <thead>
      <th data-field="Monday" class="text-center" data-sortable="true">Class Name</th>
      <th data-field="Monday" class="text-center" data-sortable="true">Period</th>
      <th data-field="Monday" class="text-center" data-sortable="true">Subject</th>
   </thead>
      <tbody>
 <?php
 foreach($restime as $rows){
   $day=$rows->day;
   //echo $day;
   if($day=="6"){ ?>
  <tr>
    <td>  <?php echo $rows->class_name.'-'.$rows->sec_name;  ?></td>
    <td>  <?php echo $rows->period;  ?></td>
      <td>  <?php echo $rows->subject_name;  ?></td>
  </tr>
  <?php   }else{
  }

}
 ?>
</tbody>
</table>
</div>

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

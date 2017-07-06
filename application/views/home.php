<style>
   .box{
   padding: 12px 0px 66px 0px;
   border: 2px solid #9a8585;
   }
   .head-count{  text-align: center; border-bottom: 2px solid #9a8585;
   }
   .cnt{font-size: 20px;}
   .alinks{color: #888282;
   font-size: 17px;}
   .fc-month-button{
   display: none;
   }
   .fc-basicWeek-button{display: none;} .fc-basicDay-button{display: none;}
   .fc-scroller{
   overflow-y: hidden;
   overflow-x: hidden;
   height: 265px !important;
   width:300px;
   }
   .fc-toolbar h2{font-size: 20px;}
   .fc-view-container{margin-top: -25px;}
   .img
   {   
	   background: url(<?php echo base_url(); ?>assets/img/circular.png);
	   width: 175px;
       height: 130px;
   }
   .img1
   {   
	   background: url(<?php echo base_url(); ?>assets/img/events.png);
	   width: 175px;
       height: 130px;
   }
   .imgs
   {   
	   background: url(<?php echo base_url(); ?>assets/img/tecahers.png);
	   width: 175px;
       height: 130px;
   }
   .plusicon
   {   
	  display:inline-block;float: right;
   }
   .design{
	 color: white;
    font-size:30px;
  
   }
   .setcolor{
    background-color: #323546;
   }
   .rem{color:white;font-size:18px;text-transform: capitalize;}
</style>
<div class="main-panel">
<div class="content">
   <div class="card">
      <div class="container-fluid">
         <p style="font-size:25px;">Admin Dashboard</p>
         <div class="">
            <div class="row">
               <div class="col-md-12">
                  <div class="col-md-9">
                     <div class="card">
                        <form id="" action="#" method="" novalidate="" style="padding-bottom:30px;">
                        
                           <fieldset id="group2" style="padding-top:20px;">
                              <div class="form-group">
                                 <div class="col-sm-12">
                                    <label class="radio radio-inline">
                                    <input type="radio" data-toggle="radio" id="user_type" value="students" name="user_type" checked=""><span style="font-size:17px;">Students</span>
                                    </label>
                                    <span style="padding-left:30px;">
                                    <label class="radio radio-inline" style="margin-top:10px;">
                                    <input type="radio" data-toggle="radio" id="user_type2" value="teachers" name="user_type"><span style="font-size:17px;">Teachers</span>
                                    </label>
                                    </span>
                                    <div class="col-sm-4" style="float:right;margin-right:110px;padding-top:10px;">
                                       <select name="cls_sex" class="form-control" id="class_sec" style="padding:05px;height:30px;">
                                          <option value="">Select Class</option>
										  <?php foreach($class as $rows){?>
                                          <option value="<?php echo $rows->class_sec_id;?>"><?php echo $rows->class_name;?> - <?php echo $rows->sec_name;?></option>
										  <?php } ?>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </fieldset>
                           <div class="content">
                              <div class="form-group">
                                 <div class="col-md-10">
                                    <input class="form-control searchbox" name="text" type="text"   id="search_txt" onkeypress="search_load()" autocomplete="off" aria-required="true" placeholder="Search Students,Teacher">
                                 </div>
                                 <div class="col-md-2">
                                    <button type="button" class="btn btn-info btn-fill pull-right" onclick="search_load()">Search </button>
                                 </div>
                              </div>
                           </div>
                        </form>
                        <div class="card">
                           <div id="result">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                    
                          <div id="simple-calendar" style="border-radius: 50px;
    padding-left: 03px;"></div> 
                        
                 
                     <p></p>
                  </div>
               <!---                      -->
			     <div class="col-md-9" style="padding-left:30px;">
				 <div class="col-md-4">
                     <div class="card" style="box-shadow:none;">
					 <div class="img">
					  <ul style="padding-left:33px;">
					  <li style="padding-top:45px;list-style-type:none;">
					 <a href="<?php echo base_url(); ?>communication/add_communication" class="design">Circular</a>
					 </li>
					 </ul>
					 </div>
					</div>
					 </div>
					 <div class="col-md-4">
                     <div class="card" style="box-shadow:none;">
					 <div class="img1">
					 <ul style="padding-left:40px;">
					  <li style="padding-top:45px;list-style-type:none;">
					   <a href="<?php echo base_url(); ?>event/create" class="design">Events</a>
					 </li>
					 </ul>
					 </div>
					 </div>
					 </div>
					 <div class="col-md-4" >
                     <div class="card" style="box-shadow:none;">
					 <div class="imgs">
					  <ul style="padding-left:7px;">
					  <li style="padding-top:25px;list-style-type:none;text-align:center;">
					 <a href="<?php echo base_url(); ?>communication/view_user_leaves" class="design">Teachers Leave</a>
					 </li>
					 </ul>
					 </div>
					 </div>
					 </div>
					 
					 </div>

				    <div class="col-md-3">
                     <div class="card" style="box-shadow:0 1px 2px rgba(33, 29, 29, 0.97), 0 0 0 1px rgba(1, 1, 16, 0.98);height:130px;">
                        <div class="header" style="padding:0px;">
                        </div>
                        <div class="content table-full-width" style="padding-top:5px;">
                           <table class="table table-striped">
                              <thead>
                                 <tr>
                                    <th>Name</th>
                                    <th>Present</th>
                                    <th>Absent</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>Teachers</td>
                                    <td class="text-center"><?php	if(empty($teacher)){
                                       echo "No data";
                                       }else{
                                       foreach ($teacher as $user_to) {}
                                       		echo $user_to->user_count;
                                       } ?></td>
                                    <td class="text-center" style="padding-right:0px;">0</td>
                                 </tr>
                                 <tr>
                                    <td>Students</td>
                                    <td class="text-center"><?php 	if(empty($res)){
                                       echo "No data";
                                       }else{
                                       foreach ($res as $user_to) {}
                                       		echo $user_to->user_count;
                                       }  ?></td>
                                    <td class="text-center"style="padding-right:0px; ">0</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <p></p>
                  </div>
				  
			   
				</div>
               <hr>
               <div class="col-md-12">
                  <div class="col-md-4">
                     <!-- <div class="card ">
                        <div id="fullCalendar"></div>
                     </div>-->
					  <div class="card">
                        <!-- <div class="header">
                           <h4 class="title" style="float:left;">Reminder</h4>
                        </div>-->
                        <div class="content" style="padding-top:1px;">
                           <div class="table-full-width">
                              <table class="table">
							   <thead class="setcolor">
                                    <th colspan="2" style="padding-bottom: 8px;"><span class="rem">Circular <a href="<?php echo base_url(); ?>communication/add_communication" >
									<img class="img-responsive plusicon" src="<?php echo base_url(); ?>assets/img/icons/plus.png"/></a></span>
									</th>
								</thead>
                                 <tbody>
                                    <?php  if(empty($dash_comm)){
                                       } else {
                                       	 $i=1;
                                       	foreach ($dash_comm as $rows) { ?>
                                    <tr>
                                       <td>
                                          <label class="checkbox">
                                          <?php echo $i; ?>
                                          </label>
                                       </td>
                                       <td><?php echo $rows->commu_title;  ?> </td>
                                    </tr>
                                    <?php  $i++; } 	}?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="card">
                        <div class="content" style="padding-top:1px;">
                           <div class="table-full-width">
                              <table class="table">
							   <thead class="setcolor">
                                    <th colspan="2" style="padding-bottom: 8px;"><span class="rem"> Reminder <a href="<?php echo base_url(); ?>event/home" >
									<img class="img-responsive plusicon" src="<?php echo base_url(); ?>assets/img/icons/plus.png"/></a></span></th>
								</thead>
                                 <tbody>
                                    <?php  if(empty($dash_reminder)){
                                       } else {
                                       	 $i=1;
                                       	foreach ($dash_reminder as $rows1) { ?>
                                    <tr>
                                       <td>
                                          <label class="checkbox">
                                          <?php echo $i; ?>
                                          </label>
                                       </td>
                                       <td><?php echo $rows1->to_do_title;  ?> </td>
                                    </tr>
                                    <?php  $i++; } 	}?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="card">
                        <div class="content" style="padding-top:1px;">
                           <div class="table-full-width">
                              <table class="table">
							   <thead class="setcolor">
                                    <th colspan="2" style="padding-bottom: 8px;"><span class="rem">Task & Events <a href="<?php echo base_url(); ?>event/create" >
									<img class="img-responsive plusicon" src="<?php echo base_url(); ?>assets/img/icons/plus.png"/></a></span></th>
								</thead>
                                 <tbody>
                                    <?php  if(empty($das_events)){
                                       } else {
                                       	 $i=1;
                                       	foreach ($das_events as $rows) { ?>
                                    <tr>
                                       <td>
                                          <label class="checkbox">
                                          <?php echo $i; ?>
                                          </label>
                                       </td>
                                       <td><?php echo $new_date = date('d-m-Y', strtotime($rows->event_date));  ?> &nbsp; <?php echo $rows->event_name; ?></td>
                                    </tr>
                                    <?php  $i++; } 	}?>
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
</div>
<script type="text/javascript">
   $(document).ready(function() {
	  $('#simple-calendar').DatePicker({
	  mode: 'single',
	  inline: true,
	  date: new Date() });
});
   
   	
   function search_load(){
   
   var ser= $("#search_txt").val();
   var user_type=$('input[name=user_type]:checked').val();
   var cls_sec= $("#class_sec").val();
   //alert(cls_sec);
   
   if(!ser && !user_type && !cls_sec){
   // alert("enter Text");
   $('#result').html('<center style="color:red;">Enter The Text in Search Box</center>');
   }else{
    $.ajax({
       url:'<?php echo base_url(); ?>adminlogin/search',
       method:"POST",
       data:{ser:ser,user_type:user_type,cls_sec:cls_sec},
      //  dataType: "JSON",
      //  cache: false,
       success:function(data)
       {
        //alert(data);
         $('#result').html(data);
         //alert(data['status']);

       }
      });
   
   
   }
   }
    
</script>


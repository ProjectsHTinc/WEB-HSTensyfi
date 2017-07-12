<style>
   .fc-scroller{
   overflow-x: hidden;
   overflow-y: hidden;
   }
   
   .fc-ltr .fc-basic-view .fc-day-number{text-align: center;}
   .fc-today-button,.fc-month-button,.fc-basicWeek-button,.fc-basicDay-button{display:none;}
   .fc-month-button{display: none;}

   .textborder{height:100px;
padding-left: 0px;
margin-left: -25px;
border-left: 3px solid #1e202c;
float: left;}
.imgstyle{padding-bottom: 10px;}
ul li a img:active {
    background-color: yellow;
}
.test{padding-top: 15px;text-align: center;padding-left:0px}
.name{padding-left:30px;
font-size:25px;
font-weight: bold;}
 .plusicon
   {   
	  display:inline-block;float:right;
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
<div class="container-fluid">
   <div class="card">
      <div class="row">
	  	      <div class="col-md-12">
                   <?php  foreach ($user_details as $rows) {} ?>     
				   <div class="tab-content">
                  <div class="tab-pane active" id="description-logo">
                     <div class="" style="border:none;box-shadow: none;">
                           <div class="col-md-3" >
						   
						   <?php
					  $user_id=$this->session->userdata('user_id');
					  $user_type=$this->session->userdata('user_type');
					  $query="SELECT user_pic,name FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type'";
					  $objRs=$this->db->query($query);
					  $row=$objRs->result();
					  foreach ($row as $rows1)
					  {}
						  $pic=$rows1->user_pic;
						  if($pic!='')
						  {?>
					<img class="img-responsive img-circle" style="width:100px;height:90px;" src="<?php echo base_url(); ?>assets/parents/profile/<?php echo $pic; ?>" > 
			        <?php }else{
				   ?> <img class="img-responsive" src="<?php echo base_url(); ?>assets/noimg.png"  />
						 <?php } 
					  ?><p class="name"><?php echo $rows1->name; ?></p>
                           </div>
                           <div class="col-md-3" style="padding-top:15px;">
                              <div class="">
							   <?php 
							    if(!empty($rows->father_name) && !empty($rows->mother_name) && !empty($rows->guardn_name) ){?>
								   <p> <b>Mr. </b>:<?php echo $rows->father_name; ?></p>
                              <p>  <b>Mrs. </b><span>:<?php echo $rows->mother_name; ?></span></p>
							  <p><b>Guardian name</b> <span> : <?php echo $rows->guardn_name; ?></span></p>
							 <?php }elseif(empty($rows->guardn_name)){
							       ?>
                              <p> <b>Mr. </b>:<?php echo $rows->father_name; ?></p>
                              <p>  <b>Mrs. </b><span>:<?php echo $rows->mother_name; ?></span></p>
                              <?php	}else{  ?>
                              <p><b>Guardian name</b> <span> : <?php echo $rows->guardn_name; ?></span></p>
							 <?php 	} ?>  
							  </div>
							  
                           </div>
                        <div  class="textborder" style="height:120px;"></div>
						   
						   <div class="col-md-6 test">
		                    <ul class="nav nav-icons" role="tablist">
                                <li class="active">
                                    <a href="#description-logo" role="tab" data-toggle="tab">
                                        <i class="fa fa-user" aria-hidden="true"></i><br>
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="#map-logo" role="tab" data-toggle="tab">
                                        <i class="fa fa-map-marker"></i><br>
                                        Location
                                    </a>
                                  </li>
                                <li class="">
                                    <a href="#legal-logo" role="tab" data-toggle="tab">
                                        <i class="fa fa-phone-square" aria-hidden="true"></i><br>
                                        Contact
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#help-logo" role="tab" data-toggle="tab">
                                        <i class="fa fa-file-text-o" aria-hidden="true"></i><br>
                                      	Student Details
                                    </a>
                                </li>
                            </ul>
						   </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="map-logo">
                    
                        <div class="col-md-6" >
                        <div class="header" style="padding-top:05px;">
                          <h4 class="title">Address</h4>
                           <p class="category"><?php echo $rows->address; ?></p>
                        </div>
                     </div>
                     
						 <div  class="textborder" style="height:70px;"></div>
						 <div class="col-md-6" style="padding-bottom: 15px;text-align: center;padding-left:0px;">
							<ul class="nav nav-icons" role="tablist">
                                <li>
								
                                    <a href="#description-logo" role="tab" data-toggle="tab">
                                    <i class="fa fa-user" aria-hidden="true"></i><br>
                                        Profile
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="#map-logo" role="tab" data-toggle="tab">
                                        <i class="fa fa-map-marker"></i><br>
                                        Location
                                    </a>
                                  </li>
                                <li class="">
                                    <a href="#legal-logo" role="tab" data-toggle="tab">
                                       <i class="fa fa-phone-square" aria-hidden="true"></i><br>
                                        Contact
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#help-logo" role="tab" data-toggle="tab">
                                        <i class="fa fa-file-text-o" aria-hidden="true"></i><br>
                                      	Student Details
                                    </a>
                                </li>
                            </ul>
						   </div>
                    
                  </div>
       
	   
	                    <div class="tab-pane" id="legal-logo">
                        <div class="col-md-3" style="padding-bottom:18px;">
                           <div class="header" style="padding:0px;">
                              <h4 class="title">Primary Email</h4>
                           <p class="category"><?php echo $rows->email; ?></p>
                           <p class="category"><?php echo $rows->email1; ?></p>
                           </div>
						   </div>
						    <div class="col-md-3" style="padding-bottom:18px;">
						    <div class="header" style="padding:0px;">
                             <h4 class="title">Phone Number</h4>
                           <p class="category"><?php echo $rows->mobile; ?></p>
                           <p class="category"><?php echo $rows->home_phone; ?></p>
						   </div>
                        </div>
                        <div  class="textborder" style="height: 70px;"></div>
						 <div class="col-md-6" style="padding-top:5px;text-align: center;padding-left:0px;">
		      <ul class="nav nav-icons" role="tablist">
                                <li>
								
                                    <a href="#description-logo" role="tab" data-toggle="tab">
                                        <i class="fa fa-user" aria-hidden="true"></i><br>
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="#map-logo" role="tab" data-toggle="tab">
                                         <i class="fa fa-map-marker"></i><br>
                                        Location
                                    </a>
                                  </li>
                                <li class="active">
                                    <a href="#legal-logo" role="tab" data-toggle="tab">
                                       <i class="fa fa-phone-square" aria-hidden="true"></i><br>
                                        Contact
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#help-logo" role="tab" data-toggle="tab">
                                        <i class="fa fa-file-text-o" aria-hidden="true"></i><br>
                                      	Student Details
                                    </a>
                                </li>
                            </ul>
						   </div>
                  </div>

                  <div class="tab-pane" id="help-logo">
                        <div class="col-md-6">
                           <div class="header" style="padding: 10px;">
                             <?php if(empty($stud_details)){
                           }else{
                           	//print_r($stud_details);
                           	//echo count($stud_details);
                           	foreach ($stud_details as $rows) {  ?>                           
                           <p class="category"><a class="stud_name"> <?php echo $rows->name; ?></a><span style="padding-left:40px;"><?php echo $rows->class_name; ?><?php echo $rows->sec_name; ?></span></p>
                        <?php } } ?>
                           </div>
						   </div>
						    
                        <div  class="textborder" style="height:63px;"></div>
						 <div class="col-md-6" style="padding-top:5px;text-align: center;padding-left:0px;">
		      <ul class="nav nav-icons" role="tablist">
                                <li>
                                    <a href="#description-logo" role="tab" data-toggle="tab">
                                       <i class="fa fa-user" aria-hidden="true"></i><br>
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="#map-logo" role="tab" data-toggle="tab">
                                         <i class="fa fa-map-marker"></i><br>
                                        Location
                                    </a>
                                  </li>
                                <li class="">
                                    <a href="#legal-logo" role="tab" data-toggle="tab">
                                         <i class="fa fa-phone-square" aria-hidden="true"></i><br>
                                        Contact
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="#help-logo" role="tab" data-toggle="tab">
                                         <i class="fa fa-file-text-o" aria-hidden="true"></i><br>
                                      	Student Details
                                    </a>
                                </li>
                            </ul>
						   </div>
                    
                  </div>
               </div>
               <!-- end tab content -->
            </div>
      </div>
   </div>
  
   
         <div class="col-md-12">
		 <div class="col-md-6">
            <div class="card">
               <div id="fullCalendar"></div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="card ">
               <div class="header" style="background-color:#1e202c;padding:10px;">
                     <h4 class="title" style="color: white;">Circular 
					 <a href="<?php echo base_url();?>adminparent/view_circular" >
						<img class="img-responsive plusicon" src="<?php echo base_url(); ?>assets/img/icons/plus.png"/></a></h4>
                  </div>
                  <div class="content content-full-width">
                     <div class="panel-group" id="accordion">
                        <?php //echo count($stud_details);
                           if(empty($parents_circular)){
                           	echo "<p> No Circular Found </p>";
                           }else{
                           	foreach($parents_circular as $circular){ ?>
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h4 class="panel-title">
                                 <a data-target="#collapseOneHover<?php echo $circular->id; ?>" href="" data-toggle="collapse-hover">
                                 <?php echo $circular->circular_title;?>
                                 </a>
                              </h4>
                           </div>
                           <div id="collapseOneHover<?php echo $circular->id; ?>" class="panel-collapse collapse">
                              <div class="panel-body">
                                 <?php echo $circular->circular_description;?>
                              </div>
                           </div>
                        </div>
                        <?php }}?>
                     </div>
                     <!-- <a href="<?php echo base_url();?>student/view_all_circular" class="btn btn-social btn-simple btn-twitter">View All</a> -->
                  </div>
            </div>
         </div>
      </div>
	 
      </div>
   </div>
</div>
<script>
   $(document).ready(function() {
   
   $('#dashboard').addClass('collapse in');
   $('#dashboard').addClass('active');
   $('#dashboard').addClass('active');
   
   
   $('#fullCalendar').fullCalendar({
   	header: {
   		left: 'prev,next today',
   		center: 'title',
   		right: 'month,basicWeek,basicDay'
   	},
   	defaultDate: new Date(),
   	editable: false,
   	eventLimit: true, // allow "more" link when too many events
   	// events:"<?php echo base_url() ?>event/getall_act_event",
   	eventSources: [
   {
    url: '<?php echo base_url() ?>event/getall_act_event',
    color: 'yellow',
    textColor: 'black'
   },
   {
    url: '<?php echo base_url() ?>event/get_all_regularleave',
    color: 'blue',
    textColor: 'white'
   },
   {
   url: '<?php echo base_url() ?>teacherevent/view_all_reminder',
   color: 'red',
   textColor: 'white'
   },
   {
   url: '<?php echo base_url() ?>leavemanage/get_all_special_leave',
   color: 'pink',
   textColor: 'white'
   }
   ],
   	eventMouseover: function(calEvent, jsEvent) {
   var tooltip = '<div class="tooltipevent" style="width:auto;height:auto;background-color:#000;color:#fff;position:absolute;z-index:10001;padding:20px;">' + calEvent.description + '</div>';
   var $tooltip = $(tooltip).appendTo('body');
   
   $(this).mouseover(function(e) {
   		$(this).css('z-index', 10000);
   		$tooltip.fadeIn('500');
   		$tooltip.fadeTo('10', 1.9);
   }).mousemove(function(e) {
   		$tooltip.css('top', e.pageY + 10);
   		$tooltip.css('left', e.pageX + 20);
   });
   },
   
   eventMouseout: function(calEvent, jsEvent) {
   $(this).css('z-index', 8);
   $('.tooltipevent').remove();
   },
   
   });
   		});
   
</script>


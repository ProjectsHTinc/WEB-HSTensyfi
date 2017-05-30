
<style>
.fc-scroller{
	overflow-x: hidden;
	overflow-y: hidden;
}
.fc-ltr .fc-basic-view .fc-day-number{text-align: center;}
.fc-today-button,.fc-month-button,.fc-basicWeek-button,.fc-basicDay-button{display:none;}
.fc-month-button{display: none;}
.stud_name{color:black;}
</style>


	<div class="main-panel">

        <div class="content">
            <div class="container-fluid">
							<div class="card">
								<div class="row">

                    <div class="col-md-8 col-md-offset-2">
                        <h4 class="title text-center" style="padding-top:20px;">Personal Information</h4>
                        <br>
												<?php  foreach ($user_details as $rows) {
													# code...
												} ?>
                        <div class="nav-container" style="    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);">
                            <ul class="nav nav-icons" role="tablist">
                                <li class="active">
                                    <a href="#description-logo" role="tab" data-toggle="tab">
                                        <i class="fa fa-info-circle"></i><br>
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
                                        <i class="fa fa-legal"></i><br>
                                        Contact
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#help-logo" role="tab" data-toggle="tab">
                                        <i class="fa fa-life-ring"></i><br>
                                      	Student Details
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane active" id="description-logo">
                                <div class="" style="border:none;box-shadow: none;">
																	<div class="row profile_detail card">
																	<div class="col-md-6" >
																		<?php $pic= $rows->father_pic; if(empty($pic)){

																		} else{  ?>
																			<img src="<?php echo base_url(); ?>assets/parents/profile/<?php echo $rows->user_pic; ?>" class="img-responsive" style="width:150px;padding-top:20px;">

																	<?php 	}?>
																			</div>
																	<div class="col-md-6">
																		<div class="">
																			<?php if(empty($rows->guardn_name)){  ?>
																				<p> Mr. :<?php echo $rows->father_name; ?></p>
																				<p>  Mrs. <span>:<?php echo $rows->mother_name; ?></span></p>
																		<?php	} else{  ?>

																			<p>  Guardian name <span>:<?php echo $rows->guardn_name; ?></span></p>
																		<?php 	}?>


																		</div>
																	</div>
																</div>

                                </div>
                            </div>


                            <div class="tab-pane" id="map-logo">
															<div class="row profile_detail card">
															<div class="col-md-12" >
																<div class="header">
																		<h4 class="title">Address</h4>
																		<p class="category"><?php echo $rows->address; ?></p>
																</div>

																	</div>

														</div>
                            </div>


                            <div class="tab-pane" id="legal-logo">
															<div class="row profile_detail card">
															<div class="col-md-6" >
																<div class="header">
																		<h4 class="title">Primary Email</h4>
																		<p class="category"><?php echo $rows->email; ?></p>
																		<p class="category"><?php echo $rows->email1; ?></p>
																</div>

																	</div>
															<div class="col-md-6">
																<div class="header">
																		<h4 class="title">Phone Number</h4>
																		<p class="category"><?php echo $rows->mobile; ?></p>
																		<p class="category"><?php echo $rows->home_phone; ?></p>

																</div>

															</div>
														</div>
                            </div>

                            <div class="tab-pane" id="help-logo">
															<div class="row profile_detail card">
															<div class="col-md-6" >
																<div class="header">
																		  <h4 class="title">More information here</h4>

																</div>
																<?php if(empty($stud_details)){

																}else{
																	//print_r($stud_details);
																	//echo count($stud_details);
																	foreach ($stud_details as $rows) {  ?>


																<div class="header">
																		<h6 class="title"> </h6>
																	<p class="category"><a class="stud_name"> <?php echo $rows->name; ?></a><span style="padding-left:40px;"><?php echo $rows->class_name; ?><?php echo $rows->sec_name; ?></span></p>
																</div>
																<?php } } ?>
																	</div>


															<div class="col-md-6">
																<div class="header">


																</div>

															</div>
														</div>

                            </div>

                        </div> <!-- end tab content -->

                    </div> <!-- end col-md-8 -->

                </div>
							</div>


							<div class="card">
								<div class="row">
									<div class="col-md-6">
										<div id="fullCalendar"></div>
									</div>
								</div>
							</div>






    </div>



				<script>
				$(document).ready(function() {

					$('#dash').addClass('active');


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

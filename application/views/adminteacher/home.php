
<style>
.fc-scroller{
	overflow-x: hidden;
	overflow-y: hidden;
}
.fc-ltr .fc-basic-view .fc-day-number{text-align: center;}
.fc-today-button,.fc-month-button,.fc-basicWeek-button,.fc-basicDay-button{display:none;}
.fc-month-button{display: none;}
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
                                      	Details
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane active" id="description-logo">
                                <div class="" style="border:none;box-shadow: none;">
																	<div class="row profile_detail card">
																	<div class="col-md-6" >
																		<?php $pic= $rows->user_pic; if(empty($pic)){

																		} else{  ?>
																			<img src="<?php echo base_url(); ?>assets/teachers/profile/<?php echo $rows->user_pic; ?>" class="img-responsive" style="width:150px;padding-top:20px;">

																	<?php 	}?>
																			</div>
																	<div class="col-md-6">
																		<div class="">
																			<p> Name :<?php echo $rows->name; ?></p>
																			<p> Gender :<?php echo $rows->sex; ?></p>
																			<p>Date Of Birth :<?php echo $rows->dob; ?></p>
																			<p> AGE :<?php echo $rows->age; ?></p>

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
																</div>
																<div class="header">
																		<h4 class="title">Secondary Email</h4>
																		<p class="category"><?php echo $rows->sec_email; ?></p>
																</div>
																	</div>
															<div class="col-md-6">
																<div class="header">
																		<h4 class="title">Phone Number</h4>
																		<p class="category"><?php echo $rows->phone; ?></p>
																</div>
																<div class="header">
																		<h4 class="title">Secondary Phone</h4>
																		<p class="category"><?php echo $rows->sec_phone; ?></p>
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
																<div class="header">
																		<h6 class="title">Class Teacher </h6>
																	<p class="category"><a> <?php echo $rows->class_name; ?>-<?php echo $rows->sec_name; ?></a></p>
																</div>
																	</div>
															<div class="col-md-6">
																<div class="header">
																		<h4 class="title">Subject Handle</h4>
																		<p class="category"><?php echo $rows->subject_name; ?></p>
																</div>

															</div>
														</div>

                            </div>

                        </div> <!-- end tab content -->

                    </div> <!-- end col-md-8 -->

                </div>
							</div>
							<div class="col-md-12">
								<div class="col-md-6">
									<div class="card ">
							                            <div class="header">
							                                <h4 class="title">UpComing Events</h4>

							                            </div>
							                            <div class="content">
							                                <div class="table-full-width">
							                                    <table class="table">
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
								<div class="col-md-6">
									<div class="card">
									<div id="fullCalendar"></div>
								</div>
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
	 }
	 ,
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

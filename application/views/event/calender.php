<style>
.fc-month-button{
	display: none;
	}
.fc-basicWeek-button{display: none;} .fc-basicDay-button{display: none;}
	</style>

	<div class="main-panel">

        <div class="content">
            <div class="container-fluid">
							<div class="content">
								<div class="header">
										<legend>Event Calender </legend>

								</div>
								<div class="container-fluid">
									<div class="row">
									<div class="col-md-8">
										<center>
											<div class="card card-calendar">
													<div class="content">

															<div id="fullCalendar"></div>

													</div>
											</div>
										</center>
									</div>
							</div>
					</div>
			</div>
		  		  </div>
    		</div>
				</div>
				<script>

	$(document).ready(function() {
$('#eventmenu').addClass('collapse in');
$('#event').addClass('active');
$('#event1').addClass('active');
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

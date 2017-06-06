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
	
</style>
	<div class="main-panel">
        <div class="content">
					<div class="card">
            <div class="container-fluid">
							<p style="font-size: 20px;">Admin Dashboard</p>

<div class="">
	<div class="row">
<div class="col-md-12">
	<div class="col-md-9">
    <div class="card">
                            <form id="" action="#" method="" novalidate="" style="padding-bottom:30px;">
                                <div class="header" >Search</div>

                                <fieldset id="group2" style="padding-left:30px;">
                                    <input type="radio" value="students" id="user_type"  name="user_type" checked="">Students
                                    <!-- <input type="radio" value="parents" id="user_type1"  name="user_type">Parents -->
                                    <input type="radio" value="teachers" id="user_type2"  name="user_type">Teachers
                                </fieldset>




                                <div class="content">
                                    <div class="form-group">
                                      <div class="col-md-10">
                                        <input class="form-control   searchbox" name="text" type="text"   id="search_txt" onkeypress="search_load()" autocomplete="off" aria-required="true" placeholder="Search Students,Teacher">
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
	     <?php
    $dt = new DateTime();
    echo $dt->format('d-M-Y');
?>
    <div class="card">
                            <div class="header">
                              
                            </div>
                            <div class="content table-full-width">
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
                                        <td class="text-center" style="padding-right:0px; ">0</td>
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
		<div class="card ">
		 <div id="fullCalendar"></div>
       </div>
	</div>


	<div class="col-md-4">
		<div class="card ">
														<div class="header">
																<h4 class="title" style="float:left;"> Reminder</h4>
    <span class="pull-right "><a href="<?php echo base_url(); ?>communication/add_communication" class="alinks">Set Reminder</a></span>
														</div>
							<div class="content">
									<div class="table-full-width">
									<table class="table">
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
		<div class="card ">
                            <div class="header" >
                                <h4 class="title" style="float:left;">Task & Events</h4>
                                <span class="pull-right alinks"><a href="<?php echo base_url(); ?>event/create" class="alinks">Create Task</a></span>
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
	


</div>

	</div>
</div>


						</div>

				</div>
			</div>

<script type="text/javascript">

	$(document).ready(function() {
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

		
function search_load(){

var ser= $("#search_txt").val();
var user_type=$('input[name=user_type]:checked').val();

if(!ser){
// alert("enter Text");
$('#result').html('<center style="color:red;">Enter The Text in Search Box</center>');
}else{
  $.ajax({
     url:'<?php echo base_url(); ?>adminlogin/search',
     method:"POST",
     data:{ser:ser,user_type:user_type},
    //  dataType: "JSON",
    //  cache: false,
     success:function(data)
     {
      //alert(data.length);
       $('#result').html(data);
       //alert(data['status']);



     }
    });


}
}


</script>

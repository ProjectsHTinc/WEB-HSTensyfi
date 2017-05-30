<style>
.box{
    padding: 12px 0px 66px 0px;
    border: 2px solid #9a8585;
  }
		.head-count{  text-align: center; border-bottom: 2px solid #9a8585;
    }
		.cnt{font-size: 20px;}
    input[type='radio']:after {
            height: 25px;
            width: 25px;
            border-radius: 15px;
            top: -2px;
            left: -1px;
            position: relative;
            background-color: #d1d3d1;
            content: '';
            display: inline-block;
            visibility: visible;
            border: 2px solid white;
        }

        input[type='radio']:checked:after {
            height: 25px;
	          width: 25px;
            border-radius: 15px;
            top: -2px;
            left: -1px;
            position: relative;
            background-color: #ffa500;
            content: '';
            display: inline-block;
            visibility: visible;
            border: 2px solid white;
        }
        input[type=radio] {
    margin: 7px 14px 0;}

</style>
	<div class="main-panel">
        <div class="content">
					<div class="card">
            <div class="container-fluid">
							<h2>Admin Dashboard</h2>



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
    <div class="card">
                            <div class="header">
                              No .Of.Users
                            </div>
                            <div class="content table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th>Total</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>Teachers</td>
                                            <td><?php	if(empty($teacher)){
                                        				echo "No data";
                                        			}else{
                                        				foreach ($teacher as $user_to) {}
                                        						echo $user_to->user_count;
                                        			} ?></td>

                                        </tr>
                                        <tr>

                                            <td class="text-center">2</td>
                                            <td>Parents</td>
                                            <td><?php  if(empty($parents)){
                                      				echo "No data";
                                      			}else{
                                      				foreach ($parents as $user_parents) {}
                                      						echo $user_parents->user_count;
                                      			} ?></td>

                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td>Students</td>
                                            <td><?php 	if(empty($res)){
                                        				echo "No data";
                                        			}else{
                                        				foreach ($res as $user_to) {}
                                        						echo $user_to->user_count;
                                        			}  ?></td>

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
	<div class="col-md-4">
		<div class="card ">
														<div class="header">
																<h4 class="title">Recent Users</h4>

														</div>
														<div class="content">
																<div class="table-full-width">
																		<table class="table">
																				<tbody>
																					<?php  if(empty($das_users)){

																					} else {
																						 $i=1;
																						foreach ($das_users as $rows) { ?>
																							<tr>
																									<td>
																											<label class="checkbox">
																												<?php echo $i; ?>
																												</label>
																									</td>
																									<td><?php echo $rows->user_name;  ?> ->&nbsp; <?php if($rows->user_type=="2"){
                                                    echo "Teacher";
                                                  }else if($rows->user_type=="3"){
                                                      echo "Student";
                                                  }else if($rows->user_type=="4"){
                                                      echo "Parent";
                                                  }
                                                ?> ->&nbsp; <?php echo $rows->name; ?></td>

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
														<div class="header">
																<h4 class="title">Recent Circular</h4>

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

</div>

	</div>
</div>


						</div>

				</div>
			</div>

<script type="text/javascript">

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

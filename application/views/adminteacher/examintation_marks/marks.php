<div class="main-panel">

 <div class="content">
            <div class="container-fluid">
			<?php if($this->session->flashdata('msg')): ?>
         <div class="alert alert-success">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
       ×</button> <?php echo $this->session->flashdata('msg'); ?>
         </div>
       <?php endif; ?>
	   <?php if(empty($edate)){ echo "<p style=color:red;>Exam Couldn't Complete</p>";}else{ ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Enter Exam Marks
								 <?php  
								 foreach($result as $flag){} $ename=$flag->exam_name;
								echo '('; echo $ename; echo ')';
								 $cls_masid=$this->input->get('var1');
								 $exam_id=$this->input->get('var2');
                                 $sub_id=$this->input->get('var3');
								 //echo $cls_masid;echo $exam_id;echo $sub_id;
								
								 //print_r($cla_tea_id);
								    $cid=$cla_tea_id[0]->class_teacher;
									//echo $cid; //exit;
									//echo $cls_masid;
									if($cid==$cls_masid)
									{?>
    <a href="<?php echo base_url(); ?>examinationresult/exam_mark_details_cls_teacher?var1=<?php echo $cid; ?>&var2=<?php  echo $exam_id; ?>"  class="btn btn-info btn-fill btn-wd">View Class Mark</a>	
									<?php }
									//foreach($res as $row){}echo $row->class_id;
									?>

					<button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button> </h4>
                                <p class="category"></p>
                            </div>
                            <div class="content table-responsive table-full-width">
					<form method="post" action="<?php echo base_url(); ?>examinationresult/marks_details" class="form-horizontal" enctype="multipart/form-data" id="markform">
                                <table class="table table-hover table-striped">
								<?php  echo '<input type="hidden" name="examid1" value="'.$exam_id.'"; />';
                                      if(!empty($res))
									  {?>
                                    <thead>
									 <th>Sno</th>
                                     <th>Name</th>
									 <?php
                                      if(empty($res))
									  {?>
										  <p style="padding:15px;">Student Not Found </p>
									 <?php  }else{
										foreach($res as $row)
										      { 
											 foreach($result as $flag){ } $eflag=$flag->exam_flag; $id=$flag->exam_id;} 
											if($eflag==1){ 
											?>
											<input type="hidden" name="examid" value="<?php echo $id;?>" />
								<th> Internal <?php echo $row->subject_name; ?> Marks
								<input type="hidden" name="subjectid" value="<?php echo $row->subject_id; ?>" /></th>
				
								<th> External <?php echo $row->subject_name; ?> Marks<input type="hidden" name="subjectid" value="<?php echo $row->subject_id; ?>" /></th>
								<?php if(!empty($mark)){?>
								<th> Total <?php echo $row->subject_name; ?> Marks<input type="hidden" name="subjectid" value="<?php echo $row->subject_id; ?>" /></th>
								
								<?php }}else{?>
										<input type="hidden" name="examid" value="<?php echo $id;?>" />	
								 <th> Total <?php echo $row->subject_name; ?> Marks<input type="hidden" name="subjectid" value="<?php echo $row->subject_id; ?>" /></th>
								 <th></th><th></th>
											<?php }?>
								
									<?php
									  }?>
                                    </thead>
                                    <tbody>
										<?php
										$i=1;
										if(!empty($mark)){
										foreach($mark as $rows){?>
										<tr>
										<?php foreach($result as $flag){} $eflag=$flag->exam_flag;
										if($eflag==1)
										{ ?>
											<td style="width:05%;"><?php echo $i;?></td>
											<td style="width:15%;">
											<?php  $stdid=$rows->name;
												   echo $stdid;
											?>
											</td>
											<?php   $im=$rows->internal_mark;
													$em=$rows->external_mark;
													$tm=$rows->total_marks;										
											if(is_numeric($im)){ ?>
											<td style="width: 20%;"><?php echo $rows->internal_mark; ?> ( <?php echo $rows->internal_grade; ?> )</td>
											<?php }else{?> <td style="width: 20%;"><?php echo $rows->internal_mark; ?></td> <?php } 
											if(is_numeric($em)){  ?>
											<td style="width: 20%;"><?php echo $rows->external_mark; ?> ( <?php echo $rows->external_grade; ?> )</td>
											<?php }else{?> <td style="width: 20%;"><?php echo $rows->external_mark; ?></td> <?php }  if(is_numeric($tm)){ ?>
											<td style="width: 20%;"><?php echo $rows->total_marks; ?> ( <?php echo $rows->total_grade; ?> )</td>
											<?php }else{ ?> 
											<td style="width: 20%;"><?php echo $rows->total_marks; ?></td> <?php } 
										}else{ 
										     $tm=$rows->total_marks;	?>
										<td style="width:15%;"><?php echo $i;?></td>
										<td style="width:25%;">
										<?php  $stdid=$rows->name;
											   echo $stdid; ?>
										</td>
										<?php  if(is_numeric($tm)){ ?>
										<td style="width:30%;"><?php echo $rows->total_marks; ?> ( <?php echo $rows->total_grade; ?> )</td>
									    <?php }else{ ?><td style="width:30%;"><?php echo $rows->total_marks; ?> </td><?php } ?>
										<td></td><td></td>
										<?php }?>
										</tr>
										<?php $i++;}
										}else{  
										foreach($res as $row)
                                         {  $gen=$row->sex?>
										<tr>
										
										<td><?php echo $i;?></td>
										<td style="">
										<?php  echo $row->name; ?>
										<input type="hidden" name="sutid[]" value="<?php echo $row->enroll_id; ?>" />
										<input type="hidden" name="teaid" value="<?php echo $row->teacher_id; ?>" />
                                        <input type="hidden" name="clsmastid" value="<?php echo $row->class_id; ?>" />
										</td>
										<?php foreach($result as $flag){} $eflag=$flag->exam_flag;
										if($eflag==1){?>
										<input type="hidden" name="eflag" value="<?php echo $eflag;?>" class="form-control"/>
										<td style="width: 30%;">
										<input style="width:60%;" type="text" maxlength="2" name="internal_marks[]"  class="form-control inputBox"/>
										</td>
										<td style="width: 30%;">
										<input style="width:60%;" type="text" maxlength="2" required name="external_marks[]"  class="form-control inputBox1"/>
										
										</td><td></td>
										<?php }else{?>
										<td style="width: 30%;">
										<input style="width:60%;" type="text" maxlength="3" required name="total_marks[]"  class="form-control inputBox2"/>
                                     <input type="hidden" name="eflag" value="<?php echo $eflag;?>" class="form-control"/>
										</td>
										<td></td><td></td>
											  <?php }?>
										</tr>
										<?php $i++;}
										}
										if(empty($mark) && !empty($res) ){ ?>
										<tr>
										<td></td><td></td>
										<td>
										 <div class="col-sm-10">
                                             <button type="submit" class="btn btn-info btn-fill center">Save</button>
                                          </div>
										 </td><td></td><td></td>
										<?php }else{ echo ""; }?>
										
										</tr>

                                    </tbody>
									  <?php }else{ echo "<p style=text-align:center;color:red;>Student Not Found </p>"; } ?>
                                </table>

								</form>

                            </div>
                        </div>
                    </div>
                </div>
	   <?php } ?>

            </div>
        </div>
	</div>
  <script>
  $('#examinationmenu').addClass('collapse in');
  $('#exam').addClass('active');
  $('#exam4').addClass('active');
  
  	var $table = $('#bootstrap-table');
         $().ready(function(){
           jQuery('#markform').addClass('collapse in');
             $table.bootstrapTable({
                 toolbar: ".toolbar",
                 clickToSelect: true,
                 showRefresh: true,
                 search: true,
                 showToggle: true,
                 showColumns: true,
                 pagination: true,
                 searchAlign: 'left',
                 pageSize:10,
                 clickToSelect: false,
                 pageList: [10,25,50,100],
   
                 formatShowingRows: function(pageFrom, pageTo, totalRows){
                     //do nothing here, we don't want to show the text "showing x of y from..."
                 },
                 formatRecordsPerPage: function(pageNumber){
                     return pageNumber + " rows visible";
                 },
                 icons: {
                     refresh: 'fa fa-refresh',
                     toggle: 'fa fa-th-list',
                     columns: 'fa fa-columns',
                     detailOpen: 'fa fa-plus-circle',
                     detailClose: 'fa fa-minus-circle'
                 }
             });
             //activate the tooltips after the data table is initialized
             $('[rel="tooltip"]').tooltip();
   
             $(window).resize(function () {
                 $table.bootstrapTable('resetView');
             });
   
   
         
  
  $(".inputBox").on("keyup keydown", function(e){
    var currentValue = String.fromCharCode(e.which);
    var finalValue = $(this).val() + currentValue;
    if(finalValue >40){
        e.preventDefault();
    }
});

$(".inputBox1").on("keyup keydown", function(e){
    var currentValue = String.fromCharCode(e.which);
    var finalValue = $(this).val() + currentValue;
    if(finalValue >60){
        e.preventDefault();
    }
});

$(".inputBox2").on("keyup keydown", function(e){
    var currentValue = String.fromCharCode(e.which);
    var finalValue = $(this).val() + currentValue;
    if(finalValue >100){
        e.preventDefault();
    }
});
});
  </script>

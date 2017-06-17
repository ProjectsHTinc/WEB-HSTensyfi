

<style>
   .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{height: 20px;width: 22px;padding: 5px 5px 5px 5px;}
   .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active{border: none !important;}
   .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{border-radius: initial !important;}
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="header">
                     <h4 class="title">Examination Calender</h4>
                  </div>
                  <div class="content">
                     <form method="post" action="<?php echo base_url(); ?>examination/add_exam_details" class="form-horizontal" enctype="multipart/form-data" id="examform">
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Exam</label>
                              <div class="col-sm-4">
                                 <input type="hidden" name="admit_date" class="form-control datepicker" placeholder="Enrollment Date"/>
                                 <select name="exam_year" required id="exam_year" onchange="checksubject(this.value)" class="selectpicker" data-title="Select Exam Year" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                    <?php foreach ($year as $sect)
                                       {
                                       $fyear=$sect->from_month;
                                       		$month= strtotime($fyear);
                                       $eyear=$sect->to_month;
                                       $month1= strtotime($eyear);
                                        ?>
                                    <?php  //echo $sect->exam_id; ?>
                                    <option value="<?php  echo $sect->exam_id; ?>">
                                       <?php  echo  date('Y',$month); ?> (To)
                                       <?php  echo  date('Y',$month1); ?> (
                                       <?php  echo $sect->exam_name; ?>)
                                    </option>
                                    <?php } ?>
                                 </select>
                              </div>
                              <label class="col-sm-2 control-label">Class</label>
                              <div class="col-sm-4">
                                 <select name="class_name" required id="class_name" class="selectpicker" data-title="Select class" onchange="checksubject(this.value)" >
                                    <?php foreach ($getall_class as $rows) {  ?>
                                    <option value="<?php echo $rows->class_sec_id; ?>">
                                       <?php echo $rows->class_name; ?>&nbsp; - &nbsp;
                                       <?php echo $rows->sec_name; ?>
                                    </option>
                                    <?php      } ?>
                                 </select>
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <p id="msg" style="text-align:center;"></p>
                              <p id="msg1" style="text-align:center;"></p>
                              <label class="col-sm-2 control-label"></label>
                              <div class="col-sm-2">
                                 <div id="ajaxres"></div>
                              </div>
                              <div class="col-sm-2">
                                 <div id="ajaxres1"></div>
                              </div>
                              <label class="col-sm-2 control-label"></label>
                              <div class="col-sm-2">
                                 <div id="ajaxres3"></div>
                              </div>
                              <div class="col-sm-2">
                                 <div id="ajaxres2"></div>
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">&nbsp;</label>
                              <div class="col-sm-4">
                                 <button type="submit" id="save" class="btn btn-info btn-fill center">Save </button>
                              </div>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php if($this->session->flashdata('msg')): ?>
      <div class="alert alert-success">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
         ×</button>
         <?php echo $this->session->flashdata('msg'); ?>
      </div>
      <?php endif; ?>
      <div class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <div class="card">
                     <div class="content">
                        <div class="fresh-datatables">
                           <form method="post" action="<?php echo base_url(); ?>examination/add_exam_detail" class="form-horizontal" enctype="multipart/form-data" name="myformsection">
                              <div class="col-sm-2">
                                 <select name="class_id" style="margin-top:30px;" class="selectpicker">
                                    <option>Select</option>
                                    <?php  foreach ($result1 as $rows)
                                       { ?>
                                    <option value="<?php echo $rows->classmaster_id; ?>"><?php echo $rows->class_name;?>
                                       <?php echo $rows->sec_name; ?>
                                    </option>
                                    <?php } ?>
                                 </select>
                              </div>
                              <div class="col-sm-4">
                                 <button type="submit" id="save" class="btn btn-info btn-fill center">Search</button>
                              </div>
                           </form>
                           <table id="bootstrap-table" class="table">
                              <thead>
                                 <th data-field="id">ID</th>
                                 <th data-field="name" data-sortable="true"> Subject</th>
                                 <th data-field="email" data-sortable="true">Exam Date</th>
                                 <th data-field="mobile"  data-sortable="true">Class/Section</th>
                                 <th data-field="Section"  data-sortable="true">Teacher</th>
                                 <th class="text-center">Action</th>
                              </thead>
                              <tbody>
                                 <?php
                                    $i=1;
                                    if(!empty($filter)){
                                    foreach($filter as $sea)
                                    {
                                    ?>
                                 <tr>
                                    <td>
                                       <?php echo $i; ?>
                                    </td>
                                    <?php
                                       $sub=$sea->subject_id;
                                       $subname="SELECT * FROM edu_subject WHERE subject_id='$sub' ";
                                       $resub=$this->db->query($subname);
                                       $ressub=$resub->result();
                                        foreach($ressub as $row1)
                                        {
                                       	 $subname=$row1->subject_name;
                                        }
                                       ?>
                                    <td>
                                       <?php echo $subname; ?>
                                    </td>
                                    <td>
                                       <?php $date=date_create($sea->exam_date);
                                          echo date_format($date,"d-m-Y");  ?> (<?php echo $sea->times; ?> ) 
                                    </td>
                                    <?php
                                       $cid=$sea->classmaster_id;
                                                                             $cls="SELECT cm.class,cm.section,cm.class_sec_id,c.*,s.* FROM edu_classmaster as cm,edu_class AS c,edu_sections as s WHERE cm.class_sec_id='$cid' AND cm.section=s.sec_id  AND cm.class=c.class_id";
                                                                             $cls=$this->db->query($cls);
                                       $clsres=$cls->result();
                                       foreach($clsres as $row2)
                                       {
                                       $clsname=$row2->class_name;
                                       $secname=$row2->sec_name;
                                       }
                                       ?>
                                    <td>
                                       <?php echo $clsname;?>
                                       <?php echo $secname; ?>
                                    </td>
                                    <?php
                                       $id=$sea->teacher_id;
                                       $query = "SELECT * FROM edu_teachers WHERE teacher_id='$id' ";
                                       $resultset = $this->db->query($query);
                                       $res=$resultset->result();
                                       foreach($res as $row)
                                       {
                                        $name=$row->name;
                                       }
                                       ?>
                                    <td>
                                       <?php echo $name; ?>
                                    </td>
                                    <td>
                                       <a href="<?php echo base_url(); ?>examination/edit_exam_details/<?php echo $sea->exam_detail_id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                                    </td>
                                 </tr>
                                 <?php $i++;  } }else{
                                    foreach ($result as $rows)
                                    { $exid=$rows->exam_id;
                                                     ?>
                                 <tr>
                                    <td>
                                       <?php echo $i; ?>
                                    </td>
                                    <td>
                                       <?php echo $rows->subject_name; ?>
                                    </td>
                                    <td>
                                       <?php $date=date_create($rows->exam_date);
                                          echo date_format($date,"d-m-Y");  ?> (<?php echo $rows->times; ?> ) 
                                    </td>
                                    <td>
                                       <?php echo $rows->class_name;?>
                                       <?php echo $rows->sec_name; ?> (<?php
                                          $sql="SELECT exam_id,exam_year,exam_name FROM edu_examination WHERE exam_id='$exid' ";
                                          $result=$this->db->query($sql);
                                          $res1=$result->result();
                                          echo $res1[0]->exam_name;
                                          
                                          ?>)
                                    </td>
                                    <?php
                                       $id=$rows->teacher_id;
                                       $query = "SELECT teacher_id,name FROM edu_teachers WHERE teacher_id='$id' ";
                                       $resultset = $this->db->query($query);
                                       $res=$resultset->result();
                                       $name=$res[0]->name;
                                       /*  foreach($res as $row)
                                       {
                                        $name=$row->name;
                                       } */
                                       ?>
                                    <td>
                                       <?php echo $name; ?>
                                    </td>
                                    <td>
                                       <a href="<?php echo base_url(); ?>examination/edit_exam_details/<?php echo $rows->exam_detail_id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                                    </td>
                                 </tr>
                                 <?php $i++;  } } ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <!-- end content-->
                  </div>
                  <!--  end card  -->
               </div>
               <!-- end col-md-12 -->
            </div>
            <!-- end row -->
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   function checksubject(exam_year,class_name)
      { //alert(val);exit;
      var exam_year = document.getElementById('exam_year');
      var class_name = document.getElementById('class_name');
   
      var eid = exam_year.value; 
      var cid = class_name.value;
      //alert(eid);alert(cid);
      if(eid!='' && cid!=''){
   	   //alert(eid);alert(cid);exit;'code=' + code + '&userid=' + userid
         $.ajax({
   			type:'post',
   			url:'<?php echo base_url(); ?>examination/subcheck',
   			data:'clsmasid=' + eid + '&examid=' + cid,
   			success:function(test)
   			{
   				//alert(test);
   				if(test=="Already Exam Added")
   				{
   			        $("#msg1").html(test); 
   					$('#msg').html('');
   					$("#ajaxres").html('');
                       $("#ajaxres1").html('');
                       $("#ajaxres2").html('');
                       $("#ajaxres3").html('');
   					$("#save").hide();
   				}
   				else{
   					$("#msg1").html('');
   					$("#save").show();
   					//alert(cid);
   					checknamefun(cid);
   				}
   			}
   	  });
      }
   }
   
       function checknamefun(cid) {
           //alert(classid);exit;
           $.ajax({
               type: 'post',
               url: '<?php echo base_url(); ?>examination/checker',
               data: {
                   classid:cid
               },
              dataType: 'json',
   
               success: function(test1) {
   				//alert(test1.subject_name);
   				//console.log(test1);
   				//var test=test1.status;
   				//alert(test);
                   if (test1.status=='Success') {
                       var sub = test1.subject_name;
   					//alert(sub.length);
                       var sub_id = test1.subject_id;
                       var len=sub.length;
   					//alert(len);
                       var i;
                       var name = '';
                       var exam_date = '';
                       var exam_secction = '';
                       var teacher = '';
                       for (i = 0; i < len; i++) {
   						'<form name="exam" id="examvalidate">';
                           name += '<input name="subject_name" type="text" required class="form-control"  value="' + sub[i] + '"><input name="subject_id[]" required type="hidden" class="form-control"  value="' + sub_id[i] + '"></br>';
   
                           exam_date += '<input type="text"  required name="exam_dates[]"  class="form-control datepicker"   placeholder="Enter The Exam Date"/></br>';
   
                           exam_secction += '<select name="time[]" required class="form-control" data-title="Select Time" data-style="btn-default btn-block" data-menu-style="dropdown-blue"><option value="">Select Time</option><option value="AM">AM</option><option value="PM">PM</option></select></br>';
   
                           teacher += '<select name="teacher_id[]" required id="teacher_id" class="form-control" ><option value="">Select Invigilator</option><?php foreach ($teacheres as $rows) {  ?><option value="<?php echo $rows->teacher_id; ?>"><?php echo $rows->name; ?></option><?php  } ?></select></br>';
   						
   						'</form>';
   
                           $("#ajaxres").html(name);
                           $("#ajaxres1").html(exam_date).find('.datepicker').datepicker({ dateFormat: 'yy-mm-dd' });
                           $("#ajaxres2").html(exam_secction);
                           $("#ajaxres3").html(teacher);
                           $('#msg').html('');
                       }
                   } else {
   					$('#msg').html('<span style="color:red;text-align:center;">Subject Not Found</p>');
   					    $("#ajaxres").html('');
                           $("#ajaxres1").html('');
                           $("#ajaxres2").html('');
                           $("#ajaxres3").html('');
   					   //$('#examform')[0].reset();
                          //alert("Subject Not Found");
                   }
               }
           });
       }
   
</script>
<script type="text/javascript">
   function myFunction(){
     $( "#datepicker" ).datepicker();
   }
   $(document).ready(function() {
   
          $('#examvalidate').validate({ // initialize the plugin
              rules: {
                  exam_year: {required: true},
                  class_name: {required: true},
                  subject_name: {required: true},
                  exam_date: {required: true},
                  time: {required: true},
   			teacher_id: {required: true}
              },
              messages: {
                  exam_year: "Please Select Exam Year",
   			class_name: "Please Select Class and Section Name",
   			subject_name: "Please Select Subject Name",
   			exam_date: "Please Enter Exam Date",
   			time: "Please Select Time",
   			teacher_id: "Please Select Teacher Name"
              }
          });
      });
   
   
   
      var $table = $('#bootstrap-table');
      $().ready(function() {
          $table.bootstrapTable({
              toolbar: ".toolbar",
              clickToSelect: true,
              showRefresh: true,
              search: true,
              showToggle: true,
              showColumns: true,
              pagination: true,
              searchAlign: 'left',
              pageSize: 8,
              clickToSelect: false,
              pageList: [8, 10, 25, 50, 100],
   
              formatShowingRows: function(pageFrom, pageTo, totalRows) {
                  //do nothing here, we don't want to show the text "showing x of y from..."
              },
              formatRecordsPerPage: function(pageNumber) {
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
   
          $(window).resize(function() {
              $table.bootstrapTable('resetView');
          });
   
      });
</script>
<script type="text/javascript">
   $().ready(function() {
       $('#exammenu').addClass('collapse in');
       $('#exam').addClass('active');
       $('#exam2').addClass('active');
   //$("#datepicker").attr('data-uk-datepicker','{format:"DD.MM.YYYY"}');
      $('.datepicker').datetimepicker({
         format: 'DD-MM-YYYY',
         icons: {
             time: "fa fa-clock-o",
             date: "fa fa-calendar",
             up: "fa fa-chevron-up",
             down: "fa fa-chevron-down",
             previous: 'fa fa-chevron-left',
             next: 'fa fa-chevron-right',
             today: 'fa fa-screenshot',
             clear: 'fa fa-trash',
             close: 'fa fa-remove'
         }
      });
   });
   
</script>
<script type="text/javascript"></script>


<style>
   .formdesign
   {
   padding-bottom: 48px;
   padding-top: 10px;
   border-radius: 12px;
   }
</style>
<div class="main-panel">
   <div class="content">
      <?php if($this->session->flashdata('msg')): ?>
      <div class="alert alert-success">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
         ×</button> <?php echo $this->session->flashdata('msg'); ?>
      </div>
      <?php endif; ?>
      <div class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <div class="card">
                     <div class="content">
                        <div class="fresh-datatables">
                           <h4 class="title" style="padding-bottom:10px;">List of Admission
                              <button style="float:right;" class="btn btn-info btn-fill center download">Export Excel</button>
                              <button style="float:right;margin-right: 10px;" class="btn btn-info btn-fill center" onclick="generatefromtable()">Export PDF</button>
                           </h4>
                           <form method="post" action="<?php echo base_url(); ?>admission/view" class="form-horizontal formdesign" enctype="multipart/form-data" name="myformsection">
                              <div class="col-sm-2">
                                 <select name="gender" style="margin-top:30px;"  class="selectpicker">
								  <option value="">Select</option>
								  <option value="Male">Male</option>
            						 <option value="Female">Female</option>
                                    <!-- <?php  foreach ($sorting as $rows)
                                       { ?>
                                    <option value="<?php echo $rows->sex; ?>"><?php echo $rows->sex;?>
                                    </option>
                                    <?php } ?>-->
                                 </select>
								 <?php  if(!empty($gender)){ foreach ($gender as $rows){} }?>
							<script language="JavaScript">document.myformsection.gender.value="<?php echo $rows->sex; ?>";</script>
                              </div>
                              <div class="col-sm-10">
                                 <button type="submit" id="save" class="btn btn-info btn-fill center">Search</button>
                              </div>
                           </form>
                           <table id="bootstrap-table" class="table">
                              <thead>
                                 <th data-field="id" class="text-left">ID</th>
                                 <th data-field="name" class="text-left" data-sortable="true">Name</th>
                                 <th data-field="Parentsname" class="text-left" data-sortable="true">Parents Name</th>
                                 <th data-field="email" class="text-left" data-sortable="true">Email</th>
                                 <th data-field="mobile" class="text-left" data-sortable="true">Mobile</th>
                                 <th data-field="gender" class="text-left" data-sortable="true">Gender</th>
                                 <th data-field="status" class="text-left" data-sortable="true">Status</th>
                                 <th data-field="Section" class="text-left" data-sortable="true">Action</th>
                              </thead>
                              <tbody>
                                 <?php
                                    $i=1;
                                    if(!empty($gender))
                                    {
                                    foreach ($gender as $rows)
                                    {$stu=$rows->status; $pname=$rows->parentsname;?>
                                 <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $rows->name; ?></td>
                                    <td><?php echo $pname; ?></td>
                                    <td><?php echo $rows->email; ?></td>
                                    <td><?php echo $rows->mobile; ?></td>
                                    <td><?php echo $rows->sex; ?></td>
                                    <td><?php
                                       if($stu=='Active'){?>
                                       <button class="btn btn-success btn-fill btn-wd">Active</button>
                                       <?php  }else{?>
                                       <button class="btn btn-danger btn-fill btn-wd">DeActive</button><?php }
                                          ?>
                                    </td>
                                    <td>
                                       <?php
                                          $enrollment_status=$rows->enrollment;
                                          if($enrollment_status==0)
                                          {
                                          ?>
                                       <a href="<?php echo base_url(); ?>enrollment/add_enrollment/<?php echo $rows->admission_id; ?>" rel="tooltip" title="Add Registration" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">
                                          <i class="fa fa-address-book" aria-hidden="true"></i>
                                          <!--  <i class="fa fa-address-card-o" aria-hidden="true"></i> -->
                                       </a>
                                       <?php
                                          }
                                          else{
                                          	?>
                                       <a href="<?php echo base_url(); ?>enrollment/edit_enroll/<?php echo $rows->admission_id; ?>" rel="tooltip" title="Already Added Registration Details " class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">
                                       <i class="fa fa-address-card-o" aria-hidden="true"></i>
                                       </a>
                                       <?php
                                          }
                                          ?>
                                       <?php
                                          $parent_status=$rows->parents_status;
                                          if($parent_status==0)
                                          {
                                          	?>
                                       <a href="<?php echo base_url(); ?>parents/home/<?php echo $rows->admission_id; ?>" rel="tooltip" title="Add Parent" class="btn btn-simple btn-info btn-icon table-action view" >
                                       <i class="fa fa-user-plus" aria-hidden="true"></i></a>
                                       <?php
                                          }
                                          else
                                          {
                                          	// echo base_url(); parents/edit_parent/ echo $rows->parnt_guardn_id;
                                          ?>
                                       <a href="<?php echo base_url(); ?>parents/edit_parents/<?php echo $rows->admission_id; ?>" rel="tooltip" title="Already Added Parent Details" class="btn btn-simple btn-info btn-icon table-action view" >
                                       <i class="fa fa-id-card-o" aria-hidden="true"></i></a>
                                       <?php
                                          }
                                          ?>
                                       <a href="<?php echo base_url(); ?>admission/get_ad_id/<?php echo $rows->admission_id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                                    </td>
                                 </tr>
                                 <?php  $i++;  }
                                    }else{
                                    	//echo'<pre>';print_r($result);exit;
                                                            foreach ($result as $rows)
                                     { $stu=$rows->status;
                                     $pname=$rows->parentsname;
                                    
                                                            ?>
                                 <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $rows->name; ?></td>
                                    <td><?php echo $pname; ?></td>
                                    <td><?php echo $rows->email; ?></td>
                                    <td><?php echo $rows->mobile; ?></td>
                                    <td><?php echo $rows->sex; ?></td>
                                    <td><?php
                                       if($stu=='Active'){?>
                                       <button class="btn btn-success btn-fill btn-wd">Active</button>
                                       <?php  }else{?>
                                       <button class="btn btn-danger btn-fill btn-wd">DeActive</button><?php }
                                          ?>
                                    </td>
                                    <td>
                                       <?php
                                          $enrollment_status=$rows->enrollment;
                                          if($enrollment_status==0)
                                          {
                                          ?>
                                       <a href="<?php echo base_url(); ?>enrollment/add_enrollment/<?php echo $rows->admission_id; ?>" rel="tooltip" title="Add Registration" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">
                                          <i class="fa fa-address-book" aria-hidden="true"></i>
                                          <!--  <i class="fa fa-address-card-o" aria-hidden="true"></i> -->
                                       </a>
                                       <?php
                                          }
                                          else{
                                          	?>
                                       <a href="<?php echo base_url(); ?>enrollment/edit_enroll/<?php echo $rows->admission_id; ?>" rel="tooltip" title="Already Added Registration Details " class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">
                                       <i class="fa fa-address-card-o" aria-hidden="true"></i>
                                       </a>
                                       <?php
                                          }
                                          ?>
                                       <?php
                                          $parent_status=$rows->parents_status;
                                          if($parent_status==0)
                                          {
                                          	?>
                                       <a href="<?php echo base_url(); ?>parents/home/<?php echo $rows->admission_id; ?>" rel="tooltip" title="Add Parent" class="btn btn-simple btn-info btn-icon table-action view" >
                                       <i class="fa fa-user-plus" aria-hidden="true"></i></a>
                                       <?php
                                          }
                                          else
                                          {
                                          ?>
                                       <a href="<?php echo base_url(); ?>parents/edit_parents/<?php echo $rows->admission_id; ?>" rel="tooltip" title="Already Added Parent Details" class="btn btn-simple btn-info btn-icon table-action view" >
                                       <i class="fa fa-id-card-o" aria-hidden="true"></i></a>
                                       <?php
                                          }
                                          ?>
                                       <a href="<?php echo base_url(); ?>admission/get_ad_id/<?php echo $rows->admission_id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                                    </td>
                                 </tr>
                                 <?php $i++;  }  }?>
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
   $(function() {  
     $(".download").click(function() {  
   $("#bootstrap-table").table2excel({
   				exclude: ".noExl",
   				name: "Excel Document Name",
   				filename: "Student",
   				fileext: ".xls",
   				exclude_img: true,
   				exclude_links: true,
   				exclude_inputs: true
   			});
     });
   
   }); 
   
   function generatefromtable() {
   			var data = [], fontSize = 12, height = 0, doc;
   			doc = new jsPDF('p', 'pt', 'a4', true);
   			doc.setFont("times", "normal");
   			doc.setFontSize(fontSize);
   			doc.text(40, 20, "Student List");
   			data = [];
   			data = doc.tableToJson('bootstrap-table');
   			height = doc.drawTable(data, {
   				xstart : 30,
   				ystart : 10,
   				tablestart : 40,
   				marginleft : 10,
   				xOffset : 10,
   				yOffset : 15
   			});
   			//doc.text(50, height + 20, 'hi world');
   			doc.save("student.pdf");
   		}
   
   
   var $table = $('#bootstrap-table');
         $().ready(function(){
           jQuery('#admissionmenu').addClass('collapse in');
           $('#admission').addClass('active');
           $('#admission2').addClass('active');
             $table.bootstrapTable({
                 toolbar: ".toolbar",
                 clickToSelect: true,
                 showRefresh: true,
                 search: true,
                 showToggle: true,
                 showColumns: true,
                 pagination: true,
                 searchAlign: 'left',
                 pageSize: 10,
                 clickToSelect: false,
                 pageList: [8,10,25,50,100],
   
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
   
   
         });
</script>


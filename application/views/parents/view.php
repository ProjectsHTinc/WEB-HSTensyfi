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
                                  <h4 class="title">List of Parents Details <button class="btn btn-info btn-fill center" onclick="generatefromtable()">Generate PDF</button></h4>

                          <table id="bootstrap-table" class="table">
                              <thead>
                                <th data-field="id" >ID</th>
                                <th data-field="name" data-sortable="true">Father Name / Guardian Name</th>
                                <th data-field="email" data-sortable="true">Email</th>
                                <th data-field="mobile"  data-sortable="true">Mobile</th>
								<th data-field="Status" data-sortable="true">Status</th>
                                <th data-field="Section" data-sortable="true">Action</th>
                              </thead>
                              <tbody>
                                <?php
                                $i=1;
                                foreach ($result as $rows)
								 {
									  $a=$rows->father_name;
									  $b=$rows->guardn_name;
									  $stu=$rows->status;
									 if(empty($a))
									 {
										  $a=$b;
									 }  
                                ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo  $a; ?></td>
                                    <td><?php echo $rows->email; ?></td>
                                    <td><?php echo $rows->mobile; ?></td>
									 <td><?php 
									  if($stu=='Active'){?>
									   <button class="btn btn-success btn-fill btn-wd">Active</button>
									   
									 <?php  }else{?>
									  <button class="btn btn-danger btn-fill btn-wd">DeActive</button><?php }
									 ?></td>

                                    <td>
                                     <!-- <a rel="tooltip" title="Add Enrollment" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">
                                      <i class="fa fa-address-card-o" aria-hidden="true"></i> </a>-->


                                     <!--  <a href="<?php //echo base_url(); ?>parents/home/<?php //echo $rows->admission_id; ?>" rel="tooltip" title="Add Parent" class="btn btn-simple btn-info btn-icon table-action view" >
										<i class="fa fa-user-plus" aria-hidden="true"></i></a> -->

                                      <a href="<?php echo base_url(); ?>parents/edit_parents/<?php echo $rows->parent_id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>

                                 <!--  <a href="#" rel="tooltip" title="Delete" class="btn btn-simple btn-danger btn-icon "><i class="fa fa-times"></i></a>-->

                                    </td>
                                  </tr>
                                  <?php $i++;  }  ?>
                              </tbody>
                          </table>

                        </div>
                            </div><!-- end content-->
                        </div><!--  end card  -->
                    </div> <!-- end col-md-12 -->
                </div> <!-- end row -->
            </div>
        </div>
   </div>
</div>

<script type="text/javascript">
function generatefromtable() {
				var data = [], fontSize = 12, height = 0, doc;
				doc = new jsPDF('p', 'pt', 'a4', true);
				doc.setFont("times", "normal");
				doc.setFontSize(fontSize);
				doc.text(60,20, "Parents List");
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
				doc.save("Parents.pdf");
			}
			
 var $table = $('#bootstrap-table');
       $().ready(function(){
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
       $('#admissionmenu').addClass('collapse in');
       $('#admission').addClass('active');
       $('#admission3').addClass('active');
</script>

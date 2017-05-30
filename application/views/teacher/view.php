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
                                  <h4 class="title">List of Teacher</h4>

                          <table id="bootstrap-table" class="table">
                              <thead>

                                 <th data-field="id" class="text-left">S.No</th>
                                <th data-field="name" class="text-left" data-sortable="true">Name</th>
                                <th data-field="email" class="text-left" data-sortable="true">Email</th>
                                <th data-field="mobile" class="text-left" data-sortable="true">Mobile</th>
                                 <th data-field="class" class="text-left" data-sortable="true">Class Teacher</th>
                                 <th data-field="status" class="text-left" data-sortable="true">Status</th> 
                                <th data-field="Section" class="text-left" data-sortable="true">Action</th>


                              </thead>
                              <tbody>
                                <?php
                                $i=1;
                                foreach ($result as $rows) {
													$stu=$rows->status;
                                ?>
                                  <tr>
                                    <td class="text-left"><?php echo $i; ?></td>
                                    <td class="text-left"><?php echo $rows->name; ?></td>
                                    <td class="text-left"><?php echo $rows->email; ?></td>
                                    <td class="text-left"><?php echo $rows->phone; ?></td>

									 <td class="text-left"><?php echo $rows->class_name;?>-<?php echo $rows->sec_name; ?></td>
									 
									 <td><?php 
									  if($stu=='A'){?>
									   <button class="btn btn-success btn-fill btn-wd">Active</button>
									   
									 <?php  }else{?>
									  <button class="btn btn-danger btn-fill btn-wd">DE-Active</button><?php }
									 ?></td>
									 
                                    
                                    <td class="text-left">

                                      <a href="<?php echo base_url(); ?>teacher/get_teacher_id/<?php echo $rows->teacher_id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>

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
 var $table = $('#bootstrap-table');
  $('#teachermenu').addClass('collapse in');
 $('#teacher').addClass('active');
 $('#teacher2').addClass('active');
       $().ready(function(){
         jQuery('#teachermenu').addClass('collapse in');
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
</script>

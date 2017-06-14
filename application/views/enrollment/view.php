<style>


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
                              <h4 class="title">List of Student Registration</h4>
                                <div class="fresh-datatables">


                          <table id="bootstrap-table" class="table">
                              <thead>

                                  <th data-field="id" >S.No</th>
                                    <!-- <th data-field="year" class="text-center" data-sortable="true">Year</th> -->
                                <th data-field="email"  data-sortable="true">Name</th>
                                <th data-field="no"  data-sortable="true">Admission No</th>
                                <th data-field="mobile"  data-sortable="true">Class-Section</th>
                                <th data-field="name" data-sortable="true">Registration Date</th>
                                <th data-field="status"  data-sortable="true">Status</th>
                                <th data-field="Section" data-sortable="true">Action</th>


                              </thead>
                              <tbody>
                                <?php
                                $i=1;
                                foreach ($result as $rows) {
									$stu=$rows->status;
//$rows->admit_year
                                ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                     <?php  foreach ($year as $row)
                                          {
                                              $fyear=$row->from_month;
                                              $month= strtotime($fyear);
                                              $eyear=$row->to_month;
                                              $month1= strtotime($eyear);
                                          }
                                     ?>

                                    <!-- <td><?php echo date('Y',$month); ?> - <?php echo date('Y',$month1); ?></td> -->
                                      <td><?php echo $rows->name; ?></td>
                                    <td><?php echo $rows->admisn_no; ?></td>



                                     <td><?php echo $rows->class_name; echo "--"; echo $rows->sec_name; ?></td>
                                     <td><?php $date=date_create($rows->admit_date);
                                     echo date_format($date,"d-m-Y"); ?></td>
                                     <!-- <td><?php echo $rows->status; ?></td> -->
									 <td><?php 
									  if($stu=='Active'){?>
									   <button class="btn btn-success btn-fill btn-wd">Active</button>
									   
									 <?php  }else{?>
									  <button class="btn btn-danger btn-fill btn-wd">DeActive</button><?php }
									 ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>admission/get_ad_id1/<?php echo $rows->admisn_no; ?>" rel="tooltip" title="View Admission Details " class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">
                                      <i class="fa fa-address-card-o" aria-hidden="true"></i>
                                       </a> 
                                      <!-- <a rel="tooltip" title="View" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)"><i class="fa fa-image"></i>
                                        </a> -->
                                      <a href="<?php echo base_url(); ?>enrollment/edit_enroll/<?php echo $rows->admisn_no; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                                      <!-- <a href="<?php  echo base_url(); ?>enrollment/de_enroll/<?php  echo $rows->enroll_id; ?>" rel="tooltip" title="Delete" c
 lass="btn btn-simple btn-danger btn-icon "><i class="fa fa-times"></i></a> -->
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
       $().ready(function(){
          jQuery('#enrollmentmenu').addClass('collapse in');
          $('#enroll').addClass('active');
          $('#enroll2').addClass('active');
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

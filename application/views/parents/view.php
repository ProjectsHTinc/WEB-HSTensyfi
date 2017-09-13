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
                                  <h4 class="title">List of Parents Details </h4>

                          <div class="toolbar">
	                            <!-- Here you can write extra buttons/actions for the toolbar-->
	                       </div>
						   
                           <table id="example" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                              <thead>
                                <th data-field="id" >ID</th>
                                <th data-field="name" data-sortable="true">Parents Name</th>
                                <th data-field="email" data-sortable="true">Email</th>
                                <th data-field="mobile"  data-sortable="true">Mobile</th>
								<th data-field="Status" data-sortable="true">Status</th>
                              </thead>
                              <tbody>
                                <?php
                                $i=1;
                                foreach ($result as $rows)
								 {
									 $stu=$rows->status;
									 $stuid=$rows->admission_id;
									 $priority=$rows->primary_flag;
                                ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $rows->name; ?></td>
                                    <td><?php echo $rows->email; ?></td>
                                    <td><?php echo $rows->mobile; ?></td>
									<td><?php 
									  if($stu=='Active'){?>
									   <button class="btn btn-success btn-fill btn-wd">Active</button>
									 <?php  }else{?>
									  <button class="btn btn-danger btn-fill btn-wd">DeActive</button><?php }
									 ?></td>
                                    <!-- <td>
                                      <a href="<?php echo base_url(); ?>parents/edit_parents/<?php echo $rows->admission_id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                                    </td>-->
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
$(document).ready(function() {
   $('#admissionmenu').addClass('collapse in');
       $('#admission').addClass('active');
       $('#admission3').addClass('active');

		$('#example').DataTable({
			dom: 'Bfrtip',
			buttons: ['excel', 'pdf'],
		    "pagingType": "full_numbers",
		    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		    responsive: true,
		    language: {
		    search: "_INPUT_",
		    searchPlaceholder: "Search records",
		    }

		});


		var table = $('#example').DataTable();

		// Edit record
		table.on( 'click', '.edit', function () {
		    $tr = $(this).closest('tr');

		    var data = table.row($tr).data();
		    alert( 'You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.' );
		} );

		// Delete a record
		table.on( 'click', '.remove', function (e) {
		    $tr = $(this).closest('tr');
		    table.row($tr).remove().draw();
		    e.preventDefault();
		} );

		//Like record
		table.on( 'click', '.like', function () {
		    alert('You clicked on Like button');
		});
	});
      
</script>

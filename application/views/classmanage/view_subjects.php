<style>
th{
  text-align: center;
}
td{
  text-align: center;
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
                              <div class="header">
                                  <legend>View Subject For Class  <button class="btn btn-info btn-fill center" onclick="generatefromtable()">Generate PDF</button><button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button></legend>

                              </div>



                                <div class="fresh-datatables">


                          <table id="bootstrap-table" class="table">
                              <thead>

                                  <th data-field="id">S.No</th>
                                  <th data-field="year"  data-sortable="true"> Class</th>
                                  <th data-field="no"  data-sortable="true">Subject </th>

                                  <th data-field="status"  data-sortable="true">Status</th>
                                  <th data-field="Section" data-sortable="true">Action</th>


                              </thead>
                              <tbody>
                                <?php
                                $i=1;
                                foreach ($res as $rows) {

                                ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td class="text-center"><?php echo $rows->class_name;?>-<?php echo $rows->sec_name; ?></td>
                                    <td><?php echo $rows->subject_name; ?></td>


                                      <td>
                                        <?php if($rows->status=='Active'){ ?>
                                          <button class="btn btn-success btn-fill btn-wd">Active</button>
                                      <?php  }else{ ?>
                                        <button class="btn btn-danger btn-fill btn-wd">De-Active</button>
                                      <?php } ?></td>
                                    <td>
                                      <a href="<?php echo base_url(); ?>classmanage/edit_subjects_class/<?php echo $rows->id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
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
				doc.text(60,20, "Parents Role List");
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
				doc.save("Parentsrole.pdf");
			}


 var $table = $('#bootstrap-table');
       $().ready(function(){
         $('#mastersmenu').addClass('collapse in');
         $('#master').addClass('active');
         $('#masters5').addClass('active');
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

<style>
.datewidth{
    width:30%;
}
    </style>
<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <?php if($this->session->flashdata('msg')): ?>
         <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            ×</button> <?php echo $this->session->flashdata('msg'); ?>
         </div>
         <?php endif; ?>
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="content">
				    <h4 class="title">Send SMS</h4>
                     <div class="fresh-datatables">
                        <table id="bootstrap-table" class="table">
                           <thead>
                              <th>S.no</th>
                              <th>Date</th>
                              <!--<th>Home Work / Class Test</th>-->
                              <th>Action</th>
                           </thead>
                           <tbody>
                              <?php
							  
                                 $i=1;
                                 foreach ($tutor_homework as $rows) {
                                 $hw=$rows->hw_type;
                                 $status=$rows->status;
								 $tdate=$rows->test_date;
								 $cid=$rows->class_id;
								 $send_status=$rows->send_option_status;
								 
                                  ?>
                              <tr>
                                 <td><?php  echo $i; ?></td>
								 <td>
							    <?php $date=date_create($rows->test_date);
                                    echo date_format($date,"d-m-Y");?>
									 </td>
                                 <td> 
								 <a rel="tooltip" href="" data-toggle="modal" data-target="#addmodel" data-id="<?php echo $tdate; ?>"  class="open-AddBookDialog"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>
								 <span style="padding-left:20px;"></span>
								 <?php if($send_status=="1")
                                       { ?>
										<i style="color:green; font-weight:bold;padding-right:10px;" class="fa fa-check" aria-hidden="true"></i> ( <?php $date=date_create($rows->updated_at);
                                    echo date_format($date,"d-m-Y");  ?> )
										<?php }else{ echo ""; } ?>
								 </td>
                                 
                              </tr>
                              <?php $i++;  }  ?>
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
         
		  <div class="modal fade" id="addmodel" role="dialog" >
            <div class="modal-dialog">
               <!-- Modal content-->
               <div class="modal-content">
                  <div class="modal-header" style="padding:10px;">
                     <button type="button" class="close" style="margin:25px;" data-dismiss="modal">&times;</button>
                     <h4 class="title">Send Home Work And Class Test</h4>
                  </div>
                  <div class="modal-body">
                     <p id="msg" style="text-align:center;"></p>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="card">
                              <div class="content">
                                 <form method="post" action="<?php echo base_url(); ?>homework/send_sms_all_homework" class="form-horizontal" id="homeworkform">
								 
								  <input type="hidden" id="event_id" name="tdate" >
								 <input type="hidden" name="clsid" id="csid" value="<?php echo $cid; ?>">
								 <fieldset>
                                       <div class="form-group">
                                          <label class="col-sm-4 control-label">Send Option</label>
                                          <div class="col-sm-6">
                                           <select multiple name="sendoption[]" class="selectpicker form-control" >
											   <option value="SMS">SMS</option>
											   <option value="Mail">Mail</option>
											   <option value="Notification">Notification</option>
											   </select>
                                          </div>
                                       </div>
                                    </fieldset>
									<fieldset>
                                       <div class="form-group">
                                          <label class="col-sm-4 control-label">&nbsp;</label>
                                          <div class="col-sm-6">
                                             <button type="submit" class="btn btn-info btn-fill center">Send </button>
                                          </div>
                                       </div>
                                    </fieldset>
									  
									    
									  </form>
                              </div>
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
		 
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function () {
     $('#homeworkmenu').addClass('collapse in');
     $('#home').addClass('active');
     $('#home1').addClass('active');
	 
	 $('#homeworkform').validate({ // initialize the plugin
       rules: {
         'sendoption[]':{required:true },
        },
        messages: {
		  'sendoption[]':"Select Send Option",
               },
			   
	        submitHandler: function(form) {
	        //alert("hi");
			var clssid = document.getElementById("csid").value;
	        swal({
	                      title: "Are you sure?",
	                      text: "You Want Confirm this form",
	                      type: "success",
	                      showCancelButton: true,
	                      confirmButtonColor: '#DD6B55',
	                      confirmButtonText: 'Yes, I am sure!',
	                      cancelButtonText: "No, cancel it!",
	                      closeOnConfirm: false,
	                      closeOnCancel: false
	                  },
	                  function(isConfirm) {
	                      if (isConfirm) {
	       $.ajax({
	           url: "<?php echo base_url(); ?>homework/send_sms_all_homework",
	            type:'POST',
	           data: $('#homeworkform').serialize(),
	           success: function(response) {
				  //alert(response);
	               if(response=="success")
				   {
	                //  swal("Success!", "Thanks for Your Note!", "success");
	                  $('#homeworkform')[0].reset();
	                  swal({
						   title: "Wow!",
						   text: "Message!",
						   type: "success"
						},
		   function() {
	           window.location = "<?php echo base_url(); ?>homework/get_all_homework/"+clssid;
	       });
	       }else{
	              sweetAlert("Oops...", "Something went wrong!", "error");
	             }
	           }
	       });
	     }else{
	         swal("Cancelled", "Process Cancel :)", "error");
	     }
	   });
	} 
	 
	
    });
	
   });
  
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
   
   
         });
</script>
<script type="text/javascript">
   $().ready(function(){
   
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
   
    $(document).on("click", ".open-AddBookDialog", function () {
      var eventId = $(this).data('id');
      $(".modal-body #event_id").val( eventId );
   });
</script>

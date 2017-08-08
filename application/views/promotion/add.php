<style>
.subject-info-box-1,
.subject-info-box-2 {
float: left;
width: 45%;
padding-left: 30px;
select {
height: 200px;
padding: 0;
option {
padding: 4px 10px 4px 10px;
}
option:hover {
background: #EEEEEE;
}
}
}
.subject-info-arrows {
float: left;
width: 10%;
input {
width: 70%;
margin-bottom: 5px;
}
}
.modalheading{
padding-left: 30px;
}
#lstBox1{
height: 300px;
}
#lstBox2{
height: 300px;
}
</style>
<div class="main-panel">
<div class="content">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-10">
                   <div class="card">
                       <div class="header">
                           <h4 class="title">List of Academic years </h4>
                       </div>

                       <a rel="" href="#myModal" data-id="12" title="Promotion" class="open-AddBookDialog btn btn-simple  btn-fill btn-info  edit"  data-toggle="modal" data-target="#myModal"   >
                       Promotion</a>
                       <div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                             <!-- Modal content-->
                             <div class="modal-content">
                                <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                                   <h4 class="modal-title">Promoting Students</h4>
                                </div>
                                <div class="modal-body">
                                   <form action="" method="post" class="form-horizontal" id="members_adding_form">
                                      <fieldset>
                                        <div class="form-group">
                                           <label class="col-sm-4 control-label">From Year</label>
                                           <div class="col-sm-6">
                                              <select   name="status" id="status" class="form-control">
                                                 <option value="Active">Active</option>
                                                 <option value="Deactive">Deactive</option>
                                              </select>
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <label class="col-sm-4 control-label">To Year</label>
                                           <div class="col-sm-6">
                                              <select   name="status" id="status" class="form-control">
                                                 <option value="Active">Active</option>
                                                 <option value="Deactive">Deactive</option>
                                              </select>
                                           </div>
                                        </div>
                                            <div class="form-group">
                                            <div class="col-sm-6">
                                              <select  name="class_master_id" id="class_master_id1"    data-title="From Class" class="selectpicker" data-style=" btn-block" data-menu-style="dropdown-blue" onchange="get_student_list()">
                                                 <?php foreach($res_class as $rows){ ?>
                                                 <option value="<?php echo $rows->class_id; ?>"><?php echo $rows->class_name; ?>-<?php echo $rows->sec_name; ?></option>
                                                 <?php    } ?>
                                              </select>
                                            </div>
                                              <div class="col-sm-6">
                                            <select  name="class_master_id" id="class_master_id1"    data-title="To Class" class="selectpicker" data-style=" btn-block" data-menu-style="dropdown-blue" onchange="get_student_list()">
                                               <?php foreach($res_class as $rows){ ?>
                                               <option value="<?php echo $rows->class_id; ?>"><?php echo $rows->class_name; ?>-<?php echo $rows->sec_name; ?></option>
                                               <?php    } ?>
                                            </select>
                                          </div>
                                         </div>
                                       </fieldset>
                                       <fieldset>
                                         <div class="form-group">
                                            <center>List of Students to include </center>
                                            <div class="subject-info-box-1">
                                               <select multiple="multiple" id='lstBox1' class="form-control">
                                                  <option value=""></option>
                                               </select>
                                            </div>
                                            <div class="subject-info-arrows text-center">
                                               <input type="button" id="btnAllRight" value=">>" class="btn btn-default" /><br />
                                               <input type="button" id="btnRight" value=">" class="btn btn-default" /><br />
                                               <input type="button" id="btnLeft" value="<" class="btn btn-default" /><br />
                                               <input type="button" id="btnAllLeft" value="<<" class="btn btn-default" />
                                            </div>
                                            <div class="subject-info-box-2">
                                               <select multiple="multiple" name="members_id[]" id='lstBox2' class="form-control">
                                               </select>
                                            </div>

                                         </div>
                                         <input type="button" id="select_all" class="pull-right" name="select_all" value="Select All">
                                         <div class="form-group">
                                            <label class="col-sm-4 control-label">Result Status</label>
                                            <div class="col-sm-6">
                                               <select   name="status" id="status" class="form-control">
                                                  <option value="Promote">Promote</option>
                                                  <option value="Demoted">Demoted</option>
                                               </select>
                                            </div>
                                         </div>
                                         <div class="form-group">
                                            <label class="col-sm-4 control-label">&nbsp;</label>
                                            <div class="col-sm-6">
                                               <button type="submit" id="save" class="btn btn-info btn-fill center">Save </button>
                                            </div>
                                         </div>
                                      </fieldset>
                                   </form>
                                </div>
                                <div class="modal-footer">
                                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
$('#select_all').click(function() {
       $('#lstBox2 option').prop('selected', true);
   });
(function () {
  $('#btnRight').click(function (e) {
      var selectedOpts = $('#lstBox1 option:selected');
      if (selectedOpts.length == 0) {
          alert("Nothing to move.");
          e.preventDefault();
      }

      $('#lstBox2').append($(selectedOpts).clone());
      $(selectedOpts).remove();
      e.preventDefault();
  });

  $('#btnAllRight').click(function (e) {
      var selectedOpts = $('#lstBox1 option');
      if (selectedOpts.length == 0) {
          alert("Nothing to move.");
          e.preventDefault();
      }

      $('#lstBox2').append($(selectedOpts).clone());
        $(this).prop("selected", true);
      $(selectedOpts).remove();
      e.preventDefault();
  });

  $('#btnLeft').click(function (e) {
      var selectedOpts = $('#lstBox2 option:selected');
      if (selectedOpts.length == 0) {
          alert("Nothing to move.");
          e.preventDefault();
      }

      $('#lstBox1').append($(selectedOpts).clone());
      $(selectedOpts).remove();
      e.preventDefault();
  });

  $('#btnAllLeft').click(function (e) {
      var selectedOpts = $('#lstBox2 option');
      if (selectedOpts.length == 0) {
          alert("Nothing to move.");
          e.preventDefault();
      }

      $('#lstBox1').append($(selectedOpts).clone());
      $(selectedOpts).remove();
      e.preventDefault();
  });

}(jQuery));

$('#grouping_form').validate({ // initialize the plugin
  rules: {
      group_title:{required:true },
      group_lead:{required:true },
      status:{required:true },
  },
  messages: {
        group_title: "Enter Grouping Name",
        group_lead:"Select group incharge",
        status:"select status"

      },
    submitHandler: function(form) {
      //alert("hi");
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
         url: "<?php echo base_url(); ?>grouping/create_group",
          type:'POST',
         data: $('#grouping_form').serialize(),
         success: function(response) {
             if(response=="success"){
              //  swal("Success!", "Thanks for Your Note!", "success");
                $('#grouping_form')[0].reset();
                swal({
         title: "Wow!",
         text: response,
         type: "success"
     }, function() {
        location.reload();
     });
             }else{
               sweetAlert("Oops...", response, "error");
             }
         }
     });
   }else{
       swal("Cancelled", response , "error");
   }
 });
}
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

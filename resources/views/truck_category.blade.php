@extends('layouts.dashboardAdmin')
@section('page_title','Equipment')
@section('page_content')

<div class="">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" >
        <div class="x_title" style="margin-bottom: 20px;">
          <div class="title_left">
            <h4 style="margin-top: -4px;">Equipment <small>Information</small></h4>
            <div style="margin-top: -42px;">
              <button type="button" class="button" id="addTruckCategory"><i class="fa fa-plus"></i> &nbsp Add Equipment</button>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <p class="text-muted font-13 m-b-30">
          It allows you to add, edit, delete Equipments.</p>
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead style="background-color: #353959; color:#ffffff;">
              <tr>
                <th style="width: 10%; text-align:center;">ID</th>
                <th>Equipment</th>
                <th style="width: 30%;">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($var as $var)
                <tr>
                  <td>{{$var->ec_id}}</td>
                  <td>{{$var->ec_category}}</td>
                  <td>
                    <button class="btn btn-info btn-xs edittype" data-id="{{$var->ec_id}}"><i class="fa fa-pencil"></i> Edit </button>
                    <button class="btn btn-delete btn-xs deletetype" data-id="{{$var->ec_id}}"><i class="fa fa-trash-o"></i> Delete </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

         <!-- jQuery -->
         <script src="../vendors/jquery/dist/jquery.min.js"></script>
         <!-- Bootstrap -->
         <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
         <!-- FastClick -->
         <script src="../vendors/fastclick/lib/fastclick.js"></script>
         <!-- NProgress -->
         <script src="../vendors/nprogress/nprogress.js"></script>
         <!-- iCheck -->
         <script src="../vendors/iCheck/icheck.min.js"></script>
         <!-- Parsley -->
         <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
         <!-- Autosize -->
         <script src="../vendors/autosize/dist/autosize.min.js"></script>
         <!-- Datatables -->
         <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
         <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
         <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
         <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
         <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
         <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
         <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
         <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
         <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
         <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
         <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
         <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
         <script src="../vendors/jszip/dist/jszip.min.js"></script>
         <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
         <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

         <!-- Custom Theme Scripts -->
         <script src="../build/js/custom.min.js"></script>

    <!-- DELETE Modal -->
  		<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Delete Equipment</h4>
            </div>
            <div class="modal-body">
              <form method="post" action="/deletetruck_category" id="delete-form">
                {{csrf_field()}}
                <input type="hidden" name="id" class="id">
              Are you sure you want to delete this Equipment?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-danger">Delete</button>
            </div>
            </form>
          </div>
        </div>
      </div>
  <!-- EDIT Modal -->
  		<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role = "document">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #353959; color:#ffffff;">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title" id="myModalLabel">Edit Equipment</h3>
            </div>
            <div class="modal-body">
          		<form method = "post" action = "/edittruck_category">
                {{csrf_field()}}
                <input type="hidden" class="id" name="id">
            		<div class="input-field col-md-12 col-sm-12 col-xs-24 form-group has-feedback">
        					<i class="large material-icons prefix" style="font-size: 37px">local_shipping</i>
                  <input type="text" class="form-control has-feedback-left inpDesc" name = "ec_category" placeholder="Equipment *"  required >
                </div>
        		</div>
            <div class="modal-footer" style="background-color: #353959; color:#ffffff;">
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="background-color: #fff600; color:#848484; border-color:#fff600">Close</button>
              <button type="submit" class="btn btn-success">Edit</button>
            </div>
        		</form>
          </div>
        </div>
      </div>

  <!-- ADD Modal -->
  		<div class="modal fade" id="addModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #353959; color:#ffffff;">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title" id="myModalLabel">Add Equipment</h3>
            </div>
            <div class="modal-body">
              <form method="post" action="/addtruck_category">
                {{csrf_field()}}
                <div class="input-field col-md-12 col-sm-12 col-xs-24 form-group has-feedback">
      						<i class="large material-icons prefix" style="font-size: 37px">local_shipping</i>
                  <input type="text" class="form-control has-feedback-left" id="ec_category" name="ec_category" placeholder="Equipment *" required>
                </div>
              </div>
            </div>
            <div class="modal-footer" style="background-color: #353959; color:#ffffff;">
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="background-color: #fff600; color:#848484; border-color:#fff600">Close</button>
              <button type="submit" class="btn btn-success">Add</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    <!-- JAVASCRIPT - ADD, EDIT, DELETE -->
    <script type="text/javascript">
    $('#addTruckCategory').click(function () {
      $('#addModal').modal('show');
    });

      $('.edittype').click(function () {
          $.ajax
          ({
              type : "get",
              url : '/gettruck_category',
              data : {"id" : $(this).data('id')},
              dataType: "json",
              success: function(response) {
                  response.forEach(function(data){
                      $('#editModal .id').val(data.ec_id);
                      $('#editModal .inpDesc').val(data.ec_category);
                  })
              }
          });
          $('#editModal').modal('show');
      });

      $('.deletetype').click(function(){
          $('#delete-form .id').val($(this).data('id'));
          $('#deleteModal').modal('show');
      });
     
    </script>
@stop

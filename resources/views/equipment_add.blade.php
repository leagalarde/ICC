@extends('layouts.dashboardAdmin')
@section('page_title','Equipment Inventory')
@section('page_content')

<div class="">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" >
        <div class="x_title" style="margin-bottom: 20px;">
          <div class="title_left">
            <h4 style="margin-top: -4px;">Equipment <small>List</small></h4>
            <div style="margin-top: -42px;">
              <button type="button" class="button" id="addTruckCategory"><i class="fa fa-plus"></i> &nbsp Add Equipment</button>
            </div>
          </div>
          <div class="clearfix"></div>
          
                    @if(count($errors))
                    <div class='form-group' id = 'flash'>
                      <div class = 'alert alert-danger'>
                        <ul>
                          @foreach ($errors->all() as $error)
                          <li>{{$error}}</li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                    @endif
        </div>
        <div class="x_content">
          <p class="text-muted font-13 m-b-30">
            It shows inventory of trucks, including some information like its manufacturer, model, date of purchased, unit cost. You can edit & delete item.
          </p>
          <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"  width="100%">
            <thead style="background-color: #353959; color:#ffffff;">
              <tr>
                <th>Action</th>
                <th>Equipment</th>
                <th>Brand</th>
                <th>Model/Plate No/Serial No</th>
                <th>Capacity</th>
                <th>status</th>
                <th>Inspection Date</th>
                <th>Inspection valid until</th>
              </tr>
            </thead>
            <tbody>
              @foreach($stock as $stock)
                <tr>
                  <td>
                    <button class="btn btn-info btn-xs edittype" data-toggle="tooltip" data-placement="left" title="Edit Equipment" data-id="{{$stock->ei_id}}"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-delete btn-xs deletetype" data-toggle="tooltip" data-placement="left" title="Delete Equipment" data-id="{{$stock->ei_id}}"><i class="fa fa-trash-o"></i></button>
                  </td>
                  <td>{{$stock->ec_category}}</td>
                  <td>{{$stock->ei_manufacturer}}</td>
                  <td>{{$stock->ei_serial_model_plate}}</td>
                  <td>{{$stock->ei_capacity_qty}} {{$stock->ei_capacity_unit}}</td>
                  <td>{{$stock->ei_status}}</td>
                  <?php
                    $inspected = $stock->ei_inspection_date;
                    $until = $stock->ei_inspection_valid_until;
                    if($inspected == '1111-11-11'){
                      $inspected = 'Not yet inspected';
                      $until = 'Not yet inspected';
                    }
                    echo '<td>'.$inspected.'</td>
                          <td>'.$until.'</td>';
                  ?>
                </tr>
        			@endforeach
            </tbody>
          </table>
      	</div>
      </div>
    </div>
  </div>
</div>
        <!-- /page content -->

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

	<!-- DELETE Truck -->
  <div class="modal fade" id="deleteTruck" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Delete Item</h4>
        </div>
        <div class="modal-body">
          <form method="post" action="/deleteequipmentinfo" id="delete-form">
            {{csrf_field()}}
			<input type="hidden" name="id" class="id">
              Are you sure you want to delete this item?
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-delete">Delete</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
                            <!-- /.modal -->

<!-- Add modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Equipment</h4>
      </br>
        <p class="text-muted font-13 m-b-30">
          If the equipment is not yet inspected you can leave the Inspection Date and Inspection valid until BLANK otherwise Fill up ALL FIELDS.
        </p>
        </div>
          <div class="modal-body">
            <form class="form-horizontal form-label-left input_mask" method="post" action="/addequipmentinfo">
              {{csrf_field()}}
              <input type="hidden" class="id" name="id">
              <div class="col-md-3 col-sm-3 col-xs-6" style="margin-right: -10px; margin-top: 8px;">
                <label>Description</label>
              </div>
              <div class="col-md-9 col-sm-9 col-xs-18" style="margin-left: -10px;">
                <select class="form-control product-name" name="product-name" id="product-name">
                  <option selected value="default" disabled>Select Equipment Type</option>
                  @foreach($list as $list)
                    <option value="{{$list->ec_id}}">{{$list->ec_category}} </option>
                  @endforeach
                </select>
              </div>
              <div class="input-field col-md-12 col-sm-12 col-xs-24 form-group has-feedback">
                <i class="large material-icons prefix" style="font-size: 37px">local_shipping</i>
                <input type="text" class="form-control has-feedback-left model" id="model" name="model" required="required" placeholder="Model">
              </div>
              <div class="input-field col-md-12 col-sm-12 col-xs-24 form-group has-feedback">
                <i class="large material-icons prefix" style="font-size: 37px">local_shipping</i>
                <input type="text" class="form-control brand"  id="brand-name" name="brand" required="required" placeholder="Brand">
              </div>
              <div class="col-md-12 col-sm-12 col-xs-24" style="margin-right: -10px; margin-top: 8px;">
                <label>Capacity</label>
              </div>
              <div class="input-field col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <input type="number" class="form-control quantity" id="equip-quantity" name="quantity"required="required" placeholder="capacity quantity">
                <span class="fa fa-asterisk form-control-feedback right" aria-hidden="true"></span>
              </div>
              <div class="input-field col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <select class="form-control has-feedback-left capacity" id="equip-capacity" name="capacity">
                  <option value="default" selected disabled>Select Capacity Unit</option>
                  <option value="Kg">Kilogram (Kg)</option>
                  <option value="Myg">Myriagram (Myg)</option>
                  <option value="P">Quintal (P)</option>
                  <option value="t">Metric Ton (t)</option>
                </select>
                <span class="fa fa-balance-scale form-control-feedback left" aria-hidden="true"></span>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback" style="margin-right: -10px; margin-top: 25px;">
                <label class="col-md-6 col-sm-6 col-xs-12">Inspection Date</label>
                <label class="col-md-6 col-sm-6 col-xs-12">Inspection Valid until</label>
              </div>
              <div class="input-field col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <input type="date" class="form-control has-feedback-right inspection-date"  id="inspection-date" name="inspection-date">
                <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
              </div>
              <div class="input-field col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <input type="date" class="form-control has-feedback-right inspection-until"  id="inspection-date-until" name="inspection-until">
                <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="border-color:#fff600">Close</button>
              <button type="submit" class="btn btn-success">Add</button>
            </div>
     		  </form>
        </div>
      </div>
    </div>

	<!-- EDIT Truck -->
  	<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Edit Equipment</h4>
      		<br>
            <p class="text-muted font-12 m-b-30">
              If the equipment is not yet inspected you can leave the Inspection Date and Inspection valid until BLANK.
            </p>
          </div>
          <div class="modal-body">
            <form class="form-horizontal form-label-left input_mask" method="post" action="/editequipmentinfo">
              {{csrf_field()}}
              <input type="hidden" class="id" name="id">
              <div class="col-md-3 col-sm-3 col-xs-6" style="margin-right: -10px; margin-top: 8px;">
                <label>Description</label>
              </div>
              <input type="hidden" class="product-name" id='product-name' name="product-name">
              <div class="col-md-9 col-sm-9 col-xs-18" style="margin-left: -10px;">
                <select class="form-control product-name">
                  @foreach($list2 as $list2)
                    <option value="{{$list2->ec_id}}" disabled>{{$list2->ec_category}} </option>
                  @endforeach
                </select>
              </div>
              <div class="input-field col-md-12 col-sm-12 col-xs-24 form-group has-feedback">
                <i class="large material-icons prefix" style="font-size: 37px">local_shipping</i>
                <input type="text" class="form-control has-feedback-left model" id="model" name="model" required="required" placeholder="Model">
              </div>
              <div class="input-field col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <input type="text" class="form-control brand"  id="brand-name" name="brand" required="required" placeholder="Brand">
                <span class="fa fa-truck form-control-feedback right" aria-hidden="true"></span>
              </div>
              <div class="input-field col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <input type="text" class="form-control status" id="status" name="status" readonly>
                <span class="fa fa-truck form-control-feedback right" aria-hidden="true"></span>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-24" style="margin-right: -10px; margin-top: 8px;">
                <label>Capacity</label>
              </div>
              <div class="input-field col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <input type="number" class="form-control quantity" id="equip-quantity" name="quantity"required="required" placeholder="Brand">
                <span class="fa fa-asterisk form-control-feedback right" aria-hidden="true"></span>
              </div>
              <div class="input-field col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <select class="form-control has-feedback-left capacity" id="equip-capacity" name="capacity">
                  <option value="default" selected disabled>Select Capacity Unit</option>
                  <option value="Kg">Kilogram (Kg)</option>
                  <option value="Myg">Myriagram (Myg)</option>
                  <option value="P">Quintal (P)</option>
                  <option value="t">Metric Ton (t)</option>
                </select>
                <span class="fa fa-balance-scale form-control-feedback left" aria-hidden="true"></span>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback" style="margin-right: -10px; margin-top: 25px;">
                <label class="col-md-6 col-sm-6 col-xs-12">Inspection Date</label>
                <label class="col-md-6 col-sm-6 col-xs-12">Inspection Valid until</label>
              </div>
              <div class="input-field col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <input type="date" class="form-control has-feedback-right inspection-date"  id="inspection-date" name="inspection-date">
                <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
              </div>
              <div class="input-field col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <input type="date" class="form-control has-feedback-right inspection-until"  id="inspection-date-until" name="inspection-until">
                <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="border-color:#fff600">Close</button>
              <button type="submit" class="btn btn-success">Edit</button>
            </div>
      		</form>
        </div>
      </div>
    </div>

<script type="text/javascript">
  $('#addTruckCategory').click(function () {
    $('#addModal').modal('show');
  });

    $('.edittype').click(function () {
      //console.log($(this).data('id'));
      //console.log('edit');
        $.ajax
        ({
            type : "get",
            url : '/getequipmentinfo',
            data : {"id" : $(this).data('id')},
            dataType: "json",
            success: function(response) {
                response.forEach(function(data){
                    $('#editModal .id').val(data.ei_id);
                    $('#editModal .product-name').val(data.ec_id);
                    //$('#editModal select option[value="'+data.ec_category+'"]').attr("selected","selected");
                    $('#editModal .brand').val(data.ei_manufacturer);
                    $('#editModal .model').val(data.ei_serial_model_plate);
                    $('#editModal .status').val(data.ei_status);
                    $('#editModal .quantity').val(data.ei_capacity_qty);
                    $('#editModal .capacity').val(data.ei_capacity_unit);
                    //$('#editModal select option[value="'+data.ei_capacity_unit+'"]').attr("selected","selected");
                    $('#editModal .inspection-date').val(data.ei_inspection_date);
                    $('#editModal .inspection-until').val(data.ei_inspection_valid_until);
                })
            }
        });
        $('#editModal').modal('show');
    });
    $('.deletetype').click(function(){
        //console.log('delete');
        $('#delete-form .id').val($(this).data('id'));
        $('#deleteTruck').modal('show');
    });
</script>

<script>
    $(function() {
        $('#flash').delay(500).fadeIn('normal', function() {
            $(this).delay(1500).fadeOut();
        });
    });
</script>
@stop

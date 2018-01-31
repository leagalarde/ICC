@extends('layouts.dashboardAdmin') 
@section('page_title','Deploy Equipment') 
@section('page_content')

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title" style="margin-bottom: 18px;">
          <div class="title_left">
            <h4>Equipment <small>Deploy</small></h4>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <form method="post" action="/addequipdep">
		  {{csrf_field()}}
            <input type="hidden" id="tableCount" name="tableCount">
            @foreach($equipcat as $reqQty)
              <input type="hidden" value="{{$reqQty->req_item_id}}" name="id">
              <input type="hidden" value="{{$reqQty->ejr_no}}" name="ejrno">
              <input type="hidden" value="{{$reqQty->proj_no}}" name="projno">
              <input type="hidden" value="{{$reqQty->req_qty}}" class="req_qty" id="req_qty">
            @endforeach
            <div class="input-field col s6">
              <i class="large material-icons prefix" style="font-size: 37px">account_box</i>
              <input type="text" id="trial" name="trial" required="required" placeholder="Trial Run by*">
            </div>
            <div class="input-field col s6">
              <i class="tiny material-icons prefix" style="font-size: 37px">date_range</i>
              <input type="date" id="trial" name="date" required="required">
            </div>
            <div class="form-group col s12">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Results</label>
              <textarea class="resizable_textarea form-control" name="result" rows="7" placeholder="Maximum of 500 characters" required="required"></textarea>
            </div>
            <div class="input-field col s6">
              <i class="large material-icons prefix" style="font-size: 37px">account_box</i>
              <input type="text" id="trial" name="turn" required="required" placeholder="Turned over by*">
            </div>
            <div class="input-field col s6">
              <i class="large material-icons prefix" style="font-size: 37px">account_box</i>
              <input type="text" id="trial" name="accept" required="required" placeholder="Accepted by*">
            </div>
            
            <div style="margin:0 auto;width:80%">
              <div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback">
                <table class="table table-striped projects" id="equipment_table">
                  <thead style="background-color: #353959; color:#ffffff; font-size: 15px; text-align: left;">
                    <tr>
                      <th style="width: 5%">#</th>
                      <th style="width: 35%">Equipment</th>
                      <th style="width: 10%">Capacity</th>
                      <th style="width: 30%">Start Date</th>
                      <th style="width: 10%">Total Days</th>
                      <th style="width: 10%">Action</th>
                    </tr>
                  </thead>
                  <tbody style="background-color: #fff; font-size: 14px; text-align: left;">
                  </tbody>
                </table>

                <div style="margin-right:-4px; margin-top:20px;">
                  <button type="button" class="button" id="addequipment"><i class="fa fa-plus"></i> &nbsp Add Equipment</button>
                </div>
              </div>
            </div>
        </div>
            <div class="x_footer" style="width:100%;text-align:center;">
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" style="width:10%">Cancel</button>
              <button type="submit" class="btn btn-success" style="width:10%">Submit</button>
            </div>
          </form>
      </div>
    </div>
  </div>

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
<script type="text/javascript" src="js/deploy_equipment_request.js"></script>

<!--ADD EQUIPMENT Modal -->
<div class="modal fade" id="addEquipment" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Equipment</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-label-left input_mask">
          <input type="hidden" class="equipment-id" id="equipment-id">
          <div class="col s6 col-sm-6 col-xs-12" style="margin-bottom: 5%;">
            <label>Equipment Type</label>
            <select class="form-control" id="select_equiptype">
              @foreach($equipcat as $equipcat)
              <option value="{{$equipcat->ec_id}}" data-name="{{$equipcat->ec_category}}">{{$equipcat->ec_category}}</option>
              @endforeach
            </select>
          </div>
          <div class="col s6 col-sm-6 col-xs-12" style="margin-bottom: 5%;" >
            <label>Equipment Description</label>
            <select class="form-control" id="select_equip">
              <option value="" selected disabled>Equipment Description</option>
            </select>
          </div>
          <div class="input-field col-sm-12 col-xs-24">
            <i class="small material-icons prefix">local_shipping</i>
            <input type="text" class="form-control has-feedback manufacturer-name" disabled id="manufacturer-name" placeholder="Manufacturer Name">
          </div>
          <div class="input-field col-sm-6 col-xs-12">
            <i class="small material-icons prefix">local_shipping</i>
            <input type="text" class="form-control has-feedback serial-model" disabled id="serial-model" placeholder="Serial Model">
          </div>
          <div class="input-field col-sm-6 col-xs-12">
            <i class="small material-icons prefix">local_shipping</i>
            <input type="text" class="form-control has-feedback equip-capacity" disabled id="equip-capacity" placeholder="Capacity">
          </div>
          <div class="form-group col-sm-6 col-xs-12">
            <label>Start Date</label>
            <input type="date" class="form-control has-feedback start-date" id="start-date" required>
          </div>
          <div class="form-group col-sm-6 col-xs-12">
            <label>Total Days</label>
            <input type="number" class="form-control has-feedback total-days" id="total-days" required placeholder="0">
          </div>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-success" id="add_equipment" data-dismiss="modal" >Add Equipment</button>
        </div>
        </form>
      </div>
    </div>
  </div>
    <!-- /.modal -->

<script>
  $('#addequipment').click(function () {
    var table = document.getElementById('tableCount').value;
    var qty = document.getElementById('req_qty').value;
    //console.log(table+'. .'+qty);
    if(table<qty){
      $('#addEquipment').modal('show');
    }else{
      alert("You can ONLY add equipment based on\nrequested number of equipment");
    }
  });
</script>


>
@stop
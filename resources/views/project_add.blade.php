@extends('layouts.dashboardAM') 
@section('page_title','Project Add') 
@section('page_content')
<div class="">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" >
        <div class="x_title">
          <h2>Add Project <small>Contract</small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <form method="post" action="/addproject" id="project_form" data-parsley-validate="">
            {{ csrf_field() }}

            <h2><span style="color:red;">NOTE: ALL FIELDS ARE REQUIRED</span></h2><br/>

            <h2 class="StepTitle" style="text-align:center; ">Company Information</h2>
            <p><span style="font-weight: bold">Instruction:</span> Select Company Name and if its not yet on the record, select others and fill up the form.</p>

            <div class="form-group row">
              <div class="col-md-6 col-sm-12 col-12 text-left form-field field-wrapper">
                <label for="company">Select Company Name</label>
                <select class="form-control company" id="company" name="company" required="" data-parsley-required="" data-parsley-required-message="Select Company Name">
                  <option value="" disabled selected>Select Company Name</option>
                  @foreach($company as $company)
                  <option value="{{$company->cl_no}}">{{$company->cl_company}}</option>
                  @endforeach
                  <option value="others">Others(Please Fill up the Company Information Form)</option>
                </select>
              </div>         
              <div class="col-md-6 col-sm-12 col-12 text-left form-field field-wrapper">
                <label for="company-name">Company Name</label>
                <input type="text" class="form-control" id="company-name" name="company-name" placeholder="Company Name" data-parsley-required="" data-parsley-required-message="Company Name is required" readonly=""/>
              </div>    
            </div>

            <div class="form-group row">      
              <div class="col-md-12 col-sm-24 col-24 text-left form-field field-wrapper">
                <label for="company-address">Company Address</label>
                <input type="text" class="form-control" id="company-address" name="company-address" placeholder="Company Address" data-parsley-required="" data-parsley-required-message="Company Address is required" readonly=""/>
              </div>          
            </div>

            <div class="form-group row">
              <div class="col-md-6 col-sm-12 col-12 text-left form-field field-wrapper">
                <label for="company-phone">Company Phone</label>
                <input type="text" class="form-control" id="company-phone" name="company-phone" placeholder="Company Phone" data-parsley-required="" data-parsley-required-message="Company Phone is required" readonly=""/>
              </div>            
              <div class="col-md-6 col-sm-12 col-12 text-left form-field field-wrapper">
                <label for="company-email">Company Address</label>
                <input type="email" class="form-control" id="company-email" name="company-email" placeholder="Company Email" data-parsley-required="" data-parsley-required-message="Company Email is required" readonly=""/>
              </div>          
            </div>
            
            <br/><h4 class="StepTitle" style="text-align:center; ">Contact Person Information</h4>
            
            <div class="form-group row">
              <div class="col-md-6 col-sm-12 col-12 text-left form-field field-wrapper">
                <label for="client-name">Full Name</label>
                <input type="text" class="form-control" id="client-name" name="client-name" placeholder="Full Name" data-parsley-required="" data-parsley-required-message="Full Name is required" readonly=""/>
              </div>          
              <div class="col-md-6 col-sm-12 col-12 text-left form-field field-wrapper">
                <label for="client-position">Position</label>
                <input type="text" class="form-control" id="client-position" name="client-position" placeholder="Position" data-parsley-required="" data-parsley-required-message="Contact Person Position is required" readonly=""/>
              </div>          
            </div>

            <div class="form-group row">
              <div class="col-md-6 col-sm-12 col-12 text-left form-field field-wrapper">
                <label for="client-phone">Contact Number</label>
                <input type="text" class="form-control" id="client-phone" name="client-phone" placeholder="Contact Number" data-parsley-required="" data-parsley-required-message="Contact Number is required" readonly=""/>
              </div>            
              <div class="col-md-6 col-sm-12 col-12 text-left form-field field-wrapper">
                <label for="client-email">Email</label>
                <input type="email" class="form-control" id="client-email" name="client-email" placeholder="Email" data-parsley-required="" data-parsley-required-message="Email is required" readonly=""/>
              </div>          
            </div>

            

            <br/>
            <hr/>
            <h2 style="text-align: center"> CONTRACT INFORMATION </h1>
              <p><span style="font-weight: bold">Instruction:</span> Fill up all fields and don't forget to add contract details</p>


              <div class="form-group row">
                <div class="col-md-6 col-sm-12 col-12 text-left form-field field-wrapper">
                  <label for="contract-type">Select Contract Type</label>
                  <select class="form-control" id="contract-type" name="contract-type" required>
                    <option value="" disabled selected>Select Contract Type</option>
                    <option value="Horizontal">Horizontal</option>
                    <option value="Vertical">Vertical</option>
                  </select>
                </div>            
                <div class="col-md-6 col-sm-12 col-12 text-left form-field field-wrapper">
                  <label for="contract-date">Contract Date</label>
                  <input type="text" class="form-control" id="contract-date" name="contract-date" placeholder="Contract Date" data-parsley-required="" data-parsley-required-message="Contract Date is required" onchange="checker()" />
                </div>          
              </div>

              <br/>

              <article style="margin-bottom: 5px">
                <table class="meta">
                  <tr>
                    <th><span>Amount Due</span></th>
                    <td><span id="prefix">P</span><span>0.00</span></td>
                  </tr>
                </table>
                <div class="col-md-6 col-sm-6 col-xs-12" style="margin-right:-4px; margin-top:-30px; margin-bottom:20px; width:100%; text-align:center" >
                  <a  data-toggle="modal" data-target="#addContractPlan"><button type="button" class="button" ><i class="fa fa-plus"></i> &nbsp Add Contract Details</button></a>
                </div>
                <table class="table table-striped table-bordered dt-responsive nowrap bill" id="bill" data-parsley-required="" data-parsley-required-message="Add Contract Details">
                  <thead>
                    <tr>
                      <th><span>Action</span></th>
                      <th style="width:8%"><span>Item No</span></th>
                      <th style="width:30%"><span>Description</span></th>
                      <th><span>Unit</span></th>
                      <th><span>Rate</span></th>
                      <th><span>Quantity</span></th>
                      <th><span>Price</span></th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <table class="balance" >
                  <tr>
                    <th><span>Total</span></th>
                    <td><span data-prefix>P </span><span> 0.00</span></td>
                  </tr>
                  <tr>
                    <th><span>Payment (15%):</span></th>
                    <td><span data-prefix>P </span><span> 0.00</span></td>
                  </tr>
                  <tr>
                    <th><span>Balance Due</span></th>
                    <td><span data-prefix>P </span><span> 0.00</span></td>
                  </tr>
                </table>
              </article>

              <input type="hidden" id="total" name="contract-total" class="total">
              <input type="hidden" id="paid" name="contract-paid" class="paid">
              <input type="hidden" id="balance" name="contract-balance" class="balance">

              <hr/>
              <h2 style="text-align: center"> PROJECT INFORMATION </h2>
              <p><span style="font-weight: bold">Instruction:</span> Fill up all fields.</p>

              <div class="form-group row">
                <div class="col-md-12 col-sm-24 col-24 form-field field-wrapper">
                  <label for="project-name">Project Name</label>
                  <input type="text" class="form-control" id="project-name" name="project-name" placeholder="Project Name" data-parsley-required="" data-parsley-required-message="Project Name is required"/>
                </div>         
              </div>

              <div class="form-group row">
                <div class="col-md-12 col-sm-24 col-24 text-left form-field field-wrapper">
                  <label for="construction-site">Construction Site</label>
                  <input type="text" class="form-control" id="construction-site" name="construction-site" placeholder="Construction Site" data-parsley-required="" data-parsley-required-message="construction-site By is required"/>
                </div>           
              </div>

              <div class="form-group row">
                <div class="col-md-6 col-sm-12 col-12 text-left form-field field-wrapper">
                  <label for="project-manager">Project Manager</label>
                  <select class="form-control" required id="project-manager" name="project-manager" data-parsley-required="" data-parsley-required-message="Project Manager is required">
                    <option value="" disabled selected>Select Project Manager</option>
                    @foreach($promanager as $promanager)
                    <option value="{{$promanager->emp_id}}">{{$promanager->emp_first_name}} {{$promanager->emp_last_name}} </option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3 col-sm-6 col-6 text-left form-field field-wrapper">
                  <label for="start">Start Date</label>
                  <input type="text" class="form-control" id="start" name="project-start-date" onchange="checker()" placeholder="Start Date" data-parsley-required="" data-parsley-required-message="Start date is required"/>
                </div>
                <div class="col-md-3 col-sm-6 col-6 text-left form-field field-wrapper">
                  <label for="end">End Date</label>
                  <input type="text" class="form-control" id="end" name="project-end-date" onchange="checker()" placeholder="End Date" data-parsley-required="" data-parsley-required-message="End date is required"/>              
                </div>
              </div>            

              <div class="form-group row">
                <div id="floor-nono" class="col-md-6 col-sm-12 col-12 text-left form-field field-wrapper" style="display:none">
                  <label for="floor-no">No of Floor/s</label>
                  <input type="text" class="form-control" id="floor-no" name="floor-no" placeholder="No of Floor/s" data-parsley-required="" data-parsley-required-message="No of Floor/s is required" />
                </div>            
                <div id="floor-areaa" class="col-md-6 col-sm-12 col-12 text-left form-field field-wrapper" style="display:none">
                  <label for="floor-area">Floor Area(square ft.)</label>
                  <input type="text" class="form-control" id="floor-area" name="floor-area" placeholder="Floor Area(square ft.)" data-parsley-required="" data-parsley-required-message="Floor area is required" />
                </div>          
              </div>

              <div class="form-group row">
                <div id="road-lengthh" class="col-md-6 col-sm-12 col-12 text-left form-field field-wrapper" style="">
                  <label for="road-length">Total Road Length(km.)</label>
                  <input type="text" class="form-control" id="road-length" name="road-length" placeholder="Total Road Length(km.)" data-parsley-required="" data-parsley-required-message="Road Length is required" />
                </div>            
                <div id="road-typee" class="col-md-6 col-sm-12 col-12 text-left form-field field-wrapper" style="">
                  <label for="road-type">RoadType</label>
                  <input type="text" class="form-control" id="road-type" name="road-type" placeholder="RoadType" data-parsley-required="" data-parsley-required-message="RoadType is required" />
                </div>          
              </div>            


              <div class="form-group row">
                <div id="project-desc" class="col-md-12 col-sm-24 col-24 text-left form-field field-wrapper">
                  <label for="project-desc">Project Description</label>
                  <textarea class="form-control" id="project-desc" name="project-desc" rows="5" cols="4" placeholder="Project Description" data-parsley-required="" data-parsley-required-message="Project Description is required" /></textarea> 
                </div>          
              </div>

              <br/>
              <hr/>
              <h2 style="text-align: center"> EQUIPMENT INFORMATION </h2>
              <p><span style="font-weight: bold">Instruction:</span> Add Equipment and fill up all fields.</p>
              <div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback">
                <label>Equipments</label>
                <table class="table table-striped dt-responsive nowrap projects" id="equipment_table">
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

                <div style="margin-right:-4px; margin-top:20px;text-align: center">
                  <a  data-toggle="modal" data-target="#addEquipment"><button type="button" class="button" ><i class="fa fa-plus"></i> &nbsp Add Equipment</button></a>
                </div>
              </div>
              <button type="submit" class="btn btn-success" id="submit" onclick="" style="margin-top:10%;width:100%">Submit</button>
            </div>
          </form>
        </div>
      </div>

      <!--ADD EQUIPMENT Modal -->
      <div class="modal fade" id="addEquipment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Add Equipment</h4>
            </div>
            <form class="form-horizontal form-label-left input_mask">
              <div class="modal-body">

                <div class="col-md-6 col-sm-6 col-xs-12">
                  <label>Equipment Type</label>
                  <select class="form-control" id="select_equiptype">
                    <option value="default" selected disabled>Select Equipment Type</option>
                    @foreach($equipcat as $equipcat)
                    <option value="{{$equipcat->ec_id}}" data-name="{{$equipcat->ec_category}}">{{$equipcat->ec_category}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12">
                  <label>Equipment Description</label>
                  <select class="form-control" id="select_equip">
                    <option value="" selected disabled>Equipment Description</option>
                  </select>
                </div>

                <input type="hidden" class="equipment-id" id="equipment-id">

                <div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback">
                  <label>Manufacturer Name</label>
                  <input type="text" class="form-control has-feedback-left manufacturer-name" disabled="disabled" id="manufacturer-name" required="required" placeholder="Manufacturer Name">
                  <span class="fa fa-truck form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Serial Model</label>
                  <input type="text" class="form-control has-feedback-left serial-model" disabled="disabled" id="serial-model" required="required" placeholder="Serial Model">
                  <span class="fa fa-truck form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" >
                  <label>Capacity</label>
                  <input type="text" class="form-control equip-capacity" disabled="disabled" id="equip-capacity" required="required" placeholder="Capacity">
                  <span class="fa fa-asterisk form-control-feedback right" aria-hidden="true"></span>
                </div>

                <div class="form-group row">
                  <div class="col-md-6 col-sm-12 col-12 text-left form-field field-wrapper" style="">
                    <label for="start-date">Start Date</label>
                    <input type="text" class="form-control" id="start-date" placeholder="Start Date" data-parsley-required="" data-parsley-required-message="Start Date is required" onchange="checker()"/>
                  </div>            
                  <div class="col-md-6 col-sm-12 col-12 text-left form-field field-wrapper" style="">
                    <label for="total-days">Total Day</label>
                    <input type="text" class="form-control" id="total-days" placeholder="Total Day" data-parsley-required="" data-parsley-required-message="Total Day is required" />
                  </div>          
                </div>            
              </div>
              <div class="modal-footer" style="margin-top: 5%;" >
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="add_equipment" data-dismiss="modal" >Add Equipment</button>
              </div>
            </form>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
      </div>
      <!-- /.modal -->
    </div>

    <!-- ADD PLAN TO THE CONTRACT -->
    <div class="modal fade" id="addContractPlan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Add Contract Details</h4>
          </div>
          <div class="modal-body" id="msg">
            <form class="form-horizontal form-label-left input_mask" id="contract_plan">

              <div class="form-group row">
                <div class="col-md-12 col-sm-24 col-24 text-left form-field field-wrapper">
                  <label for="select_plan">Select a Plan</label>
                  <select class="form-control" id="select_plan" name="select_plan" data-parsley-required="" data-parsley-required-message="Select Plan">
                    <option value="" selected disabled>Select a Plan</option>
                    @foreach($plan as $plan)
                    <option value="{{$plan->task_id}}">{{$plan->task_description}}</option>
                    @endforeach
                  </select>
                </div>     
              </div> 

              <input type="hidden" id="task-id" class="task-id">
              <input type="hidden" id="phase-id" class="phase-id">

              <div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback">
                <label>Plan Description</label>
                <input type="text" class="form-control has-feedback-left task-description" disabled="disabled" id="task-description" required="required" placeholder="Plan Descrption">
                <span class="fa fa-truck form-control-feedback left" aria-hidden="true"></span>
              </div>

              <div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback">
                <label>Unit</label>
                <input type="text" class="form-control has-feedback-left task-unit" disabled="disabled" id="task-unit" required="required" placeholder="Unit">
                <span class="fa fa-truck form-control-feedback left" aria-hidden="true"></span>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <label>Cost</label>
                <input type="text" class="form-control task-cost" disabled="disabled" id="task-cost" required="required" placeholder="Cost">
                <span class="fa fa-truck form-control-feedback right" aria-hidden="true"></span>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <label>Quantity</label>
                <input type="text" class="form-control task-quantity" id="task-quantity" name="task_quantity" required="required" placeholder="Quantity">
                <span class="fa fa-asterisk form-control-feedback right" aria-hidden="true"></span>
              </div>

              <div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback">
                <label>Total</label>
                <input type="text" class="form-control task-price" id="task-price" required="required" placeholder="Total" readonly>
                <span class="fa fa-asterisk form-control-feedback right" aria-hidden="true"></span>
              </div>
            </div>
            <div class="modal-footer" style="margin-top: 5%;">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-success add" data-dismiss="modal" >Add Contract Plan</button>
            </div>
            <!-- /.modal-content -->
          </form>
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- validation -->
<script src="../vendors/validation/dist/jquery.validate.min.js"></script>

<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>
<!-- jQuery Smart Wizard -->
<script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
<!-- Custom Theme Scripts -->
<script src="../build/js/custom.js"></script>
<!-- Dropzone.js -->
<script src="../vendors/dropzone/dist/min/dropzone.min.js"></script>
<script src="../vendors/upload.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="../vendors/moment/min/moment.min.js"></script>
<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

<script src="js/projectbill.js"></script>
<script type="text/javascript" src="js/project_equipment.js"></script>
<script type="text/javascript" src="js/materialize.js"></script>
<script type="text/javascript" src="js/table_script.js"></script>
<script type="text/javascript" src="js/client-company-info.js"></script>
<script type="text/javascript" src="js/project_addAll.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.min.js"></script>

<!-- Dropzone.js -->
<link href="../vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
<!-- bootstrap-daterangepicker -->

<link href="css/addproject.css" rel="stylesheet"></link>

@stop
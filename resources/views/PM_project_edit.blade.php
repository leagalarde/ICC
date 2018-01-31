@extends('layouts.dashboard')
@section('page_title','Project Edit')
@section('page_content')

<div class="">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-24">
      <div class="x_panel">
        <div class="x_title">
          <h1>Project Details</h1>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <form method="post" class="form-horizontal form-label-left input_mask" action="/editPMproject" data-parsley-validate>
            {{csrf_field()}}
            @foreach($proj as $proj)
            <div class="col-md-12 col-sm-12 col-xs-24".>
              <div class="col-md-8 col-sm-8 col-xs-16 form-group has-feedback" style="margin-top:2%;">
                <input value="{{$proj->pi_title}}" type="text" class="form-control has-feedback-left" id="project-name" name="project-name" placeholder="Project Name" required>
                <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
              </div>

              <div class="col-md-4 col-sm-4 col-xs-8 form-group has-feedback" style="margin-top:2%;">
                <input value="{{$proj->proj_no}}" style="text-align: right;" type="text" id="project-id" class="form-control col-md-7 col-xs-12" name="project-id" placeholder="1"  readonly>
                <span class=" form-control-feedback left" aria-hidden="true" style="color:#000; margin-top: 5px;">ID</span>
              </div>

              <div class="form-group col-md-6 col-sm-6 col-xs-12" style="margin-top:1%;">
                <div class="form-group">
                  <label>Project Site</label>
                  <input value="{{$proj->pi_construction_site}}" type="text" id="project-site" name="project-site" class="form-control" placeholder="Project Site"  required readonly>
                </div>
              </div>

              <div class="form-group col-md-6 col-sm-6 col-xs-12" style="margin-top:1%;">
                <label>Start & End Date</label>
                <fieldset>
                  <div class="control-group">
                    <div class="controls">
                      <div class="input-prepend input-group">
                        <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                        <input disabled type="text" name="reservation" id="reservation" class="form-control" value="{{date('m/d/Y', strtotime ($proj->proj_start_date))}} - {{date('m/d/Y', strtotime ($proj->proj_end_date))}}" />
                      </div>
                    </div>
                  </div>
                </fieldset>
              </div>

              <input type="hidden" value="{{$proj->ci_desc}}" id="contype">

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" id="floor-nono" style="margin-top: 3px;">
                <label> Number of Floor/s</label>
                <input type="text" value="{{$proj->pi_floor_no}}"  class="form-control has-feedback-left" name="floor-no" id="floor-no" placeholder="No of Floor/s" required="required" style="background-color: #fff">
                <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" id="floor-areaa" style="margin-top: 3px;">
                <label>Floor Area  (ft <sup >2 </sup> )</label>
                <input type="text" value="{{$proj->pi_floor_area}}"  class="form-control has-feedback-left" name="floor-area" id="floor-area" placeholder="Floor Area (square feet)" required="required" style="background-color: #fff">
                <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" id="road-lengthh" style="margin-top: 5px;">
                <label> Total Length Road (km)</label>
                <input type="text" value="{{$proj->pi_road_length}}"  class="form-control has-feedback-left" name="road-length" id="road-length" placeholder="Road Length (km)" required="required" style="background-color: #fff">
                <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" id="road-typee" style="margin-top: 5px;">
                <label>Road Type</label>
                <input type="text"value="{{$proj->pi_road_type}}"  class="form-control has-feedback-left" name="road-type" id="road-type" placeholder="Road Type" required="required" style="background-color: #fff">
                <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
              </div>

              <div class="form-group col-md-12 col-sm-12 col-xs-24" style="margin-top:5px;">
                <label >Project Description</label>
                <textarea class="resizable_textarea form-control" name-="project-desc" id="project-desc" name="project-desc" rows="5" cols="50" required >{{$proj->pi_description}}</textarea>
              </div>

              <div class="ln_solid" style="margin-top: 41%"></div>
              <div class="col-md-12 col-sm-12 col-xs-24 " style="margin-left:40%;">
                <a href="{{ url ('PM_project') }}"><button type="button" class="btn btn-primary" onclick="goBack()">Cancel</button></a>
                <button class="btn btn-primary" type="button" onclick="resetit()">Reset</button>
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8 col-xs-16">
      <div class="x_panel">
        <div class="x_title">
          <h2>Project Tasks</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <p class="text-muted font-13 m-b-30" style="margin-bottom:3%;">
            It contains the project tasks, and each is described in detail. There are some tasks and some phases that can happen simultaneously. The responsibility of the Project Manager is to schedule the subcontractors at the appropriate time so that the critical path is completed in the least amount of time
          </p>
          <!-- start project task list -->
          <table id="datatable-responsive" class="table projects">
            <thead style="background-color: #353959; color:#ffffff;">
              <tr>
                <th style="width: 100%">Project Tasks</th>
              </tr>
            </thead>
            <tbody>
              @php $task1 = $task @endphp
              @foreach($task1 as $task1)
              <tr>
                <td>
                  <div class="col-md-24 col-xs-24">
                    <div class="flex">
                      <ul class="list-inline widget_profile_box">
                        <li style="width:75%; margin-top:-8px;">
                          <h3 style="color:#232323; font-size: 1.6em;"><button class="btn btn-primary edittask" type="button"  data-id="{{$task1->pt_id}}"><i class="fa fa-edit"></i></button> {{$task1->task_description}} </h3>
                        </li>
                        <li style="width:25%; text-align:right; margin-top:-7px;">
                          @if($task1->pt_end_date == '1111-11-11')
                          <h3><span class="label label-default">Not Yet Set</span></h3>
                          @else
                          <h3><span class="label @if(strtotime($task1->pt_end_date) < strtotime('now') && $task1->pt_percentage!=100) label-danger @elseif($task1->pt_status=='Complete') label-success @elseif($task1->pt_status=='Pending') label-default @else label-warning @endif">@if(strtotime($task1->pt_end_date) < strtotime("now") && $task1->pt_percentage != 100) Delayed @else {{$task1->pt_status}} @endif</span></h3>
                          @endif
                        </li>
                        <li style="width:100%">
                          <div class="project_progress" style="text-align:center;">
                            <div class="progress progress_sm">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{$task1->pt_percentage}}"></div>
                            </div>
                            <small>{{$task1->pt_percentage}}% Complete</small>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <div class="flex">
                      <ul class="list-inline count2">
                        <li>
                          <span>Start Date: {{$task1->pt_start_date}}</span>
                        </li>
                        <li>
                          <span style="color: @if($task1->pt_expense > $task1->pt_total_cost) #c60303 @else @endif">
                            Budget:<br>{{$task1->pt_expense}} / {{$task1->pt_total_cost}} 
                          </span>
                        </li>
                        <li>
                          @if($task1->pt_end_date == '1111-11-11')
                          <span>Deadline: NOT YET SET</span>
                          @else
                          <span>Deadline: {{$task1->pt_end_date}}</span>
                          @endif
                        </li>
                      </ul>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <!-- end project task list -->
        </div>
      </div>
    </div>
    
    <div class="col-md-4 col-sm-4 col-xs-12" style="float:right;">
      <div class="x_panel tile fixed_height_300">
        <div class="x_title">
          <h2>Project Milestones</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Settings 1</a></li>
                <li><a href="#">Settings 2</a></li>
              </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <p style="margin-bottom:6%;">
            We have divided the project process into three (3) phases. (You can edit phases here.)
          </p>
          @php $phase1 = $phase @endphp
          @foreach($phase1 as $phase1)
          <div class="widget_summary">
            <div class="w_left w_25">
              <a class="editmilestone" data-id="{{$phase1->pp_id}}" style="cursor:pointer"><span>{{$phase1->phase_title}}</span></a>
            </div>
            <div class="w_center w_55">
              <div class="progress">
                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="{{$phase1->pp_percentage}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$phase1->pp_percentage}}%;">
                </div>
              </div>
            </div>
            <div class="w_right w_20">
              <span>{{$phase1->pp_percentage}}%</span>
            </div>
            <div class="clearfix"></div>
          </div>
          @endforeach
        </div>
      </div>
    </div>          
    
    <div class="col-md-4 col-sm-4 col-xs-8" style="float:right;">
      <div class="x_panel">
        <div class="x_title">
          <h1>Client Details</h1>

          <div class="clearfix"></div>
        </div>
        <div class="x_content well" style="padding:20px">
          <h2 class="StepTitle" style="text-align:left; margin-bottom: 25px;"><strong>Project Manager</strong></h2>
          <h4><strong>Name:</strong> {{$proj->emp_first_name}} {{$proj->emp_last_name}}</h4>
          <h4><strong>Job Title:</strong> {{$proj->el_position}}</h4>
          <h4><strong>Email:</strong> {{$proj->emp_email}}</h4>
          <h4><strong>Telephone:</strong> {{$proj->emp_contact}}</h4>

          <br />
          @foreach($client as $client)
          <h2 class="StepTitle" style="text-align:left; margin-bottom: 25px;"><strong>Client Info</strong></h2>
          <h4><strong>Company Name:</strong></h4>
          <h4>{{$client->cl_company}}</h4>
          <h4><strong>Main Contact:</strong></h4>
          <h4>{{$client->cr_first_name}} {{$client->cr_last_name}}</h4>
          <h4><strong>Email:</strong> {{$client->cr_email}}</h4>
          <h4><strong>Telephone
          @endforeach
          <div class="ln_solid" style="margin-top: 8%;"></div>
          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-24 " style="width:100%;">
              <button type="submit" id="editclient" data-id="{{$proj->proj_no}}" class="btn btn-success" style="width:100%">Edit Project Details</button>  
              <a href="/previewcontract?id={{$proj->proj_no}}"><button class="btn btn-success" style="margin-top: 13px; width:100%">Preview Contract</button></a>
              <a href="/PM_monthlyreport?id={{$proj->proj_no}}"><button class="btn btn-success" style="margin-top: 13px; width:100%">Monthly Report</button></a>
              @if ($proj->proj_status == 'Closed')
              <a href="/openproject?id={{$proj->proj_no}}"><button class="btn btn-success" style="margin-top: 13px; width:100%">Open Project</button></a>
              @else
              <a href="/closeproject?id={{$proj->proj_no}}"><button class="btn btn-success" style="margin-top: 13px; width:100%">Close Project</button></a>
              @endif
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
                        
    <div class="col-md-8 col-xs-16">
      <div class="x_panel ">
        <div class="x_title">
          <h2>Equipment</h2>
          <div style="float:right;">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#information" data-toggle="tab">Information</a></li>
              <li><a href="#request" data-toggle="tab">Replacement Request</a></li>
            </ul>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="tab-content">
          <!-- start form for validation -->
          <div id="information" class="tab-pane fade in active">
            <table class="table table-striped">
              <thead style="background-color: #353959; color:#ffffff;">
                <tr>
                  <th style="width: 1%">No</th>
                  <th style="width: 8%">Equipment</th>
                  <th style="width: 22%">Serial/Model/Plate no.</th>
                  <th style="width: 8%">capacity</th>
                  <th style="width: 30%">Start date</th>
                  <th style="width: 5%">total days</th>
                  <th style="width: 5%">Status</th>
                  <th style="width: 18%">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($equipdep as $equipdep)
                <tr>
                  <td>{{$equipdep->ei_id}}</td>
                  <td>{{$equipdep->ec_category}}</td>
                  <td>{{$equipdep->ei_serial_model_plate}}</td>
                  <td>{{$equipdep->ei_capacity_qty}}{{$equipdep->ei_capacity_unit}}</td>
                  <td>{{$equipdep->ed_start_date}}</td>
                  <td>{{$equipdep->ed_total_days}}</td>
                  <td style="text-align:center">
                    <span class="label @if($equipdep->ei_status=='Maintenance') label-warning 
                                 @elseif($equipdep->ei_status=='Deployed') label-success 
                                 @else label-danger @endif" 
                          style="font-size: 1.1em">{{$equipdep->ei_status}}
                    </span>
                  </td>
                  <td>
                    <div class="btn-group">
                      <button type="submit" id="editequipment" data-id="{{$equipdep->ed_id}}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Edit" style="width:@if($equipdep->ei_status!='Deployed') 50%;
                      @else 100%;
                      @endif text-align:center;">
                        <i class="fa fa-pencil" ></i>
                      </button>
                      @if($equipdep->ei_status == 'Maintenance')
                      <button type="submit" id="equipmentmaintenance" data-id="{{$equipdep->ed_id}}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Equipment Maintenance" style="width:50%; text-align:center;">
                        <i class="fa fa-wrench" ></i>
                      </button>
                      @elseif($equipdep->ei_status == 'Defective')
                      <button type="submit" id="equipmentrequest" data-id="{{$equipdep->ed_id}}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Equipment Request" style="width:50%; text-align:center;">
                        <i class="fa fa-truck" ></i>
                      </button>
                      @endif
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          @foreach($equipreq as $equipreq)
          <div id="request" class="tab-pane fade">
            <table class="table table-striped">
              <thead style="background-color: #353959; color:#ffffff;">
                <tr>
                  <th style="width: 10%">No</th>
                  <th style="width: 50%">Equipment</th>
                  <th style="width: 20%">Quantity</th>
                  <th style="width: 20%">Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{$equipreq->req_item_id}}</td>
                  <td>{{$equipreq->req_items}}</td>
                  <td>{{$equipreq->req_qty}}</td>
                  <td>
                    @if($equipreq->req_status == 'Sent')
                    <span class="label label-info" style="font-size: 1.1em"><i class="fa fa-paper-plane-o"> {{$equipreq->req_status}}</i></span>
                    @elseif($equipreq->req_status == 'Approved')
                    <span class="label label-success" style="font-size: 1.1em"><i class="fa fa-check"> {{$equipreq->req_status}}</i></span>
                    @else
                    <span class="label label-danger" style="font-size: 1.1em"><i class="fa fa-times"> {{$equipreq->req_status}}</i></span>
                    @endif
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          @endforeach
        </div>
      </div>
    </div>
              
    <div class="col-md-8 col-xs-16">
      <div class="x_panel ">
        <div class="x_title">
          <h2>Time Extension Request <small>Information</small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <table class="table table-striped">
            <thead style="background-color: #353959; color:#ffffff;">
              <tr>
                <th style="width: 10%;">Ref. No.</th>
                <th style="width: 20%">Date Created</th>
                <th style="width: 15%">No. of Days</th>
                <th style="width: 30%">Reason of Delay</th>
                <th style="width: 15%; text-align:center">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($ter as $ter)
              <tr>
                <td style="text-align:center">{{$ter->ter_id}}</td>
                <td>{{$ter->ter_date}}</td>
                <td>{{$ter->ter_days}}</td>
                <td>{{$ter->ter_reason}}</td>
                <td style="text-align:center"><span class="label @if($ter->ter_status=='Waiting') label-warning @elseif($ter->ter_status=='Sent') label-info @elseif($ter->ter_status=='Approved') label-success @else label-danger @endif" style="font-size: 1.1em">{{$ter->ter_status}}</span></td>
              </tr> 
              @endforeach
            </tbody>
          </table>
          <div class="ln_solid"></div>
          <button type="submit" data-id="{{$proj->proj_no}}" class="btn btn-success reqtimeext" style="width:100%"><i class="fa fa-clock-o"></i>&nbsp;Request Time Extension</button>
        </div>
      </div>
    </div>
                    
    <div class="col-md-8 col-xs-16">
      <div class="x_panel ">
        <div class="x_title">
          <h2>Remarks <small>Information</small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <!-- start form for validation -->
          <form method="post" class="form-horizontal form-label-left input_mask" action="/editProjRemarks" data-parsley-validate>
            {{csrf_field()}}
            <div class="form-group col-md-12 col-sm-12 col-xs-24">
              <p class="text-muted font-13 m-b-30" style="margin-bottom:3%;">
                Information entered here will be shown on "Project Status Monthly Report".  Please update your remarks monthly.
              </p>
              <input type="hidden" value="{{$proj->proj_no}}" name="proj_no">
              <textarea class="resizable_textarea form-control" name-="project-remarks" id="project-remarks" name="project-remarks" rows="8" cols="50" required >{{$proj->pi_remarks}}</textarea>
            </div>
            <br/>
            <div class="ln_solid" style="margin-top: 40%;"></div>
            <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-24 " style=" margin-bottom:5px;">
                <button type="submit" class="btn btn-success" style="width:100%">Update Project Remarks</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
              
    <div class="col-md-4 col-sm-4 col-xs-8" style="float:right;">
      <div class="x_panel ">
        <div class="x_title">
          <h2>Contract Form <small>Information</small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <!-- start form for validation -->
          <form method="post" class="form-horizontal form-label-left input_mask" action="/editProjContract" data-parsley-validate>
            {{csrf_field()}}
            @foreach($contract as $contract)
            <input type="hidden" value="{{$contract->proj_no}}" name="proj_no">
            <label >Contract Title</label>
            <input type="text" id="ci_name" class="form-control" name="ci_name" value="{{$contract->ci_name}}" required />
            <label style="margin-top: 4%;">Contract Type*:</label>
            <p>
              Horizontal
              <input type="radio" class="flat" name="ci_desc" id="Horizontal" disabled value="Horizontal" @if($contract->ci_desc=='Horizontal') checked @else @endif  />
              Vertical
              <input type="radio" class="flat" name="ci_desc" id="Vertical" disabled  value="Vertical" @if($contract->ci_desc=='Vertical') checked @else @endif />
              @endforeach
            </p>
            <!-- start task list -->
            <table class="table table-striped" style="margin-top:6%;">
              <thead style="background-color: #353959; color:#ffffff;">
                <tr>
                  <th style="width: 100%">Contract Plans</th>
                </tr>
              </thead>
              <tbody>
                @php $plan1 = $plan @endphp
                @foreach($plan1 as $plan1)
                <tr>
                  <td>
                    <a data-toggle="tooltip" data-placement="left" title="Price per unit: {{$plan1->task_unit_cost}}/{{$plan1->task_unit}}  Quantity: {{$plan1->pt_qty}} {{$plan1->task_unit}} ................  Total Cost: {{$plan1->pt_total_cost}}">{{$plan1->task_description}}</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <br/>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-24 " style="margin-top:-5px; margin-bottom:5px;">
                <button type="submit" class="btn btn-success" style="width:100%">Edit Contract Details</button>
                <a href="/previewcontract?id={{$proj->proj_no}}" class="btn btn-success" style="margin-top: 13px; width:100%">Preview Contract</a>
              </div>
            <!-- end form for validations -->
            </div>
          </form>
        </div>
      </div>      
    </div>
    <div class="row">
      <div class="col-md-12 col-xs-24">
        <div class="x_panel">
          <div class="x_title">
            <h2>Project Financials <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
              <li><a class="close-link"><i class="fa fa-close"></i></a></li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form class="form-horizontal form-label-left">
              <p class="text-muted font-13 m-b-30" style="margin-bottom:3%;">
                It shows all approved plans and specifications including the following work of items at the unt prices.
              </p>
              <table class="table table-striped">
                <thead style="background-color: #353959; color:#ffffff;">
                  <tr>
                    <th>Contract Plan</th>
                    <th>Cost</th>
                    <th>Quantiy</th>
                    <th>Final Cost</th>
                  </tr>
                </thead>
                <tbody style="font-size: 14px;">
                  @foreach($plan as $plan)
                  <tr>
                    <td>{{$plan->task_description}}</td>
                    <td>₱ <?php $number = $plan->task_unit_cost; echo number_format ( $number , "2" , "." , "," )?>/ {{$plan->task_unit}}</td>
                    <td>{{$plan->pt_qty}}</td>
                    <td>
                      <span><strong>
                        ₱ <?php $number = $plan->pt_total_cost; echo number_format ( $number , "2" , "." , "," )?>
                        </strong></span>
                    </td>
                    @endforeach
                  <tr>
                    <td colspan="3" align="right" class="quote-align-right" style="font-size: 16px;">Total Cost:</td>
                    <td class="subtotal">
                      <strong>
                        ₱ <?php $number = $plan->cb_total; echo number_format ( $number , "2" , "." , "," )?>
                      </strong>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3" align="right" class="quote-align-right" style="font-size: 16px;">Received by Alcel:</td>
                    <td class="subtotal bg-green ">
                      <strong>
                        ₱ <?php $number = $plan->cb_paid; echo number_format ( $number , "2" , "." , "," )?>
                      </strong>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3" align="right" class="quote-align-right" style="font-size: 16px;">Balance:</td>
                    <td class="subtotal bg-red">	
                      <strong>
                        ₱ <?php $number = $plan->cb_balance; echo number_format ( $number , "2" , "." , "," )?>
                      </strong>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
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
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../vendors/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.js"></script>
	<script src="js/projectbill.js"></script>

	<script type="text/javascript" src="js/project_equipment.js"></script>
	

	<div class="modal fade" id="editMilestone" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">	Milestone</h4>
                    </div>
                    <div class="modal-body">
					<form method="post" action="/editProjectMilestone">
					{{csrf_field()}}
					<input type="hidden" id="proj_no" name="proj_no">
					<input type="hidden" id="id" name="id">
					<div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback">
					   <label> Start Date </label>
                        <input type="date" class="form-control" id="pp_start_date" name="pp_start_date" max="1979-12-31" required="required" >
                     </div>
					<div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback">
					   <label> Deadline</label>
                        <input type="date" class="form-control" id="pp_end_date" name="pp_end_date" required="required" >
                    </div>
                    </div>
					<div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
					</form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


	<div class="modal fade" id="editClient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Edit Details</h4>
                </div>
                <div class="modal-body">
				<form method="post" action="/editClientCompany">
				{{csrf_field()}}
					<input type="hidden" id="id" name="id">
					<h2 class="StepTitle" style="text-align:center; margin-bottom: 15px;">Client Information</h2>
					<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						<input type="text" class="form-control has-feedback-left" id="client_fname" name="client_fname" required="required" placeholder="First Name">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                    </div>

					 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control" id="client_lname" name="client_lname" required="required" placeholder="Last Name">
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                     </div>

					 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="client_email" name="client_email" required="required" placeholder="Email">
                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control" id="client_phone" name="client_phone" required="required" placeholder="Phone">
                        <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
					</div>

					<div class="col-md-9 col-sm-9 col-xs-18 form-group has-feedback" style="margin-bottom:20px;">
                        <input type="text" class="form-control has-feedback-left" id="client_address" name="client_address" required="required" placeholder="Address">
                        <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-3 col-sm-3 col-xs-6 form-group has-feedback" style="margin-bottom:20px;">
                        <input type="text" class="form-control" id="client_position" name="client_position" required="required" placeholder="Position">
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
					</div>

					<h2 class="StepTitle" style="text-align:center; ">Company Information</h2>
                    <div class="form-group col-md-12 col-sm-12 col-xs-24">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Company Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="company-name" name="company-name" required="required" class="form-control col-md-7 col-xs-12" name="company-name">
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-24">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Address <span class="required">*</span>
						</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="company-address" name="company-address" required="required" class="form-control col-md-7 col-xs-12" name="company-address">
                        </div>
                    </div>
					<div class="form-group col-md-12 col-sm-12 col-xs-24">
                        <label  class="control-label col-md-3 col-sm-3 col-xs-12">Telephone No. <span class="required">*</span>
						</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="company-phone" name="company-phone" required="required" class="form-control col-md-7 col-xs-12" name="company-address">
                        </div>
                    </div>
					<div class="form-group col-md-12 col-sm-12 col-xs-24" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email Address <span class="required">*</span>
						</label>
                        <div class="col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 1%">
                            <input type="text" id="company-email" name="company-email" required="required" class="form-control col-md-7 col-xs-12" name="company-address">
                        </div>
					</div>
                </div>
                <div class="modal-footer"style="margin-top: 0%">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" >Edit Details</button>
                </div>
				</form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


	<div class="modal fade" id="editTask" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Edit Task</h4>
                    </div>
                    <div class="modal-body">
                    <form method="post" action="/editProjectTask">
					{{csrf_field()}}
					<input type="hidden" id="proj_no" name="proj_no">
					<input type="hidden" id="id" name="id">
                      <div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="task-title" name="task-title" required="required" placeholder="Task Title *">
                        <span class="fa fa-pencil-square-o form-control-feedback left" aria-hidden="true"></span>
                      </div>

                    <div class="col-md-12 col-sm-12 col-xs-24 form-group has-feedback">
					   <label> Assigned Milestone</label>
                        <select class="form-control" id="select_taskphase" name="select_taskphase">
                            <option value="" disabled selected>Select Milestone</option>
							@php $phase2 = $phase @endphp
                            @foreach($phase2 as $phase2)
								<option value="{{$phase2->pp_id}}">{{$phase2->phase_title}} : {{$phase2->phase_description}} </option>
							@endforeach
                         </select>
                    </div>

                    <div class="col-md-6 col-sm-5 col-xs-12 form-group has-feedback">
					   <label> Task Status</label>
                        <select class="form-control" id="select_taskstatus" name="select_taskstatus">
                            <option value="" disabled selected>Select Project Status</option>
							<option value="Pending">Pending</option>
                            <option value="On Going">On Going</option>
                            <option value="Complete">Complete</option>
                         </select>
                    </div>

					<div class="col-md-6 col-sm-5 col-xs-12 form-group has-feedback">
					   <label> Percentage Complete</label>
                        <select class="form-control" id="select_taskpercent" name="select_taskpercent">
                            <option value="0">0%</option>
                            <option value="10">10%</option>
                            <option value="20">20%</option>
							<option value="30">30%</option>
                            <option value="40">40%</option>
                            <option value="50">50%</option>
                            <option value="60">60%</option>
                            <option value="70">70%</option>
							<option value="80">80%</option>
                            <option value="90">90%</option>
                            <option value="100">100%</option>
                         </select>
                    </div>

					<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					   <label> Estimated Budget </label>
                        <input type="text" disabled="disabled" class="form-control" id="task_total_cost" name="task_total_cost" required="required" >
                    	<span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
					</div>

					<div class="col-md-6 col-sm-5 col-xs-12 form-group has-feedback">
					   <label> Expense</label>
                        <input type="text" class="form-control" id="task_expense" name="task_expense" required="required" >
                    	<span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
					</div>

					<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
					   <label> Start Date </label>
                        <input type="date" class="form-control" id="start_task" name="start_task" required="required" >
                        <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
					  </div>

					<div class="col-md-6 col-sm-5 col-xs-12 form-group has-feedback">
					   <label> Deadline</label>
                        <input type="date" class="form-control" id="end_task" name="end_task" required="required" >
						<span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
					</div>

					<div id="divreasondelay" class="form-group col-md-12 col-sm-12 col-xs-24" style="margin-top:5px; display: none;">
						<label >Reson of Delay</label>
						<textarea class="resizable_textarea form-control" name-="reason-delay" id="reason-delay" name="reason-delay" rows="5" cols="30" required ></textarea>
					</div>

					<div id="divreasonexpense" class="form-group col-md-12 col-sm-12 col-xs-24" style="margin-top:5px; display: none;">
						<label >Reason of Over Expense</label>
						<textarea class="resizable_textarea form-control" name-="reason-expense" id="reason-expense" name="reason-expense" rows="5" cols="30" required ></textarea>
					</div>

					<div id="alert" class="alert alert-success col-md-12 col-sm-12 col-xs-24" style="display: none; margin-top: 5%;">
						The task <strong id="tasknme"> </strong> was completed on <strong id="date_completed"> </strong>
					</div>

                    </div>
                    <div class="modal-footer"style="margin-top: 0%">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Edit</button>
                    </div>
					</form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

   
    <div class="modal fade" id="editEquipment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Edit Details</h4>
          </div>
          <div class="modal-body">
		    <form method="post" action="/editEquipment">
		      {{csrf_field()}}
              <input type="hidden" id="id" name="id">

              <div class="form-group col-md-12 col-sm-12 col-xs-24" >
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Category</label>
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <input type="text" class="form-control has-feedback-left" id="category" name="category" disabled>
                  <span class="fa fa-truck form-control-feedback left" aria-hidden="true"></span>
                </div>
              </div>
            
              <div class="form-group col-md-12 col-sm-12 col-xs-24" >
                <label class="control-label col-md-3 col-sm-6 col-xs-12">Serial/Model/Plate No.</label>
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <input type="text" class="form-control has-feedback-left" id="info" name="info" disabled>
                  <span class="fa fa-truck form-control-feedback left" aria-hidden="true"></span>
                </div>
              </div>

              <div class="form-group col-md-12 col-sm-12 col-xs-24" >
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Start date</label>
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <input type="date" class="form-control has-feedback-left" id="startdate" name="startdate" disabled>
                  <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                </div>
              </div>

              <div class="form-group col-md-12 col-sm-12 col-xs-24" >
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Total days</label>
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <input type="number" class="form-control has-feedback-left" id="totaldays" name="totaldays" disabled>
                  <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                </div>
              </div>

              <div class="form-group col-md-12 col-sm-12 col-xs-24" >
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Capacity</label>
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <input type="text" class="form-control has-feedback-left" id="capacity" name="capacity" disabled>
                  <span class="fa fa-balance-scale form-control-feedback left" aria-hidden="true"></span>
                </div>
              </div>

              <div class="form-group col-md-12 col-sm-12 col-xs-24" >
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                <div class="input-field col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <select class="form-control status" id="status" name="status">
                    <option value="" selected disabled>Select Status</option>
                    <option value="Defective">Defective</option>
                    <option value="Deployed">Deployed</option>
                    <option value="Maintenance">Maintenance</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer"style="margin-top: 0%">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success" >Edit Details</button>
            </div>
		  </form>
            <!-- /.modal-content -->
        </div>
      </div>
    </div>
    <!-- /.modal -->
    <div class="modal fade" id="equipmentMaintenance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Maintenance Details</h4>
          </div>
          <div class="modal-body">
		    <form method="post" action="/editEquipmentMaintenance">
		      {{csrf_field()}}
              <input type="hidden" id="id" name="id">
              <input type="hidden" id="today" name="today">
              <div class="form-group col-sm-6">
                <div class="form-group col-md-12 col-sm-12 col-xs-24">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Drivers Name</label>
                  <div class="col-md-8 col-sm-8 col-xs-12 form-group has-feedback">
                    <input type="text" class="form-control has-feedback-left" id="driver" name="driver" placeholder="Drivers Name">
                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                  </div>
                </div>

                <div class="form-group col-md-12 col-sm-12 col-xs-24">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Repaired By</label>
                  <div class="col-md-8 col-sm-8 col-xs-12 form-group has-feedback">
                    <input type="text" class="form-control has-feedback-left" id="repairedby" name="repairedby" placeholder="Repaired By">
                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                  </div>
                </div>
                
                <div class="form-group col-md-12 col-sm-12 col-xs-24">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Started</label>
                  <div class="col-md-8 col-sm-8 col-xs-12 form-group has-feedback">
                    <input type="date" class="form-control has-feedback-left" id="datestarted" name="datestarted">
                    <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                    </div>
                </div>

                <div class="form-group col-md-12 col-sm-12 col-xs-24">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Completed</label>
                  <div class="col-md-8 col-sm-8 col-xs-12 form-group has-feedback">
                    <input type="date" class="form-control has-feedback-left" id="datecompleted" name="datecompleted">
                    <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                  </div>
                </div>

                <div class="form-group col-md-12 col-sm-12 col-xs-24">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Checked By</label>
                  <div class="col-md-8 col-sm-8 col-xs-12 form-group has-feedback">
                    <input type="text" class="form-control has-feedback-left" id="checkedby" name="checkedby" placeholder="Checked By">
                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                  </div>
                </div>

                <div class="form-group col-md-12 col-sm-12 col-xs-24">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Checked Date</label>
                  <div class="col-md-8 col-sm-8 col-xs-12 form-group has-feedback">
                    <input type="date" class="form-control has-feedback-left" id="checkeddate" name="checkeddate">
                    <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                  </div>
                </div>

                <div class="form-group col-md-12 col-sm-12 col-xs-24">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Location</label>
                  <div class="col-md-8 col-sm-8 col-xs-12 form-group has-feedback">
                    <input type="text" class="form-control has-feedback-left" id="location" name="location" placeholder="Location/Address">
                    <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
                  </div>
                </div>  
              </div>
              <div class="form-group col-sm-6">
                <div class="form-group col-md-12 col-sm-12 col-xs-24">
                  <label class="control-label col-md-5 col-sm-5 col-xs-12">Problems Encountered</label>
                  <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                    <textarea class="resizable_textarea form-control" id="problems" name="problems" rows="6" cols="70" placeholder="Maximum of 500 characters"></textarea>
                  </div>
                </div>

                <div class="form-group col-md-12 col-sm-12 col-xs-24">
                  <label class="control-label col-md-5 col-sm-5 col-xs-12">Details of Work Done</label>
                  <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                    <textarea class="resizable_textarea form-control" id="details" name="details" rows="7" cols="70" placeholder="Maximum of 500 characters"></textarea>
                  </div>
                </div>
              </div>

            </div>
            <div class="modal-footer"style="margin-top: 0%">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success" >Save</button>
            </div>
		  </form>
            <!-- /.modal-content -->
        </div>
      </div>
    </div>
    <!-- /.modal -->
    <div class="modal fade" id="equipmentRequest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Request Details</h4>
          </div>
          <div class="modal-body">
		    <form method="post" action="/addEquipmentRequest">
		      {{csrf_field()}}
              <input type="hidden" id="id" name="id">
              <div class="form-group col-md-12 col-sm-12 col-xs-24">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Request No</label>
                <div class="col-md-8 col-sm-8 col-xs-12 form-group has-feedback">
                  <input type="number" class="form-control has-feedback-left" id="requestno" name="requestno" placeholder="0000">
                  <span class="fa fa-asterisk form-control-feedback left" aria-hidden="true"></span>
                </div>
              </div>
              
              <div class="form-group col-md-12 col-sm-12 col-xs-24">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Item</label>
                <div class="col-md-8 col-sm-8 col-xs-12 form-group has-feedback">
                  <input type="text" class="form-control has-feedback-left" id="item" name="item" readonly>
                  <span class="fa fa-truck form-control-feedback left" aria-hidden="true"></span>
                </div>
              </div>

              <div class="form-group col-md-12 col-sm-12 col-xs-24">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Quantity</label>
                <div class="col-md-8 col-sm-8 col-xs-12 form-group has-feedback">
                  <input type="number" class="form-control has-feedback-left" id="quantity" name="quantity" placeholder="0" required>
                  <span class="fa fa-asterisk form-control-feedback left" aria-hidden="true"></span>
                </div>
              </div>
                
              <div class="form-group col-md-12 col-sm-12 col-xs-24">
                <label class="control-label col-md-5 col-sm-5 col-xs-12">Remarks<small>(optional)</small></label>
                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                  <textarea class="resizable_textarea form-control" id="remarks" name="remarks" rows="6" cols="70" placeholder="Maximum of 100 characters"></textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer"style="margin-top: 0%">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success" >Send</button>
            </div>
		  </form>
            <!-- /.modal-content -->
        </div>
      </div>
    </div>
    <!-- /.modal -->


<div class="modal fade" id="reqtimeext" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Edit Task</h4>
                    </div>
                    <div class="modal-body">
                    <form method="post" action="/reqtimeext">
					{{csrf_field()}}
					<input type="hidden" id="proj-no" name="proj-no">
						<table style="width:100%; border: 1.5px solid black;">
							<thead style="background-color: #f9f500; color:#000000; border: 1.5px solid black;">
								<tr style="font-size: 1.15em;">
									<td colspan="2" style="padding: 7px;"> &nbsp; I. PROJECT DESCRIPTION</td>
								</tr>
							</thead>
							<tbody>
								<tr style="border-bottom: 1.5px solid #494949;">
									<th style="background-color: #353959; color:#ffffff; width:40%; font-size: 1.1em;">
										&nbsp;&nbsp;&nbsp;&nbsp;Project Title
									</th>
									<td class="proj-title" style="width: 60%; font-size: 1em; color:black; padding: 7px; text-align: center;">
									</td>
								</tr>
								<tr style="border-bottom: 1.5px solid #494949;">
									<th style="background-color: #353959; color:#ffffff; width:40%; font-size: 1.1em;">
										&nbsp;&nbsp;&nbsp;&nbsp;Project Manager
									</th>
									<td class="proj-manager" style="width: 60%; font-size: 1em; color:black; padding: 7px; text-align: center;">
									</td>
								</tr>
								<tr style="border-bottom: 1.5px solid #494949;">
									<th style="background-color: #353959; color:#ffffff; width:40%; font-size: 1.1em;">
										&nbsp;&nbsp;&nbsp;&nbsp;Start Date
									</th>
									<td class="start-date" style="width: 60%; font-size: 1em; color:black; padding: 7px; text-align: center;">
									</td>
								</tr>
								<tr style="border-bottom: 1.5px solid #494949;">
									<th style="background-color: #353959; color:#ffffff; width:40%; font-size: 1.1em;">
										&nbsp;&nbsp;&nbsp;&nbsp;End Date
									</th>
									<td class="end-date" style="width: 60%; font-size: 1em; color:black; padding: 7px; text-align: center;">
									</td>
								</tr>
								<tr style="border-bottom: 1.5px solid #494949;">
									<th style="background-color: #353959; color:#ffffff; width:40%; font-size: 1.1em;">
										&nbsp;&nbsp;&nbsp;&nbsp;Project Duration
									</th>
									<td class="proj-duration" style="width: 60%; font-size: 1em; color:black; padding: 7px; text-align: center;">
									</td>
								</tr>
							</tbody>
						</table>
						
						<table style="width:100%; border: 1.5px solid black;">
							<thead style="background-color: #f9f500; color:#000000; border: 1.5px solid black;">
								<tr style="font-size: 1.15em;">
									<td colspan="2" style="padding: 7px;"> &nbsp; II. REQUEST INFORMATION</td>
								</tr>
							</thead>
							<tbody>
								<tr style="border-bottom: 1.5px solid #494949;">
									<th style="background-color: #353959; color:#ffffff; width:40%; font-size: 1.1em;">
										&nbsp;&nbsp;&nbsp;&nbsp;Number of Days
									</th>
									<td style="width: 60%; font-size: 1em; color:black; padding: 7px; text-align: center;">
										<input type="text" name="ter-duration" id="ter-duration" style="text-align: center; border:none;">
									</td>
								</tr>
								<tr style="border-bottom: 1.5px solid #494949;">
									<th style="background-color: #353959; color:#ffffff; width:40%; font-size: 1.1em;">
										&nbsp;&nbsp;&nbsp;&nbsp;Reason of Delay
									</th>
									<td style="width: 60%; font-size: 1em; color:black; padding: 7px; text-align: center;">
										<select class="form-control" id="ter-reason" name="ter-reason">
											<option disabled selected>Choose cause of project delay</option>
											<optgroup label="Client-related Factors">
												<option value="Delay in progress payments">Delay in progress payments</option>
												<option value="Change orders by client during construction">Change orders by client during construction</option>
											</optgroup>
											<optgroup label="Contractor-related Factors">
												<option value="Rework due to errors during construction">Rework due to errors during construction</option>
												<option value="Shortage of labors ">Shortage of labors </option>
											</optgroup>
											<optgroup label="Supplies & Equipment-related Factors">
												<option value="Shortage of construction materials">Shortage of construction materials</option>
												<option value="Shortage of equipment">Shortage of equipment</option>
												<option value="Equipment breakdowns">Equipment breakdowns</option>
												<option value="Wrong selection of equipment">Wrong selection of equipment</option>
											</optgroup>
											<optgroup label="External-related Factors">
												<option value="Natural disasters & Inclement weather">Natural disasters & Inclement weather	</option>
												<option value="Accident during construction">Accident during construction</option>
												<option value="Delay in providing services from utilities (such as water, electricity)">Delay in providing services from utilities (such as water, electricity)</option>
											</optgroup>
										</select>
									</td>
								</tr>
								
								<tr style="border-bottom: 1.5px solid #494949;">
									<th style="background-color: #353959; color:#ffffff; width:40%; font-size: 1.1em;">
										&nbsp;&nbsp;&nbsp;&nbsp;Other Remarks <small> (optional)</small>
									</th>
									<td style="width: 60%; font-size: 1em; color:black; padding: 7px; text-align: center;">
										<textarea class="resizable_textarea form-control" name-="ter-remarks" id="ter-remarks" name="ter-remarks" rows="8" cols="50"></textarea>
									</td>
								</tr>
							</tbody>
						</table>
                                
                    </div>
					<div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Add Time Extension Request</button>
                    </div>
					</form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->	

	<script>
	// Get data for editClient Modal
		$('#editclient').click(function () {
        $.ajax
        ({
            type : "get",
            url : '/getClientCompany',
            data : {"id" : $(this).data('id')},
            dataType: "json",
            success: function(response) {
                response.forEach(function(data){
                    $('#editClient #id').val(data.proj_no);
                    $('#editClient #client_fname').val(data.cr_first_name);
                    $('#editClient #client_lname').val(data.cr_last_name);
                    $('#editClient #client_email').val(data.cr_email);
                    $('#editClient #client_phone').val(data.cr_contact);
                    $('#editClient #client_address').val(data.cr_address);
                    $('#editClient #client_position').val(data.cr_position);
                    $('#editClient #company-name').val(data.cl_company);
                    $('#editClient #company-address').val(data.cl_address);
                    $('#editClient #company-phone').val(data.cl_contact);
                    $('#editClient #company-email').val(data.cl_email);
                })
            }
        });
        $('#editClient').modal('show');
	});
      
      
    //equipment  
    $('#editequipment').click(function () {
      $.ajax
        ({
            type : "get",
            url : '/getEquipment',
            data : {"id" : $(this).data('id')},
            dataType: "json",
            success: function(response) {
                response.forEach(function(data){
                    $('#editEquipment #id').val(data.ei_id);
                    $('#editEquipment #category').val(data.ec_category);
                    $('#editEquipment #info').val(data.ei_serial_model_plate);
                    $('#editEquipment #capacity').val(data.ei_capacity_qty+data.ei_capacity_unit);
                    $('#editEquipment #startdate').val(data.ed_start_date);
                    $('#editEquipment #totaldays').val(data.ed_total_days);
                    $('#editEquipment #status').val(data.ei_status);
                })
            }
        });
        $('#editEquipment').modal('show');
	});
    $('#equipmentmaintenance').click(function () {
      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth()+1; //January is 0!
      var yyyy = today.getFullYear();
      var date_start;
      var date_completed;
      var checkeddate;
      if(dd<10) {
        dd = '0'+dd
      } 

      if(mm<10) {
        mm= '0'+mm
      } 

      today = yyyy + '-' + mm  + '-' + dd;
        //console.log(today);
        $.ajax
        ({
            type : "get",
            url : '/getEquipmentMaintenance',
            data : {"id" : $(this).data('id')},
            dataType: "json",
            success: function(response) {
                response.forEach(function(data){
                    $('#equipmentMaintenance #id').val(data.ed_id);
                    $('#equipmentMaintenance #today').val(today);
                    $('#equipmentMaintenance #driver').val(data.ejr_driver_name);
                    $('#equipmentMaintenance #repairedby').val(data.ejr_repaired_by);
                    if(data.ejr_date_start == '1111-11-11'){
                      date_start = '';
                    }
                    if(data.ejr_date_completed == '1111-11-11'){
                      date_completed = '';
                    }
                    if(data.ejr_checked_date == '1111-11-11'){
                      checkeddate = '';
                    }
                    $('#equipmentMaintenance #datestarted').val(date_started);
                    $('#equipmentMaintenance #datecompleted').val(date_completed);
                    $('#equipmentMaintenance #checkedby').val(data.ejr_checkedby);
                    $('#equipmentMaintenance #checkeddate').val(checkeddate);
                    $('#equipmentMaintenance #location').val(data.ejr_location);
                    $('#equipmentMaintenance #problems').val(data.ejr_problems);
                    $('#equipmentMaintenance #details').val(data.ejr_workdone);
                })
            }
        });
        $('#equipmentMaintenance').modal('show');
	});
    $('#equipmentrequest').click(function () {
      $.ajax
        ({
          type : "get",
          url : '/getEquipmentRequest',
          data : {"id" : $(this).data('id')},
          dataType: "json",
          success: function(response) {
              response.forEach(function(data){
                  $('#equipmentRequest #id').val(data.ejr_no);
                  $('#equipmentRequest #item').val(data.ec_category);
                  console.log(data.ed_id);
              })
          }
        });
        $('#equipmentRequest').modal('show');
	});
    
      
	// Get data for reqtimeext Modal
	$('.reqtimeext').click(function () {
		$.ajax
        ({
            type : "get",
            url : '/getreqdetails',
            data : {"id" : $(this).data('id')},
            dataType: "json",
            success: function(response) {
                response.forEach(function(data){
                    $('#reqtimeext #proj-no').val(data.proj_no);
                    $('#reqtimeext .proj-title').text(data.pi_title);
					$('#reqtimeext .proj-manager').text(data.emp_first_name + " " + data.emp_middle_initial + " " + data.emp_last_name );
					$('#reqtimeext .start-date').text(data.proj_start_date);
					$('#reqtimeext .end-date').text(data.proj_end_date);
                    $('#reqtimeext #newproj-enddate').val(data.proj_end_date);
						var datestart = new Date(data.proj_start_date);
						var dateend = new Date(data.proj_end_date);
						var duration = (dateend - datestart)/(1000*60*60*24);
					$('#reqtimeext .proj-duration').text(duration + 1);
                })
            }
        });
        $('#reqtimeext').modal('show');
	});
	

	// Get data for editTask Modal
		$('.edittask').click(function () {
        $.ajax
        ({
            type : "get",
            url : '/getProjectTask',
            data : {"id" : $(this).data('id')},
            dataType: "json",
            success: function(response) {
                response.forEach(function(data){
                    $('#editTask #proj_no').val(data.proj_no);
                    $('#editTask #id').val(data.pt_id);
                    $('#editTask #task-title').val(data.task_description);
					$('#editTask #start_task').val(data.pt_start_date).attr({
						"max" : data.pp_end_date,        // substitute your own
						"min" : data.pp_start_date          // values (or variables) here
					});
                    if(data.pt_end_date != '1111-11-11'){
                      $('#editTask #end_task').val(data.pt_end_date).attr({
                          "max" : data.pp_end_date,        // substitute your own
                          "min" : data.pp_start_date          // values (or variables) here
                      });
                    }else{
                      $('#editTask #end_task').attr({
                          "max" : data.pp_end_date,        // substitute your own
                          "min" : data.pp_start_date          // values (or variables) here
                      });
                    }
                    $('#editTask #task_total_cost').val(data.pt_total_cost);
                    $('#editTask #task_expense').val(data.pt_expense);
                    $('#editTask #reason-delay').val(data.pt_reason_delay);
                    $('#editTask #reason-expense').val(data.pt_reason_expense);
                    $('#editTask select option[value="'+data.pt_status+'"]').attr("selected","selected");
                    $('#editTask select option[value="'+data.pt_percentage+'"]').attr("selected","selected");
                    $('#editTask select option[value="'+data.pp_id+'"]').attr("selected","selected");
                    $('#editTask #alert').text("This task '" + data.task_description + "' was completed on " + data.pt_date_completed + ".");
					if (data.pt_percentage == 100) {
						$("#editTask #alert").show("fast"); //Slide Down Effect
					}
					else {
						$("#editTask #alert").hide();
					}
					if (data.pt_expense > data.pt_total_cost ) {
						$("#editTask #divreasonexpense").show();
					}
					else {
						$("#editTask #divreasonexpense").hide();
					}
          var d = new Date();
          var month = d.getMonth()+1;
          var day = d.getDate();
          var output = d.getFullYear() + '-' +
              (month<10 ? '0' : '') + month + '-' +
              (day<10 ? '0' : '') + day;
          if(data.pt_end_date < output && data.pt_end_date != output){
            $("#editTask #divreasondelay").show();
          }else{
            $("#editTask #divreasondelay").hide();
          }
                })
            }
        });
        $('#editTask').modal('show');
	});


		// Get data for editMilestone Modal
		$('.editmilestone').click(function () {
        $.ajax
        ({
            type : "get",
            url : '/getProjectMilestone',
            data : {"id" : $(this).data('id')},
            dataType: "json",
            success: function(response) {
                response.forEach(function(data){
                    $('#editMilestone #proj_no').val(data.proj_no);
                    $('#editMilestone #id').val(data.pp_id);
					$('#editMilestone #pp_start_date').val(data.pp_start_date).attr({
						"max" : data.proj_end_date,        // substitute your own
						"min" : data.proj_start_date          // values (or variables) here
					});
                    $('#editMilestone #pp_end_date').val(data.pp_end_date).attr({
						"max" : data.proj_end_date,        // substitute your own
						"min" : data.proj_start_date          // values (or variables) here
					});
                })
            }
        });
        $('#editMilestone').modal('show');
	});
      $('#notif').click(function () {
		$.ajax
        ({
            type : "get",
            url : '/updatenotif',
            data : {"id" : $(this).data('id')},
            dataType: "json",
            success: function(response) {
				$("#notifcount").hide();
            }
        });
	 });
		function resetit() {
			document.getElementById("project-name").value = "";
			document.getElementById("project-site").value = "";
			document.getElementById("project-desc").value = "";
			$('#project-manager option[value="default"]').prop('selected', true);
		}

		// Task status and percentage
		$('#select_taskpercent').on('change', function(){
			if($('#select_taskpercent').val()==0){
				$('#select_taskstatus option[value="Pending"]').prop('selected', true);
			}else if ($('#select_taskpercent').val()==100){
				$('#select_taskstatus option[value="Complete"]').prop('selected', true);
			}else {
				$('#select_taskstatus option[value="On Going"]').prop('selected', true);
				}
		});
		$('#select_taskstatus').on('change', function(){
			if($('#select_taskstatus').val()=='Pending'){
				$('#select_taskpercent option[value="0"]').prop('selected', true);
			}else if ($('#select_taskstatus').val()=='Complete'){
				$('#select_taskpercent option[value="100"]').prop('selected', true);
			}else {
				$('#select_taskpercent option[value="10"]').prop('selected', true);
				}
		});

		var contype = document.getElementById("contype");
        var floornono= document.getElementById("floor-nono");
        var floorareaa= document.getElementById("floor-areaa");
        var floorno= document.getElementById("floor-no");
        var floorarea= document.getElementById("floor-area");
        var roadtypee= document.getElementById("road-typee");
        var roadlengthh= document.getElementById("road-lengthh");
        var roadtype= document.getElementById("road-type");
        var roadlength= document.getElementById("road-length");

		if (contype.value == "Vertical") {
			roadlength.value = "0" ;
			roadtype.value =  "0" ;
		}
		else {
			floorno.value =  "0" ;
			floorarea.value =  "0" ;
		}

        floornono.style.display = contype.value == "Vertical" ? "block" : "none";
        floorareaa.style.display = contype.value == "Vertical" ? "block" : "none";
        roadlengthh.style.display = contype.value == "Vertical" ? "none" : "display";
        roadtypee.style.display = contype.value == "Vertical" ? "none" : "display";
      
      
	
	$('#notif').click(function () {
		$.ajax
        ({
            type : "get",
            url : '/updatenotif',
            data : {"id" : $(this).data('id')},
            dataType: "json",
            success: function(response) {
				$("#notifcount").hide();
            }
        });
	});
		

       </script>
@stop
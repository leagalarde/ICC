@extends('layouts.dashboardAM') 
@section('page_title','Invoice') 
@section('page_content')

<div class="">

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Request Payment / Invoice <small></small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <section class="content invoice">
            <!-- title row -->
            <div class="row">
              <div class="col-xs-12 invoice-header">
                <h1>
                  <i class="fa fa-globe"></i> Invoice.
                  <small class="pull-right">Date: @php echo date("m/d/Y", (strtotime("now"))) @endphp</small>
                </h1>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                From
                <address>
                  <strong>Alcel Construction, Inc.</strong>
                  <br>Quezon Avenue, Poblacion
                  <br>Alaminos City, Pangasinan
                  <br>Phone: (075) 552-7511
                  <br>Email: alcelconstruction.com
                </address>
              </div>
              <!-- /.col -->
              @foreach($proj as $proj)
              <div class="col-sm-4 invoice-col">
                To
                <address>
                  <strong>{{$proj->cr_first_name}} {{$proj->cr_last_name}}</strong>
                  <br>{{$proj->cl_company}}
                  <br>{{$proj->cl_address}}
                  <br>Phone: {{$proj->cl_contact}}
                  <br>Email: {{$proj->cl_contact}}                               
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <b>Invoice #INVC<?php echo time(); ?></b>
                <br>
                <br>
                <b>Payment Due:</b> <?php echo date("m/d/Y", (strtotime($invoicedue))) ?>
                <br>
                <b>Project No:</b> {{$proj->proj_no}} 
                <br>
                <b>Percentage Accomplished:</b> 	<?php $number = $proj->proj_percentage; echo number_format ( $number , "2" , "." , "," )?> %
                <br>
                <b>Accumulated Percentage:</b> 	<?php $number = $proj->proj_percentage - $invoiceper; echo number_format ( $number , "2" , "." , "," )?> %
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
              <div class="col-xs-12 table">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10%">Item No.</th>
                      <th style="width: 30%">Task Description</th>
                      <th>Unit Cost</th>
                      <th>Qty</th>
                      <th>Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <form method="post" action="/addprojinvoice">
                      {{csrf_field()}}
                      @foreach($invoicetask as $invoicetask)
                      <tr>
                        <td>{{$invoicetask->pt_id}} <input type="hidden" name="pt_id" id="pt_id" value="{{$invoicetask->pt_id}}"></td>
                        <td>{{$invoicetask->task_description}}</td>
                        <td>{{$invoicetask->task_unit_cost}}/{{$invoicetask->task_unit}}</td>
                        <td>{{$invoicetask->pt_qty}}</td>
                        <td>
                          ₱ <?php $number = $invoicetask->pt_total_cost; echo number_format ( $number , "2" , "." , "," )?>
                        </td>
                      </tr>
                      @endforeach
                      <tr style="border-bottom:1px;">
                        <td><strong>TOTAL</strong></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                          <strong>₱ <?php $number = $expense; echo number_format ( $number , "2" , "." , "," )?></strong>
                        </td>
                      </tr>
                      </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <!-- accepted payments column -->
              <div class="col-xs-6" style="text-align:center">		
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; text-align:left">
                  Tasks included in this invoice are tasks included in Contract and Agreement signed by 
                  both parties. Project percentage is also agreed by engineers of both parties.
                </p>
                <input type="hidden" id="proj_no" name="proj_no" value="{{$proj->proj_no}}">
                <input type="hidden" id="proj_percentage" name="proj_percentage" value="{{$proj->proj_percentage}}">
                <input type="hidden" id="invoice_no" name="invoice_no" value="INVC<?php echo time(); ?>">
                <input type="hidden" id="invoice_due" name="invoice_due" value="<?php echo date("Y-m-d", (strtotime($invoicedue))) ?>">
                @if($terno > 0 && $proj->proj_percentage == 100)
                <input type="text" id="invoice_amount" style="display:none" name="invoice_amount" value="<?php  $number = ($expense * (($proj->proj_percentage - $invoiceper) * .01)) + $req_amount; echo number_format ( $number , "2" , ".", "" )?>">
                @else
                <input type="text" id="invoice_amount" style="display:none" name="invoice_amount" value="<?php  $number = $expense * (($proj->proj_percentage - $invoiceper) * .01); echo number_format ( $number , "2" , ".", "" )?>">
                @endif
                <button type="submit" class="btn btn-success "><i class="fa fa-credit-card"></i> Submit and Generate Invoice</button>
              </div>
              <!-- /.col -->
              <div class="col-xs-6">
                <p class="lead">Amount Due <?php echo date("m/d/Y", (strtotime($invoicedue))) ?></p>
                <div class="table-responsive">
                  <table class="table ">
                    <tbody>
                      <tr>
                        <th style="width:50%">
                          <a data-toggle="tooltip" data-placement="top" title="Original Percentage: <?php $number = ($proj->proj_percentage) - $invoiceper; echo number_format ( $number , "2" , 
                          "." , "" )?>">
                            Subtotal (<?php $number = $proj->proj_percentage - $invoiceper; echo number_format ( $number , "2" , "." , "," )?> %):
                          </a>
                        </th>
                        <td>	
                          ₱ <?php $number = $expense * (($proj->proj_percentage - $invoiceper) * .01); echo number_format ( $number , "2" , "." , "," )?>
                        </td>
                      </tr>
                      @if($terno > 0 && $proj->proj_percentage == 100)
                      <tr>
                        <th style="width:50%">Time Extensions:</th>
                        <td>	
                          ₱ <?php $number = $req_amount; echo number_format ( $number , "2" , "." , "," )?>
                        </td>
                      </tr>
                      @endif
                      <tr>
                        <th style="width:50%">Total:</th>
                        <td>	
                          @if($terno > 0)
                          ₱ <?php $number = ($expense * (($proj->proj_percentage - $invoiceper) * .01)) + $req_amount; echo number_format ( $number , "2" , "." , "," )?>
                          @else
                          ₱ <?php $number = $expense * (($proj->proj_percentage - $invoiceper) * .01); echo number_format ( $number , "2" , "." , "," )?>
                          @endif
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  
                  </form>
              </div>
            </div>
            <!-- /.col -->
            </div>
          <!-- /.row -->
          
          @endforeach
          <!-- / foreach($proj as $proj) -->
          </section>
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
    <!-- PNotify -->
    <script src="../vendors/pnotify/dist/pnotify.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.js"></script>

@stop
$(document).ready(function () {
  // Populate select_equip dropdown
  $('#select_equiptype').on('change', function () {
    // console.log($(this).val());
    $('#select_equip').empty();
    $('#select_equip').append('<option value="" selected disabled>Equipment Description</option>');
    var option = "";
    $.ajax({
      type: "get",
      url: '/getEquipList',
      data: {
        "equiptype_id": $(this).val()
      },
      dataType: "json",
      success: function (response) {
        response.forEach(function (data) {
          option += '<option value="' + data.ei_capacity_qty + ' ' + data.ei_capacity_unit + '">' + data.ei_capacity_qty + ' ' + data.ei_capacity_unit + '</option>';
          // console.log(data.ei_manufacturer);
          $("#equip_left").text("0 "+data.ec_category);
        })
        $('#select_equip').append(option);
      }
    });
  });

  // Fill up the form according to select_equip dropdown
  $('#select_equip').on('change', function () {
    $('#quantity').val("");
    $('#equip-capacity').val($('#select_equip').val());
    $.ajax({
      type: "get",
      url: '/getEquipDetails',
      data: {
        "ec_id": $('#select_equiptype').val(),
        "capacity": $('#select_equip').val(),
      },
      dataType: "json",
      success: function (response) {
        response.forEach(function (data) {
          $("#equip-category").val(data.ec_category);
          $("#equip_left").text(data.count+" "+data.ec_category);
          $("#equip-qty").val(data.count);
          //for(x=0;x<e)
        })
        $('#quantity').on('keyup', function(e){
          //console.log($(this).val() +">"+ $("#equip-qty").val());
          if ($(this).val() > $("#equip-qty").val() 
            && e.keyCode != 46
            && e.keyCode != 8
            ) {
           e.preventDefault();     
         $(this).val($("#equip-qty").val());
       }
     });
      }
    });
  });

  // Add equipment to HTML table
  $('#add_equipment').click(function () {
    document.getElementById("submit").disabled = false;
    var new_ecid = document.getElementById("select_equiptype").value;
    //var new_equipfull = document.getElementById("manufacturer-name").value + " " + document.getElementById("serial-model").value;
    var new_equipcategory = document.getElementById("equip-category").value;
    var new_equipcapacity = document.getElementById("equip-capacity").value;
    var new_date = document.getElementById("start-date").value;
    var new_total_days = document.getElementById("total-days").value;
    var new_quantity = document.getElementById("quantity").value;
    var new_name = $('#select_equiptype')
    .find(':selected')
    .attr('data-name');
    //console.log('name=' + new_name);
    //console.log('eiid =' + new_eiid);
    //console.log('date=' + new_date);
    //console.log('total_days=' + new_total_days);
    if (new_name == undefined) {
      alert('Select Equipment Type');
    } else if (new_ecid == '') {
      alert('Select Equipment Description');
    } else if (new_date == '') {
      alert('Select Start date');
    } else if (new_total_days == '' || new_total_days == 0) {
      alert('Total Days must not be equal to 0 or must not be blank');
    } else if (new_quantity == '' || new_quantity == 0) {
      alert('Quantity must not be equal to 0 or must not be blank');
    }else {
      $("#equipment_table")
      .append('<tr><td><input type="hidden" id="ec_id" name="ec_id[]" value="' + new_ecid + '"/>' + new_ecid + 
        '</td><td><input type="hidden" name="category[]" value="' + new_equipcategory + '"/>' + new_equipcategory +
        '</td><td><input type="hidden" id="ei_capacity[]" name="capacity[]" value="' + new_equipcapacity + '"/>' + new_equipcapacity +
        '</td><td><input type="hidden" name="start_date[]" value="' + new_date + '"/>' + new_date + 
        '</td><td><input type="hidden" name="total_days[]" value="' + new_total_days + '"/>' + new_total_days +
        '</td><td><input type="hidden" id="ec_quantity" name="quantity[]" value="' + new_quantity + '"/>' + new_quantity + '</td><td> <a  class="btn btn-danger btn-xs" onclick="delete_equipment( this )"><i class="fa fa-trash-o"></i> Remove </a></td></tr>');

      document.getElementById("select_equiptype").value = "";
      //document.getElementById("manufacturer-name").value = "";
      //document.getElementById("serial-model").value = "";
      document.getElementById("equip-capacity").value = "";
      document.getElementById("start-date").value = "";
      document.getElementById("total-days").value = "";
      document.getElementById("quantity").value = "";

      $('#select_equip').empty();
      $('#select_equip').append('<option value="" selected disabled>Equipment Description</option>');
      $('#select_equiptype option[value="default"]').prop('selected', true);
      //console.log("hey"+$('#ec_id').val());
      $.ajax({
        type: "post",
        url: '/EquipmentPending',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }, 
        dataType: "json",
        contentType: 'application/json; charset=utf-8',
        data: {
          "ec_id": $('#ec_id').val(),
          "quantity": $('#ec_quantity').val(),
        },
        dataType: "json",
        success: function (response) {
          console.log(response);
        }
      });
    } //
  });
});
// Remove equipment to HTML table
function delete_equipment(r) {
  var equipment_table = document.getElementById("equipment_table").rows.length - 1;
  var i = r.parentNode.parentNode.rowIndex;
  if (equipment_table == 1) {
    document.getElementById("submit").disabled = true;
  }
  document.getElementById("equipment_table").deleteRow(i);
}

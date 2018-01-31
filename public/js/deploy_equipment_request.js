$(document).ready(function () {

  // Populate select_equip dropdown
  var req_qty = document.getElementById("req_qty").value;
  var tableCount = $('#equipment_table').length - 1;

  //console.log('hi' + req_qty
  var ec_id = document.getElementById("select_equiptype").value;
  $('#select_equip').empty();
  $('#select_equip').append('<option value="" selected disabled>Equipment Description</option>');
  var option = "";
  $.ajax({
    type: "get",
    url: '/getEquipList',
    data: {
      "equiptype_id": ec_id
    },
    dataType: "json",
    success: function (response) {
      response.forEach(function (data) {
        option += '<option value="' + data.ei_id + '">' + data.ei_manufacturer + ' ' + data.ei_serial_model_plate + '</option>';
        //console.log(data.ei_manufacturer);
      })
      $('#select_equip').append(option);
    }
  });

  // Fill up the form according to select_equip dropdown
  $('#select_equip').on('change', function () {
    //console.log('hi' + $(this).val());
    $.ajax({
      type: 'get',
      url: '/getEquipDetails',
      data: {
        'ei_id': $(this).val()
      },
      dataType: "json",
      success: function (response) {
        response.forEach(function (data) {
          //console.log('yah'+data.ei_manufacturer);
          var capacity = data.ei_capacity_qty + ' ' + data.ei_capacity_unit;
          $('#addEquipment .equipment-id').val(data.ei_id);
          $('#addEquipment .manufacturer-name').val(data.ei_manufacturer);
          $('#addEquipment .serial-model').val(data.ei_serial_model_plate);
          $('#addEquipment .equip-capacity').val(capacity);
        })
      }
    });

  });

  // Add equipment to HTML table
  $('#add_equipment').click(function () {
    var new_eiid = document.getElementById("equipment-id").value;
    var new_equipfull = document.getElementById("manufacturer-name").value + " " + document.getElementById("serial-model").value;
    var new_equipcapacity = document.getElementById("equip-capacity").value;
    var new_date = document.getElementById("start-date").value;
    var new_total_days = document.getElementById("total-days").value;
    var new_name = $('#select_equiptype')
      .find(':selected')
      .attr('data-name');


    if (new_name == undefined) {
      alert('Select Equipment Type');
    } else if (new_eiid == '') {
      alert('Select Equipment Description');
    } else if (new_date == '') {
      alert('Select Start date');
    } else if (new_total_days == '' || new_total_days == 0) {
      alert('Total Days must not be equal to 0 or must not be blank');
    } else {

      tableCount++;
      document.getElementById("tableCount").value = tableCount;
      $("#equipment_table")
        .append('<tr><td><input type="hidden" name="ei_id[]" value="' + new_eiid + '"/>' + new_eiid + '</td><td>' + new_name + " " + new_equipfull + '</td><td>' + new_equipcapacity +
          '</td><td><input type="hidden" name="start_date[]" value="' + new_date + '"/>' + new_date + '</td><td><input type="hidden" name="total_days[]" value="' + new_total_days + '"/>' + new_total_days +
          '</td><td> <a  class="btn btn-danger btn-xs" onclick="delete_equipment( this )"><i class="fa fa-trash-o"></i> Remove </a></td></tr>');

      document.getElementById("equipment-id").value = "";
      document.getElementById("manufacturer-name").value = "";
      document.getElementById("serial-model").value = "";
      document.getElementById("equip-capacity").value = "";
      document.getElementById("start-date").value = "";
      document.getElementById("total-days").value = "";

      $('#select_equip').empty();
      $('#select_equip').append('<option value="" selected disabled>Equipment Description</option>');
      $('#select_equiptype option[value="default"]').prop('selected', true);
    }
  });
});
// Remove equipment to HTML table
function delete_equipment(r) {
  var i = r.parentNode.parentNode.rowIndex;
  if (tableCount > 1) {
    tableCount--;
    tableCount = 0;
  }
  document.getElementById("tableCount").value = tableCount;
  document.getElementById("equipment_table").deleteRow(i);
}

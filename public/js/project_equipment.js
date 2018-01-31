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
          option += '<option value="' + data.ei_id + '">' + data.ei_manufacturer + ' ' + data.ei_serial_model_plate + '</option>';
          // console.log(data.ei_manufacturer);
        })
        $('#select_equip').append(option);
      }
    });
  });

  // Fill up the form according to select_equip dropdown
  $('#select_equip').on('change', function () {
    $.ajax({
      type: 'get',
      url: '/getEquipDetails',
      data: {
        'ei_id': $(this).val()
      },
      dataType: "json",
      success: function (response) {
        response.forEach(function (data) {
          // console.log(data.ei_manufacturer);
          var capacity = data.ei_capacity_qty + ' ' + data.ei_capacity_unit;
          $('#addEquipment .equipment-id').val(data.ei_id);
          $('#addEquipment .manufacturer-name').val(data.ei_manufacturer);
          $('#addEquipment .serial-model').val(data.ei_serial_model_plate);
          $('#addEquipment .equip-capacity').val(capacity);
          // console.log($(this).val());
          $("#manufacturer-name,#serial-model,#equip-capacity")
          .bind("checkval", function (){
            var label = $(this).prev("label");
            label.addClass(showClass);
          }).on("keyup", function (){
            $(this).trigger("checkval");
          }).on("focus", function (){
            $(this).prev("label").addClass(onClass);
          }).on("blur", function (){
            $(this).prev("label").removeClass(onClass);
          }).trigger("checkval");
        })
      }
    });
  });

  // Add equipment to HTML table
  $('#add_equipment').click(function () {
    document.getElementById("submit").disabled = false;
    var new_eiid = document.getElementById("equipment-id").value;
    var new_equipfull = document.getElementById("manufacturer-name").value + " " + document.getElementById("serial-model").value;
    var new_equipcapacity = document.getElementById("equip-capacity").value;
    var new_date = document.getElementById("start-date").value;
    var new_total_days = document.getElementById("total-days").value;
    var new_name = $('#select_equiptype')
    .find(':selected')
    .attr('data-name');
    //console.log('name=' + new_name);
    //console.log('eiid =' + new_eiid);
    //console.log('date=' + new_date);
    //console.log('total_days=' + new_total_days);
    if (new_name == undefined) {
      alert('Select Equipment Type');
    } else if (new_eiid == '') {
      alert('Select Equipment Description');
    } else if (new_date == '') {
      alert('Select Start date');
    } else if (new_total_days == '' || new_total_days == 0) {
      alert('Total Days must not be equal to 0 or must not be blank');
    } else {
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

      $("#manufacturer-name,#serial-model,#equip-capacity")
      .bind("checkval", function (){
        var label = $(this).prev("label");
        if (this.value != ""){
          label.addClass(showClass);
        }else{
          label.removeClass(showClass);
        }
      }).on("keyup", function (){
        $(this).trigger("checkval");
      }).on("focus", function (){
        $(this).prev("label").addClass(onClass);
      }).on("blur", function (){
        $(this).prev("label").removeClass(onClass);
      }).trigger("checkval")
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

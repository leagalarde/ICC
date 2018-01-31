function delete_row(r) {
  //var result = confirm( "Are you sure? Delete row from order?" );
  //if ( result ) {
  var i = r.parentNode.parentNode.rowIndex;
  document.getElementById("equipment_table")
    .deleteRow(i);
  //}
}

function add_equipment() {
  var new_brand = document.getElementById("brand-name")
    .value;
  var new_product = document.getElementById("product-name")
    .value;
  var new_model = document.getElementById("model")
    .value;
  var new_capacity = document.getElementById("equip-capacity")
    .value;
  var new_quantity = document.getElementById("equip-quantity")
    .value;
  var new_id = $('#product-name')
    .find(':selected')
    .attr('data-id');

  $("#equipment_table")
    .append('<tr id="row"><td><input type="hidden" name="product-name[]" value="' + new_id + '"/>' + new_product + '</td><td><input type="hidden" name="brand-name[]" value="' + new_brand + '"/>' + new_brand +
      '</td><td><input type="hidden" name="model[]" value="' + new_model + '"/>' + new_model + '</td><td><input type="hidden" name="capacity[]" value="' + new_capacity +
      '"/><input type="hidden" name="quantity[]" value="' + new_quantity + '"/>' + new_quantity + " " + new_capacity +
      "</td><td> <a  class='btn btn-danger btn-xs' onclick='delete_row( this )'><i class='fa fa-trash-o'></i> Remove </a></td></tr>");

  document.getElementById("product-name")
    .value = "";
  document.getElementById("brand-name")
    .value = "";
  document.getElementById("model")
    .value = "";
  document.getElementById("equip-capacity")
    .value = "";
  document.getElementById("equip-quantity")
    .value = "";

  $('#product-name option[value="default"]')
    .prop('selected', true);
}

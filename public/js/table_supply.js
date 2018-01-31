function delete_row(r) {
  //var result = confirm("Are you sure? Delete row from order?");
  //if (result) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("supply_table")
      .deleteRow(i);
      $(document).ready(function () {
    	  var total = 0;
    	  $('.sum').each(function (index, element) {
    	    total = total + parseFloat($(element).val());
    			//console.log(total,new_price,new_TQuantity);
    			document.getElementById("Total").value = total;
    		});
    	});
    if ( $(this).closest("tbody").find("tr").length === 0 ) {
      document.getElementById("Total").value = 0;
    }
  //}
}
function add_supply() {
	var new_item = document.getElementById("item-name")
    .value;
  var new_brand = document.getElementById("brand")
    .value;
	var new_TQuantity = document.getElementById("TQuantity")
	  .value;
  var new_cap_unit = document.getElementById("capacity-unit")
    .value;
  var new_cap_quantity = document.getElementById("capacity-quantity")
    .value;
	var new_price = document.getElementById("Price")
	  .value * new_TQuantity;
  var new_id = $('#item-name')
    .find(':selected')
    .attr('data-id');

	$("#supply_table")
	  .append( '<tr><td><input type="hidden" name="product-name[]" value="' + new_id + '"/>' + new_item +'</td><td><input type="hidden" name="brand-name[]" value="' + new_brand + '"/>' + new_brand +
		'</td><td><input type="hidden" name="capacity-quantity[]" value="' + new_cap_quantity + '"/><input type="hidden" name="capacity-unit[]" value="' + new_cap_unit + '"/>' + new_cap_quantity + new_cap_unit +
		'</td><td><input type="hidden" name="total-quantity[]" value="' + new_TQuantity + '"/>' + new_TQuantity + '</td><td><input type="hidden" class = "sum" name="price[]" value="' + new_price + '"/>' + new_price +
		"</td><td><a class='btn btn-danger btn-xs' onclick='delete_row( this )'><i class='fa fa-trash-o'></i> Remove </a></td></tr>" );

	$(document).ready(function () {
	  var total = 0;
	  $('.sum').each(function (index, element) {
	    total = total + parseFloat($(element).val());
			//console.log(total,new_price,new_TQuantity);
			document.getElementById("Total").value = total;
		});
	});
  document.getElementById("brand")
    .value = "";
  document.getElementById("item-name")
    .value = "";
  document.getElementById("capacity-unit")
    .value = "";
  document.getElementById("capacity-quantity")
    .value = "0";
	document.getElementById("TQuantity")
	  .value = "0";
	document.getElementById("Price")
		.value = "0";
  $('#item-name option[value="default"]')
    .prop('selected', true);
}

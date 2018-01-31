$( document )
	.ready( function () {

		// Populate select_equip dropdown
		$( '#select_supptype' )
			.on( 'change', function () {
				// console.log($(this).val());
				$( '#select_supp' )
					.empty();
				$( '#select_supp' )
					.append( '<option value="" selected disabled>Supply Description</option>' );
				var option = "";
				$.ajax( {
					type: "get",
					url: '/getSuppList',
					data: {
						"supptype_id": $( this )
							.val()
					},
					dataType: "json",
					success: function ( response ) {
						response.forEach( function ( data ) {
							option += '<option value="' + data.si_no + '">' + data.si_brand + ' ' + data.si_desc + '</option>';
							//console.log(data.si_no+"hi1");
						} )
						$( '#select_supp' )
							.append( option );
					}
				} );
			} );

		// Fill up the form according to select_supp dropdown
		$( '#select_supp' )
			.on( 'change', function () {
				// console.log($(this).val());
				$.ajax( {
					type: 'get',
					url: '/getSuppDetails',
					data: {
						'si_no': $( this )
							.val()
					},
					dataType: "json",
					success: function ( response ) {
						response.forEach( function ( data ) {
							//console.log("hi2" + data.si_no);
							var unit = data.si_cap_qty + ' ' + data.si_cap_unit;
							$( '#addSupplies .supp-no' )
								.val( data.si_no );
							$( '#addSupplies .supp-brand' )
								.val( data.si_brand );
							$( '#addSupplies .supp-unit' )
								.val( unit );
							$( '#addSupplies .supp-available' )
								.val( data.si_quantity );
							$( '#addSupplies .supp-quantity' )
								.attr( {
									"max": data.si_quantity, // substitute your own
									"min": 5 // values (or variables) here
								} );
						} )
					}
				} );

			} );

		// Add equipment to HTML table
		$( '#add_supply' )
			.click( function () {
				var new_suppno = document.getElementById( "supp-no" )
					.value;
				var new_suppunit = document.getElementById( "supp-unit" )
					.value;
				var new_suppquantity = document.getElementById( "supp-quantity" )
					.value;
				var new_suppbrand = document.getElementById( "supp-brand" )
					.value;
				var new_name = $('#select_supptype')
				  .find(':selected')
				  .attr('data-name');

				$( "#supply_table" )
					.append( '<tr><td><input type="hidden" name="supp_no[]" value="' + new_suppno + '"/>' + new_suppno + '</td><td>' + new_name + " " + new_suppbrand +
					'</td><td><input type="hidden" name="supp_quantity[]" value="' + new_suppquantity + '"/>' + new_suppquantity + '</td><td>' + new_suppunit +
					'</td><td> <a class="btn btn-danger btn-xs" onclick="delete_supply( this )"><i class="fa fa-trash-o"></i> Remove </a></td></tr>' );

				document.getElementById( "supp-no" )
					.value = "";
				document.getElementById( "supp-brand" )
					.value = "";
				document.getElementById( "supp-available" )
					.value = "";
				document.getElementById( "supp-unit" )
					.value = "";
				document.getElementById( "supp-quantity" )
					.value = "0";

				$( '#select_supp' )
					.empty();
				$( '#select_supp' )
					.append( '<option value="" selected disabled>Supply Description</option>' );
				$( '#select_supptype option[value="default"]' )
					.prop( 'selected', true );

			} );
	} );


	// Remove equipment to HTML table
	function delete_supply( r ) {
		var i = r.parentNode.parentNode.rowIndex;
		document.getElementById("supply_table").deleteRow(i);
	}

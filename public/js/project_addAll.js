$(document).ready(function($) {
  $("#start-date").datepicker({
    dateFormat: "yy-mm-dd",
    autoclose: true, 
  });       
  $("#contract-date").datepicker({
    dateFormat: "yy-mm-dd",
    autoclose: true, 
  });       
  $( "#start, #end" ).datepicker({
    dateFormat: "yy-mm-dd",
    numberOfMonths: 2,
    onSelect: function( selectedDate ) {
      if(this.id == 'start'){
        var dateMin = $('#start').datepicker("getDate");
        var rMin = new Date(dateMin.getFullYear(), dateMin.getMonth(),dateMin.getDate() + 1); 
        $('#end').datepicker("option","minDate",rMin);
      }

    }
  });
});


var onClass = "on";
var showClass = "show";

function checker(){
  $("#contract-date,#start,#end,#start-date")
  .bind("checkval", function (){
    var label = $(this).prev("label");
    if (this.value !== ""){
      label.addClass(showClass);
    }else{
      label.removeClass(showClass);
    }//if else
  }).on("keyup", function (){
    $(this).trigger("checkval");
  }).on("focus", function (){
    $(this).prev("label").addClass(onClass);
  }).on("blur", function (){
    $(this).prev("label").removeClass(onClass);
  }).trigger("checkval");     
}

$(function (){

  $("input, select, textarea")
  .bind("checkval", function (){
    var label = $(this).prev("label");
    if (this.value !== ""){
      label.addClass(showClass);
    }else{
      label.removeClass(showClass);
          }//if else
        }).on("keyup", function (){
          $(this).trigger("checkval");
        }).on("focus", function (){
          $(this).prev("label").addClass(onClass);
        }).on("blur", function (){
          $(this).prev("label").removeClass(onClass);
        }).trigger("checkval");

        $("select")
        .on("change", function (){
          var $this = $(this);

          if ($this.val() == ""){
            $this.addClass("watermark");
          }else{
            $this.removeClass("watermark");
          }//if else

          $this.trigger("checkval");
        }).change();
      });
$(document).ready(function() {

	// Validate client-phone (INT)
	$('#client_phone').keypress(function(eve) {
		if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0) ) {
      eve.preventDefault();
    }
  });

	// Validate company-phone (INT)
	$('#company-phone').keypress(function(eve) {
		if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0) ) {
      eve.preventDefault();
    }
  });

    // Validate company-phone (INT)
    $('#task-quantity').keypress(function(eve) {
      if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0) ) {
        eve.preventDefault();
      }
    });

    // Validate company-phone (INT)
    $('#total-days').keypress(function(eve) {
      if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0) ) {
        eve.preventDefault();
      }
    });
    
	// Computes plan-price
	$( "#task-quantity" ).keyup(function() {
		var total = 0;

    inpquantity = document.getElementById("task-quantity").value;
    inpcost = document.getElementById("task-cost").value;

    inptotal = inpcost * inpquantity;

    //document.getElementById("task-quantity").value = numberWithCommas(inpquantity);

    total = parseFloat(Math.round(inptotal * 100) / 100).toFixed(2);
    document.getElementById("task-price").value = numberWithCommas(total);


    $(".task-price")
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

  });

	$('#contract-type').on('change',function(){
		var contype = document.getElementById("contract-type");
    var floornono= document.getElementById("floor-nono");
    var floorareaa= document.getElementById("floor-areaa");
    var floorno= document.getElementById("floor-no");
    var floorarea= document.getElementById("floor-area");
    var roadtypee= document.getElementById("road-typee");
    var roadlengthh= document.getElementById("road-lengthh");
    var roadtype= document.getElementById("road-type");
    var roadlength= document.getElementById("road-length");
    floornono.style.display = contype.value == "Vertical" ? "block" : "none";
    floorareaa.style.display = contype.value == "Vertical" ? "block" : "none";
    roadlengthh.style.display = contype.value == "Vertical" ? "none" : "block";
    roadtypee.style.display = contype.value == "Vertical" ? "none" : "block";

    roadlength.value = contype.value == "Vertical" ? "0" : "";
    roadtype.value = contype.value == "Vertical" ? "0" : "";
    floorno.value = contype.value == "Vertical" ? "" : "0";
    floorarea.value = contype.value == "Vertical" ? "" : "0";
    floorno.value = contype.value == "Horizontal" ? "0" : "";
    floorarea.value = contype.value == "Horizontal" ? "0" : "";
    roadlength.value = contype.value == "Horizontal" ? "" : "0";
    roadtype.value = contype.value == "Horizontal" ? "" : "0";
        //roadlengthh.style.display = contype.value == "Vertical" ? "none" : "display";
        //roadtypee.style.display = contype.value == "Vertical" ? "none" : "display";
      });

});


$(function() {
  $('#flash').delay(500).fadeIn('normal', function() {
    $(this).delay(500).fadeOut();
  });
});
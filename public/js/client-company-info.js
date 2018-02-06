$(document).ready(function () {
  $("#client-name, #client-position, #client-phone, #client-email, #company-phone, #company-name, #company-address, #company-email")
  .on('change', function () {
    
  });

  // Fill up the form according to client dropdown
  $('#company').on('change', function () {
    if($(this).val() != 'others' && $(this).val() != null){

      $("#client-name, #client-position, #client-phone, #client-email, #company-phone, #company-name, #company-address, #company-email")
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

      //console.log('hello'+$(this).val());
      $('#client-name').prop("readonly", true);
      $('#client-position').prop("readonly", true);
      $('#client-phone').prop("readonly", true);
      $('#client-email').prop("readonly", true);
      $('#company-name').prop("readonly", true);
      $('#company-address').prop("readonly", true);
      $('#company-phone').prop("readonly", true);
      $('#company-email').prop("readonly", true);
      $.ajax({
        type: 'get',
        url: '/getCompanyDetails',
        data: {
          'cl_no': $(this).val()
        },
        dataType: "json",
        success: function (response) {
          response.forEach(function (data) {
              $('#client-name').val(data.cr_first_name + " " + data.cr_last_name);
              $('#client-position').val(data.cr_position);
              $('#client-phone').val(data.cr_contact);
              $('#client-email').val(data.cr_email);
              $('#company-name').val(data.cl_company);
              $('#company-address').val(data.cl_address);
              $('#company-phone').val(data.cl_contact);
              $('#company-email').val(data.cl_email);
            })
        }
      });
    }else if($(this).val() == 'others'){

      //clearing fields
      $('#client-name').val("");
      $('#client-position').val("");
      $('#client-phone').val("");
      $('#client-email').val("");
      $('#company-name').val("");
      $('#company-address').val("");
      $('#company-phone').val("");
      $('#company-email').val("");
      //enabling fields
      $('#client-name').prop("readonly", false);
      $('#client-position').prop("readonly", false);
      $('#client-phone').prop("readonly", false);
      $('#client-email').prop("readonly", false);
      $('#company-name').prop("readonly", false);
      $('#company-address').prop("readonly", false);
      $('#company-phone').prop("readonly", false);
      $('#company-email').prop("readonly", false);

      $("#client-name, #client-position, #client-phone, #client-email, #company-phone, #company-name, #company-address, #company-email")
      .bind("checkval", function (){
        var label = $(this).prev("label");
        if (this.value != ""){
          label.addClass(showClass);
        }else{
          label.removeClass(showClass);
        }
      }).on("change", function (){
        $(this).trigger("checkval");
      }).on("focus", function (){
        $(this).prev("label").addClass(onClass);
      }).on("blur", function (){
        $(this).prev("label").removeClass(onClass);
      }).trigger("checkval");
    }//if else its not others
  });
});

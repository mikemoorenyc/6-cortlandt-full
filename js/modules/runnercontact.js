function runnercontact() {

  $('.ninja-forms-form label .ninja-forms-req-symbol ').each(function(){
    $(this).remove();
  });
  $('.field-wrap textarea').attr('placeholder', "Message");
  function readyCheck() {
    var ready = true;
    $('.field-wrap input[type=text], textarea').each(function(){
      if($(this).hasClass('ninja-forms-req')) {
        if($(this).val() == '') {
          ready = false;
        }
      }
      //Check if brokerage firm is needed
      if ($('input.status-check.broker').is(':checked')) {
        if($('input.firm').val() == '') {
          ready = false;
        }
      }
      if(ready == false) {
        $('.submit-wrap input[type="submit"]').attr('disabled',true);
      } else {
        $('.submit-wrap input[type="submit"]').removeAttr('disabled');
      }
    });
  }
  readyCheck();
  $('.field-wrap input.status-check').on('change',function(){
    $('.field-wrap input.status-check').prop('checked',false);
    $(this).prop('checked',true);
    if(!$(this).hasClass("broker")) {
      $('.field-wrap.firm-wrap').addClass('__disabled');
    } else {
      $('.field-wrap.firm-wrap').removeClass('__disabled');
    }
    readyCheck();
  });
  $('.field-wrap input[type=text], textarea').on('keypress',readyCheck);
  $('.field-wrap input[type=text], textarea').on('change',readyCheck);



  $('#broker-switcher a').on('click',function(){

    return false;
  });



  $('.ninja-forms-form').submit(function(event){
    event.preventDefault();
    var theForm = $('.ninja-forms-form');
    var formData = $(theForm).serialize();
    $.ajax({
      type: 'POST',
      url: $(theForm).attr('action'),
      data: formData
    })
    .done(function(response) {
      var thedata = jQuery.parseJSON( response);
      console.log(thedata);


    })
    .fail(function(data) {
      alert('There was a problem saving your information. Please try again later.');

    });

  });
}

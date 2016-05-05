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
    $('.submit-wrap input[type="submit"]').attr('disabled',true).val('Sending');
    $.ajax({
      type: 'POST',
      url: $(theForm).attr('action'),
      data: formData
    })
    .done(function(response) {
      $('.submit-wrap input[type="submit"]').removeAttr('disabled').val('Submit');


      var thedata = jQuery.parseJSON( response);
  
      if(thedata.success == false) {
        alert('Please enter a valid email address');
        $('input.email').addClass("errored");
      } else {
        alert('Thank you for your submission. We will get back to you shortly.');
        $('.field-wrap input[type=text], textarea').val('');
        $('.field-wrap').removeClass('errored');
        $('input').removeClass("errored");
      }
      readyCheck();


    })
    .fail(function(data) {
      $('.submit-wrap input[type="submit"]').removeAttr('disabled').val('Submit');

      alert('There was a problem saving your information. Please try again later.');
      readyCheck();
    });

  });
}

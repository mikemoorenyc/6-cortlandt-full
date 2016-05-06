function runnertribeca() {
  $('#mobile-map-key .cats button').on('click',function(e){
    e.preventDefault();
    $('#mobile-map-key .cats button').removeClass('__activated');
    $(this).addClass('__activated');

    $('#mobile-map-key').addClass('__changing');
    var slug = $(this).data('slug');
    var newPoints = $('#map-list li[data-slug="'+slug+'"] ul.points').html();
    //SWITCH IMG
    $('#map-image-container img').removeClass('__activated');
    $('#map-image-container img[data-slug="'+slug+'"]').addClass('__activated');
    $("#mobile-map-key .point-list").fadeOut(250, function(){
      $("#mobile-map-key .point-list").html(newPoints).fadeIn(250,function(){
        $('#mobile-map-key').removeClass('__changing');
      });
    });
  });

  //SLIDE ON DT
  $('#map-list h2').on('click',function(){
    $('#map-list').addClass("__changing");
    $('#map-list li.__activated .point-list').slideUp(250);

    $(this).next().slideDown(250, function(){
      $('#map-list li').removeClass('__activated');
      $(this).parent().addClass("__activated");
      $('#map-list').removeClass("__changing");
    });
    var slug = $(this).parent().data('slug');
    //SWITCH IMG
    $('#map-image-container img').removeClass('__activated');
    $('#map-image-container img[data-slug="'+slug+'"]').addClass('__activated');
    return false;
  });
}

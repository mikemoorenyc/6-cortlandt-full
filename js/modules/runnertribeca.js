function runnertribeca() {
  $('#mobile-map-key .cats button').on('click',function(e){
    e.preventDefault();
    $('#mobile-map-key').addClass('__changing');
    var slug = $(this).data('slug');
    var newPoints = $('#map-list li[data-slug="'+slug+'"] ul.points').html();
    //SWITCH IMG
    $('#map-image-container img').removeClass('__active');
    $('#map-image-container img[data-slug="'+slug+'"]').addClass('__active');
    $("#mobile-map-key .point-list").fadeOut(250, function(){
      $("#mobile-map-key .point-list").html(newPoints).fadeIn(250,function(){
        $('#mobile-map-key').removeClass('__changing');
      });
    });
  });

  //SLIDE ON DT
  $('#map-list h2').on('click',function(){
    $('#map-list li.__activated .points').slideUp(250);
    $('#map-list li').removeClass('__activated');
    $(this).parent().addClass("__activated");
    $(this).next().slideDown(250);
    var slug = $(this).parent().data('slug');
    //SWITCH IMG
    $('#map-image-container img').removeClass('__active');
    $('#map-image-container img[data-slug="'+slug+'"]').addClass('__active');
    return false;
  });
}

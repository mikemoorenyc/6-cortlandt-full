$('.sub-nav button').on('click',function(e){
  e.preventDefault();

  var anchor = $(this).attr('data-target');

  $('html,body').animate({scrollTop:($('div[data-anchor="'+anchor+'"]').offset().top-$('header').height()+1)},250);

});

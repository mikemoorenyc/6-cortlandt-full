function runnerbuilding() {
  if($(window).width()< 1000) {
    $('#home-header img').height($(window).height() - ($('header').height() + $('#home-header h1').height()) );
  }

  $('#amen-list .copy-box').each(function(){
    var mh = $(this).find('.intro').height();
    $(this).attr('data-min', (mh+5) ).attr('data-max', $(this).find('.inner').height()+5);
    $(this).css({
      'height': (mh+5)+'px',
    });
  });
  $('#amen-list .read-more').on('click',function(){
    if(!$(this).prev().hasClass('__opened')) {
      var nh = $(this).prev().attr('data-max');
      $(this).prev().addClass('__opened').height(nh);
      $(this).text('Read Less');
    } else {
      var nh = $(this).prev().attr('data-min');
      $(this).prev().removeClass('__opened').height(nh);
      $(this).text('Read More');
    }

    return false;
  });

  $('a.go-down').on('click',function(){
    var parent = $(this).closest('#home-header');

    $('html,body').animate({scrollTop:($(parent).next().offset().top-$('header').height())},250)
    return false;
  });

  //HISTORY list

  $('#history-list li.even').each(function(){
    if($(window).width() >= 1000) {
      $(this).find('.copy').after($(this).find('.aside'));
    }
  });
}

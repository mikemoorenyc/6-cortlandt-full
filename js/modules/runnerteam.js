function runnerteam() {
  $('#team-list a.read-more').on('click',function(){
    if(!$(this).hasClass('__opened')) {
      var copy = $(this).prev();
      var h = $(copy).find('.inner').height();
      $(copy).height(h);
      $(this).text('Read Less').addClass('__opened');
    } else {
      $(this).text('Read More').removeClass('__opened');
      $(this).prev().removeAttr('style');
    }

    return false;
  });
}

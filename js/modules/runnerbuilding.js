function runnerbuilding() {
  if($(window).width()< 1000) {
    $('#home-header img').height($(window).height() - ($('header').height() + $('#home-header h1').height()) );
  }
}

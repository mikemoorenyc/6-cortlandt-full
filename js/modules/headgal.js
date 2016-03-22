function headGal() {
  if($('#header-gallery').find('.slide').length < 1) {
    return;
  }
  //First Slide IMG
  var firstImg = $('#header-gallery').find('.slide img')[0];

  if (!firstImg.complete) {
		$(this).one('load',function(){
			sliderInit();
		});
	} else {
		sliderInit();
	}


  function sliderInit() {
    $('#header-gallery .container').slick({
      'arrows': false,
      'dots': true
    });
  }
}

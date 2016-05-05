function siteInit() {
  //DECLARE GLOBAL APP HERE
  var myApp = {
    siteDir: phpvars_siteDir,
    ww: $(window).width(),
    wh: $(window).height(),
    dt: 801,
    tab: 401,
    ts: 500,
    currentPosition: '',
    orientation : function() {
      function decider(w,x) {
        if (w >= x) {
        $('html').addClass('_orientation-landscape').removeClass('_orientation-portrait');
        }else {
         $('html').removeClass('_orientation-landscape').addClass('_orientation-portrait');
        }
        //SET THE FOOTER THING
        var fh = $('#footer').height();
        $('#app_wrap').css('padding-bottom', fh+'px');
      }
      decider(this.ww,this.wh);

      $(window).resize(function(){
        this.ww = $(window).width();
        this.wh = $(window).height();
        decider(this.ww,this.wh);
      }.bind(this));

    }
  };
  myApp.orientation();

  //PROGRAMATICALLY Attach Fastclick
  if(Modernizr.touchevents) {
    $(function() {
      FastClick.attach(document.body);
    });
  }

  $('.menu-open, .menu-close').click(function(e){
    e.preventDefault();
    $('html').toggleClass('__menu-opened');
  });

  $('nav .link a').click(function(){
    $('html').removeClass('__menu-opened');
  });




  theHistory();

  //LOAD IN SVG

  $.ajax({
    method: 'GET',
    url: myApp.siteDir+'/assets/svgs.svg',
    dataType: 'html'
  })
  .done(function(data){



    $('body').prepend('<div class="hide">'+data+'</div>');
  });

  $(window).scroll(function(){
    scrollState();
    $('html').removeClass('__menu-opened');
  });

  function scrollState() {
    var currentScroll = $(window).scrollTop();
    currentScroll = currentScroll + $('header').height();
    $("div[data-anchor]").each(function(){
      var s = $(this);
      var top = $(s).offset().top;
      if (top <= currentScroll) {
        $(this).addClass('__above');
      } else {
        $(this).removeClass('__above');
      }
    });
    var currentPos = $('div[data-anchor].__above').last().attr('data-anchor');

    if(currentPos != myApp.currentPosition) {
      $('.sub-nav button').removeClass('__active');
      $('.sub-nav button[data-target="'+currentPos+'"]').addClass("__active");
      myApp.currentPosition = currentPos;
    }
  }




  var firstSlug = $('#main-content-container').data('slug');
  pageLoader(firstSlug);

  $('html').addClass('_page-loaded');
  console.log('scripts loaded');
}

//DON'T TOUCH

siteInit();

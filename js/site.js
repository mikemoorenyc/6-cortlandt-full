function siteInit() {
  //DECLARE GLOBAL APP HERE
  var myApp = {
    siteDir: phpvars_siteDir,
    ww: $(window).width(),
    wh: $(window).height(),
    dt: 801,
    tab: 401,
    ts: 500,
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




  //theHistory();

  //LOAD IN SVG

  $.ajax({
    method: 'GET',
    url: myApp.siteDir+'/assets/svgs.svg',
    dataType: 'html'
  })
  .done(function(data){



    $('body').prepend('<div class="hide">'+data+'</div>');
  });





  var firstSlug = $('#main-content-container').data('slug');
  pageLoader(firstSlug);

  $('html').addClass('_page-loaded');
  console.log('scripts loaded');
}

//DON'T TOUCH

siteInit();

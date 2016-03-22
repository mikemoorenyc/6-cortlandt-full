//PAGE LOADER FUNCTION
function pageLoader(newSlug) {

  headGal();

  $('nav#main-navigation a').removeClass('__active');
  $('nav#main-navigation a[data-slug="'+newSlug+'"]').addClass('__active');

  //SEND CURRENT STATE TO GOOGLE
  var currentURL = window.location.href ;

  if(typeof ga !=='undefined') {
    ga('send', 'pageview', currentURL);
  }

  //MAKE INTERNAL LINKS
  var siteURL = "http://" + top.location.host.toString();
  var internalLinks = $("a[href^='"+siteURL+"'], a[href^='/'], a[href^='./'], a[href^='../']");
  $(internalLinks).addClass('internal');
  $('a.internal').each(function(){
    var linkstr = $(this).attr('href');
    if($(this).attr('target') == "_blank" || linkstr.indexOf('.pdf') >= 0 || linkstr.indexOf('.jpg') >= 0 || linkstr.indexOf('.png') >= 0) {
      $(this).removeClass('internal');
    }
  });



  //RUN PAGE SPECIFIC FUNCTIONS

  /*
  if (typeof window['runner'+theSlug] == 'function') {

    window['runner'+theSlug]();
  } else {

  }
*/


}

function runnerresidences() {
  if($(window).width() >= 1000) {
    $('#living-spaces').append($('#handcrafted-elements img.limg'));
    $('#kitchens').append($('#handcrafted-elements img.rimg'));
    $('#kitchens').append($('#handcrafted-elements .title'));
    $('#home-office').append($('#master-bedrooms .section h1'));
  }
}

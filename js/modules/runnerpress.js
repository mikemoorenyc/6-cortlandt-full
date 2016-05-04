function runnerpresspage() {
  console.log('asfd');
  $('.more-posts-container a.more-posts').on('click',function(){
    var mainBtn = $(this);
    var url = $(this).attr('href');

    $(this).addClass('__loading').text('Loading');
    //$(this).html('<svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#arrows"></use></svg>');
    $.ajax({
      method: 'GET',
      url:url,
      dataType: 'html'
    })
    .done(function(data){

      $('#press-list').append($(data).find('#press-list').html());

      var morePost = $(data).find('.more-posts-container')[0];

      if(!$(morePost).hasClass('empty')) {
        var btn = $(morePost).find('a.more-posts')[0];
        $(mainBtn).removeClass('__loading').text($(btn).text()).attr('href', $(btn).attr('href'));
      } else {
        $(mainBtn).remove();
        $('.more-posts-container').addClass('empty');
      }

    });
    return false;
  });
}

function runnerpresspage() {
  console.log('asfd');
  $('.more-posts-container a.more-posts').on('click',function(){

    var url = $(this).attr('href');

    $(this).addClass('__loading');
    //$(this).html('<svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#arrows"></use></svg>');
    $.ajax({
      method: 'GET',
      url:url,
      dataType: 'html'
    })
    .done(function(data){
      $('.more-posts-container').empty().append($(data).find('.more-posts-container').html());
      $('#press-list').append($(data).find('#press-list').html());

    });
    return false;
  });
}

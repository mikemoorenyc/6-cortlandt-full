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

      $('#press-list').append($(data).find('#press-list').html());
      $('.more-posts-container').remove();
      $('#press-section').append($(data).find('.more-posts-container')[0]);

    });
    return false;
  });
}

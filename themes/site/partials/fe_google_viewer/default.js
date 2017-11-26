$('.viewer-container').click(function(e){
  e.preventDefault();
  $('.viewer-placeholder').hide();
  var googleView = $('#viewer-iframe');
  googleView.attr('src','https://www.google.com/maps/embed?pb=!1m0!4v1501869930931!6m8!1m7!1sfOBA9z1mEbUAAAQvxazcTw!2m2!1d40.77119016639963!2d-73.95632464851832!3f275!4f0!5f0.7820865974627469');
});

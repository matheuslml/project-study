
function getId(url) {
    const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
    const match = url.match(regExp);
    return (match && match[2].length === 11)
      ? match[2]
      : null;
}


$('.video-btn').click(function() {
    const videoId = getId($(this).data( "src" ));
    let videoSrc = `//www.youtube.com/embed/${videoId}`;
    $('#myModal').on('shown.bs.modal', function (e) {
        $("#video").attr('src',videoSrc + "?autoplay=1&amp;controls=1&amp;feature=player_embedded&amp;rel=0&showinfo=0" );
    })
    $('#myModal').on('hide.bs.modal', function (e) {
        $("#video").removeAttr('src');
    })
});

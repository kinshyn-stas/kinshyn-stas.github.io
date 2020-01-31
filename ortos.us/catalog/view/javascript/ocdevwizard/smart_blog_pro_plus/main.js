function show_youtube(youtube_code, block) {
  $(block).html('<iframe width="100%" height="100%" src="https://www.youtube.com/embed/' + youtube_code + '?controls=1&rel=0&showinfo=0&autoplay=1&enablejsapi=1&cc_load_policy=1" frameborder="0" allowfullscreen></iframe>');
}

$(document).ready(function () {
  if ($(".toros-slider").length > 0) {
    $(".toros-slider").owlCarousel({
      loop: true,
      dots: false,
      autoplay: true,
      autoplayTimeout: 4000,
      animateOut: "fadeOut",
      animateIn: "fadeIn",
      slideSpeed: 2000,
      items: 1,
      nav: false,
      smartSpeed: 1000,
    });
  }
  $("#instagram").instastory({
    get: "@TOROSSTEAKHOUSE",
    limit: 9,
    imageSize:240,
    template:
      '<div class="col-md-3 col-6 m-md-3"><a href="{{link}}" rel="noopener" target="_blank"><img src="{{image}}" alt="{{caption}}" class="img-fluid"></a></div>',
  });
  $(window).scroll(function () {
    if ($(window).scrollTop() > $(".toros-banner ").height() ) {
      $(".header").addClass("sticky");
    } else {
      $(".header").removeClass("sticky");
    }
  });
  
});



/*
//map
function initMap() {
		 var uluru = {lat: 30.329381, lng: 76.399730};
		  var map = new google.maps.Map(
		      document.getElementById('map'), {zoom: 4, center: uluru});
		  var marker = new google.maps.Marker({position: uluru, map: map});
		}
/*$(window).scroll(function(){
	    var scroll = $(window).scrollTop();
	    if(scroll < 1){
	        $('.navbar').css('background', 'transparent');
	    } else{
	        $('.navbar').css('background', 'black');
	        $('.navbar').css('transition', 'background 1s');
	    }
});
$(window).scroll(function() {
  $(".slideanim").each(function(){
    var pos = $(this).offset().top;

    var winTop = $(window).scrollTop();
    if (pos < winTop + 600) {
      $(this).addClass("slider");
    }
  });

});
$(document).ready(function(){
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
  if (this.hash !== "") {
    event.preventDefault();
    var hash = this.hash;
    $('html, body').animate({
      scrollTop: $(hash).offset().top
    }, 900, function(){
      window.location.hash = hash;
      });
    }
  });
  $('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 3000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
	});
	$('.nav-item').on('click',function() {
	  $('.navbar-collapse').collapse('hide');
	});
});
*/
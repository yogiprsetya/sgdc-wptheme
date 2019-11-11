function humbMenu() {
	var a = document.getElementById("myTopnav");
	"topnav" === a.className ? a.className += " responsive" : a.className = "topnav"
}

function openSearch() {
	var a = document.getElementById("search");
	"form-search" === a.className ? a.className += " open" : a.className = "form-search"
}

// Populer post
$('.owl-carousel').owlCarousel({
  loop: true,
  margin: 25,
  // nav: false,
  dots: true,
  responsive: {
    0: {
      items:2
    },
    1000: {
      items:4
    }
  }
})


// document.addEventListener("DOMContentLoaded", function() {
// 	var lazyloadImages = document.querySelectorAll("img");
// 	var lazyloadThrottleTimeout;

// 	function lazyload() {
// 			if (lazyloadThrottleTimeout) {
// 					clearTimeout(lazyloadThrottleTimeout)
// 			}
// 			lazyloadThrottleTimeout = setTimeout(function() {
// 					var scrollTop = window.pageYOffset;
// 					lazyloadImages.forEach(function(img) {
// 							if (img.offsetTop < (window.innerHeight + scrollTop)) {
// 									img.src = img.dataset.src;
// 									img.classList.remove('lazy')
// 							}
// 					});
// 					if (lazyloadImages.length == 0) {
// 							document.removeEventListener("scroll", lazyload);
// 							window.removeEventListener("resize", lazyload);
// 							window.removeEventListener("orientationChange", lazyload)
// 					}
// 			}, 20)
//     }
//     document.addEventListener("scroll", lazyload);
//     window.addEventListener("resize", lazyload);
//     window.addEventListener("orientationChange", lazyload)
// })
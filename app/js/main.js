function humbMenu() {
	var a = document.getElementById("myTopnav");
	"topnav" === a.className ? a.className += " responsive" : a.className = "topnav"
}

function openSearch() {
	var a = document.getElementById("search");
	"form-search" === a.className ? a.className += " open" : a.className = "form-search"
}

// Defer Image
var deferImgTag = () => {
  var imgDefer = document.getElementsByTagName('img'),
      imgDefers = document.querySelectorAll('div[data-src]'),
      style = "background-image: url({url})";

  for(var i=0; i < imgDefer.length; i++) {
    if(imgDefer[i].getAttribute('data-src')) {
      imgDefer[i].setAttribute('src', imgDefer[i].getAttribute('data-src'));
      imgDefer[i].classList.remove('lazy');
    }
  }

  for(var i = 0; i < imgDefers.length; i++) {
    imgDefers[i].setAttribute('style', style.replace("{url}", imgDefers[i].getAttribute('data-src')));
    imgDefers[i].classList.remove('lazy');
  }
}

window.onload = function() {
  deferImgTag()
}

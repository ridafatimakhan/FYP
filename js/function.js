function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";

  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}



var $ = jQuery;
function menuHover() {
  if ($(window).width() > 768) {
    $('.menu-item.parent').hover(function (e) {
      e.stopPropagation();
      $('body').addClass('menu-hover');
      $(this).addClass('item-active');
    }, function (e) {
      e.stopPropagation();
      $('body').removeClass('menu-hover');
      $(this).removeClass('item-active');
    });
  } else {
    $('.menu-item.parent > a').click(function (b) {
      b.preventDefault();
      $(this).parent().toggleClass('active');
    });
  }
}

$(document).ready(function () {

  menuHover();

});
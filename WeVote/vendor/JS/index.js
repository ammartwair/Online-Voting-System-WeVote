let navbar = document.getElementById('navbar');
window.onscroll = function(){
    if (window.pageYOffset > 505) {
        navbar.style.backgroundColor = "#00000099";
      } else {
        navbar.style.backgroundColor = "#00000000";
      }
}
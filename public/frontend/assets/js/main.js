(function() {
    if (location.pathname != '/carrito' && location.pathname != '/login') {

        if(window.scrollY > 0){
            let bar = document.getElementById('navPrincipal');
            bar.classList.add('bg-white', 'fixed-top')
        }else{
            let bar = document.getElementById('navPrincipal');
            bar.classList.remove('bg-white', 'fixed-top')
        }

        /* if (document.getElementById('menuScroll').classList.contains('active')) {
            document.getElementById('menuScroll').classList.remove('active', 'show')
        } */
    }

    function fadeout() {
        document.querySelector('.preloader').style.opacity = '0';
        document.querySelector('.preloader').style.display = 'none';
    }
    window.onscroll = function() {
      if (location.pathname != '/login') {
          var header_navbar = document.querySelector(".navbar-area"); var sticky = header_navbar.offsetTop; var backToTo = document.querySelector(".scroll-top"); if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) { backToTo.style.display = "flex"; } else { backToTo.style.display = "none"; }
      }
    };
    let navbarToggler = document.querySelector(".mobile-menu-btn");
    if (navbarToggler) {
      navbarToggler.addEventListener('click', function() { navbarToggler.classList.toggle("active"); });
    }
})();


/*const URLac = location.pathname;

const inicio = document.getElementById('inicio');
const sobre = document.getElementById('sobre');
const contac = document.getElementById('contact');

console.log(URLac);
switch (URLac) {
    case '/':
        inicio.classList.add('active')
        break;
    case '/sobre-nosotros':
        sobre.classList.add('active')
        break;
    case '/contacto':
        contac.classList.add('active')
        break;



}*/

!(function($) {
  "use strict";

  // esto es para el scroll en los dispositivos grandes
  var scrolltoOffset = $('#menu-navegacion').outerHeight() - 1;
  $(document).on('click', '.navbar a, .navbar-toggler a, .scrollto', function(e) {

    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
     
      var target = $(this.hash);
  
      if (target.length) {

        e.preventDefault();

        var scrollto = target.offset().top - scrolltoOffset;
        console.log("scrollto", scrollto);

        if ($(this).attr("href") == '#menu-navegacion') {
          
          scrollto = 0;
        }
        $('#navbarSupporteContent').removeClass('show');
        $('html, body').animate({
          scrollTop: scrollto
        }, 1500, 'easeInOutExpo');

        if ($(this).parents('.navbar, .navbar-toggler').length) {
          console.log("$(this).parents(", $(this).parents());
          $('.navbar .active, .navbar-toggler .active').removeClass('active');
          $(this).closest('li').addClass('active');
          
        }

        if ($('body').hasClass('navbar-toggler-active')) {
          $('body').removeClass('navbar-toggler-active');
          $('.navbar-toggler-toggle i').toggleClass('icofont-navigation-menu icofont-close');
          $('.navbar-toggler-overly').fadeOut();
          
        }
        return false;
      }
    }
  });

  // Activate smooth scroll on page load with hash links in the url
  $(document).ready(function() {
    if (window.location.hash) {
      var initial_nav = window.location.hash;
      if ($(initial_nav).length) {
        var scrollto = $(initial_nav).offset().top - scrolltoOffset;
        $('html, body').animate({
          scrollTop: scrollto
        }, 1500, 'easeInOutExpo');
      }
    }
  });

 
  // Navigation active state on scroll
  var nav_sections = $('section');
  var main_nav = $('.navbar, .navbar-toggler');

  $(window).on('scroll', function() {
    var cur_pos = $(this).scrollTop() + 200;

    nav_sections.each(function() {
      var top = $(this).offset().top,
        bottom = top + $(this).outerHeight();

      if (cur_pos >= top && cur_pos <= bottom) {
        if (cur_pos <= bottom) {
          main_nav.find('a').removeClass('active');
        }
        main_nav.find('a[href="#' + $(this).attr('id') + '"]').addClass('active');
      }
      if (cur_pos < 300) {
        $(".navbar ul:first li:first, .mobile-menu ul:first li:first").addClass('active');
      }
    });
  });

  // Mobile Navigation
  if ($('.navbar').length) {
    var $mobile_nav = $('.navbar').clone().prop({
      class: 'navbar-toggler d-lg-none'
    });
    // $('body').append($mobile_nav);
    // $('body').prepend('<button type="button" class="navbar-toggler-toggle d-lg-none"><i class="icofont-navigation-menu"></i></button>');
    // $('body').append('<div class="navbar-toggler-overly"></div>');

    $(document).on('click', '.navbar-toggler-toggle', function(e) {
      $('body').toggleClass('navbar-toggler-active');
      $('.navbar-toggler-toggle i').toggleClass('icofont-navigation-menu icofont-close');
      $('.navbar-toggler-overly').toggle();
    });

    $(document).on('click', '.navbar-toggler .drop-down > a', function(e) {
      e.preventDefault();
      $(this).next().slideToggle(300);
      $(this).parent().toggleClass('active');
    });

    $(document).click(function(e) {
      var container = $(".navbar-toggler, .navbar-toggler-toggle");
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        if ($('body').hasClass('navbar-toggler-active')) {
          $('body').removeClass('navbar-toggler-active');
          $('.navbar-toggler-toggle i').toggleClass('icofont-navigation-menu icofont-close');
          $('.navbar-toggler-overly').fadeOut();
        }
      }
    });
  } else if ($(".navbar-toggler, .navbar-toggler-toggle").length) {
    $(".navbar-toggler, .navbar-toggler-toggle").hide();
  }

  // Toggle .header-scrolled class to #header when page is scrolled
  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $('#header').addClass('header-scrolled');
    } else {
      $('#header').removeClass('header-scrolled');
    }
  });

  if ($(window).scrollTop() > 100) {
    $('#header').addClass('header-scrolled');
  }

  // Portfolio details carousel
  $(".portfolio-details-carousel").owlCarousel({
    autoplay: true,
    dots: true,
    loop: true,
    items: 3
  });
  $(".visiones-carousel").owlCarousel({
    autoplay: true,
    dots: true,
    loop: true,
    items: 1
  });

  // Back to top button
  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $('.back-to-top').fadeIn('slow');
    } else {
      $('.back-to-top').fadeOut('slow');
    }
  });

  $('.back-to-top').click(function() {
    $('html, body').animate({
      scrollTop: 0
    }, 1500, 'easeInOutExpo');
    return false;
  });

  // Clients carousel (uses the Owl Carousel library)
  $(".clients-carousel").owlCarousel({
    autoplay: true,
    dots: true,
    loop: true,
    responsive: {
      0: {
        items: 2
      },
      768: {
        items: 4
      },
      900: {
        items: 6
      }
    }
  });

  // jQuery counterUp
  $('[data-toggle="counter-up"]').counterUp({
    delay: 10,
    time: 1000
  });

  // Testimonials carousel (uses the Owl Carousel library)
  $(".testimonials-carousel").owlCarousel({
    autoplay: true,
    dots: true,
    loop: true,
    responsive: {
      0: {
        items: 1
      },
      768: {
        items: 2
      },
      900: {
        items: 2
      },
      1400: {
        items: 2
      }
    }
  });

  // Porfolio isotope and filter
  $(window).on('load', function() {
    var portfolioIsotope = $('.portfolio-container').isotope({
      itemSelector: '.portfolio-item',
      layoutMode: 'fitRows'
    });

    $('#portfolio-flters li').on('click', function() {
      $("#portfolio-flters li").removeClass('filter-active');
      $(this).addClass('filter-active');

      portfolioIsotope.isotope({
        filter: $(this).data('filter')
      });
      aos_init();
    });

    // Initiate venobox (lightbox feature used in portofilo)
    $(document).ready(function() {
      $('.venobox').venobox();
    });
  });

  // Init AOS
  function aos_init() {
    AOS.init({
      duration: 1000,
      once: true
    });
  }
  $(window).on('load', function() {
    // $('body').addClass('loaded');
    aos_init();
  });


  
  $("#portada").mousemove( function( e ) {
      $( '.background' ).parallax( -300, e );
      $( '.portada1' )    .parallax( -50  , e );
      $( '.portada2' )    .parallax( -100  , e );
      $( '.portada3' )    .parallax( 10  , e );

      $( '.portada1-2' )    .parallax( 70  , e );
      $( '.portada2-2' )    .parallax( -240  , e );
      $( '.portada3-2' )    .parallax( 25  , e );
      $( '.tienda' )    .parallax( 125  , e );
  });

 
$(".a-logo img").hover(function() {
  var tipo = $(this).attr("tipo");
  console.log("$(this).attr(\"tipo\")", $(this).attr("tipo"));

  if(tipo=="logo"){

    $(this).attr("src","landing/vistas/img/plantilla/logo_inverso.png");
    $(this).attr("tipo","inverso"); 
    var pixs = 1;
    $(".punto").css({"-webkit-filter": "blur("+pixs+"px)","filter": "blur("+pixs+"px)" })     
    $(".punto").removeClass("text-white");
    $(".punto").addClass("text-warning");

  }else{
    var pixs = 0;
    $(this).attr("src","landing/vistas/img/plantilla/logo.png");
    $(this).attr("tipo","logo");  
    $(".punto").removeClass("text-warning"); 
    $(".punto").addClass("text-white");
    $(".punto").css({"-webkit-filter": "blur("+pixs+"px)","filter": "blur("+pixs+"px)" })  
  }
  
});
$(".a-logo img").blur(function() {
  $(this).hide("slow");
  $(this).attr("src","landing/vistas/img/plantilla/logo.png");
   
});
$(".a-logo img").blur(function() {
   $('.punto').css("color", "#FFF");
        
});

// /*=========================================================
// =            movimiento para elegir sucursales            =
// =========================================================*/
// var words = document.getElementsByClassName('word');
// var wordArray = [];
// var currentWord = 0;

// words[currentWord].style.opacity = 1;
// for (var i = 0; i < words.length; i++) {
//   splitLetters(words[i]);
// }

// function changeWord() {
//   var cw = wordArray[currentWord];
//   var nw = currentWord == words.length-1 ? wordArray[0] : wordArray[currentWord+1];
//   for (var i = 0; i < cw.length; i++) {
//     animateLetterOut(cw, i);
//   }
  
//   for (var i = 0; i < nw.length; i++) {
//     nw[i].className = 'letter behind';
//     nw[0].parentElement.style.opacity = 1;
//     animateLetterIn(nw, i);
//   }
  
//   currentWord = (currentWord == wordArray.length-1) ? 0 : currentWord+1;
// }

// function animateLetterOut(cw, i) {
//   setTimeout(function() {
//     cw[i].className = 'letter out';
//   }, i*80);
// }

// function animateLetterIn(nw, i) {
//   setTimeout(function() {
//     nw[i].className = 'letter in';
//   }, 340+(i*80));
// }

// function splitLetters(word) {
//   var content = word.innerHTML;
//   word.innerHTML = '';
//   var letters = [];
//   for (var i = 0; i < content.length; i++) {
//     var letter = document.createElement('span');
//     letter.className = 'letter';
//     letter.innerHTML = content.charAt(i);
//     word.appendChild(letter);
//     letters.push(letter);
//   }
  
//   wordArray.push(letters);
// }

// changeWord();
// setInterval(changeWord, 4000);
const typed = new Typed('.typed', {
  strings: [
    '<span class="sucursal">Elegí tu sucursal</span>',
    '<span class="sucursal">más cercana</span>',
    '<span class="sucursal">ABRIL</span>',
    '<span class="sucursal">siempre CERCA tuyo</span>',
    '<span class="sucursal">ABRIL</span>',
    '<span class="sucursal">Vive</span>',
    '<span class="sucursal">en VOS.</span>'
  ],

  //stringsElement: '#cadenas-texto', // ID del elemento que contiene cadenas de texto a mostrar.
  typeSpeed: 75, // Velocidad en mlisegundos para poner una letra,
  startDelay: 300, // Tiempo de retraso en iniciar la animacion. Aplica tambien cuando termina y vuelve a iniciar,
  backSpeed: 75, // Velocidad en milisegundos para borrrar una letra,
  smartBackspace: true, // Eliminar solamente las palabras que sean nuevas en una cadena de texto.
  shuffle: false, // Alterar el orden en el que escribe las palabras.
  backDelay: 1500, // Tiempo de espera despues de que termina de escribir una palabra.
  loop: true, // Repetir el array de strings
  loopCount: false, // Cantidad de veces a repetir el array.  false = infinite
  showCursor: true, // Mostrar cursor palpitanto
  cursorChar: '|', // Caracter para el cursor
  contentType: 'html', // 'html' o 'null' para texto sin formato
});
 })(jQuery);

var num = 15;

var w = window.innerWidth;
console.log('w: ', w/2);
w_mitad = w/2
console.log("window.innerWidth", window.innerWidth);
var h = window.innerHeight;
console.log("window.innerHeight", window.innerHeight);  

var dirx = [];
var diry = [];

for (i = 0; i < num; i++) {
  //Crear corazon
  let heart = document.createElement("DIV");
  corazon =i % 3
  console.log('corazon: ', corazon);

  switch (corazon) {
    case 0:
      
      heart.className = "heart";
      break;

    case 1:

      heart.className = "heart2";
      break;

    case 2:

      heart.className = "heart3";
      
          break;
  
    
  }

  
  document.body.appendChild(heart);

  //Asignar tamaño       
  let tam = Math.floor((Math.random() * 20) + 15);
  heart.style.width = tam + "px";
  heart.style.height = tam + "px";
  //Asignar posicion inicial
  let posy = Math.floor((Math.random() * 0.1 * h) + 0.8 * h);
  heart.style.top = posy + "px";
  let posx = Math.floor((Math.random() * 0.8 * w) + 0.1 * h);
  console.log('posx: ', posx);
  heart.style.left = posx + "px";
  //Crear vector direccion y id
  heart.id = "h" + i;
  diry[i] = Math.floor((Math.random() * 5) - 10);
  dirx[i] = Math.floor((Math.random() * 10) - 5);
  //Asignar evento
  heart.setAttribute("onclick","deleteheart(this)")
}
// $('.heart').append('<div class="palabraHeart1">¡vive</div>');
// $('.heart').append('<div class="palabraHeart2">¡en vos!</div>')
// $(".heart").append("<div class='corazonpalabra'>abril</div>");
window.requestAnimationFrame(move);
setInterval(function() {
  move()
}, 60);

function move(){
  
  for(i=0;i<num;i++){
    //Seleccion de corazon
    let heart = document.getElementById("h"+i);
    //Aumento de coordenadas
    let y =  parseInt(heart.style.top) + diry[i];
    let x =  parseInt(heart.style.left) + dirx[i];
    //Reinicio de coordenadas
    if (x > 0.8*w) { x = 0.2*w;}
    if (x < 0.2*w) { x = 0.8*w;}
    if (y < 0.2*h) { y = 0.8*h;}
    if (y > 0.8*h) { y = 0.2*w;}
    //Asigmnacion de coordenadas
    heart.style.top = y + "px";
    heart.style.left = x + "px";
  }

  
}
$('.portada').on('mouseover', function(){
  // console.log("estoy encima del drop")
  $('.portada').css("cursor", "pointer");
});




$(".portada").on("click",function(){

  window.location = 'https://www.abrilamoblamientos.com.ar/tienda/'
  
})
$(".btnTienda").on("click",function(){

  window.location = 'https://www.abrilamoblamientos.com.ar/tienda/'
  
})
function deleteheart(element){

  element.style.display = "none";
  
}



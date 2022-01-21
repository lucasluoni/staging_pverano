// IIFE -> a function created and executed inmediately
// Before ECMAScript15 the only way to keep variables in a local scope was to put them inside functions
(function (){
  // turns on strict mode in JS
  'use strict'

  // we just want to make sure that our form elements are ready for us to start adding event listeners to them 
  document.addEventListener('DOMContentLoaded', function(){
    
    // tela de projeto / produto
    function addProductImagesGrid (){
      let imagens = document.querySelectorAll('#produto img')
      imagens.forEach((imagem) => {
        imagem.className = 'col-12 img-fluid'
      })
    }
    addProductImagesGrid()

    // switch 'active' class in between filter buttons (home)
    function switchActiveClass () {
      let homeBody = document.querySelector('body')
      if (homeBody.classList.contains('home')) {
        let btnContainer = document.querySelector("#filtros")
        let btns = btnContainer.querySelectorAll(".btn")    
        btns.forEach((btn) => {
          btn.addEventListener('click', function () {
            let current = btnContainer.querySelectorAll(".active")
            current[0].classList.remove('active')
            this.classList.add('active')
          })
        })
      }    
    }
    switchActiveClass()

    // filter projects after 'active' button
    function filterHomeElements() {    
      const filtros = document.querySelectorAll('#filtros button')
      const filtroResidencial = 'category-residencial'
      const filtroComercial = 'category-comercial'
      const residencial = document.querySelectorAll('.category-residencial')
      const comercial = document.querySelectorAll('.category-comercial')
      const destaque = document.querySelectorAll('.category-destaque')

      filtros.forEach((filtro) => {
        filtro.addEventListener('click', (evt) => {
          let value = evt.target.value
          if (value === filtroComercial) {
            residencial.forEach(item => item.classList.remove('show'))
            comercial.forEach(item => item.classList.add('show'))
          }
          else if (value === filtroResidencial) {
              residencial.forEach(item => item.classList.add('show'))
              comercial.forEach(item => item.classList.remove('show'))
          }
          else {
              residencial.forEach(item => item.classList.remove('show'))
              comercial.forEach(item => item.classList.remove('show'))
              destaque.forEach(item => item.classList.add('show'))
          }
        })
      })

    }
    filterHomeElements()

    // remove wp link hashes
    function removeLinkHashes () {
      // Select all links with hashes
      $('a[href*="#"]')
      // Remove links that don't actually link to anything
      .not('[href="#"]')
      .not('[href="#0"]')
      .click(function(event) {
        // On-page links
        if (
          location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
          && 
          location.hostname == this.hostname
        ) {
          // Figure out element to scroll to
          let target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
          // Does a scroll target exist?
          if (target.length) {
            // Only prevent default if animation is actually gonna happen
            event.preventDefault();
            $('html, body').animate({
              scrollTop: target.offset().top
            }, 1200, function() {
              // Callback after animation
              // Must change focus!
              let $target = $(target);
              $target.focus();
              if ($target.is(":focus")) { // Checking if the target was focused
                return false;
              } else {
                $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                $target.focus(); // Set focus again
              }
            })
          }
        }
      })
    }
    removeLinkHashes()

  })

  //Hide spinnerLoader
  window.addEventListener('load', () => {
    const hideLoader = () => {
      let loader = document.querySelector('.spinner-wrapper')
      loader.style.visibility = 'hidden'
    }
    setTimeout(hideLoader, 2000)
  })

})()
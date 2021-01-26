  <footer>
    <div class="container">
      <div class="row pt-5 pb-4">

        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6">
          <a class="navbar-brand-footer d-inline-block" href="#"></a>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-3 d-none d-sm-none d-md-block">
          <p class="montserrat">Copyright<br /> <span class="text-dark">2020 @Mikka Marcenaria</span></p>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 d-none d-sm-none d-md-block pl-5">
          <p><span class="montserrat">Desenvolvido por</span><br /> <a class="text-dark" href="http://www.arteluz.art.br" target="_blank">ArteLuz</a></p>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6">
            <ul id="nav-social" class="nav justify-content-end">
              <li class="nav-item">
                  <a href="https://www.facebook.com/mikkamarcenariamobiliario/" target="_blank" class="nav-link">
              <i class="fa fa-facebook text-dark" style="font-size:24px;"></i>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="https://www.instagram.com/mikkamarcenaria/" target="_blank" class="nav-link">
              <i class="fa fa-instagram text-dark" style="font-size:24px;"></i>
                </a>
              </li>
            </ul>

  </footer>

  <?php wp_footer(); ?>

  <script type="text/javascript">

  //  Load More Eventos na Home (loop-front-page.php) ////////////////////////////////////////////////////// 
  var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
  var page = 2;
  jQuery(function($) {
    $('body').on('click', '#load_more', function() {
    // alert("Hello! I am an alert box!!");
    $('#loading').stop().hide().fadeIn('fast');
    //$('.loadmore').hide().fadeOut('fast');
    $('#loading').html('<img src="<?php echo get_template_directory_uri(); ?>/images/loading.gif" />');
    // alert("Hello! I am an alert box!!");
      var data = {
        'action': 'load_posts_home_by_ajax',
        'page': page,
        'security': '<?php echo wp_create_nonce("load_more_posts"); ?>'
      };

      $.post(ajaxurl, data, function(response) {
      $('#loading').hide().fadeOut('fast');
      //$('.loadmore').stop().hide().fadeIn('fast');    
        $('.card-columns').append(response);
        page++;
      });
    });
  });

  </script>

  <script>
    
    (function(){
      'use strict';

      var imagens = document.querySelectorAll('#produto img');
      var i;
      for(i = 0; i < imagens.length; i++){
        imagens[i].className = 'col-12 img-fluid';
      }

    })(window,document);

  </script>


  <script>
    
    filterSelection("category-destaque") // Execute the function and show all columns
    
    function filterSelection(c) {
        var x, i;
        x = document.getElementsByClassName("card");
        if (c == "") c = "category-destaque";
        // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
        for (i = 0; i < x.length; i++) {
          w3RemoveClass(x[i], "show");
          if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
        }
    }

    // Show filtered elements
    function w3AddClass(element, name) {
      var i, arr1, arr2;
      arr1 = element.className.split(" ");
      // console.log("o conteúdo de arr1 é: " + arr1[0]);
      arr2 = name.split(" ");
      // console.log("o conteúdo de arr2 é: " + arr2[0]);
      for (i = 0; i < arr2.length; i++) {
        if (arr1.indexOf(arr2[i]) == -1) {
          element.className += " " + arr2[i];
        }
      }
    }

    // Hide elements that are not selected
    function w3RemoveClass(element, name) {
      var i, arr1, arr2;
      arr1 = element.className.split(" ");
      arr2 = name.split(" ");
      for (i = 0; i < arr2.length; i++) {
        while (arr1.indexOf(arr2[i]) > -1) {
          arr1.splice(arr1.indexOf(arr2[i]), 1);
        }
      }
      element.className = arr1.join(" ");
    }

    // Adicione ou remoce a classe 'active' no botão do filtro selecionado (portfolio)
    var btnContainer = document.getElementById("filtros");
    var btns = btnContainer.getElementsByClassName("btn");
    for (var i = 0; i < btns.length; i++) {
      btns[i].addEventListener("click", function(){
        var current = btnContainer.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");
        this.className += " active";
      });
    }

  </script>

  <script>
    $(document).ready(function() {
    //Preloader
    preloaderFadeOutTime = 500;
    function hidePreloader() {
    var preloader = $('.spinner-wrapper');
    preloader.fadeOut(preloaderFadeOutTime);
    }
    hidePreloader();
    });
  </script>

  <script>
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
      var target = $(this.hash);
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
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });
  </script>

  </body>
</html>
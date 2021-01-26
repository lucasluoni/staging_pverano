<?php while ( have_posts() ) : the_post(); //Open the loop ?>
        
  <!-- CONTENT -->

  <div class="container-fluid">

    <div class="row">
      <div class="col px-0">

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    
          <div class="carousel-inner">
            
              <div class="carousel-item active">
                <img class="d-block w-100" src="images/banner-pinturas.jpg" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                <h1 class="display-3"><?php the_title(); ?></h1>
                </div>
              </div>

            </div>

        </div>

      </div>
    </div>

  </div>

  <div class="container-fluid pb-5">
    <div class="container">

      <div id="obras_deck" class="mt-5 mb-0">
        <div class="card-deck">

          <?php 
              $args = array(
                  'post_type' => 'post',
                  'post_status' => 'publish',
                  'posts_per_page' => '-1',
                  'order' => 'DESC',
                  'paged' => 1,
              );
              $my_post
          ?>

          <?php
              $my_posts = new WP_Query( $args );
              if ( $my_posts->have_posts() ) : 
              while ( $my_posts->have_posts() ) : $my_posts->the_post()               
          ?>


          <div id=post-<?php the_ID(); ?> <?php post_class('card'); ?>>
            <img class="card-img-top img-fluid" src=<?php the_post_thumbnail( array(360) ); ?> alt="Card image cap">
            <div class="overlay text-white px-4">
              <h3 class="text-uppercase">2019</h3><!-- aqui vai a categoria, ver como adicionar -->
              <a href=<?php the_permalink(); ?>>ver pinturas</a>
            </div>
          </div>

           
        <?php endwhile; ?>            
        <?php endif; wp_reset_query(); ?>        

        </div><!-- .card-deck -->
      </div><!-- #obras_deck -->

      <!-- <div id="loading" class="mx-auto" style="width:60px;display:block;"></div> -->

      <?php
      // don't display the button if there are not enough posts
      // if (  $my_posts->max_num_pages > 1 )
      //     echo '<button type="button" class="mx-auto mt-5 btn btn-outline-primary mais-eventos-home text-uppercase loadmore d-block rounded-0">+ novidades</button>'; // you can use <a> as well
      ?>

      </div><!-- container py-5 -->
    </div><!-- container-fluid eventosHome -->

    <section class="entry-utility">
        <?php comments_template(); ?>
    </section><!-- .entry-utility -->


<?php endwhile; ?>
<?php while ( have_posts() ) : the_post(); //Open the loop ?>

  <?php $post_meta_data = get_post_custom($post->ID); ?>
        
  <!-- <div class="content"> -->

    <section id="produto">    

      <div class="container-fluid py-5">
        <div class="container">

              <div class="row ml-auto">
                  <div class="col-10 m-0 p-0">
                    <h5 class="text-uppercase cinzaClaro mb-0"><?php the_title(); ?></h5>
                  </div>
                  <div class="col-2  my-0 py-0 text-right">                
                      <a class="btn rounded-0 text-uppercase text-white" style="margin-top: -10px; padding: 3px 7px; font-size: 12px; background-color: #5b6d77;" href="<?php echo get_site_url(); ?>">X</a>
                  </div>
              </div>

              <div class="row" id="post_content">
                <div class="col-12 mt-3 px-0 py-0">
                  <?php the_content(); ?>
                </div>
              </div>

              <div class="row mx-auto">

                <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-10 px-0">

                  <span id="ficha_tecnica"></span>

                  <?php $projeto = get_post_meta($post->ID, 'custom_projeto', true); 
                  if($projeto != '') { ?>
                    <p id="projeto" class="mb-0">
                    <span class="font-weight-bolder text-uppercase">projeto:</span> 
                    <a href="http://www.instagram.com/<?php echo $projeto; ?>" target="_blank">@<?php echo $projeto; ?></a>
                    </p>
                  <?php } ?>

                  <?php $cliente = get_post_meta($post->ID, 'custom_cliente', true); 
                  if($cliente != '') { ?>
                    <p id="cliente" class="mb-0">
                    <span class="font-weight-bolder text-uppercase">cliente:</span> 
                    <a href="http://www.instagram.com/<?php echo $cliente; ?>" target="_blank">@<?php echo $cliente; ?></a>
                    </p>
                  <?php } ?>

                  <?php $construtora = get_post_meta($post->ID, 'custom_construtora', true); 
                  if($construtora != '') { ?>
                    <p id="construtora" class="mt-0 mb-0">
                    <span class="font-weight-bolder text-uppercase">construtora:</span> 
                    <a href="http://www.instagram.com/<?php echo $construtora; ?>" target="_blank">@<?php echo $construtora; ?></a>
                    </p>
                  <?php } ?>

                </div>

                <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-2 px-0 mt-1 pt-0  text-right">
                    <span class="small text-uppercase">share </span>
                    <div class="sharethis-inline-share-buttons"></div>
                </div>

              </div>          

            </div>
          </div>

    </section>

    <section id="call_to_action">
      <div class="container-fluid px-0 py-5 bg-white insetShedou">
        <div class="container py-3">

          <div class="row">
            <div class="col text-center">         
              <!-- <h1 class="text-uppercase roxo mb-0">gostou do nosso trabalho?</h1> -->
              <h1 class="text-uppercase roxo mb-0">curtiu a mikka?</h1>
              <p class="montserrat mb-4">Entre em contato que responderemos o mais breve possível.</p>
            </div>
          </div>

        <div class="row">
          <div class="col text-center">
            <a class="btn bgRoxo my-3 rounded-0 text-uppercase text-white" href="<?php echo get_site_url(); ?>/#contato" role="button">entre em contato</a>
          </div>
        </div>

        </div>
      </div>
    </section>


  <!-- </div> --><!-- end content -->


<?php endwhile; // End the loop. ?>

    <!-- </div> -->
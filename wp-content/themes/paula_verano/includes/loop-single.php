<?php while ( have_posts() ) : the_post(); //Open the loop ?>

	<div class="container-fluid">

			<div class="row">
				<div class="col px-0">

					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
									
						<div class="carousel-inner">
					    
							<div class="carousel-item active">
								<img class="d-block w-100" src=<?php echo( get_template_directory_uri() . '/images/banner-home-rosane-franco-01.jpg'); ?> alt="First slide">
								<div class="carousel-caption d-none d-md-block">
									<h1><?php echo get_category_parents( $cat, true, ' &raquo; ' ); ?></h1>								
									<div class="has-overlay"></div>
								</div>
							</div>

						</div>

					</div>

				</div>
			</div>

	</div>

	<div class="container-fluid pb-5">
		<div class="container">

			<div id="obras_home" class="row mt-5 mb-0">
				
				<div class="col">

					<div class="card-columns">

					<?php
						$cat = get_category( get_query_var( 'cat' ) );
						$cat_id = $cat->cat_ID;
						$child_categories=get_categories(
							array( 'parent' => $cat_id )
						);
						foreach ( $child_categories as $child ) {
					?>


						<div <?php post_class('content card'); ?>>
							<a href="<?php echo get_site_url() . '/category/' . $child ->cat_name . '-' . $cat->slug;  ?>">
						    	<div class="content-overlay"></div>
					        	<img class="content-image card-img-top img-fluid" src=<?php the_post_thumbnail( array(360) ); ?>
					        	<div class="content-details fadeIn-top">
						        	<ion-icon name="camera" class="text-white ionicons"></ion-icon>
					        		<h3 class="content-title text-uppercase text-white"><?php echo $child ->cat_name; ?></h3>
						    	</div>
							</a>
					    </div>

					    <?php

							}

						?>      

					</div>

				</div>

			</div>

			</div><!-- obras_home -->

			<section class="entry-utility">
			</section><!-- .entry-utility -->

		</div>
	</div>
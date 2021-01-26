<?php //while ( have_posts() ) : the_post(); //Open the loop ?>

	<div class="container-fluid d-none d-sm-block d-md-block d-lg-block d-xl-block">

			<div class="row">
				<div class="col px-0">

					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
									
						<div id="banner_menor" class="carousel-inner">
					    
							<div class="carousel-item active">
							<img class="d-block w-100" src="<?php echo( get_template_directory_uri() . '/images/banner-obras-rosane-franco.jpg'); ?>" alt="First slide">
								<div class="carousel-caption bannerMenor">
									<h1><?php echo get_category_parents( $cat, false, ' &raquo; ' ); ?></h1>								
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

			<button class="btn btn-primary ml-auto mt-5 d-flex" onclick="goBack()">voltar</button>

			<div id="obras_home" class="row mt-3 mb-0">
				
				<div class="col">

					<div class="card-columns">

					<?php
					$cat = get_category( get_query_var( 'cat' ) );
					$cat_id = $cat->cat_ID;
					$child_categories = get_categories(
					    array( 'parent' => $cat_id )
					);

				    $args = array(
				        'post_type' => 'post',
				        'category__in' => $cat_id,
				        'post_status' => 'publish',
				        'posts_per_page' => '-1',
				        'order' => 'DESC',
				        'paged' => 1,
				    );
				    // $my_post
					?>

					<?php
					    $my_posts = new WP_Query( $args );
					    if ( $my_posts->have_posts() ) : 
					    while ( $my_posts->have_posts() ) : $my_posts->the_post()               
					?>


					<div id=post-<?php the_ID(); ?> <?php post_class('content card'); ?>>
						<a 
						href="<?php echo get_the_post_thumbnail_url(); ?>"
						data-toggle="lightbox" 
						data-gallery="example-gallery" 
						data-type="image" 
						data-title="<?php the_title(); ?>
						<br><small><?php the_content(); ?></small>"
						>
					    	<div class="content-overlay"></div>
				        	<img class="content-image card-img-top img-fluid" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" src=<?php the_post_thumbnail( array(360) ); ?>
				        	<div class="content-details fadeIn-top">
					        	<ion-icon name="camera" class="text-white ionicons"></ion-icon>
				        		<h3 class="content-title text-uppercase text-white">
				        			<?php the_title(); ?>
				        			</h3>
					    	</div>
						</a>
						<small><?php echo $caption; ?></small>
				    </div>
					 
					<?php endwhile; ?>            
					<?php endif; wp_reset_query(); ?>        

					</div>

				</div>

			</div>

				<div id="loading" class="mx-auto" style="width:60px;display:block;"></div>

				<?php
				// don't display the button if there are not enough posts
				if (  $my_posts->max_num_pages > 1 )
			    echo '<button type="button" class="btn btn-primary mx-auto my-5 d-flex load-more-obras">ver mais</button>';
				?>

			</div><!-- obras_home -->

			<!-- </div> -->

			<section class="entry-utility">
				<?php //comments_template(); ?>
			</section><!-- .entry-utility -->

			<?php //endwhile; ?>

		</div>
	</div>
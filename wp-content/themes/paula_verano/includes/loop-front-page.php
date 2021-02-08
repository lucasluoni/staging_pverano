<?php while ( have_posts() ) : the_post(); //Open the loop ?>
	
		<section id="projetos">		

			<div class="container-fluid py-5">
				<div class="container">

					<div class="row py-5">
						<div class="col">

							<div id="filtros" class="list-group justify-content-center">
								<button class="btn list-group-item text-capitalize active" 
								onclick="filterSelection('category-destaque')"> todos</button>
								<button class="btn list-group-item text-capitalize" 
								onclick="filterSelection('category-comercial')"> comercial</button>
								<button class="btn list-group-item text-capitalize" 
								onclick="filterSelection('category-residencial')"> residencial</button>
							</div>

						</div>
					</div>

					<div class="row pb-0">

						<div class="card-columns col-12">					

						<?php 
						    $args = array(
						        'post_type' => 'post',
						        'post_status' => 'publish',
						        'posts_per_page' => '30',
						        'order' => 'DESC',
						        // 'paged' => 1,
		                        // 'category_name' => 'destaque'
						    );
						    $my_post
						?>

						<?php
						    $my_posts = new WP_Query( $args );
						    if ( $my_posts->have_posts() ) : 
						    while ( $my_posts->have_posts() ) : $my_posts->the_post()               
						?>

						<?php $post_meta_data = get_post_custom($post->ID); ?>

						<div id="post-<?php the_ID(); ?>" <?php post_class('card border-0 rounded-0 show'); ?>>
							<a href="<?php the_permalink(); ?>">
								<img 
								class="card-img img-fluid border-0 rounded-0" 
								alt="..."  
								src="<?php the_post_thumbnail( array(360) ); ?>
								<div class="card-img-overlay">
									<div class="containertext">
										<h6 class="card-title text-white mb-1 montserrat"><?php the_title(); ?></h6>
										<h6 class="card-text yellow">
											<?php 
											$date = get_post_meta($post->ID, 'custom_subtitulo', true); if($date != ''){echo $date;} 
											?>
										</h6>
									</div>
								</div>
							</a>
						</div>
						 
						<?php endwhile; ?>            
						<?php endif; wp_reset_query(); ?>   			

					</div><!-- card-columns -->

					</div>

				</div>
			</div>

		</section>

		<section id="sobre_nos">

			<div class="container-fluid px-0">

				<div class="container">
					<div class="row">
						<div class="col">					
							<h1 class="text-uppercase mb-3">sobre</h1>
						</div>
					</div>
				</div>

				<div class="bgimg shadow"></div>

			</div>

			<div class="container-fluid">
				<div class="container">

					<div class="row">

						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mt-5 mb-2">
							<h3 class="text-uppercase">arquitetura e decoração ao seu alcance</h3>
						</div>

						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mt-5 mb-4">
							<?php the_content(); ?>
						</div>

		</section>

		<section id="contato">

			<div class="container-fluid px-0">

				<!-- <div class="bgimg-2 shadow"></div> -->

				<div class="container">
					<div class="row">
						<div class="col">					
							<h1 class="text-uppercase roxo mt-5 mb-0">gostou do nosso trabalho?</h1>
							<p class="montserrat mb-4">Entre em contato que responderemos o mais breve possível.</p>
						</div>
					</div>
				</div>

				<div class="bgimg-2 shadow"></div>

			</div>

<!-- 			<div class="container-fluid">

				<div class="container">
					
					<div class="row">
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mt-5 justify-content-center d-flex">
							<div style="margin-right:20px; display: inline-block; min-width:48px;">
							<i class="fa fa-envelope" style="font-size:48px;color:#322a3f"></i>
							</div>
							<div style="display: inline-block; min-width: 60px;">Envie-nos um e-mail <br /><a href="mailto:contato@mikkamarcenaria.com.br">clique aqui</a></div>
						</div>
						<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 mt-5 mb-4 justify-content-center d-flex">
							<div style="margin-right:18px; display: inline-block; min-width:42px;">
							<i class="fa fa-whatsapp" style="font-size:48px;color:#322a3f"></i>
							</div>
							<div style="display: inline-block; min-width: 60px;"><p>Nosso WhatsApp <br /><a href="mailto:contato@mikkamarcenaria.com.br">+55 21 98568-2144</a></p></div>
						</div>
					</div>

				</div>

			</div> -->

			<div class="container-fluid bg-white">
				<div class="container">				

				<div class="row py-4">

		            <div class="col-12 mt-3">
		                
		                <form 
		                action="<?php echo htmlspecialchars(bloginfo('template_directory').'/mail.php')?>" 
		                method="POST" 
		                autocomplete="off">
		               			                
		                    <div class="row mx-auto">
		                
		                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
			                        <p>
				                        <!-- <label for="name" class="text-left"><strong>Nome</strong>:</label> -->
				                        <input type="text" name="name" class="form-control rounded-0" onfocus="this.value=''" placeholder="Digite o seu nome" required>
			                        </p>
		                        </div>		                        
		                        
		                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
		                        <p>
		                        <!-- <label for="email"><strong>E-mail</strong>:</label> -->
		                        <input type="email" name="email" class="form-control rounded-0" name="email" onfocus="this.value=''" placeholder="Digite o seu e-mail" required>
		                        </p>
		                        </div>

		                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
			                        <p>
				                        <!-- <label for="subject" class="text-left"><strong>Assunto</strong>:</label> -->
				                        <input type="text" name="subject" class="form-control rounded-0" onfocus="this.value=''" placeholder="Digite o assunto" required>
			                        </p>
		                        </div>

		                        <div class="col-12 mt-3">

		                        <!-- <label for="message"><strong>Mensagem</strong>:</label> -->
		                        <textarea class="form-control w-100 rounded-0 mb-2" rows="3" name="message" placeholder="Mensagem" required></textarea>

		                        <button type="submit" class="btn bgAmarelo my-3 rounded-0 text-uppercase text-white">enviar mensagem</button>
		                        </div>
		    
		                    </div>
		                </form>

		            </div>					

				</div>

			</div>
		</div>

		</section>

		<section class="entry-utility">
			<?php //comments_template(); ?>
		</section><!-- .entry-utility -->

	</div><!-- end content -->

<?php endwhile; ?>

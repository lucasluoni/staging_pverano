<?php
/* The main index file */
?>

<?php get_header(); ?>

        
        	<!-- <h2><?php //the_archive_title(); ?></h2> -->
            
			<?php get_template_part( 'includes/loop', 'archive' ); ?>

		</div><!--container-->
	</div><!--container-fluid-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
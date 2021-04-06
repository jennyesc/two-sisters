<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Two_Sisters_Bakery
 */

get_header();

?>

	<main id="primary" class="site-main">

		<div class="alignfull catering-banner">
			<?php the_post_thumbnail();?>
		</div>

		<div class="catering-wrapper">

			<h1><?php the_title();?></h1> <?php

			if( function_exists('get_field') ) { ?>

				<section class="catering-message"> <?php

					if( get_field('catering_message') ): ?>
						<p><?php the_field('catering_message'); ?> </p> <?php 
					endif;?>

				</section> 

				<section class="catering-form-container"> 

					<div class="catering-form"> <?php
						if( get_field('catering_form_title') ): ?>
							<h2><?php the_field('catering_form_title'); ?> </h2> <?php
						endif;
				
						echo do_shortcode('[forminator_form id="484"]'); ?>
					</div> 

					<div class="catering-form-images"> <?php
						$image1 = get_field('cat_image_1');
						$image2 = get_field('cat_image_2');

						if (!empty ($image1) ){
							echo wp_get_attachment_image( $image1, $image1['size']);
						};

						if (!empty ($image2) ){
							echo wp_get_attachment_image( $image2, $image2['size']); 
						}; ?>
					</div>

				</section> <?php

				wp_reset_postdata();
			
			}; ?>

		</div>
	

	</main><!-- #main -->

<?php
get_footer();

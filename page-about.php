<?php
/**
 * The template for displaying About Page
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

	<main id="primary" class="site-main about-main">
		<?php 
		if( function_exists('get_field') ) { ?>
			<section class="about-container">
				<div class="about-intro-content"> <?php	
					if (get_field('about_header_one') ): ?>
						<h2><?php the_field('about_header_one'); ?> </h2><?php 
					endif;
					
					if (get_field('about_description_one') ): ?>
						<p class="description"><?php the_field('about_description_one'); ?> </p><?php 
					endif;?>
				</div>	<!-- end about-intro-content -->		
				<div class="about-image"><?php	
					$image = get_field('about_image_one');
						if (!empty($image) ) : 
								echo wp_get_attachment_image ($image, $image['size']);	
						endif; ?>	
				</div>
							
			</section> <!-- end about-container -->
			
			<section class="about-container bakery">
				<div class="about-intro-content"><?php
					if (get_field('about_header_two') ): ?>
						<h2><?php the_field('about_header_two'); ?> </h2><?php 
					endif; 
					
					if (get_field('about_description_two') ): ?>
						<p class="description"><?php the_field('about_description_two'); ?> </p><?php 
					endif;?> 
				</div>	<!-- end about-intro-content -->	
							
					<div class="about-image-two"><?php
						$image = get_field('about_image_two');
							if (!empty($image) ) :
								echo wp_get_attachment_image ($image, $image['size']);
							endif; ?>
					</div>
						
			</section><!-- end about-container -->
			<section class="cta-image-container">					
				<article class="cta-container"><?php		
					if (get_field('cta_image_title_one') ): ?>
						<a href="<?php echo the_permalink(38)?>"><h2 class="title"><?php the_field('cta_image_title_one'); ?> </h2><?php	
							$image = get_field('cta_image_one');
								if (!empty($image) ) : 
									echo wp_get_attachment_image ($image, $image['size']); 
								endif; ?>
						</a><?php 
					endif;?>						
				</article>

				<article class="cta-container"><?php
					if (get_field('cta_image_title_two') ): ?>
						<a href="<?php echo the_permalink(31)?>"><h2 class="title"><?php the_field('cta_image_title_two'); ?> </h2><?php 
							$image = get_field('cta_image_two');
								if (!empty($image) ) : 
									echo wp_get_attachment_image ($image, $image['size']); 
								endif; ?>
						</a><?php
					endif;?>
				</article>
			</section>	<!-- end cta-image-container -->
			<?php wp_reset_postdata();
		}; ?> 					
	</main><!-- #main -->

<?php

get_footer();

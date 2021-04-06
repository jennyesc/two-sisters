<?php
/**
 * The template for displaying the front/home page
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

	<main id="primary" class="site-main home-main">
		<?php
		while ( have_posts() ) :
			the_post(); ?>

			<section class="banner-home alignfull"> 
				
				<div class="home-banner-image"><?php 
					if (has_post_thumbnail() ) : ?>
						<div class="home-img"><?php the_post_thumbnail('full'); ?> 
						<h1 class="screen-reader-text"> <?php the_title(); ?></h1></div> <?php
					endif;?>
				</div> <?php
				
					if(function_exists('get_field') ){
						$imageCookie = get_field('cookie_image');?>
						<div class="cookie-image-container"> <?php
						if (!empty($imageCookie) ) : ?> 	
							<div class="cookie-image">	
								<?php echo wp_get_attachment_image ($imageCookie, $image['size']);
						endif; ?>
						</div> <?php
					}; ?>			
				</div> <?php

				if (function_exists('the_custom_logo')) : ?>
					<div class="home-logo"><?php the_custom_logo(); ?>
					</div><?php
				endif;

				$two_sisters_description = get_bloginfo( 'description', 'display' );
				if ( $two_sisters_description || is_customize_preview() ) : ?>
					<p class="tagline"><?php echo $two_sisters_description; ?></p><?php 
				endif; 

				if (function_exists('get_field') ) {
					$linkCTA = get_field('shop_cta_link', 'option'); ?>
					<a class="home-shop-cta-btn" href="
					<?php echo $linkCTA['url']; ?>">
					<?php echo $linkCTA['title']; ?></a><?php
				}; ?>	 

			</section>

			<section class="home-intro-message">
				<?php
				//intro message
				if( function_exists('get_field') ) {
					
					$image = get_field('intro_image');
						if (!empty($image) ) : ?> 	<?php
							echo wp_get_attachment_image ($image, $image['size']); ?> <?php 	
						endif; ?>

					<section class="intro-text-container"><?php
						if (get_field('intro_title') ): ?>
							<h2 class="intro-title"><?php the_field('intro_title'); ?> </h2><?php
						endif;	
						if (get_field('intro_message') ): ?>
							<p class="intro-par"><?php the_field('intro_message'); ?> </p> <?php
						endif;
						wp_reset_postdata(); ?>

					</section> <?php
				};?> 
					
			</section>
		
			<?php
			//check if have product cats
			$terms = get_terms(
				array(
					'taxonomy' 	=> 'product_cat',
					'parent' => 0,
					'hide_empty' => true
				)
			); ?>
			<section class="home-cat-container">
				<h2>Shop Our Products</h2><?php
			//displays categories
			if ( $terms && ! is_wp_error( $terms) ){ ?>
				<ul><?php
				foreach ( $terms as $term) { ?>
					<li> <a href= "<?php echo get_term_link( $term )?>"> 
					<h3> <?php echo $term->name;?> </h3> <?php
					$thumb_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
					
					// print the IMG HTML for parent category
					if (!empty ($thumb_id) ){
						echo wp_get_attachment_image ($thumb_id, 'large'); 
					};?>	
					</a> </li> <?php
				}; ?>
				</ul> <?php
			}; ?>

			</section>			

			<div class="slick-slider-container">
				<?php echo do_shortcode('[slick-slider design="design-3" sliderheight="450" speed="4000" image_fit="true"] '); ?>
			</div>

			<section class="insta-container">
				<h2> Follow Us</h2>
					<?php echo do_shortcode('[instagram feed="122"]'); ?>
			</section>

			<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php

get_footer();

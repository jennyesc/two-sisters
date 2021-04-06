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

<main id="primary" class="site-main contact-main">
	<div class="alignfull feat-img">
		<?php the_post_thumbnail();?>
		<h1><?php the_title();?></h1> <?php		
		if( function_exists('get_field') ) :
			if (get_field('contact_intro') ) :?>
				<h2><?php the_field('contact_intro');?></h2><?php
			endif;
		endif; ?>
	</div>
	
	<div class="contact-wrapper"><?php	
		if( function_exists('get_field') ) : 			
			if( have_rows('location_information') ) :
				while ( have_rows('location_information' ) ) : the_row();	?>
					<article class="store-location">
						<div class="contact-store-info">
							<h2> <?php the_sub_field('location_name'); ?></h2>
							<p> <?php the_sub_field('location_address'); ?><br><?php
							the_sub_field('location_city');?> <?php 
							the_sub_field('location_province'); ?> &nbsp <?php 
							the_sub_field('location_postal_code');?> </p>
							<p class="highlight"> Phone: <?php the_sub_field('location_phone'); ?></p>
							<p> <span class="highlight">Hours: </span>  <br>  <?php 
							the_sub_field('opening_hours'); ?></p>
						</div>	<?php 	
						if( get_sub_field('location_image') ):
							$locationIm = get_sub_field('location_image');
							if($locationIm) :?>
								<div class="image-store"><?php 
									echo wp_get_attachment_image( $locationIm, $locationIm['size']); ?>
								</div>	<?php				
							endif; 	
						endif;?>
					</article><?php 												
				endwhile;
			endif; 
		endif; 	?>
	</div> <!-- end contact wrapper -->

	<div class="contact-map-form-container"><?php
	if( function_exists('get_field') ) : 		
		if( have_rows('location_information') ): ?>
			<div class="acf-map alignfull" data-zoom="16"><?php 
				while ( have_rows('location_information') ) : the_row(); 
					// Load sub field values.
					$title 		= get_sub_field('location_name');
					$location 	= get_sub_field('location_map');?>
										
					<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>">
						<h3><?php echo esc_html( $title ); ?></h3>
						<p><em><?php echo esc_html( $location['address'] ); ?></em></p>
					</div><?php 
				endwhile; ?>
			</div><?php
		endif; ?>
		<section class="contact-form-container"><?php
			if (get_field('contact_form_heading') ) : ?>
				<h2> <?php the_field('contact_form_heading')?> </h2><?php
			endif;
			echo do_shortcode('[forminator_form id="478"]'); ?>
		</section> <?php
	endif; ?>
	</div> <!-- end container --><?php
		
	wp_reset_postdata(); ?>

</main><!-- #main -->

<?php

get_footer();

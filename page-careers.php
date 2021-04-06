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
		<div class="career-content">
			<h1> <?php the_title(); ?> </h1>
			<?php 
				if (function_exists( 'get_field') ) :
					if	(get_field('career_message') ) : ?>
						<p> <?php the_field('career_message'); ?></p> <?php
					endif;
				endif;	
			?>
			
			<section class="banner-career alignfull"> 
				<?php 
					if (has_post_thumbnail() ) :
						the_post_thumbnail('full');
					endif;
				?>
			</section>

			<section class="available-jobs"><?php
				if (function_exists( 'get_field') ) : 
					if	(get_field('positions_heading') ) : ?>
						<h2><?php the_field('positions_heading');?></h2><?php
					endif; ?>
					<div class="flex-content"><?php 
						if(have_rows('job_listings') ) : 
							while ( have_rows('job_listings') ) : the_row();?>
								<article class="job-listings">
									<h3> <?php the_sub_field('position');?> </h3>
									<p><strong> Location: </strong> <?php the_sub_field('location');?> </p>
									<p><strong> Job description:</strong> <br> <?php the_sub_field('job_details');?></p>
									<p><a href="#form-career">Click here to apply  </a></p><?php 
										if(has_sub_field('closing_date')) : ?>
											<p> <?php the_sub_field('closing_date'); ?> </p><?php 
										endif; ?>
								</article><?php 
							endwhile;
						endif;?>
					</div> <?php
				endif; ?>
			</section>

			<section class="career-form-section"><?php
					if(function_exists('get_field') ) :
						if(get_field('career_form_heading') ) : ?>
							<h2> <?php the_field('career_form_heading'); ?> </h2><?php
						endif;?>
							<div class="flex-form-section">
								<div class="career-form-images"><?php 	
									$image = get_field('image_beside_form');
										if($image) :
											echo wp_get_attachment_image( $image, $image['size']);								
										endif;

										$image2 = get_field('image_beside_form_2');
										if($image2) :
											echo wp_get_attachment_image( $image2, $image2['size']);								
										endif; ?>
								</div>
								<div class="form-career" id="form-career">	<?php 
									echo do_shortcode('[forminator_form id="472"]'); ?>
								</div>
							</div> <?php
					endif; ?>
			</section>	
		</div>
	</main><!-- #main -->

<?php
get_footer();

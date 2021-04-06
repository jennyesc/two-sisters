<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Two_Sisters_Bakery
 */

?>

	<footer id="colophon" class="site-footer">

	<?php 
		if( function_exists('get_field') ) { ?>

			<div class="shop-cta-container"> <?php

				$imageCTA = get_field('shop_cta_image', 'option');
				$linkCTA = get_field('shop_cta_link', 'option');

				if( !empty ($linkCTA) && !is_shop() ): ?>
					<a href="<?php echo $linkCTA['url']; ?>">
						<p class="shop-cta-link"> <?php echo  $linkCTA['title']; ?> </p>
						<?php
						if (!empty ($imageCTA) ){
							echo wp_get_attachment_image( $imageCTA, $imageCTA['size']);
						};
						?>
					</a><?php   

				else: ?>
					<a href="<?php the_permalink(31); ?>">
						<p class="catering-cta-link"> <?php echo get_the_title(31); ?> </p><?php
						if (!empty ($imageCTA) ){
							echo wp_get_attachment_image( $imageCTA, $imageCTA['size']);
						};?>
					</a><?php 
				endif; ?>

			</div> 

			<div class="main-footer-wrapper">

				<div class="contact-explore-wrapper">

					<section class="footer-location-information"><?php
							if( get_field('contact_title', 'option') ): ?>
								<h2><?php the_field('contact_title', 'option'); ?> </h2> <?php 
							endif;?>
							<div class="location-grid"><?php
								if( have_rows('location_information', 'option') ) :
									while ( have_rows('location_information', 'option' ) ) : the_row();	?>
										<article class="store-location">
											<div class="contact-store-info">
												<p> <?php the_sub_field('location_name'); ?></p>
												<p> <?php the_sub_field('location_address'); ?></p>
												<p> <?php the_sub_field('location_city');?>,
													<?php the_sub_field('location_province');?>
													<?php the_sub_field('location_postal_code');?> </p>
												<p> Ph: <?php the_sub_field('location_phone'); ?></p>
											</div>	
										</article><?php 
									endwhile;
								endif; ?>
							</div> 
					</section>

					<section class="footer-explore-information"> <?php 

						if( get_field('explore_title', 'option') ): ?>
							<h2><?php the_field('explore_title', 'option'); ?> </h2> <?php 
						endif; ?>

							<div class="right-footer-menu">
								<nav id="footer-navigation" class="footer-navigation">
									<?php 	wp_nav_menu( array( 'theme_location' => 'footer' ) );		?>
								</nav>
							</div>

					</section> <?php

					wp_reset_postdata(); ?>

				</div><!-- contact-explore-wrapper --> <?php

		}; ?> 

				<div class="bottom-footer-menu">
					<nav id="social-navigation" class="social-navigation">
						<?php 	wp_nav_menu( array( 'theme_location' => 'social' ) );		?>
					</nav>
					<p>© 2021
						<span><a href="https://gaiasantoro.ca" target="_blank">Gaia Santoro,</a></span>
						<span><a href="https://www.jennyescobell.com" target="_blank">Jenny Escobell,</a></span>
						<span><a href="https://krizzelaldama.com" target="_blank">Krizzel Aldama &</a></span>
						<span><a href="https://mikaelacodes.com" target="_blank">Mikaela Abrams</a></span>
					</p>
				</div><!-- .footer-menus -->
			</div><!-- wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

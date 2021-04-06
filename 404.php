<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Two_Sisters_Bakery
 */

get_header();
?>

	<main id="primary" class="site-main error-404">

		<section class="not-found">
			<header class="page-header">
				<div class="four-o-four-box">		
					<p class="first-four">	4 </p>
					<div class="donut">  </div>
					<p class="last-four"> 4</p>
				</div>

				<h1 class="page-title"> D'oh!</h1>
			</header><!-- .page-header -->

			<section class="page-content">
				<h2>	It looks like this page is taking a break.</h2>
				<p> Please visit our shop or feel free to contact us.</p>

				<nav>
					<a class="a-shop" href="https://twosistersbakery.bcitwebdeveloper.ca/shop/"> </a>
					<a class="shop-text" href="https://twosistersbakery.bcitwebdeveloper.ca/shop/"> Shop </a>
					<a class="a-contact" href="https://twosistersbakery.bcitwebdeveloper.ca/contact/"> </a>
					<a class="contact-text" href="https://twosistersbakery.bcitwebdeveloper.ca/contact/"> Contact </a>


					<!-- <ul>
						<li class="nav-shop"> <a class="a-shop" href="https://twosistersbakery.bcitwebdeveloper.ca/shop/">Shop  </a> </li>
						<li class="nav-contact"> <a class="a-contact" href="https://twosistersbakery.bcitwebdeveloper.ca/contact/">Contact</a> </li>
					</ul> -->
				</nav>
			</section>
		</section><!-- not-found -->

	</main><!-- #main -->

<?php
get_footer();

<?php
/**
 * The template for Contact page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Herb_&_Life
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<h1><?php the_title(); ?></h1>
		<div class="wrapper">
			<section class="contact-intro">
				<?php if( function_exists( 'get_field' ) ){
					$contract_intro = get_field( 'contract_intro' );
				}?>
				<p><?php if( $contract_intro ){ echo $contract_intro; }?></p>
			</section><!--.contact-intro-->

			<section class="contact-form">
				<?php if(is_active_sidebar( 'contact-form' )){
						dynamic_sidebar( 'contact-form' );
					}
				?>
			</section><!--.contact-form-->

			<section class = "store-locator">
				<h2>Locations</h2>

				<?php if(is_active_sidebar('store-locator')){
					dynamic_sidebar('store-locator');
				}
				?>    
			</section><!--.contact-form-->
			</div><!-- .wrapper -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();

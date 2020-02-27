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
 * @package Herb_&_Life
 */

get_header();
?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class = "hero-slide slider">
			
			<?php 
			if(get_field('hero_image_slider') ):?>
			
			
				<?php while(has_sub_field('hero_image_slider')): 
				$images = get_sub_field('hero_image');
				$header = get_sub_field('hero_header');
				$description = get_sub_field('hero_description');
				$buttonText = get_sub_field('hero_button_label');
				$buttonLink = get_sub_field('hero_link');
				$size = 'full'; // (thumbnail, medium, large, full or custom size)
				?>
			
				<div class = "hero-banner">
						
						<?php echo wp_get_attachment_image( $images, $size ); ?>
						<div class="hero-banner-text-box">
							<h3>
							<?php echo $header?>
							</h3>
							<?php if($description):?>
							<p>
							<?php echo $description?>
							<p>
							<?php endif; ?>
							<?php if($buttonText):
								echo '<button src=".$buttonLink.">'.$buttonText.'</button>'
							?>
							<?php endif; ?>
						</div>	
				</div>							
				<?php endwhile; ?>
										
			<?php endif; ?>
				
			</section>

			<section class="home-intro">
				<?php if(get_field('home_intro_title') ):?>	
				<h1><?php the_field('home_intro_title')?></h1>
				<?php endif;?>

				<?php if(get_field('home_intro') ):?>	
				<p><?php the_field('home_intro')?></p>
				<?php endif;?>
				
			</section>

			<section class ="featured-products">
				<h2>Featured Products</h2>
				<?php if(get_field('home_featured') ):?>
				<?php while(has_sub_field('home_featured')): 
					$title = get_sub_field('featured_title');
					$text = get_sub_field('featured_text');
					$buttonText = get_sub_field('featured_button_label');
					$posts = get_sub_field('featured_image');
					if($posts):?>
					<div class = "featured-image">
					<?php foreach($posts as $post):?>	
					<?php setup_postdata($post); ?>
					<?php the_post_thumbnail( 'medium' );?>
					<?php endforeach;
					wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
					</div>
					<?php endif;?>
				<div class="featured-text-box">
				<h3><?php echo $title ?></h3>
				<p><?php echo $text ?><p>
				<button><a href = "<?php get_the_permalink(); ?>"><?php echo $buttonText ?></a></button>
				</div>
				<?php endwhile; ?>
				<?php endif;?>        
				<!-- Featured products loop -->  
			</section>

			<section class = "category">
				<h2>Categories</h2>
				<?php
				$prod_cat_args = array(
						'taxonomy'=>'product_cat',
						'orderby'=>'name',
						'empty' => 0,
						'parent'=>0  //exclude subcategory
				);
				$terms = get_categories($prod_cat_args);
				foreach($terms as $term){
					$term_link = get_term_link($term);
					echo '<div><a class = "category" href="'.esc_url($term_link).'">'.$term->name . '</a></div>';
				}

				?>
			</section>

			<section class="why-us"> 
				<h2>Why Choose Us?</h2>
				<?php if(get_field('why_us') ):?>
					<?php while(has_sub_field('why_us')): 
					$title = get_sub_field('why_us_title');
					$images = get_sub_field('why_us_image');
					$size = 'medium'; // (thumbnail, medium, large, full or custom size)
					$lists = get_sub_field('why_us_list');
					?>
					<div class = "whyus-wrapper">
							<h3>
							<?php echo $title?>
							</h3>
							<?php echo wp_get_attachment_image( $images, $size ); ?>
						
							<?php if($lists):?>
							<ul>
								<?php foreach($lists as $list):?>
									<?php foreach($list as $list_item):?>
									<li><?php echo $list_item ?></li>
									<?php endforeach;?> 
								<?php endforeach;?>
							</ul>
							<?php endif; ?>	
						</div>	
					</div>
					
					<?php endwhile;?>
				<?php endif;?>
			</section>
		
		<section class = "latest-blog">
			<h2>Latest News</h2>
			<?php 
			$arg = array('posts_per_page'=> 1);
			$blog_query = new WP_Query($arg);
			if($blog_query->have_posts()):
				while($blog_query->have_posts()):
					$blog_query->the_post(); ?>
				<?php the_post_thumbnail(); ?>
				<h3><a href = "<?php the_permalink(); ?>">
				<?php the_title();?>
				</a></h3>
				<?php the_content()?>
			<?php
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</section>

		<section class = "upcoming-events">
		<h2>Upcoming Events</h2>
		<ul>
			<?php 
			$args = array( 'post_type' => 'product', 'posts_per_page' => 3, 'product_cat' => 'events', 'orderby' => 'rand' );
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
					<li class="events">    
					 <a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">
						 <?php woocommerce_show_product_sale_flash( $post, $product ); ?>
						 <?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" />'; ?>
						 <h3><?php the_title(); ?></h3>
						 <p><?php the_content();?></p>                  
					 </a>
					 <?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>
				 </li>
			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
		</ul>
		</section>

		<section class="awards">
			<h2>Awards & Certificates</h2>
		</section>
			

		<?php
		// while ( have_posts() ) :
		// 	the_post();

		// 	get_template_part( 'template-parts/content', 'page' );

		// 	// If comments are open or we have at least one comment, load up the comment template.
		// 	if ( comments_open() || get_comments_number() ) :
		// 		comments_template();
		// 	endif;
		// endwhile; // End of the loop.
		?>

	



		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();

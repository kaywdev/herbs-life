<?php
	$tags = [];
	$tagObjects = get_the_tags();

	if( $tagObjects ) {
		foreach( $tagObjects as $tagObject ) {
			$tags[] = $tagObject->name;
		}
	}

	$tags = implode( ' ', $tags ); ?>

<a class="blog-post <?php echo $tags; ?>" href="<?php echo get_permalink( get_the_ID() ) ?>">
	<article class="content" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php the_post_thumbnail( 'blog-thumbnail' ); ?>
			
			<header class="entry-header">
				<div class="meta-info">
					<?php
						$targetCategories 	= array( 'news', 'recipe' );
						$postCategories 	= [];
						$postCategory 		= "";

						$categories 		= get_the_category();
						if( $categories ) {
							foreach( $categories as $category ) {
								$postCategories[] = $category->name;
							}
						}

						foreach( $targetCategories as $targetCategory ){
							$index = array_search( $targetCategory, $postCategories );
							if( $index >= 0 ) {
								$postCategory = $postCategories[ $index ];		
							}
						}
					?>

					<span class="author"><?php echo "Written by " . get_the_author(); ?></span><!--.author-->
					<span class="category"><?php echo ucwords($postCategory); ?></span><!--.category-->
				</div><!--.meta-info-->
				<h2 class="title"><?php the_title(); ?></h2><!--.title-->
			</header>

			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div><!-- .entry-content -->
	</article><!--.blog-post#post-<?php the_ID(); ?> -->
</a><!--.post-link-->
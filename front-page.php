<?php
/*
Template Name: Home - Background Photo
*/
?>

<?php get_header(); 
    $theme_option = flagship_sub_get_global_options();
    	
		$news_query_cond = $theme_option['flagship_sub_news_query_cond'];
			if ( false === ( $news_query = get_transient( 'news_mainpage_query' ) ) ) {
				if ($news_query_cond === 1) {
					$news_query = new WP_Query(array(
						'post_type' => 'post',
						'tax_query' => array(
							array(
								'taxonomy' => 'category',
								'field' => 'slug',
								'terms' => array( 'books' ),
								'operator' => 'NOT IN'
							)
						),
						'posts_per_page' => 3)); 
				} else {
					$news_query = new WP_Query(array(
						'post_type' => 'post',
						'posts_per_page' => 3)); 
				}
			set_transient( 'news_mainpage_query', $news_query, 2592000 );
			} 	

?>

<main>

	<!-- Set photo background -->
		<div class="row hide-for-small-only" id="photo" aria-label="Highlighted Biology Research Imagery">
			<div class="small-12 columns radius10">
			</div>
		</div>

		
		<?php the_content(); ?>


	<!-- Begin main content area -->
	<div class="row wrapper radius10" id="page" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
		<div class="small-12 columns">

		    <?php if ( $news_query->have_posts() ) : ?>
		    	<div class="row">
		    		<div class="small-12 columns">
		            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	                    <?php the_content(); ?>
	                <?php endwhile; endif; ?>
		    		</div>
		    	</div>
		        <div class="row">
			        <div class="small-12 columns">
			        	<h4><?php echo $theme_option['flagship_sub_feed_name']; ?></h4>
			        </div>
		           <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
		            <article class="news-item <?php if(is_sticky()) :?>sticky<?php endif;?>" aria-labelledby="post-<?php the_ID(); ?>" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">   	 
		                <div class="small-12 large-4 columns post-container">
		                    <div class="row">
		                        <div class="small-11 small-centered columns post">
	        	                    <?php if(has_post_thumbnail()) : ?>
	        	                      <?php the_post_thumbnail('rss', array('itemprop' => 'image')); ?>
	        	                    <?php endif; ?>
	                                <div class="row">
	                                    <div class="small-12 columns">
	                                        <h1 itemprop="headline">
												<a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>"><?php the_title();?></a>
	                                        </h1>
	                                        <div class="entry-content" itemprop="text">	
	                                        	<?php the_excerpt(); ?>
	                                        </div>
	                                    </div>
	                                </div>
		                        </div>
		                    </div>
		                </div>
		             </article>
		           <?php endwhile; ?>
		        </div>
		        <?php
				   $blog_id = get_current_blog_id();
				   if ( 57 != $blog_id && 58 != $blog_id ) { // 57=Biology 58=CMDB Site IDs. Neither have News posts.
				?>
			        <div class="row">
					    <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>"><h5 class="black">View All <?php echo $theme_option['flagship_sub_feed_name']; ?></h5></a>
					</div>
				<?php } ?>
			<?php endif; ?>
		</div>
	</div>
</main>
<?php get_footer(); ?>
